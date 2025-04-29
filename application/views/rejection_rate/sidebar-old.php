<div class="wrapper" style="min-height: 79vh">
<nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
  <ul class="list-unstyled components"> 

    <li>
      <a href="#sidemenu_workpack_list" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
      <i class="fas fa-chart-line"></i>  &nbsp; KPI Weekly
      </a>
      <ul class="list-unstyled collapse show" id="sidemenu_workpack_list">
         
        <li>
          <a href="<?php echo base_url();?>rejection_rate/rate_weekly/<?= strtr($this->encryption->encrypt('cmltv'), '+=/', '.-~'); ?>">
                <i class="fas fa-chart-line"></i>  &nbsp; Weekly Comulative
          </a>
        </li>
         
        <li>
          <a href="<?php echo base_url();?>rejection_rate/rate_weekly/<?= strtr($this->encryption->encrypt('ts'), '+=/', '.-~'); ?>/<?= strtr($this->encryption->encrypt('1'), '+=/', '.-~'); ?>">
                <i class="fas fa-chart-line"></i> &nbsp; Weekly TS
          </a>
        </li>
        
        <li>
          <a href="<?php echo base_url();?>rejection_rate/rate_weekly/<?= strtr($this->encryption->encrypt('jkt'), '+=/', '.-~'); ?>/<?= strtr($this->encryption->encrypt('2'), '+=/', '.-~'); ?>">
                <i class="fas fa-chart-line"></i> &nbsp; Weekly JKT
          </a>
        </li>
      
        <li>
          <a href="<?php echo base_url();?>rejection_rate/rate_weekly/<?= strtr($this->encryption->encrypt('str'), '+=/', '.-~'); ?>/<?= strtr($this->encryption->encrypt("x"), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt("2"), '+=/', '.-~') ?>">
                <i class="fas fa-chart-line"></i>   &nbsp; Weekly STR
          </a>
        </li> 

        <li>
          <a href="<?php echo base_url();?>rejection_rate/rate_weekly/<?= strtr($this->encryption->encrypt('pip'), '+=/', '.-~'); ?>/<?= strtr($this->encryption->encrypt("x"), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt("1"), '+=/', '.-~') ?>">
                <i class="fas fa-chart-line"></i>  &nbsp; Weekly PIP
          </a>
        </li> 


      </ul>
    </li>

    <!-- <li>
      <a href="#sidemenu_workpack_list" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
      <i class="fas fa-chart-line"></i>  &nbsp; KPI Weekly By Process
      </a>
      <ul class="list-unstyled collapse show" id="sidemenu_workpack_list">
         
        <li>
          <a href="<?php echo base_url();?>rejection_rate/rate_index/<?= strtr($this->encryption->encrypt('cmltv'), '+=/', '.-~'); ?>">
                <i class="fas fa-chart-line"></i>  &nbsp; Master Comulative
          </a>
        </li>
         
        <li>
          <a href="<?php echo base_url();?>rejection_rate/rate_index/<?= strtr($this->encryption->encrypt('ts'), '+=/', '.-~'); ?>/<?= strtr($this->encryption->encrypt('1'), '+=/', '.-~'); ?>">
                <i class="fas fa-chart-line"></i> &nbsp; Master TS
          </a>
        </li>
        
        <li>
          <a href="<?php echo base_url();?>rejection_rate/rate_index/<?= strtr($this->encryption->encrypt('jkt'), '+=/', '.-~'); ?>/<?= strtr($this->encryption->encrypt('2'), '+=/', '.-~'); ?>">
                <i class="fas fa-chart-line"></i> &nbsp; Master JKT
          </a>
        </li>
      
        <li>
          <a href="<?php echo base_url();?>rejection_rate/rate_index/<?= strtr($this->encryption->encrypt('str'), '+=/', '.-~'); ?>/<?= strtr($this->encryption->encrypt("x"), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt("2"), '+=/', '.-~') ?>">
                <i class="fas fa-chart-line"></i>   &nbsp; Master STR
          </a>
        </li> 

        <li>
          <a href="<?php echo base_url();?>rejection_rate/rate_index/<?= strtr($this->encryption->encrypt('pip'), '+=/', '.-~'); ?>/<?= strtr($this->encryption->encrypt("x"), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt("1"), '+=/', '.-~') ?>">
                <i class="fas fa-chart-line"></i>  &nbsp; Master PIP
          </a>
        </li> 


      </ul>
    </li> -->

  </ul>
</nav>