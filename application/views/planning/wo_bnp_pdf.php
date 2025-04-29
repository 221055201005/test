<?php
function createspace($num = 0)
{
  for ($i = 0; $i < $num; $i++) {
    echo "&nbsp;";
  }
}

$total_weight = 0;
$num_piecemark = 0;
?>
<!DOCTYPE html>
<html>

<head>
  <title><?php echo $meta_title ?></title>
</head>
<style type="text/css">
  @page {
    margin: 2.87cm 0.75cm 0.75cm 0.75cm;
  }

  header {
    position: fixed;
    top: -1.87cm;
    left: 0px;
    right: 0px;
  }

  body {
    margin: 0px;
    font-size: 10px;
  }

  .page_break {
    page-break-before: always;
  }

  .page_break_element {
    page-break-inside: avoid;
  }

  table {
    width: 100%;
  }

  .table-bordered>tbody>tr>td {
    border: 1px solid #000;
  }

  .td-valign-top>tbody>tr>td {
    vertical-align: top;
  }

  .td-signature-pic {
    overflow: visible;
    height: 100px;
  }

  .width-25 {
    width: 25%;
  }

  .width-10 {
    width: 10%;
  }

  .valign-middle {
    vertical-align: middle !important;
  }

  .text-center {
    text-align: center;
  }

  .text-right {
    text-align: right;
  }

  .text-left {
    text-align: left;
  }

  .text-bold {
    font-weight: bold;
  }

  .auto-fit {
    width: 1% !important;
    white-space: nowrap;
  }

  .m-0 {
    margin: 0px;
  }

  .p-0 {
    padding: 0px;
  }

  .px-1 {
    padding-right: .25rem;
    padding-left: .25rem;
  }

  .px-2 {
    padding-right: .5rem;
    padding-left: .5rem;
  }

  .px-3 {
    padding-right: 1rem;
    padding-left: 1rem;
  }

  .px-4 {
    padding-right: 1.5rem;
    padding-left: 1.5rem;
  }

  .pr-1 {
    padding-right: .25rem;
  }

  .pr-2 {
    padding-right: .5rem;
  }

  .pr-3 {
    padding-right: 1rem;
  }

  .pr-4 {
    padding-right: 1.5rem;
  }

  .pl-1 {
    padding-left: .25rem;
  }

  .pl-2 {
    padding-left: .5rem;
  }

  .pl-3 {
    padding-left: 1rem;
  }

  .pl-4 {
    padding-left: 1.5rem;
  }

  .b {
    border: 1px solid #000;
  }

  .by {
    border-top: 1px solid #000;
    border-bottom: 1px solid #000;
  }

  .bx {
    border-left: 1px solid #000;
    border-right: 1px solid #000;
  }

  .bl {
    border-left: 1px solid #000;
  }

  .br {
    border-right: 1px solid #000;
  }

  .bt {
    border-top: 1px solid #000;
  }

  .bb {
    border-bottom: 1px solid #000;
  }

  .nb {
    border: none !important;
  }

  .nby {
    border-top: none !important;
    border-bottom: none !important;
  }

  .nbx {
    border-left: none !important;
    ;
    border-right: none !important;
    ;
  }

  .nbl {
    border-left: none !important;
    ;
  }

  .nbr {
    border-right: none !important;
    ;
  }

  .nbb {
    border-bottom: none !important;
    ;
  }

  .nbt {
    border-top: none !important;
    ;
  }

  .column {
    column-count: 2 !important;
    column-gap: 10px !important;
  }

  h1,
  h2,
  h3,
  h4,
  h5,
  h6 {
    margin: 0;
  }

  input {
    margin: 0px;
    padding: 0px;
  }

  .qrcode {
    vertical-align: middle !important;
    padding: 0.5px;
  }

  .qrcode-image {
    width: 2.7cm;
  }
</style>

<body>
  <header>
    <table width="100%" class="table-bordered text-center" cellspacing="0" cellpadding="10">
      <tr>
        <td width="15%;"><img src="<?= $project_list[$workpack['project']]['client_logo'] ?>" style='height: 50px;' /></td>
        <td>
          <h1><?= $project_list[$workpack['project']]['description'] ?></h1>
        </td>
        <td width="15%;"><img src="img/seatrium_logo_bg_white.png" style='height: 50px;' /></td>
      </tr>
    </table>
  </header>
  <table width="100%" class="table-bordered text-center td-valign-top" cellspacing="0" cellpadding="0">
    <tr>
      <td width="50%">
        <table width="100%" class="text-center td-valign-top" cellspacing="0" cellpadding="2">
          <tr>
            <td class='bb text-left text-bold' colspan="3">WORK DESCRIPTION</td>
          </tr>
          <tr>
            <td class="auto-fit text-left text-bold">Work Pack Number</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo $workpack['workpack_no'] ?></td>
          </tr>
          <tr>
            <td class="auto-fit text-bold text-left">Workpack Description</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo $workpack['description'] ?></td>
          </tr>
        </table>
      </td>
      <td width="50%">
        <table width="100%" class="text-center td-valign-top" cellspacing="0" cellpadding="2">
          <tr>
            <td class='bb text-left text-bold' colspan="4">WORK DATE</td>
          </tr>
          <tr>
            <td class="auto-fit text-left text-bold">Plan Start Date</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo ($workpack['plan_start_date'] == "" ? "" : date("D, d M Y", strtotime($workpack['plan_start_date']))) ?></td>
            <td class="auto-fit qrcode" rowspan="6"><img class="qrcode-image" src="data:image/png;base64,<?= $qrcode ?>" /></td>
          </tr>
          <tr>
            <td class="auto-fit text-bold text-left">Plan Finish Date</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo ($workpack['plan_finish_date'] == "" ? "" : date("D, d M Y", strtotime($workpack['plan_finish_date']))) ?></td>
          </tr>
          <tr>
            <td class="auto-fit text-bold text-left">Duration</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo (date_diff(date_create($workpack['plan_start_date']), date_create($workpack['plan_finish_date']))->format("%a")) + 1; ?> Day</td>
          </tr>
          <tr>
            <td class="auto-fit text-bold text-left">Actual Start Date</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"></td>
          </tr>
          <tr>
            <td class="auto-fit text-bold text-left">Actual Finish Date</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"></td>
          </tr>
          <tr>
            <td class="auto-fit text-bold text-left">Issued Date</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo ($workpack['issued_date'] == "" ? "" : date("D, d M Y", strtotime($workpack['issued_date']))) ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

  <table width="100%" class="table-bordered text-center td-valign-top" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <table width="100%" class="text-center td-valign-top" cellspacing="0" cellpadding="2">
          <tr>
            <td class="bb text-left text-bold" colspan="3">WORK CAPACITY </td>
          </tr>
          <tr>
            <td class="auto-fit text-left text-bold">SITE / WORK SHOP</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo ($workpack['location_v2'] != 0 ? @$area_v2_list[$location_v2_list[$workpack['location_v2']]['id_area']]['name'] . ', ' . @$location_v2_list[$workpack['location_v2']]['name'] : @$location_list[$workpack['location']]['location_name']) ?></td>
          </tr>
          <tr>
            <td class="auto-fit text-left text-bold">Module</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo $module_list[$workpack['module']]['mod_desc'] ?></td>
          </tr>
          <tr>
            <td class="auto-fit text-left text-bold">Budget manhours</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo $workpack['budget_manhours'] ?> MHRS</td>
          </tr>
        </table>
      </td>
      <td width="50%">
        <table width="100%" class="table-bordered text-center td-valign-top" cellspacing="0" cellpadding="2">
          <tr>
            <td class="bb text-left text-bold" colspan="6">MANPOWER BUDGET </td>
          </tr>
          <tr>
            <td class="text-bold">No</td>
            <td class="text-bold">Trade</td>
            <td class="text-bold">Total Manpower</td>
            <td class="text-bold">Days</td>
            <td class="text-bold">Man Hours</td>
            <td class="text-bold">Total Manhours</td>
          </tr>
          <?php
          $total = 0;
          foreach ($budget_manhours_list as $key => $value) :
            $total_manhours = ($value['manpower'] * $value['day'] * $value['manhours']);
            $total += $total_manhours; ?>
            <tr>
              <td><?php echo $key + 1 ?></td>
              <td><?php echo $workpack_section[$value['name']]['name'] ?></td>
              <td><?php echo $value['manpower'] ?></td>
              <td><?php echo $value['day'] ?></td>
              <td><?php echo $value['manhours'] ?></td>
              <td><?php echo ($value['manpower'] * $value['day'] * $value['manhours']) ?></td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <td colspan='5'><b>Total Manhours</b></td>
            <td><?php echo $total ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

  <br>
  <table width="100%" class="table-bordered text-center" cellspacing="0" cellpadding="2">
    <tr>
      <td class="auto-fit px-2 text-bold py-3">No</td>
      <td class="text-bold py-3">Name</td>
      <td class="text-bold py-3">Badge ID</td>
      <td class="text-bold py-3">Activity</td>
      <td class="auto-fit px-2 text-bold py-3">Days</td>
      <td class="auto-fit px-2 text-bold py-3">Manhours</td>
      <td class="auto-fit px-2 text-bold py-3">Total<br>Manhours</td>
      <td class="auto-fit px-2 text-bold py-3">No</td>
      <td class="text-bold py-3">Name</td>
      <td class="text-bold py-3">Badge ID</td>
      <td class="text-bold py-3">Activity</td>
      <td class="auto-fit px-2 text-bold py-3">Days</td>
      <td class="auto-fit px-2 text-bold py-3">Manhours</td>
      <td class="auto-fit px-2 text-bold py-3">Total<br>Manhours</td>
    </tr>
    <?php for ($i = 0; $i < 10; $i++) : ?>
      <tr>
        <td><?= ($i + 1) ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?= ($i + 11) ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    <?php endfor; ?>
  </table>
  <br>
  <table width="100%" class="table-bordered text-center td-valign-top" cellspacing="0" cellpadding="2">
    <tr>
      <td class="text-bold py-3">No.</td>
      <td class="text-bold py-3">Unique No.</td>
      <td class="text-bold py-3">MRIR No.</td>
      <td class="text-bold py-3">DO / PL No.</td>
      <td class="text-bold py-3">Description</td>
      <td class="text-bold py-3">Paint System</td>
      <td class="text-bold py-3">Qty</td>
      <td class="text-bold py-3">Thk (mm)</td>
      <td class="text-bold py-3">Width (mm)</td>
      <td class="text-bold py-3">Length (mm)</td>
      <td class="text-bold py-3">Plate / Tag No.</td>
    </tr>
    <?php
    $no = 1;
    foreach ($material_list as $key => $value) :
    ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= @$mb_list[$value['id_template']]['unique_ident_no'] ?></td>
        <td><?= explode('/', @$mb_list[$value['id_template']]['report_no'])[1] ?></td>
        <td><?= @$mb_list[$value['id_template']]['do_or_pl_no'] ?></td>
        <td><?= @$mb_list[$value['id_template']]['description'] ?></td>
        <td>
          <?php
          $paint_system_arr = [];
          foreach ($paint_system as $key1 => $value1) {
            if (in_array($value1['id'], $material_paint_system_list[$value["id_template"]])) {
              $paint_system_arr[] = $value1['code'];
            }
          }
          echo join(', ', $paint_system_arr);
          ?>
        </td>
        <td><?= @$value['qty'] ?></td>
        <td><?= @$mb_list[$value['id_template']]['thk'] ?></td>
        <td><?= @$mb_list[$value['id_template']]['width'] ?></td>
        <td><?= @$mb_list[$value['id_template']]['length'] ?></td>
        <td><?= @$mb_list[$value['id_template']]['plate_or_tag_no'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
  <br>
  <table width="100%" class="table-bordered td-valign-top" cellspacing="0" cellpadding="2">
    <tr>
      <td class="auto-fit px-2 text-bold py-3">
        Remarks Status/Reason of Delay :
        <br>
        <br>
        <br>
        <br>
        <br>
      </td>
    </tr>
  </table>
  <div class="page_break_element">
    <br>
    <table width="100%" class="" cellspacing="0" cellpadding="2">
      <tr>
        <td class="td-signature-pic width-25 text-center">
          <?php if (!in_array(@$user[$workpack['submitted_by']]['sign_approval'], ['', 'default.png'])) : ?>
            <img width='150px;' style="align-items: center !important;" src="data:image/png;base64, <?= @$user[$workpack['submitted_by']]['sign_approval'] ?>">
          <?php endif; ?>
        </td>
        <td class="width-10"></td>
        <td class="td-signature-pic width-25 text-center">
          <?php if (!in_array(@$user[$workpack['approval_by']]['sign_approval'], ['', 'default.png'])) : ?>
            <img width='150px;' style="align-items: center !important;" src="data:image/png;base64, <?= @$user[$workpack['approval_by']]['sign_approval'] ?>">
          <?php endif; ?>
        </td>
        <td class="width-10"></td>
        <td class="td-signature-pic width-25 text-center">
          <?php if (!in_array(@$user[$workpack['superintendent_by']]['sign_approval'], ['', 'default.png'])) : ?>
            <img width='150px;' style="align-items: center !important;" src="data:image/png;base64, <?= @$user[$workpack['superintendent_by']]['sign_approval'] ?>">
          <?php endif; ?>
        </td>
        <td class="width-10"></td>
        <td class="td-signature-pic width-25"></td>
      </tr>
      <tr>
        <td class="bb" style="font-size: 12px"><?= @$user[$workpack['submitted_by']]['full_name'] ?></td>
        <td></td>
        <td class="bb" style="font-size: 12px"><?= @$user[$workpack['approval_by']]['full_name'] ?></td>
        <td></td>
        <td class="bb" style="font-size: 12px"><?= @$user[$workpack['superintendent_by']]['full_name'] ?></td>
        <td></td>
      </tr>
      <tr>
        <td style="white-space: nowrap;"><b>WORKPACK COORDINATOR</b></td>
        <td></td>
        <td style="white-space: nowrap;"><b>PROJECT ENGINEER</b></td>
        <td></td>
        <td style="white-space: nowrap;"><b>CONSTRUCTION SUPERINTENDENT</b></td>
        <td></td>
      </tr>
      <tr>
        <td>Date: <?= date('d F Y', strtotime($workpack['submitted_date'])) ?></td>
        <td></td>
        <td>Date: <?= date('d F Y', strtotime($workpack['approval_date'])) ?></td>
        <td></td>
        <td>Date: <?= date('d F Y', strtotime($workpack['superintendent_date'])) ?></td>
        <td></td>
      </tr>
    </table>
  </div>

</body>

</html>