<style>
  th,
  td {
    vertical-align: middle !important;
  }
</style>

<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div id="accordion">
          <div class="card shadow rounded-0">
            <div class="card-header">
              <div class="row">
                <div class="col-md-6">
                  <h6 class="mt-2">Filter</h6>
                </div>
                <div class="col-md-6 text-right">
                  <button class="btn btn-sm btn-primary collapsed" data-toggle="collapse" data-target="#filter_coll" aria-expanded="false" aria-controls="filter_coll">
                    <i class="fas fa-angle-double-down"></i>
                  </button>
                </div>
              </div>
            </div>
            <div id="filter_coll" class="collapse <?= $this->input->get() ? 'show' : '' ?>" data-parent="#accordion">
              <div class="card-body bg-white overflow-auto">
                <form action="" method="GET">
                  <div class="row">

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label"> Category</label>
                        <div class="col-xl">
                          <select name="id_type" class="select2" style="width:100%" required>
                            <option value="">---</option>
                            <?php foreach ($master_attachment as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>" <?= $get['id_type'] == $value['id'] ? 'selected' : '' ?>><?= $value['categories_desc'] ?> (<?= $value['sub_section'] ?>)</option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label ">Deck Elevation / Service Line</label>
                        <div class="col-xl">
                          <select class="form-control" name="deck_elevation">
                            <option value="">---</option>
                            <?php foreach ($master_deck as $key => $value) : ?>
                              <option value="<?php echo $value['id'] ?>" <?= $get['deck_elevation'] == $value['id'] ? 'selected' : '' ?>><?php echo $value['name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 text-right">
                      <button class="mt-2 btn btn-sm btn-flat btn-info" name="submit" value="search"><i class="fas fa-search"></i> Search</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Additional Attachment List</h6>
          </div>
          <div class="card-body bg-white">
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable" id="table_client" width="100%">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th>Category</th>
                    <th>Deck Elevation / Service Line</th>
                    <th>File</th>
                    <th>Ecodoc No</th>
                    <th>Book / Volume</th>
                    <th>Upload By</th>
                    <th>Upload Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table>
            </div>
            <br>
            <div class="col-md-4">
              <div class="row mb-1">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
  function removeAttachment(id) {

    Swal.fire({
      title: 'Are you sure to Remove this Report?',
      text: "",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Remove!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "<?= base_url('additional_attachment/removeAttachment/') ?>",
          type: "post",
          data: {
            'id': id,
          },
          success: function(data) {
            Swal.fire(
              'Data Has Been Removed !',
              '',
              'success'
            ).then(function() {
              location.reload();
              return false;
            });
          }
        });
      }
    })
  }
  $(document).ready(function() {
    $("#table_client").DataTable({
      order: [],
      processing: true,
      serverSide: true,
      orderable: true,
      ajax: {
        url: "<?= site_url($serverside) ?>",
        type: "POST",
        data: {
          id_type: "<?= $get['id_type'] ?>",
          deck_elevation: "<?= $get['deck_elevation'] ?>",
        }
      }
    })
  })
</script>