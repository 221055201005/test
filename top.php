<style type="text/css">
  #topbar-mobile {
    display: none;
  }

  @media (max-width: 767px) {
    #topbar-mobile {
      display: block;
    }

    #topbar-desktop {
      display: none;
    }
  }

  body,
  .form-control,
  .custom-select,
  .btn {
    font-size: 0.9rem
  }
</style>

<style>
  .notificationx .badgex {
    position: absolute;
    top: -10px;
    left: -11px;
    padding: 5px 10px;
    border-radius: 50%;
    background-color: red;
    color: white;
    font-size: 9px !important;
  }

  .notif {
    max-width: 330px !important;
    z-index: 999;
  }

  #notif_container {
    z-index: 1021;
    transform: translate3d(-45px, 36px, 0px) !important;
  }
</style>
<?php error_reporting(0); ?>

<body style="background-color: whitesmoke;">
  <div class="bg-white">
    <div class="container-fluid">
      <div class="row py-3 align-items-center">
        <div class="col-md">
          <img src="<?php echo base_url(); ?>img/seatrium_logo_bg_white.png" width="200" class="py-3">
        </div>
        <!--  <div class="col-md">
          <img src="<?php echo base_url(); ?>img/training.png" >
        </div> -->
        <div class="col-md text-right">
          <div class="dropdown w-100">
            <div class="btn-group">

              <button type="button" class="btn btn-flat bg-primary text-white">
                <i class="fa fa-user"></i> &nbsp; <?php echo @$this->user_cookie[1]; ?>
              </button>
              <a href='<?php echo $this->user_cookie[9]; ?>'>
                <button type="button" class="btn btn-flat bg-danger text-white">
                  <i class="fa fa-sign-out"></i> Portal
                </button>
              </a>
              <button type="button" class="btn btn-flat bg-info   notificationx  text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell" aria-hidden="true"></i>

                <span class="badgex <?= get_notification()[0]['total_unread'] <= 0 ? "d-none" : null ?>" id='total_notification'><?php echo get_notification()[0]['total_unread']; ?></span>

              </button>
              <div id="notif_container" class="dropdown-menu">
                <?php $data_notification = get_notification();
                foreach ($data_notification as $key => $value) {
                  $id_notif_var_array[] = $value['id_notif']; ?>
                  <a id='id_<?= $value['id_notif'] ?>' onclick="redirect_notification('<?= $value['link'] ?>','<?= $value['id_notif'] ?>')" class="dropdown-item list-group-item list-group-item-action flex-column align-items-start notif <?= empty($value['status_read']) ? "unread" : null ?>" href="#" title='<?= $value['notification_desc'] ?>'>
                    <div class="d-flex w-100 justify-content-between">
                      <small><b><?= $value['main_title'] ?>
                          <?php
                          $earlier  = new DateTime(date("Y-m-d", strtotime($value['created_date'])));
                          $later    = new DateTime(date("Y-m-d"));
                          $abs_diff = $later->diff($earlier)->format("%a");

                          if (date("Y-m-d", strtotime($value['created_date'])) == date("Y-m-d")) {
                            echo "Today";
                          } else {
                            if ($abs_diff > 1) {
                              echo $abs_diff . " days ago";
                            } else {
                              echo $abs_diff . " day ago";
                            }
                          }
                          ?> </b>
                      </small>
                    </div>
                    <div class='notif'>
                      <small><?= $value['mini_title'] ?></small>
                      <p class="mb-1"><small><?= substr($value['notification_desc'], 0, 40) . "..." ?></small></p>
                    </div>
                  </a>
                <?php } ?>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url() . "notification" ?>">See All</a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  </div>

  <nav class="sticky-top py-1 bg-green-smoe container-fluid">

    <div class="row align-items-center" id="topbar-mobile">
    </div>

    <div class="row align-items-center" id="topbar-desktop">
      <div class="col-md">
        <div class="row">

          <div class="col-md-auto d-flex justify-content-between">
            <div class="btn-group">
              <button type="button" class="btn btn-flat btn-green-smoe text-white" onClick="sidebarCollapse();" <?php echo (isset($sidebar) ? '' : 'disabled'); ?>>
                <i class="fas fa-align-justify"></i>
              </button>
            </div>
          </div>

          <?php if ($this->permission_cookie[1] == 1) { ?>
            <div class="col-md-auto text-center topbar-menu">
              <div class="btn-group">
                <a href="<?php echo base_url(); ?>home/" class="btn btn-flat btn-green-smoe text-white">
                  <i class="fas fa-home"></i> &nbsp;Home
                </a>
              </div>
            </div>
          <?php } ?>

          <?php if ($this->permission_cookie[2] == 1 or $this->permission_cookie[8] == 1) { ?>
            <div class="col-md-auto text-center topbar-menu">
              <div class="btn-group">
                <a href="<?php echo base_url(); ?>engineering" class="btn btn-flat btn-green-smoe text-white">
                  <i class="fas fa-drafting-compass"></i> &nbsp;Engineering
                </a>
              </div>
            </div>
          <?php } ?>

          <?php if ($this->permission_cookie[14] == 1) { ?>
            <div class="col-md-auto text-center topbar-menu">
              <div class="btn-group">
                <a href="<?php echo base_url(); ?>planning" class="btn btn-flat btn-green-smoe text-white">
                  <i class="fas fa-pencil-ruler"></i> &nbsp;Planning
                </a>
              </div>
            </div>
          <?php } ?>

          <?php if ($this->permission_cookie[66] == 1) { ?>

            <div class="col-md-auto text-center topbar-menu">
              <div class="btn-group">
                <a href="<?php echo base_url(); ?>planning/search_workpack" class="btn btn-flat btn-green-smoe text-white">
                  <i class="fas fa-chalkboard-teacher"></i> &nbsp;Surveyor
                </a>
              </div>
            </div>

          <?php } ?>


          <?php if ($this->permission_cookie[20] == 1 or $this->permission_cookie[29] == 1 or $this->permission_cookie[38] == 1 or $this->permission_cookie[56] == 1 or $this->permission_cookie[158] == 1) { ?>
            <div class="col-md-auto text-center topbar-menu">
              <div class="btn-group">
                <a href="#" class="btn btn-flat btn-green-smoe text-white nav-link" id="fabrication" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-industry"></i> &nbsp;Fabrication &nbsp;<i class="fas fa-caret-down"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="fabrication">
                  <?php if ($this->permission_cookie[20] == 1) { ?>
                    <a class="dropdown-item" href="<?= base_url(); ?>material_verification"><i class="fas fa-caret-right"></i> MATERIAL VERIFICATION</a>
                  <?php } ?>

                  <?php if ($this->permission_cookie[29] == 1) { ?>
                    <a class="dropdown-item" href="<?= base_url(); ?>fitup"><i class="fas fa-caret-right"></i> FIT UP</a>
                  <?php } ?>

                  <?php if ($this->permission_cookie[38] == 1) { ?>
                    <a class="dropdown-item" href="<?= base_url(); ?>visual"><i class="fas fa-caret-right"></i> VISUAL TESTING</a>
                  <?php } ?>

                  <?php if ($this->permission_cookie[131] == 1) { ?>
                    <a class="dropdown-item" href="<?= base_url(); ?>dimension/dc_list/"><i class="fas fa-caret-right"></i> ADDITIONAL REPORT</a>
                  <?php } ?>

                  <!-- <?php if ($this->permission_cookie[56] == 1) { ?>
										<?php if ($this->user_cookie[11] != 1) { ?>
											<a class="dropdown-item" href="<?= base_url() . 'ndt/bucket_list/rfi' ?>"><i class="fas fa-caret-right"></i>
												NDT TRANSMITTAL</a>
										<?php } else { ?>
											<a class="dropdown-item" href="<?= base_url() . 'ndt/bucket_list' ?>"><i class="fas fa-caret-right"></i>
												NDT TRANSMITTAL</a>
										<?php } ?>
									<?php } ?> -->
                  <?php if ($this->permission_cookie[176] == 1) { ?>
                    <a class="dropdown-item" href="<?= base_url(); ?>rejection_rate"><i class="fas fa-caret-right"></i> REJECTION RATE</a>
                  <?php } ?>
                  <?php //if($this->permission_cookie[0] == 1 && $this->user_cookie[7] != 8){ 
                  ?>
                  <a class="dropdown-item" href="<?php echo base_url() ?>master/welder/welder_performance"><i class="fas fa-caret-right"></i> WELDER PERFORMANCE</a>

                  <?php if ($this->permission_cookie[177] == 1) { ?>
                    <a class="dropdown-item" href="<?= base_url(); ?>itr"><i class="fas fa-caret-right"></i> ITR</a>
                  <?php } ?>

                  <?php if ($this->permission_cookie[180] == 1) { ?>
                    <a class="dropdown-item" href="<?= base_url(); ?>bondstrand"><i class="fas fa-caret-right"></i> BONDSTRAND</a>
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php } ?>

          <?php if ($this->permission_cookie[67] == 1) { ?>

            <div class="col-md-auto text-center topbar-menu">
              <div class="btn-group">
                <a href="#" class="btn btn-flat btn-green-smoe text-white nav-link" id="fabrication" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-thermometer-quarter"></i> &nbsp;NDT &nbsp;<i class="fas fa-caret-down"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="fabrication">
                  <a class="dropdown-item" href="<?= base_url() . 'ndt_live/transmittal_list' ?>"><i class="text-seatrium-blue fas fa-caret-right"></i> NDT Transmittal</a>
                  <?php
                  $ndt = $this->db->query("SELECT * FROM master_ndt_type")->result_array();
                  foreach ($ndt as $key => $ndt_value) {
                    if (in_array($ndt_value['id'], [1, 2, 3, 7, 9])) {
                  ?>
                      <a class="dropdown-item" href="<?= base_url() . 'ndt_live/ndt_list/' . encrypt($ndt_value['ndt_initial']) ?>"><i class="text-seatrium-blue fas fa-caret-right"></i>
                        <?= $ndt_value['ndt_description'] ?></a>
                    <?php } ?>
                  <?php } ?>
                </div>
              </div>
            </div>

          <?php } ?>

          <?php if ($this->permission_cookie[68] == 1) { ?>

            <!-- <div class="col-md-auto text-center topbar-menu">
            <div class="btn-group">
              <a href="<?php echo base_url(); ?>wtr" class="btn btn-flat btn-green-smoe text-white">
                <i class="fas fa-file-word"></i> &nbsp;MWTR
              </a>
            </div>
          </div> -->

            <div class="col-md-auto text-center topbar-menu">
              <div class="btn-group">
                <a href="#" class="btn btn-flat btn-green-smoe text-white nav-link" id="fabrication" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-search"></i> &nbsp;Traceabilty &nbsp;<i class="fas fa-caret-down"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="fabrication">
                  <a class="dropdown-item" href="<?php echo base_url(); ?>wtr"><i class="fas fa-caret-right"></i> MWTR</a>
                  <?php if ($this->permission_cookie[178] == 1) { ?>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>btr"><i class="fas fa-caret-right"></i> BTR</a>
                  <?php } ?>

                  <?php if ($this->permission_cookie[187] == 1) : ?>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>mts"><i class="fas fa-caret-right"></i> MTS</a>
                  <?php endif; ?>


                  <a class="dropdown-item" href="<?php echo base_url(); ?>additional_attachment"><i class="fas fa-caret-right"></i> ADDITIONAL ATTACHMENT</a>
                  <?php if ($this->permission_cookie[0] == 1) : ?>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>mdb"><i class="fas fa-caret-right"></i> DOSSIER</a>
                  <?php endif; ?>
                </div>
              </div>
            </div>


          <?php } ?>

          <?php if ($this->permission_cookie[69] == 1) { ?>

            <div class="col-md-auto text-center topbar-menu">
              <div class="btn-group">
                <a href="<?php echo base_url(); ?>irn" class="btn btn-flat btn-green-smoe text-white">
                  <i class="fas fa-file-word"></i> &nbsp;IRN
                </a>
              </div>
            </div>

          <?php } ?>

          <?php if ($this->permission_cookie[137] == 1) { ?>
            <div class="col-md-auto text-center topbar-menu">
              <div class="btn-group">
                <a href="<?php echo base_url(); ?>mechanical_completion" class="btn btn-flat btn-green-smoe text-white" title="Mechanical Completion">
                  <i class="fas fa-file-word"></i> &nbsp;MC
                </a>
              </div>
            </div>
          <?php } ?>

          <?php if ($this->permission_cookie[69] == 1) { ?>

            <div class="col-md-auto text-center topbar-menu">
              <div class="btn-group">
                <a href="<?php echo base_url(); ?>planning_bnp" class="btn btn-flat btn-green-smoe text-white">
                  <i class="fas fa-file-word"></i> &nbsp;B&P
                </a>
              </div>
            </div>

          <?php } ?>

          <!-- <?php //if(in_array($this->user_cookie[11], [1, 14]) || $this->user_cookie[7] == 8){ 
                ?> -->
          <?php if ($this->user_cookie[7] == 8) { ?>
            <!-- <div class="col-md-auto text-center topbar-menu">
              <div class="btn-group">
                <a href="<?php echo base_url(); ?>rfi" class="btn btn-flat btn-green-smoe text-white">
                  <i class="fas fa-file-word"></i> &nbsp;Status RFI
                </a>
              </div>
            </div> -->
          <?php } ?>

          <?php if ($this->permission_cookie[72] == '1') { ?>

            <div class="col-md-auto text-center topbar-menu">
              <div class="btn-group">

                <a href="<?php echo base_url(); ?>welding_rfi/rfi_list" class="btn btn-flat btn-green-smoe text-white">
                  <i class="fas fa-file-word"></i> &nbsp;Welding
                </a>

              </div>
            </div>
          <?php } ?>

          <?php if ($this->permission_cookie[165] == 1) : ?>
            <div class="col-md-auto text-center topbar-menu">
              <div class="btn-group">

                <a href="<?php echo base_url(); ?>welder_activity" class="btn btn-flat btn-green-smoe text-white">
                  <i class="fas fa-hard-hat"></i> &nbsp;Foreman Fighter
                </a>

              </div>
            </div>
          <?php endif; ?>

          <?php if ($this->permission_cookie[175] == 1) : ?>
            <div class="col-md-auto text-center topbar-menu">
              <div class="btn-group">
                <a href="<?php echo base_url(); ?>master/area/area_list" class="btn btn-flat btn-green-smoe text-white">
                  <i class="fas fa-database"></i> &nbsp;Master Data
                </a>
              </div>
            </div>
          <?php endif; ?>

          <?php if ($this->permission_cookie[112] == '1' or $this->permission_cookie[107] == '1' or $this->permission_cookie[117] == '1') { ?>
            <div class="col-md-auto text-center topbar-menu">
              <div class="btn-group">
                <a href="#" class="btn btn-flat btn-green-smoe text-white nav-link" id="fabrication" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-list-ol"></i> &nbsp;Register &nbsp;<i class="fas fa-caret-down"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="fabrication">
                  <?php if ($this->permission_cookie[112] == '1') { ?>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>master/wps/wps_list"><i class="fas fa-caret-right"></i> WPS Register</a>
                  <?php } ?>
                  <?php if ($this->permission_cookie[184] == 1) : ?>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>master/cons_lot"><i class="fas fa-caret-right"></i> Consumable Lot Register</a>
                  <?php endif; ?>
                  <?php if ($this->permission_cookie[107] == '1') { ?>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>master/welder/welder_list"><i class="fas fa-caret-right"></i> Welder Register</a>
                  <?php } ?>
                  <?php if ($this->permission_cookie[117] == '1') { ?>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>master/fitter/fitter_list"><i class="fas fa-caret-right"></i> Fitter Register</a>
                  <?php } ?>
                  <?php if ($this->user_cookie[11] == 1) { ?>
                    <?php if ($this->permission_cookie[56] == '1') { ?>
                      <a class="dropdown-item" href="<?php echo base_url(); ?>master/ndter/personnel_list"><i class="fas fa-caret-right"></i> NDT Personnel Register</a>
                    <?php } ?>
                  <?php } ?>
                  <?php if ($this->user_cookie[11] == 1) { ?>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>master/cons_reg/consumable_list"><i class="fas fa-caret-right"></i> Welding Consumable Register ( Structure )</a>
                  <?php } ?>
                  <?php if ($this->permission_cookie[179] == '1') { ?>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>master/bonder/bonder_list"><i class="fas fa-caret-right"></i> Bonder Register</a>
                  <?php } ?>

                  <?php if ($this->permission_cookie[174] == 1) : ?>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>master/form/register_list"><i class="fas fa-caret-right"></i> Form Register</a>
                  <?php endif; ?>


                </div>
              </div>
            </div>
          <?php } ?>

          <!-- <div class="col-md-auto text-center topbar-menu">
              <div class="btn-group">
                <a href="#" class="btn btn-flat btn-green-smoe text-white nav-link" id="fabrication"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-industry"></i> &nbsp;Welding &nbsp;<i class="fas fa-caret-down"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="fabrication">
                  <?php //if($this->permission_cookie[20] == 1){ 
                  ?>
                    <a class="dropdown-item" href="<?= base_url(); ?>we_dept/fitup_list"><i class="fas fa-caret-right"></i> FIT-UP</a>
                  <?php //} 
                  ?>
                  <?php //if($this->permission_cookie[29] == 1){ 
                  ?>
                    <a class="dropdown-item" href="<?= base_url(); ?>we_dept/visual_list"><i class="fas fa-caret-right"></i> VISUAL</a>
                  <? php // } 
                  ?>
                </div>
              </div>
            </div> -->

        </div>
      </div>
      <div class="col-md-auto text-center">
        <div class="btn-group">
          <button type="button" class="btn btn-flat btn-green-smoe text-white">
            <span class="text-white"><?php echo date("l, d F Y"); ?></span>
          </button>
        </div>
      </div>

    </div>


  </nav>




  <style>
    .border-mobile {
      border-bottom: 1px solid #dee2e6
    }

    #topmenu .col-md-auto:nth-child(1) .border-mobile {
      border-top: 1px solid #dee2e6
    }
  </style>
  <script>
    var topbarmenu = '<div class="col-xl">' +
      '<div class="row">' +
      '<div class="col-md-auto d-flex justify-content-between">' +
      '<div class="btn-group">' +
      '<button type="button" class="btn btn-flat btn-dark text-white" onClick="sidebarCollapse();" <?php echo (isset($sidebar) ? '' : 'disabled'); ?>>' +
      '<i class="fas fa-align-justify"></i>' +
      '</button>' +
      '</div>' +
      '<div id="idbtncol" class="btn-group">' +
      '<button type="button" class="btn btn-flat btn-light text-black" data-toggle="collapse" data-target="#topmenu">' +
      '<i class="fas fa-align-justify"></i>' +
      '</button>' +
      '</div>' +
      '</div>            ' +
      '</div>' +
      '<div class="row collapse mt-3" id="topmenu">';
    $(".topbar-menu").each(function() {
      var menu_html = $(this).find('.btn-group').html();
      topbarmenu += '<div class="col-md-auto">' +
        '<div class="btn-group w-100 border-mobile text-left">' +
        menu_html +
        '</div>' +
        '</div>';
    });
    topbarmenu += '<div class="col-md-auto text-center">' +
      '<div class="btn-group mt-3">' +
      '<button type="button" class="btn btn-flat btn-green-smoe text-white">' +
      '<span class="text-white"><?php echo date("l, d F Y"); ?></span>' +
      '</button>' +
      '</div>' +
      '</div> ' +

      '</div>' +
      '</div> ';
    $("#topbar-mobile").html(topbarmenu);
    $("#topmenu a").each(function() {
      $(this).addClass("text-left");
    })
  </script>