<style>
  th,
  td {
    vertical-align: middle !important;
  }

  .input_width {
    width: 300px !important;
  }
</style>
<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card rounded-0 shadow">
          <div class="card-header">
            <h6 class="m-0 card-title"> Create New Consumable Lot No.</h6>
          </div>
          <div class="card-body">
            <form action="<?= site_url('master/consumable/submit_consumable') ?>" method="post">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive overlfow-auto">
                    <table class="table table-hover text-center table-sm">
                      <thead class="bg-info text-white">
                        <th>Project</th>
                        <th>Batch Lot. No</th>
                        <th>Brand Trade Name & Classification</th>
                        <th>Manufacturer</th>
                        <th>Diamater Size <br> (mm)</th>
                        <th>WPS Used</th>
                        <th>Action</th>
                      </thead>
                      <tbody id="t_body">
                        <tr>
                          <td>
                            <select name="project_id[0]" class="custom-select" required>
                              <option value="">---</option>
                              <?php foreach ($project_list as $key => $value) : ?>
                                <option value="<?= $value['id'] ?>"><?= $value['project_name'] ?></option>
                              <?php endforeach; ?>
                            </select>
                          </td>
                          <td><input type="text" name="lot_no[0]" onfocus="autocomplete_lot_no(this)" class="form-control input_0" required></td>
                          <td><input type="text" name="brand_trade_name[0]" class="form-control input_1 inputable" required></td>
                          <td><input type="text" name="manufacturer[0]" class="form-control input_2 inputable" required></td>
                          <td><input type="text" name="diameter[0]" class="form-control input_3 inputable" required></td>
                          <td>
                            <select name="id_wps[0][]" class="select2 input_width" multiple required>
                              <?php foreach ($wps_list as $key => $value): ?> 
                               <option value="<?= $value['id_wps'] ?>"><?= $value['wps_no'] ?></option>
                               <?php endforeach; ?>
                            </select>
                          </td>
                          <td>
                            <button type="button" onclick="new_row(this)" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12 text-right">
                  <a href="<?= site_url('master/consumable/consumable_list') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                  <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
  $('form').on('submit', function() {
    $('button[name="submit"]').attr('disabled', true)
  })

  var row_no = 1

  function new_row(btn) {
    let new_row = `
    <tr>
      <td>
        <select name="project_id[${row_no}]" class="custom-select" required>
          <option value="">---</option>
          <?php foreach ($project_list as $key => $value) : ?>
            <option value="<?= $value['id'] ?>"><?= $value['project_name'] ?></option>
          <?php endforeach; ?>
        </select>
      </td>
      <td><input type="text" name="lot_no[${row_no}]" onfocus="autocomplete_lot_no(this)" class="form-control input_0" required></td>
      <td><input type="text" name="brand_trade_name[${row_no}]" class="form-control input_1 inputable" required></td>
      <td><input type="text" name="manufacturer[${row_no}]" class="form-control input_2 inputable" required></td>
      <td><input type="text" name="diameter[${row_no}]" class="form-control input_3 inputable" required></td>
      <td>
        <select name="id_wps[${row_no}][]" class="select2 input_width" multiple required>
          <?php foreach ($wps_list as $key => $value): ?> 
            <option value="<?= $value['id_wps'] ?>"><?= $value['wps_no'] ?></option>
            <?php endforeach; ?>
        </select>
      </td>
      <td>
        <button type="button" onclick="delete_row(this)" class="btn btn-danger btn-sm"><i class="fas fa-minus"></i></button>
      </td>
    </tr>
    `
    $("#t_body").append(new_row)
    $('.select2').select2({
      theme : 'bootstrap'
    })

    row_no++
  }

  function delete_row(btn) {
    $(btn).closest('tr').remove()
  }

  function autocomplete_lot_no(input) {
    $(input).autocomplete({
      source: function(request, response) {
        $.post('<?php echo base_url(); ?>master/consumable/autocomplete_lot_no/', {
          term: request.term,
        }, response, 'json');
      },
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      },
      minLength: 0,
      select: function(event, ui) {
        checklot(ui.item.value, input)

      },
      close: function(event, ui) {
        $(input).val('')
      }
    })
  }

  function checklot(lot_no, input) {

    if (lot_no == '') return false;

    let lot_dup = []


    $.ajax({
      url: "<?= site_url('master/consumable/validate_lot_no') ?>",
      type: "POST",
      dataType: "JSON",
      data: {
        lot_no: lot_no
      },
      success: (data) => {
        if (data.success) {
          input.value = lot_no

          $('.input_0').each(function() {
            if (this.value == lot_no) {
              lot_dup.push(1)
            }
          })

          if (lot_dup.length > 1) {
            Swal.fire({
              type: "error",
              title: `Duplicate Lot Number`,
              html: `Lot Number ${lot_no} Alredy Exist in the List`
            })
            $(input).closest('tr').find('.inputable').val('')
            input.value = ""
            return
          }

          $(input).closest('tr').find('.input_1').val(data.brand_trade)
          $(input).closest('tr').find('.input_2').val(data.brand_name)
          $(input).closest('tr').find('.input_3').val(data.size)
        } else {
          Swal.fire({
            type: "error",
            title: data.message
          })
          $(input).closest('tr').find('.inputable').val('')
          input.value = ""

        }
      }
    })

  }
</script>