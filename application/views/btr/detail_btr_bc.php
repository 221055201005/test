<?php $this->load->view('_partial/header'); ?>
<?php

error_reporting(0);
$irn          = $irn_list[0];
$btr          = $joint_list[0];

$links_atc = base_url_ftp_eng() . "public_smoe/open_atc/2/" . encrypt($drawing[$btr['drawing_no']]['id']) . "/" . $drawing[$btr['drawing_no']]['last_revision_no'];

?>
<style>
  body {
    margin: 10px
  }

  th,
  td {
    vertical-align: middle !important;
  }
</style>
<title>BTR</title>
<?php if (@$btr['status_inspection'] == 0) : ?>
  <div class="row">
    <div class="col-md-12">
      <a href="<?= site_url('btr/import_joint/'.encrypt($btr['drawing_no']).'/'.encrypt($btr['uniq_id'])) ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Joint</a>
    </div>
  </div>
<?php endif; ?>
<table style="width:100%">
  <tr>
    <td>
      <center><img src="<?= base_url() ?>/img/header_report.png" style='width: 450px; height: 70px;'></center>
    </td>
  </tr>
</table>
<table style="width:100%; font-weight: bold !important;">
  <tr>
    <td style="width:200px; white-space: nowrap !important"> PROJECT NAME </td>
    <td> : </td>
    <td> <?= $project[$btr['project']]['project_name'] ?> </td>
    <td rowspan="5" style="vertical-align: middle !important;">
      <center>
        <h2><strong>BONDSTRAND ADHESIVE ASSEMBLY REPORT</strong></h2>
      </center>
    </td>
  </tr>

  <tr>
    <td> CLIENT </td>
    <td> : </td>
    <td> <?= $project[$btr['project']]['client'] ?> </td>
  </tr>

  <tr>
    <td> DRAWING NO </td>
    <td> : </td>
    <td><?= $btr['drawing_no'] ?> (<a href="<?= $links_atc ?>" target="_blank"> File Drawing</a>)</td>
  </tr>

  <tr>
    <td> REV </td>
    <td> : </td>
    <td><?= $btr['rev_no'] ?></td>
  </tr>

  <tr>
    <td> DESCRIPTION </td>
    <td> : </td>
    <td style="width:200px; white-space: nowrap !important"><?= $drawing[$btr['drawing_no']]['title'] ?></td>
  </tr>

</table>
<br>
<table style="width:100%; text-align: center; border-collapse: collapse;" border="1">
  <thead>
    <tr>
      <th rowspan="3">S/N</th>
      <th rowspan="3">PROJECT</th>
      <th rowspan="3">PRODUCT SERIES / RATING</th>
      <th rowspan="3">TITLE</th>
      <th rowspan="3">ISOMETRIC NO</th>
      <th rowspan="3">REV.</th>
      <th rowspan="3">LOCATION</th>
      <th rowspan="3">DATE</th>
      <th rowspan="3">RFI NO.</th>
      <th rowspan="3">REPORT NO.</th>
      <th colspan="3">ISOMETRIC</th>
      <th rowspan="3">BONDER ID</th>
      <th colspan="3">FIT UP & JOINT PREPARATION</th>
      <th colspan="7">ADHESIVE BONDED JOINT</th>
      <th colspan="3">JOINT CURING</th>
      <th colspan="2">ENV</th>
      <th rowspan="3">INSPECTION RESULT</th>
      <th rowspan="3">REMARKS</th>
    </tr>
    <tr>
      <th rowspan="2">JOINT NO</th>
      <th rowspan="2">SPOOL NO</th>
      <th rowspan="2">OD (INCH)</th>
      <th rowspan="2">SANDING (40-60 GRIT)</th>
      <th rowspan="2">CLEAN & DRY</th>
      <th rowspan="2">ALIGNMENT</th>
      <th colspan="2">BATCH NO OF ADHESIVE</th>
      <th rowspan="2">ADHESIVE TYPE</th>
      <th colspan="2">TIME</th>
      <th colspan="2">INSERTION DEPTH</th>
      <th rowspan="2">TEMP (DEG C)</th>
      <th colspan="2">TIME</th>
      <th rowspan="2">HUM</th>
      <th rowspan="2">TEMP</th>
    </tr>
    <tr>
      <th>R</th>
      <th>H</th>
      <th>START</th>
      <th>FINISH</th>
      <th>SPEC</th>
      <th>ACTUAL</th>
      <th>START</th>
      <th>FINISH</th>
    </tr>

  </thead>
  <tbody>
    <?php $no = 1;
    foreach ($joint_list as $key => $value) : ?>
      <?php

      $show = false;
      $location_name = '';
      if (isset($baa[$value['id']])) {
        $show = true;
        $location_name = $area[$baa[$value['id']]['area']]['name'];
        $location_name .= ', ' . $location[$baa[$value['id']]['location']]['name'];
      }

      ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $project[$value['project']]['project_name'] ?></td>
        <td>
          <?php if ($show) : ?>
            <?= $baa[$value['id']]['product_series_rating'] ?>
          <?php endif; ?>
        </td>
        <td><?= $drawing[$value['drawing_no']]['title'] ?></td>
        <td><?= $value['drawing_no'] ?></td>
        <td><?= $value['rev_no'] ?></td>
        <td><?= $location_name ?></td>
        <td>
          <?php if ($show) : ?>
            <?= date('Y-m-d', strtotime($baa[$value['id']]['submit_date'])) ?>
          <?php endif; ?>
        </td>

        <td>
          <?php if ($show) : ?>
            <?= $baa[$value['id']]['submission_id'] ?>
          <?php endif; ?>
        </td>

        <td>
          <?php if ($show) : ?>
            <?= $baa[$value['id']]['report_number'] ?>
          <?php endif; ?>
        </td>
        <td>
          <?= $value['joint_no'] ?>
        </td>

        <td style="white-space: nowrap;">
          <?= $piecemark[$value['pos_1']]['spool_no'] ?>
          <hr>
          <?= $piecemark[$value['pos_2']]['spool_no'] ?>
        </td>
        <td><?= $value['diameter'] ?></td>
        <td>
          <?php if ($show) : ?>
            <?php

            $bonders  = [];
            foreach (explode(";", $baa[$value['id']]['bonder_id']) as $v) {
              $bonders[] = $bonder[$v]['bonder_id'];
            }

            ?>

            <?= implode(',<br>', $bonders) ?>
          <?php endif; ?>
        </td>

        <td>
          <?php if ($show) : ?>
            <?= $baa[$value['id']]['sanding_40_60'] ?>
          <?php endif; ?>
        </td>
        <td>
          <?php if ($show) : ?>
            <?= $baa[$value['id']]['clean_dry'] ?>
          <?php endif; ?>
        </td>
        <td style="white-space: nowrap;">
          <?= $piecemark[$value['pos_1']]['material'] ?>
          <hr style="margin:5px">
          <?= $piecemark[$value['pos_2']]['material'] ?>
        </td>

        <td>
          <?php if ($show) : ?>
            <?= $baa[$value['id']]['adhesive_r'] ?>
          <?php endif; ?>
        </td>

        <td>
          <?php if ($show) : ?>
            <?= $baa[$value['id']]['adhesive_h'] ?>
          <?php endif; ?>
        </td>

        <td>
          <?php if ($show) : ?>
            <?= $baa[$value['id']]['adhesive_type'] ?>
          <?php endif; ?>
        </td>

        <td>
          <?php if ($show) : ?>
            <?= date('H:i', strtotime($baa[$value['id']]['adhesive_time_start'])) ?>
          <?php endif; ?>
        </td>

        <td>
          <?php if ($show) : ?>
            <?= date('H:i', strtotime($baa[$value['id']]['adhesive_time_stop'])) ?>
          <?php endif; ?>
        </td>

        <td>
          <?php if ($show) : ?>
            <?= $baa[$value['id']]['depth_spec'] ?>
          <?php endif; ?>
        </td>

        <td>
          <?php if ($show) : ?>
            <?= $baa[$value['id']]['depth_actual'] ?>
          <?php endif; ?>
        </td>

        <td>
          <?php if ($show) : ?>
            <?= $baa[$value['id']]['curing_temp'] ?>
          <?php endif; ?>
        </td>

        <td>
          <?php if ($show) : ?>
            <?= date('H:i', strtotime($baa[$value['id']]['curing_start'])) ?>
          <?php endif; ?>
        </td>

        <td>
          <?php if ($show) : ?>
            <?= date('H:i', strtotime($baa[$value['id']]['curing_finish'])) ?>
          <?php endif; ?>
        </td>

        <td>
          <?php if ($show) : ?>
            <?= $baa[$value['id']]['env_hum'] ?>
          <?php endif; ?>
        </td>

        <td>
          <?php if ($show) : ?>
            <?= $baa[$value['id']]['env_temp'] ?>
          <?php endif; ?>
        </td>

        <td>
          <?php if ($show) : ?>
            <?php if ($baa[$value['id']]['status_inspection'] == 1) : ?>
              OS
            <?php elseif ($baa[$value['id']]['status_inspection'] == 2) : ?>
              REJ
            <?php elseif ($baa[$value['id']]['status_inspection'] == 3) : ?>
              ACC
            <?php endif; ?>
          <?php else : ?>
            OS
          <?php endif; ?>
        </td>

        <td>
          <?php if ($show) : ?>
            <?= $baa[$value['id']]['inspection_remarks'] ?>
          <?php endif; ?>
        </td>


      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<br><br>
<table class="table-body" width="100%" style="text-align: left;border-collapse: collapse !important; padding-top: -0.8px;">
  <tbody>
    <tr>
      <td style="width: 25%; border: none;"></td>
      <td style="width: 25%; border: none;"></td>
      <td style="width: 25%; border: none;"></td>
      <td style="width: 25%; border: none;"></td>
    </tr>
    <tr style="vertical-align: text-bottom !important;">
      <td style="width: 25%; border: none; vertical-align: text-bottom !important;">

        <?php if ($irn['smoe_approval_by']) : ?>
          <img src="data:image/png;base64,<?= $user[$irn['smoe_approval_by']]['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />
        <?php endif; ?>

      </td>
      <td style="width: 25%; border: none;"></td>
      <td style="width: 25%; border: none; vertical-align: text-bottom !important;">
        <?php if ($irn['client_approval_by']) : ?>
          <img src="data:image/png;base64,<?= $user[$irn['client_approval_by']]['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />
        <?php endif; ?>
      </td>
      <td style="width: 25%; border: none;"></td>
      <td style="width: 25%; border: none;"></td>
    </tr>
    <tr>
      <td style="width: 25%; border: none;">
        <?php if ($irn['smoe_approval_by']) : ?>
          <?= $user[$irn['smoe_approval_by']]['full_name'] ?>
        <?php endif; ?>
        <br>
        <b>_______________________</b>
      </td>
      <td style="width: 25%; border: none;"></td>
      <td style="width: 25%; border: none;">
        <?php if ($irn['client_approval_by']) : ?>
          <?= $user[$irn['client_approval_by']]['full_name'] ?>
        <?php endif; ?>
        <br>
        <b>_______________________</b>
      </td>
      <td style="width: 25%; border: none;"></td>
      <td style="width: 25%; border: none;"><b>_______________________</b></td>
    </tr>
    <tr>
      <td style="width: 25%; border: none; padding-top: 10px;"><b>CONTRACTOR</b></td>
      <td style="width: 25%; border: none;"></td>
      <td style="width: 25%; border: none; padding-top: 10px;"><b>EMPLOYER</b></td>
      <td style="width: 25%; border: none; padding-top: 10px;"><b></b></td>
      <td style="width: 25%; border: none; padding-top: 10px;"><b>THIRD PARTY <strong><i><span style="font-size: 14px !important"> (if any)</span></i></strong></b></td>
    </tr>
    <tr>
      <td style="width: 25%; border: none;">DATE :

        <?= $irn['smoe_approval_date'] ? date('Y-m-d', strtotime($irn['smoe_approval_date'])) : null ?>

      </td>
      <td style="width: 25%; border: none;"></td>
      <td style="width: 25%; border: none;">DATE :
        <?= $irn['client_approval_date'] ? date('Y-m-d', strtotime($irn['client_approval_date'])) : null ?>

      </td>
      <td style="width: 25%; border: none;"></td>
      <td style="width: 25%; border: none;">DATE :</td>
    </tr>
    <tr>
      <td style="width: 25%; border: none;"><br /></td>
      <td style="width: 25%; border: none;"></td>
      <td style="width: 25%; border: none;">
      </td>
      <td style="width: 25%; border: none;">
      </td>
      <td style="width: 25%; border: none;">
      </td>
    </tr>
    <tr>
      <td style="width: 25%; border: none;"></td>
      <td style="width: 25%; border: none;"></td>
      <td style="width: 25%; border: none;">
      </td>
      <td style="width: 25%; border: none;">
        <!-- IDATE : -->
      </td>
      <td style="width: 25%; border: none;">
        <!-- IDATE : -->
      </td>
    </tr>
    <tr>
      <td style="width: 25%; border: none;"></td>
      <td style="width: 25%; border: none;"></td>
      <td style="width: 25%; border: none;">
      </td>
      <td style="width: 25%; border: none;">
      </td>
      <td style="width: 25%; border: none;">
      </td>
    </tr>
  </tbody>
</table>