<div id="content" class="container-fluid">

  <style type="text/css">
    .disabled-effect {
      pointer-events: none;
      opacity:0.5;
    }
  </style>
  <?php //test_var($this->permission_cookie); ?>
  <?php error_reporting(0) ?>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="GET">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status Approval</label>
                  <div class="col-xl">
                    <select class="form-control" name="status_approval">
                      <option value="999">---</option>
                      <option value="0">Deleted</option>
                      <option value="1">Pending Approval</option>
                      <option value="2">Rejected</option>
                      <option value="3">Accepted</option>
                    </select>
                  </div>
                </div>  
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">NDT Method</label>
                  <div class="col-xl">
                    <select class="form-control" name="ndt_method">
                      <option value="">---</option>
                      <?php foreach ($master_ndt as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['ndt_method'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['ndt_initial'] ?></option>
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
  
  <?php //if(isset($get['submit'])): ?>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">

          <div class="overflow-auto">
            <table class="table table-hover text-center dataTable" width="100%">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th style="min-width: 200px !important" class="text-nowrap">RFI No.</th>
                  <th class="text-nowrap">Request By</th>
                  <th class="text-nowrap">Request Date</th>
                  <th class="text-nowrap">Request Reason</th>
                  <th class="text-nowrap">Status Approval</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($list as $key => $value): ?>
                <?php //test_var($value); ?>
                <tr>
                  <td><b><?= $value['itr_rfi_no'] ?></b></td>
                  <td><?= $user_list[$value['request_by']]['full_name'] ?></td>
                  <td><?= $value['request_date'] ?></td>
                  <td><?= $value['request_reason'] ?></td>
                  <td>
                    <?php 
                    if($value['status_approval']==0){
                      echo '<span class="badge badge-secondary">Deleted</span>';
                    } elseif($value['status_approval']==1){
                      echo '<span class="badge badge-warning">Pending Approval</span>';
                    } elseif($value['status_approval']==2){
                      echo '<span class="badge badge-danger">Rejected</span>';
                    } elseif($value['status_approval']==3){
                      echo '<span class="badge badge-success">Accepted</span>';
                    }

                    if($value['status_approval']>1){
                      echo "<br>";
                      echo "<small style='font-size: 7pt !important'><b><i>By ".$user_list[$value['approval_by']]['full_name']."</i></b></small>";
                      echo "<br>";
                      echo "<small style='font-size: 7pt !important'><b><i>On ".$value['approval_date']."</i></b></small>";
                    }
                    ?>
                  </td>
                  <td>
                    <?php if($this->permission_cookie[127]==1){ ?>
                      <?php if($value['status_approval']==1){ ?>
                      <div class="btn-group">
                        <span class="btn btn-lg btn-success" onclick="approvalDialog('<?= $value['id'] ?>',3)">
                          <i class="fas fa-check"></i>
                        </span>
                        <span class="btn btn-lg btn-danger" onclick="approvalDialog('<?= $value['id'] ?>',2)">
                          <i class="fas fa-times"></i>
                        </span>
                      </div>
                      <?php } else {
                        echo "-";
                      } ?>
                    <?php } ?>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <br>
        </div>
      </div>
    </div>
  </div>
  <?php //endif; ?>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
  function approvalDialog(id, status_approval){
    console.log('ini id void '+id+' Ok')

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-lg btn-success',
        cancelButton: 'btn btn-lg btn-danger'
      },
      buttonsStyling: false
    })

    if(status_approval==2){
      var btn_yes = 'Yes, Reject the Request!'
    } else if(status_approval==3){
      var btn_yes = 'Yes, Accept the Request!'
    }
    

    swalWithBootstrapButtons.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: btn_yes,
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((result) => {
      if (result.value==true) {
        $.ajax({
          url: "<?= base_url('itr/void_approval_v2/') ?>",
          type: "post",
          data: {
            'id': id,
            'status_approval': status_approval,
          }
        });
        swalWithBootstrapButtons.fire(
          'Proceed!',
          '',
          'success'
        )
        location.reload()
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancelled',
          '',
          'error'
        )
      }
    })
  }

  $(document).ready(
    function() {
      $('.dataTable').DataTable({
          order: [],
        })
    }
  )

</script>