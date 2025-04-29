<style>
[data-tooltip] {
  position: relative;
  z-index: 2;
  cursor: pointer;
}

/* Hide the tooltip content by default */
[data-tooltip]:before,
[data-tooltip]:after {
  visibility: hidden;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  pointer-events: none;
}

/* Position tooltip above the element */
[data-tooltip]:before {
  position: absolute;
  bottom: 150%;
  left: 50%;
  margin-bottom: 5px;
  margin-left: -80px;
  padding: 7px;
  width: 160px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  background-color: #000;
  background-color: hsla(0, 0%, 20%, 0.9);
  color: #fff;
  content: attr(data-tooltip);
  text-align: center;
  font-size: 14px;
  line-height: 1.2;
}

/* Triangle hack to make tooltip look like a speech bubble */
[data-tooltip]:after {
  position: absolute;
  bottom: 150%;
  left: 50%;
  margin-left: -5px;
  width: 0;
  border-top: 5px solid #000;
  border-top: 5px solid hsla(0, 0%, 20%, 0.9);
  border-right: 5px solid transparent;
  border-left: 5px solid transparent;
  content: " ";
  font-size: 0;
  line-height: 0;
}

/* Show tooltip content on hover */
[data-tooltip]:hover:before,
[data-tooltip]:hover:after {
  visibility: visible;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
  filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}
</style>
<div id="content" class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">

            <a href="<?php echo  base_url(); ?>we_dept/visual_new" class="btn btn-primary"><i class="fas fa-plus-circle"></i> New</a>
            <a href="<?php echo  base_url(); ?>we_dept/visual_import" class="btn btn-warning"><i class="fas fa-upload"></i> Upload Data</a>

            <table class="table table-hover text-center dataTable"  width="100%">
              <thead class="bg-green-smoe text-white">
                <tr>                                                 
                  <th>Report no</th>
                  <th>Drawing No</th>
                  <th width="200px;">Description</th>
                  <th>Module</th>
                  <th>Requestor</th>
                  <th>Request Date</th>                    
                  <th>Last Update By/Date</th>  
                  <th>Status</th>
                  <th width="150px;">Action</th>
                </tr>
              </thead> 
              <tbody>
                <?php foreach ($data_list as $key => $value) { ?>
                  <tr>                                                 
                    <td><?php echo $value['report_no']; ?></td>
                    <td><?php echo $value['drawing_no']; ?></td>
                    <td><?php echo $value['description']; ?></td>
                    <td><?php echo $value['module']; ?></td>
                    <td><?php echo $value['request_by']; ?></td>
                    <td><?php echo $value['request_date']; ?></td>                   
                    <td width="150px;">-</td>
                    <td width="150px;">-</td>
                    <td width="150px;">
                      <a href="<?php echo base_url(); ?>we_dept/visual_detail/<?php echo strtr($this->encryption->encrypt("details"),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['report_no']),'+=/', '.-~'); ?>" class='btn btn-secondary'><i class="fas fa-list-alt"></i></a>
                      
                      <a href="<?php echo base_url(); ?>we_dept/visual_detail/<?php echo strtr($this->encryption->encrypt("update"),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['report_no']),'+=/', '.-~'); ?>" class='btn btn-warning'><i class="fas fa-edit"></i></a>

                      <a href="<?php echo base_url(); ?>we_dept/visual_detail/<?php echo strtr($this->encryption->encrypt("pdf"),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['report_no']),'+=/', '.-~'); ?>" class='btn btn-danger'><i class="fas fa-file-pdf"></i></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>             
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
  $('.dataTable').DataTable({
    "lengthChange": false,
    "order": []
  });
</script>
