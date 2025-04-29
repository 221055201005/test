<!-- <div class="row">
  <div class="col-md-2">
    <ul class="list-group sidebar-group">

      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i> 
        <a style="color: black" href="<?php echo base_url();?>additional_attachment/additional_attachment_list">
          <i class="fas fa-caret-right"></i>  &nbsp; Additional Attachment List
        </a>
      </li>

      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i> 
        <a style="color: black" href="<?php echo base_url();?>additional_attachment/upload_additional_attachment">
          <i class="fas fa-caret-right"></i>  &nbsp; Upload Additional Attachment
        </a>
      </li>

      
    </ul>
  </div>

</div> -->

<div class="wrapper" style="min-height: 79vh">
  <nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
    <ul class="list-unstyled components">

      <li>
        <a href="<?= site_url('additional_attachment/additional_attachment_list') ?>">
          <i class="fas fa-list"></i> &nbsp;&nbsp; Additional Attachment List
        </a>
      </li>

			<?php if ($this->permission_cookie[130] == 1) : ?>
      <li>
        <a href="<?= site_url('additional_attachment/upload_additional_attachment') ?>">
          <i class="fas fa-cloud-upload-alt"></i> &nbsp;&nbsp; Upload Additional Attachment
        </a>
      </li>
			<?php endif; ?>


    </ul>
  </nav>