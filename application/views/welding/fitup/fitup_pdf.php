<!DOCTYPE html>
<html><head>
  <title><?php echo $data_list[0]["report_no"]; ?></title>
  <style type="text/css">   
    @page { margin: 0cm 0cm; }
    body {
      top: 0cm;
      left: 0cm;
      right: 0cm;
      margin-top: 6.5cm;
      margin-left: 0.5cm;
      margin-right: 0.5cm;
      margin-bottom: 1cm;
      font-family: "helvetica";
      font-size: 50% !important;
    }

    header {
      position: fixed;
      top: 2cm;
      left: 0cm;
      right: 0cm;
      height: 5cm;
      padding-top: 5px;
      padding-left: 0.48cm;
      padding-right: 0.48cm;    
    }

    .number2 {
      position: fixed;
      top: 20cm;
      left: 0cm;
      right: 0cm;
      height: 1cm;
      padding-bottom: 5px;
      padding-left: 0.48cm;
      padding-right: 0.48cm;    
    }

    footer {      
      bottom: -0.5cm;
      left: 0cm;
      right: 0cm;
      height: 5cm;
      padding-top: 10px;
      padding-bottom: 5px;
      padding-left: 0.48cm;
      padding-right: 0.48cm;    
    }

    .titleHead {
      border:1px #000 solid;
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
      border:1px #000 solid;
      font-weight: bold;
      max-width: 150px;
      word-wrap: break-word;
    }

    table>thead>tr>td,table>tbody>tr>td{
      vertical-align: top;
    }

    .br_break{
      line-height: 15px;
    }

    .br_break_no_bold{
      line-height: 18px;
    }

    .br{
      border-right: 1px #000 solid;
    }
    .bl{
      border-left: 1px #000 solid;
    }
    .bt{
      border-top: 1px #000 solid;
    }
    .bb{
      border-bottom:  1px #000 solid;
    }
    .bx{
      border-left: 1px #000 solid;
      border-right: 1px #000 solid;
    }
    .by{
      border-top: 1px #000 solid;
      border-bottom: 1px #000 solid;
    }
    .ball{
      border-top: 1px #000 solid;
      border-bottom: 1px #000 solid;
      border-left: 1px #000 solid;
      border-right: 1px #000 solid;
    }   
    .tab{
      display: inline-block; 
      width: 60px;
    }
    .tab2{
      display: inline-block; 
      width: 70px;
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
      margin:0;
      vertical-align: bottom;
      position: relative;
      top: 0px;
      *overflow: hidden;
    }
</style>

</head><body>
  <header>
    <table width="100%" border="1px" style="border-collapse: collapse !important;">
      <tr>
        <td width="15%;" style="padding: 10px;"><center><img src="<?php echo $project_data_portal[0]['project_logo']; ?>" style='width: 160px; height: 50px;' />&nbsp;&nbsp;&nbsp;<img src="img/ga_logo1.png" style='width: 50px; height: 50px;' />&nbsp;&nbsp;&nbsp;<img src="data:image/png;base64,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" style='width: 100px; height: 40px;' /></center></td>
      </tr>     
    </table>
     </br>
    <table width="100%" border="1px" style="border-collapse: collapse !important;">
      <head>
        <tr>
        <td ><b class="tab">EMPLOYER</b>: <?php echo strtoupper($data_list[0]["employer_title"]); ?></td>
        <td><b class="tab2">REPORT NO.</b>: <?php echo strtoupper($data_list[0]["report_no"]); ?></td>
      </tr><tr>
        <td ><b class="tab">PROJECT</b>: <?php echo strtoupper($data_list[0]["description"]); ?></td>
        <td><b class="tab2">DATE</b>: <?php echo date("d F Y",strtotime($data_list[0]["date_title"])); ?></td>
      </tr><tr>
        <td ><b class="tab">MODULE.</b>: <?php echo strtoupper($data_list[0]["module"]); ?></td>
        <td><b class="tab2">DRAWING NO.</b>: <?php echo strtoupper($data_list[0]["drawing_no"]); ?> </td>
      </tr><tr>
        <td ><b class="tab">CONTRACTOR</b>: <?php echo strtoupper($data_list[0]["contractor"]); ?></td>
        <td><b class="tab2">DESCRIPTION</b>:  <?php echo strtoupper($data_list[0]["description"]); ?></td>
      </tr><tr>
        <td colspan="2" class="bb bx" width="100%"><center><b>FIT UP INSPECTION REPORT - <?php echo strtoupper($data_list[0]["discipline"]); ?></b></center></td>
      </tr><tr>
        <td colspan="2" class="bb bx" width="100%"><left><b>DOCUMENT / SPECIFICATION / PROCEDURE No. / REFER to : <?php echo strtoupper($data_list[0]["referer_document"]); ?></b></left></td>
      </tr>
      </head>
    </table>
  </header>
  <table width="100%" border="0" style="text-align: left;border-collapse: collapse !important;">
    <thead><tr>
      <td rowspan="2" class="ball" style="vertical-align: middle; width: 15px !important;"><center><b>S/N</b></center></td>
      <td rowspan="2" class="ball" style="vertical-align: middle; width: 100px !important;"><center><b>Drawing/Weld Map No</b></center></td>
      <td rowspan="2" class="ball" style="vertical-align: middle; width: 30px !important;"><center><b>Item No./<br/>Joint No</b></center></td>
      <td rowspan="2" class="ball" style="vertical-align: middle; width: 50px !important;"><center><b>Type<br/>Of<br/>Weld</b></center></td>
      <td colspan="5" class="ball" style="vertical-align: middle;"><center><b>Material Traceability</b></center></td>
      <td rowspan="2" class="ball" style="vertical-align: middle; width: 40px !important;"><center><b>THK<br/>(MM)</b></center></td>
      <td rowspan="2" class="ball" style="vertical-align: middle; width: 40px !important;"><center><b>Length<br/>(MM)</b></center></td>
      <td rowspan="2" class="ball" style="vertical-align: middle; width: 40px !important;"><center><b>Tack Weld ID</b></center></td>
      <td rowspan="2" class="ball" style="vertical-align: middle;"><center><b>WPS</b></center></td>
      <td rowspan="2" class="ball" style="vertical-align: middle;"><center><b>Inspection<br/>Status</b></center></td>
      <td rowspan="2" class="ball" style="vertical-align: middle;"><center><b>Remarks</b></center></td>      
    </tr><tr>
      <td class="ball" style="vertical-align: middle; width: 60px !important;"><center><b>Desc</b></center></td>
      <td class="ball" style="vertical-align: middle; width: 100px !important;"><center><b>Piece Mark</b></center></td>
      <td class="ball" style="vertical-align: middle; width: 70px !important;"><center><b>Grade/Spec</b></center></td>
      <td class="ball" style="vertical-align: middle; width: 130px !important;"><center><b>Unique No.</b></center></td>
      <td class="ball" style="vertical-align: middle; "><center><b>Heat No.</b></center></td>     
    </tr></thead><tbody>
     
        <?php $no = 1; foreach ($data_list as $key => $value) { ?>

                  <tr>
                      <td rowspan="2" class="ball" style="vertical-align: middle;text-align: center;"><?php echo $no; ?></td>
                      <td rowspan="2" class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['drawing_weldmap'] ?></td>
                      <td rowspan="2" class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['item_joint_no'] ?></td>
                      <td rowspan="2" class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['type_of_weld'] ?></td>
                      <td class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['mtt_desc_1'] ?></td>
                      <td class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['mtt_piecemark_1'] ?></td>
                      <td class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['mtt_grade_1'] ?></td>
                      <td class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['mtt_unique_1'] ?></td>
                      <td class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['mtt_heat_no_1'] ?></td>
                      <td class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['mtt_thk_1'] ?></td>
                      <td rowspan="2"  class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['joint_length'] ?></td>
                      <td rowspan="2"  class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['tack_weld_id'] ?></td>
                      <td rowspan="2"  class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['wps_no'] ?></td>
                      <td rowspan="2"  class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['inspection_result'] ?></td>
                      <td rowspan="2"  class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['remarks'] ?></td>
                  </tr>
                  <tr>
                      <td class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['mtt_desc_2'] ?></td>
                      <td class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['mtt_piecemark_2'] ?></td>
                      <td class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['mtt_grade_2'] ?></td>
                      <td class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['mtt_unique_2'] ?></td>
                      <td class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['mtt_heat_no_2'] ?></td>
                      <td class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['mtt_thk_2'] ?></td>
                  </tr>

                <?php $no++; } ?></tbody>
  </table>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <table width="100%">
      <tr>
        <td colspan="16">      
          <table class="table-body" width="100%" style="text-align: left; border-collapse: collapse !important;">
            <tr>
              <td style="width: 25%; border: none;">
                <?php if(isset($sign_approval[$welding_rfi['approve_by']])){ ?>
                <img style="width:100px;" src="data:image/png;base64, <?php  echo $sign_approval[$welding_rfi['approve_by']]; ?>">
                <?php } ?>
              </td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;">
                <?php if(isset($sign_approval[$welding_rfi['client_by']])){ ?>
                <img style="width:100px;" src="data:image/png;base64, <?php  echo $sign_approval[$welding_rfi['client_by']]; ?>">
                <?php } ?>
              </td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;">
                <?php if(isset($sign_approval[$welding_rfi['third_party_by']])){ ?>
                <img style="width:100px;" src="data:image/png;base64, <?php  echo $sign_approval[$welding_rfi['third_party_by']]; ?>">
                <?php } ?>
              </td>
            </tr><tr>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
            </tr><tr>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
            </tr><tr>
              <td style="width: 25%; border: none;">
                <?php if(isset($sign_approval[$welding_rfi['approve_by']])){ ?>
                <?php echo $user_list[$welding_rfi['approve_by']]; ?>
                <?php } ?>
                <br>
                <b>_____________________</b>
              </td>
              <td style="width: 25%; border: none;"><b></b>
              </td>
              <td style="width: 25%; border: none;">
                <?php if(isset($sign_approval[$welding_rfi['client_by']])){ ?>
                <?php echo $user_list[$welding_rfi['client_by']]; ?>  
                <?php } ?>
                <br>
                <b>_____________________</b>
              </td>
              <td style="width: 25%; border: none;"><b></b>
              </td>
              <td style="width: 25%; border: none;">
                <?php if(isset($sign_approval[$welding_rfi['third_party_by']])){ ?>
                <?php echo $user_list[$welding_rfi['third_party_by']]; ?> 
                <?php } ?> 
                <br>
                <b>_____________________</b>
              </td>
            </tr><tr>
              <td style="width: 25%; border: none; padding-top: 10px;"><b>CONTRACTOR</b></td>
              <td style="width: 25%; border: none; padding-top: 10px;"><b></b></td>
              <td style="width: 25%; border: none; padding-top: 10px;"><b>EMPLOYER</b></td>
              <td style="width: 25%; border: none; padding-top: 10px;"><b></b></td>
              <td style="width: 25%; border: none; padding-top: 10px;"><b>THIRD PARTY</b></td>
            </tr><tr>
              <td style="width: 25%; border: none;">DATE : <?php  if(isset($welding_rfi['approve_date']) AND $welding_rfi['approve_date'] != "0000-00-00 00:00:00" || $welding_rfi['approve_date'] != "0000-00-00") { echo date("d F Y",strtotime($welding_rfi['approve_date'])); }; ?></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;">DATE : <?php  if(isset($welding_rfi['client_date']) AND $welding_rfi['client_date'] != "0000-00-00 00:00:00" || $welding_rfi['client_date'] != "0000-00-00") { echo date("d F Y",strtotime($welding_rfi['client_date'])); }; ?></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;">DATE : <?php  if(isset($welding_rfi['third_party_date']) AND $welding_rfi['third_party_date'] != "0000-00-00 00:00:00" || $welding_rfi['third_party_date'] != "0000-00-00") { echo date("d F Y",strtotime($welding_rfi['third_party_date'])); }; ?></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  <!-- <footer>
</footer> -->
</body></html>