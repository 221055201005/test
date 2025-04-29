<style>
  .ui-front {
    z-index: 9999999 !important;
}
</style>
<div id="content" class="container-fluid">
  <div class="row">
    <div class="col-md-5">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="GET">
            <div class="row">
              <div class="col-md">
                <div class="form-group row">
                  <div class="col-md">
                    <input type="text" class="form-control autocomplete_wm" name="drawing_wm" placeholder="Type Drawing WM" value="<?php echo @$get['drawing_wm'] ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md">
                    <input type="text" class="form-control" name="report_no" placeholder="Type Report No" value="<?php echo @$get['report_no'] ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md">
                    <input type='text' name="joint_no" class="form-control autopiecemark" onfocus="autopiecemark(this);" onblur="search_piecemark(this);" placeholder="Type Joint" value="<?php echo @$get['joint_no'] ?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-auto">
                    <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-search"></i> Search</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <?php if (@$joint['joint_no'] != '') : ?>
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0"><?php echo $joint['joint_no'] ?></h6>
          </div>
          <div class="card-body bg-white overflow-auto">
            <div class="row">
              <div class="col-md">
                <table border="0">
                  <tr>
                    <td class="font-weight-bold">Drawing No</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['drawing_no'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Drawing WM</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['drawing_wm'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Joint No</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['joint_no'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">GA/AS Reference#1</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['ref_1'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Piecemark#1</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['pos_1'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">GA/AS Reference#2</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['ref_2'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Piecemark#2</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['pos_2'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Deck Elevation / Service Line </td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $deck_elevation_list[$joint['deck_elevation']]['code'] ?> - <?php echo $deck_elevation_list[$joint['deck_elevation']]['name'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Desc Assy.</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $desc_assy_list[$joint['description_assy']]['code'] ?> - <?php echo $desc_assy_list[$joint['description_assy']]['name'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Spool No</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['spool_no'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Row</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['grid_row'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Column</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['grid_column'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Sector</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo @$sector_list[$joint['grid_row'] . $joint['grid_column']] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Is Bondstrand</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo ($joint['is_bondstrand'] == '1' ? 'Yes' : 'No') ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">History Revision</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><a href="#" onclick="open_history_log(<?php echo $joint['id'] ?>)">Open History</a></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">More Info</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><a target="_blank" href="<?= base_url() ?>engineering/joint_list?status=<?= ($joint['workpack_id'] == '' ? 'outstanding' : 'submitted') ?>&submit=search&drawing_no=<?= $joint['drawing_no'] ?>">Go to Detail</a></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
    <div class="col-md">
      <?php if (@$rfi) : ?>
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Results</h6>
          </div>
          <div class="card-body bg-white overflow-auto">
            <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">

              <?php foreach ($rfi as $keys => $values) { ?>
              <li class="nav-item" role="presentation">
                <a class="rounded-0 nav-link <?= $first==$keys ? 'active' : '' ?>" id="pills-<?= $keys ?>-tab" data-toggle="pill" href="#pills-<?= $keys ?>" role="tab" aria-controls="pills-<?= $keys ?>" aria-selected="true">
                  <?php print_r($master_report_no[$values[0]['project']][$values[0]['company_id']][$values[0]['discipline']][$values[0]['module']][$values[0]['type_of_module']]["ndt_rfi"]."-".$method."-".$keys) ?>

                  <?php
                  echo "&nbsp;";
                  if (count($values) > 0) {
                    echo "<span class='badge badge-dark badge-pill'>" . count($values) . "</span>";
                  } else {
                    echo "<span class='badge badge-light badge-pill'>0</span>";
                  }
                  ?>
                </a>
              </li>
              <?php } ?>

            </ul>
            <div class="tab-content overflow-auto" id="pills-tabContent" style="max-height: 60vh;">
              <?php foreach ($rfi as $keys => $values) { ?>
              <div class="tab-pane fade <?= $first==$keys ? 'show active' : '' ?>" id="pills-<?= $keys ?>" role="tabpanel" aria-labelledby="pills-<?= $keys ?>-tab">
                <hr>
                <?php  
                  $enc_uniq_id_report     = encrypt($values[0]['uniq_id_report']);
                  $link_more = site_url("ndt_live/ndt_detail_" . strtolower($method) . "/" . $enc_uniq_id_report);
                  $initial_enc = encrypt($method);

                  if ($values[0]['uniq_id_report'] == '') {
                    $link_more = site_url("ndt_live/joint_list/" . $initial_enc . '?drawing_no=' . $joint['drawing_no']);
                  }
                ?>
                <table border="0">
                  <tr>
                    <td class="font-weight-bold">Report No</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?= $values[0]['report_no'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Status</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td>
                      <?php
                      $status_list[0]             = [
                        'text'                    => "Submited",
                        'color'                   => "primary"
                      ];
                      $status_list[1]             = [
                        'text'                    => "Pending by QC (SEATRIUM)",
                        'color'                   => "warning"
                      ];
                      $status_list[2]             = [
                        'text'                    => "Rejected by QC (SEATRIUM)",
                        'color'                   => "danger"
                      ];
                      $status_list[3]             = [
                        'text'                    => "Approved by QC (SEATRIUM)",
                        'color'                   => "success"
                      ];
                      $status_list[13]             = [
                        'text'                    => "Pending by QC (SUBCONT)",
                        'color'                   => "warning"
                      ];
                      $status_list[14]             = [
                        'text'                    => "Rejected by QC (SUBCONT)",
                        'color'                   => "danger"
                      ];
                      $status_list[15]             = [
                        'text'                    => "Approved by QC (SUBCONT)",
                        'color'                   => "success"
                      ];
                      $status_list[4]             = [
                        'text'                    => "Pending by Client",
                        'color'                   => "warning"
                      ];
                      $status_list[5]             = [
                        'text'                    => "Pending by Client",
                        'color'                   => "warning"
                      ];
                      $status_list[6]             = [
                        'text'                    => "Rejected by Client",
                        'color'                   => "danger"
                      ];
                      $status_list[7]             = [
                        'text'                    => "Approved by Client",
                        'color'                   => "success"
                      ];
                      $status_list[8]             = [
                        'text'                    => "Re-Offer Client",
                        'color'                   => "warning"
                      ];
                      $status_list[9]             = [
                        'text'                    => "Not Active",
                        'color'                   => "secondary"
                      ];
                      $status_list[12]             = [
                        'text'                    => "Void",
                        'color'                   => "dark"
                      ];

                      if ($value['submission_id'] == '') {
                        $status_list[0]             = [
                          'text'                    => "Pending Vendor Submission",
                          'color'                   => "primary"
                        ];
                      }

                      ?>
                      <span class="badge badge-pill badge-<?= $status_list[$values[0]['status_inspection']]['color'] ?>"><?= $status_list[$values[0]['status_inspection']]['text'] ?></span>
                    </td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">More Info</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><a target="_blank" href="<?= $link_more ?>">Go to Detail</a></td>
                  </tr>
                </table>
                
                <hr>

                <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-idndt="<?= encrypt($values[0]["id_".strtolower($method)]) ?>">
                  Add <i class="fas fa-plus"></i>
                </button>
                <br>
                <br>

                <table class="table table-bordered table-hover text-center">
                  <thead>
                    <tr class="bg-gray-table">
                      <th>Welder</th>
                      <th>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($values as $key => $value) { ?>
                    <tr>
                      <td><?= $master_welder[$value["id_welder"]]["welder_code"].' - '.$master_welder[$value["id_welder"]]["welder_name"] ?></td>
                      <td>
                        <?php if(COUNT($values)>1){ ?>
                        <span class="btn btn-danger" onclick="removeWelder('<?= encrypt($value["id_".strtolower($method)]) ?>', '<?= encrypt($value["id_welder"]) ?>', '<?= strtolower($method) ?>')">
                          <i class="fas fa-times"></i>
                        </span>
                        <?php } ?>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php elseif (@$get['joint_no'] != '') : ?>
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Results</h6>
          </div>
          <div class="card-body bg-white overflow-auto">
            Joint Not Found
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Welder</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="<?= base_url("ndt_live/add_welder") ?>">
      <div class="modal-body">
        <div class="form-group">
          <label class="col-form-label">Welder</label>
          <input type="text" class="form-control" name="id_welder" onfocus="autowelder(this);">
          <input type="hidden" class="idndt" name="id_ndt">
          <input type="hidden" class="method" name="method" value="<?= $method ?>">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
</div>

</div><!-- ini div dari sidebar yang class wrapper -->



<script type="text/javascript">
  function autowelder(input) {
    $("input[name=id_welder]").autocomplete({
      source: function(request, response) {
        $.ajax({
          url: "<?php echo base_url() ?>ndt_live/autocomplete_welder",
          type: "post",
          dataType: "json",
          data: {
            term: request.term,
            project_id: "<?= $rfi[$first][0]['project'] ?>"
          },
          success: function(data) {
            response(data);
          }
        });
      }
    });
  }

  $('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var idndt = button.data('idndt') 

    $('.idndt').val(idndt)
  })

  function removeWelder(id_ndt_enc, id_welder_enc, method) {
    Swal.fire({
      type: 'warning',
      title: 'Are You Sure to Delete this Data?',
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: 'Yes',
    }).then((result) => {
      console.log(result)
      /* Read more about isConfirmed, isDenied below */
      if (result.value == true) {
        $.ajax({
          url: "<?= base_url() ?>ndt_live/removeWelder",
          type: "POST",
          data: {
            id_ndt_enc: id_ndt_enc,
            id_welder_enc: id_welder_enc,
            method: method,
          },
        })
        Swal.fire('Success!', '', 'success')
        location.reload()
      } else {
        Swal.fire('Changes are not saved', '', 'info')
      }
    })
  }

  function autopiecemark(input) {
    $("input[name=joint_no]").autocomplete({
      source: function(request, response) {
        var drawing_wm = $('input[name=drawing_wm]').val()
        var spool_no = $('input[name=spool_no]').val()
        $.ajax({
          url: "<?php echo base_url() ?>ndt_live/autocomplete_joint",
          type: "post",
          dataType: "json",
          data: {
            term: request.term,
            drawing_wm: drawing_wm,
            method: "<?= $method ?>",
          },
          success: function(data) {
            response(data);
          }
        });
      }
    });
  }

  $(".autocomplete_doc, .autocomplete_wm").autocomplete({
    source: function(request, response) {
      var project_id = $("#project_id option:selected").val();
      var drawing_type;
      if ($(this.element).hasClass("autocomplete_doc")) {
        drawing_type = 1; //ga or as
      } else if ($(this.element).hasClass("autocomplete_wm")) {
        drawing_type = 2;
      }
      $.ajax({
        url: "<?php echo base_url() ?>engineering/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: drawing_type,
          project_id: project_id,
        },
        success: function(data) {
          response(data);
        }
      });
    }
  });

  $(".autocomplete_spool_no").autocomplete({
    source: function(request, response) {
      $.ajax({
        url: "<?php echo base_url() ?>engineering/autocomplete_spool_no",
        dataType: "json",
        data: {
          term: request.term,
        },
        success: function(data) {
          response(data);
        }
      });
    }
  });

  function open_history_log(id) {
    $('#history_log').modal('show');
    $('#history_log .modal-body').html('<div class="text-center"><div class="spinner-border text-success" role="status"><span class="sr-only">Loading...</span></div></div>');
    $.ajax({
      url: "<?php echo base_url() ?>engineering/get_table_history_log",
      type: "POST",
      data: {
        id_template: id,
        module: 2,
      },
      success: function(data) {
        $('#history_log .modal-body').html(data);
      }
    });
  }

  function search_piecemark(input) {
    // if($(input).val() != ''){
    //   $(input).closest('form').submit();
    // }
  }
</script>