<?php

error_reporting(0);
if ($category == "second_to_primer") {
  $category_text = "Secondary to Primer + Deck Plate";
} else {
  $category_text = ucfirst($category);
}

?>

<style>
  .rotate {
    transform: rotate(90deg);
    -webkit-transform: rotate(90deg);
    -moz-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
  }

  th,
  td {
    vertical-align: middle !important;
  }
</style>

<div class="table-responsive overflow-auto">
  <table border="1" class="table table-hover table-bordered text-center">
    <tbody>
      <tr>
        <th colspan="<?= count($joint_type) + 21 ?>"><h5><strong><?= $category_text ?></strong></h5></th>
      </tr>
      <tr class="alert-primary">
        <th rowspan="2">Deck Elevation / Service Line</th>
        <th rowspan="2">Total Length</th>
        <th rowspan="2">Fitup Submission</th>
        <th rowspan="2">Fitup Approved</th>
        <th rowspan="2">Fitup Rejected</th>
        <th rowspan="2">Outstanding</th>
        <th rowspan="2">Percentange %</th>
        <th rowspan="2">Visual Submission</th>
        <th rowspan="2">Visual Approved</th>
        <th rowspan="2">Visual Rejected</th>
        <th rowspan="2">Outstanding</th>
        <th rowspan="2">Percentage &</th>
        <th rowspan="2">Complete Welding</th>
        <th colspan="<?= count($joint_type) ?>">Joint Type</th>
        <th colspan="4">MPI Status Based on Total Length Required MT</th>
        <th colspan="4">UT Status Based on Total Length Required UT</th>
      </tr>
      <tr class="alert-primary">
        <?php foreach ($joint_type as $v) : ?>
          <th><?= $v['weld_type_code'] ?></th>
        <?php endforeach; ?>
        <th>Need MT</th>
        <th>MT Done</th>
        <th>MT O/S</th>
        <th>Percentage %</th>
        <th>Need UT</th>
        <th>UT Done</th>
        <th>UT O/S</th>
        <th>Percentage %</th>
      </tr>
      <?php foreach ($deck_list as $value) : ?>
        <?php

        $need_mt = 0;

        if (in_array($category, ['special','primary'])) {
          $need_mt = floor(intval($join_list[$value['id']]['total_length']));
        } elseif ($category == "secondary") {
          $need_mt = floor((intval($join_list[$value['id']]['total_length']) * 5) / 100);
        } else {
          $need_mt = floor((intval($join_list[$value['id']]['total_length']) * 20) / 100);
        }

        $need_ut = 0;
        if (isset($total_need_ut[$value['id']])) {
          $need_ut = array_sum($total_need_ut[$value['id']]);
        }

        if (in_array($category, ['special','primary'])) {
          $need_ut = floor($need_ut);
        } elseif ($category == "secondary") {
          $need_ut = floor(($need_ut * 5) / 100);
        } else {
          // $need_ut = floor(($need_ut * 20) / 100);
          $need_ut = floor((array_sum($total_need_ut_wt[$value['id']]['bw']) * 10) / 100) + array_sum($total_need_ut_wt[$value['id']]['tfp']) + floor((array_sum($total_need_ut_wt[$value['id']]['tky']) * 10) / 100);
        }

        ?>
        <tr>
          <td><?= $value['name'] ?></td>
          <td><?= intval($join_list[$value['id']]['total_length']) ?></td>
          <td><?= intval($fitup[$value['id']]['total_length_submission']) ?></td>
          <td><?= intval($fitup[$value['id']]['total_length_approved']) ?></td>
          <td><?= intval($fitup[$value['id']]['total_length_reject']) ?></td>
          <td>
            <?= intval($join_list[$value['id']]['total_length']) - intval($fitup[$value['id']]['total_length_approved']) ?>
          </td>
          <td>
            <?php

            $percentage_fitup = (intval($fitup[$value['id']]['total_length_approved']) / intval($join_list[$value['id']]['total_length'])) * 100;
            $percentage_fitup = $percentage_fitup > 100 ? 100 : $percentage_fitup;
            $percentage_fitup = is_nan($percentage_fitup) ? 0 : $percentage_fitup;

            $class_percent_ft    = "bg-success";

            if ($percentage_fitup < 25) {
              $class_percent_ft  = "bg-danger";
            } elseif ($percentage_fitup >= 25 && $percentage_fitup < 50) {
              $class_percent_ft  = "bg-warning";
            } elseif ($percentage_fitup >= 50 && $percentage_fitup < 75) {
              $class_percent_ft  = "bg-info";
            }


            ?>


            <div class="progress">
              <div class="progress-bar progress-bar-striped <?= $class_percent_ft ?>" role="progressbar" style="width: <?= $percentage_fitup ?>%" aria-valuenow="<?= $percentage_fitup ?>" aria-valuemin="0" aria-valuemax="100"><strong><?= number_format($percentage_fitup, 2) ?> %</strong></div>
            </div>

          </td>

          <td><?= intval($visual[$value['id']]['total_length_submission']) ?></td>
          <td><?= intval($visual[$value['id']]['total_length_approved']) ?></td>
          <td><?= intval($visual[$value['id']]['total_length_reject']) ?></td>
          <td>
            <?= intval($join_list[$value['id']]['total_length']) - intval($visual[$value['id']]['total_length_approved']) ?>
          </td>
          <td>

            <?php

            $percentage_visual = (intval($visual[$value['id']]['total_length_approved']) / intval($join_list[$value['id']]['total_length'])) * 100;
            $percentage_visual = $percentage_visual > 100 ? 100 : $percentage_visual;
            $percentage_visual = is_nan($percentage_visual) ? 0 : $percentage_visual;

            $class_percent_vs    = "bg-success";

            if ($percentage_visual < 25) {
              $class_percent_vs  = "bg-danger";
            } elseif ($percentage_visual >= 25 && $percentage_visual < 50) {
              $class_percent_vs  = "bg-warning";
            } elseif ($percentage_visual >= 50 && $percentage_visual < 75) {
              $class_percent_vs  = "bg-info";
            }


            ?>




            <div class="progress">
              <div class="progress-bar progress-bar-striped <?= $class_percent_vs ?>" role="progressbar" style="width: <?= $percentage_visual ?>%" aria-valuenow="<?= $percentage_visual ?>" aria-valuemin="0" aria-valuemax="100"><strong><?= number_format($percentage_visual, 2) ?> %</strong></div>
            </div>

          </td>
          <td><?= intval($visual[$value['id']]['total_length_all']) ?></td>
          <?php foreach ($joint_type as $v) : ?>
            <td><?= intval(@$summary_weld_type[$value['id']][$v['id']]) ?></td>
          <?php endforeach; ?>
          <td>
            <?= $need_mt ?>
          </td>
          <td>
            <?= floatval($ndt_count['2'][$value['id']]['total_length']) ?>
          </td>
          <td>
            <?= intval($need_mt - $ndt_count['2'][$value['id']]['total_length']) > 0 ? intval($need_mt - $ndt_count['2'][$value['id']]['total_length']) : 0 ?>
          </td>
          <td>

            <?php

            $percentage_mt = ($ndt_count['2'][$value['id']]['total_length'] / $need_mt) * 100;
            $percentage_mt = $percentage_mt > 100 ? 100 : $percentage_mt;
            $percentage_mt = is_nan($percentage_mt) ? 0 : $percentage_mt;

            $class_percent_mt    = "bg-success";

            if ($percentage_mt < 25) {
              $class_percent_mt  = "bg-danger";
            } elseif ($percentage_mt >= 25 && $percentage_mt < 50) {
              $class_percent_mt  = "bg-warning";
            } elseif ($percentage_mt >= 50 && $percentage_mt < 75) {
              $class_percent_mt  = "bg-info";
            }

            ?>


            <div class="progress">
              <div class="progress-bar progress-bar-striped <?= $class_percent_mt ?>" role="progressbar" style="width: <?= $percentage_mt ?>%" aria-valuenow="<?= $percentage_mt ?>" aria-valuemin="0" aria-valuemax="100"><strong><?= number_format($percentage_mt, 2) ?> %</strong></div>
            </div>

          </td>
          <td><?= $need_ut ?></td>
          <td>
            <?= floatval($ndt_count['3'][$value['id']]['total_length']) ?>
          </td>
          <td>
            <?= intval($need_ut - $ndt_count['3'][$value['id']]['total_length']) > 0 ? intval($need_ut - $ndt_count['3'][$value['id']]['total_length']) : 0 ?>
          </td>
          <td>

            <?php

            $percentage_ut = ($ndt_count['3'][$value['id']]['total_length'] / $need_ut) * 100;
            $percentage_ut = $percentage_ut > 100 ? 100 : $percentage_ut;
            $percentage_ut = is_nan($percentage_ut) ? 0 : $percentage_ut;

            $class_percent_ut    = "bg-success";

            if ($percentage_ut < 25) {
              $class_percent_ut  = "bg-danger";
            } elseif ($percentage_ut >= 25 && $percentage_ut < 50) {
              $class_percent_ut  = "bg-warning";
            } elseif ($percentage_ut >= 50 && $percentage_ut < 75) {
              $class_percent_ut  = "bg-info";
            }


            ?>

            <div class="progress">
              <div class="progress-bar progress-bar-striped <?= $class_percent_ut ?>" role="progressbar" style="width: <?= $percentage_ut ?>%" aria-valuenow="<?= $percentage_ut ?>" aria-valuemin="0" aria-valuemax="100"><strong><?= number_format($percentage_ut, 2) ?> %</strong></div>
            </div>
          </td>

        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>