<?php
  if(@$project == ''){
    $project = $this->user_cookie[10];
  }
?>

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
    padding: 20px 15px 10px;
    height: 100%;
  }

  .card_title_ds,
  .c-dashboardInfo__subInfo {
    color: #6c6c6c;
    font-size: 0.9em;
    font-weight: bold;
  }

  .c-dashboardInfo span {
    display: block;
  }

  .dashboard_info_card {
    font-weight: 600;
    font-size: 2em;
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

  .checklist .wrap:after {
    background: linear-gradient(81.67deg, #98edc2 0%, #79d1a5 100%);
  }

  .open .wrap:after {
    background: linear-gradient(81.67deg, #e3e3e3 0%, #a1a1a1 100%);
  }

  .inprogress .wrap:after {
    background: linear-gradient(81.67deg, #fff2cc 0%, #e6c877 100%);
  }

  .completed_pmt .wrap:after {
    background: linear-gradient(81.67deg, #e5f7c3 0%, #bfd98f 100%);
  }

  .pending_qc .wrap:after {
    background: linear-gradient(81.67deg, #1a4da2 0%, #0084f4 100%);
  }

  .rejected_qc .wrap:after {
    background: linear-gradient(81.67deg, #c94747 0%, #d67a7a 100%);
  }

  .approved_qc .wrap:after {
    background: linear-gradient(81.67deg, #1a4da2 0%, #0084f4 100%);
  }

  .client_invitation .wrap:after {
    background: linear-gradient(69.83deg, #0084f4 0%, #00c48c 100%);
  }

  .punch_client .wrap:after {
    background: linear-gradient(69.83deg, #6166f2 0%, #878ad6 100%);
  }

  .approved_client .wrap:after {
    background: linear-gradient(82.59deg, #84d194 0%, #47c462 100%);
  }

  .completed .wrap:after {
    background: linear-gradient(82.59deg, #00c48c 0%, #00a173 100%);
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
</style>

<div id="content">
  <div class="container-fluid">
		<?php if(count($this->user_cookie[13]) > 1): ?>
			<div class="row">
				<div class="col-md">
				</div>
				<div class="col-md-auto">
					<select class="form-control" name="project" onchange="window.location = '<?= base_url() ?>mechanical_completion/mechanical_completion_dashboard/'+this.value">
						<?php foreach ($project_list as $key => $value): ?>
							<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
								<option value="<?= strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>" <?= ($project == $value['id'] ? 'selected' : '') ?>><?= $value['project_name'] ?></option>
							<?php endif; ?>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<br>
		<?php endif; ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title text-center"><strong>Mechanical Completion - Overall</strong></h6>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="row align-items-stretch">

          <div class="c-dashboardInfo col-lg col-md-6 checklist">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"><i class="fas fa-check-circle"></i> CHECKLIST</h4>
              <span class="hind-font caption-12 dashboard_info_card card_all total_checklist">0</span>
              <a href="<?= site_url('mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("all"), '+=/', '.-~')) ?>" target="_blank"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>
            </div>
          </div>

          <div class="c-dashboardInfo col-lg col-md-6 open">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"><i class="fas fa-folder-open"></i> OPEN</h4>
              <span class="hind-font caption-12 dashboard_info_card card_all total_draft">0</span>
              <a href="<?= site_url('mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("0"), '+=/', '.-~')) ?>" target="_blank"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>
            </div>
          </div>

          <div class="c-dashboardInfo col-lg col-md-6 inprogress">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"><i class="fas fa-tasks"></i> DRAFTING DOCUMENT</h4>
              <span class="hind-font caption-12 dashboard_info_card card_all total_inprogress">0</span>
              <a href="<?= site_url('mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("1"), '+=/', '.-~')) ?>" target="_blank"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>
            </div>
          </div>


          <div class="c-dashboardInfo col-lg col-md-6 pending_qc">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"><i class="fas fa-hourglass-half"></i> COMPLETED PMT & PENDING QC</h4><span class="hind-font caption-12 dashboard_info_card card_all total_pending">0</span>
              <a href="<?= site_url('mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("2|3"), '+=/', '.-~')) ?>" target="_blank"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>
            </div>
          </div>


        </div>
      </div>
      <div class="col-md-12">
        <div class="row align-items-strech">

          <div class="c-dashboardInfo col-lg col-md-6 rejected_qc">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"><i class="fas fa-times"></i> REJECTED QC</h4><span class="hind-font caption-12 dashboard_info_card card_all total_rejected">0</span>
              <a href="<?= site_url('mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("7"), '+=/', '.-~')) ?>" target="_blank"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>
            </div>
          </div>

          <div class="c-dashboardInfo col-lg col-md-6 approved_qc">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"><i class="fas fa-check"></i> APPROVED QC</h4><span class="hind-font caption-12 dashboard_info_card card_all total_approved">0</span>
              <a href="<?= site_url('mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("6"), '+=/', '.-~')) ?>" target="_blank"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>
            </div>
          </div>

          <div class="c-dashboardInfo col-lg col-md-6 client_invitation">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"> <i class="fas fa-bell"></i> CLIENT INVITATION</h4><span class="hind-font caption-12 dashboard_info_card card_all total_invitation">0</span>
              <a href="<?= site_url('mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("4|10"), '+=/', '.-~')) ?>" target="_blank"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>
            </div>
          </div>

          <div class="c-dashboardInfo col-lg col-md-6 approved_client">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"><i class="fas fa-check-square"></i> APPROVED BY CLIENT & COMPLETED</h4><span class="hind-font caption-12 dashboard_info_card card_all total_approved_client">0</span>
              <a href="<?= site_url('mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("9"), '+=/', '.-~')) ?>" target="_blank"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <h6 class="card-title text-center mb-3"><strong>Mechanical Completion - Discipline</strong></h6>
              </div>
              <div class="col-md float-right">
                <select onchange="load_filter_data()" name="discipline" class="select2 select-sm input-sm" style="width:100%">
                  <option value="">Discipline (Overall)</option>
                  <?php foreach ($discipline_list as $key => $value) : ?>
                    <option value="<?= $value['id'] ?>"><?= $value['mc_code'] ?> (<?= $value['discipline_name'] ?>)</option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md float-right">
                <select onchange="load_filter_data()" name="system" class="select2 select-sm input-sm" style="width:100%">
                  <option value="">System (Overall)</option>
                  <?php foreach ($system_list as $key => $value) : ?>
                    <option value="<?= $value['system'] ?>"><?= $value['system'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md float-right">
                <select onchange="load_filter_data()" name="subsystem" class="select2 select-sm input-sm" style="width:100%">
                  <option value="">Subsystem (Overall)</option>
                  <?php foreach ($subsystem_list as $key => $value) : ?>
                    <option value="<?= $value['subsystem'] ?>"><?= $value['subsystem'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="row align-items-stretch">

          <div class="c-dashboardInfo col-lg col-md-6 checklist">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"><i class="fas fa-check-circle"></i> CHECKLIST</h4>
              <span class="hind-font caption-12 dashboard_info_card card_filter total_checklist_filter">0</span>
              <a data-status="<?= strtr($this->encryption->encrypt("all"), '+=/', '.-~') ?>" href="#" onclick="go_to_detail(event, this)"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>
            </div>
          </div>


          <div class="c-dashboardInfo col-lg col-md-6 open">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"><i class="fas fa-folder-open"></i> OPEN</h4>
              <span class="hind-font caption-12 dashboard_info_card card_filter total_draft_filter">0</span>
              <a data-status="<?= strtr($this->encryption->encrypt("0"), '+=/', '.-~') ?>" href="#" onclick="go_to_detail(event, this)"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>
            </div>
          </div>


          <div class="c-dashboardInfo col-lg col-md-6 inprogress">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"><i class="fas fa-tasks"></i> DRAFTING DOCUMENT</h4>
              <span class="hind-font caption-12 dashboard_info_card card_filter total_inprogress_filter">0</span>
              <a data-status="<?= strtr($this->encryption->encrypt("1"), '+=/', '.-~') ?>" href="#" onclick="go_to_detail(event, this)"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>
            </div>
          </div>

          <div class="c-dashboardInfo col-lg col-md-6 pending_qc">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"><i class="fas fa-hourglass-half"></i> COMPLETED PMT & PENDING QC</h4><span class="hind-font caption-12 dashboard_info_card card_filter total_pending_filter">0</span>
              <a data-status="<?= strtr($this->encryption->encrypt("2|3"), '+=/', '.-~') ?>" href="#" onclick="go_to_detail(event, this)"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>
            </div>
          </div>




        </div>
      </div>
      <div class="col-md-12">
        <div class="row align-items-stretch">
          

          <div class="c-dashboardInfo col-lg col-md-6 rejected_qc">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"><i class="fas fa-times"></i> REJECTED QC</h4><span class="hind-font caption-12 dashboard_info_card card_filter total_rejected_filter">0</span>
              <a data-status="<?= strtr($this->encryption->encrypt("7"), '+=/', '.-~') ?>" href="#" onclick="go_to_detail(event, this)"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>
            </div>
          </div>

          <div class="c-dashboardInfo col-lg col-md-6 approved_qc">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"><i class="fas fa-check"></i> APPROVED QC</h4><span class="hind-font caption-12 dashboard_info_card card_filter total_approved_filter">0</span>
              <a data-status="<?= strtr($this->encryption->encrypt("6"), '+=/', '.-~') ?>" href="#" onclick="go_to_detail(event, this)"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>
            </div>
          </div>

          <div class="c-dashboardInfo col-lg col-md-6 client_invitation">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"><i class="fas fa-bell"></i> CLIENT INVITATION</h4><span class="hind-font caption-12 dashboard_info_card card_filter total_invitation_filter">0</span>
              <a data-status="<?= strtr($this->encryption->encrypt("4|10"), '+=/', '.-~') ?>" href="#" onclick="go_to_detail(event, this)"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>
            </div>
          </div>

          <div class="c-dashboardInfo col-lg col-md-6 approved_client">
            <div class="wrap">
              <h4 class="heading heading5 hind-font medium-font-weight card_title_ds"><i class="fas fa-check-square"></i> APPROVED BY CLIENT & COMPLETED</h4><span class="hind-font caption-12 dashboard_info_card card_filter total_approved_client_filter">0</span>
              <a data-status="<?= strtr($this->encryption->encrypt("9"), '+=/', '.-~') ?>" href="#" onclick="go_to_detail(event,this)"><span style="font-size : 12px" class="text-secondary"> <strong>More Detail <i class="fas fa-arrow-right"></i></strong></span></a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</div>

<script>
  load_overall_data()
  load_filter_data()

  function load_overall_data() {

    $(".card_filter").html(spinner())
    $(".card_all").html(spinner())

    $.ajax({
      url: "<?= site_url('mechanical_completion/load_data_dashboard') ?>",
      type: "POST",
      data: {
        project: <?= $project ?>,
      },
      dataType: "JSON",
      success: (data) => {
        $('.total_draft').html(data.total_draft)
        $('.total_pending').html(parseInt(data.total_pending_qc) + parseInt(data.total_completed_pmt))
        $('.total_invitation').html(parseInt(data.total_invite_client) + parseInt(data.total_review_document_client))
        $('.total_approved').html(data.total_approved_qc)
        $('.total_rejected').html(data.total_rejected_qc)
        $('.total_approved_client').html(data.total_approved_client)
        $('.total_checklist').html(data.total_all)
        $('.total_inprogress').html(data.total_inprogress)

        // $('.total_draft_filter').html(data.total_draft)
        // $('.total_pending_filter').html(data.total_pending_qc)
        // $('.total_invitation_filter').html(data.total_invite_client)
        // $('.total_completed_filter').html(data.total_completed)
        // $('.total_approved_filter').html(data.total_approved_qc)

        // $('.total_checklist_filter').html(data.total_all)
        // $('.total_inprogress_filter').html(data.total_inprogress)
        // $('.total_completed_pmt_filter').html(data.total_completed_pmt)
      }

    })
  }

  function load_filter_data() {
    $(".card_filter").html(spinner())

    let discipline = $('select[name="discipline"]').val()
    let system = $('select[name="system"]').val()
    let subsystem = $('select[name="subsystem"]').val()

    $.ajax({
      url: "<?= site_url('mechanical_completion/load_data_dashboard') ?>",
      type: "POST",
      data: {
        discipline: discipline,
        system: system,
        subsystem: subsystem,
        project: <?= $project ?>,
      },
      dataType: "JSON",
      success: (data) => {
        $('.total_draft_filter').html(data.total_draft)
        $('.total_pending_filter').html(parseInt(data.total_pending_qc) + parseInt(data.total_completed_pmt))
        $('.total_invitation_filter').html(parseInt(data.total_invite_client) + parseInt(data.total_review_document_client))
        $('.total_approved_filter').html(data.total_approved_qc)
        $('.total_rejected_filter').html(data.total_rejected_qc)
        $('.total_checklist_filter').html(data.total_all)
        $('.total_inprogress_filter').html(data.total_inprogress)
        $('.total_approved_client_filter').html(data.total_approved_client)
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

  function go_to_detail(e, btn) {
    e.preventDefault()

    let status = $(btn).data('status')
    let discipline = $('select[name="discipline"]').val()
    let system = $('select[name="system"]').val()
    let subsystem = $('select[name="subsystem"]').val()


    window.open("<?= site_url('mechanical_completion/detail_status_mc/?status=') ?>" + status + '&discipline=' + discipline + '&system=' + system + '&subsystem=' + subsystem, '_blank');

  }
</script>