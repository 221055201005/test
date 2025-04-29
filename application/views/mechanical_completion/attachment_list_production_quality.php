<?php

$tab1   = strtr($this->encryption->encrypt('mv'), '+=/', '.-~');
$tab2   = strtr($this->encryption->encrypt('fi'), '+=/', '.-~');
$tab3   = strtr($this->encryption->encrypt('vt'), '+=/', '.-~');
$tab4   = strtr($this->encryption->encrypt('ndt'), '+=/', '.-~');

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
            <h6 class="m-0">Production & Quality Attachment</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <ul class="nav nav-pills border-bottom border-gray" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link <?= $tab == "mv" ? 'active' : '' ?>" id="mv-tab" href="<?= site_url('mechanical_completion/attachment_list_production_quality/' . $tab1) ?>" role="tab" aria-controls="mv" aria-selected="true">Material Verification</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?= $tab == "fi" ? 'active' : '' ?>" id="fi-tab" href="<?= site_url('mechanical_completion/attachment_list_production_quality/' . $tab2) ?>" role="tab" aria-controls="fi" aria-selected="false">Fitup Inspection</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?= $tab == "vt" ? 'active' : '' ?>" id="vt-tab" href="<?= site_url('mechanical_completion/attachment_list_production_quality/' . $tab3) ?>" role="tab" aria-controls="vt" aria-selected="false">Visual Testing</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?= $tab == "ndt" ? 'active' : '' ?>" id="ndt-tab" href="<?= site_url('mechanical_completion/attachment_list_production_quality/' . $tab4) ?>" role="tab" aria-controls="ndt" aria-selected="false">NDT</a>
                  </li>
                </ul>
              </div>

            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <div id="content_list">

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
  const spinner = () => {
    return `<div class="container text-center h-100">
        <div class="row align-items-center h-100">
          <div class="col-md-12">
            <div class="spinner-border text-success" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </div>
      </div>`
  }

  <?php if ($tab) : ?>

    load_data()

    function load_data() {
      $("#content_list").html(spinner)
      let url   = "<?= site_url('mechanical_completion/load_document_pq/'.$tab) ?>"
      console.log(url)

      $.ajax({
        url     : url,
        type    : "POST",
        success : (data) => {
          $("#content_list").html(data)
        }
      })
    }

  <?php endif; ?>
</script>