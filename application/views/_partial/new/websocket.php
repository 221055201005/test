<?php
  $ip_address = $_SERVER['REMOTE_ADDR'];
  if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }

  if(isset($this->user_cookie[0])){
    $user_cookie = $this->user_cookie;
  }
  else{
    $user_cookie = explode(";",$this->input->cookie('portal_user'));
  }

  if($ip_address == getenv('IP_FIREWALL_GATEWAY')){
    $server_main = getenv('WEBSOCKET_HOST_ALT');
    $server_alt = getenv('WEBSOCKET_HOST');
  }
  else{
    $server_main = getenv('WEBSOCKET_HOST');
    $server_alt = getenv('WEBSOCKET_HOST_ALT');
  }
?>
<script>
  var conn;
  $(document).ready(function(){
    websocket_connect("<?= $server_main ?>");
  });

  function websocket_connect(server_address) {
    conn = new WebSocket('wss://'+server_address+':<?= getenv('WEBSOCKET_PORT') ?>/');//Websocket
    conn.onopen = function(e) {
      console.log("Connection established!");
      sendMsg({
        event:'connect', 
        id_user: <?php echo $user_cookie[0] ?>,
        name: "<?php echo $user_cookie[1] ?>",
        project: <?php echo $user_cookie[10] ?>,
        department: <?php echo $user_cookie[4] ?>,
        browser: "<?php echo $this->agent->browser(); ?>",
        ip_address: "<?php echo $ip_address; ?>",
        module: "PCMS2",
      });
      if(typeof init_signal_ws === "function"){
        init_signal_ws();
      }
    };
    conn.onmessage = function(e) {
      var data = JSON.parse(e.data);
      if(data.event == 'getclientperip') {
        if(typeof eventgetclientperip === "function"){
          eventgetclientperip(data);
        }
        else{
          console.log(data);
        }
      }
      else if(data.event == 'forcelogout'){
        if(typeof eventforcelogout === "function"){
          eventforcelogout(data);
        }
      }
    };
    conn.onerror = function(e) {
      console.log(e.code);
      if(server_address != "<?= $server_alt ?>"){
        websocket_connect("<?= $server_alt ?>");
      }
    };
  }

  function sendMsg(obj){
    conn.send(JSON.stringify(obj));
    console.log(obj);
  }

  function eventforcelogout(obj) {
    window.location = "https://<?php echo $_SERVER['SERVER_NAME'] ?>/smoe_portal/auth/logout/"+obj.login_status+"?notif="+obj.msg;
  }
</script>