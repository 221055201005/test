<!-- <div class="row">
  <div class="col-md-2">
    <ul class="list-group sidebar-group">
      <li class="list-group-item" style="background-color: #e3e3e3;"><b>Area & Location</b> <i class="fas fa-caret-down"></i></li>

      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
        <a style="color: black" href="<?php echo base_url(); ?>master/area">
          <i class="fas fa-caret-right"></i> &nbsp; Area
        </a>
      </li>
      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
        <a style="color: black" href="<?php echo base_url(); ?>master/location">
          <i class="fas fa-caret-right"></i> &nbsp; Location
        </a>
      </li>
      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
        <a style="color: black" href="<?php echo base_url(); ?>master/point/point_list">
          <i class="fas fa-caret-right"></i> &nbsp; Point
        </a>
      </li>

      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
        <a style="color: black" href="<?php echo base_url(); ?>master/alocation/alocation_list">
          <i class="fas fa-caret-right"></i> &nbsp; Alocation
        </a>
      </li>

      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
        <a style="color: black" href="<?php echo base_url(); ?>master/area/export_download">
          <i class="fas fa-caret-right"></i> &nbsp; Export & Download
        </a>
      </li>


    </ul>
  </div>
  <?php if ($this->permission_cookie[0] == 1) : ?>
    <div class="col-md-2">
      <ul class="list-group sidebar-group">
        <li class="list-group-item" style="background-color: #e3e3e3;"><b> Other</b> <i class="fas fa-caret-down"></i></li>

        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url(); ?>master/class_data">
            <i class="fas fa-caret-right"></i> &nbsp; Class
          </a>
        </li>

        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url(); ?>master/deck_elevation">
            <i class="fas fa-caret-right"></i> &nbsp; Deck Elevation / Service Line
          </a>
        </li>
        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url(); ?>master/discipline/discipline_list">
            <i class="fas fa-caret-right"></i> &nbsp; Discipline
          </a>
        </li>
        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url(); ?>master/desc_assy/desc_assy_list">
            <i class="fas fa-caret-right"></i> &nbsp; Description Assembly
          </a>
        </li>
        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url(); ?>master/joint_type/joint_type_list">
            <i class="fas fa-caret-right"></i> &nbsp; Joint Type
          </a>
        </li>
        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url(); ?>master/module/module_list">
            <i class="fas fa-caret-right"></i> &nbsp; Module
          </a>
        </li>
        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url(); ?>master/type_of_module/type_of_module_list">
            <i class="fas fa-caret-right"></i> &nbsp; Type of Module
          </a>
        </li>
        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url(); ?>master/weld_type/weld_type_list">
            <i class="fas fa-caret-right"></i> &nbsp; Weld Type
          </a>
        </li>
        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url(); ?>master/welder_process">
            <i class="fas fa-caret-right"></i> &nbsp; Welder Process
          </a>
        </li>
      </ul>
    </div>
  <?php endif; ?>
  
</div> -->

<div class="wrapper" style="min-height: 79vh">
  <nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
    <ul class="list-unstyled components">
      <?php if ($this->permission_cookie[166]) : ?>
        <li>
          <a href="#sidemenu_map" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="fas fa-map"></i> &nbsp; Area & Location
          </a>
          <ul class="list-unstyled collapse show" id="sidemenu_map">
            <li>
              <a href="<?php echo base_url(); ?>master/area">
                <i class="fas fa-database"></i> &nbsp; Area
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>master/location">
                <i class="fas fa-database"></i> &nbsp; Location
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>master/point/point_list">
                <i class="fas fa-database"></i> &nbsp; Point
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>master/alocation/alocation_list">
                <i class="fas fa-database"></i> &nbsp; Alocation
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>master/area/export_download">
            <i class="fas fa-database"></i> &nbsp; Export & Download
          </a>
        </li>
        </li>
      <?php endif; ?>

      <?php if ($this->permission_cookie[0] == 1) : ?>
        <li>
          <a href="#sidemenu_other" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="fas fa-list-alt"></i> &nbsp; Other
          </a>
          <ul class="list-unstyled collapse show" id="sidemenu_other">
            <li>
              <a href="<?php echo base_url(); ?>master/class_data">
                <i class="fas fa-database"></i> &nbsp; Class
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>master/deck_elevation">
                <i class="fas fa-database"></i> &nbsp; Deck Elevation / Service Line
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>master/discipline/discipline_list">
                <i class="fas fa-database"></i> &nbsp; Discipline
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>master/desc_assy/desc_assy_list">
                <i class="fas fa-database"></i> &nbsp; Description Assembly
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>master/joint_type/joint_type_list">
                <i class="fas fa-database"></i> &nbsp; Joint Type
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>master/module/module_list">
                <i class="fas fa-database"></i> &nbsp; Module
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>master/phase/phase_list">
                <i class="fas fa-database"></i> &nbsp; Phase
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>master/type_of_module/type_of_module_list">
                <i class="fas fa-database"></i> &nbsp; Type of Module
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>master/weld_type/weld_type_list">
                <i class="fas fa-database"></i> &nbsp; Weld Type
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>master/welder_process">
                <i class="fas fa-database"></i> &nbsp; Welder Process
              </a>
            </li>
          </ul>
        </li>
      <?php endif; ?>

    </ul>
  </nav>