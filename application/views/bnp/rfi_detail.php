<div id="content" class="container-fluid"> 
<?php 
  error_reporting(0);
  $inspection_month   = DATE('m' ,strtotime($main[0]['inspection_date']));
  $inspection_month_to= DATE('m' ,strtotime($main[0]['inspection_date_to']));

  $inspection_date    = DATE('d' ,strtotime($main[0]['inspection_date']));
  $inspection_date_to = DATE('d' ,strtotime($main[0]['inspection_date_to']));

  $inspection_date_arr = array();

  $start = new DateTime (DATE('Y-m-d' ,strtotime($main[0]['inspection_date']))); 
  $end = new DateTime (DATE('Y-m-d' ,strtotime($main[0]['inspection_date_to']))); 

  $interval = new DateInterval ("P1D"); 
  $range = new DatePeriod ($start, $interval, $end);
  foreach ($range as $key => $value) {
    if($value->format('l')=='Sunday'){
      $blank[] = $value->format('d');
    }
  }

  if($inspection_date_to<$inspection_date){
    foreach (range($inspection_date, 31) as $keyc => $valuec) {
      $inspection_date_arr[] = $valuec;
    }
    foreach (range(1, $inspection_date_to) as $keyc => $valuec) {
      $inspection_date_arr[] = $valuec;
    }
  } else {
    foreach (range($inspection_date, $inspection_date_to) as $keyc => $valuec) {
      $inspection_date_arr[] = $valuec;
    }
  }

  $inspection_month_arr = array();
  foreach (range($inspection_month, $inspection_month_to) as $keyc => $valuec) {
    $inspection_month_arr[] = $valuec;
  }
?>           
    <div class="row d-none">
      <div class="col-12">
        <div class="row">
          <div class="col-md-12">
            <ul class="nav nav-pills border-bottom border-gray" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detail List</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Attachment</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

      <!-- <div class="row"> -->

    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Attachment</h6>
          </div>
          <div class="card-body bg-white">

            <button class="btn btn-info" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRedline">
              <i class="fas fa-plus-circle"></i> Add Attachment
            </button>
            <br/><br/>

            <table class="table table-hover text-center table_attachment">
              <thead class="bg-info text-white">
                  <th>No</th>
                  <th>Piecemark Name</th>
                  <th>Attachment Name</th>
                  <th>Uploaded By</th>
                  <th>Uploaded Date</th>
                  <th></th>
              </thead>
              <tbody>
                <?php $no = 1;foreach ($attachment_list as $key => $value): ?> 
                  <tr>
                    <td>
                      <?= $no++ ?>  
                    </td>
                    <td>
                      <?= $value['id_detail_wp_paint_system'] ?>
                    </td>
                    <td>
                      <a target="_blank" href="https://www.smoebatam.com/pcms_v2_photo/fab_img/<?= $value['filename'] ?>"> <?= $value['filename'] ?></a>
                    </td>
                    <td>
                      <?= $user[$value['upload_by']]['full_name'] ?> 
                    </td>
                    <td>
                      <?= $value['upload_datetime'] ?>    
                    </td>
                    <td>
                      <a href="" class="btn btn-dange"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <div class="col-12">
              <div class="card shadow my-3 rounded-0">
                  <div class="card-header">
                    <h6 class="m-0">RFI - INSPECTION NOTIFICATION</h6>
                  </div>
                  <div class="card-body bg-white">
                  <!-- START START START -->
                  <style type="text/css">
                      .bg-selected {
                          background-color: #949494;
                      }''
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
                        /*width: 16px;*/
                        /*height: 16px;*/
                        padding: 0;
                        margin:0;
                        vertical-align: bottom;
                        position: relative;
                        top: -1px;
                        *overflow: hidden;
                      }
                      input[type=checkbox]
                      {
                        -ms-transform: scale(0.8); /* IE */
                        -moz-transform: scale(0.8); /* FF */
                        -webkit-transform: scale(0.8); /* Safari and Chrome */
                        -o-transform: scale(0.8); /* Opera */
                        transform: scale(0.8);
                      }
                      .checkboxtext
                      {
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
                      #example1 {
                        border-radius: 25px;
                        border: 1px solid;
                        padding: 10px;
                        box-shadow: 5px 10px;
                        width:100%;
                      }
                      #example2 {
                        border-radius: 25px;
                        border: 1px solid;
                        padding: 10px;
                        box-shadow: 5px 10px;
                        width:100%;
                      }
                  </style>
                  <center>
                      <!-- <form method="POST" action="<?= base_url('planning_bnp/client_approval') ?>"> -->
                          <div id='example1'>
                              <table  border="1px" style="border-collapse: collapse !important;padding:10px;" width="100%">
                                  <tr>       
                                      <td colspan="2" class="text-center">
                                          <img src="<?= base_url('img/').'header_report.png' ?>"  style="width: 500px !important;">
                                      </td>
                                  </tr>
                                  <tr>       
                                    <td width="50%" style="padding: 5px;vertical-align: middle !important;" style="padding: 10px;">EMPLOYER <br><b>SOFIA OFFSHORE WINDFARM LTD</b> </td>
                                    <td width="50%" style="padding: 5px;vertical-align: middle !important;">RFI No: <br><b><?= 
                                    // $main[0]['report_number']
                                    "SOF-OCP-SMO-".$type_of_module[$main[0]['type_of_module']]['code']."-".strtoupper($discipline[$main[0]['discipline']]['initial_for_report'])."-COPP-".strtoupper($main[0]['report_number'])
                                     ?></b></td>
                                  </tr>
                                  <tr>       
                                    <td style="padding: 5px;vertical-align: middle !important;height: 15px !important;">PROJECT TITLE <br><b>OFFSHORE CONVERTER PLATFORM</b> </td>
                                    <td style="padding: 5px;vertical-align: middle !important;">Submitted Date:<br>
                                      <div class="row">
                                        <div class="col-md-4">
                                          <input type="date" name="submitted_date" class="form-control submitted_date" value="<?= DATE('Y-m-d', strtotime($main[0]['submitted_date'])) ?>">
                                        </div>
                                        <div class="col-md-2">
                                          <span class="btn btn-warning" onclick="saveTestedLength()"><i class="fas fa-save"></i></span>
                                          <script type="text/javascript">
                                            function saveTestedLength(kunci){
                                              var submitted_date = $('.submitted_date').val()
                                              var transmittal_uniqid     = "<?= $main[0]['transmittal_uniqid'] ?>"

                                              $.ajax({
                                                url: "<?php echo base_url();?>planning_bnp/update_submitted_date",
                                                type: "post",
                                                data: {
                                                  submitted_date    : submitted_date,
                                                  transmittal_uniqid: transmittal_uniqid,
                                                },
                                                success: function(data) { 
                                                  Swal.fire(
                                                    'Success',
                                                    'Your data has been Updated!',
                                                    'success'
                                                  );
                                                  location.reload();                  
                                                }
                                              });
                                            }
                                          </script>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <?php
                                      $locationk = explode(';', $main[0]['location']);
                                      foreach ($locationk as $keyk => $valuek) {
                                        $locationz[] = $location[$valuek];
                                      }
                                    ?>
                                    <td style="padding: 5px;vertical-align: middle !important;">CONTRACTOR <br><b>SEMBCORP MARINE</b></td>
                                    <td style="padding: 5px;vertical-align: middle !important;">Location Inspection: <br><b><?= @$area[$main[0]['area']].', '.(implode(', ', $locationz)).', '.@$point[$main[0]['point']] ?></b></td>
                                  </tr>
                              </table>
                              <br>
                              <table  border="1px" style="border-collapse: collapse !important;padding:20px !important;" width="100%">
                                <tr>
                                  <td colspan="22" style="text-align:center; padding-bottom: 4px; "><b>RFI - INSPECTION NOTIFICATION</b></td>
                                </tr>

                                <tr>
                                  <td colspan="22" class="text-ri">
                                    <br>
                                    <div class="row">
                                      <div class="col-md-5">
                                        <input type="date" name="from" class="form-control from" value="<?= DATE('Y-m-d', strtotime($main[0]['inspection_date'])) ?>">
                                      </div>
                                      <div class="col-md-5">
                                        <input type="date" name="to" class="form-control to" value="<?= DATE('Y-m-d', strtotime($main[0]['inspection_date_to'])) ?>">
                                      </div>
                                      <div class="col-md-2">
                                        <span class="btn btn-warning" onclick="saveInspectionDate()"><i class="fas fa-save"></i></span>
                                        <script type="text/javascript">
                                          function saveInspectionDate(kunci){
                                            var from = $('.from').val()
                                            var to = $('.to').val()
                                            var transmittal_uniqid     = "<?= $main[0]['transmittal_uniqid'] ?>"

                                            $.ajax({
                                              url: "<?php echo base_url();?>planning_bnp/update_inspection_date",
                                              type: "post",
                                              data: {
                                                from    : from,
                                                to    : to,
                                                transmittal_uniqid: transmittal_uniqid,
                                              },
                                              success: function(data) { 
                                                Swal.fire(
                                                  'Success',
                                                  'Your data has been Updated!',
                                                  'success'
                                                );
                                                location.reload();                  
                                              }
                                            });
                                          }
                                        </script>
                                      </div>
                                    </div>
                                    <br>
                                  </td>
                                </tr>

                                <tr>
                                  <td colspan="6" style="text-align:center; padding-bottom: 4px;"><b>MONTH</b></td>
                                  <td colspan="16" style="text-align:center; padding-bottom: 4px;"><b>DAY</b></td>
                                </tr>
                                <tr>
                                  <td  style="text-align:center; padding-bottom: 4px;" class="<?= in_array(1, $inspection_month_arr) ? 'bg-selected' : '' ?>">
                                    <b>JAN</b>
                                  </td>
                                  <td  style="text-align:center; padding-bottom: 4px;" class="<?= in_array(2, $inspection_month_arr) ? 'bg-selected' : '' ?>">
                                    <b>FEB</b>
                                  </td>
                                  <td  style="text-align:center; padding-bottom: 4px;" class="<?= in_array(3, $inspection_month_arr) ? 'bg-selected' : '' ?>">
                                    <b>MAR</b>
                                  </td>
                                  <td  style="text-align:center; padding-bottom: 4px;" class="<?= in_array(4, $inspection_month_arr) ? 'bg-selected' : '' ?>">
                                    <b>APR</b>
                                  </td>
                                  <td  style="text-align:center; padding-bottom: 4px;" class="<?= in_array(5, $inspection_month_arr) ? 'bg-selected' : '' ?>">
                                    <b>MAY</b>
                                  </td>
                                  <td  style="text-align:center; padding-bottom: 4px;" class="<?= in_array(6, $inspection_month_arr) ? 'bg-selected' : '' ?>">
                                    <b>JUN</b>
                                  </td>
                                  <td rowspan='2' style="text-align:center; padding-bottom: 4px;vertical-align: middle !important;"
                                    class="<?= (in_array(1, $inspection_date_arr) AND !in_array(1, $blank)) ? 'bg-selected' : '' ?>"><b>1</b></td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(2, $inspection_date_arr) AND !in_array(2, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>2</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(3, $inspection_date_arr) AND !in_array(3, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>3</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(4, $inspection_date_arr) AND !in_array(4, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>4</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(5, $inspection_date_arr) AND !in_array(5, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>5</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(6, $inspection_date_arr) AND !in_array(6, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>6</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(7, $inspection_date_arr) AND !in_array(7, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>7</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(8, $inspection_date_arr) AND !in_array(8, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>8</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(9, $inspection_date_arr) AND !in_array(9, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>9</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(10, $inspection_date_arr) AND !in_array(10, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>10</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(11, $inspection_date_arr) AND !in_array(11, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>11</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(12, $inspection_date_arr) AND !in_array(12, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>12</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(13, $inspection_date_arr) AND !in_array(13, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>13</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(14, $inspection_date_arr) AND !in_array(14, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>14</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(15, $inspection_date_arr) AND !in_array(15, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>15</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(16, $inspection_date_arr) AND !in_array(16, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>16</b>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= in_array(7, $inspection_month_arr) ? 'bg-selected' : '' ?>">
                                    <b>JUL</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= in_array(8, $inspection_month_arr) ? 'bg-selected' : '' ?>">
                                    <b>AUG</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= in_array(9, $inspection_month_arr) ? 'bg-selected' : '' ?>">
                                    <b>SEP</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= in_array(10, $inspection_month_arr) ? 'bg-selected' : '' ?>">
                                    <b>OCT</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= in_array(11, $inspection_month_arr) ? 'bg-selected' : '' ?>">
                                    <b>NOV</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= in_array(12, $inspection_month_arr) ? 'bg-selected' : '' ?>">
                                    <b>DEC</b>
                                  </td>

                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(17, $inspection_date_arr) AND !in_array(17, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>17</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(18, $inspection_date_arr) AND !in_array(18, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>18</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(19, $inspection_date_arr) AND !in_array(19, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>19</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(20, $inspection_date_arr) AND !in_array(20, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>20</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(21, $inspection_date_arr) AND !in_array(21, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>21</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(22, $inspection_date_arr) AND !in_array(22, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>22</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(23, $inspection_date_arr) AND !in_array(23, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>23</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(24, $inspection_date_arr) AND !in_array(24, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>24</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(25, $inspection_date_arr) AND !in_array(25, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>25</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(26, $inspection_date_arr) AND !in_array(26, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>26</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(27, $inspection_date_arr) AND !in_array(27, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>27</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(28, $inspection_date_arr) AND !in_array(28, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>28</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(29, $inspection_date_arr) AND !in_array(29, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>29</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(30, $inspection_date_arr) AND !in_array(30, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>30</b>
                                  </td>
                                  <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(31, $inspection_date_arr) AND !in_array(31, $blank)) ? 'bg-selected' : '' ?>">
                                    <b>31</b>
                                  </td>
                                </tr> 
                                <tr>
                                  <td colspan="22" style="text-align:left; padding:20px !important; ">
                                    Document Ref.: SOF-OCP-000-SMO-004-0006-PP
                                  </td>
                                </tr>
                                <tr>
                                  <td colspan="22" style="text-align:justify !important; padding:10px !important;">DISCIPLINE : &nbsp;&nbsp;
                                    <?php if($main[0]['discipline'] == '2'){ ?>

                                    <input disabled  type="checkbox" style="width: 20px !important; height: 20px !important" name="optiona" id="opta" checked /><?php } else { ?><input disabled  type="checkbox" style="width: 20px !important; height: 20px !important" name="optiona" id="opta" /><?php } ?><span class="checkboxtext"> &nbsp;&nbsp;STRUCTURAL&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    
                                    <input disabled  type="checkbox" style="width: 20px !important; height: 20px !important" name="optiona" id="opta" /><span class="checkboxtext"> &nbsp;&nbsp;ELECTRICAL&nbsp;&nbsp;&nbsp;&nbsp;</span>

                                    <input disabled  type="checkbox" style="width: 20px !important; height: 20px !important" name="optiona" id="opta" /><span class="checkboxtext"> &nbsp;&nbsp;MECHANICAL&nbsp;&nbsp;&nbsp;&nbsp;</span>

                                    <input disabled  type="checkbox" style="width: 20px !important; height: 20px !important" name="optiona" id="opta" /><span class="checkboxtext"> &nbsp;&nbsp;INSTR/AUT&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <?php if($main[0]['discipline'] == '1'){ ?>
                                      <input disabled  type="checkbox" style="width: 20px !important; height: 20px !important" name="optiona" id="opta" checked="" />
                                    <?php } else { ?>
                                      <input disabled  type="checkbox" style="width: 20px !important; height: 20px !important" name="optiona" id="opta" />
                                    <?php } ?>
                                    <span class="checkboxtext"> &nbsp;&nbsp;PIPING&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    
                                    <input disabled  type="checkbox" style="width: 20px !important; height: 20px !important" name="optiona" id="opta" />
                                    <span class="checkboxtext">&nbsp;&nbsp;HVAC&nbsp;&nbsp;&nbsp;&nbsp;</span>

                                    <input disabled  type="checkbox" style="width: 20px !important; height: 20px !important" name="optiona" id="opta" />
                                    <span class="checkboxtext">&nbsp;&nbsp;TELECOM&nbsp;&nbsp;&nbsp;&nbsp;</span>

                                    <input disabled  type="checkbox" style="width: 20px !important; height: 20px !important" name="optiona" id="opta" />
                                    <span class="checkboxtext">&nbsp;&nbsp;PACKAGE&nbsp;&nbsp;&nbsp;&nbsp;</span>

                                  </td>
                                </tr>

                                <form action="<?= base_url('planning_bnp/update_desc_rfi') ?>" method="POST">
                                  <tr>
                                    <td colspan="1" style="text-align:center; vertical-align: middle; font-weight: bold; max-width: 10px !important"><center>No.</center></td>
                                    <td colspan="6" style="text-align:center; vertical-align: middle; font-weight: bold;"><center>ITEM / TAG NUMBER</center></td>
                                    <td colspan="6" style="text-align:center; vertical-align: middle; font-weight: bold;"><center>ITEM / TAG DESCRIPTION</center></td>
                                    <td colspan="3" style="text-align:center; vertical-align: middle; font-weight: bold; max-width: 10px !important"><center>EXPECTED TIME</center></td>
                                    <td colspan="3" style="text-align:center; vertical-align: middle; font-weight: bold; max-width: 10px !important"><center>ITP <br>Intervention <br>to Employer</center></td> 
                                    <td colspan="3" style="text-align:center; vertical-align: middle; font-weight: bold; max-width: 10px !important"><center>INSPECTION EXECUTION RESULT</center></td> 
                                  </tr>

                                  <?php $nox = 1; foreach($rfi_detail as $key => $value){ ?>
                                  <tr>
                                    <input type="hidden" name="id[]" value="<?= $value['id'] ?>">
                                    <td colspan="1" style=" text-align:center; vertical-align: middle;"><?= $nox ?></td>
                                    <td colspan="6" style=" text-align:center; vertical-align: middle;">
                                      <textarea class="form-control" name="tag_no[]"><?= $value['tag_no'] ?></textarea>
                                    </td>

                                    <td colspan="6" style=" text-align:center; vertical-align: top;">
                                      <textarea class="form-control" name="tag_description[]"><?= $value['tag_description'] ?></textarea>    
                                    </td>

                                    <?php if($key==0){ ?>
                                      <td rowspan="<?= COUNT($rfi_detail) ?>" colspan="3" style=" text-align:center; vertical-align: top; max-width: 10px">
                                        <textarea class="form-control" name="expected_time[]"><?= $value['expected_time'] ?></textarea>  
                                      </td>

                                      <td rowspan="<?= COUNT($rfi_detail) ?>" colspan="3" style=" text-align:center; vertical-align: top; max-width: 10px">
                                        <?php
                                          if($value['itp']){
                                            $legend_inspection_auth = explode(';', $value['itp']);
                                            $inspection_authority = [];
                                            if(in_array(1, $post['itp']) OR in_array(1, $legend_inspection_auth)) {
                                              $inspection_authority[] = 'Hold Point ';
                                            }

                                            if(in_array(2, $post['itp']) OR in_array(2, $legend_inspection_auth)) {
                                              $inspection_authority[] = 'Witness ';
                                            }

                                            if(in_array(3, $post['itp']) OR in_array(3, $legend_inspection_auth)) {
                                              $inspection_authority[] = 'Monitoring ';
                                            }

                                            if(in_array(4, $post['itp']) OR in_array(4, $legend_inspection_auth)) {
                                              $inspection_authority[] = 'Review ';
                                            } 
                                          } else {
                                            $inspection_authority = '-';
                                          }
                                        ?>
                                        <select class="form-control select2" name="itp[]" multiple="">
                                          <option <?= in_array(1, $legend_inspection_auth) ? 'selected' : '' ?> value="1">Hold Point</option>
                                          <option <?= in_array(2, $legend_inspection_auth) ? 'selected' : '' ?> value="2">Witness</option>
                                          <option <?= in_array(3, $legend_inspection_auth) ? 'selected' : '' ?> value="3">Monitoring</option>
                                          <option <?= in_array(4, $legend_inspection_auth) ? 'selected' : '' ?> value="4">Review</option>
                                        </select>
                                      </td> 
                                      <td rowspan="<?= COUNT($rfi_detail) ?>" colspan="3" style=" text-align:center; vertical-align: top; max-width: 10px">
                                        <textarea class="form-control" name="result[]"><?= $value['result'] ?></textarea>  
                                      </td> 
                                    <?php } ?>
                                  </tr>
                                <?php $nox++; } ?> 
                                <tr>
                                  <td colspan="22" style=" text-align:center; vertical-align: middle; padding: 10px">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                                  </td>
                                </tr> 
                                  
                                </form>
                              </table>
                              <table  border="1px" style="border-collapse: collapse !important;" width="100%" class="">
                                <tr>
                                  <td style="text-align:center; padding-bottom: 4px;padding:20px;font-size: 12px !important;"> 
                                  <table style='width: 100% !important;text-align: left !important;'>
                                    <tr>
                                      <th>Paint System :</th>
                                      <th>Activity Details :</th> 
                                      <th>Paint Product :</th>
                                      <th>Colour :</th>
                                    </tr>
                                    <tr>
                                      <th><?= (isset($master_paint_system_details[$id_paint_system]["code"]) ? $master_paint_system_details[$id_paint_system]["code"] : "-" ) ?></th>
                                      <th><?= (isset($master_activity[$id_paint_system][$id_activity]) ? $master_activity[$id_paint_system][$id_activity]["description_of_activity"] : "-" ) ?></th>
                                       <th><?= (isset($master_activity[$id_paint_system][$id_activity]) ? $master_activity[$id_paint_system][$id_activity]["paint_product"] : "-" ) ?></th>
                                      <th>
                                        <?php if(strtoupper($main[0]['report_number']) == "0043D" || strtoupper($main[0]['report_number'])  == "0044D"){ ?>
                                          Pastel Orange ( RAL 2003 )
                                        <?php } else { ?>
                                          <?= (isset($master_activity[$id_paint_system][$id_activity]) ? $master_activity[$id_paint_system][$id_activity]["color"] : "-" ) ?>  
                                        <?php } ?>
                                      </th>
                                    </tr>
                                  </table>
                                  </td>
                                </tr> 
                                <tr>
                                  <td style="text-align:center; padding-bottom: 4px;padding:20px;font-size: 20px !important;"><b>LEGEND : INSPECTION EXCECUTION RESULT</b></td>
                                </tr>          
                                <tr>
                                  <td  colspan="3" valign="middle" style="padding: 5px;width: 100% !important;font-size: 20px !important;vertical-align: middle !important;padding:20px;">
                                    <center>
                                      <table width="100%">
                                        <tr>
                                          <td style="width: 15% !important;"><center><label><input type="checkbox" disabled="" name='status_inspection' value="7" <?php if($rfi_detail[0]['status_inspection'] == '7'){ echo "checked"; } ?> style="width: 20px !important; height: 20px !important" required> Accepted</label></center></td>
                                          <td style="width: 30% !important;"><center><label><input type="checkbox" disabled="" name='status_inspection' value="9" <?php if($rfi_detail[0]['status_inspection'] == '9'){ echo "checked"; } ?> style="width: 20px !important; height: 20px !important" required> Accepted & Released With Comment</label></center></td>
                                          <td style="width: 15% !important;"><center><label><input type="checkbox" disabled="" name='status_inspection' value="6" <?php if($rfi_detail[0]['status_inspection'] == '6'){ echo "checked"; } ?> style="width: 20px !important; height: 20px !important" required> Rejected</label></center></td>
                                          <td style="width: 20% !important;"><center><label><input type="checkbox" disabled="" name='status_inspection' value="10" <?php if($rfi_detail[0]['status_inspection'] == '10'){ echo "checked"; } ?> style="width: 20px !important; height: 20px !important" required> Postpone</label></center></td>
                                          <td style="width: 20% !important;"><center><label><input type="checkbox" disabled="" name='status_inspection' value="11" <?php if($rfi_detail[0]['status_inspection'] == '11'){ echo "checked"; } ?> style="width: 20px !important; height: 20px !important" required> Re-Offer</label></center></td>
                                        </tr>
                                      </table>
                                    </center>
                                  </td>
                                </tr>
                                <tr class="">
                                  <td style="text-align:left; padding-bottom: 4px; width: 95%; height: 250px !important;"><b>Comment/Remarks :<br/></td>
                                </tr>
                                <tr class="">
                                  <td style="text-align:center; padding-bottom: 4px;  "><b>SIGNATURE FOR INSPECTION EXECUTED</b></td>
                                </tr>
                              </table> 
                              <table width="100%" border="1px" style="border-collapse: collapse;" class="">
                                <tr>
                                  <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:33.33%;" >CONTRACTOR</td>
                                  <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:33.33%;">PPG PAINT REPRESENTATIVE</td>
                                  <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:33.33%;">EMPLOYER</td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom: 4px; ">NAME <b><?php if(isset($user[$main[0]['inspector_id']]['full_name'])){ echo $user[$main[0]['inspector_id']]['full_name']; } ?></b></td>

                                  <td style="padding-bottom: 4px; ">NAME</td>

                                  <td style="padding-bottom: 4px; ">NAME <b><?php if(isset($user[$rfi_detail[0]['client_inspection_by']]['full_name'])){ echo  $user[$rfi_detail[0]['client_inspection_by']]['full_name']; } ?></b></td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 4px; ">SIGNATURE<br/>
                                      <?php if(isset($user[$main[0]['inspector_id']]['sign_approval'])){ ?>
                                        <center>
                                          <img src="data:image/png;base64,<?= $user[$main[0]['inspector_id']]['sign_approval'] ?>"  style="width: 200px !important; height: 150px !important">
                                        </center>
                                      <?php } ?>
                                    </td>

                                    <td style="padding-bottom: 4px; ">SIGNATURE<br/><br/><br/>
                                    </td>

                                    <td style="padding-bottom: 4px; ">SIGNATURE<br/>
                                      <?php if(isset($user[$rfi_detail[0]['client_inspection_by']]['sign_approval'])){ ?>
                                        <center>
                                          <img src="data:image/png;base64,<?= $user[$rfi_detail[0]['client_inspection_by']]['sign_approval'] ?>"  style="width: 200px !important; height: 150px !important">
                                        </center>
                                       <?php } ?> 
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 4px; ">Date
                                      <?php if(isset($user[$main[0]['inspector_id']]['sign_approval'])){ ?>
                                        <b><?php echo date("Y-m-d",strtotime($main[0]['transmittal_date'])); ?></b>
                                      <?php } ?>
                                    </td>
                                    <td style="padding-bottom: 4px; ">Date</td>
                                    <td style="padding-bottom: 4px; ">Date 
                                      <?php if(isset($user[$rfi_detail[0]['client_inspection_by']]['sign_approval'])){ ?>
                                        <b><?php echo date("Y-m-d",strtotime($rfi_detail[0]['client_inspection_datetime'])); ?></b>
                                      <?php } ?>
                                    </td>
                                    
                                </tr>
                              </table>  
                          </div>
                          <div class="col text-right" style="padding-top: 30px !important">
                              <hr>
                              <button class="btn btn-primary <?= $rfi_detail[0]['status_inspection']!=0 ? 'd-none' : '' ?> d-none" type="submit">
                                  <i class="fas fa-paper-plane"></i> Submit
                              </button>
                              <a class="btn btn-danger" href="<?= base_url('planning_bnp/pdf_rfi_potrain/').$main[0]['transmittal_uniqid'] ?>" target="_blank">
                                <i class="fas fa-file-pdf"></i> PDF
                              </a>
                              |
                              <a class="btn btn-info btnotif" href="<?= base_url('planning_bnp/send_invitation/').$main[0]['transmittal_uniqid'] ?>">
                                <!-- <i class="fas fa-envelope"></i> Send Invitation -->
                                <i class="fas fa-envelope"></i> Send RFI
                              </a>
                              <style type="text/css">
                                
                              </style>
                              <input onclick='setNotif("<?= $main[0]['transmittal_uniqid'] ?>", this)' type="checkbox" checked="" value="1" id="weekday-1" clas="form-control" style="transform: scale(2); margin: 5px !important; margin-left: 15px !important" />
                              <label for="weekday-1" style="display: inline"><b style="font-size: 12pt !important">With Notif</b></label>
                              <script type="text/javascript">
                                function setNotif(transmittal_uniqid, ini){
                                  var check = $(ini)[0].checked
                                  if(check==false){
                                    $(".btnotif").attr("href", "<?= base_url('planning_bnp/send_invitation/').$main[0]['transmittal_uniqid'] ?>"+"/1")
                                  } else {
                                    $(".btnotif").attr("href", "<?= base_url('planning_bnp/send_invitation/').$main[0]['transmittal_uniqid'] ?>")
                                  }
                                }
                              </script>
                          </div>
                      <!-- </form> -->
                  </center>
                  <!-- END END END -->
                  </div>
              </div>
          </div>

          <div class="col-12 ">
            <div class="card shadow my-3 rounded-0">
              <div class="card-header">
                <h6 class="m-0">RFI - INSPECTION NOTIFICATION</h6>
              </div>
              <div class="card-body bg-white"> 
                <input type="hidden" name="template_id"> 
                <div class="overflow-auto">  
                  <?php if($wp_type==0){ ?>
                    <div class="text-right">
                      <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-plus"></i>
                         Add Piecemark
                      </button>
                    </div>
                    <br>
                    <table class="table table-hover text-center dataTable">
                      <thead class="bg-green-smoe text-white">
                        <tr>
                          <th>NO</th>
                          <th>PIECEMARK NO.</th>
                          <th>DRAWING NUMBER</th>
                          <th>PAINT SYSTEM</th>
                          <th>Activity</th>
                          <th>ITEM/SPEC</th>
                          <th>IRN NUMBER</th>
                          <th>WORKPACK NO.</th>
                          <th>LOCATION</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($list as $key => $value) { ?>
                        <tr>
                          <td><?= $key+1 ?></td>
                          <td><?= $value['part_id'] ?></td>
                          <td><?= $value['drawing_ga'] ?></td>
                          <td><?= $paint_system[$main[0]['id_paint_system']]['name'] ?></td>
                          <td><?= $activity[$main[0]['id_activity']]['description_of_activity'] ?></td>
                          <td>N/A</td>
                          <td><a href="<?= base_url('irn/show_irn_detail/').strtr($this->encryption->encrypt($irn['submission_id']), '+=/', '.-~') ?>"><?= "SOF-OCP-SMO-TS-STR-RFI-IRN-B&P-".$data_wp['irn_report_no'] ?></a></td>
                          <td><a href="<?= base_url('planning/workpack_pdf_bnp/').strtr($this->encryption->encrypt($data_wp['id_workpack']), '+=/', '.-~') ?>"><?= $data_wp['workpack_no'] ?></a></td>
                          <td style="text-align: center !important; vertical-align: middle !important;">
                            <?php 
                              foreach (explode(';', $arr_bp[$arr_wp[$value['id']]['id']]['location']) as $keyj => $valuej) {
                                echo $location[$valuej].', ';
                              }
                            ?>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <form action="<?= base_url('planning_bnp/aditional_pcmark') ?>" method="POST">
                        <input type="hidden" name="ndt_report_number" class="form-control" value="<?= $list[0]['report_number'] ?>" required>
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Piecemark List</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <table class="table table_modal">
                                <thead class="bg-green-smoe text-white">
                                  <tr>
                                    <th>NO</th>
                                    <th>PIECEMARK NO.</th>
                                    <th>DRAWING NUMBER</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($left_data as $key => $valueh) {?>
                                    <tr>
                                      <td>
                                        <input type="checkbox" name="id[]" class="form-control" value="<?= $valueh['id_bnp'] ?>">
                                        <b><?= $key+1 ?></b>
                                        <input type="hidden" name="transmittal_uniqid" value="<?= $main[0]['transmittal_uniqid'] ?>">
                                      </td>
                                      <td><?= $valueh['part_id'] ?></td>
                                      <td><?= $valueh['drawing_ga'] ?></td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- <table class="table table-hover text-center dataTable">
                        <thead class="bg-green-smoe text-white">
                        <tr>
                            <th>NO</th>
                            <th>PIECEMARK NO.</th>
                            <th>DRAWING NUMBER</th>
                            <th>PAINT SYSTEM</th>
                            <th>Activity</th>
                            <th>ITEM/SPEC</th>
                            <th>IRN NUMBER</th>
                            <th>WORKPACK NO.</th>
                            <th>LOCATION</th>
                            <th>REMARKS</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($rfi_detail as $key => $value){
                          if(isset($value['drawing_as']) && !empty($value['drawing_as'])){
                              $weldmap_material = substr($value['drawing_as'],-13);
                          } else {
                              $weldmap_material = substr($value['drawing_ga'],-20);
                          }  
                  
                          if(isset($warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'])){
                              $uniq_no_p1 = $warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'];
                          } else {
                              $uniq_no_p1 = "-";
                          } 

                          if($uniq_no_p1 != "-"){ 
                              if(isset($list_unique_data[$uniq_no_p1])){
                                  $list_of_attachment = array(); 
                                  foreach($list_unique_data[$uniq_no_p1] as $key => $vx){ 
                                  $list_of_attachment[] = "<a target='_blank' href='https://www.smoebatam.com/warehouse_ori/file/mrir/cm/".$vx["document_file"]."'  style='display: inline-block !important;'>".$vx["document_name"]."</a>";
                                  }
                                  $show_attachment = implode("<br/><br/>",$list_of_attachment);
                              } else {
                                  $show_attachment = "-";
                              }
                          } else {
                          $show_attachment = "-";
                          } 

                          if(isset($status_piecemark[$value['part_id']]['profile'])){
                              $profile_p1 = $status_piecemark[$value['part_id']]['profile'];
                          } else {
                              $profile_p1 = "-";
                          } 

                          if(isset($status_piecemark[$value['part_id']]['diameter'])){
                              $diameter_p1 = $status_piecemark[$value['part_id']]['diameter'];
                          } else {
                              $diameter_p1 = "-";
                          }

                          if(isset($status_piecemark[$value['part_id']]['length'])){
                              $length_p1 = $status_piecemark[$value['part_id']]['length'];
                          } else {
                              $length_p1 = "-";
                          } 

                          if(isset($status_piecemark[$value['part_id']]['area'])){
                              $area_p1 = $status_piecemark[$value['part_id']]['area'];
                          } else {
                              $area_p1 = "-";
                          }

                          if(isset($status_piecemark[$value['part_id']]['can_number'])){
                          $can_number = $status_piecemark[$value['part_id']]['can_number'];
                          } else {
                          $can_number = "-";
                          }

                          if(isset($status_piecemark[$value['part_id']]['thickness'])){
                              $thickness_p1 = $status_piecemark[$value['part_id']]['thickness'];
                          } else {
                              $thickness_p1 = "-";
                          } 

                          $project_id               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['project_code']),'+=/', '.-~');
                          $discipline               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['discipline']),'+=/', '.-~');
                          $type_of_module           = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['type_of_module']),'+=/', '.-~');
                          $module                   = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['module']),'+=/', '.-~');
                          $report_no                = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_number']),'+=/', '.-~');
                          $report_no_rev            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_no_rev']),'+=/', '.-~');
                          $submission_id            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['submission_id']),'+=/', '.-~');

                          if(isset($status_piecemark[$value['part_id']]['status_inspection'])){
                              if($status_piecemark[$value['part_id']]['status_inspection'] >= 3){
                                  if(isset($status_piecemark[$value['part_id']]['report_number'])){
                                  $status_inspection_p1 = '<a target="_blank" href="'.base_url().'material_verification/material_verification_pdf_client/'.$project_id.'/'.$discipline.'/'.$type_of_module.'/'.$module.'/'.$report_no.'/'.$report_no_rev.'">COMPLETED</a>';
                                  } else {
                                  $status_inspection_p1 = '<a target="_blank" href="'.base_url().'material_verification/material_verification_pdf/'.$submission_id.'">COMPLETED</a>';
                                  }                                               
                              } else {
                              $status_inspection_p1 ='OS';  
                              }
                              
                          } else {
                              $status_inspection_p1 = "-";
                          }
          
                          $status_fitup = "-"; 
                          $status_visual ="-";
                          $status_MT_show = "-";
                          $status_PT_show = "-";
                          $status_UT_show = "-";
                          $status_RT_show = "-";
                        ?>
                            <tr>
                              <td><?= $key+1 ?></td>
                              <td><?= $value['tag_no'] ?></td>
                              <td><?= $value['tag_description'] ?></td>
                              <td><?= $paint_system[$main[0]['id_paint_system']]['name'] ?></td>
                              <td><?= $activity[$main[0]['id_activity']]['description_of_activity'] ?></td>
                              <td>N/A</td>
                              <td>
                                <a href="<?= base_url('irn/show_irn_detail/').strtr($this->encryption->encrypt($irn['submission_id']), '+=/', '.-~') ?>">
                                  <?= "SOF-OCP-SMO-TS-STR-RFI-IRN-B&P-".$data_wp['irn_report_no'] ?>
                                </a>   
                              </td>
                              <td>
                                <a href="<?= base_url('planning/workpack_pdf_bnp/').strtr($this->encryption->encrypt($data_wp['id_workpack']), '+=/', '.-~') ?>">
                                  <?= $data_wp['workpack_no'] ?>
                                </a>   
                              </td>

                              <?php if($key==0){ ?>
                                <td rowspan="<?= COUNT($rfi_detail) ?>" style="text-align: center !important; vertical-align: middle !important;">
                                  <?php 
                                    foreach (explode(';', $arr_bp[$arr_wp[$main[0]['id_piecemark']]['id']]['location']) as $keyj => $valuej) {
                                      echo $location[$valuej].', ';
                                    }
                                  ?>
                                </td>
                              <?php } ?>

                              <td><?= $value['tag_description'] ?></td>
                            </tr>          
                        <?php } ?>                     
                        </tbody>
                    </table> -->  

                  <?php } else { ?>
                    <table class="table table-hover text-center dataTable">
                      <thead class="bg-green-smoe text-white">
                      <tr>
                          <th>NO</th>
                          <th>PIECEMARK NO.</th>
                          <th>DRAWING NUMBER</th>
                          <th>PAINT SYSTEM</th>
                          <th>Activity</th>
                          <!-- <th>QTY</th> -->
                          <th>ITEM/SPEC</th>
                          <th>IRN NUMBER</th>
                          <th>WORKPACK NO,</th>
                          <th>LOCATION</th>
                          <!-- <th>ITEM DESCRIPTION</th> -->
                          <th>REMARKS</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php foreach($list as $key => $value){

                        if(isset($value['drawing_as']) && !empty($value['drawing_as'])){
                            $weldmap_material = substr($value['drawing_as'],-13);
                        } else {
                            $weldmap_material = substr($value['drawing_ga'],-20);
                        }  
                
                        if(isset($warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'])){
                            $uniq_no_p1 = $warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'];
                        } else {
                            $uniq_no_p1 = "-";
                        } 

                        if($uniq_no_p1 != "-"){ 
                            if(isset($list_unique_data[$uniq_no_p1])){
                                $list_of_attachment = array(); 
                                foreach($list_unique_data[$uniq_no_p1] as $keyx => $vx){ 
                                $list_of_attachment[] = "<a target='_blank' href='https://www.smoebatam.com/warehouse_ori/file/mrir/cm/".$vx["document_file"]."'  style='display: inline-block !important;'>".$vx["document_name"]."</a>";
                                }
                                $show_attachment = implode("<br/><br/>",$list_of_attachment);
                            } else {
                                $show_attachment = "-";
                            }
                        } else {
                        $show_attachment = "-";
                        } 

                        if(isset($status_piecemark[$value['part_id']]['profile'])){
                            $profile_p1 = $status_piecemark[$value['part_id']]['profile'];
                        } else {
                            $profile_p1 = "-";
                        } 

                        if(isset($status_piecemark[$value['part_id']]['diameter'])){
                            $diameter_p1 = $status_piecemark[$value['part_id']]['diameter'];
                        } else {
                            $diameter_p1 = "-";
                        }

                        if(isset($status_piecemark[$value['part_id']]['length'])){
                            $length_p1 = $status_piecemark[$value['part_id']]['length'];
                        } else {
                            $length_p1 = "-";
                        } 

                        if(isset($status_piecemark[$value['part_id']]['area'])){
                            $area_p1 = $status_piecemark[$value['part_id']]['area'];
                        } else {
                            $area_p1 = "-";
                        }

                        if(isset($status_piecemark[$value['part_id']]['can_number'])){
                        $can_number = $status_piecemark[$value['part_id']]['can_number'];
                        } else {
                        $can_number = "-";
                        }

                        if(isset($status_piecemark[$value['part_id']]['thickness'])){
                            $thickness_p1 = $status_piecemark[$value['part_id']]['thickness'];
                        } else {
                            $thickness_p1 = "-";
                        } 

                        $project_id               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['project_code']),'+=/', '.-~');
                        $discipline               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['discipline']),'+=/', '.-~');
                        $type_of_module           = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['type_of_module']),'+=/', '.-~');
                        $module                   = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['module']),'+=/', '.-~');
                        $report_no                = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_number']),'+=/', '.-~');
                        $report_no_rev            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_no_rev']),'+=/', '.-~');
                        $submission_id            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['submission_id']),'+=/', '.-~');

                        if(isset($status_piecemark[$value['part_id']]['status_inspection'])){
                            if($status_piecemark[$value['part_id']]['status_inspection'] >= 3){
                                if(isset($status_piecemark[$value['part_id']]['report_number'])){
                                $status_inspection_p1 = '<a target="_blank" href="'.base_url().'material_verification/material_verification_pdf_client/'.$project_id.'/'.$discipline.'/'.$type_of_module.'/'.$module.'/'.$report_no.'/'.$report_no_rev.'">COMPLETED</a>';
                                } else {
                                $status_inspection_p1 = '<a target="_blank" href="'.base_url().'material_verification/material_verification_pdf/'.$submission_id.'">COMPLETED</a>';
                                }                                               
                            } else {
                            $status_inspection_p1 ='OS';	
                            }
                            
                        } else {
                            $status_inspection_p1 = "-";
                        }
        
                        $status_fitup = "-"; 
                        $status_visual ="-";
                        $status_MT_show = "-";
                        $status_PT_show = "-";
                        $status_UT_show = "-";
                        $status_RT_show = "-";
                      ?>
                          <tr>

                            <td><?= $key+1 ?></td>
                            <td><?= $value['part_id'] ?></td>
                            <td><?= $value['drawing_ga'] ?></td>
                            <td><?= $paint_system[$main[0]['id_paint_system']]['name'] ?></td>
                            <td><?= $activity[$main[0]['id_activity']]['description_of_activity'] ?></td>
                            <td><?= $profile_p1 ?> </td>
                            <td>
                              <a href="<?= base_url('irn/show_irn_detail_material/').strtr($this->encryption->encrypt($value['irn_submission_id']), '+=/', '.-~') ?>">
                                <?= "SOF-OCP-SMO-TS-STR-RFI-IRN-B&P-".$value['irn_report_number'] ?>
                              </a>    
                            </td>

                            <td>
                              <a href="<?= base_url('planning/workpack_pdf_bnp/').strtr($this->encryption->encrypt($arr_wp_by_idtp[$value['id_piecemark']]['id_workpack']), '+=/', '.-~') ?>">
                                <?= $arr_wp_by_idtp[$value['id_piecemark']]['workpack_no'] ?>
                              </a>
                            </td>

                            <td rowspan="" style="text-align: center !important; vertical-align: middle !important;">
                              <?php 
                                foreach (explode(';', $main[0]['location']) as $keyj => $valuej) {
                                  echo $location[$valuej].', ';
                                }
                              ?>
                            </td>
                            <td></td>
                          </tr>          
                      <?php } ?>                     
                      </tbody>
                    </table>  
                  <?php } ?>
                  <div class="col text-right" style="padding-top: 10px !important">
                      <hr>
                      <a class="btn btn-danger" href="<?= base_url('planning_bnp/pdf_rfi_landscape/').$main[0]['transmittal_uniqid'] ?>" target="_blank">
                          <i class="fas fa-file-pdf"></i> PDF
                      </a>
                      <br><br>
                  </div>
                </div>  
                
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card shadow my-3 rounded-0">
              <div class="card-header">
                <h6 class="m-0">Attachment</h6>
              </div>
              <div class="card-body bg-white">
                <button class="btn btn-info <?= $main[0]['status_invitation']==0 ? 'd-none' : '' ?>" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRedline">
                  <i class="fas fa-plus-circle"></i> Add Attachment
                </button>
                <br/><br/>

                <table class="table table-hover text-center table_attachment">
                    <thead class="bg-info text-white">
                        <th>No</th>
                        <th>Attachment Name</th>
                        <th>for Piecemark</th>
                        <th>Uploaded By</th>
                        <th>Uploaded Date</th>
                        <th></th>
                    </thead>
                    <tbody>
                      <?php $no = 1;foreach ($attachment_list as $key => $value): ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td>
                            <a target="_blank" href="https://www.smoebatam.com/pcms_v2_photo/fab_img/<?= $value['filename'] ?>"> <?= $value['filename'] ?></a>
                          </td>
                          <td>
                            <?php if($value['id_detail_wp_paint_system']=='-1'){ ?>
                              <b>All Piecemarks Under This Report</b>
                            <?php } else { ?>
                              <?= $piecemark_name[$piecemark_by_idwpps[$value['id_detail_wp_paint_system']]['id_template']]['part_id'] ?>
                            <?php } ?>
                          </td>
                          <td><?= $user[$value['upload_by']]['full_name'] ?></td>
                          <td><?= $value['upload_datetime'] ?></td>
                          <td>
                            <a href="<?= base_url('planning_bnp/removeAttachment/').strtr($this->encryption->encrypt($value['id']),'+=/', '.-~') ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                </table>
              </div>
            </div>
          </div>

      </div>
    </div>

        

      <!-- </div>  -->
    <!-- </form> -->

    <div class="modal fade" id="modalRedline" role="dialog">
      <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <form action="<?php echo base_url();?>planning_bnp/add_attachment" method="POST"  enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">Add Attachment</h4>
            </div>
            <div class="modal-body">

              <b><i>Upload By :</i></b>
              <input type="text" name="upload_byx" class="form-control" required value="<?= $this->user_cookie[1] ?>" readonly>
              <input type="hidden" name="upload_by" required value="<?= $this->user_cookie[0] ?>">
              <input type="hidden" name="submission_id" required value="<?= $main[0]['transmittal_uniqid'] ?>"><br>
              
              <b><i>Upload Date :</i></b>
              <input type="text" name="upload_datetime" class="form-control" required value="<?= DATE('Y-m-d H:i:s') ?>" readonly><br>

              <b><i>Attachment File :</i></b><br>
              <input type="file" name="attachment[]" accept="application/pdf" multiple="" required>

              <br><br>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="all_piecemark" style="width: 20px !important; height: 20px !important" value="1">
                <label class="form-check-label" for="exampleCheck1" ><b>All Piecemark</b></label>
              </div>

              <br>
              <table class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white">
                <tr>
                    <th>NO</th>
                    <th>PIECEMARK NO.</th>
                    <th>DRAWING NUMBER</th>
                    <th>PAINT SYSTEM</th>
                </tr>
                </thead>
                <?php if($wp_type==0){ ?>
                  <tbody>
                    <?php foreach ($workpack_list as $key => $value) { ?>
                      <tr>
                        <td style="vertical-align: middle !important;">
                          <input type="checkbox" name="id_detail_wp_paint_systemx[]" value="<?= $value['id_detail_wp_paint_system'] ?>" style="width: 20px !important; height: 20px !important" onclick="saveValue(this)">
                        </td>
                        <td><?= $piecemark_name[$value['id_template']]['part_id'] ?></td>
                        <td><?= $piecemark_name[$value['id_template']]['drawing_ga'] ?></td>
                        <td><?= $paint_system[$value['id_paint_system']]['name'] ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                <?php } else { ?>
                  <tbody>
                    <?php foreach($list as $key => $value){
                      if(isset($value['drawing_as']) && !empty($value['drawing_as'])){
                          $weldmap_material = substr($value['drawing_as'],-13);
                      } else {
                          $weldmap_material = substr($value['drawing_ga'],-20);
                      }  
              
                      if(isset($warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'])){
                          $uniq_no_p1 = $warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'];
                      } else {
                          $uniq_no_p1 = "-";
                      } 

                      if($uniq_no_p1 != "-"){ 
                          if(isset($list_unique_data[$uniq_no_p1])){
                              $list_of_attachment = array(); 
                              foreach($list_unique_data[$uniq_no_p1] as $key => $vx){ 
                              $list_of_attachment[] = "<a target='_blank' href='https://www.smoebatam.com/warehouse_ori/file/mrir/cm/".$vx["document_file"]."'  style='display: inline-block !important;'>".$vx["document_name"]."</a>";
                              }
                              $show_attachment = implode("<br/><br/>",$list_of_attachment);
                          } else {
                              $show_attachment = "-";
                          }
                      } else {
                      $show_attachment = "-";
                      } 

                      if(isset($status_piecemark[$value['part_id']]['profile'])){
                          $profile_p1 = $status_piecemark[$value['part_id']]['profile'];
                      } else {
                          $profile_p1 = "-";
                      } 

                      if(isset($status_piecemark[$value['part_id']]['diameter'])){
                          $diameter_p1 = $status_piecemark[$value['part_id']]['diameter'];
                      } else {
                          $diameter_p1 = "-";
                      }

                      if(isset($status_piecemark[$value['part_id']]['length'])){
                          $length_p1 = $status_piecemark[$value['part_id']]['length'];
                      } else {
                          $length_p1 = "-";
                      } 

                      if(isset($status_piecemark[$value['part_id']]['area'])){
                          $area_p1 = $status_piecemark[$value['part_id']]['area'];
                      } else {
                          $area_p1 = "-";
                      }

                      if(isset($status_piecemark[$value['part_id']]['can_number'])){
                      $can_number = $status_piecemark[$value['part_id']]['can_number'];
                      } else {
                      $can_number = "-";
                      }

                      if(isset($status_piecemark[$value['part_id']]['thickness'])){
                          $thickness_p1 = $status_piecemark[$value['part_id']]['thickness'];
                      } else {
                          $thickness_p1 = "-";
                      } 

                      $project_id               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['project_code']),'+=/', '.-~');
                      $discipline               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['discipline']),'+=/', '.-~');
                      $type_of_module           = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['type_of_module']),'+=/', '.-~');
                      $module                   = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['module']),'+=/', '.-~');
                      $report_no                = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_number']),'+=/', '.-~');
                      $report_no_rev            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_no_rev']),'+=/', '.-~');
                      $submission_id            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['submission_id']),'+=/', '.-~');

                      if(isset($status_piecemark[$value['part_id']]['status_inspection'])){
                          if($status_piecemark[$value['part_id']]['status_inspection'] >= 3){
                              if(isset($status_piecemark[$value['part_id']]['report_number'])){
                              $status_inspection_p1 = '<a target="_blank" href="'.base_url().'material_verification/material_verification_pdf_client/'.$project_id.'/'.$discipline.'/'.$type_of_module.'/'.$module.'/'.$report_no.'/'.$report_no_rev.'">COMPLETED</a>';
                              } else {
                              $status_inspection_p1 = '<a target="_blank" href="'.base_url().'material_verification/material_verification_pdf/'.$submission_id.'">COMPLETED</a>';
                              }                                               
                          } else {
                          $status_inspection_p1 ='OS';  
                          }
                          
                      } else {
                          $status_inspection_p1 = "-";
                      }

                      $status_fitup = "-"; 
                      $status_visual ="-";
                      $status_MT_show = "-";
                      $status_PT_show = "-";
                      $status_UT_show = "-";
                      $status_RT_show = "-";
                    ?>
                      <tr>
                        <td style="vertical-align: middle !important;">
                          <input type="checkbox" name="id_detail_wp_paint_system[]" value="<?= $arr_wp[$value['id_piecemark']]['id_detail_wp_paint_system'] ?>" style="width: 20px !important; height: 20px !important">
                        </td>
                        <td><?= $value['part_id'] ?></td>
                        <td><?= $value['drawing_ga'] ?></td>
                        <td><?= $paint_system[$arr_bp[$arr_wp[$value['id_piecemark']]['id']]['id_paint_system']]['name'] ?></td>
                      </tr>          
                    <?php } ?>                     
                  </tbody>
                <?php } ?>
              </table> 

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
      
</div>
</div>



<script>
  var arrai = []

  function saveValue(ini){
    if($(ini)[0].checked == true){
      console.log('centang')
      arrai.push($(ini).val())
    } else {
      console.log('gak centang')
      arrai = $.grep(arrai, function(value) {
        return value != $(ini).val();
      });
    }
    console.log(arrai);
    $('.id_detail_wp_paint_system').val('')
    $('.id_detail_wp_paint_system').val(arrai)
  }

  $("select[name=module]").chained("select[name=project]");
  
  $(document).ready(function(){ 
    selectRefresh();    
  });

  function selectRefresh() {     
    $(".select2_multiple_activity").select2({ 
        allowClear: true,
        tokenSeparators: [', ', ' '],
    }) 
    $(".select2_multiple_paint_system").select2({ 
        allowClear: true,
        tokenSeparators: [', ', ' '],
    }) 
  }
  

  $('.dataTable').DataTable({
    order: [],
    columnDefs: [{
      "targets": 0,
      "orderable": false,
    }]
  })

  var data_checkbox = [];
  function save_checkbox(input) {
    console.log(data_checkbox);
    if($(input).prop("checked") == true && $.inArray($(input).val(), data_checkbox) == -1){
      data_checkbox.push($(input).val());
    }
    else if($(input).prop("checked") == false && $.inArray($(input).val(), data_checkbox) != -1){
      data_checkbox.splice( $.inArray($(input).val(), data_checkbox), 1 );
    }
    $(".num_ticker").html(data_checkbox.length)
  }

  function checkall(input) {
    $('#form_create_workpack input[type=checkbox]').each(function(i, obj) {
      if($(input).prop("checked") == true && $(obj).prop("checked") == false){
        $(obj).trigger("click");
        console.log("all"+$(obj).val());
      }
      else if($(input).prop("checked") == false && $(obj).prop("checked") == true){
        $(obj).trigger("click");
      }
    });
  }

  function create_workpack() {
    if(data_checkbox.length > 0){
      sweetalert("loading", "Please wait...!");
      $("#form_create_workpack input[name=template_id]").val(data_checkbox.join(", "));
      document.getElementById("form_create_workpack").submit();
    }
    else{
      sweetalert("error", "No item selected!");
    }
  }

  $(".autocomplete_irn_approved").autocomplete({
    source: function( request, response ) {
      var project_id = $("#project_id option:selected").val();
      var drawing_type = 3;
      $.ajax( {
        url: "<?php echo base_url() ?>planning/autocomplete_irn_approved",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: drawing_type,
          project_id: project_id,
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    // select: function (event, ui) {
    //   var value = ui.item.value;
    //   if(value == 'No Data.'){
    //     ui.item.value = "";
    //   }
    //   else{
    //     get_data_drawing(ui.item.value);
    //   }
    // }
  });

   
</script>