<form action="<?php echo base_url(); ?>wtr/submit_irn_fabrication" enctype="multipart/form-data" method='POST' id="form_submition"> 

<script type="text/javascript">
  var arrIdTemplateJoint = [];
</script>
<div id="content" class="container-fluid">
  <div class="row">
    
    
            <div class="col-md-12">

               <div class="my-3 p-3 bg-white rounded shadow-sm">
                <h6 class="pb-2 mb-0">Submit to IRN</h6>
                 <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          
                    <div class="container-fluid">

                            <div class="row">
                              <div class="col-md">
                                <div class="form-group row">
                                  <label class="col-xl-3 col-form-label">Project List :</label>
                                  <div class="col-xl">
                                     <select class="form-control project2" name="project_joint" id="project2" required="" onchange="populateModuleChained();">
                                      <option value="">---</option>
                                        <?php foreach($project_chain as $project){ ?>                                          
                                            <option value="<?= $project['id'] ?>" <?php echo ($this->user_cookie == $project['id'] ? 'selected' : ($this->user_cookie[10] == $project['id'] ? 'selected' : '')) ?>><?= $project['project_name'] ?></option>
                                        <?php } ?>
                                      </select> 
                                  </div>
                                </div>
                              </div>
                            </div> 

                            <div class="row">
                              <div class="col-md">
                                <div class="form-group row">
                                  <label class="col-xl-3 col-form-label">Module / Jacket List :</label>
                                  <div class="col-xl">
                                     <select class="form-control select2class module2" name="module_joint" id="module" required onchange="openDrawingByjoint();">
                                      <option value="">---</option>                                        
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md">
                                <div class="form-group row">
                                  <label class="col-xl-3 col-form-label">Discipline List :</label>
                                  <div class="col-xl">
                                    <select class="custom-select select2class" name="discipline_joint" required="" id="disciplinex" onchange="openDrawingByjoint();">
                                      <?php foreach ($discipline_list as $key => $value) : ?>
                                      <option value="<?php echo $value['id'] ?>" ><?php echo $value['discipline_name'] ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md">
                                <div class="form-group row">
                                  <label class="col-xl-3 col-form-label">Drawing Number :</label>
                                  <div class="col-xl">
                                    <input type='text' name="drawing_joint" class="form-control" onkeydown="autodrawingByjoint(this);" placeholder="Type Drawing" id="drawing" disabled="">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md">
                                <div class="form-group row">
                                  <label class="col-xl-3 col-form-label">Joint Number :</label>
                                  <div class="col-xl">
                                    <input type='text' name="joint_number" class="form-control" onkeydown="auto_joint_number(this);" placeholder="Type Joint Number" id="joint_no" disabled=""> 
                                  </div>
                                </div>
                              </div>
                            </div>
                          
                            <div class="row">                   
                              <div class="col-md">
                                <div class="form-group row">
                                  <div class="col-xl text-left">
                                    <button type='button' class="btn btn-primary" title="Submit" id="addRowBtn">
                                      <i class="fas fa-plus"></i>
                                       Add
                                    </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                  </div>
              </div>
            </div>
          </div> 

          <div class="col-md-12">     

               

              <div class="my-3 p-3 bg-white rounded shadow-sm">
                <h6 class="pb-2 mb-0">Submit IRN - Fabcrication</h6>
                  <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">          
                    <div class="container-fluid">
                      <table class="table" width="100%" id='tableListJoint'>
                        <thead>
                            <tr>
                              <th>Drawing Number</th>
                              <th>Discipline</th>
                              <th>Module</th>
                              <th>Joint Number</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>                          
                        </tbody>
                      </table>                            
                    </div>
                  </div>
              </div>
           </div>

          <div class="col-md-12">

              <div class="my-3 p-3 bg-white rounded shadow-sm">
                <h6 class="pb-2 mb-0">Submit IRN - Dimentional Control</h6>
                  <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">          
                    <div class="container-fluid">
                      <table class="table" width="100%" id='table_dc'>
                        <thead>
                            <tr>
                              <th><center>Description</center></th>
                              <th><center>File</center></th>
                              <th><button type="button" class="btn btn-primary" title="Delete Row"  onclick="addrow_dc()"><i class="fas fa-plus-circle"></i></button></th>
                            </tr>
                        </thead>
                        <tbody>                          
                        </tbody>
                      </table>                            
                    </div>
                  </div>
              </div>

          </div> 

          <div class="col-md-12">

              <div class="my-3 p-3 bg-white rounded shadow-sm">
                <h6 class="pb-2 mb-0">Submit IRN - Punchlist</h6>
                  <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">          
                    <div class="container-fluid">
                      <table class="table" width="100%" id='table_pnc'>
                        <thead>
                            <tr>
                              <th><center>Description</center></th>
                              <th><center>File</center></th>
                              <th><button type="button" class="btn btn-primary" title="Delete Row"  onclick="addrow_pnc()"><i class="fas fa-plus-circle"></i></button></th>
                            </tr>
                        </thead>
                        <tbody>                          
                        </tbody>
                      </table> 

                      <button type="submit" class="btn btn-danger" title="Submit" >
                      <i class="fas fa-list"></i>
                      Submit
                    </button>

                    </div>
                  </div>
              </div>
            </div>

        

        </div>
  </div>  
</div>
</div><!-- ini div dari sidebar yang class wrapper -->

<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.chained.min.js"></script>
<script charset=utf-8>
  $(function(){
    $("#modulex").chained("#projectx");  
  });  
</script>

<script type="text/javascript">

    jQuery(document).ready(function(){
      addrow_dc();
      addrow_pnc();
      populateModuleChained();

    });

  function openDrawingByjoint(){

    var module_value     = $("select[name='module_joint']").find('option:selected').val();  
    var discipline_value = $("select[name='discipline_joint']").find('option:selected').val();

    if(module_value !== "" && discipline_value !== ""){
      $("input[name='drawing_joint']").prop("disabled", false);
      $("input[name='joint_number']").prop("disabled", false);
    } else {
      $("input[name='drawing_joint']").prop("disabled", true);
      $("input[name='joint_number']").prop("disabled", true);
    }

  }

  function autodrawingByjoint(input){
        var module_value     = $("select[name='module_joint']").find('option:selected').val();  
        var discipline_value = $("select[name='discipline_joint']").find('option:selected').val();

        $(input).autocomplete({
          source: function(request,response){
            $.post('<?php echo base_url(); ?>wtr/display_drawing',{term: request.term ,module_value:module_value, discipline_value:discipline_value }, response, 'json');
          },
          autoFocus: true,
          classes: {
            "ui-autocomplete": "highlight"
          },
          select: function(event, ui){
            var badge = ui.item.value.split(" - ");
          }
        });
    }
</script>

  <script type="text/javascript">
  function populateModuleChained(){

           var project     = $("select[name='project_joint']").find('option:selected').val(); 

            $.ajax({
            url: "<?php echo base_url();?>wtr/populate_module_chained",
            type: "post",
            data: {
              project_id: project
            },
            success: function(data) {

              if(data.includes("Error")){
                $('#module').find('option').remove().end();
                Swal.fire(
                  'Warning',
                  'Sorry, Module / Jacket ID not Found for selected Project Name',
                  'warning'
                );

              } else {
                 $('#module').find('option').remove().end();
                  $.each(JSON.parse(data), function(i, obj){
                       $('#module').append($('<option>').text(obj.text).attr('value', obj.val));
                       openDrawingByjoint();
                  });

              }

            }

          });       

}


    function auto_joint_number(input){     

        var drawing_no       = $("input[name='drawing_joint']").val();  
        var module_value     = $("select[name='module_joint']").find('option:selected').val();  
        var discipline_value = $("select[name='discipline_joint']").find('option:selected').val();
        var joint_no         = $("input[name='joint_number']").val(); 

        $(input).autocomplete({
          source: function(request,response){
            $.post('<?php echo base_url(); ?>wtr/display_joint_number',{term: request.term, drawing_no:drawing_no, module:module_value, discipline:discipline_value}, response, 'json');
          },
          autoFocus: true,
          classes: {
            "ui-autocomplete": "highlight"
          },
          select: function(event, ui){
            var badge = ui.item.value.split(" - ");
          }
        });
    }

$(function(){
   
    var tbl = $("#tableListJoint");

    var no = 0;
    
    $("#addRowBtn").click(function(){

       var project_joint         = $("select[name='project_joint']").find('option:selected').val();  
       var drawing_joint_val     = $("input[name='drawing_joint']").val();  
       var module_joint_val      = $("select[name='module_joint']").find('option:selected').val();  
       var discipline_joint_val  = $("select[name='discipline_joint']").find('option:selected').val();
       var joint_number_val      = $("input[name='joint_number']").val(); 
       var module_joint_text     = $("select[name='module_joint']").find('option:selected').text();  
       var discipline_joint_text = $("select[name='discipline_joint']").find('option:selected').text();

         if(drawing_joint_val === ""){
             alert("Please Type Drawing Number..");
             return false;
          } else if(module_joint_val === ""){
             alert("Please Choice Module / Jacket ID..");
             return false;
          } else if(discipline_joint_val === ""){
             alert("Please Choice Discipline..");
             return false;
          } else if(joint_number_val === ""){
             alert("Please type joint number..");
             return false;   
          } else {


            $.ajax({
            url: "<?php echo base_url();?>irn/validated_joint_number",
            type: "post",
            data: {
              drawing_no: drawing_joint_val,
              discipline: discipline_joint_val,
              module: module_joint_val,
              joint_no: joint_number_val,
            },
            success: function(data) {

               no++;
               var message = "Joint Not Found..!";
                for( var i = 0; i < no; i++){
                    if(i != no){

                      if($("input[name='id_joint["+i+"]']").val() == data){
                        data = 'Error';
                        var message = 'Duplicate Joint No on the list!';
                      }
                    }
                }

              if(data.includes("Error")){

                Swal.fire(
                  'Warning',
                  'Sorry, '+message,
                  'warning'
                );

              } else {

                $("input[name='joint_number']").val("");  

                $("<tr><td>"+drawing_joint_val+" <input type='hidden' name='id_joint["+no+"]' value='"+ data +"'><input type='hidden' name='project' value='"+ project_joint +"'><input type='hidden' name='discipline' value='"+ discipline_joint_val +"'><input type='hidden' name='type_of_search' value='PDF'></td><td>"+discipline_joint_text+"</td><td>"+module_joint_text+"</td><td>"+joint_number_val+"</td><td><button class='delRowBtn btn btn-danger'>Delete</button></td></tr>").appendTo(tbl);     
              }

            }

          });

            
          }   
    });
        
    $(document.body).delegate(".delRowBtn", "click", function(){
        $(this).closest("tr").remove();        
    });    
    
});


  var count_data_dc = 0;
  function addrow_dc() {
  var html = `
    <tr id="remove_dc${count_data_dc}">
      <td class="align-middle">
        <input type="text" class="form-control" name="dc_desc[${count_data_dc}]" id="dc_desc[${count_data_dc}]" placeholder='DC Description' required>
      </td>

      <td class="align-middle">
        <center>      
          <input type="file" name="dc_attachment[${count_data_dc}]">
        </center>  
      </td>

      <td class="align-middle"><button type="button" class="btn btn-danger" title="Delete Row" onclick="deleterow_dc(this,${count_data_dc});"><i class="fa fa-trash"></i></button></td>
   </tr>`;
    
    $("#table_dc").append(html);
    count_data_dc++;
  }

  function deleterow_dc(input, index) {
    console.log(index);
    $(input).closest('tr').remove();
    $('table#table_dc tr#remove_dc'+index).remove();
  }

  var count_data_pnc = 0;
  function addrow_pnc() {
    var html = `
      <tr id="remove_pnc${count_data_pnc}">
        <td class="align-middle">
          <input type="text" class="form-control" name="pnc_desc[${count_data_pnc}]" id="pnc_desc[${count_data_pnc}]" placeholder='Punchlist Description' required>
        </td>

        <td class="align-middle">
          <center>      
            <input type="file" name="pnc_attachment[${count_data_pnc}]">
          </center>  
        </td>

        <td class="align-middle"><button type="button" class="btn btn-danger" title="Delete Row" onclick="deleterow_pnc(this,${count_data_pnc});"><i class="fa fa-trash"></i></button></td>
     </tr>`;
    
     $("#table_pnc").append(html);
     count_data_pnc++;
  }

  function deleterow_pnc(input, index) {
    $(input).closest('tr').remove();
    $('table#table_pnc tr#remove_pnc'+index).remove();
  }

  </script>


</form>





