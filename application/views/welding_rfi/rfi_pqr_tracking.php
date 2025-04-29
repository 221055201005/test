<div id="content" class="container-fluid">
 
  <div class="row">
    <div class="col-md-6">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Searching PQR WPQT</h6>
          <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                     <div class="form-inline">
                        <div class="form-group mb-2">
                            <label for="staticEmail2" class="sr-only">PQR</label>
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Example : PQR 112">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only">Type PQR Number</label>
                            <input type="text" class="form-control" id="search_pqr" placeholder="Type PQR Number" name='search_pqr'>
                        </div>
                        <button type="button" id="btn_search_pqr" class="btn btn-primary mb-2" onclick='check_pqr()'>Search</button>
                        </div>
                     
                    </div>
                </div>

               
          </div>
        </div>
      </div>
    </div>   
  </div> 
</div>

</div><!-- ini div dari sidebar yang class wrapper -->

<script type="text/javascript">
   
   $("#search_pqr").keypress(function (e) {
        if (e.which == 13) {
            check_pqr();
            return false;   
        }
    });

   function check_pqr() {
      
    var text = $("#search_pqr").val();

     $.ajax({
      url: "<?php echo base_url();?>welding_rfi/check_pqr/",
      type: "post",
      data: {
        'pos': text,
      },
      success: function(data) { 
     
        if(data.includes("Error")){

          $('.pqr_data').remove();
          $("#btn_search_pqr").addClass('is-invalid');
          $('.invalid-feedback').remove( ":contains('Error')" );
          $("#btn_search_pqr").after('<div class="invalid-feedback">'+data+'</div>');

        } else {

          $('.pqr_data').remove();
          $('.invalid-feedback').remove( ":contains('Error')" );
          $("#btn_search_pqr").removeClass('is-invalid');
          $("#btn_search_pqr").addClass('is-valid');
          $("#btn_search_pqr").after('<div class="is-valid">'+data+'</div>');   
                 
        }

      }
    });
  }
</script>