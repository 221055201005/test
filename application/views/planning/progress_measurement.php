<div id="content" class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">                                    
            Filter                       
          </h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="GET">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                  <div class="col-md">

                    <select class="form-control project" name="project" required>
                      <option value="">---</option>
                      <?php foreach ($project_list as $key => $value) : ?>
												<?php if (in_array($value['id'], $this->user_cookie[13])) : ?>
                      		<option value="<?php echo $value['id'] ?>" <?php echo (@$filter['project'] == $value['id'] ? 'selected' : ($this->user_cookie[10]==$value['id'] ? 'selected' : '') ) ?>><?php echo $value['project_name'] ?></option>
                      	<?php endif; ?>
                      <?php endforeach; ?>
                    </select> 

                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
                  <div class="col-md">

                      <select class="form-control type_of_module" name="type_of_module" required>
                          <option value="">---</option>
                          <?php foreach ($type_of_module_list as $key => $value) : ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo (@$filter['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                          <?php endforeach; ?>
                      </select>

                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-md">

                      <select class="form-control discipline" name="discipline" required>
                          <option value="">---</option>
                          <?php foreach ($discipline_list as $key => $value) : ?>
                          <option value="<?php echo $value['id'] ?>" <?php echo (@$filter['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                          <?php endforeach; ?>
                      </select>

                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Phase</label>
                  <div class="col-md">

                      <select class="form-control phase" name="phase" required>
                          <option value="">---</option>

                          <option value="FB" <?= @$filter['phase']=='FB' ? 'selected' : '' ?>>FB</option>
                          <option value="AS" <?= @$filter['phase']=='AS' ? 'selected' : '' ?>>AS</option>
                          <option value="ER" <?= @$filter['phase']=='ER' ? 'selected' : '' ?>>ER</option>

                      </select>

                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Elevation</label>
                  <div class="col-md">

                      <select class="form-control deck_elevation" name="deck_elevation" >
                        <option value="">---</option>
                        <?php foreach ($deck_elevation_list as $key => $value) : ?>
                          <option value="<?php echo $value['id'] ?>" <?php echo (@$filter['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>

                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">

                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing Assembly</label>
                  <div class="col-md">

                    <select class='select2_desc_assy text-center drawing_as' name='drawing_as'></select>
                    <script>
                      $(document).ready(function() {

                        $(".select2_desc_assy").select2({
                          tags: true,
                          tokenSeparators: [',', ' '],
                          ajax: {
                                url: "<?php echo base_url();?>home/get_drawing_as_ajax",
                                type: "post",
                                dataType       : 'json',
                                data: function (params) {
                                  var query = {
                                    search: params.term
                                  }
                                  return query;
                                },
                                processResults: function (data) {
                                  return {
                                    results: data
                                  }
                                }
                              }
                        })

                        <?php if(@$filter['drawing_as']){ ?>
                          var isi = <?= "'".@$filter['drawing_as']."'" ?>;

                          $(".select2_desc_assy").select2('data', {id:isi, text:isi})
                        <?php } else { ?>

                        <?php } ?>
                        })
                    </script>
                  </div>

                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold"> </label>
                  <div class="col-md">

                    

                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">                                          
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 text-right">

                <button class="mt-2 btn btn-sm btn-flat btn-success" name="submit" value="search">
                  <i class="fas fa-search"></i> Search
                </button>

              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">
            <?php
              $level = 5;
              if(@$filter['deck_elevation']){
                $level = 6;
              }
              if(@$filter['drawing_as']){
                $level = 7;
              }
            ?>
            Progress Measurement <b>Level <?php echo $level ?></b>                         
          </h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <table width="100%"  class="table table-hover table-bordered dataTable"  style="text-align: center">
            <thead>
              <tr class="text-white bg-info">
                <th rowspan="2">Type of Module</th>
                <th rowspan="2">Discipline</th>
                <th rowspan="2">Phase</th>
                
                <th rowspan="2">Elevation</th>
                <?php if(@$filter['deck_elevation']): ?>
                <th rowspan="2">Drawing Assembly</th>
                <?php endif; ?>
                <?php if(@$filter['drawing_as']): ?>
                <th rowspan="2">Piecemark</th>
                <?php endif; ?>

                <th rowspan="1" colspan="5"><b>Progress Measurement</b></th>

              </tr>
              <tr class="text-white bg-info">
                <th rowspan="1" colspan="1"><b>Mark / Cutting</b></th>
                <th rowspan="1" colspan="1"><b>Fit-up</b></th>
                <th rowspan="1" colspan="1"><b>Weld Out</b></th>
                <th rowspan="1" colspan="1"><b>NDE Acceptance</b></th>
                <th rowspan="1" colspan="1"><b>Progress Sum</b></th>
              </tr>
            </thead>
            <tbody>
            <tr>
                <td>Top Side</td>
                <td>Structural</td>
                <td>FB</td>

                <td>Deck 1</td>
                <?php if(@$filter['deck_elevation']): ?>
                <td>2013J310008-31-DR-0101-0003-AS-D1-PG-0080</td>
                <?php endif; ?>
                <?php if(@$filter['drawing_as']): ?>
                <td>SP-D1-P-PLT-0273-01</td>
                <?php endif; ?>

                <td>0%</td>
                <td>0%</td>
                <td>0%</td>
                <td>0%</td>
                <td>0%</td>
              </tr>
              <tr>
                <td>Top Side</td>
                <td>Structural</td>
                <td>FB</td>

                <td>Deck 1</td>
                <?php if(@$filter['deck_elevation']): ?>
                <td>2013J310008-31-DR-0101-0003-AS-D1-PG-0080</td>
                <?php endif; ?>
                <?php if(@$filter['drawing_as']): ?>
                <td>SP-D1-P-PLT-0273-01</td>
                <?php endif; ?>

                <td>0%</td>
                <td>0%</td>
                <td>0%</td>
                <td>0%</td>
                <td>0%</td>
              </tr>
              <tr>
                <td>Top Side</td>
                <td>Structural</td>
                <td>FB</td>

                <td>Deck 1</td>
                <?php if(@$filter['deck_elevation']): ?>
                <td>2013J310008-31-DR-0101-0003-AS-D1-PG-0080</td>
                <?php endif; ?>
                <?php if(@$filter['drawing_as']): ?>
                <td>SP-D1-P-PLT-0273-01</td>
                <?php endif; ?>

                <td>0%</td>
                <td>0%</td>
                <td>0%</td>
                <td>0%</td>
                <td>0%</td>
              </tr>
              <!-- <?php foreach ($type_of_module_list as $key => $value): ?>
                <?php foreach ($discipline_list as $key2 => $value2): ?>
                  <?php foreach ($phase_list as $key3 => $value3): ?>
                    <?php foreach ($deck_elevation_list as $key4 => $value4): ?>
                    <tr>
                      <td><?php echo $value["name"] ?></td>
                      <td><?php echo $value2["discipline_name"] ?></td>
                      <td><?php echo $value3 ?></td>

                      <td><?php echo $value4["name"] ?></td>

                      <td>0%</td>
                      <td>0%</td>
                      <td>0%</td>
                      <td>0%</td>
                      <td>0%</td>
                    </tr>
                    <?php endforeach; ?>
                  <?php endforeach; ?>
                <?php endforeach; ?>
              <?php endforeach; ?> -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
</div>
</div>