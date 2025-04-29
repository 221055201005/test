<style>
  .c-dashboardInfo {
    margin-bottom: 15px;
  }

  .c-dashboardInfo .wrap {
    background: #ffffff;
    box-shadow: 2px 10px 20px rgba(0, 0, 0, 0.1);
    border-radius: 7px;
    text-align: center;
    position: relative;
    overflow: hidden;
    padding: 40px 25px 20px;
    height: 100%;
  }

  .card_title_ds,
  .c-dashboardInfo__subInfo {
    color: #6c6c6c;
    font-size: 1.18em;
  }

  .c-dashboardInfo span {
    display: block;
  }

  .dashboard_info_card {
    font-weight: 600;
    font-size: 2.5em;
    line-height: 64px;
    color: #323c43;
  }

  .c-dashboardInfo .wrap:after {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 10px;
    content: "";
  }

  .c-dashboardInfo:nth-child(1) .wrap:after {
    background: linear-gradient(81.67deg, #29ba3a 0%, #94f29f 100%);
  }

  .c-dashboardInfo:nth-child(2) .wrap:after {
    background: linear-gradient(81.67deg, #42b3b3 0%, #68d4d4 100%);
  }

  .c-dashboardInfo:nth-child(3) .wrap:after {
    background: linear-gradient(81.67deg, #1a4da2 0%, #0084f4 100%);
  }

  .c-dashboardInfo:nth-child(4) .wrap:after {
    background: linear-gradient(81.67deg, #c94747 0%, #fa7e75 100%);
  }

  .card_title_ds svg {
    color: #d7d7d7;
    margin-left: 5px;
  }

  .MuiSvgIcon-root-19 {
    fill: currentColor;
    width: 1em;
    height: 1em;
    display: inline-block;
    font-size: 24px;
    transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
    user-select: none;
    flex-shrink: 0;
  }

  .bg_color_1 {
    background-color: #1995AD;
  }
</style>

<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h5 class="card-title text-center"><strong>Foreman Fighter Dashboard</strong></h5>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm justify-content-center">
          <div class="card-body p-2">
            <div class="row">
              <div class="col-md-3">
                <input type="date" name="date_activity" value="<?= date('Y-m-d') ?>" class="form-control form-control-sm">

              </div>
              <div class="col-md text-left">
                <button type="button" onclick="load_card_dashboard()" class="btn btn-sm btn-info"><i class="fas fa-search"></i> Filter</button>
              </div>

              <div class="col-md text-right">
                <span class="mt-1"><strong><i>Activity Date : <span class="date_text"><?= date('F d, Y') ?></span></i></strong></span>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 mt-3">
        <div class="row align-items-stretch">
          <div class="c-dashboardInfo col-lg col-md-6">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"><i class="fas fa-check-circle"></i> TOTAL WELDER ACTIVE</h4><span class="hind-font caption-12 dashboard_info_card total_active">0</span>
              <a data-status="<?= strtr($this->encryption->encrypt("welder_active"), '+=/', '.-~') ?>" href="#" onclick="go_to_detail(event, this)"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>
            </div>
          </div>

          <div class="c-dashboardInfo col-lg col-md-6">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"><i class="fas fa-users"></i> TOTAL WELDER AVAILABLE</h4><span class="hind-font caption-12 dashboard_info_card total_available">0</span>
              <a data-status="<?= strtr($this->encryption->encrypt("welder_available"), '+=/', '.-~') ?>" href="#" onclick="go_to_detail(event, this)"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>
            </div>
          </div>
          <div class="c-dashboardInfo col-lg col-md-6">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"><i class="fas fa-tasks"></i> TOTAL WELDER ASSIGNED</h4><span class="hind-font caption-12 dashboard_info_card total_assigned">0</span>
              <a data-status="<?= strtr($this->encryption->encrypt("welder_assigned"), '+=/', '.-~') ?>" href="#" onclick="go_to_detail(event, this)"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>
            </div>
          </div>

          <div class="c-dashboardInfo col-lg col-md-6">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"><i class="fas fa-times-circle"></i> TOTAL WELDER NOT ASSIGNED</h4><span class="hind-font caption-12 dashboard_info_card total_not_assigned">0</span>

              <a data-status="<?= strtr($this->encryption->encrypt("welder_not_assigned"), '+=/', '.-~') ?>" href="#" onclick="go_to_detail(event, this)"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>

            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-header text-white bg_color_1">
            <h6 class="card-title text-center p-0 m-0"><strong>Weekly Welder Activity</strong></h6>
          </div>
          <div class="card-body">

            <div class="row">
              <div class="col-md-6">
                <div id="weekly_welder" style="min-height:35vh"></div>
              </div>
              <div class="col-md-6">
                <div id="weekly_welder_not_assign" style="min-height:35vh"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-header text-white bg_color_1">
            <h6 class="card-title text-center p-0 m-0"><strong>Weekly Foreman Activity</strong></h6>
          </div>
          <div class="card-body">

            <div class="row">
              <div class="col-md-12">
                <div id="weekly_foreman" style="min-height:35vh"></div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-header text-white bg_color_1">
            <h6 class="card-title text-center p-0 m-0"><strong>Weekly Supervisor Activity</strong></h6>
          </div>
          <div class="card-body">

            <div class="row">
              <div class="col-md-12">
                <div id="weekly_spv" style="min-height:35vh"></div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</div>
</div>

<script>
  load_card_dashboard()

  function load_card_dashboard() {
    $('.dashboard_info_card').html(spinner())

    let date_activity = $('input[name="date_activity"]').val()
    let date_text = new Date(date_activity).toLocaleString('en-us', {
      day: '2-digit',
      month: 'long',
      year: 'numeric'
    })

    $('.date_text').text(date_text)

    $.ajax({
      url: "<?= site_url('welder_activity/load_count_dashboard') ?>",
      type: "POST",
      data: {
        date_filter: $('input[name="date_activity"]').val()
      },
      dataType: "JSON",
      success: (data) => {
        $('.total_active').html(data.total_welder_active)
        $('.total_assigned').html(data.total_assigned)
        $('.total_available').html(data.total_available)
        $('.total_not_assigned').html(data.total_not_assigned)
      }
    })
  }

  function spinner() {
    return `
    <div class="container text-center h-100">
      <div class="row align-items-center h-100">
        <div class="col-md-12">
          <div class="spinner-border text-success" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      </div>
    </div>
    `
  }

  load_weekly_welder()
  load_weekly_welder_not_assigned()

  function load_weekly_welder() {

    $("#weekly_welder").html(spinner())

    $.ajax({
      url: "<?= site_url('welder_activity/load_weekly_welder') ?>",
      type: "POST",
      success: (data) => {
        $("#weekly_welder").html(data)
      }
    })

  }

  function load_weekly_welder_not_assigned() {

    $("#weekly_welder_not_assign").html(spinner())

    $.ajax({
      url: "<?= site_url('welder_activity/load_weekly_welder_not_assigned') ?>",
      type: "POST",
      success: (data) => {
        $("#weekly_welder_not_assign").html(data)
      }
    })

  }

  load_weekly_foreman()

  function load_weekly_foreman() {
    $("#weekly_foreman").html(spinner())

    $.ajax({
      url: "<?= site_url('welder_activity/foreman_weekly_summary') ?>",
      type: "POST",
      success: (data) => {
        $("#weekly_foreman").html(data)
      }
    })
  }

  load_weekly_spv()

  function load_weekly_spv() {
    $("#weekly_spv").html(spinner())

    $.ajax({
      url: "<?= site_url('welder_activity/spv_weekly_summary') ?>",
      type: "POST",
      success: (data) => {
        $("#weekly_spv").html(data)
      }
    })
  }

  function go_to_detail(event, btn) {
    event.preventDefault()
    let status = $(btn).data('status')
    let date_activity = $('input[name="date_activity"]').val()

    window.open("<?= site_url('welder_activity/detail_dashboard_daily/?status=') ?>" + status + '&date_activity=' + date_activity, '_blank')

  }
</script>