<?php $this->load->view('_partial/header'); ?>
<?php

error_reporting(0);
$irn          = $irn_list[0];
$btr          = $joint_list[0];

if ($from_signed == 1) {
  $signed       = $signed_list[0];
  $irn          = $signed;
}

$links_atc = base_url_ftp_eng() . "public_smoe/open_atc/2/" . encrypt($drawing[$btr['drawing_no']]['id']) . "/" . $drawing[$btr['drawing_no']]['last_revision_no'];

?>
<style>
  @page {
    size: auto;
  }

  body {
    margin: 10px
  }

  th,
  td {
    vertical-align: middle !important;
  }

  .color_pending_client {
    color: #ff0000;
  }

  .color_pending_QC { 
    background-color: #6bff93;
  }

</style>
<title>BTR</title>
<?php if (isset($signed_list) && @$btr['status_inspection'] <= 1) : ?>
  <div class="row">
    <div class="col-md-12">
      <a href="<?= site_url('btr/import_joint/' . encrypt($btr['drawing_no']) . '/' . encrypt($btr['uniq_id'])) ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Joint</a>
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
    <td><?= $drawing[$btr['drawing_no']]['last_revision_no'] ?></td>
  </tr>

  <tr>
    <td> DESCRIPTION </td>
    <td> : </td>
    <td style="width:200px; white-space: nowrap !important"><?= $drawing[$btr['drawing_no']]['title'] ?></td>
  </tr>

  <?php if (isset($signed_list)) : ?>
    <tr>
      <td> ATTACHMENT </td>
      <td> : </td>
      <td style="width:200px; white-space: nowrap !important">
        <?php if ($this->permission_cookie[0] == 1) : ?>
          <form action="<?= site_url('btr/upload_attachment') ?>" enctype="multipart/form-data" method="post">
            <input type="hidden" name="uniq_id" value="<?= $btr['uniq_id'] ?>">
            <div class="row">
              <div class="col-md-4 mt-2">
                <input type="file" name="attachment" accept="application/pdf" required>
                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-upload"></i> Upload</button>
              </div>
            </div>
          </form>
        <?php endif; ?>
      </td>
    </tr>

    <?php if ($attachment_list) : ?>
      <tr>
        <td> </td>
        <td></td>
        <td style="width:200px; white-space: nowrap !important">
          <div class="row">
            <?php foreach ($attachment_list as $key => $value) : ?>
              <?php

              $enc_path   = encrypt("/PCMS/pcms_v2/mwtr");
              $enc_file   = encrypt($value['filename']);

              $link_file  = site_url('irn/open_file/' . $enc_file . '/' . $enc_path);

              ?>
              <div class="col-md-12 mb-1">
                <?php if ($this->permission_cookie[0] == 1) : ?>
                  <button onclick="delete_att(this, '<?= encrypt($value['id']) ?>')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                <?php endif; ?>
                <a href="<?= $link_file ?>" target="_blank"><?= $value['filename'] ?></a>
              </div>
            <?php endforeach; ?>
          </div>
        </td>
      </tr>
    <?php endif; ?>
  <?php endif; ?>


</table>
<br>
<table style="width:100%; text-align: center; border-collapse: collapse;" border="1">
  <thead>
    <tr>
      <th rowspan="3">S/N</th>
      <th rowspan="3">PROJECT</th>
      <th rowspan="3">TITLE</th>
      <th rowspan="3">ISOMETRIC NO</th>
      <th rowspan="3">REV.</th>
      <th rowspan="3">ECODOC NO.</th>
      <th rowspan="3">DATE</th>
      <!-- <th rowspan="3">RFI NO.</th> -->
      <th rowspan="3">REPORT NO.</th>
      <th colspan="3">ISOMETRIC</th>
      <th rowspan="3">BONDER ID</th>
      <th colspan="3">FIT UP & JOINT PREPARATION</th>
      <th colspan="7">ADHESIVE BONDED JOINT</th>
      <th colspan="3">JOINT CURING</th>
      <th colspan="2">ENV</th>
      <th rowspan="3">INSPECTION RESULT</th>
      <th rowspan="3">REMARKS</th>
      <?php if ($from_signed) : ?>
        <th rowspan="3"></th>
      <?php endif; ?>
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
      <th rowspan="2">HUM (%)</th>
      <th rowspan="2">TEMP (DEG C)</th>
    </tr>
    <tr>
      <th>R</th>
      <th>H</th>
      <th>START</th>
      <th>FINISH</th>
      <th>SPEC (MM)</th>
      <th>ACTUAL (MM)</th>
      <th>START</th>
      <th>FINISH</th>
    </tr>

  </thead>
  <tbody>
    <?php $no = 1;
    foreach ($joint_list as $key => $value) : ?>
      <?php

      $show = false;
      if (isset($baa[$value['id']])) {
        $show = true;
      }

      ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $project[$value['project']]['project_name'] ?></td>

        <td><?= $drawing[$value['drawing_no']]['title'] ?></td>
        <td><?= $value['drawing_no'] ?></td>
        <td><?= $value['rev_no'] ?></td>
        <td><?= $drawing[$value['drawing_no']]['client_doc_no'] ?></td>

        <td>
          <?php if ($show) : ?>
            <?= date('Y-m-d', strtotime($baa[$value['id']]['adhesive_time_start'])) ?>
          <?php endif; ?>
        </td>

        <!-- <td>
          <?php if ($show) : ?>
            <a href="<?= site_url('bondstrand/detail_inspection_list/' . encrypt($baa[$value['id']]['submission_id']) . '/' . encrypt("submission") . '/' . encrypt("pdf")) ?>" target="_blank"><?= $baa[$value['id']]['submission_id'] ?></a>
          <?php endif; ?>
        </td> -->

        <td>
          <?php if ($show) : ?>
            <?php if ($baa[$value['id']]['report_number']) : ?>
              <?php

              $report_no_btr  = $baa[$value['id']]['report_number'];
              $report_btr     = $this->format_report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['bonstrand_report'] . $report_no_btr;
              $pdf_action     = "";

              if($baa[$value['id']]['status_inspection'] == 7) {
                $pdf_action   = "pdf";
              }
              ?>
              <a class="<?= $baa[$value['id']]['status_inspection'] ==  5 ? 'color_pending_client' : '' ?>" href="<?= site_url('bondstrand/detail_summary_list/' . encrypt($report_no_btr) . '/' . encrypt($pdf_action)) ?>" target="_blank"> <?= $report_btr ?></a>
            <?php endif; ?>
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
            <?= date('h:i A', strtotime($baa[$value['id']]['adhesive_time_start'])) ?>
          <?php endif; ?>
        </td>

        <td>
          <?php if ($show) : ?>
            <?= date('h:i A', strtotime($baa[$value['id']]['adhesive_time_stop'])) ?>
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
            <?= date('h:i A', strtotime($baa[$value['id']]['curing_start'])) ?>
          <?php endif; ?>
        </td>

        <td>
          <?php if ($show) : ?>
            <?= date('h:i A', strtotime($baa[$value['id']]['curing_finish'])) ?>
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
            <?php elseif ($baa[$value['id']]['status_inspection'] >= 3) : ?>
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

        <?php if ($from_signed) : ?>
          <td>
            <?php if ($value['status_inspection'] == 0  && in_array($this->user_cookie[0], $this->allowed_user)): ?> 
             <button type="button" onclick="delete_joint(this, '<?= encrypt($value['id_btr']) ?>')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
             <?php endif; ?>
          </td>
        <?php endif; ?>


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

        <?php if (@$irn['smoe_approval_by']) : ?>
          <img src="data:image/png;base64,<?= $user[$irn['smoe_approval_by']]['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />

        <?php else : ?>
          <?php if (@$irn['status_inspection'] == 1) : ?>
            <button class="btn btn-primary" onclick="digital_sign(this, 3)"><i class="fas fa-check"></i> Digital Sign</button>
          <?php endif; ?>
        <?php endif; ?>


      </td>
      <td style="width: 25%; border: none;"></td>
      <td style="width: 25%; border: none; vertical-align: text-bottom !important;">
        <?php if (@$irn['client_approval_by']) : ?>
          <img src="data:image/png;base64,<?= $user[$irn['client_approval_by']]['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />
        <?php endif; ?>

        <?php if (@$irn['status_inspection'] == 5) : ?>
          <div class="row">
            <div class="col-md-12">
              <select name="status_by_client" onchange="show_client_sign(this)" class="custom-select" style="width:50% !important">
                <option value="">---</option>
                <option value="7">Accepted</option>
                <option value="9">Accepted & Released with Comment</option>
                <option value="11">Re-Offer</option>
              </select>
            </div>
            <div class="col-md-12 mt-2 remarks_client d-none">
              <textarea name="remarks_client" class="form-control" style="width:50% !important" rows="5"></textarea>
            </div>
            <div class="col-md-12 mt-2 btn_client d-none">
              <button class="btn btn-primary" onclick="digital_sign_client(this)"><i class="fas fa-check"></i> Digital Sign</button>
            </div>
          </div>
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

<script>
  function digital_sign(btn, status) {
    if (confirm("Sign This Document ?") == true) {

      $.ajax({
        url: "<?= site_url('btr/approval_btr_signed') ?>",
        type: "POST",
        data: {
          status: status,
          uniq_id: "<?= $btr['uniq_id'] ?>"
        },
        dataType: "JSON",
        success: (data) => {
          if (data.success) {
            location.reload()
          }
        }
      })

    }
  }

  function show_client_sign(select) {
    let value = select.value

    if (value) {
      $('.btn_client').removeClass('d-none')


      if (value == 9 || value == 11) {
        $('.remarks_client').removeClass('d-none')
      } else {
        $('.remarks_client').addClass('d-none')
        $('textarea[name="remarks_client"]').val('')
      }
    } else {
      $('.btn_client').addClass('d-none')
      $('.remarks_client').addClass('d-none')
      $('textarea[name="remarks_client"]').val('')
    }
  }

  function digital_sign_client(btn) {
    if (confirm("Sign This Document ?") == true) {
      $.ajax({
        url: "<?= site_url('btr/approval_btr_signed_client') ?>",
        type: "POST",
        data: {
          uniq_id: "<?= $btr['uniq_id'] ?>",
          status: $('select[name="status_by_client"]').val(),
          remarks_client: $('textarea[name="remarks_client"]').val()

        },
        dataType: "JSON",
        success: (data) => {
          if (data.success) {
            location.reload()
          }
        }
      })

    }
  }

  function delete_att(btn, id_enc) {
    Swal.fire({
      type: "warning",
      title: 'Are you sure to delete this attachment?',
      showCancelButton: true,

    }).then((res) => {
      if (res.value) {
        $.ajax({
          url: "<?= site_url('btr/delete_att') ?>",
          type: "POST",
          data: {
            id_enc: id_enc
          },
          dataType: "JSON",
          success: (data) => {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "Data Has Been Deleted !!",
                timer: 1000
              })

              setTimeout(() => {
                location.reload()
              }, 1000);
            }
          }
        })
      }
    })
  }

  function delete_joint(btn, id_enc) {
    Swal.fire({
      type : "warning",
      title : "Delete This Joint From BTR ?",
      showCancelButton : true
    }).then((res) => {
      if(res.value) {
        $.ajax({
          url : "<?= site_url('btr/delete_joint_btr') ?>",
          type : "POST",
          data : {
            id_enc : id_enc
          },
          dataType : "JSON",
          success : (data) => {
            if(data.success) {
              Swal.fire({
                type : "success",
                title : "Joint Has Been Deleted",
                timer : 1000
              })

              $(btn).closest('tr').remove()
            }
          } 
        })
      }
    })
  }
</script>