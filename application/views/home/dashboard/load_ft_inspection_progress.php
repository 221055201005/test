<div class="table-responsive overflow-auto">
  <table class="table table-bordered text-center">
    <tbody>
      <tr class="font-weight-bold text-center header-percentage">
        <th style="vertical-align: middle !important;" rowspan="2">S/N</th>
        <th style="vertical-align: middle !important;" rowspan="2">DECK ELEVATON</th>
        <th style="vertical-align: middle !important;" rowspan="2">TOTAL JOINTS</th>
        <th style="vertical-align: middle !important;" rowspan="2">TOTAL WELD LENGTH (mm)</th>
        <th style="vertical-align: middle !important;" colspan="4">INSPECTION STATUS</th>
        <th style="vertical-align: middle !important;" rowspan="2">% PROGRESS INSPECTION</th>
        <th style="vertical-align: middle !important;" rowspan="2">% REMARKS</th>
      </tr>
      <tr class="font-weight-bold text-center header-percentage">
        <th>Approved by QC</th>
        <th>Pending Approval QC</th>
        <th>Outstanding Re-Submit</th>
        <th>Waiting Submit</th>
      </tr>
      <?php
      $no = 1;
      $total_all_data = [];
      foreach ($deck_list as $key => $value) : ?>
        <?php

        $total_lg_qc          = @$total_length_ft[$value['id']]["approved_by_qc"] + 0;
        $total_lg_pending_qc    = @$total_length_ft[$value['id']]["pending_approval"] + 0;
        $total_lg_outstanding   = @$total_length_ft[$value['id']]["outstanding_resubmit"] + 0;
        $total_lg_waiting       = @$total_length_ft[$value['id']]["waiting_submit"] + 0;

        $total_all_wl         = @$total_weld_length[$value['id']] + 0;
        $total_all_jt         = @$total_jt[$value['id']] + 0;

        @$total_all_data["all_jt"] += $total_all_jt;
        @$total_all_data["all_lg"] += $total_all_wl;
        @$total_all_data["all_approved_lg"] += $total_lg_qc;
        @$total_all_data["all_pending_lg"] += $total_lg_pending_qc;
        @$total_all_data["all_outstanding_lg"] += $total_lg_outstanding;
        @$total_all_data["all_waiting_lg"] += $total_lg_waiting;

        if ($total_all_wl == 0) {
          $percentage         = 0;
        } else {
          $percentage           = ($total_lg_qc / $total_all_wl) * 100;
          $percentage           = round($percentage, 2);
        }

        if ($percentage >= 0 && $percentage <= 25) {
          $bg_class = 'bg-danger';
        } elseif ($percentage >= 26 && $percentage <= 50) {
          $bg_class = 'bg-warning';
        } elseif ($percentage >= 51 && $percentage <= 75) {
          $bg_class = 'bg-info';
        } else {
          $bg_class = 'bg-success';
        }

        ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $value['name'] ?></td>
          <td><?= $total_all_jt ?></td>
          <td><?= $total_all_wl ?></td>
          <td><?= $total_lg_qc ?></td>
          <td><?= $total_lg_pending_qc ?></td>
          <td><?= $total_lg_outstanding ?></td>
          <td><?= $total_lg_waiting ?></td>
          <td>
            <div class="progress">
              <div class="progress-bar <?= $bg_class ?> progress-bar-striped progress-bar-animated font-weight-bold" role="progressbar" aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentage ?>%"><?= $percentage ?>%</div>
            </div>
          </td>
          <td>

          </td>
        </tr>
      <?php endforeach; ?>
      <?php

      if (intval($total_all_data["all_jt"]) == 0) {
        $percentage         = 0;
      } else {
        $percentage           = ($total_all_data["all_approved_lg"] / $total_all_data["all_lg"]) * 100;
        $percentage           = round($percentage, 2);
      }

      if ($percentage >= 0 && $percentage <= 25) {
        $bg_class = 'bg-danger';
      } elseif ($percentage >= 26 && $percentage <= 50) {
        $bg_class = 'bg-warning';
      } elseif ($percentage >= 51 && $percentage <= 75) {
        $bg_class = 'bg-info';
      } else {
        $bg_class = 'bg-success';
      }

      ?>
      <tr class="font-weight-bold h6 header-percentage-footer">
        <td colspan="2">GRAND TOTAL</td>
        <td><?= @$total_all_data["all_jt"] + 0 ?></td>
        <td><?= @$total_all_data["all_lg"] + 0 ?></td>
        <td><?= @$total_all_data["all_approved_lg"] + 0 ?></td>
        <td><?= @$total_all_data["all_pending_lg"] + 0 ?></td>
        <td><?= @$total_all_data["all_outstanding_lg"] + 0 ?></td>
        <td><?= @$total_all_data["all_waiting_lg"] + 0 ?></td>
        <td>
          <div class="progress">
            <div class="progress-bar <?= $bg_class ?> progress-bar-striped progress-bar-animated font-weight-bold" role="progressbar" aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentage ?>%"><?= $percentage ?>%</div>
          </div>
        </td>
        <td></td>
      </tr>

    </tbody>
  </table>
</div>
<hr>

<?php foreach ($class_list as $class) : ?>
  <div class="table-responsive overflow-auto">
    <h6 class="card-title font-weight-bold"> Class #<?= $class['class_name'] ?></h6>
    <table class="table table-bordered text-center">
      <tbody>
        <tr class="font-weight-bold text-center header-percentage">
          <th style="vertical-align: middle !important;" rowspan="2">S/N</th>
          <th style="vertical-align: middle !important;" rowspan="2">DECK ELEVATON</th>
          <th style="vertical-align: middle !important;" rowspan="2">TOTAL JOINTS</th>
          <th style="vertical-align: middle !important;" rowspan="2">TOTAL WELD LENGTH (mm)</th>
          <th style="vertical-align: middle !important;" colspan="4">INSPECTION STATUS</th>
          <th style="vertical-align: middle !important;" rowspan="2">% PROGRESS INSPECTION</th>
          <th style="vertical-align: middle !important;" rowspan="2">% REMARKS</th>
        </tr>
        <tr class="font-weight-bold text-center header-percentage">
          <th>Approved by QC</th>
          <th>Pending Approval QC</th>
          <th>Outstanding Re-Submit</th>
          <th>Waiting Submit</th>
        </tr>
        <?php
        $no = 1;
        $total_all_data = [];
        foreach ($deck_list as $key => $value) : ?>
          <?php

          $total_lg_qc            = @$total_length_ft_by_class[$value['id']][$class['id']]["approved_by_qc"] + 0;
          $total_lg_pending_qc    = @$total_length_ft_by_class[$value['id']][$class['id']]["pending_approval"] + 0;
          $total_lg_outstanding   = @$total_length_ft_by_class[$value['id']][$class['id']]["outstanding_resubmit"] + 0;
          $total_lg_waiting       = @$total_length_ft_by_class[$value['id']][$class['id']]["waiting_submit"] + 0;

          $total_all_wl         = @$total_weld_length_by_class[$value['id']][$class['id']] + 0;
          $total_all_jt         = @$total_jt_by_class[$value['id']][$class['id']] + 0;

          @$total_all_data["all_jt"] += $total_all_jt;
          @$total_all_data["all_lg"] += $total_all_wl;
          @$total_all_data["all_approved_lg"] += $total_lg_qc;
          @$total_all_data["all_pending_lg"] += $total_lg_pending_qc;
          @$total_all_data["all_outstanding_lg"] += $total_lg_outstanding;
          @$total_all_data["all_waiting_lg"] += $total_lg_waiting;


          if ($total_all_wl == 0) {
            $percentage         = 0;
          } else {
            $percentage           = ($total_lg_qc / $total_all_wl) * 100;
            $percentage           = round($percentage, 2);
          }

          if ($percentage >= 0 && $percentage <= 25) {
            $bg_class = 'bg-danger';
          } elseif ($percentage >= 26 && $percentage <= 50) {
            $bg_class = 'bg-warning';
          } elseif ($percentage >= 51 && $percentage <= 75) {
            $bg_class = 'bg-info';
          } else {
            $bg_class = 'bg-success';
          }

          ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $value['name'] ?></td>
            <td><?= $total_all_jt ?></td>
            <td><?= $total_all_wl ?></td>
            <td><?= $total_lg_qc ?></td>
            <td><?= $total_lg_pending_qc ?></td>
            <td><?= $total_lg_outstanding ?></td>
            <td><?= $total_lg_waiting ?></td>
            <td>
              <div class="progress">
                <div class="progress-bar <?= $bg_class ?> progress-bar-striped progress-bar-animated font-weight-bold" role="progressbar" aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentage ?>%"><?= $percentage ?>%</div>
              </div>
            </td>
            <td>

            </td>
          </tr>
        <?php endforeach; ?>
        <?php

        if (intval($total_all_data["all_jt"]) == 0) {
          $percentage         = 0;
        } else {
          $percentage           = ($total_all_data["all_approved_lg"] / $total_all_data["all_lg"]) * 100;
          $percentage           = round($percentage, 2);
        }

        if ($percentage >= 0 && $percentage <= 25) {
          $bg_class = 'bg-danger';
        } elseif ($percentage >= 26 && $percentage <= 50) {
          $bg_class = 'bg-warning';
        } elseif ($percentage >= 51 && $percentage <= 75) {
          $bg_class = 'bg-info';
        } else {
          $bg_class = 'bg-success';
        }

        ?>
        <tr class="font-weight-bold h6 header-percentage-footer">
          <td colspan="2">GRAND TOTAL</td>
          <td><?= @$total_all_data["all_jt"] + 0 ?></td>
          <td><?= @$total_all_data["all_lg"] + 0 ?></td>
          <td><?= @$total_all_data["all_approved_lg"] + 0 ?></td>
          <td><?= @$total_all_data["all_pending_lg"] + 0 ?></td>
          <td><?= @$total_all_data["all_outstanding_lg"] + 0 ?></td>
          <td><?= @$total_all_data["all_waiting_lg"] + 0 ?></td>
          <td>
            <div class="progress">
              <div class="progress-bar <?= $bg_class ?> progress-bar-striped progress-bar-animated font-weight-bold" role="progressbar" aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentage ?>%"><?= $percentage ?>%</div>
            </div>
          </td>
          <td></td>
        </tr>

      </tbody>
    </table>
  </div>
<?php endforeach; ?>