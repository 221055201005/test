<style>
  .bg-success-dashboard{
    background-color: #20bf6b;
  }
</style>
<div id="content" class="container-fluid">
  <div class="bg-white p-3 shadow-sm">
    <h4 class="text-center font-weight-bold">Production & Quality Dashboard</h4>
    <?= $tabmenu ?>
  </div>
  <br/>

	<div class="row">
    <div class="col-md-12">
      <div class="card my-2 border-0 shadow-sm">
        <div class="card-body bg-white text-center p-2">
					<div id="container_workpacksummary" style="height: 100%; width: 100%;">
						<div class="text-center loading mt-4">
							<div class="spinner-border" role="status"></div>
						</div>
					</div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card my-2 border-0 shadow-sm">
        <div class="card-body bg-white text-center p-2">
					<div class="mx-auto overflow-auto height-card" id="table_workpack_pf">
						<table class="table table-sm table-bordered">
							<thead>
								<tr class="bg-success-dashboard text-white">
									<th colspan="2">Workpack Pre-Fabrication</th>
								</tr>
								<tr class="bg-success-dashboard text-white">
									<th>Status</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						<div class="text-center loading my-4">
							<div class="spinner-border" role="status"></div>
						</div>
					</div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card my-2 border-0 shadow-sm">
        <div class="card-body bg-white text-center p-2">
					<div class="mx-auto overflow-auto height-card" id="table_workpack_fb">
						<table class="table table-sm table-bordered">
							<thead>
								<tr class="bg-success-dashboard text-white">
									<th colspan="2">Workpack Fabrication</th>
								</tr>
								<tr class="bg-success-dashboard text-white">
									<th>Status</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						<div class="text-center loading my-4">
							<div class="spinner-border" role="status"></div>
						</div>
					</div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card my-2 border-0 shadow-sm">
        <div class="card-body bg-white text-center p-2">
					<div class="mx-auto overflow-auto height-card" id="table_workpack_as">
						<table class="table table-sm table-bordered">
							<thead>
								<tr class="bg-success-dashboard text-white">
									<th colspan="2">Workpack Assembly</th>
								</tr>
								<tr class="bg-success-dashboard text-white">
									<th>Status</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						<div class="text-center loading my-4">
							<div class="spinner-border" role="status"></div>
						</div>
					</div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card my-2 border-0 shadow-sm">
        <div class="card-body bg-white text-center p-2">
					<div class="mx-auto overflow-auto height-card" id="table_workpack_er">
						<table class="table table-sm table-bordered">
							<thead>
								<tr class="bg-success-dashboard text-white">
									<th colspan="2">Workpack Erection</th>
								</tr>
								<tr class="bg-success-dashboard text-white">
									<th>Status</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						<div class="text-center loading my-4">
							<div class="spinner-border" role="status"></div>
						</div>
					</div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script>
	var section = -1;
	$(document).ready(function(){
		loading_dashboard();
  });

	function loading_dashboard() {
		section++;
		if(section == 0){
			load_data_workpack_summary_new();
    }
		else if(section == 1){
			load_data_table_workpack_summary();
    }
	}

	function load_data_workpack_summary_new() {
    $.ajax({
      url: '<?php echo base_url() ?>home/load_data_workpack_summary_new',
      type: 'GET',
			data: {
				project: <?= ($this->input->get('project') ?? $this->user_cookie[10]) ?>,
				company: <?= ($this->input->get('company') ?? $this->user_cookie[11]) ?>,
			},
      async: true,
      dataType: "json",
      success: function (data) {
        generate_verticalbarchart("container_workpacksummary", data);
        loading_dashboard();
      }
    });
  }

	function load_data_table_workpack_summary() {
    $.ajax({
      url: '<?php echo base_url() ?>home/load_data_table_workpack_summary',
      type: 'GET',
			data: {
				project: <?= ($this->input->get('project') ?? $this->user_cookie[10]) ?>,
				company: <?= ($this->input->get('company') ?? $this->user_cookie[11]) ?>

			},
      async: true,
      dataType: "json",
      success: function (data) {
				// data = JSON.parse(data);
        $("#table_workpack_pf").find("tbody").html(data['PF']);
        $("#table_workpack_pf").find(".loading").addClass("d-none");
        $("#table_workpack_fb").find("tbody").html(data['FB']);
        $("#table_workpack_fb").find(".loading").addClass("d-none");
        $("#table_workpack_as").find("tbody").html(data['AS']);
        $("#table_workpack_as").find(".loading").addClass("d-none");
        $("#table_workpack_er").find("tbody").html(data['ER']);
        $("#table_workpack_er").find(".loading").addClass("d-none");
        loading_dashboard();
      }
    });
  }

	function generate_verticalbarchart(element, dataset) {
    Highcharts.chart(element, {
      credits: {
        enabled: false,
      },
      chart: {
        type: 'column'
      },
      title: {
        text: ''
      },
      xAxis: {
        categories: [
          'Workpack PF',
          'Workpack FB',
          'Workpack AS',
          'Workpack ER'
        ],
        crosshair: true
      },
      legend: {
        enabled: false,
      },
      yAxis: {
        min: 0,
        title: {
          text: 'Rainfall (mm)'
        },
        visible: false,
      },
      tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
          '<td style="padding:1"><b>{point.y:.0f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
      },
      plotOptions: {
        column: {
          pointPadding: 0.2,
          borderWidth: 0
        },
        series: {
          dataLabels: {
            enabled: true,
            crop: false,
            overflow: "none"
          }
        },
      },
      series: dataset
    });

  }
</script>