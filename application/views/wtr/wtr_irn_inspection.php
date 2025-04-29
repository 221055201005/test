<?php error_reporting(0); $transmittal = $transmittal_list[0]; ?>

  <style type="text/css">

    .titleHead {
      border:1px #000 solid;
      border-collapse: collapse;
      text-align: center;
      vertical-align: middle;
      font-size: 100%;
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
      font-size: 100%;
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
      font-size: 100%;
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
      font-size: 100%;
      display: inline;
    }

    textarea {
      width: 95%;
      height: 250px !important;
    }

    .button {
      background-color: #4CAF50; /* Green */
      border: none;
      color: white;
      padding: 10px 10px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      transition-duration: 0.4s;
      cursor: pointer;
      border-radius: 10px;
    }

    .button2 {
      background-color: #00b52a; 
      color: white;
      border: 2px solid #00b52a;
    }

    .button2:hover {
      background-color: #017d1e;
      color: white;
    }

    .button3 {
      background-color: #d4ad00; 
      color: white;
      border: 2px solid #d4ad00;
    }

    .button3:hover {
      background-color: #e6bb00;
      color: white;
    }

    .button4 {
      background-color: #d42626; 
      color: white;
      border: 2px solid #d42626;
    }

    .button4:hover {
      background-color: #cc0000;
      color: white;
    }

  </style>
<div id="content" class="container-fluid bg-white overflow-auto">
  <div class="row">
    <div class="col-md-12">
      <br/>
      <br/>

      <center>

        <form method="POST" action="<?php echo base_url();?>irn/irn_process_approval" enctype="multipart/form-data" >

            <table  border="1px" style="border-collapse: collapse !important;" width="70%">
              <tr>
                <td rowspan='6' valign="middle" style="padding: 5px;width: 20% !important;vertical-align: middle !important;">
                  <center>
                    <img src="<?php echo base_url(); ?>img/logo_top_sofia.png" style="width: 450px;">
                  </center>
                </td>
                <td rowspan='6' valign="middle" style="font-size: 100%;padding: 5px;width: 60% !important;vertical-align: middle !important;font-weight: bold;font-size: 35px;"> 
                  <center><?php echo strtoupper($project_desc[$transmittal['project']]) ?><br/>INSPECTION RELEASE NOTE </center>
                </td>
                <td style="padding: 5px;vertical-align: middle !important;width: 20% !important;">DOC NO :</td>
              </tr>

              <tr>      
                <td style="padding: 5px;vertical-align: middle !important;"><b><?php echo strtoupper($transmittal['irn_transmitted_no']) ?></b></td>
              </tr>
              <tr>      
                <td style="padding: 5px;vertical-align: middle !important;">REV</td>
              </tr>
              <tr>
                <td style="padding: 5px;vertical-align: middle !important;"><b>0</b></td>
              </tr>
              <tr>        
                <td style="padding: 5px;vertical-align: middle !important;">PAGE </td>
              </tr>
              <tr>       
                <td style="padding: 5px;vertical-align: middle !important;"><b>-</b></td>
              </tr>
            </table>

            <br/>

            <table  border="1px" style="border-collapse: collapse !important;" width="70%"><tr>
                <td colspan="2" valign="middle" style="padding: 5px;width: 80% !important;vertical-align: middle !important;">Document Reference No : </td>       
                <td style="padding: 5px;vertical-align: middle !important;width: 20% !important;">DATE : <?php echo date("F d, Y",strtotime($transmittal['irn_transmitted_datetime'])) ?></td>
              </tr></table>
            <table  border="1px" style="border-collapse: collapse !important;" width="70%"><tr>
                <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">Location of Origin :</td>   
              </tr></table>
            <table  border="1px" style="border-collapse: collapse !important;" width="70%"><?php foreach($transmittal_list as $value){ ?><tr>
                <td  valign="middle" style="padding: 5px;width: 20% !important;vertical-align: middle !important;">Drawing No :</td>       
                <td  valign="middle" style="padding: 5px;width: 60% !important;vertical-align: middle !important;"><?php echo $value['drawing_no'] ?></td>      
                <td style="padding: 5px;vertical-align: middle !important;width: 20% !important;">Rev : 0</td>
              </tr><?php } ?></table>
            <table  border="1px" style="border-collapse: collapse !important;" width="70%"><tr>
                <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">Description :</td>   
              </tr><?php foreach($transmittal_list as $value){ ?><tr>
                <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;"> <?php echo $title_document[$value['drawing_no']] ?> </td><?php } ?>  
              </tr></table>
            <table  border="1px" style="border-collapse: collapse !important;" width="70%"><tr>
                <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">
                 <center><b>Item described below requested to be release for next further handling (<span style='text-decoration: line-through;'>Installation</span>/Blasting & Painting/<span style='text-decoration: line-through;'>Galvanized</span>/<span style='text-decoration: line-through;'>Erection</span>)</b></center></td>   
              </tr></table>

              <!-- item for releases -->
             
              <table  border="1px" style="border-collapse: collapse !important;" width="70%"><tr>
                <td colspan="8" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">Item Number :</td>   
              </tr>
                <?php $no_data = 1; foreach($piecemark_list as $value_pc){ ?>
                  <tr>
                    <td valign="middle" style="padding: 5px;width: 1% !important;vertical-align: middle !important;">
                      <?php echo  $no_data; ?>
                    </td>   
                    <td colspan="2" valign="middle" style="padding: 5px;width: 99% !important;vertical-align: middle !important;">
                      <?php echo $value_pc; ?>
                    </td>
                  </tr>  
                <?php $no_data++; } ?>
              </table>      

              <table  border="1px" style="border-collapse: collapse !important;" width="70%"><tr>
                <td  colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">Total : <?php echo $no_data - 1; ?> ea </td>  
              </tr></table>

              <!-- item for releases -->
            <table  border="1px" style="border-collapse: collapse !important;" width="70%"><tr>
              <td colspan="6" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">Detail Checklist :</td>   
              </tr><tr>
                <td valign="middle" style="padding: 5px;width: 2% !important;vertical-align: middle !important;"></td>   
                <td valign="middle" style="padding: 5px;width: 20% !important;vertical-align: middle !important;"></td>   
                <td valign="middle" style="padding: 5px;width: 8% !important;vertical-align: middle !important;"><center>YES / NO / NA</center></td> 
                <td valign="middle" style="padding: 5px;width: 2% !important;vertical-align: middle !important;"></td>   
                <td valign="middle" style="padding: 5px;width: 20% !important;vertical-align: middle !important;"></td>   
                <td valign="middle" style="padding: 5px;width: 8% !important;vertical-align: middle !important;"><center>YES / NO / NA</center></td>  
              </tr>

                <?php $row = 5; $col = 2; for($i = 1; $i<$row+1; $i++): ?>

                <tr>
                  <?php for($c = 0; $c<$col; $c++): ?>

                  <?php 
                    $index = ($i + ($c*$row)) - 1;
                  ?>
                  <td valign="middle" style="padding: 5px;width: 2% !important;vertical-align: middle !important;text-align: center;">
                    <?php if(isset($master_irn_detail[$index]['id_irn_detail'])){ ?>

                      <input type="hidden" value='<?php echo $master_irn_detail[$index]['id_irn_detail'] ?>' name="id_master_irn_detail[<?php echo $index; ?>]"> 

                      <input type="hidden" name="id_pcms_irn_detail[<?php echo $index; ?>]" value='<?php echo $irn_pcms_detail[$master_irn_detail[$index]['id_irn_detail']]['id_pcms_irn_detail']; ?>'>

                    <?php } ?>
                    <?= isset($master_irn_detail[$index]) ? $master_irn_detail[$index]['id_irn_detail'] : '' ?>
                  </td>
                  <td valign="middle" style="padding: 5px;width: 20% !important;vertical-align: middle !important;"><?= isset($master_irn_detail[$index]) ? $master_irn_detail[$index]['inspection_desc'] : '' ?></td>
                  <td valign="middle" style="padding: 5px;width: 15% !important;vertical-align: middle !important;text-align: center;">
                      <?php if(isset($master_irn_detail[$index])){ ?>
                        <span style="display: inline-block !important;width: 70px !important;">
                          <label><input type="radio" name="result[<?php echo $index; ?>]" value='YES' <?php if($irn_pcms_detail[$master_irn_detail[$index]['id_irn_detail']]['irn_inspection_result'] == 'YES'){ echo "checked"; } ?> <?php if($this->user_cookie[7] == 8){ echo "disable"; } ?> required>&nbsp;&nbsp;&nbsp;YES</label>
                          </span>
                          <span style="display: inline-block !important;width: 70px !important;">
                          <label><input type="radio" name="result[<?php echo $index; ?>]" value='NO' <?php if($irn_pcms_detail[$master_irn_detail[$index]['id_irn_detail']]['irn_inspection_result'] == 'NO'){ echo "checked"; } ?> <?php if($this->user_cookie[7] == 8){ echo "disable"; } ?> required>&nbsp;&nbsp;&nbsp;NO</label>
                          </span>
                          <span style="display: inline-block !important;width: 70px !important;">
                          <label><input type="radio" name="result[<?php echo $index; ?>]" value='N/A' <?php if($irn_pcms_detail[$master_irn_detail[$index]['id_irn_detail']]['irn_inspection_result'] == 'N/A'){ echo "checked"; } ?> <?php if($this->user_cookie[7] == 8){ echo "disable"; } ?> required>&nbsp;&nbsp;&nbsp;N/A</label>
                        </span>
                      <?php } else { echo "&nbsp;"; } ?>
                  </td>
                  <?php endfor; ?>
                </tr>
                <?php endfor; ?>
            </table>
            <table  border="1px" style="border-collapse: collapse !important;" width="70%"><tr>
                <td  colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;"><center>Notes on checklist : if any item hasbeen checked / verified / inspected prior to release this release note, the item shall be ticked as “ YES”, and if the item has not been checked/verified/inspected prior to release this release note, the item shall be ticked as “NO”, and if does not relevant  on one of them, it should be ticked as ” N/A ”</center></td></tr></table>

            <table  border="1px" style="border-collapse: collapse !important;" width="70%">
              <tr>
                <td  colspan="3" valign="middle" style="padding: 5px;width: 100% !important;font-size: 20px !important;vertical-align: middle !important;">
                  <center>
                    <b>INSPECTION EXECUTION RESULT</b>
                  </center>
                </td>
              </tr>
              <tr>
                <td  colspan="3" valign="middle" style="padding: 5px;width: 100% !important;font-size: 20px !important;vertical-align: middle !important;">
                  <center>
                    <table width="100%">
                      <tr>
                        <td style="width: 15% !important;"><center><label><input type="radio" name='inspection_result' value="1" <?php if($transmittal['irn_inspection_result'] == '1'){ echo "checked"; } ?>> Accepted</label></center></td>
                        <td style="width: 30% !important;"><center><label><input type="radio" name='inspection_result' value="2" <?php if($transmittal['irn_inspection_result'] == '2'){ echo "checked"; } ?>> Accepted & Released With Comment</label></center></td>
                        <td style="width: 15% !important;"><center><label><input type="radio" name='inspection_result' value="3" <?php if($transmittal['irn_inspection_result'] == '3'){ echo "checked"; } ?>> Rejected</label></center></td>
                        <td style="width: 20% !important;"><center><label><input type="radio" name='inspection_result' value="4" <?php if($transmittal['irn_inspection_result'] == '4'){ echo "checked"; } ?>> Postpone</label></center></td>
                        <td style="width: 20% !important;"><center><label><input type="radio" name='inspection_result' value="5" <?php if($transmittal['irn_inspection_result'] == '5'){ echo "checked"; } ?>> Re-Offer</label></center></td>
                      </tr>
                    </table>
                  </center>
                </td>
              </tr>
            </table>

            <table  border="1px" style="border-collapse: collapse !important;" width="70%"><tr>
              <td style="text-align:left; padding-bottom: 4px; ">
                <b>Remarks :</b><br/>
                <textarea name='remarks' class="form-control"><?php echo $transmittal['irn_remarks'] ?></textarea>
              </td>
            </tr></table>
            <table width="70%" border="1px" style="border-collapse: collapse;">
                <tr>
                  <!-- <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold;">SUPLIER</td> -->
                  <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:33.33%;" >CONTRACTOR</td>
                  <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:33.33%;">EMPLOYER</td>
                  <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:33.33%;">THIRD PARTY</td>
                </tr>
                <tr>
                  <td style="padding-bottom: 4px; ">NAME <b><?php if(isset($user[$transmittal['irn_approval_by']]['full_name'])){ echo $user[$transmittal['irn_approval_by']]['full_name']; } ?></b></td>
                  <td style="padding-bottom: 4px; ">NAME <b><?php if(isset($user[$transmittal['irn_approval_by_client']]['full_name'])){ echo  $user[$transmittal['irn_approval_by_client']]['full_name']; } ?></b></td>
                  <td style="padding-bottom: 4px; ">NAME</td>
                </tr>
                 <tr>
                  <td style="padding-bottom: 4px; ">SIGNATURE<br/>
                    <?php if(isset($user[$transmittal['irn_approval_by']]['sign_approval'])){ ?>

                    <center>
                      <img src="data:image/png;base64,<?= $user[$transmittal['irn_approval_by']]['sign_approval'] ?>" style="width: 50% !important; height: 5% !important">
                    </center>

                    <?php } else { ?> 
                      <input type="hidden" name='irn_no' value="<?php echo $transmittal['irn_transmitted_no']; ?>">
                      <input type="hidden" name='sign_status' value="smoe">
                      <br/><br/>
                      <center>
                        <button type="submit" class="button button2" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&#10004; Digital Sign</span>
                        </button>
                      </center>
                      <br/><br/>
                    <?php } ?>
                  </td>

                  <td style="padding-bottom: 4px; ">SIGNATURE<br/>
                    <?php if(isset($user[$transmittal['irn_approval_by_client']]['sign_approval'])){ ?>

                    <center>
                      <img src="data:image/png;base64,<?= $user[$transmittal['irn_approval_by_client']]['sign_approval'] ?>" style="width: 50% !important; height: 5% !important">
                    </center>

                     <?php } else { ?>
                        <?php if(isset($user[$transmittal['irn_approval_by']]['full_name']) AND $this->user_cookie[7] == 8){ ?> 
                          <input type="hidden" name='irn_no' value="<?php echo $transmittal['irn_transmitted_no']; ?>">
                          <input type="hidden" name='sign_status' value="client">
                          <br/><br/>
                          <center>
                            <button type="submit" class="button button2" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&#10004; Digital Sign</span>
                            </button>
                          </center>
                          <br/><br/>
                        <?php } ?>
                    <?php } ?>
                  </td>

                  <td style="padding-bottom: 4px; ">SIGNATURE<br/><br/><br/>
                  </td>
                </tr>
                 <tr>
                  <td style="padding-bottom: 4px; ">Date
                     <?php if(isset($user[$transmittal['irn_approval_by']]['sign_approval'])){ ?>
                      <b><?php echo date("Y-m-d",strtotime($transmittal['irn_approval_by_datetime'])); ?></b>
                     <?php } ?>
                  </td>
                  <td style="padding-bottom: 4px; ">Date 
                     <?php if(isset($user[$transmittal['irn_approval_by_client']]['sign_approval'])){ ?>
                    <b><?php echo date("Y-m-d",strtotime($transmittal['irn_approval_by_client_datetime'])); ?></b>
                      <?php } ?>
                  </td>
                  <td style="padding-bottom: 4px; ">Date</td>
                </tr>
            </table>  

            <?php if(isset($user[$transmittal['irn_approval_by']]['full_name']) AND $this->user_cookie[7] != 8){ ?>
                <br/>
                <?php if(isset($irn_pcms_detail[1]['update_by'])){ ?> 
                    <b><i>Latest Update By : <?php echo $user[$irn_pcms_detail[1]['update_by']]['full_name']; ?> - on : <?php echo $irn_pcms_detail[1]['update_by_date']; ?></i></b>
                <?php } ?>           
                <br/>            
                <br/>            
                    <input type="hidden" name='irn_no' value="<?php echo $transmittal['irn_transmitted_no']; ?>">
                    <input type="hidden" name='process_status' value="update">          
                    <button type="submit" class="button button3" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&#10004; Update Data</span>
                    </button>

                    <a target='_blank' href="<?php echo  base_url(); ?>irn/wtr_irn/<?php echo strtr($this->encryption->encrypt($transmittal['irn_transmitted_no']),'+=/', '.-~') ; ?>" class="button button4"> <i class="fas fa-file-pdf"></i> PDF</a>

                    <a target='_blank' href="<?php echo  base_url(); ?>planning/workpack_irn_new_process/<?php echo strtr($this->encryption->encrypt($transmittal['irn_transmitted_no']),'+=/', '.-~') ; ?>" class="button button2"> <i class="fas fa-plus"></i> Create Workpack</a>
                  
                <br/><br/>
            <?php } ?>

          </form>

          <table  border="1px" style="border-collapse: collapse !important;" width="70%">
                <tr>
                  <td valign="middle" style="padding: 5px;font-size: 125% !important;vertical-align: middle !important;"><b><i>Supporting Documentation :</i></b></td>   
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
                </tr>
                <?php } ?>          
              </table>

              <?php if(sizeof($irn_dc) > 0){ ?>
                <table  border="1px" style="border-collapse: collapse !important;" width="70%">
                  <tr>
                    <td  valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;"><b>Dimentional Control ( DC ) :</b></td>   
                  </tr> 
                  <?php foreach($irn_dc as $value){ ?>
                    <tr>
                      <td valign="middle" style="padding: 5px;vertical-align: middle !important;">
                        <a target='_blank' href="<?= $this->link_server ?>/pcms_v2_photo/dc_file/<?php echo $value['dc_attachment'] ?>">
                          <?php echo $value['dc_desc'] ?>
                        </a>
                      </td>
                    </tr>
                  <?php } ?>               
                </table>
              <?php } ?>
              <?php if(sizeof($irn_pnc) > 0){ ?>
              <table  border="1px" style="border-collapse: collapse !important;" width="70%">
                <tr>
                  <td  valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;"><b>Punchlist :</b></td>   
                </tr> 
                <?php foreach($irn_pnc as $value){ ?>
                    <tr>
                      <td valign="middle" style="padding: 5px;vertical-align: middle !important;">
                        <a target='_blank' href="<?= $this->link_server ?>/pcms_v2_photo/punchlist_file/<?php echo $value['pnc_attachment'] ?>">
                          <?php echo $value['pnc_desc'] ?>
                        </a>
                      </td>
                    </tr>
                  <?php } ?>              
              </table>
              <?php } ?>
</center>
      </div>
      </div>
      </div>
      </div>