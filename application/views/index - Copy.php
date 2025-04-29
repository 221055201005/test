<?php $this->load->view('_partial/header'); ?>
<?php $this->load->view('_partial/top'); ?>

<?php if (isset($sidebar) && $sidebar != "") : ?>
  <div id="accordion">
    <div style="position: fixed; bottom: 0; left: 0; z-index: 999; " class="w-100 content-sidebar">
      <button type="button" class="btn btn-flat toggle-sidebar" style="position: relative; background-color: #dddddd; font-size: 20px !important;" data-toggle="collapse" data-target="#sidebar_col" aria-expanded="false" aria-controls="sidebar_col">
        <i class="fas fa-angle-double-down  fa-lg btn-sidebar"></i><i class="fas fa-angle-double-up  fa-lg btn-sidebar"></i>
      </button>
      <div id="sidebar_col" class="sidebar-foot collapse " aria-labelledby="headingOne" data-parent="#accordion" style="background-color: #dddddd;">
        <div class="p-3">
          <?php $this->load->view($sidebar); ?>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php $this->load->view($subview); ?>
<?php $this->load->view('_partial/footer'); ?>