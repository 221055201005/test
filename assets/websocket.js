console.log('websocket.js');
console.log('browser: ', getBrowserInfo());
console.log('ip: ', getIPAddresses());
console.log('cookie: ', getCookie('portal_user'));

// (function(window) {
// 	// Configuration object to store settings
// 	const WebSocketConfig = {
// 			serverMain: '',
// 			serverAlt: '',
// 			websocketPort: '',
// 			userCookie: [],
// 			ipAddress: ''
// 	};

	// Fungsi untuk mendapatkan informasi browser
	function getBrowserInfo() {
			const ua = navigator.userAgent;
			let browser = 'Unknown';
			
			if (ua.includes('Firefox')) browser = 'Firefox';
			else if (ua.includes('Chrome')) browser = 'Chrome';
			else if (ua.includes('Safari')) browser = 'Safari';
			else if (ua.includes('Edge')) browser = 'Edge';
			else if (ua.includes('MSIE') || ua.includes('Trident/')) browser = 'Internet Explorer';
			
			return browser;
	}

	// Fungsi untuk mendapatkan alamat IP
	
	async function getLocalIPAddress() {
		return new Promise((resolve, reject) => {
				// Create a temporary RTCPeerConnection
				const pc = new RTCPeerConnection({
						iceServers: []
				});

				// Create a data channel to trigger ICE candidates
				pc.createDataChannel("");

				// Create an offer
				pc.createOffer()
						.then(offer => pc.setLocalDescription(offer))
						.catch(err => reject(err));

				// Listen for ICE candidates
				pc.onicecandidate = (ice) => {
						// Check if ice candidate is not null
						if (!ice || !ice.candidate) {
								pc.close();
								return;
						}

						// Extract IP from candidate
						const candidateStr = ice.candidate.candidate;
						const ipRegex = /([0-9]{1,3}(\.[0-9]{1,3}){3})/;
						const match = candidateStr.match(ipRegex);

						if (match) {
								const ip = match[1];
								
								// Filter out non-local IP addresses
								const localIPRegex = /^(192\.168\.|10\.|172\.(1[6-9]|2[0-9]|3[0-1])\.)/;
								
								if (localIPRegex.test(ip)) {
										pc.close();
										resolve(ip);
								}
						}
				};
		});
	}

	// Fallback function to get IP addresses
	async function getIPAddresses() {
		try {
				// Try to get local IP first
				const localIP = await getLocalIPAddress();
				if (localIP) return localIP;
		} catch (localError) {
				console.warn('Could not retrieve local IP:', localError);
		}

		// Fallback to public IP
		try {
				const response = await fetch('https://api.ipify.org?format=json');
				const data = await response.json();
				return data.ip;
		} catch (publicError) {
				console.error('Error getting IP address:', publicError);
				return 'Unknown';
		}
	}


	// Fungsi untuk mendapatkan cookie
	function getCookie(name) {
			const value = `; ${document.cookie}`;
			const parts = value.split(`; ${name}=`);
			if (parts.length === 2) return parts.pop().split(';').shift();
			return null;
	}

// 	// Function to initialize WebSocket connection
// 	async function websocketConnect(serverAddress) {
// 			// Ensure we have a server address
// 			if (!serverAddress) {
// 					console.error('No server address provided');
// 					return;
// 			}

// 			// Dapatkan informasi pengguna dari cookie
// 			const portalUserCookie = getCookie('portal_user');
// 			let userInfo = [];
			
// 			try {
// 					// Parsing cookie
// 					if (portalUserCookie) {
// 							userInfo = JSON.parse(decodeURIComponent(portalUserCookie));
// 					}
// 			} catch (error) {
// 					console.error('Error parsing portal_user cookie:', error);
// 			}

// 			// Dapatkan alamat IP dan info browser
// 			const ipAddress = await getIPAddress();
// 			const browser = getBrowserInfo();

// 			// Create WebSocket connection
// 			const conn = new WebSocket(`wss://${serverAddress}:${WebSocketConfig.websocketPort}/`);

// 			// Connection opened
// 			conn.onopen = function(e) {
// 					console.log("Connection established!");
					
// 					// Send connection message
// 					sendMsg({
// 							event: 'connect',
// 							id_user: userInfo[0] || 'Unknown',
// 							name: userInfo[1] || 'Unknown',
// 							project: userInfo[10] || 'Unknown',
// 							department: userInfo[4] || 'Unknown',
// 							browser: browser,
// 							ip_address: ipAddress,
// 							module: window.location.pathname
// 					});

// 					// Call init_signal_ws if it exists
// 					if (typeof window.init_signal_ws === "function") {
// 							window.init_signal_ws();
// 					}
// 			};

// 			// Listen for messages
// 			conn.onmessage = function(e) {
// 					try {
// 							const data = JSON.parse(e.data);

// 							if (data.event === 'getclientperip') {
// 									if (typeof window.eventgetclientperip === "function") {
// 											window.eventgetclientperip(data);
// 									} else {
// 											console.log(data);
// 									}
// 							} else if (data.event === 'forcelogout') {
// 									if (typeof window.eventforcelogout === "function") {
// 											window.eventforcelogout(data);
// 									}
// 							}
// 					} catch (error) {
// 							console.error('Error parsing message:', error);
// 					}
// 			};

// 			// Handle connection errors
// 			conn.onerror = function(e) {
// 					console.log(e.code);
// 					if (serverAddress !== WebSocketConfig.serverAlt) {
// 							websocketConnect(WebSocketConfig.serverAlt);
// 					}
// 			};

// 			// Expose send method
// 			window.sendMsg = function(obj) {
// 					if (conn.readyState === WebSocket.OPEN) {
// 							conn.send(JSON.stringify(obj));
// 							console.log(obj);
// 					} else {
// 							console.error('WebSocket is not open');
// 					}
// 			};
// 	}

// 	// Global function to initialize WebSocket with configuration
// 	window.initWebSocketClient = function(config) {
// 			// Merge provided config with default config
// 			Object.assign(WebSocketConfig, config);

// 			// Determine which server to use
// 			const serverToUse = WebSocketConfig.ipAddress === WebSocketConfig.firewallGateway 
// 					? WebSocketConfig.serverAlt 
// 					: WebSocketConfig.serverMain;

// 			// Initialize connection
// 			websocketConnect(serverToUse);
// 	};

// 	// Default force logout handler (can be overridden)
// 	window.eventforcelogout = function(obj) {
// 			window.location = `https://${window.location.hostname}/smoe_portal/auth/logout/${obj.login_status}?notif=${obj.msg}`;
// 	};

// 	// Automatically initialize WebSocket when script loads
// 	if (window.initWebSocketClient) {
// 			window.initWebSocketClient({
// 					serverMain: 'your-main-server.com',
// 					serverAlt: 'your-alt-server.com',
// 					websocketPort: '443', // Sesuaikan dengan port WebSocket Anda
// 					firewallGateway: 'your-firewall-gateway-ip'
// 			});
// 	}
// })(window);
