<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>
    
    <div class="card-body bg-white">
      <div class="overflow-auto">
        <table class="table table-hover text-center dataTable">
          <thead class="bg-green-smoe text-white">
            <tr>
              <th>Project</th>
              <th>RFI No</th>
              <th>Process</th>
              <th>Drawing No</th>
              <th>Transmit Time</th>
              <th>Total Item</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($summary_mv_list as $key => $value): ?>
            <?php 

              $key_data               = explode("_", $key);

              $total_item_per_report_mv  = @count($total_detail_mv[$value['report_number']]);
              $encrypt_project_id     = strtr($this->encryption->encrypt($value['project_code']), '+=/', '.-~');
              $encrypt_discipline     = strtr($this->encryption->encrypt($value['discipline']), '+=/', '.-~');
              $encrypt_type_of_module = strtr($this->encryption->encrypt($value['type_of_module']), '+=/', '.-~');
              $encrypt_module         = strtr($this->encryption->encrypt($value['module']), '+=/', '.-~');
              $encrypt_report_number  = strtr($this->encryption->encrypt($value['report_number']), '+=/', '.-~');
              $encrypt_report_no_rev  = strtr($this->encryption->encrypt($value['report_no_rev']), '+=/', '.-~');

              $format_report_no       = $report_no_list['mv_no'][$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']]."-".$value['report_number'];

              if($key_data[1] == 13) {
                $format_report_no       = $report_no_list['mv_no_smop'][$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']]."-".$value['report_number'];
              }

            ?> 
            <tr>
              <td><?= $project[$value['project_code']]['project_name'] ?></td>
              <td><?= $format_report_no ?></td>
              <td> Material Verification </td>
              <td><?= $value['drawing_no'] ?></td>
              <td><?= $value['transmittal_datetime'] ?></td>
              <td><?= $total_mv[$key] ?></td>
              <td><a target="_blank" href='<?php echo base_url() ?>material_verification/detail_client_rfi/<?php echo $encrypt_project_id.'/'.$encrypt_discipline.'/'.$encrypt_type_of_module.'/'.$encrypt_module.'/'.$encrypt_report_number.'/'.$encrypt_report_no_rev ?>' class="btn btn-primary btn-sm"><i class="fas fa-list"></i> Detail</a></td>
            </tr>
          <?php endforeach; ?>

          <?php foreach ($summary_ft_list as $key => $value): ?>
            <?php 
              $key_data               = explode("_", $key);
              $total_item_per_report_ft  = @count($total_detail_ft[$key]);

              $format_report_no       = $report_no_list['fitup_report'][$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']]."-".$value['report_number'];

              if($key_data[1] == 13) {
                $format_report_no     = $report_no_list['fitup_report_smop'][$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']]."-".$value['report_number'];
              }

            ?> 
            <tr>
              <td><?= $project[$value['project_code']]['project_name'] ?></td>
              <td><?= $format_report_no ?></td>
              <td> Fitup </td>
              <td><?= $value['drawing_no'] ?></td>
              <td><?= $value['transmitted_date'] ?></td>
              <td><?= $total_ft[$key] ?></td>
              <td><a target="_blank" href='<?php echo  base_url(); ?>fitup/client_inspection/<?php echo strtr($this->encryption->encrypt($value['project_code']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['discipline']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['module']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['type_of_module']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['report_number']),'+=/', '.-~'); ?>'><button class='btn btn-primary btn-sm'><i class="fas fa-list"></i> Detail</button></a></td>
            </tr>
          <?php endforeach; ?>

          <?php foreach ($summary_vs_list as $key => $value): ?>
            <?php
              $key_data               = explode("_", $key);
              $total_item_per_report_vs  = @count($total_detail_vs[$key]);

              $format_report_no       = $report_no_list['visual_rfi'][$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']]."-".$value['report_number'];

              if($key_data[1] == 13) {
                $format_report_no     = $report_no_list['visual_rfi_smop'][$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']]."-".$value['report_number'];
              }

            ?> 
            <tr>
              <td><?= $project[$value['project_code']]['project_name'] ?></td>
              <td><?= $format_report_no ?></td>
              <td> Visual </td>
              <td><?= $value['drawing_no'] ?></td>
              <td><?= $value['transmittal_datetime'] ?></td>
              <td><?= $total_vs[$key] ?></td>
              <td><a target="_blank" href="<?php echo base_url(); ?>visual/detail_inspection/<?php echo $value['report_number'] ?>/client/<?php echo $value['drawing_no']?>" class="btn btn-primary btn-sm"><i class="fas fa-list"></i> Detail</a></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
</div>
<script>
  $('.dataTable').DataTable({});
</script>