<html>
                 <body>
                    <p>Dear All,</b></p>
                    <p>The following Email contain Inspection Invitation for Fit-Up Progress.</p>
                    <p><b>Employer Inspection Authority : <u><?= $legend_inspection_auth ?></u></b></p>
                    <p>Please see the attachment below :</p>
                    <p>
                    <table style='border-collapse:collapse;border: 1px solid #cccccc;padding:10px;'>
                      <tr style='padding:20px !important;'>
                        <td>
                          <table style='padding:20px !important;'>
                            <tr style='font-weight:bold;'>
                              <td>RFI No</td>
                              <td>:</td>
                              <td><?= $rfi_no_mail ?> <?php if(isset($postpone_reoffer_no_val)){ echo "Rev. ".$postpone_reoffer_no_val; } ?></td>
                            </tr>
                            <tr>
                              <td>Report No</td>
                              <td>:</td>
                              <td><?= $report_no_mail ?></td>
                            </tr>
                            <tr>
                              <td>Invitation Date</td>
                              <td>:</td>
                              <td><?= $date_inspect ?></td>
                            </tr>
                            <tr>
                              <td>Invitation Time</td>
                              <td>:</td>
                              <td><?= $time_inspect ?></td>
                            </tr>
                            <tr>
                              <td>Location</td>
                              <td>:</td>
                              <td><?= $location_inspect ?></td>
                            </tr>
                            <tr>
                              <td>Public Address</td>
                              <td>:</td>
                              <td style="padding:20px;"><a href='<?= $link_address_client ?>' style='padding:10px;border-radius: 5px;background-color:#000a9c;color:#ffffff;'>Link</a></td>
                            </tr>
                            <tr>
                              <td>SMOE Network Address</td>
                              <td>:</td>
                              <td style="padding:20px;"><a href='<?= $link_address_smoe ?>' style='padding:10px;border-radius: 5px;background-color:#000a9c;color:#ffffff;'>Link</a></td>
                            </tr>
                          </table>
                        </td>                     
                      </tr>
                    </table>
                    
                    </p>
                    
                    <p>Regards,<br/>PT. SMOE Portal<br>(Auto Reminder System)</p>
                    <br/>
                    <p><b>This is a system generated Email. <br/> Please do not reply to this email address.</b></p>
                    <br>
                    <b>SMOE-IT Dev-Notif-000001</b>
                 </body>
               </html>