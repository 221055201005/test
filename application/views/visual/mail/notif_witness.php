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
                              <td>PCMS Link</td>
                              <td>:</td>
                              <td>
                                <table style='padding:20px !important;width: 500px !important;'>
                                  <tr>
                                    <td>
                                      <a href='<?= $link_address_client ?>'><button class='btn btn-success'><i class="fas fa-tasks"></i> Approval</button></a> 
                                    </td>
                                    <td>
                                      ( Public Domain )
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <a href='<?= $link_address_smoe ?>'><button class='btn btn-success'><i class="fas fa-tasks"></i> Approval</button></a> 
                                    </td>
                                    <td>
                                      ( PT SMOE Network )
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </table>
                        </td>                     
                      </tr>
                    </table>
                    
                    </p>
                    
                    <p>Regards,<br/>PT. SMOE Portal<br>(Auto Reminder System)</p>
                    <br/>
                    <p><b>This is a system generated Email. <br/> Please do not reply to this email address.</b></p>
                 </body>
               </html>