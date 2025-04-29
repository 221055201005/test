<!DOCTYPE html>
<html>

<head>
  <?php
  error_reporting(0);
  $bnp        = $bnp_list[0];

  $location_desc = '';

  if (isset($area[$bnp['area']])) {
    $location_desc .= $area[$bnp['area']];

    if (isset($location[$bnp['location']])) {
      $location_desc .= ', ' . $location[$bnp['location']];

      if (isset($point[$bnp['point']])) {
        $location_desc .= ', ' . $point[$bnp['point']];
      }
    }
  }

  ?>
  <title><?= $bnp['request_no'] ?></title>
  <style type="text/css">
    /* @page {
      margin: 0cm 0cm;
    } */

    body {
      top: 0cm;
      left: 0cm;
      right: 0cm;
      margin-top: 5.5cm;
      margin-left: 0.25cm;
      margin-right: 0.25cm;
      margin-bottom: 1cm;
      font-family: "helvetica";
      font-size: 60% !important;
    }

    header {
      position: fixed;
      /*top: 2cm;*/
      left: 0cm;
      right: 0cm;
      height: 5cm;
      padding-top: 15px;
      /*padding-left: 1.4cm;
      padding-right: 1.5cm;*/
      padding-top: -0.2cm;
      margin-top: 0.5cm;
      margin-left: 0.25cm;
      margin-right: 0.25cm;

    }

    footer {
      position: fixed;
      left: 0cm;
      right: 0cm;
      height: 5cm;

      margin-top: 0.5cm;
      margin-left: 0.5cm;
      margin-right: 0.5cm;

    }

    .titleHead {
      border: 1px #000 solid;
      border-collapse: collapse;
      text-align: center;
      vertical-align: middle;
      font-size: 25px;
      background-color: #a6ffa6;
      font-weight: bold;

    }

    .titleHeadMain {
      text-align: center;
      border-collapse: collapse;
      text-align: center;
      vertical-align: middle;
      font-size: 25px;
      font-weight: bold;
    }

    table.table td {
      font-size: 90%;
      border: 1px #000 solid;
      font-weight: bold;
      max-width: 150px;
      word-wrap: break-word;
    }

    table>thead>tr>td,
    table>tbody>tr>td {
      vertical-align: top;
    }

    .br_break {
      line-height: 15px;
    }

    .br_break_no_bold {
      line-height: 18px;
    }

    .br {
      border-right: 1px #000 solid;
    }

    .bl {
      border-left: 1px #000 solid;
    }

    .bt {
      border-top: 1px #000 solid;
    }

    .bb {
      border-bottom: 1px #000 solid;
    }

    .bx {
      border-left: 1px #000 solid;
      border-right: 1px #000 solid;
    }

    .by {
      border-top: 1px #000 solid;
      border-bottom: 1px #000 solid;
    }

    .ball {
      border-top: 1px #000 solid;
      border-bottom: 1px #000 solid;
      border-left: 1px #000 solid;
      border-right: 1px #000 solid;
      word-wrap: break-word;
    }

    .tab {
      display: inline-block;
      width: 60px;
    }

    .tab2 {
      display: inline-block;
      width: 120px;
    }

    hr {
      border-top: 0px !important;
    }

    label {
      display: block;
      padding-left: 2;
      text-indent: -1;
    }

    input {
      width: 5px;
      height: 5px;
      padding: 0;
      margin: 0;
      vertical-align: bottom;
      position: relative;
      top: 0px;
      *overflow: hidden;
    }
  </style>
</head>

<body>
  <header>
    <table width="100%" border="1px" style="border-top: 0px !important; border-left: 0px !important; border-right: 0px !important; border-bottom: 0px !important;">
      <tr style="border-top: 0px !important; border-left: 0px !important; border-right: 0px !important">
        <td width="1%;" style="padding: 10px; border-top: 0px !important; border-left: 0px !important; border-right: 0px !important;">
          <center>
            <img src="img/seatrium_logo_bg_white.png" style=' height: 50px;' />
          </center>
        </td>
        <td width="1%" style="padding: 10px; text-align: left !important; border-top: 0px !important; border-left: 0px !important; border-right: 0px !important;">
          <center>
            <img src="<?= $project_list[$bnp['project_id']]['client_logo'] ?>" style='height: 50px;' />
          </center>
        </td>
        <td width="15%;" style=" font-size: 20px !important; padding: 10px; vertical-align: middle !important;border-top: 0px !important; border-left: 0px !important; border-right: 0px !important;">
          <center>
            <h1 style="text-align: left;">RFI - INSPECTION NOTIFICATION</h1>
          </center>
        </td>
      </tr>
    </table>
    <!-- <table width="100%" border="1px" style="border-top: 0px !important; border-left: 0px !important; border-right: 0px !important">
      <tr style="border-top: 0px !important; border-left: 0px !important; border-right: 0px !important">
        <td width="15%;" style="padding: 10px; border-top: 0px !important; border-left: 0px !important; border-right: 0px !important">
          <center>
            <img src="img/seatrium_logo_bg_white.png" style=' height: 50px;' />
          </center>
        </td>
        <td style="padding: 10px; text-align: left !important; border-top: 0px !important; border-left: 0px !important; border-right: 0px !important">
          <center>
            <img src="<?= $project_list[$bnp['project_id']]['client_logo'] ?>" style=' height: 50px;' />
          </center>
        </td>
        <td width="15%;" style="padding: 10px; border-top: 0px !important; border-left: 0px !important; border-right: 0px !important">
          <center>
            <h1>RFI - INSPECTION NOTIFICATION</h1>
          </center>
        </td>
      </tr>
    </table> -->
    </br>
    <table width="100%" style="border-collapse: collapse !important;">

      <head>
        <tr>
          <td width="50%"><b class="tab">Project</b>: <?= $project_list[$bnp['project_id']]['project_name'] ?></td>
          <td></td>
        </tr>
        <tr>
          <td><b class="tab">From Dept.</b>: BLASTING & PAINTING</td>
          <td style="text-align: right !important;"><b class="">Request No.</b>: <?= $bnp['request_no'] ?></td>

        </tr>
        <tr>
          <td><b class="tab">Date</b>: <?= DATE('d-M-y', strtotime($bnp['created_date'])) ?></td>
          <td></td>
        </tr>
        <tr>
          <td><b class="tab">Location</b>:
            <?= $location_desc ?>
          </td>
          <td></td>
        </tr>
        <?php
        $tagdescs = array_column($bnp_detail, 'tag_description');
        foreach ($tagdescs as $keyv => $valuev) {
          $tagdesc[str_replace("\n", '', str_replace(' ', '', $valuev))] = $valuev;
        }
        ?>
        <tr>
          <td style="vertical-align: middle !important;" colspan="2"><b class="tab">Tag Description</b>:
            <?= implode(', ', $tagdesc) ?>
          </td>
        </tr>

        <tr>
          <td colspan="2" style="text-align: justify;">
            <table width="100%">
              <td><b class="tab">Discipline</b>:</td>

              <td>
                <?php if ($bnp['discipline'] == '2') { ?>
                  <input disabled type="checkbox" name="optiona" id="opta" checked /><?php } else { ?><input disabled type="checkbox" name="optiona" id="opta" /><?php } ?><span class="checkboxtext"> &nbsp;&nbsp;STRUCTURAL&nbsp;&nbsp;&nbsp;&nbsp;</span>
              </td>

              <td>
                <input disabled type="checkbox" name="optiona" id="opta" /><span class="checkboxtext"> &nbsp;&nbsp;ELECTRICAL&nbsp;&nbsp;&nbsp;&nbsp;</span>
              </td>

              <td>
                <input disabled type="checkbox" name="optiona" id="opta" /><span class="checkboxtext"> &nbsp;&nbsp;MECHANICAL&nbsp;&nbsp;&nbsp;&nbsp;</span>
              </td>

              <td>
                <input disabled type="checkbox" name="optiona" id="opta" /><span class="checkboxtext"> &nbsp;&nbsp;INSTR/AUT&nbsp;&nbsp;&nbsp;&nbsp;</span>
              </td>

              <td>
                <?php if ($bnp['discipline'] == '1') { ?>
                  <input disabled type="checkbox" name="optiona" id="opta" checked="" />
                <?php } else { ?>
                  <input disabled type="checkbox" name="optiona" id="opta" />
                <?php } ?>
                <span class="checkboxtext"> &nbsp;&nbsp;PIPING&nbsp;&nbsp;&nbsp;&nbsp;</span>
              </td>

              <td>
                <input disabled type="checkbox" name="optiona" id="opta" />
                <span class="checkboxtext">&nbsp;&nbsp;HVAC&nbsp;&nbsp;&nbsp;&nbsp;</span>
              </td>

              <td>
                <input disabled type="checkbox" name="optiona" id="opta" />
                <span class="checkboxtext">&nbsp;&nbsp;TELECOM&nbsp;&nbsp;&nbsp;&nbsp;</span>
              </td>

              <td>
                <input disabled type="checkbox" name="optiona" id="opta" />
                <span class="checkboxtext">&nbsp;&nbsp;PACKAGE&nbsp;&nbsp;&nbsp;&nbsp;</span>
              </td>
            </table>

          </td>
        </tr>

      </head>
    </table>
  </header>
  <footer>

  </footer>
  <br>

  <table width="100%" border="1" style="text-align: left;border-collapse: collapse !important;">
    <thead>
      <tr>
        <th>NO</th>
        <th>PIECEMARK NO.</th>
        <th>DRAWING NUMBER</th>
        <th>PAINT SYSTEM</th>
        <th>QTY</th>
        <th>ITEM/SPEC</th>
        <th>IRN NUMBER</th>
        <!-- <th>LOCATION</th> -->
        <th>REMARKS</th>
      </tr>
    </thead>
    <tbody style="text-align: center;">
      <?php $no = 1;
      foreach ($detail_list as $key => $value) : ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $value['part_id'] ?></td>
          <td><?= $value['drawing_ga'] ?></td>
          <td><?= $paint_system[$bnp['id_paint_system']]['name'] ?></td>
          <td>1</td>
          <td><?= $value['profile'] ?></td>
          <td><?= $value['irn_report_no'] ?></td>
          <td><?= $value['irn_description'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <br><br><br><br><br>
  <!-- <table width="100%">
    <tr>
      <td colspan="20"> -->
  <div style="page-break-inside: avoid !important;">
    <table class="table-body" width="100%" style="border-collapse: collapse !important; padding-top: -1.8px;">
      <tbody>
        <tr>
          <td colspan="2" height="50px"> * Comment / Remarks: <?= $rfi_detail[0]['client_inspection_remarks'] ?></td>
        </tr>
        <tr>
          <td style="width: 25%; border: none;text-align: left;">
          </td>
          <td style="width: 25%; border: none;"></td>

          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;">
          </td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;text-align: center;">
            Prepared by:
          </td>
        </tr>
        <tr>
          <td style="width: 25%; border: none;text-align: left;">
          </td>
          <td style="width: 25%; border: none;"></td>

          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;">
          </td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;text-align: center;">
            <img src="data:image/png;base64,<?= $user[$bnp['created_by']]['sign_approval'] ?>" style="width: 150px !important; height: 100px !important">
          </td>
        </tr>
        <tr>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
        </tr>
        <tr>
          <td style="width: 25%; border: none;text-align: center;">

            <br>
            <b></b>
          </td>
          <td style="width: 25%; border: none;"></td>

          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;">

            <br>
            <b></b>
          </td>

          <td></td>
          <td></td>

          <td style="width: 25%; border: none;text-align: center;">
            <?= $user[$bnp['created_by']]['full_name'] ?>
            <br>
            <b>__________________________</b>
          </td>

        </tr>
        <tr>
          <td style="width: 25%; border: none; padding-top: 10px;text-align: left;">
            <b></b>
          </td>
          <td style="width: 25%; border: none; padding-top: 10px;">
            <b></b>
          </td>
          <td style="width: 25%; border: none; padding-top: 10px;">
            <b></b>
          </td>
          <td style="width: 25%; border: none; padding-top: 10px;">
            <b></b>
          </td>
          <td style="width: 25%; border: none; padding-top: 10px;">
            <b></b>
          </td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none; padding-top: 10px;text-align: center;">
            <b>CONTRACTOR PROD / PMT</b>
          </td>

        </tr>
        <tr>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>

          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>

          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;">

          </td>

        </tr>
      </tbody>
    </table>
  </div>
  <!-- </td>
    </tr>
  </table> -->
</body>

</html>