<?php error_reporting(0); $transmittal = $transmittal_list[0]; ?>
<!DOCTYPE html>
<html><head>
  <title><?php echo $transmittal['irn_transmitted_no'] ?>.pdf</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.5">
  <link rel="shortcut icon" href="img/favicon.png"/>
  <style type="text/css">
   
    @page {
      margin: 0cm 0cm;
    }

    body {
      top: 0cm;
      left: 0cm;
      right: 0cm;
      margin-top: 5.4cm;
      margin-left: 1.5cm;
      margin-right: 1.5cm;
      margin-bottom: 0cm;
      font-family: "helvetica";
      font-size: 9px;
    }


    footer {
      position: fixed;
      top: 21.3cm;
      left: 0cm;
      right: 0cm;
      height: 5cm;
      padding-top: 3px;
      padding-left: 1.5cm;
      padding-right: 1.5cm;
      font-size: 9px;
    }

    header {
      position: fixed;
      top: 1cm;
      left: 0cm;
      right: 0cm;
      height: 2cm;
      padding-top: 2px;
      padding-left: 1.5cm;
      padding-right: 1.5cm;
      font-size: 9px;
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
      border-right: 1px #000 solid !important;
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
      width: 130px;
    }
    .tab2{
      display: inline-block; 
      width: 130px;
    }
    .text-nowrap{
      white-space: nowrap;
    }
    .valign-middle{
      vertical-align: middle;
    }
    label {
      display: block;
      padding-left: 2px;
      padding-bottom: 5px;
      padding-top: 1px;
      text-indent: 1px;
      font-size: 9px;
    }

    input {
      width: 16px;
      height: 16px;
      padding: 0;
      margin:0;
      vertical-align: bottom;
      position: relative;
      top: -1px;
      *overflow: hidden;
    }

    input[type=checkbox]
    {
      /* Double-sized Checkboxes */
      -ms-transform: scale(0.8); /* IE */
      -moz-transform: scale(0.8); /* FF */
      -webkit-transform: scale(0.8); /* Safari and Chrome */
      -o-transform: scale(0.8); /* Opera */
      transform: scale(0.8);
      /*padding: 1px;*/
    }

    /* Might want to wrap a span around your checkbox text */
    .checkboxtext
    {
      /* Checkbox text */
      font-size: 9px;
      display: inline;
    }
    .page_break { page-break-before: always; }
  </style>
</head><body>

  <header>
      <table  border="1px" style="border-collapse: collapse !important;" width="100%"><tr>
        <td rowspan='3' valign="middle" style="padding: 5px;width: 20% !important;vertical-align: middle !important;"><center>
              <img src="img/sembcorp-logo.png" style="width: 120px;">
            </center>
            <!-- <img src="img/logo.png" style="width: 120px;"> -->
          </td>
          <td rowspan='6' valign="middle" style="font-size: 15px;padding: 5px;width: 60% !important;vertical-align: middle !important;font-weight: bold;"> 
            <center><?php echo strtoupper($project_desc[$transmittal['project']]) ?><br/>INSPECTION RELEASE NOTE </center>
          </td>
          <td style="padding: 5px;vertical-align: middle !important;width: 20% !important;">DOC NO :</td>
        </tr><tr>      
          <td style="padding: 5px;vertical-align: middle !important;"><b><?php echo strtoupper($transmittal['irn_transmitted_no']) ?></b></td>
        </tr><tr>      
          <td style="padding: 5px;vertical-align: middle !important;">REV</td>
        </tr><tr>
          <td rowspan='3' valign="middle" style="padding: 5px;vertical-align: middle !important;">
            <center>
              <img src="<?php echo $project_logo[$transmittal['project']]; ?>" style="width: 120px;">
            </center>
          </td>
          <td style="padding: 5px;vertical-align: middle !important;"><b>0</b></td>
        </tr><tr>        
          <td style="padding: 5px;vertical-align: middle !important;">PAGE </td>
        </tr><tr>       
          <td style="padding: 5px;vertical-align: middle !important;"><b> </b></td>
        </tr></table>
</header>
    <br/>
      <table  border="1px" style="border-collapse: collapse !important;" width="100%"><tr>
          <td colspan="2" valign="middle" style="padding: 5px;width: 80% !important;vertical-align: middle !important;">Document Reference No : </td>       
          <td style="padding: 5px;vertical-align: middle !important;width: 20% !important;">DATE : <?php echo date("F d, Y",strtotime($transmittal['irn_transmitted_datetime'])) ?></td>
        </tr></table>
      <table  border="1px" style="border-collapse: collapse !important;" width="100%"><tr>
          <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">Location of Origin :</td>   
        </tr></table>
      <table  border="1px" style="border-collapse: collapse !important;" width="100%"><?php foreach($transmittal_list as $value){ ?><tr>
          <td  valign="middle" style="padding: 5px;width: 20% !important;vertical-align: middle !important;">Drawing No :</td>       
          <td  valign="middle" style="padding: 5px;width: 60% !important;vertical-align: middle !important;"><?php echo $value['drawing_no'] ?></td>       
          <td style="padding: 5px;vertical-align: middle !important;width: 20% !important;">Rev : 0</td>
        </tr><?php } ?></table>
      <table  border="1px" style="border-collapse: collapse !important;" width="100%"><tr>
          <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">Description :</td>   
        </tr><?php foreach($transmittal_list as $value){ ?><tr>
          <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;"> <?php echo $title_document[$value['drawing_no']] ?> </td><?php } ?>  
        </tr></table>
      <table  border="1px" style="border-collapse: collapse !important;" width="100%"><tr>
          <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">
           <center><b>Item described below requested to be release for next further handling (<span style='text-decoration: line-through;'>Installation</span>/Blasting & Painting/<span style='text-decoration: line-through;'>Galvanized</span>/<span style='text-decoration: line-through;'>Erection</span>)</b></center></td>   
        </tr></table>

        <!-- item for releases -->

        <table  border="1px" style="border-collapse: collapse !important;" width="100%"><tr>
          <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">Item Number :</td>   
        </tr><?php $no_data = 1; foreach($piecemark_list as $value_pc){ ?><tr>
          <td valign="middle" style="padding: 5px;width: 20px !important;vertical-align: middle !important;"><?php echo  $no_data; ?></td>   
          <td colspan="2" valign="middle" style="padding: 5px;width: 580px !important;vertical-align: middle !important;"><?php echo $value_pc; ?></td><?php $no_data++;} ?>
        </tr></table>      

        <table  border="1px" style="border-collapse: collapse !important;" width="100%"><tr>
          <td  colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">Total : <?php echo $no_data - 1; ?> ea</td>  
        </tr></table>

        <!-- item for releases -->
      <table  border="1px" style="border-collapse: collapse !important;" width="100%"><tr>
          <td colspan="6" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">Detail Checklist :</td>   
        </tr><tr>
          <td valign="middle" style="padding: 5px;width: 20px; !important;vertical-align: middle !important;"></td>   
          <td valign="middle" style="padding: 5px;width: 230px; !important;vertical-align: middle !important;"></td>   
          <td valign="middle" style="padding: 5px;width: 50px !important;vertical-align: middle !important;"><center>YES/NO/NA</center></td>
          <td valign="middle" style="padding: 5px;width: 20px; !important;vertical-align: middle !important;"></td>   
          <td valign="middle" style="padding: 5px;width: 230px; !important;vertical-align: middle !important;"></td>   
          <td valign="middle" style="padding: 5px;width: 50px !important;vertical-align: middle !important;"><center>YES/NO/NA</center></td>   
        </tr>
        <?php $row = 5; $col = 2; for($i = 1; $i<$row+1; $i++): ?>

          <tr>
            <?php for($c = 0; $c<$col; $c++): ?>

            <?php 
              $index = ($i + ($c*$row)) - 1;
            ?>
            <td valign="middle" style="padding: 5px;width: 20px; !important;vertical-align: middle !important;text-align: center;">
              <?= isset($master_irn_detail[$index]) ? $master_irn_detail[$index]['id_irn_detail'] : '' ?>
            </td>
            <td valign="middle" style="padding: 5px;width: 230px; !important;vertical-align: middle !important;"><?= isset($master_irn_detail[$index]) ? $master_irn_detail[$index]['inspection_desc'] : '' ?></td>
            <td valign="middle" style="padding: 5px;width: 50px !important;vertical-align: middle !important;text-align: center;">
                <?php if(isset($master_irn_detail[$index])){ echo $irn_pcms_detail[$master_irn_detail[$index]['id_irn_detail']]['irn_inspection_result']; } else { echo "&nbsp;"; } ?>
            </td>
            <?php endfor; ?>
          </tr>
          <?php endfor; ?>
      </table>
      <table  border="1px" style="border-collapse: collapse !important;" width="100%"><tr>
          <td  colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;"><center>Notes on checklist : if any item hasbeen checked/verified/inspected prior to release this release note, the item shall be ticked as “ YES”, and if the item has not been checked/verified/inspected prior to release this release note, the item shall be ticked as “NO”, and if does not relevant  on one of them, it should be ticked as” NA”</center></td></tr></table>
      <table  border="1px" style="border-collapse: collapse !important;" width="100%">
        <tr>
          <td  colspan="3" valign="middle" style="padding: 5px;width: 100% !important;font-size: 10px !important;vertical-align: middle !important;">
            <center>
              <b>INSPECTION EXECUTION RESULT</b>
            </center>
          </td>
        </tr>
        <tr>
          <td  colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">
            <center>
              <table width="100%">
                <tr>
                  <td style="width: 15% !important;"><label><input type="checkbox" name='inspection_result' value="1" <?php if($transmittal['irn_inspection_result'] == '1'){ echo "checked"; } ?>> Accepted</label></td>
                  <td style="width: 30% !important;"><label><input type="checkbox" name='inspection_result' value="2" <?php if($transmittal['irn_inspection_result'] == '2'){ echo "checked"; } ?>> Accepted & Released With Comment</label></td>
                  <td style="width: 15% !important;"><label><input type="checkbox" name='inspection_result' value="3" <?php if($transmittal['irn_inspection_result'] == '3'){ echo "checked"; } ?>> Rejected</label></td>
                  <td style="width: 20% !important;"><label><input type="checkbox" name='inspection_result' value="4" <?php if($transmittal['irn_inspection_result'] == '4'){ echo "checked"; } ?>> Postpone</label></td>
                  <td style="width: 20% !important;"><label><input type="checkbox" name='inspection_result' value="5" <?php if($transmittal['irn_inspection_result'] == '5'){ echo "checked"; } ?>> Re-Offer</label></td>
                </tr>
              </table>
            </center>
          </td>
        </tr>
      </table>    

      <table  border="1px" style="border-collapse: collapse !important;" width="100%"><tr>
        <td style="text-align:left; padding-bottom: 4px; font-size: 12px !important;"><b>Remarks :<br/><br/><br/><br/></b></td>
      </tr></table>
      <table width="100%" border="1px" style="border-collapse: collapse;">
          <tr>
            <!-- <td style="text-align:center; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold;">SUPLIER</td> -->
            <td style="text-align:center; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold; width:33.33%;" >CONTRACTOR</td>
            <td style="text-align:center; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold; width:33.33%;">EMPLOYER</td>
            <td style="text-align:center; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold; width:33.33%;">THIRD PARTY</td>
          </tr>
          <tr>
            <!-- <td style="padding-bottom: 4px; font-size: 10px !important;">NAME</td> -->
            <td style="padding-bottom: 4px; font-size: 10px !important;">NAME <b><?php if(isset($user[$transmittal['irn_approval_by']]['full_name'])){ echo $user[$transmittal['irn_approval_by']]['full_name']; } ?></b></td>
            <td style="padding-bottom: 4px; font-size: 10px !important;">NAME <b><?php if(isset($user[$transmittal['irn_approval_by_client']]['full_name'])){ echo  $user[$transmittal['irn_approval_by_client']]['full_name']; } ?></b></td>
            <td style="padding-bottom: 4px; font-size: 10px !important;">NAME</td>
          </tr>
           <tr>
            <!-- <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE<br/><br/><br/></td> -->
            <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE<br/>
              <?php if(isset($user[$transmittal['irn_approval_by']]['sign_approval'])){ ?>
              <img src="data:image/png;base64,<?= $user[$transmittal['irn_approval_by']]['sign_approval'] ?>" style="width: 200px !important; height: 100px !important">
            <?php } ?>
            </td>

            <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE<br/>
              <?php if(isset($user[$transmittal['irn_approval_by_client']]['sign_approval'])){ ?>
              <img src="data:image/png;base64,<?= $user[$transmittal['irn_approval_by_client']]['sign_approval'] ?>" style="width: 200px !important; height: 100px !important">
               <?php } ?>
            </td>

            <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE<br/><br/><br/>
            </td>
          </tr>
           <tr>
            <!-- <td style="padding-bottom: 4px; font-size: 10px !important;">Date</td> -->
            <td style="padding-bottom: 4px; font-size: 10px !important;">Date 
               <?php if(isset($user[$transmittal['irn_approval_by']]['sign_approval'])){ ?>
              <b><?php echo date("Y-m-d",strtotime($transmittal['irn_approval_by_datetime'])); ?></b>
               <?php } ?>
            </td>
            <td style="padding-bottom: 4px; font-size: 10px !important;">Date 
               <?php if(isset($user[$transmittal['irn_approval_by_client']]['sign_approval'])){ ?>
              <b><?php echo date("Y-m-d",strtotime($transmittal['irn_approval_by_client_datetime'])); ?></b>
                <?php } ?>
            </td>
            <td style="padding-bottom: 4px; font-size: 10px !important;">Date</td>
          </tr>
      </table>

      <div class="page_break"></div>

      <table  border="1px" style="border-collapse: collapse !important" width="100%">
        <tr>
            <td valign="middle" style="padding: 5px;vertical-align: middle !important;"><b>Attachment File :</b></td>   
          </tr>
          <tr>
            <td valign="middle" style="padding: 5px;vertical-align: middle !important;"><b>Welding Traceability Report ( WTR ) :</b></td>   
          </tr>
          <?php foreach($transmittal_list as $value){ ?>
          <tr>
            <td valign="middle" style="padding: 5px;vertical-align: middle !important;">
              <a target='_blank' href="<?php echo base_url(); ?>wtr/wtr_list_detail/<?php echo strtr($this->encryption->encrypt($value['project']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['drawing_no']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['drawing_type']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['discipline']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['module']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['type_of_module']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt("pdf"),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($transmittal['irn_transmitted_no']),'+=/', '.-~'); ?>">
                <?php echo $value['drawing_no'] ?>
              </a>
            </td>
          <?php } ?>
          </tr>
        </table>

        <?php if(sizeof($irn_dc) > 0){ ?>
                <table  border="1px" style="border-collapse: collapse !important;" width="100%">
                  <tr>
                    <td  valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;"><b>Dimentional Control ( DC ) :</b></td>   
                  </tr> 
                  <?php foreach($irn_dc as $value){ ?>
                    <tr>
                      <td valign="middle" style="padding: 5px;vertical-align: middle !important;">
                        <a target='_blank' href="https://www.smoebatam.com/pcms_v2_photo/dc_file/<?php echo $value['dc_attachment'] ?>">
                          <?php echo $value['dc_desc'] ?>
                        </a>
                      </td>
                    </tr>
                  <?php } ?>               
                </table>
              <?php } ?>
              <?php if(sizeof($irn_pnc) > 0){ ?>
              <table  border="1px" style="border-collapse: collapse !important;" width="100%">
                <tr>
                  <td  valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;"><b>Punchlist :</b></td>   
                </tr> 
                <?php foreach($irn_pnc as $value){ ?>
                    <tr>
                      <td valign="middle" style="padding: 5px;vertical-align: middle !important;">
                        <a target='_blank' href="https://www.smoebatam.com/pcms_v2_photo/punchlist_file/<?php echo $value['pnc_attachment'] ?>">
                          <?php echo $value['pnc_desc'] ?>
                        </a>
                      </td>
                    </tr>
                  <?php } ?>              
              </table>
              <?php } ?>
 
</body></html>