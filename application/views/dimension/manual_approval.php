

  <link rel="stylesheet" href="<?php echo base_url('assets/digital_signature/libs/modernizr.js') ?>" type="text/css">
  <style type="text/css">
  
  input {
    padding: .5em;
    margin: .5em;
  }
  select {
    padding: .5em;
    margin: .5em;
  }
  
  #signatureparent {
    color:darkblue;
    background-color:darkgrey;
    /*max-width:600px;*/
    padding:20px;
  }
  
  /*This is the div within which the signature canvas is fitted*/
  #signature {
    border: 2px dotted black;
    background-color:lightgrey;
  }

  /* Drawing the 'gripper' for touch-enabled devices */ 
  html.touch #content {
    float:left;
    width:92%;
  }
  html.touch #scrollgrabber {
    float:right;
    width:4%;
    margin-right:2%;
    background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAFCAAAAACh79lDAAAAAXNSR0IArs4c6QAAABJJREFUCB1jmMmQxjCT4T/DfwAPLgOXlrt3IwAAAABJRU5ErkJggg==)
  }
  html.borderradius #scrollgrabber {
    border-radius: 1em;
  }
   
</style>
  
    <div id="content"  class="container" style="background-color: whitesmoke">
      <div class="row">
        <div class="container-fluid">
   
           <div class="my-3 p-3 bg-white rounded shadow-sm">
                  <a href="javascript:history.back();">
                     <i class="fas fa-arrow-left"></i> Back
                  </a>
            <center>
              <div id="content">

                Please Sign This Document as Your Approval, <?php echo $read_cookies[1]; ?> :
                <br>
                <br>
                <form action="verification/manual_sign" method="post">

            <div id="signature" style="width: 700px"></div>
            <input type="hidden" name="hdnSignature" id="hdnSignature" />
            <input type="hidden" name="module" value='<?php echo $module ?>' />
            <input type="hidden" name="user_id" value='<?php echo $user_id ?>' />
            <input type="hidden" name="report_no" value='<?php echo $report_no ?>' />
            <input type="hidden" name="id_dc" value='<?php echo $id_dc ?>' />
            <input type="hidden" name="save" value='save' />
            
            <input type="button" class='btn btn-warning' id="btn_reset" value="Reset" />
            <?php if($read_permission[49] == 1){ ?>
            <input type="button" class='btn btn-primary' id="btn_submit" value="Finish & Save" />
            <?php } ?>

          </form>

         </div>
      </center>
           </div>
    </div>
    </div>
    </div>

        
      <script type="text/javascript">
        jQuery.noConflict()
      </script>
      <script src="<?php echo base_url('assets/digital_signature/libs/jSignature.min.noconflict.js') ?>"></script>
      <script>
        (function($){
  
          $(document).ready(function(){
    
            'use strict';
            var $sigdiv = $("#signature");
            $sigdiv.jSignature({'UndoButton':false, 'width': 700, 'height': 250});// inits the jSignature widget.
 
            $('#btn_reset').click(function () {

                $sigdiv.jSignature("reset")

            }); 
            //save data to hidden field before submiting the form
            $('#btn_submit').click(function () {
      
                var datapair = $sigdiv.jSignature("getData", "image");
              $('#hdnSignature').val(datapair[1]);
              //now submit form 
              document.forms[0].submit();
    
            });
    
          });
  
        })(jQuery)
      </script>

</div>