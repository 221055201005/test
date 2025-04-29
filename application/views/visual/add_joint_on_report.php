<form action="<?= site_url('visual/add_joint_on_report_process') ?>" method="post">
  <input type="hidden" name="report_number" value="<?= $report_number ?>">
  <input type="hidden" name="id_visual_ex" value="<?= $id_visual_ex ?>">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="">Request By</label>
        <input type="text" class="form-control" value="<?= $user_cookie[1] ?>" disabled>
      </div>
    </div>
    <div class="col-md-12">
    	<table class="table">
    		<thead>
    			<tr>
    				<th>Joint No.</th>
    				<th>Weld map</th>
    			</tr>
    		</thead>
    		<tbody>
  			<?php foreach ($joint_list as $key => $value) { ?>
  				<tr>
  					<td>
  						<input type="checkbox" name="id_visual[]" value="<?= $value["id_visual"] ?>">
  						<?= $value["joint_no"] ?>
  					</td>
  					<td><?= $value["drawing_wm"] ?></td>
  				</tr>
  			<?php } ?>
    		</tbody>
    	</table>
    </div>
    <div class="col-md-12">
      <hr>
      <div class="float-right">
        <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i> Update</button>
      </div>
    </div>
  </div>
</form>
<script>
  $(document).ready(function(){ 
    $('form').on('submit', function() {
      $('button[type=submit]').attr('disabled', true)
    }) 
   })
</script>