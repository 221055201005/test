
    <footer class="container-fluid bg-white py-2">
      <div class="row">
        <div class="col-12 col-md">
          <center><small class="d-block my-1 text-muted">&copy; 2021 - PT. SMOE - PROJECT CONTROL MANAGEMENT SYSTEM </small></center>
        </div>
      </div>
    </footer>
    
    
    <?php $this->load->view('_partial/websocket');?>

    <script type="text/javascript">
      $('#dataTable').DataTable( {
         drawCallback: function () {
          //  console.log( 'Table redrawn '+new Date() );
         }
      } );

      $('.dataTable_v1').DataTable( {
        "paging": false,
        "order": []
      } );

      $('select.select2').select2({
        theme: 'bootstrap'
      });

      $('.select2-multiple').select2({
        allowClear: true,
        tokenSeparators: [', ', ' '],
        multiple: true,
        // selectOnClose: true,
        placeholder: 'select..'
      })

      $(".overflow-auto").floatingScroll();

      $('.custom-file-input').on('change', function() {
        $(this).parent().find('.custom-file-label').html($(this).val().replace(/C:\\fakepath\\/i, ''));
      });

      $('[data-toggle="tooltip"]').tooltip()

      var delayTimer_sidebarCollapse;
    	function sidebarCollapse(){
        $('#sidebar').toggleClass('active');
        clearTimeout(delayTimer_sidebarCollapse);
        delayTimer_sidebarCollapse = setTimeout(function() {
          $.ajax({            
            url: "<?php echo base_url();?>home/sidebarCollapse/",
          });
        }, 500);
    	}

      <?php if($this->session->flashdata('success') == TRUE): ?>
      Swal.fire({
        title: 'Success!',
        type: 'success',
        text: '<?php echo $this->session->flashdata('success'); ?>',
        timer: 1000
      })
      <?php endif; ?>
      <?php if($this->session->flashdata('error') == TRUE): ?>
      Swal.fire(
        'Error!',
        '<?php echo $this->session->flashdata('error'); ?>',
        'error'
      )
      <?php endif; ?>
      $('form').attr('autocomplete', 'off');
      $('#sidebar').on('show.bs.collapse','.collapse', function() {
        $('#sidebar').find('.collapse.show').collapse('hide');
      });

      async function sweetalert(type, text, input = null,e = null, func_name = null) {
        if(type == 'success'){
          Swal.fire({
            title: 'Success!',
            type: 'success',
            text: text,
            timer: 1000
          })
        }
        else if(type == 'error'){
          Swal.fire(
            'Error!',
            text,
            'error'
          )
        }
        else if(type == 'loading'){
          Swal.fire({
            title: text,
            onBeforeOpen () {
              Swal.showLoading ()
            },
            onAfterClose () {
              Swal.hideLoading()
            },
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false
          });
        }
        else if(type == 'confirm' && input != null && e != null){
          e.preventDefault();
          Swal.fire({
            title: text,
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes !'
          }).then((result) => {
            if (result.value) {
              sweeralert_confirm(type, text, input, e, func_name);
            }
          })
        }
        else if(type == 'confirm_remarks' && input != null && e != null){
          e.preventDefault();
          const { value: remarks } = await Swal.fire({
            title: text,
            text: "You won't be able to revert this!",
            type: 'warning',
            input: 'textarea',
            inputPlaceholder: 'Type your remarks here...',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!',
            inputValidator: (value) => {
              if (!value) {
                return 'You need to write something!'
              }
            }
          })
          if(remarks){
            // console.log(remarks)
            sweeralert_confirm(type, text, input, e, func_name, remarks);
          }
        }
      }

      function sweeralert_confirm(type, text, input = null, e = null, func_name = null, remarks = '') {
        if($(input).is("[href]")){
          window.location = $(input).prop("href");
        }
        else if($(input).is("[type]")){
          if($(input).prop("type") == "submit"){
            $(input).closest("form").submit()
          }
          else if(func_name != null){
            if(typeof window[func_name] === "function"){
              if(type == 'confirm_remarks'){
                window[func_name](input, remarks);
              }
              else{
                window[func_name](input);
              }
            }
          }
        }
      }

      $(function() {
        var resize_tbl_pressed = false;
        var resize_tbl_start = undefined;
        var resize_tbl_startX, resize_tbl_startWidth;
        
        $("table th").mousedown(function(e) {
          // console.log("resize");
          resize_tbl_start = $(this);
          resize_tbl_pressed = true;
          resize_tbl_startX = e.pageX;
          resize_tbl_startWidth = $(this).width();
          $(resize_tbl_start).addClass("resizing");
        });
        
        $(document).mousemove(function(e) {
          if(resize_tbl_pressed) {
            $(resize_tbl_start).css("min-width", resize_tbl_startWidth+(e.pageX-resize_tbl_startX));
          }
        });
        
        $(document).mouseup(function() {
          if(resize_tbl_pressed) {
            $(resize_tbl_start).removeClass("resizing");
            resize_tbl_pressed = false;
          }
        });
      });

      function generate_tabindex(element, numdowntab) {
        inputs = $(element);
        inputs.each(function(i, el) {
            $(el).attr('tabindex', i+1);
        });
        keypress_input_table(element, numdowntab)
      }

      function keypress_input_table(element, numdowntab) {
        $(element).keypress(function(evt) {
          // If the keypress event code is 13 (Enter)
          if (evt.keyCode == 13) {
            // Make sure this is not a submit input
            if ($(this).prop('type') !== 'submit') {
              evt.preventDefault();
              currentTabindex = $(this).attr('tabindex');
              if (currentTabindex) {
                nextInput = $('input[tabindex="'+ (parseInt(currentTabindex)+numdowntab) +'"]');
                if (nextInput.length) {
                  nextInput.focus();
                  nextInput.select();
                  return false;
                }
                else{
                  nextInput = $('select[tabindex="'+ (parseInt(currentTabindex)+numdowntab) +'"]');
                  if (nextInput.length) {
                    nextInput.focus();
                    return false;
                  }
                }
              }
            }
          }
        });
      }
    </script>

    <!-- USER VALIDATION  -->

      <?php  
        $CI =& get_instance(); 
        $CI->load->helper('browser'); 
        $CI->load->model('general_mod');   
        $data_cookies = helper_cookies(@$CI->input->get('user'));
        $CI->user_cookie 		  = $data_cookies['data_user'];

        if($this->user_cookie[12] == getenv('IP_FIREWALL_GATEWAY')){
          $this->link_server = getenv('LINK_SERVER_OUTSIDE');
        } else {
          $this->link_server = getenv('LINK_SERVER');
        }
      ?>

      <script src="<?php echo base_url('assets/sweetalert2/sweetalert2.all.min.js') ?>"></script> 
      <script type="text/javascript">
          
          function swall_data(id_user,life_time){  
            var links_changes = "<?= $this->link_server ?>/smoe_portal/Password_config/Password_config/user_edit/"+id_user+"/warning"; 
            Swal.fire({
              title: '<strong><u>Password Expired Notification!</u></strong>',
              icon: 'info',
              html:
                'Your password will expired in <b> '+life_time+' Days </b>, <br/> ' +
                'Please change your password On ' +
                '<a href="'+links_changes+'">This Links!</a> ',
              showCloseButton: true, 
            })
          }  

          $(document).ready(function() { 
            time_restriction_checker(); 

            // setInterval(function() {
            //   load_notification('<?= strtr($this->encryption->encrypt($CI->user_cookie[0]), '+=/', '.-~') ?>')
            // }, 3000);
            
          });

          function time_restriction_checker() {   
              var currentTime = new Date();  
              $.ajax( {
                url: "<?= $this->link_server ?>/smoe_portal/Checker_time/restriction_time_checker",
                dataType: "json",
                data: {
                  id_user: '<?= $CI->user_cookie[0]; ?>', 
                  company: '<?= $CI->user_cookie[11]; ?>', 
                },
                success: function(data) { 
                  var company_name         = data.company_name;
                  var available_start_from = Number(data.available_start_from);
                  var available_start_to   = Number(data.available_start_to);
                  var status_full_access   = data.status_full_access;
                  var server_time          = data.server_time;  
                  var hours                = currentTime.getHours();
                  var time_restric_status  = Number(data.time_restric_status);

                  if(hours < available_start_from || hours > available_start_to){ 
                      if(time_restric_status == 1){
                        <?php if($this->user_cookie[12] == getenv('IP_FIREWALL_GATEWAY')){ ?>  
                          var links_logout = "<?= $this->link_server.'/smoe_portal/auth/logout' ?>";
                          window.location.href = links_logout; 
                        <?php } else { ?>  
                          console.log("Inside Access - Policy Allowed!");
                        <?php } ?> 
                      } else { 
                        console.log("Time Restriction - Policy Disabled!"); 
                      }  
                  } else {
                      console.log("Working Hours Policy : " + available_start_from + " - " + hours + " - " + available_start_to);
                  } 
                }
              });  
          } 
      </script> 

      <?php 
          if(isset($CI->user_cookie) && !isset($this->exception)){ 

              $where["id_user"] = $CI->user_cookie[0];
              $get_user = $CI->general_mod->get_user_data($where);
              unset($where); 
 
              
              if($get_user[0]["login_status"] == 0 || sizeof($get_user) <= 0){

                if($this->user_cookie[12] == getenv('IP_FIREWALL_GATEWAY')){
                   redirect($this->link_server."/smoe_portal/auth/logout");
                } else {
                   redirect($this->link_server."/smoe_portal/auth/logout");
                }
                
              } 
          
              $get_policy = $CI->general_mod->getById(1);  
              
              if($get_policy->change_password_policy > 1){ 
                $current_date     = date("Y-m-d");
                $lastUpdatePass   = date("Y-m-d",strtotime($get_user[0]["last_update_password"]));
                $expired_date     = date('Y-m-d', strtotime('+'.$get_policy->change_password_policy.' months', strtotime($lastUpdatePass))); 

                $current_date = new DateTime($current_date);
                $expired_date = new DateTime($expired_date);  
                $total_days = $current_date->diff($expired_date)->format("%r%a");
                $total_days_show = $expired_date->diff($current_date)->format("%r%a"); 

                if(!isset($pass_policy)){
                  if($total_days <= 0){  
                    redirect($this->link_server."/smoe_portal/Password_config/Password_config/user_edit/".$CI->user_cookie[0]."/expired"); 
                  } else if($total_days > 0 && $total_days <= 3){ 
                    echo '<script type="text/javascript">swall_data("'.$CI->user_cookie[0].'","'.$total_days_show.'")</script>';  
                  }   
                } 
              } 
          } 
      ?>

    <!-- USER VALIDATION  -->


  <script>
    function redirect_notification(link,id_notif){ 
        $.ajax({
          url: "<?php echo base_url() ?>notification/update_status_read",
          dataType: "json",
          data: {
            link: link, 
            id_notif: id_notif, 
          },
          success: function(data) {  
            if(data.success == "success"){
              $("#id_"+id_notif).removeClass("unread");
              $("#total_notification").text(data.total_notif);
              window.open(data.link, '_blank');
              location.reload();
            }  
          }
        });
    }

    <?php 
      $data_notification = get_notification();  
      foreach($data_notification as $key => $value){ $id_notif_var_array[] = $value['id_notif']; } 
      $php_array = $id_notif_var_array;
      sort($php_array);
      $js_array = json_encode($php_array);
      echo "sessionStorage.setItem('array_id_notif', JSON.stringify(". $js_array . "));\n";
    ?>
 

    function load_notification(id_user){ 
        $.ajax({
          url: "<?php echo base_url() ?>notification/get_notification",
          dataType: "json",
          data: {
            id_user: id_user,  
          },
          success: function(data) {  
            if(data.success == "success"){ 
              // console.log(data);
               $("#total_notification").text(data.data_notif[0]['total_unread']);   
               
               if(data.data_notif[0]['total_unread'] > 0){
                $("#total_notification").removeClass("d-none");
               }
                
                var array_check = sessionStorage.getItem('array_id_notif');

                //console.log(array_check);

               if(array_check.includes(data.data_notif[0]['id_notif']) == false){

                SaveDataToLocalStorage(data.data_notif[0]['id_notif']);

                if(data.data_notif[0]['status_read'] == 0){
                  var unread = "unread";
                } else {
                  var unread = null;
                }

                var html    = `
                <a id='id_${data.data_notif[0]['id_notif']}' onclick="redirect_notification('${data.data_notif[0]['link']}','${data.data_notif[0]['id_notif']}')" class="dropdown-item list-group-item list-group-item-action flex-column align-items-start notif ${unread}" href="#" title='${data.data_notif[0]['notification_desc']}'>
                            <div class="d-flex w-100 justify-content-between">
                            <small><b>${data.data_notif[0]['main_title']}
                                Today </b>
                              </small>
                            </div>
                            <div class='notif'>
                            <small>${data.data_notif[0]['mini_title']}</small>
                            <p class="mb-1"><small>${data.data_notif[0]['notification_desc'].substring(0, 40)}...</small></p>
                            </div>
                      </a>
                `;

                $("#notif_container").prepend(html); 
  
                $.toastDefaults.position = 'bottom-right';
                $.toastDefaults.dismissible = true;
                $.toastDefaults.stackable = true;
                $.toastDefaults.pauseDelayOnHover = true;
                $.toast({
                    type: "info",
                    title: data.data_notif[0]['main_title'],
                    subtitle: data.data_notif[0]['mini_title'],
                    content: data.data_notif[0]['notification_desc'], 
                    delay: 10000 
                });


              }

            }  
          }
        });
    }

    function SaveDataToLocalStorage(data)
    {
        var a = []; 
        a = JSON.parse(sessionStorage.getItem('array_id_notif')) || []; 
        a.push(data);  
        var id_remove = a[0];
        const remove_data = document.getElementById('id_'+id_remove);
        remove_data.style.display = 'none';
        const final_array = a.slice(1); 
        sessionStorage.setItem('array_id_notif', JSON.stringify(final_array));
    }
  </script>

  <!-- Google tag (gtag.js) -->
  <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-VVM5SM257Z"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-VVM5SM257Z');
  </script> -->

  </body>
</html>