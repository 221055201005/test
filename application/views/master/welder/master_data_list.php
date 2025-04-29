<?php

$main = $main[0];

?>

<style>
  th,
  td {
    vertical-align: middle !important;
  }
</style>
<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card rounded-0 shadow">
          <div class="card-header">
            <div class="row">
              <div class="col-6 mt-2">
                <h6 class="m-0"> Master Data - <strong><?= $main['name'] ?></strong></h6>
              </div>
              <div class="col-6 text-right">
                <button class="btn btn-primary" onclick="add_data(this)"><i class="fas fa-plus-circle"></i> Add New</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table class="table table-hover text-center" id="table_list">
                    <thead class="bg-green-smoe text-white">
                      <th>No</th>
                      <th>Category</th>
                      <th>Value</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php $no = 1;
                      foreach ($detail_list as $key => $value) : ?>
                        <?php

                        $id_enc = encrypt($value['id']);

                        ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= $main['name'] ?></td>
                          <td><?= $value['value'] ?></td>
                          <td>
                            <button type="button" onclick="update_data(this, '<?= $id_enc ?>')" class="btn btn-warning"><i class="fas fa-edit"></i> Update</button>
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
      </div>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<script>
  $("#table_list").DataTable({
    order: []
  })

  function add_data(btn) {

    $('#modal').modal({
      show: true,
      keyboard: false,
      backdrop: "static"
    })

    $('.modal-title').html(`Add New - <strong><?= $main['name'] ?></strong>`)
    $('.modal-dialog').addClass('modal-lg')
    $('.modal-body').html(spinner())

    $.ajax({
      url: "<?= site_url('master/welder/add_master_data') ?>",
      type: "POST",
      data: {
        id_main: "<?= $id_main_enc ?>"
      },
      success: (data) => {
        $('.modal-body').html(data)
      }
    })
  }


  function update_data(btn, id_enc) {

    $('#modal').modal({
      show: true,
      keyboard: false,
      backdrop: "static"
    })

    $('.modal-title').html(`Update - <strong><?= $main['name'] ?></strong>`)
    $('.modal-dialog').addClass('modal-lg')
    $('.modal-body').html(spinner())

    $.ajax({
      url: "<?= site_url('master/welder/update_master_data') ?>",
      type: "POST",
      data: {
        id_enc: id_enc
      },
      success: (data) => {
        $('.modal-body').html(data)
      }
    })
  }

  function spinner() {
    return `
  <div class="container text-center h-100">
    <div class="row align-items-center h-100">
      <div class="col-md-12">
        <div class="spinner-border text-success" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
    </div>
  </div>
  `
  }
</script>