<body>
  <div class="bg-seatrium-blue shadow">
    <div class="container-fluid">

      <div class="row py-3 align-items-center">
        <div class="col-md-2 text-center">
          <img class="logo-top" src="<?php echo base_url(); ?>img/seatrium-black.png">
        </div>

        <div class="col-8 text-center mt-3 mb-1 toggle-menu-mobile button-menu-mobile toggle-menu-mobile button-menu-mobile"  data-toggle="collapse" data-target="#menu_mobile" aria-expanded="false" aria-controls="menu_mobile">

          <div class="row align-items-center " style="background-color: white">

            <div class="col-md-auto text-center">
              <div class="btn-group w-100">
                <button class="btn btn-flat btn-sm btn-white font-weight-bold">
                  <!-- <i class="text-seatrium-blue fas fa-list"></i> &nbsp; -->
                  Menu&nbsp;
                  <i class="text-seatrium-blue fas fa-caret-up icon-menu-mobile"></i>
                  <i class="text-seatrium-blue fas fa-caret-down icon-menu-mobile"></i>
                </button>
              </div>
            </div>

          </div>
        </div>

        <div class="col text-right mt-3 mb-1 button-menu-mobile">
          <div class="btn-group">
            <button data-toggle="dropdown" href="#" aria-expanded="false" type="button" class="btn btn-sm text-white text-nowrap bg-seatrium-blue-dark">
              <i class="text-seatrium-blue fa fa-user text-white"></i> <i class="text-seatrium-blue fa fa-caret-down text-white"></i>
            </button>

            <ul class="dropdown-menu dropdown-user dropdown-menu-right ">
              <div class="dropdown-user-scroll scrollbar-outer">
                <li>
                  <div class="user-box">

                    <div class="u-text">
                      <h4><?= $this->user_cookie[1] ?></h4>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?= getenv('LINK_PCMS_PORTAL_OUTSIDE') ?>"><i class="fas fa-caret-right"></i> Portal</a>
                </li>
              </div>
            </ul>

            <button type="button" class="btn btn-sm notificationx text-nowrap text-seatrium-blue" style="background-color: white;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="text-seatrium-blue fa fa-bell" aria-hidden="true"></i>
              <i class="text-seatrium-blue fa fa-caret-down" aria-hidden="true"></i>

              <span class="badgex <?= @get_notification()[0]['total_unread']+0 <= 0 ? "d-none" : null ?>" id='total_notification'><?php echo @get_notification()[0]['total_unread']+0; ?></span>

            </button>
          </div>
        </div>

        <div class="col-md-12  button-menu-mobile  bg-white">
          <div class="collapse multi-collapse" id="menu_mobile">
            
          </div>
        </div>

        <div class="col-md text-center tab-menu-desktop">
          <div class="row align-items-center rounded" id="topbar-desktop" style="background-color: white">
            <div class="col-md">
              <div class="row">
                <?php if ($this->permission_cookie[1] == 1) { ?>
                  <div class="col-md-auto text-center topbar-menu">
                    <div class="btn-group">
                      <a href="<?php echo base_url(); ?>home/" class="btn btn-flat btn-white">
                        <i class="text-seatrium-blue fas fa-home"></i> &nbsp;Home
                      </a>
                    </div>
                  </div>
                <?php } ?>
                <?php if ($this->permission_cookie[2] == 1 or $this->permission_cookie[8] == 1) { ?>
                  <div class="col-md-auto text-center topbar-menu">
                    <div class="btn-group">
                      <a href="<?php echo base_url(); ?>engineering" class="btn btn-flat btn-white ">
                        <i class="text-seatrium-blue fas fa-drafting-compass"></i> &nbsp;Engineering
                      </a>
                    </div>
                  </div>
                <?php } ?>
                <?php if ($this->permission_cookie[14] == 1) { ?>
                  <div class="col-md-auto text-center topbar-menu">
                    <div class="btn-group">
                      <a href="<?php echo base_url(); ?>planning" class="btn btn-flat btn-white ">
                        <i class="text-seatrium-blue fas fa-pencil-ruler"></i> &nbsp;Planning
                      </a>
                    </div>
                  </div>
                <?php } ?>
                <?php if ($this->permission_cookie[66] == 1) { ?>
                  <div class="col-md-auto text-center topbar-menu">
                    <div class="btn-group">
                      <a href="<?php echo base_url(); ?>planning/search_workpack" class="btn btn-flat btn-white ">
                        <i class="text-seatrium-blue fas fa-chalkboard-teacher"></i> &nbsp;Surveyor
                      </a>
                    </div>
                  </div>
                <?php } ?>
                <?php if ($this->permission_cookie[20] == 1 or $this->permission_cookie[29] == 1 or $this->permission_cookie[38] == 1 or $this->permission_cookie[56] == 1 or $this->permission_cookie[158] == 1) { ?>
                  <div class="col-md-auto text-center topbar-menu">
                    <div class="btn-group">
                      <a href="#" class="btn btn-flat btn-white  nav-link" id="fabrication" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="text-seatrium-blue fas fa-industry"></i> &nbsp;Fabrication &nbsp;<i class="text-seatrium-blue fas fa-caret-down"></i>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="fabrication">
                        <?php if ($this->permission_cookie[20] == 1) { ?>
                          <a class="dropdown-item" href="<?= base_url(); ?>material_verification"><i class="text-seatrium-blue fas fa-caret-right"></i> MATERIAL VERIFICATION</a>
                        <?php } ?>
                        <?php if ($this->permission_cookie[29] == 1) { ?>
                          <a class="dropdown-item" href="<?= base_url(); ?>fitup"><i class="text-seatrium-blue fas fa-caret-right"></i> FIT UP</a>
                        <?php } ?>
                        <?php if ($this->permission_cookie[38] == 1) { ?>
                          <a class="dropdown-item" href="<?= base_url(); ?>visual"><i class="text-seatrium-blue fas fa-caret-right"></i> VISUAL TESTING</a>
                        <?php } ?>
                        <?php if ($this->permission_cookie[131] == 1) { ?>
                          <a class="dropdown-item" href="<?= base_url(); ?>additional/dc_list/"><i style="color: #003fff;" class="fas fa-caret-right"></i> ADDITIONAL REPORT</a>
                        <?php } ?>
                        <a class="dropdown-item" href="<?= base_url(); ?>rejection_rate"><i class="text-seatrium-blue fas fa-caret-right"></i> REJECTION RATE</a>
                        <a class="dropdown-item" href="<?php echo base_url() ?>master/welder/welder_performance"><i class="text-seatrium-blue fas fa-caret-right"></i> WELDER PERFORMANCE</a>
                        <a class="dropdown-item" href="<?= base_url(); ?>itr"><i class="text-seatrium-blue fas fa-caret-right"></i> ITR</a>
                        <a class="dropdown-item" href="<?= base_url(); ?>bondstrand"><i class="text-seatrium-blue fas fa-caret-right"></i> BONDSTRAND</a>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                <?php if ($this->permission_cookie[67] == 1) { ?>
                  <div class="col-md-auto text-center topbar-menu">
                    <div class="btn-group">
                      <a href="#" class="btn btn-flat btn-white  nav-link" id="fabrication" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="text-seatrium-blue fas fa-thermometer-quarter"></i> &nbsp;NDT &nbsp;<i class="text-seatrium-blue fas fa-caret-down"></i>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="fabrication">
                        <a class="dropdown-item" href="<?= base_url() . 'ndt_live/transmittal_list' ?>"><i class="text-seatrium-blue fas fa-caret-right"></i> NDT Transmittal</a>
                        <?php
                        $ndt = $this->db->query("SELECT * FROM master_ndt_type")->result_array();
                        foreach ($ndt as $key => $ndt_value) {
                          if ($this->user_cookie[7] != 8) {
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
                  <div class="col-md-auto text-center topbar-menu">
                    <div class="btn-group text-left">
                      <a href="#" class="btn btn-flat btn-white  nav-link" id="fabrication" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="text-seatrium-blue fas fa-search"></i> &nbsp;Traceabilty &nbsp;<i class="text-seatrium-blue fas fa-caret-down"></i>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="fabrication">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>wtr"><i class="text-seatrium-blue fas fa-caret-right"></i> MWTR</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>btr"><i class="text-seatrium-blue fas fa-caret-right"></i> BTR</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>additional_attachment"><i class="text-seatrium-blue fas fa-caret-right"></i> ADDITIONAL ATTACHMENT</a>
                        <?php if ($this->permission_cookie[0] == 1) : ?>
                          <a class="dropdown-item" href="<?php echo base_url(); ?>mdb"><i class="text-seatrium-blue fas fa-caret-right"></i> DOSSIER</a>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                <?php if ($this->permission_cookie[69] == 1) { ?>
                  <div class="col-md-auto text-center topbar-menu">
                    <div class="btn-group">
                      <a href="<?php echo base_url(); ?>irn" class="btn btn-flat btn-white ">
                        <i class="text-seatrium-blue fas fa-file-word"></i> &nbsp;IRN
                      </a>
                    </div>
                  </div>
                <?php } ?>
                <?php if ($this->permission_cookie[137] == 1) { ?>
                  <div class="col-md-auto text-center topbar-menu">
                    <div class="btn-group">
                      <a href="<?php echo base_url(); ?>mechanical_completion" class="btn btn-flat btn-white " title="Mechanical Completion">
                        <i class="text-seatrium-blue fas fa-file-word"></i> &nbsp;MC
                      </a>
                    </div>
                  </div>
                <?php } ?>
                <?php if ($this->permission_cookie[69] == 1) { ?>
                  <div class="col-md-auto text-center topbar-menu">
                    <div class="btn-group">
                      <a href="<?php echo base_url(); ?>planning_bnp" class="btn btn-flat btn-white ">
                        <i class="text-seatrium-blue fas fa-file-word"></i> &nbsp;B&P
                      </a>
                    </div>
                  </div>
                <?php } ?>
                <?php if ($this->user_cookie[7] == 8) { ?>
                  <div class="col-md-auto text-center topbar-menu">
                    <div class="btn-group">
                      <a href="<?php echo base_url(); ?>rfi" class="btn btn-flat btn-white ">
                        <i class="text-seatrium-blue fas fa-file-word"></i> &nbsp;Status RFI
                      </a>
                    </div>
                  </div>
                <?php } ?>
                <?php if ($this->permission_cookie[72] == '1') { ?>
                  <div class="col-md-auto text-center topbar-menu">
                    <div class="btn-group">
                      <a href="<?php echo base_url(); ?>welding_rfi/rfi_list" class="btn btn-flat btn-white ">
                        <i class="text-seatrium-blue fas fa-file-word"></i> &nbsp;Welding
                      </a>
                    </div>
                  </div>
                <?php } ?>
                <?php if ($this->user_cookie[4] == 1) : ?>
                  <div class="col-md-auto text-center topbar-menu">
                    <div class="btn-group">
                      <a href="<?php echo base_url(); ?>welder_activity" class="btn btn-flat btn-white ">
                        <i class="text-seatrium-blue fas fa-hard-hat"></i> &nbsp;Foreman Fighter
                      </a>
                    </div>
                  </div>
                <?php endif; ?>
                <div class="col-md-auto text-center topbar-menu">
                  <div class="btn-group">
                    <a href="<?php echo base_url(); ?>master/area/area_list" class="btn btn-flat btn-white ">
                      <i class="text-seatrium-blue fas fa-database"></i> &nbsp;Master Data
                    </a>
                  </div>
                </div>

                <?php if ($this->permission_cookie[112] == '1' or $this->permission_cookie[107] == '1' or $this->permission_cookie[117] == '1') { ?>
                  <div class="col-md-auto text-center topbar-menu">
                    <div class="btn-group">
                      <a href="#" class="btn btn-flat btn-white  nav-link" id="fabrication" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="text-seatrium-blue fas fa-list-ol"></i> &nbsp;Register &nbsp;<i class="text-seatrium-blue fas fa-caret-down"></i>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="fabrication">
                        <?php if ($this->permission_cookie[112] == '1') { ?>
                          <a class="dropdown-item" href="<?php echo base_url(); ?>master/wps/wps_list"><i class="text-seatrium-blue fas fa-caret-right"></i> WPS Register</a>
                        <?php } ?>
                        <?php if ($this->permission_cookie[107] == '1') { ?>
                          <a class="dropdown-item" href="<?php echo base_url(); ?>master/welder/welder_list"><i class="text-seatrium-blue fas fa-caret-right"></i> Welder Register</a>
                        <?php } ?>
                        <?php if ($this->permission_cookie[117] == '1') { ?>
                          <a class="dropdown-item" href="<?php echo base_url(); ?>master/fitter/fitter_list"><i class="text-seatrium-blue fas fa-caret-right"></i> Fitter Register</a>
                        <?php } ?>
                        <?php if ($this->user_cookie[11] == 1) { ?>
                          <?php if ($this->permission_cookie[56] == '1') { ?>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>master/ndter/personnel_list"><i class="text-seatrium-blue fas fa-caret-right"></i> NDT Personnel Register</a>
                          <?php } ?>
                        <?php } ?>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>master/bonder/bonder_list"><i class="text-seatrium-blue fas fa-caret-right"></i> Bonder Register</a>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-2 text-center text-right tab-user">
          <div class="dropdown w-100">
            <div class="btn-group">

              <button type="button" class="btn text-white rounded" style="background-color: #012bb3">
                <i class="text-seatrium-blue fa fa-user text-white"></i> &nbsp; <?php echo @$this->user_cookie[1]; ?>
                &nbsp; <i class="text-seatrium-blue fa fa-caret-down text-white"></i>
              </button>
              &nbsp;
              &nbsp;

              <button type="button" class="btn notificationx rounded" style="color: #012bb3; background-color: white;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="text-seatrium-blue fa fa-bell" aria-hidden="true"></i>
                <i class="text-seatrium-blue fa fa-caret-down" aria-hidden="true"></i>

                <span class="badgex <?= @get_notification()[0]['total_unread']+0 <= 0 ? "d-none" : null ?>" id='total_notification'><?php echo @get_notification()[0]['total_unread']+0; ?></span>

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

        <div class="col-12">&nbsp;</div>

        <div class="col-12 text-center ">
          <div class="col-md-12 row text-center">
            <div class="col-12 align-items-center" style="display: block ruby; position: absolute;">
              <?php $this->load->view('_partial/breadcump'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>








  <!-- </div> -->
  <!-- <nav class="sticky-top py-1 bg-green-smoe container-fluid">
		<div class="row align-items-center" id="topbar-mobile">
		</div>
	</nav> -->

  <style>
    .border-mobile {
      border-bottom: 1px solid #dee2e6
    }

    #topmenu .col-md-auto:nth-child(1) .border-mobile {
      border-top: 1px solid #dee2e6
    }
  </style>
  <script>

let mobile_row   = ''
    $("#topbar-desktop .topbar-menu").each((v, i) => {

      console.log($(i).html())
      mobile_row    += '<div class=" col-md-12 topbar-menu text-left">'
      mobile_row    += $(i).html()
      mobile_row    += `</div>`
    })
    let mobile_menu = `<div class="row">`
    mobile_menu    += mobile_row
    mobile_menu    += `</div>`

    $("#menu_mobile").html(mobile_menu)

    function showDesktopMenu() {
      var sidebar = $('.tab-menu-desktop')

      if (sidebar.css('display') == 'none') {

        sidebar.css("display", "block")
        $('.icon-menu-mobile').removeClass('fa-caret-down')
        $('.icon-menu-mobile').addClass('fa-caret-up')
        $('.topbar-menu').removeClass('text-center').addClass('text-left')
        $("#topbar-desktop").removeClass('rounded')
      } else {
        sidebar.css("display", "none")
        $('.icon-menu-mobile').addClass('fa-caret-down')
        $('.icon-menu-mobile').removeClass('fa-caret-up')
        $('.topbar-menu').removeClass('text-left').addClass('text-center')
        $("#topbar-desktop").addClass('rounded')
      }
    }

    function showSidebar() {
      var sidebar = $('.sidebar-foot')

      console.log(sidebar[0].classList)

      if (sidebar[0].classList.contains('d-none')) {
        sidebar.removeClass('d-none')
        $('.btn-sidebar').removeClass('fa-angle-double-up')
        $('.btn-sidebar').addClass('fa-angle-double-down')
        $('.div-sidebar').css("overflow-y", "auto")
        $('.content-sidebar').removeClass('margin-bottom-sb-10')
      } else {
        sidebar.addClass('d-none')
        $('.btn-sidebar').addClass('fa-angle-double-up')
        $('.btn-sidebar').removeClass('fa-angle-double-down')
        $('.div-sidebar').css("overflow-y", "hidden")
        $('.content-sidebar').addClass('margin-bottom-sb-10')
      }
    }

    function showFilter() {
      var sidebar = $('.tab-filter')

      console.log(sidebar[0].classList)

      if (sidebar[0].classList.contains('d-none')) {
        sidebar.removeClass('d-none')
        $('.icon-filter').addClass('fa-angle-double-up')
        $('.icon-filter').removeClass('fa-angle-double-down')
      } else {
        sidebar.addClass('d-none')
        $('.icon-filter').removeClass('fa-angle-double-up')
        $('.icon-filter').addClass('fa-angle-double-down')
      }
    }
  </script>