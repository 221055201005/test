<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>
    
    <div class="card-body bg-white overflow-auto">
      <form action="<?php echo base_url() ?>planning/plan_target_new_process" method="POST">
        <div class="row">
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
              <div class="col-md">

                <select class="form-control project" name="project" required>
                  <option value="">---</option>
                  <?php foreach ($project_list as $key => $value) : ?>
                  <option value="<?php echo $value['id'] ?>"><?php echo $value['project_name'] ?></option>
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
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['code']." - ".$value['name'] ?></option>
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

                <select class="form-control discipline" name="discipline" >
                  <option value="">---</option>
                  <?php foreach ($discipline_list as $key => $value) : ?>
                  <option value="<?php echo $value['id'] ?>"><?php echo $value['discipline_name'] ?></option>
                  <?php endforeach; ?>
                </select>

              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Phase</label>
              <div class="col-md">

                <select class="form-control phase" name="phase" >
                  <option value="">---</option>

                  <option value="FB">FB</option>
                  <option value="AS">AS</option>
                  <option value="ER">ER</option>

                </select>

              </div>
            </div>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">From</label>
              <div class="col-md">
                <input type="date" class="form-control" name="date_from" onchange="calculate_period()" required>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">To</label>
              <div class="col-md">
                <input type="date" class="form-control" name="date_to" onchange="calculate_period()" required>
              </div>
            </div>
          </div>
        </div> -->
        <div class="row">
          <!-- <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Period</label>
              <div class="col-md">
                <input type="text" class="form-control" name="period" readonly>
              </div>
            </div>
          </div> -->
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Date</label>
              <div class="col-md">
                <input type="date" class="form-control" name="date_target" required>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Target Progress(%)</label>
              <div class="col-md">
                <input type="number" class="form-control" name="progress" required>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-right">
            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
          </div>
        </div>
        <?php
          // $week = date("W");
          // echo "Week ".$week."<br>";
          // $week_start = new DateTime();
          // $week_start->setISODate(date("Y"),$week);
          // echo $week_start->format('Y-m-d')."<br>";
          // $week_finish = date("Y-m-d", strtotime($week_start->format('Y-m-d')." +6 days"));
          // echo $week_finish;
        ?>
      </form>
    </div>
  </div>

</div>
</div>
<script>
  function calculate_period() {
    var date_from = $("input[name=date_from]").val();
    var date_to = $("input[name=date_to]").val();

    $.ajax( {
      url: "<?php echo base_url() ?>planning/calculate_period",
      dataType: "json",
      type: "post",
      data: {
        date_from: date_from,
        date_to: date_to,
        year: "<?php echo date("Y") ?>",
      },
      success: function( data ) {
        console.log(data);
        $("input[name=period]").val(data)
      }
    });
  }
</script>