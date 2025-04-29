<div id="content" class="container-fluid">
		<div class="row">
	        <div class="col-md-12">
                <div class="my-3 p-3 bg-white rounded shadow-sm">
                  <h5>PCMS Version 2.0 </h5>
                    <style>
                      .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
                        color: #fff;
                        background-color: #008060;
                      }
                      .nav-pills .nav-link {
                        border-radius: .25rem;
                        color: grey;
                      }
                    </style>
                    
                        <div class="row">
                            <div class="col">
                              <div class="card shadow my-3 rounded-0">
                                <div class="card-header">
                                  <h6 class="m-0"><?php echo $meta_title ?></h6>
                                </div>
                                <div class="card-body bg-white overflow-auto">
                                  <form action="#" method="GET">
                                    <div class="row">
                                      <div class="col-6">
                                        <div class="form-group row">
                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                                          <div class="col-md">

                                            <select class="form-control" name="project">
                                               <?php if($this->permission_cookie[0] == 1){ ?>
                                                <option value="">---</option>
                                                <?php foreach ($project_list as $key => $value) : ?>
                                                <option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                                                <?php endforeach; ?>
                                              <?php } else { ?>
                                                <?php foreach ($project_list as $key => $value) : ?>
                                                  <?php if($this->user_cookie[10] == $value['id']){ ?>
                                                    <option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                                                  <?php } ?>
                                                <?php endforeach; ?>
                                              <?php } ?>
                                            </select> 

                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-6">
                                        <div class="form-group row">
                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                                          <div class="col-md">

                                                <select class="form-control" name="module">
                                                    <option value="">---</option>
                                                    <?php foreach ($module_list as $key => $value) : ?>
                                                    <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'].' ('.$value['mod_id'].')' ?></option>
                                                    <?php endforeach; ?>
                                                </select>

                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-6">
                                        <div class="form-group row">
                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
                                          <div class="col-md">

                                                <select class="form-control" name="type_of_module">
                                                    <option value="">---</option>
                                                    <?php foreach ($type_of_module_list as $key => $value) : ?>
                                                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                                                    <?php endforeach; ?>
                                                  </select>

                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-6">
                                        <div class="form-group row">
                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                                          <div class="col-md">

                                                <select class="form-control" name="discipline">
                                                    <option value="">---</option>
                                                    <?php foreach ($discipline_list as $key => $value) : ?>
                                                    <option value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                                                    <?php endforeach; ?>
                                                  </select>

                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-6">
                                        <div class="form-group row">
                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Deck Elevation / Service Line</label>
                                          <div class="col-md">

                                            <select class="form-control" name="deck_elevation">
                                              <option value="">---</option>
                                              <?php foreach ($deck_elevation_list as $key => $value) : ?>
                                                <option value="<?php echo $value['id'] ?>" <?php echo (@$get['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                                              <?php endforeach; ?>
                                            </select>

                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-6">
                                        <div class="form-group row">

                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Phase</label>

                                          <div class="col-md">
                                            
                                            <select class="form-control" name="phase">
                                              <option value="">---</option>
                                              <option value="PF" <?php echo (@$get['phase'] == "PF" ? 'selected' : '') ?>>Pre - Fabrication</option>
                                              <option value="FB" <?php echo (@$get['phase'] == "FB" ? 'selected' : '') ?>>Fabrication</option>
                                              <option value="AS" <?php echo (@$get['phase'] == "AS" ? 'selected' : '') ?>>Assembly</option>
                                              <option value="ER" <?php echo (@$get['phase'] == "ER" ? 'selected' : '') ?>>Erection</option>
                                            </select>

                                          </div>

                                        </div>
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-6">
                                        <div class="form-group row">
                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description Assy Code</label>
                                          <div class="col-md">

                                          <select class="form-control select2" name="desc_assy">
                                              <option value="">---</option>
                                              <?php foreach ($desc_assy_list as $key => $value) : ?>
                                                <option value="<?php echo $value['id'] ?>" <?php echo (@$get['desc_assy'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                                              <?php endforeach; ?>
                                            </select>

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
                        </div>
                </div>
                <div>
                <?php if($level==1){ ?>
                  <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="card-title"><center><b>LEVEL 1</b></center></h5>
                            </div>
                        </div>
                        <hr>

                        <div class="row collapse show" id="timeverifySheet">
                            <div class="col">
                            <center><h5>MAX: <b>60 %</b></h5></center>
                              <div class="card border-0 card-ds  shadow-sm">
                                  <div class="card-body" style="background-color:#264653">
                                      <div class="row">
                                          <div class="col-md-6">
                                              <h2 class="text-white card-title waitingTVS"><b><?= array_sum($level_1['2']['fb'])*60/100 ?> %</b></h2>
                                              <span class="text-white">
                                                  <b>FABRICATION -<br>STRUCTURE</b>
                                              </span>
                                          </div>
                                          <div class="col-md">
                                              <div class="float-right">
                                                  <i class="fas fa-cog fa-4x text-white mt-2"></i>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <div class="col">
                            <center><h5>MAX: <b>30 %</b></h5></center>
                              <div class="card border-0 card-ds  shadow-sm">
                                  <div class="card-body" style="background-color:#2a9d8f">
                                      <div class="row">
                                          <div class="col-md-6">
                                              <h2 class="text-white card-title waitingTVS"><b><?= array_sum($level_1['2']['as'])*30/100 ?> %</b></h2>
                                              <span class="text-white">
                                                  <b>ASSEMBLY -<br>STRUCTURE</b>
                                              </span>
                                          </div>
                                          <div class="col-md">
                                              <div class="float-right">
                                                  <i class="fas fa-layer-group fa-4x text-white mt-2"></i>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <div class="col">
                            <center><h5>MAX: <b>10 %</b></h5></center>
                              <div class="card border-0 card-ds  shadow-sm">
                                  <div class="card-body" style="background-color:#e9c46a">
                                      <div class="row">
                                          <div class="col-md-6">
                                              <h2 class="text-white card-title waitingTVS"><b><?= array_sum($level_1['2']['er'])*10/100 ?> %</b></h2>
                                              <span class="text-white">
                                                  <b>ERRECTION -<br>STRUCTURE</b>
                                              </span>
                                          </div>
                                          <div class="col-md">
                                              <div class="float-right">
                                                  <i class="fas fa-crop-alt fa-4x text-white mt-2"></i>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            </div>

                            <div class="col">
                            <center><h5>MAX: <b>40 %</b></h5></center>
                              <div class="card border-0 card-ds  shadow-sm">
                                  <div class="card-body" style="background-color:#f4a261">
                                      <div class="row">
                                          <div class="col-md-6">
                                              <h2 class="text-white card-title waitingTVS"><b><?= array_sum($level_1['1']['fb'])*40/100 ?> %</b></h2>
                                              <span class="text-white">
                                                  <b>FABRICATION -<br>PIPE</b>
                                              </span>
                                          </div>
                                          <div class="col-md">
                                              <div class="float-right">
                                                  <i class="fas fa-cog fa-4x text-white mt-2"></i>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <div class="col">
                            <center><h5>MAX: <b>30 %</b></h5></center>
                              <div class="card border-0 card-ds  shadow-sm">
                                  <div class="card-body" style="background-color:#e76f51">
                                      <div class="row">
                                          <div class="col-md-6">
                                              <h2 class="text-white card-title waitingTVS"><b><?= array_sum($level_1['1']['er'])*30/100 ?> %</b></h2>
                                              <span class="text-white">
                                                  <b>ERRECTION -<br>PIPE</b>
                                              </span>
                                          </div>
                                          <div class="col-md">
                                              <div class="float-right">
                                                  <i class="fas fa-crop-alt fa-4x text-white mt-2"></i>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            
                        </div>
                    </div>
                  </div>
                <?php } ?>
                <?php if($level==3){ ?>
                  <div class="card">

                  <ul class="nav nav-tabs nav-justified nav-pills" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="str-tab" data-toggle="tab" href="#str" role="tab" aria-controls="str" aria-selected="true">STRUCTURE</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pip-tab" data-toggle="tab" href="#pip" role="tab" aria-controls="pip" aria-selected="false">PIPING</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="str" role="tabpanel" aria-labelledby="str-tab">
                      <div class="col">
                        <div class="row">
                        
                          <div class="col-md-4 card">
                            <div style="width: 100%;" id="level_3_fb"></div>
                            <script>
                              Highcharts.chart('level_3_fb', {
                                chart: {
                                  type: 'column'
                                  ,zoomType: 'Xy'
                                },
                                title: {
                                  text: '<b>LEVEL 3 - FABRICATION - STR'
                                },
                                subtitle: {
                                  text: ''
                                },
                                xAxis: {
                                  categories: [''],
                                  crosshair: true
                                },
                                yAxis: {
                                  min: 0,
                                  title: {
                                    text: 'Progress (%)'
                                  }
                                },
                                tooltip: {
                                  headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                  pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
                                  footerFormat: '</table>',
                                  shared: true,
                                  useHTML: true
                                },
                                plotOptions: {
                                  column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0
                                  }
                                },
                                series: [
                                  {
                                    name: 'Mark/Cut (MAX: 15%)',
                                    data: [<?= json_encode($level_3[2]['fb']['mv']) ?>]
                                    ,color: '#2a9d8f',
                                  },
                                  {
                                    name: 'Fit-Up (MAX: 30%)',
                                    data: [<?= json_encode($level_3[2]['fb']['fu']) ?>]
                                    ,color: '#e9c46a',
                                  },
                                  {
                                    name: 'Weld Out (MAX: 45%)',
                                    data: [<?= json_encode($level_3[2]['fb']['vs']) ?>]
                                    ,color: '#f4a261',
                                  },
                                  {
                                    name: 'NDE Acceptance (MAX: 10%)',
                                    data: [<?= json_encode($level_3[2]['fb']['ndt']) ?>]
                                    ,color: '#e76f51',
                                  },
                              ]
                              });
                            </script>
                          </div>
                          <!-- ======================= -->
                          <div class="col-md-4 card">
                            <div style="width: 100%;" id="level_3_as"></div>
                            <script>
                              Highcharts.chart('level_3_as', {
                                chart: {
                                  type: 'column'
                                  ,zoomType: 'Xy'
                                },
                                title: {
                                  text: '<b>LEVEL 3 - ASSEMBLY - STR'
                                },
                                subtitle: {
                                  text: ''
                                },
                                xAxis: {
                                  categories: [''],
                                  crosshair: true
                                },
                                yAxis: {
                                  min: 0,
                                  title: {
                                    text: 'Progress (%)'
                                  }
                                },
                                tooltip: {
                                  headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                  pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
                                  footerFormat: '</table>',
                                  shared: true,
                                  useHTML: true
                                },
                                plotOptions: {
                                  column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0
                                  }
                                },
                                series: [
                                  {
                                    name: 'Installation (MAX: 40%)',
                                    data: [<?= json_encode($level_3[2]['as']['fu']) ?>]
                                    ,color: '#e9c46a',
                                  },
                                  {
                                    name: 'Weld Out (MAX: 50%)',
                                    data: [<?= json_encode($level_3[2]['as']['vs']) ?>]
                                    ,color: '#f4a261',
                                  },
                                  {
                                    name: 'NDE Acceptance (MAX: 10%)',
                                    data: [<?= json_encode($level_3[2]['as']['ndt']) ?>]
                                    ,color: '#e76f51',
                                  },
                              ]
                              });
                            </script>
                          </div>
                          <!-- ======================= -->
                          <div class="col-md-4 card">
                            <div style="width: 100%;" id="level_3_er"></div>
                            <script>
                              Highcharts.chart('level_3_er', {
                                chart: {
                                  type: 'column'
                                  ,zoomType: 'Xy'
                                },
                                title: {
                                  text: '<b>LEVEL 3 - ERRECTION - STR'
                                },
                                subtitle: {
                                  text: ''
                                },
                                xAxis: {
                                  categories: [''],
                                  crosshair: true
                                },
                                yAxis: {
                                  min: 0,
                                  title: {
                                    text: 'Progress (%)'
                                  }
                                },
                                tooltip: {
                                  headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                  pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
                                  footerFormat: '</table>',
                                  shared: true,
                                  useHTML: true
                                },
                                plotOptions: {
                                  column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0
                                  }
                                },
                                series: [
                                  {
                                    name: 'Install / Erect (MAX: 50%)',
                                    data: [<?= json_encode($level_3[2]['er']['fu']) ?>]
                                    ,color: '#e9c46a',
                                  },
                                  {
                                    name: 'Weld Out (MAX: 50%)',
                                    data: [<?= json_encode($level_3[2]['er']['vs']) ?>]
                                    ,color: '#f4a261',
                                  },
                                  {
                                    name: 'NDE Acceptance (MAX: 10%)',
                                    data: [<?= json_encode($level_3[2]['er']['ndt']) ?>]
                                    ,color: '#e76f51',
                                  },
                              ]
                              });
                            </script>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="tab-pane fade" id="pip" role="tabpanel" aria-labelledby="pip-tab">
                      <div class="col">
                        <div class="row">
                        
                          <div class="col-md-6 card">
                            <div style="width: 100%;" id="level_3_pp_fb"></div>
                            <script>
                              Highcharts.chart('level_3_pp_fb', {
                                chart: {
                                  type: 'column'
                                  ,zoomType: 'Xy'
                                },
                                title: {
                                  text: '<b>LEVEL 3 - FABRICATION - PIP'
                                },
                                subtitle: {
                                  text: ''
                                },
                                xAxis: {
                                  categories: [''],
                                  crosshair: true
                                },
                                yAxis: {
                                  min: 0,
                                  title: {
                                    text: 'Progress (%)'
                                  }
                                },
                                tooltip: {
                                  headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                  pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
                                  footerFormat: '</table>',
                                  shared: true,
                                  useHTML: true
                                },
                                plotOptions: {
                                  column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0
                                  }
                                },
                                series: [
                                  {
                                    name: 'Mark/Cut (MAX: 20%)',
                                    data: [<?= json_encode($level_3[1]['fb']['mv']) ?>]
                                    ,color: '#2a9d8f',

                                  },
                                  {
                                    name: 'Fit-Up (MAX: 25%)',
                                    data: [<?= json_encode($level_3[1]['fb']['fu']) ?>]
                                    ,color: '#e9c46a',

                                  },
                                  {
                                    name: 'Weld Out (MAX: 45%)',
                                    data: [<?= json_encode($level_3[1]['fb']['vs']) ?>]
                                    ,color: '#f4a261',
 
                                  },
                                  {
                                    name: 'NDE Acceptance (MAX: 10%)',
                                    data: [<?= json_encode($level_3[1]['fb']['ndt']) ?>]
                                    ,color: '#e76f51',
                                  },
                              ]
                              });
                            </script>
                          </div>
                          <!-- ======================= -->
                          <div class="col-md-6 card">
                            <div style="width: 100%;" id="level_3_pp_er"></div>
                            <script>
                              Highcharts.chart('level_3_pp_er', {
                                chart: {
                                  type: 'column'
                                  ,zoomType: 'Xy'
                                },
                                title: {
                                  text: '<b>LEVEL 3 - ERRECTION - PIP'
                                },
                                subtitle: {
                                  text: ''
                                },
                                xAxis: {
                                  categories: [''],
                                  crosshair: true
                                },
                                yAxis: {
                                  min: 0,
                                  title: {
                                    text: 'Progress (%)'
                                  }
                                },
                                tooltip: {
                                  headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                  pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
                                  footerFormat: '</table>',
                                  shared: true,
                                  useHTML: true
                                },
                                plotOptions: {
                                  column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0
                                  }
                                },
                                series: [
                                  {
                                    name: 'Run Pipes c/w field joints (MAX: 60%)',
                                    data: [<?= json_encode($level_3[1]['er']['fu']) ?>]
                                    ,color: '#e9c46a',

                                  },
                                  {
                                    name: 'Welded / Bolted (MAX: 30%)',
                                    data: [<?= json_encode($level_3[1]['er']['vs']) ?>]
                                    ,color: '#f4a261',

                                  },
                                  {
                                    name: 'NDE (MAX: 10%)',
                                    data: [<?= json_encode($level_3[1]['er']['ndt']) ?>]
                                    ,color: '#e76f51',
                                  },
                              ]
                              });
                            </script>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  </div>
                <?php } ?>
                <?php if($level==4){ ?>
                <div class="card shadow my-3 rounded-0">
                  <ul class="nav nav-tabs nav-pills nav-justified" id="myTab" role="tablist">  
                    <?php foreach ($master_deck as $key => $value) { ?>
                      <li class="nav-item">
                        <a class="nav-link <?= $key==0 ? 'active' : '' ?>" id="<?= $value['code'] ?>-tab" data-toggle="tab" href="#<?= $value['code'] ?>" role="tab" aria-controls="<?= $value['code'] ?>" aria-selected="true"><b><?= strtoupper($value['name']) ?></b></a>
                      </li>
                    <?php } ?>    
                  </ul>
                  
                  <div class="tab-content" id="myTabContent">
                    <?php foreach ($master_deck as $key_4 => $value) { ?>
                    <div class="tab-pane fade <?= $key_4==0 ? 'show active' : '' ?>" id="<?= $value['code'] ?>" role="tabpanel" aria-labelledby="<?= $value['code'] ?>-tab">
                      <div class="col">
                        <br>
                        <div class="col">
                          <div class="row">
                            <div class="col-md-4 card">
                              <div style="width: 100%" id="container_fb_<?= $value['code'] ?>"></div>
                              <?php if($summary[$value['id']]['fb']['na']<100 AND isset($summary[$value['id']]['fb']['na'])){ ?>
                                <script>
                                  Highcharts.chart('container_fb_<?= $value['code'] ?>', {
                                    chart: {
                                      type: 'column'
                                      ,zoomType: 'Xy'
                                    },
                                    title: {
                                      text: 'FABRICATION'
                                    },
                                    xAxis: {
                                      categories: ['CONSTRUCT'],
                                      title: {
                                        text: null
                                      }
                                    },
                                    yAxis: {
                                      min: 0,
                                      max: 100,
                                      title: {
                                        text: 'Progress (%)',
                                        align: 'high'
                                      },
                                      labels: {
                                        overflow: 'justify'
                                      }
                                    },
                                    tooltip: {
                                      valueSuffix: ' %'
                                    },
                                    plotOptions: {
                                      bar: {
                                        dataLabels: {
                                          enabled: true
                                        }
                                      }
                                    },
                                    legend: {
                                      layout: 'vertical',
                                      align: 'right',
                                      verticalAlign: 'top',
                                      x: -40,
                                      y: 80,
                                      floating: true,
                                      borderWidth: 1,
                                      backgroundColor:
                                        Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                                      shadow: true
                                    },
                                    credits: {
                                      enabled: false
                                    },
                                    series: [{
                                      name: 'Mark/Cut (MAX :'+<?= json_encode($percent[0])?>+' %)',
                                      data: [<?= json_encode($summary[$value['id']]['fb']['mv']) ?>,],
                                      color: '#89b0ae'
                                    }, {
                                      name: 'Fit-Up (MAX :'+<?= json_encode($percent[1])?>+' %)',
                                      data: [<?= json_encode($summary[$value['id']]['fb']['fu']) ?>,],
                                      color: '#3d5a80'
                                    }, {
                                      name: 'Weld Out (MAX :'+<?= json_encode($percent[2])?>+' %)',
                                      data: [<?= json_encode($summary[$value['id']]['fb']['vs']) ?>,],
                                      color : '#98c1d9'
                                    }, {
                                      name: 'NDE Acceptance (MAX :'+<?= json_encode($percent[3])?>+' %)',
                                      data: [<?= json_encode($summary[$value['id']]['fb']['ndt']) ?>,],
                                      color : '#bee3db'
                                    }, {
                                      name: 'IN/NO PROGRESS',
                                      data: [<?= json_encode($summary[$value['id']]['fb']['na']) ?>,],
                                      color : '#ee6c4d'
                                    }],
                                  });
                                  //======== hapus
                                </script>
                              <?php } else {?>
                              <center>
                                <div class="align-middle">
                                  <div class="mt-4" style="width:220px; height:220px; border-radius:50%; border: 2px solid #e74c3c; vertical-align: middle">
                                  <div class="container h-100">
                                    <div class="row h-100 justify-content-center align-items-center">
                                      <h4 class="text-danger">No Data Available </h4>
                                    </div>
                                  </div>
                                  </div>
                                </div>
                              </center>
                              <?php } ?>
                            </div>
                            <div class="col-md-4 card">
                              <div style="width: 100%" id="container_as_<?= $value['code'] ?>"></div>
                              <?php if($summary[$value['id']]['as']['na']<100 AND isset($summary[$value['id']]['as']['na'])){ ?>
                              
                                <script>
                                  Highcharts.chart('container_as_<?= $value['code'] ?>', {
                                    chart: {
                                      type: 'column'
                                      ,zoomType: 'Xy'
                                    },
                                    title: {
                                      text: 'ASSEMBLY'
                                    },
                                    xAxis: {
                                      categories: ['CONSTRUCT'],
                                      title: {
                                        text: null
                                      }
                                    },
                                    yAxis: {
                                      min: 0,
                                      max: 100,
                                      title: {
                                        text: 'Progress (%)',
                                        align: 'high'
                                      },
                                      labels: {
                                        overflow: 'justify'
                                      }
                                    },
                                    tooltip: {
                                      valueSuffix: ' %'
                                    },
                                    plotOptions: {
                                      bar: {
                                        dataLabels: {
                                          enabled: true
                                        }
                                      }
                                    },
                                    legend: {
                                      layout: 'vertical',
                                      align: 'right',
                                      verticalAlign: 'top',
                                      x: -40,
                                      y: 80,
                                      floating: true,
                                      borderWidth: 1,
                                      backgroundColor:
                                        Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                                      shadow: true
                                    },
                                    credits: {
                                      enabled: false
                                    },
                                    series: [{
                                      name: 'Installation (MAX :'+<?= json_encode($percent[4])?>+' %)',
                                      data: [<?= json_encode($summary[$value['id']]['as']['fu']) ?>,],
                                      color: '#3d5a80'
                                    }, {
                                      name: 'Weld Out (MAX :'+<?= json_encode($percent[5])?>+' %)',
                                      data: [<?= json_encode($summary[$value['id']]['as']['vs']) ?>,],
                                      color : '#98c1d9'
                                    }, {
                                      name: 'NDE Acceptance (MAX :'+<?= json_encode($percent[6])?>+' %)',
                                      data: [<?= json_encode($summary[$value['id']]['as']['ndt']) ?>,],
                                      color : '#bee3db'
                                    }, {
                                      name: 'IN/NO PROGRESS',
                                      data: [<?= json_encode($summary[$value['id']]['as']['na']) ?>,],
                                      color : '#ee6c4d'
                                    }]
                                  });
                                  //======== hapus
                                </script>
                              <?php } else {?>
                              <center>
                                <div class="align-middle">
                                  <div class="mt-4" style="width:220px; height:220px; border-radius:50%; border: 2px solid #e74c3c; vertical-align: middle">
                                  <div class="container h-100">
                                    <div class="row h-100 justify-content-center align-items-center">
                                      <h4 class="text-danger">No Data Available </h4>
                                    </div>
                                  </div>
                                  </div>
                                </div>
                              </center>
                              <?php } ?>
                            </div>
                            <div class="col-md-4 card">
                              <div style="width: 100%" id="container_er_<?= $value['code'] ?>"></div>
                              <?php if($summary[$value['id']]['er']['na']<100 AND isset($summary[$value['id']]['er']['na'])){ ?>
                                <script>
                                  Highcharts.chart('container_er_<?= $value['code'] ?>', {
                                    chart: {
                                      type: 'column'
                                      ,zoomType: 'Xy'
                                    },
                                    title: {
                                      text: 'ERRECTION'
                                    },
                                    xAxis: {
                                      categories: ['CONSTRUCT'],
                                      title: {
                                        text: null
                                      }
                                    },
                                    yAxis: {
                                      min: 0,
                                      max: 100,
                                      title: {
                                        text: 'Progress (%)',
                                        align: 'high'
                                      },
                                      labels: {
                                        overflow: 'justify'
                                      }
                                    },
                                    tooltip: {
                                      valueSuffix: ' %'
                                    },
                                    plotOptions: {
                                      bar: {
                                        dataLabels: {
                                          enabled: true
                                        }
                                      }
                                    },
                                    legend: {
                                      layout: 'vertical',
                                      align: 'right',
                                      verticalAlign: 'top',
                                      x: -40,
                                      y: 80,
                                      floating: true,
                                      borderWidth: 1,
                                      backgroundColor:
                                        Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                                      shadow: true
                                    },
                                    credits: {
                                      enabled: false
                                    },
                                    series: [{
                                      name: 'Install / Erect (MAX :'+<?= json_encode($percent[7])?>+' %)',
                                      data: [<?= json_encode($summary[$value['id']]['er']['fu']) ?>,],
                                      color: '#3d5a80'
                                    }, {
                                      name: 'Weld Out (MAX :'+<?= json_encode($percent[8])?>+' %)',
                                      data: [<?= json_encode($summary[$value['id']]['er']['vs']) ?>,],
                                      color : '#98c1d9'
                                    }, {
                                      name: 'NDE Acceptance (MAX :'+<?= json_encode($percent[9])?>+' %)',
                                      data: [<?= json_encode($summary[$value['id']]['er']['ndt']) ?>,],
                                      color : '#bee3db'
                                    }, {
                                      name: 'IN/NO PROGRESS',
                                      data: [<?= json_encode($summary[$value['id']]['er']['na']) ?>,],
                                      color : '#ee6c4d'
                                    }]
                                  });
                                  //======== hapus
                                </script>
                              <?php } else {?>
                              <center>
                                <div class="align-middle">
                                  <div class="mt-4" style="width:220px; height:220px; border-radius:50%; border: 2px solid #e74c3c; vertical-align: middle">
                                  <div class="container h-100">
                                    <div class="row h-100 justify-content-center align-items-center">
                                      <h4 class="text-danger">No Data Available </h4>
                                    </div>
                                  </div>
                                  </div>
                                </div>
                              </center>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                        <br>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                <?php } ?>
                </div>
              </div>
            </div>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->