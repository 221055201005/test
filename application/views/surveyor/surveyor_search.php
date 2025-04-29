<div id="content" class="container-fluid">

  <form action="<?= site_url('planning/search_workpack') ?>" method="post">

    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0"><?php echo $meta_title ?></h6>
          </div>
          <div class="card-body bg-white overflow-auto">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Workpack No.</label>
									<div class="col-md-8 col-lg-9">
										<input type="text" class="form-control autocomplete_wp" name='workpack_no' placeholder="Search By Workpack Number" value='<?php echo @$post['workpack_no']; ?>'>
									</div>
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Workpack Sub Activity No.</label>
									<div class="col-md-8 col-lg-9">
										<input type="text" class="form-control autocomplete_wp_sub" name='workpack_sub_no' placeholder="Search By Workpack Sub Activity Number" value='<?php echo @$post['workpack_sub_no']; ?>'>
									</div>
                </div>
              </div>  
              <div class="col-md-12 text-right">
								<br>
								<button type="submit" class="btn btn-primary" type="button"><i class="fas fa-search"></i> Search</button>
              </div>             
            </div>            
          </div>
        </div>
      </div>
    </div>

  </form>

  <?php if($workpack_list){ ?>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th>Workpack No.</th>
                    <th>Phase</th>
                    <th>Description</th>
                    <th>Module</th>
                    <th>Type of Module</th>
                    <th>Discipline</th>
                    <th>Deck Elevation / Service Line</th>
                    <th>Assy Code</th>
                    <?php if($workpack_list[0]["phase"] != "BAA"){ ?>                    
                    <th>Location</th> 
                    <th>Work Detail</th>
                    <?php } ?>
                    <th>Plan Start Date</th>
                    <th>Plan Finish Date</th>
                    <th>Progress</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($workpack_list as $key => $value):  ?>
                    <tr>
                      <td><?php echo $value['workpack_no'] ?></td>
                      <td><?php echo $value['phase'] ?></td>
                      <td><?php if(!empty($value['description'])){ echo $value['description']; } else { echo "-"; } ?></td>
                      <td><?php echo @$module_list[$value['module']]['mod_desc'] ?></td>
                      <td><?php echo @$type_of_module_list[$value['type_of_module']]['name'] ?></td>
                      <td><?php echo @$discipline_list[$value['discipline']]['discipline_name'] ?></td>
                      <td><?php echo @$deck_elevation_list[$value['deck_elevation']]['name'] ?></td>
                      <td><?php echo @$desc_assy_list[$value['desc_assy']]['name'] ?></td>      
                      <?php if($workpack_list[0]["phase"] != "BAA"){ ?>                 
                      <td><?php echo @$location_list[$value['location']]['location_name'] ?></td> 
                      <td><?php if(!empty($value['work_detail'])){ echo $value['work_detail']; } else { echo "-"; } ?></td>
                      <?php } ?>
                      <td><?php echo $value['plan_start_date'] ?></td>
                      <td><?php echo $value['plan_finish_date'] ?></td>                    
                      <td>

                        <?php if($value["type"] == "2"){ ?>

                          <a  href="<?php echo base_url() ?>planning/surveyor_detail_blasting/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>" class="btn btn-sm btn-block m-0 text-left text-nowrap btn-flat btn-primary"><i class="fas fa-tasks"></i> Progress</a>


                        <?php } else { ?>  

                          <?php if($value['id_workpack'] != ''){ ?>
														<a href="<?php echo base_url() ?>planning/surveyor_detail_subactivity/<?= encrypt($value['id_workpack']) ?>/<?= encrypt($value['activity']) ?>" class="btn btn-sm btn-block m-0 text-left text-nowrap btn-flat btn-primary"><i class="fas fa-tasks"></i> Progress</a>
                          <?php } else if($value['phase'] == "PF"){ ?>
                            <a href="<?php echo base_url() ?>planning/surveyor_detail_pc/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>" class="btn btn-sm btn-block m-0 text-left text-nowrap btn-flat btn-primary"><i class="fas fa-tasks"></i> Progress</a>
                          <?php } else if($value['phase'] == "ITR"){ ?>
                            <a href="<?php echo base_url() ?>planning/surveyor_detail_itr/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>" class="btn btn-sm btn-block m-0 text-left text-nowrap btn-flat btn-primary"><i class="fas fa-tasks"></i> Progress</a>
                            <?php } else if($value['phase'] == "BAA"){ ?>
                            <a href="<?php echo base_url() ?>planning/surveyor_detail_baa/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>" class="btn btn-sm btn-block m-0 text-left text-nowrap btn-flat btn-primary"><i class="fas fa-tasks"></i> Progress</a>  
                          <?php } else { ?>  
                            <a href="<?php echo base_url() ?>planning/surveyor_detail_jn/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>" class="btn btn-sm btn-block m-0 text-left text-nowrap btn-flat btn-primary"><i class="fas fa-tasks"></i> Progress</a>
                          <?php } ?> 

                        <?php } ?>  

                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>

</div>
</div>

<script>
  $(".autocomplete_wp").autocomplete({
    source: function( request, response ) {
    $.ajax( {
        url: "<?php echo base_url() ?>planning/autocomplete_wp",
        dataType: "json",
        data: {
          term: request.term
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
    }
  });

	$(".autocomplete_wp_sub").autocomplete({
    source: function( request, response ) {
    $.ajax( {
        url: "<?php echo base_url() ?>planning/autocomplete_wp_sub",
        dataType: "json",
        data: {
          term: request.term
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
    }
  });
</script>