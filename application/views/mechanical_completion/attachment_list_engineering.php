<?php
  $tab_list = [
    0 => [
      'link' =>'load_attachment_eng_shopdrawing',
      'name' =>'Shop Drawing',
    ],
    1 => [
      'link' =>'load_attachment_eng_mdr',
      'name' =>'MDR',
    ],
  ];

  if(!in_array($tab, array_column($tab_list, 'link'))){
    redirect('mechanical_completion/attachment_list_engineering/load_attachment_eng_shopdrawing');
  }
?>

<style>
  th, td {
    vertical-align: middle !important;
  }
  
  .nav-link {
    color: #000;
  }

  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link {
    color: #007bff;
    background: #fff;
    border-bottom: 2px solid #007bff;
    border-radius: 0px;
  }
</style>

<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0"><?= $meta_title ?></h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <ul class="nav nav-pills border-bottom border-gray" id="myTab" role="tablist">
                  <?php foreach ($tab_list as $key => $value): ?>
                  <li class="nav-item">
                    <a class="nav-link <?= $tab == $value['link'] ? 'active' : '' ?>" id="receiving-tab" href="<?= site_url('mechanical_completion/attachment_list_engineering/' . $value['link']) ?>" role="tab" aria-controls="receiving" aria-selected="true"><?= $value['name'] ?></a>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>

            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <div id="content_list" class="overflow-auto">
                  <?php $this->load->view('mechanical_completion/engineering/'.$tab);?>
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
<script>
</script>