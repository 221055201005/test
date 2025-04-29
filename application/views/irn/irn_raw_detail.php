<style>
   

    .table_content {
      text-align: center;
    }

</style>
<div id="content" class="container-fluid">
  <div class="row">
    <div class="col-md-12">

  
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">

            <form action="<?php echo base_url(); ?>irn/irn_approval" method='POST' id="form_submition">
      
              <table  border="1px" style="border-collapse: collapse !important;font-weight: bold;color: #000000;" width="100%">
                <tr>
                  <td valign="middle" style="padding: 5px;width: 20% !important;vertical-align: middle !important;">
                    <center><img src="<?php echo base_url(); ?>img/logo.png" style="width: 250px;"></center>
                  </td>
                  <td valign="middle" style="font-size: 100%;padding: 5px;width: 60% !important;vertical-align: middle !important;font-weight: bold;font-size: 35px;"> 
                    <center>RAW MATERIALS RELEASE NOTE FOR BLASTING AND PAINTING</center>
                  </td>
                  <td valign="middle" style="padding: 5px;vertical-align: middle !important;width: 20% !important;">
                    <center> <img src="<?php echo base_url(); ?>img/logo_top_sofia.png" style="width: 450px;"> </center>
                  </td>
                </tr>
              </table>
              <table  border="1px" style="border-collapse: collapse !important;" width="100%">
                <tr>
                  <td valign="middle" colspan="3">
                    &nbsp;
                  </td>
                </tr>
              </table>
              <table  border="1px" style="border-collapse: collapse !important;font-weight: bold;color: #000000;" width="100%">
                <tr>
                  <td valign="middle" style="padding: 10px !important;"> Release Note </td>
                  <td valign="middle" style="width: 700px;padding: 10px !important;"> &nbsp; : <?php echo $irn_list[0]['irn_transmitted_no']; ?></td>
                  <td valign="middle" style="padding: 10px !important;"> Location</td>
                  <td valign="middle" style="padding: 10px !important;"> &nbsp; : <?php echo $location_list[$irn_list[0]['material_location']]["location_name"]; ?></td>
                </tr>
                <tr>
                  <td valign="middle" style="padding: 10px !important;"> Date Of Issued </td>
                  <td valign="middle" style="padding: 10px !important;"> &nbsp; :  <?php echo $irn_list[0]['irn_transmitted_datetime']; ?></td>
                  <td valign="middle" style="padding: 10px !important;"> Project Ref</td>
                  <td valign="middle" style="padding: 10px !important;"> &nbsp; :  <?php echo $project_code[$irn_list[0]['irn_project']]; ?></td>
                </tr>
              </table>
              <table  border="1px" style="border-collapse: collapse !important;" width="100%">
                <tr>
                  <td valign="middle" colspan="3">
                    &nbsp;
                  </td>
                </tr>
              </table>
              <table  border="1px" style="border-collapse: collapse !important;color: #000000;padding: 25px !important;" width="100%">
                <thead>
                  <tr style="font-weight: bold;color: #000000;">
                    <td valign="middle" rowspan="2" class="font-weight-bold" style="padding: 10px !important;width: 3% !important;"><center>S/No</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold" style="padding: 10px !important;width: 15% !important;"><center>Description</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold" style="padding: 10px !important;width: 10% !important;"><center>Spec/Grade</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold" style="padding: 10px !important;width: 10% !important;"><center>Heat/Series No</center></td>
                    <td valign="middle" colspan="3" class="font-weight-bold" style="padding: 10px !important;"><center>Size ( In MM )</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold" style="padding: 10px !important;"><center>Qty</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold" style="padding: 10px !important;"><center>UoM</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold" style="padding: 10px !important;"><center>MRIR No.</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold" style="padding: 10px !important;"><center>Unique Ident No.</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold" style="padding: 10px !important;"><center>Return Received ( QTY )</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold" style="padding: 10px !important;"><center>Remarks</center></td>
                   
                  </tr>
                  <tr>
                    <td valign="middle" class="font-weight-bold" style="padding: 10px !important;"><center>Length</center></td>
                    <td valign="middle" class="font-weight-bold" style="padding: 10px !important;"><center>Width/OD</center></td>
                    <td valign="middle" class="font-weight-bold" style="padding: 10px !important;"><center>Thk</center></td>                  
                  </tr>
                </thead>
                <tbody>

                   <?php 
                        $no = 1;
                        $sum = 0; 
                        foreach ($irn_list as $key => $value) { 

                          $report_no = explode("/",$uniq_no_list[$value['id_master_irn_detail']]['report_no']); 
                    ?>
                    <tr class="table_content">
                      <td style="padding: 10px !important;"><?php echo $no; ?></td>
                      <td style="padding: 10px !important;"><?php echo @$material_catalog_list[$value['id_template']]['material']; ?></td>
                      <td style="padding: 10px !important;"><?php echo @$uniq_no_list[$value['id_master_irn_detail']]['spec']; ?></td>
                      <td style="padding: 10px !important;"><?php echo @$uniq_no_list[$value['id_master_irn_detail']]['heat_or_series_no']; ?></td>
                      <td style="padding: 10px !important;"><?php echo @$uniq_no_list[$value['id_master_irn_detail']]['length_m']; ?></td>
                      <td style="padding: 10px !important;"><?php echo @$uniq_no_list[$value['id_master_irn_detail']]['width_m']; ?></td>
                      <td style="padding: 10px !important;"><?php echo @$uniq_no_list[$value['id_master_irn_detail']]['thk_mm']; ?></td>
                      <td style="padding: 10px !important;"><?php echo $value['qty_issued'] ?></td>
                      <td style="padding: 10px !important;"><?php echo @$uom_list[$uniq_no_list[$value['id_master_irn_detail']]['uom']]["description"]; ?></td>
                      <td style="padding: 10px !important;"><?php echo @$report_no[1]; ?></td>
                      <td style="padding: 10px !important;"><?php echo $value['id_master_irn_detail']; ?></td>
                      <td style="padding: 10px !important;"></td>
                      <td style="padding: 10px !important;"><?php echo $value['remarks']; ?></td>
                    </tr>

                   <?php $sum+= $value['qty_issued']; $no++; } ?>

                </tbody>
                
                <tr style="background-color: #b0b0b0 !important;font-weight: bold;color: #000000;">
                    <td style="padding: 10px !important;"><center>&nbsp;</center></td>              
                    <td style="padding: 10px !important;"><center>&nbsp;</center></td>              
                    <td style="padding: 10px !important;"><center>&nbsp;</center></td>              
                    <td style="padding: 10px !important;"><center>&nbsp;</center></td>              
                    <td style="padding: 10px !important;"><center>&nbsp;</center></td>              
                    <td style="padding: 10px !important;"><center>&nbsp;</center></td>              
                    <td style="padding: 10px !important;"><center>&nbsp;</center></td>              
                    <td style="padding: 10px !important;"><center><?php echo $sum; ?></center></td>              
                    <td style="padding: 10px !important;"><center>Length</center></td>              
                    <td style="padding: 10px !important;"><center>&nbsp;</center></td>              
                    <td style="padding: 10px !important;"><center>&nbsp;</center></td>              
                    <td style="padding: 10px !important;"><center>&nbsp;</center></td>              
                    <td style="padding: 10px !important;"><center>&nbsp;</center></td>              
                    <td style="padding: 10px !important;"><center>&nbsp;</center></td>              
                </tr>

              </table>

              <table  border="1px" style="border-collapse: collapse !important;" width="100%">
                <tr>
                  <td valign="middle" colspan="3">
                    &nbsp;
                  </td>
                </tr>
              </table>

              <table  border="1px" style="border-collapse: collapse !important;" width="100%">
                <tr>
                  <td valign="middle" colspan="3" style="font-size: 10px;color: #000000;font-weight: bold;padding: 10px !important;">
                      Note : Raw Material Return to Storage After Blasting and Painting Finish
                  </td>
                </tr>
              </table>

              <table  border="1px" style="border-collapse: collapse !important;" width="100%">
                <tr>
                  <td valign="middle" colspan="3">
                    &nbsp;
                  </td>
                </tr>
              </table>

              <table  border="1px" style="border-collapse: collapse !important;color: #000000;font-weight: bold;padding: 10px !important;" width="100%">
                <tr>
                  <td style="padding: 10px !important;">Prepared by,</td>
                  <td style="padding: 10px !important;">Acknowledge,</td>
                  <td style="padding: 10px !important;">Received By,</td>
                </tr>
                <tr>
                  <td>&nbsp;<br/><br/><br/></td>
                  <td>&nbsp;<br/><br/><br/></td>
                  <td>&nbsp;<br/><br/><br/></td>
                </tr>
              </table>

            </form>

          </div>
        </div>
      </div>
  </div>
  </div>
</div>
</div>
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.chained.min.js"></script>
<script>
    $("select[name=module]").chained("select[name=project]");
</script>
