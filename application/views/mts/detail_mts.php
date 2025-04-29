<?php $this->load->view('_partial/header'); ?>
<?php

error_reporting(0);
$irn            = $irn[0];
$mts            = $pc_list[0];

$enc_path_cert  = encrypt("/PCMS/warehouse/receiving");

if ($from_signed == 1) {
  $signed       = $signed_list[0];
  $irn          = $signed;
}

$links_atc = base_url_ftp_eng() . "public_smoe/open_atc/2/" . encrypt($drawing[$mts['drawing_ga']]['id']) . "/" . $drawing[$mts['drawing_ga']]['last_revision_no'];

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

  .bg_color_reject_client {
    background-color: #76db99;
  }

  .color_reject_client {
    color: #ff0000;
  }

  .color_pending_QC {
    background-color: #6bff93;
  }
</style>
<title>MTS</title>
<?php if (isset($signed_list) && @$mts['status_inspection'] <= 1) : ?>
  <div class="row mb-2">
    <div class="col-md-12">
      <a href="<?= site_url('mts/import_piecemark/' . encrypt($mts['drawing_no']) . '/' . encrypt($mts['uniq_id'])) ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Piecemark</a>
    </div>
  </div>
<?php endif; ?>
<table class="mb-2" width="100%" style="border-collapse: collapse !important; border: 1px solid black">
  <tr>
    <td class="v_middle text-left p-2" width="20%">
      <img src="<?= base_url() ?>img/seatrium_logo_bg_white.png" style="width:300px">
    </td>
    <td class="v_middle text-center p-2" width="60%">
      <h1><?= $project[$mts['project']]['description'] ?></h1>
    </td>
    <td class="v_middle text-right p-2" width="20%">
      <img src="<?= $project[$mts['project']]['client_logo'] ?>" style="width:200px">

    </td>
  </tr>
</table>
<table style="width:100%; font-weight: bold !important;">
  <tr>
    <td style="width:200px; white-space: nowrap !important"> PROJECT NAME </td>
    <td> : </td>
    <td> <?= $project[$mts['project']]['project_name'] ?> </td>
    <td rowspan="5" style="vertical-align: middle !important;">
      <center>
        <h2><strong>MATERIAL TRACEABILITY SUMMARY</strong></h2>
      </center>
    </td>
  </tr>

  <tr>
    <td> <?= ($mts['project'] == 17 ? 'CLIENT' : 'COMPANY') ?> </td>
    <td> : </td>
    <td> <?= $project[$mts['project']]['client'] ?> </td>
  </tr>

  <tr>
    <td> DRAWING NO </td>
    <td> : </td>
    <td class="text-nowrap"><?= $mts['drawing_no'] ?> (<a href="<?= $links_atc ?>" target="_blank"> File Drawing</a>) <br> <?= ($drawing[$mts['drawing_no']]['drawing_no'] && $mts['project'] == 19) ? $drawing[$mts['drawing_no']]['drawing_no'] : "" ?></td>
  </tr>

  <tr>
    <td> REV </td>
    <td> : </td>
    <td><?= $data_drawing[$mts['drawing_no']]['last_revision_no'] ? $data_drawing[$mts['drawing_no']]['last_revision_no'] : 'N/A' ?></td>
  </tr>

  <tr>
    <td> DESCRIPTION </td>
    <td> : </td>
    <td style="width:200px; white-space: nowrap !important"><?= $drawing[$mts['drawing_no']]['title'] ?></td>
  </tr>

  <?php if (isset($signed_list)) : ?>
    <tr>
      <td> ATTACHMENT </td>
      <td> : </td>
      <td style="width:200px; white-space: nowrap !important">
        <?php if ($this->permission_cookie[0] == 1) : ?>
          <form action="<?= site_url('btr/upload_attachment') ?>" enctype="multipart/form-data" method="post">
            <input type="hidden" name="uniq_id" value="<?= $mts['uniq_id'] ?>">
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
    <th>S/N</th>
    <th>DRAWING NUMBER <br> (ASSEMBLY)</th>
    <th>DRAWING NUMBER <br> (ASSEMBLY) REV.</th>
    <th>DRAWING NUMBER <br> (<?= $mts['project'] == 21 ? 'CUTTING PLAN' : 'SINGLE PART' ?>)</th>
    <th>DRAWING NUMBER <br> (<?= $mts['project'] == 21 ? 'CUTTING PLAN' : 'SINGLE PART' ?>) REV.</th>
    <th>MATERIAL DESCRIPTION</th>
    <th>PROFILE</th>
    <th>PIECE MARK NUMBER</th>
    <th>QTY</th>
    <th>UNIQUE NUMBER</th>
    <th>MILL CERT NO</th>
    <th>HEAT NUMBER</th>
    <th>PRODUCT TEST NO</th>
    <th>MATERIAL GRADE</th>
    <th>MATERIAL CLASS</th>
    <th>DELIVERY CONDITION</th>
    <th>SIZE (INCH)</th>
    <th>DIAMETER <br> (mm)</th>
    <th>THK <br> (mm)</th>
    <th>WIDTH <br> (mm)</th>
    <th>LENGTH <br> (mm)</th>
    <th>WEIGHT <br> (kg)</th>
    <th>MRIR REPORT NUMBER</th>
    <th>MV REPORT NUMBER</th>
    <th>MV APPROVED DATE</th>
    <th>MV INSPECTION STATUS</th>
    <th>REMARKS</th>
    <?php if ($from_signed) : ?>
      <th></th>
    <?php endif; ?>
  </thead>
  <?php $no = 1;
  foreach ($pc_list as $key => $value) : ?>
    <?php

    $data_mv        = $mv[$value['id_piecemark']];
    $data_mis       = $mis[$data_mv['id_mis']];
    $mrir_report    = explode("/", $data_mis['report_no'])[1];

    if ($data_mis['partial_report_no'] > 0) {
      $mrir_report  .= '-' . $data_mis['partial_report_no'];
    }
    // $mrir_link      = wh_base_url().'mb/detail_mrir_cs/'.$data_mis['discipline'].'?id='.encrypt($data_mis['mrir_id']).'&action='.encrypt("detail").'&status='.encrypt($unique_detail[$data_mis['unique_no']]['status']).'&partial_report_no='.encrypt($data_mis['partial_report_no']).'&user='.encrypt($this->user_cookie[0]);
    $mrir_link      = wh_base_url() . 'mb/mrir_material_link/' . $data_mis['discipline'] . '/' . encrypt($data_mis['mrir_id']) . '/' . encrypt("detail") . '/' . encrypt($unique_detail[$data_mis['unique_no']]['status']) . '/' . encrypt($data_mis['partial_report_no']);
    $encrypt_link   = encrypt($mrir_link);
    $mrir_link      = link_portal() . "/jump_url/redirect/" . $encrypt_link;

    $mill_cert    = $data_mis['mill_cert_no'];

    if (isset($att_rec[$rec_det[$unique_detail[$data_mis['unique_no']]['receiving_detail_id']]['receiving_id']][$data_mis['mill_cert_no']])) {

      $cert_name = $att_rec[$rec_det[$unique_detail[$data_mis['unique_no']]['receiving_detail_id']]['receiving_id']][$data_mis['mill_cert_no']];

      $enc_cert_name  = encrypt($mill_cert);
      $enc_rec_id     = encrypt($rec_det[$unique_detail[$data_mis['unique_no']]['receiving_detail_id']]['receiving_id']);
      $link_cert      = wh_base_url().'public_smoe/open_file_cert/'.$enc_cert_name.'/'.$enc_rec_id.'/receiving/download';
      $mill_cert    = '<a href="' . $link_cert . '" target="_blank">' . $mill_cert . '</a>';
    }

    if ($data_mv) {
      $project_mv_enc         = encrypt($data_mv['project_code']);
      $discipline_mv_enc      = encrypt($data_mv['discipline']);
      $type_of_module_mv_enc  = encrypt($data_mv['type_of_module']);
      $module_mv_enc          = encrypt($data_mv['module']);
      $report_no_mv_enc       = encrypt($data_mv['report_number']);
      $report_no_rev_mv_enc   = encrypt($data_mv['report_no_rev']);
      $drawing_no_mv_enc      = encrypt($data_mv['drawing_no']);
      $detail_enc             = encrypt('detail');

      
      if ($data_mv['project_code'] == 21) {
        $running_report = $this->format_report[$data_mv['project_code']][$data_mv['company_id']][$data_mv['discipline']][$data_mv['module']][$data_mv['type_of_module']][$data_mv['deck_elevation']]['mv_no'];
      } else {
        $running_report = $this->format_report[$data_mv['project_code']][$data_mv['company_id']][$data_mv['discipline']][$data_mv['module']][$data_mv['type_of_module']]['mv_no'];
      }

      if ($data_mv['company_id'] == 13) {
        $running_report = $this->format_report[$data_mv['project_code']][$data_mv['discipline']][$data_mv['module']][$data_mv['type_of_module']]['mv_no_smop'];
      }

      $running_report         = $running_report . '-' . $data_mv['report_number'];

      if ($data_mv['report_no_rev'] > 0) {
        $running_report       .= ' Rev. ' . $data_mv['report_no_rev'];
      }

      if (in_array($data_mv['status_inspection'], array(7))) {
        $running_report         = '<a target="_blank" href="' . site_url('material_verification/material_verification_pdf_client/' . $project_mv_enc . '/' . $discipline_mv_enc . '/' . $type_of_module_mv_enc . '/' . $module_mv_enc . '/' . $report_no_mv_enc . '/' . $report_no_rev_mv_enc . '/' . $drawing_no_mv_enc) . '">' . $running_report . '</a>';
      } else {
        $running_report         = '<a target="_blank" '. ($data_mv['status_inspection'] == 6 ? "class='color_reject_client'" : '').' href="' . site_url('material_verification/detail_client_rfi/' . $project_mv_enc . '/' . $discipline_mv_enc . '/' . $type_of_module_mv_enc . '/' . $module_mv_enc . '/' . $report_no_mv_enc . '/' . $report_no_rev_mv_enc . '/' . $detail_enc . '/' . $drawing_no_mv_enc) . '">' . $running_report . '</a>';
      }
      
    }

    // SECOND DRAWING
    $second_drawing = $value['drawing_sp'];
    $second_rev     = $data_drawing[$value['drawing_sp']]['last_revision_no'];
    if ($value['project'] == 21) {
      $second_drawing = $value['drawing_cp'];
      // $second_rev     = $data_drawing[$value['drawing_cp']]['last_revision_no'];
      $second_rev     = $value['rev_cp'];

    }

    ?>
    <tr>
      <td><?= $no++ ?></td>
      <td>
        <?php if ($value['drawing_as']) : ?>
          <?php

          $links_atc_as = base_url_ftp_eng() . "public_smoe/open_atc/2/" . encrypt($drawing[$value['drawing_as']]['id']) . "/" . $data_drawing[$value['drawing_as']]['last_revision_no'];

          ?>
          <a href="<?= $links_atc_as ?>" target="_blank"><?= $value['drawing_as'] ?> <br> <?=  ($drawing[$value['drawing_as']]['drawing_no'] && in_array($mts['project'],  [19,21])) ? "(".$drawing[$value['drawing_as']]['drawing_no'].")" : "" ?></a>
        <?php else : ?>
          N/A
        <?php endif; ?>
      </td>
      <td><?= $data_drawing[$value['drawing_as']]['last_revision_no'] && in_array($mts['project'],  [19,21]) ? $data_drawing[$value['drawing_as']]['last_revision_no'] : 'N/A' ?></td>

      <td>
        <?php if ($second_drawing) : ?>
          <?php

          $links_atc_as = base_url_ftp_eng() . "public_smoe/open_atc/2/" . encrypt($drawing[$second_drawing]['id']) . "/" . $second_rev;

          ?>
          <a href="<?= $links_atc_as ?>" target="_blank"><?= $second_drawing ?> <br> <?=  ($drawing[$second_drawing]['drawing_no'] && in_array($mts['project'],  [19,21])) ? "(".$drawing[$second_drawing]['drawing_no'].")" : "" ?></a>
        <?php else : ?>
          N/A
        <?php endif; ?>
      </td>
      <td><?= $second_rev ? $second_rev : 'N/A' ?></td>
      <td><?= $value['material'] ?></td>
      <td><?= $value['profile'] ?></td>
      <td><?= $value['part_id'] ?></td>
      <td>1</td>
      <td><?= $data_mis['unique_no'] ?></td>
      <td><?= $mill_cert ?></td>
      <td><?= $data_mis['heat_or_series_no'] ?></td>
      <td><?= $data_mis['plate_or_tag_no'] ?></td>
      <td><?= $grade[$value['grade']]['material_grade'] ?></td>
      <td><?= $data_mis['spec_category'] ?></td>
      <td><?= $data_mis['delivery_condition'] ?></td>
      <td><?= $value['size'] ?></td>
      <td><?= $value['diameter'] ? $value['diameter'] : '' ?></td>
      <td><?= $value['thickness'] ?></td>
      <td><?= $value['width'] ? $value['width'] : '' ?></td>
      <td><?= $value['length'] ?></td>
      <td><?= $value['weight'] ?></td>
      <td>
        <a href="<?= $mrir_link ?>" target="_blank"><?= $mrir_report ?></a>
      </td>
      <td <?= (in_array($data_mv['status_inspection'], array(0,1,2,4,6,8,9,10,11)) ? "class='bg_color_reject_client'" : null) ?>>
        <?php if ($data_mv['report_number']) : ?>
          <?= $running_report ?>
        <?php endif; ?>
      </td>
      <td><?= $data_mv['inspection_datetime'] ? date('Y-m-d', strtotime($data_mv['inspection_datetime'])) : null ?></td>
      <td>
        <?php if ($data_mv['status_inspection'] == 1) : ?>
          OS
        <?php elseif ($data_mv['status_inspection'] == 2) : ?>
          REJ
        <?php elseif ($data_mv['status_inspection'] >= 3 && $data_mv['status_inspection'] != 6) : ?>
          ACC
        <?php elseif ($data_mv['status_inspection'] == 6) : ?>
          REJECT CLIENT
        <?php endif; ?>
      </td>

      <td></td>
      <?php if ($from_signed) : ?>
        <td>
          <?php if ($value['status_inspection'] == 0  && in_array($this->user_cookie[0], $this->allowed_user)) : ?>
            <button type="button" onclick="delete_joint(this, '<?= encrypt($value['id_mts']) ?>')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
          <?php endif; ?>
        </td>
      <?php endif; ?>

    </tr>
  <?php endforeach; ?>
  <?php if ($from_signed) : ?>
    <tr>
      <td colspan="21" class="text-left p-2">
        <strong>Note (if Any) :</strong>
        <textarea class="form-control mt-2" id="notes"><?= $mts['notes'] ?></textarea>
        <button type="button" onclick="save_note(this)" class="btn btn-success btn-sm mt-2"><i class="fas fa-save"></i> Save Note</button>
      </td>
    </tr>
  <?php endif; ?>
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
      <td style="width: 25%; border: none; padding-top: 10px;"><b><?= ($mts['project'] == 17 ? 'EMPLOYER' : 'COMPANY') ?></b></td>
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
        url: "<?= site_url('mts/approval_mts_signed') ?>",
        type: "POST",
        data: {
          status: status,
          uniq_id: "<?= $mts['uniq_id'] ?>"
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
        url: "<?= site_url('mts/approval_mts_signed_client') ?>",
        type: "POST",
        data: {
          uniq_id: "<?= $mts['uniq_id'] ?>",
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
      type: "warning",
      title: "Delete This Joint From MTS ?",
      showCancelButton: true
    }).then((res) => {
      if (res.value) {
        $.ajax({
          url: "<?= site_url('mts/delete_joint_mts') ?>",
          type: "POST",
          data: {
            id_enc: id_enc
          },
          dataType: "JSON",
          success: (data) => {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "Joint Has Been Deleted",
                timer: 1000
              })

              $(btn).closest('tr').remove()
            }
          }
        })
      }
    })
  }

  function save_note(btn) {

    if (confirm("Update Notes ?") == true) {
      let notes = $("#notes").val()
      $.ajax({
        url: "<?= site_url('mts/update_notes') ?>",
        type: "POST",
        data: {
          uniq_id: "<?= $mts['uniq_id'] ?>",
          notes: notes,
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
</script>