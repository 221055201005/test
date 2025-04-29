
function check_data() {
	console.log(navigator);

	// Push.create("Hello world!", {
 //    body: "How's it hangin'?",
 //    icon: '/icon.png',
 //    timeout: 4000,
 //    onClick: function () {
 //        window.focus();
 //        this.close();
 //    }
	// });
	// showNotification('Vibration Sample', {
 //      body: 'Buzz! Buzz!',
 //      icon: '../images/touch/chrome-touch-icon-192x192.png',
 //      vibrate: [200, 100, 200, 100, 200, 100, 200],
 //      tag: 'vibration-sample'
 //    });
	setTimeout(function(){ check_data(); }, 3000);
}

self.addEventListener('install', function(e) {
	check_data();
	// if (global === undefined) {

 //    var global = window;
 //  }
  // importScripts('push.js');
});
// self.importScripts('push.js');
