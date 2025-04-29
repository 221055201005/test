<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $meta_title ?></title>
    <style>
      body{
        /* background-color: whitesmoke; */
        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
      }
      .card{
        background-color: #fff;
        padding: 1.25rem;
        box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
        border-radius: 0.25rem;
        border: 1px solid #999;
      }
      .text-center{
        text-align: center;
      }
      .title-report{
        font-size: 1rem;
        margin: 0;
      }
      .title-card{
        font-size: 0.9rem;
        margin: 0;
        color: #6c6c6c;
        height: 25px;
      }
      table{
        border-spacing: 0px;
        width: 100%;
      }
      th, td{
        padding-left: 15px;
        padding-right: 15px;
        padding-bottom: 15px;
      }
      .total-data{
        font-weight: 600;
        font-size: 2em;
        line-height: 64px;
        color: #323c43;
        margin: 0;
      }
      .link-detail{
        color: #6c757d!important;
        font-size: 12px;
        font-weight: bolder;
        text-decoration: none;
      }

      .wrap{
        background: #ffffff;
        box-shadow: 2px 10px 20px rgba(0, 0, 0, 0.1);
        border-radius: 7px;
        text-align: center;
        position: relative;
        overflow: hidden;
        padding: 20px 15px 10px;
        /* height: 150px; */
      }

      .wrap:after {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 150%;
        height: 10px;
        content: "";
      }

      .wrap.checklist:after {
        background: #98edc2;
      }

      .wrap.open:after {
        background: #e3e3e3;
      }

      .wrap.inprogress:after {
        background: #fff2cc;
      }

      .wrap.completed_pmt:after {
        background: #e5f7c3;
      }

      .wrap.pending_qc:after {
        background: #1a4da2;
      }

      .wrap.rejected_qc:after {
        background: #c94747;
      }

      .wrap.approved_qc:after {
        background: #1a4da2;
      }

      .wrap.client_invitation:after {
        background: #0084f4;
      }

      .wrap.punch_client:after {
        background: #6166f2;
      }

      .wrap.approved_client:after {
        background: #84d194;
      }

      .wrap.completed:after {
        background: #00c48c;
      }
      .page_break { 
        page-break-before: always;
      }
    </style>
  </head>
  <body>
    <br>
    <br>
    <br>
    <center>
      <img src="img/logo_top_sofia.png" style="width: 200px;">
      <img src="img/sembcorp-logo.png" style="width: 132px;">
    </center>
    <br>
    <br>
    <br>
    <table border="0">
      <tr>
        <td>
          <div class="card text-center">
            <h6 class="title-report"><strong><?= $meta_title ?> - Overall</strong></h6>
          </div>
        </td>
      </tr>
    </table>
    
    <table border="0">
      <tr>
        <td width="25%">
          <?php
            $link_detail_encrypt = site_url('mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("all"), '+=/', '.-~'));
            $link_detail_encrypt = getenv('LINK_PCMS_PORTAL')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_detail_encrypt), '+=/', '.-~');
            $link_out_detail_encrypt = getenv('LINK_PCMSV2_OUTSIDE').'/mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("all"), '+=/', '.-~');
            $link_out_detail_encrypt = getenv('LINK_PCMS_PORTAL_OUTSIDE')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_out_detail_encrypt), '+=/', '.-~');
          ?>
          <div class="card text-center wrap checklist">
            <h6 class="title-card"><strong>CHECKLIST</strong></h6>
            <h1 class="total-data"><?= $total_data['total_all'] ?></h1>
            <a href="<?= $link_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (Internal)</a>
            <br>
            <a href="<?= $link_out_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (External)</a>
          </div>
        </td>
        <td width="25%">
          <?php
            $link_detail_encrypt = site_url('mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("0"), '+=/', '.-~'));
            $link_detail_encrypt = getenv('LINK_PCMS_PORTAL')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_detail_encrypt), '+=/', '.-~');
            $link_out_detail_encrypt = getenv('LINK_PCMSV2_OUTSIDE').'/mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("0"), '+=/', '.-~');
            $link_out_detail_encrypt = getenv('LINK_PCMS_PORTAL_OUTSIDE')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_out_detail_encrypt), '+=/', '.-~');
          ?>
          <div class="card text-center wrap open">
            <h6 class="title-card"><strong>OPEN</strong></h6>
            <h1 class="total-data"><?= $total_data['total_draft'] ?></h1>
            <a href="<?= $link_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (Internal)</a>
            <br>
            <a href="<?= $link_out_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (External)</a>
          </div>
        </td>
        <td width="25%">
          <?php
            $link_detail_encrypt = site_url('mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("1"), '+=/', '.-~'));
            $link_detail_encrypt = getenv('LINK_PCMS_PORTAL')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_detail_encrypt), '+=/', '.-~');
            $link_out_detail_encrypt = getenv('LINK_PCMSV2_OUTSIDE').'/mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("1"), '+=/', '.-~');
            $link_out_detail_encrypt = getenv('LINK_PCMS_PORTAL_OUTSIDE')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_out_detail_encrypt), '+=/', '.-~');
          ?>
          <div class="card text-center wrap inprogress">
            <h6 class="title-card"><strong>DRAFTING DOCUMENT</strong></h6>
            <h1 class="total-data"><?= $total_data['total_inprogress'] ?></h1>
            <a href="<?= $link_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (Internal)</a>
            <br>
            <a href="<?= $link_out_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (External)</a>
          </div>
        </td>
        <td width="25%">
          <?php
            $link_detail_encrypt = site_url('mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("2|3"), '+=/', '.-~'));
            $link_detail_encrypt = getenv('LINK_PCMS_PORTAL')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_detail_encrypt), '+=/', '.-~');
            $link_out_detail_encrypt = getenv('LINK_PCMSV2_OUTSIDE').'/mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("2|3"), '+=/', '.-~');
            $link_out_detail_encrypt = getenv('LINK_PCMS_PORTAL_OUTSIDE')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_out_detail_encrypt), '+=/', '.-~');
          ?>
          <div class="card text-center wrap pending_qc">
            <h6 class="title-card"><strong>COMPLETED PMT & PENDING QC</strong></h6>
            <h1 class="total-data"><?= $total_data['total_completed_pmt'] + $total_data['total_pending_qc'] ?></h1>
            <a href="<?= $link_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (Internal)</a>
            <br>
            <a href="<?= $link_out_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (External)</a>
          </div>
        </td>
      </tr>
      <tr>
        <td width="25%">
          <?php
            $link_detail_encrypt = site_url('mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("7"), '+=/', '.-~'));
            $link_detail_encrypt = getenv('LINK_PCMS_PORTAL')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_detail_encrypt), '+=/', '.-~');
            $link_out_detail_encrypt = getenv('LINK_PCMSV2_OUTSIDE').'/mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("7"), '+=/', '.-~');
            $link_out_detail_encrypt = getenv('LINK_PCMS_PORTAL_OUTSIDE')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_out_detail_encrypt), '+=/', '.-~');
          ?>
          <div class="card text-center wrap rejected_qc">
            <h6 class="title-card"><strong>REJECTED QC</strong></h6>
            <h1 class="total-data"><?= $total_data['total_rejected_qc'] ?></h1>
            <a href="<?= $link_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (Internal)</a>
            <br>
            <a href="<?= $link_out_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (External)</a>
          </div>
        </td>
        <td width="25%">
          <?php
            $link_detail_encrypt = site_url('mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("6"), '+=/', '.-~'));
            $link_detail_encrypt = getenv('LINK_PCMS_PORTAL')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_detail_encrypt), '+=/', '.-~');
            $link_out_detail_encrypt = getenv('LINK_PCMSV2_OUTSIDE').'/mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("6"), '+=/', '.-~');
            $link_out_detail_encrypt = getenv('LINK_PCMS_PORTAL_OUTSIDE')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_out_detail_encrypt), '+=/', '.-~');
          ?>
          <div class="card text-center wrap approved_qc">
            <h6 class="title-card"><strong>APPROVED QC</strong></h6>
            <h1 class="total-data"><?= $total_data['total_approved_qc'] ?></h1>
            <a href="<?= $link_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (Internal)</a>
            <br>
            <a href="<?= $link_out_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (External)</a>
          </div>
        </td>
        <td width="25%">
          <?php
            $link_detail_encrypt = site_url('mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("4|10"), '+=/', '.-~'));
            $link_detail_encrypt = getenv('LINK_PCMS_PORTAL')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_detail_encrypt), '+=/', '.-~');
            $link_out_detail_encrypt = getenv('LINK_PCMSV2_OUTSIDE').'/mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("4|10"), '+=/', '.-~');
            $link_out_detail_encrypt = getenv('LINK_PCMS_PORTAL_OUTSIDE')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_out_detail_encrypt), '+=/', '.-~');
          ?>
          <div class="card text-center wrap client_invitation">
            <h6 class="title-card"><strong>CLIENT INVITATION</strong></h6>
            <h1 class="total-data"><?= $total_data['total_invite_client'] + $total_data['total_review_document_client'] ?></h1>
            <a href="<?= $link_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (Internal)</a>
            <br>
            <a href="<?= $link_out_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (External)</a>
          </div>
        </td>
        <td width="25%">
          <?php
            $link_detail_encrypt = site_url('mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("9"), '+=/', '.-~'));
            $link_detail_encrypt = getenv('LINK_PCMS_PORTAL')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_detail_encrypt), '+=/', '.-~');
            $link_out_detail_encrypt = getenv('LINK_PCMSV2_OUTSIDE').'/mechanical_completion/detail_status_mc/?status=' . strtr($this->encryption->encrypt("9"), '+=/', '.-~');
            $link_out_detail_encrypt = getenv('LINK_PCMS_PORTAL_OUTSIDE')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_out_detail_encrypt), '+=/', '.-~');
          ?>
          <div class="card text-center wrap approved_client">
            <h6 class="title-card"><strong>APPROVED BY CLIENT & COMPLETED</strong></h6>
            <h1 class="total-data"><?= $total_data['total_approved_client'] ?></h1>
            <a href="<?= $link_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (Internal)</a>
            <br>
            <a href="<?= $link_out_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (External)</a>
          </div>
        </td>
      </tr>
    </table>
    
    <?php foreach ($total_data_discipline as $key => $value): ?>
      <div class="page_break"></div>
      <br>
      <br>
      <br>
      <center>
        <img src="img/logo_top_sofia.png" style="width: 200px;">
        <img src="img/sembcorp-logo.png" style="width: 132px;">
      </center>
      <br>
      <br>
      <br>
      <table border="0">
        <tr>
          <td>
            <div class="card text-center">
              <h6 class="title-report"><strong><?= $meta_title." - ".$discipline_list[$key]['discipline_name']." (".$discipline_list[$key]['mc_code'].")" ?></strong></h6>
            </div>
          </td>
        </tr>
      </table>
      
      <table border="0">
        <tr>
          <td width="25%">
            <?php
              $link_detail_encrypt = site_url('mechanical_completion/detail_status_mc/?discipline='.$value['discipline'].'&status=' . strtr($this->encryption->encrypt("all"), '+=/', '.-~'));
              $link_detail_encrypt = getenv('LINK_PCMS_PORTAL')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_detail_encrypt), '+=/', '.-~');
              $link_out_detail_encrypt = getenv('LINK_PCMSV2_OUTSIDE').'/mechanical_completion/detail_status_mc/?discipline='.$value['discipline'].'&status=' . strtr($this->encryption->encrypt("all"), '+=/', '.-~');
              $link_out_detail_encrypt = getenv('LINK_PCMS_PORTAL_OUTSIDE')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_out_detail_encrypt), '+=/', '.-~');
            ?>
            <div class="card text-center wrap checklist">
              <h6 class="title-card"><strong>CHECKLIST</strong></h6>
              <h1 class="total-data"><?= $value['total_all'] ?></h1>
              <a href="<?= $link_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (Internal)</a>
              <br>
              <a href="<?= $link_out_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (External)</a>
            </div>
          </td>
          <td width="25%">
            <?php
              $link_detail_encrypt = site_url('mechanical_completion/detail_status_mc/?discipline='.$value['discipline'].'&status=' . strtr($this->encryption->encrypt("0"), '+=/', '.-~'));
              $link_detail_encrypt = getenv('LINK_PCMS_PORTAL')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_detail_encrypt), '+=/', '.-~');
              $link_out_detail_encrypt = getenv('LINK_PCMSV2_OUTSIDE').'/mechanical_completion/detail_status_mc/?discipline='.$value['discipline'].'&status=' . strtr($this->encryption->encrypt("0"), '+=/', '.-~');
              $link_out_detail_encrypt = getenv('LINK_PCMS_PORTAL_OUTSIDE')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_out_detail_encrypt), '+=/', '.-~');
            ?>
            <div class="card text-center wrap open">
              <h6 class="title-card"><strong>OPEN</strong></h6>
              <h1 class="total-data"><?= $value['total_draft'] ?></h1>
              <a href="<?= $link_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (Internal)</a>
              <br>
              <a href="<?= $link_out_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (External)</a>
            </div>
          </td>
          <td width="25%">
            <?php
              $link_detail_encrypt = site_url('mechanical_completion/detail_status_mc/?discipline='.$value['discipline'].'&status=' . strtr($this->encryption->encrypt("1"), '+=/', '.-~'));
              $link_detail_encrypt = getenv('LINK_PCMS_PORTAL')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_detail_encrypt), '+=/', '.-~');
              $link_out_detail_encrypt = getenv('LINK_PCMSV2_OUTSIDE').'/mechanical_completion/detail_status_mc/?discipline='.$value['discipline'].'&status=' . strtr($this->encryption->encrypt("1"), '+=/', '.-~');
              $link_out_detail_encrypt = getenv('LINK_PCMS_PORTAL_OUTSIDE')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_out_detail_encrypt), '+=/', '.-~');
            ?>
            <div class="card text-center wrap inprogress">
              <h6 class="title-card"><strong>DRAFTING DOCUMENT</strong></h6>
              <h1 class="total-data"><?= $value['total_inprogress'] ?></h1>
              <a href="<?= $link_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (Internal)</a>
              <br>
              <a href="<?= $link_out_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (External)</a>
            </div>
          </td>
          <td width="25%">
            <?php
              $link_detail_encrypt = site_url('mechanical_completion/detail_status_mc/?discipline='.$value['discipline'].'&status=' . strtr($this->encryption->encrypt("2|3"), '+=/', '.-~'));
              $link_detail_encrypt = getenv('LINK_PCMS_PORTAL')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_detail_encrypt), '+=/', '.-~');
              $link_out_detail_encrypt = getenv('LINK_PCMSV2_OUTSIDE').'/mechanical_completion/detail_status_mc/?discipline='.$value['discipline'].'&status=' . strtr($this->encryption->encrypt("2|3"), '+=/', '.-~');
              $link_out_detail_encrypt = getenv('LINK_PCMS_PORTAL_OUTSIDE')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_out_detail_encrypt), '+=/', '.-~');
            ?>
            <div class="card text-center wrap pending_qc">
              <h6 class="title-card"><strong>COMPLETED PMT & PENDING QC</strong></h6>
              <h1 class="total-data"><?= $value['total_completed_pmt'] + $value['total_pending_qc'] ?></h1>
              <a href="<?= $link_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (Internal)</a>
              <br>
              <a href="<?= $link_out_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (External)</a>
            </div>
          </td>
        </tr>
        <tr>
          <td width="25%">
            <?php
              $link_detail_encrypt = site_url('mechanical_completion/detail_status_mc/?discipline='.$value['discipline'].'&status=' . strtr($this->encryption->encrypt("7"), '+=/', '.-~'));
              $link_detail_encrypt = getenv('LINK_PCMS_PORTAL')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_detail_encrypt), '+=/', '.-~');
              $link_out_detail_encrypt = getenv('LINK_PCMSV2_OUTSIDE').'/mechanical_completion/detail_status_mc/?discipline='.$value['discipline'].'&status=' . strtr($this->encryption->encrypt("7"), '+=/', '.-~');
              $link_out_detail_encrypt = getenv('LINK_PCMS_PORTAL_OUTSIDE')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_out_detail_encrypt), '+=/', '.-~');
            ?>
            <div class="card text-center wrap rejected_qc">
              <h6 class="title-card"><strong>REJECTED QC</strong></h6>
              <h1 class="total-data"><?= $value['total_rejected_qc'] ?></h1>
              <a href="<?= $link_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (Internal)</a>
              <br>
              <a href="<?= $link_out_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (External)</a>
            </div>
          </td>
          <td width="25%">
            <?php
              $link_detail_encrypt = site_url('mechanical_completion/detail_status_mc/?discipline='.$value['discipline'].'&status=' . strtr($this->encryption->encrypt("6"), '+=/', '.-~'));
              $link_detail_encrypt = getenv('LINK_PCMS_PORTAL')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_detail_encrypt), '+=/', '.-~');
              $link_out_detail_encrypt = getenv('LINK_PCMSV2_OUTSIDE').'/mechanical_completion/detail_status_mc/?discipline='.$value['discipline'].'&status=' . strtr($this->encryption->encrypt("6"), '+=/', '.-~');
              $link_out_detail_encrypt = getenv('LINK_PCMS_PORTAL_OUTSIDE')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_out_detail_encrypt), '+=/', '.-~');
            ?>
            <div class="card text-center wrap approved_qc">
              <h6 class="title-card"><strong>APPROVED QC</strong></h6>
              <h1 class="total-data"><?= $value['total_approved_qc'] ?></h1>
              <a href="<?= $link_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (Internal)</a>
              <br>
              <a href="<?= $link_out_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (External)</a>
            </div>
          </td>
          <td width="25%">
            <?php
              $link_detail_encrypt = site_url('mechanical_completion/detail_status_mc/?discipline='.$value['discipline'].'&status=' . strtr($this->encryption->encrypt("4|10"), '+=/', '.-~'));
              $link_detail_encrypt = getenv('LINK_PCMS_PORTAL')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_detail_encrypt), '+=/', '.-~');
              $link_out_detail_encrypt = getenv('LINK_PCMSV2_OUTSIDE').'/mechanical_completion/detail_status_mc/?discipline='.$value['discipline'].'&status=' . strtr($this->encryption->encrypt("4|10"), '+=/', '.-~');
              $link_out_detail_encrypt = getenv('LINK_PCMS_PORTAL_OUTSIDE')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_out_detail_encrypt), '+=/', '.-~');
            ?>
            <div class="card text-center wrap client_invitation">
              <h6 class="title-card"><strong>CLIENT INVITATION</strong></h6>
              <h1 class="total-data"><?= $value['total_invite_client'] + $value['total_review_document_client'] ?></h1>
              <a href="<?= $link_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (Internal)</a>
              <br>
              <a href="<?= $link_out_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (External)</a>
            </div>
          </td>
          <td width="25%">
            <?php
              $link_detail_encrypt = site_url('mechanical_completion/detail_status_mc/?discipline='.$value['discipline'].'&status=' . strtr($this->encryption->encrypt("9"), '+=/', '.-~'));
              $link_detail_encrypt = getenv('LINK_PCMS_PORTAL')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_detail_encrypt), '+=/', '.-~');
              $link_out_detail_encrypt = getenv('LINK_PCMSV2_OUTSIDE').'/mechanical_completion/detail_status_mc/?discipline='.$value['discipline'].'&status=' . strtr($this->encryption->encrypt("9"), '+=/', '.-~');
              $link_out_detail_encrypt = getenv('LINK_PCMS_PORTAL_OUTSIDE')."/jump_url/redirect/".strtr($this->encryption->encrypt($link_out_detail_encrypt), '+=/', '.-~');
            ?>
            <div class="card text-center wrap approved_client">
              <h6 class="title-card"><strong>APPROVED BY CLIENT & COMPLETED</strong></h6>
              <h1 class="total-data"><?= $value['total_approved_client'] ?></h1>
              <a href="<?= $link_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (Internal)</a>
              <br>
              <a href="<?= $link_out_detail_encrypt ?>" class="link-detail" target="_blank">More Detail (External)</a>
            </div>
          </td>
        </tr>
      </table>
    <?php endforeach; ?>
  </body>
</html>