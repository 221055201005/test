<div class="table-responsive overflow-auto">
  <table class="table table-bordered text-center">
    <tbody>
      <tr class="font-weight-bold text-center header-percentage">
        <th style="vertical-align: middle !important;" rowspan="2">S/N</th>
        <th style="vertical-align: middle !important;" rowspan="2">DECK ELEVATON</th>
        <th style="vertical-align: middle !important;" rowspan="2">TOTAL PIECEMARK</th>
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

      $no             = 1;
      $total_all_data = [];
      foreach ($deck_list as $key => $value) : ?>
        <?php

        $total_pc_approved_qc   = @$total_pc_mv[$value['id']]["approved_by_qc"] + 0;
        $total_pc_pending_qc    = @$total_pc_mv[$value['id']]["pending_approval"] + 0;
        $total_pc_outstanding   = @$total_pc_mv[$value['id']]["outstanding_resubmit"] + 0;
        $total_pc_waiting       = @$total_pc_mv[$value['id']]["waiting_submit"] + 0;
        $total_all_pc           = @$total_pc[$value['id']] + 0;

        @$total_all_data["all_pc"] += $total_all_pc;
        @$total_all_data["all_approved_pc"] += $total_pc_approved_qc;
        @$total_all_data["all_pending_pc"] += $total_pc_pending_qc;
        @$total_all_data["all_outstanding_pc"] += $total_pc_outstanding;
        @$total_all_data["all_waiting_pc"] += $total_pc_waiting;

        if ($total_all_pc == 0) {
          $percentage         = 0;
        } else {
          $percentage           = ($total_pc_approved_qc / $total_all_pc) * 100;
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
          <td><?= $total_all_pc ?></td>
          <td><?= $total_pc_approved_qc ?></td>
          <td><?= $total_pc_pending_qc ?></td>
          <td><?= $total_pc_outstanding ?></td>
          <td><?= $total_pc_waiting ?></td>
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

      if (intval($total_all_data["all_pc"]) == 0) {
        $percentage         = 0;
      } else {
        $percentage           = (intval($total_all_data["all_approved_pc"]) / intval($total_all_data["all_pc"])) * 100;
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
        <td><?= @$total_all_data["all_pc"] + 0 ?></td>
        <td><?= @$total_all_data["all_approved_pc"] + 0 ?></td>
        <td><?= @$total_all_data["all_pending_pc"] + 0 ?></td>
        <td><?= @$total_all_data["all_outstanding_pc"] + 0 ?></td>
        <td><?= @$total_all_data["all_waiting_pc"] + 0 ?></td>
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