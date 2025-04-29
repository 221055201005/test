<style>
    [data-tooltip] {
      position: relative;
      z-index: 2;
      cursor: pointer;
    }

    /* Hide the tooltip content by default */
    [data-tooltip]:before,
    [data-tooltip]:after {
      visibility: hidden;
      -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
      filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=0);
      opacity: 0;
      pointer-events: none;
    }

    /* Position tooltip above the element */
    [data-tooltip]:before {
      position: absolute;
      bottom: 150%;
      left: 50%;
      margin-bottom: 5px;
      margin-left: -80px;
      padding: 7px;
      width: 160px;
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
      background-color: #000;
      background-color: hsla(0, 0%, 20%, 0.9);
      color: #fff;
      content: attr(data-tooltip);
      text-align: center;
      font-size: 14px;
      line-height: 1.2;
    }

    /* Triangle hack to make tooltip look like a speech bubble */
    [data-tooltip]:after {
      position: absolute;
      bottom: 150%;
      left: 50%;
      margin-left: -5px;
      width: 0;
      border-top: 5px solid #000;
      border-top: 5px solid hsla(0, 0%, 20%, 0.9);
      border-right: 5px solid transparent;
      border-left: 5px solid transparent;
      content: " ";
      font-size: 0;
      line-height: 0;
    }

    /* Show tooltip content on hover */
    [data-tooltip]:hover:before,
    [data-tooltip]:hover:after {
      visibility: visible;
      -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
      filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=100);
      opacity: 1;
    }
</style>
<div id="content" class="container-fluid">
  <div class="row">
    <div class="col-md-12">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Filter Data For Inspection</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="POST">
            <div class="row">
               <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Project ID</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" required>
                      <?php if($this->permission_cookie[0] == 1){ ?>     
                        <option value="">---</option>                     
                        <?php foreach ($project_list as $key => $value) : ?>
                        <option onclick="save_project()" value="<?php echo $value['id'] ?>" <?php echo (@$user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                        <?php endforeach; ?>
                      <?php } else { ?>
                        <?php foreach ($project_list as $key => $value) : ?>
                          <?php if(in_array($value['id'], $this->user_cookie[13])){ ?>
                            <option onclick="save_project()" value="<?php echo $value['id'] ?>" <?php echo (@$user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                          <?php } ?>
                        <?php endforeach; ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label for="" class="col-md-4 col-lg-3 col-form-label"> Yard</label>
                  <div class="col-xl">
                    <select class="custom-select" name="company_yard">
                      <?php foreach ($company_list as $key => $value) : ?>
                        <?php if(in_array($value['id_company'], $this->user_cookie[14])){ ?>
                          <option value="<?php echo $value['id_company'] ?>" <?= $company==$value['id_company'] ? 'selected' : '' ?>><?php echo $value['company_name'] ?></option>
                        <?php } ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label for="" class="col-md-4 col-lg-3 col-form-label"> Company</label>
                  <div class="col-xl">
                    <select class="custom-select select2" name="company_id">
                      <option value="0">---</option>
                      <?php foreach ($company_list as $key => $value) : ?>
                        <?php //if(in_array($value['id_company'], $this->user_cookie[14])){ ?>
                          <option value="<?php echo $value['id_company'] ?>"><?php echo $value['company_name'] ?></option>
                        <?php //} ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline">
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$post['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="module">
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                      <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$post['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Type Of Module</label>
                  <div class="col-xl">
                   <select class="form-control" name="type_of_module">
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$post['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>  
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label" required> Deck Elevation / Service Line</label>
                    <div class="col-xl">
                    <select class="form-control" name="deck_elevation" >
                      <option value="">---</option>
                      <?php foreach ($deck_elevation as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Category IRN</label>
                  <div class="col-xl">
                    <select class="form-control" name="category_irn">
                        <option value="1">IRN Material</option>  
                        <option value="2">IRN Dashboard - Material</option>   
                        <!-- <option value="0">IRN Joint Number</option>     -->
                        <option value="3">IRN Dashboard - Joint</option>    
                    </select>
                  </div>
                </div>
              </div>
            </div> 

            <!-- <div class="row">
              <div class="col-6">
                <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted" required> IRN Report Number </label>
                    <div class="col-xl">
                    <input class="form-control autocomplete_irn_approved" id="irn_report_no" name='irn_report_no' type="IRN Report Number" placeholder="IRN Report Number" aria-label="IRN Report Number" value="<?php echo @$get['irn_report_no'] ?>" >
                    </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label "></label>
                  <div class="col-xl">
                   
                  </div>
                </div>
              </div>
            </div>  -->


            <div class="row">
              <div class="col-12 text-right"> 
                <button type="submit" name='submit' value='export_excel' class="btn btn-success" title="Update"><i class="fas fa-download"></i> Download</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
       
  </div>
  </div>
</div>
</div>
<script type="text/javascript"> 
 
  $('.dataTable').DataTable({
    order: [0,"asc"], 
  })   


  $(".autocomplete_irn_approved").autocomplete({
    source: function( request, response ) {  
      $.ajax( {
        url: "<?php echo base_url() ?>irn/autocomplete_irn_approved/<?= "joint" ?>",
        dataType: "json",
        data: {
          term: request.term, 
        },
        success: function( data ) { 
          response( data );
        }
      });
    },
    select: function (event, ui) {
      var value = ui.item.value;
      if(value == 'No Data.'){
        ui.item.value = "";
      }
      else{
        change_status_irn(ui.item.value);
      }
    }
  });


  function change_status_irn(category_irn) {
    $("select[name=category_irn]").val(0)
  }


</script>

<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.chained.min.js"></script>
<script>
    $("select[name=module]").chained("select[name=project]");
</script>
