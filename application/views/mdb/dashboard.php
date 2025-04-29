<style>
  a,
  a:hover {
    text-decoration: none;
    color: black;

  }

  .card_link:hover {
    filter: brightness(90%);
    cursor: pointer;
  }
</style>


<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow">

          <div class="card-header">
            <h2 class="card-title text-center font-weight-bold m-0"><i class="fas fa-file-alt"></i> DOSSIER</h2>
          </div>

          <div class="card-body">
            <div class="row">

              <div class="col-md-6 mt-3">
                <?php
                $link = site_url('mdb/mdb_general/');
                ?>
                <a href="<?= $link ?>" target="_blank">
                  <div class="card shadow-sm card_link">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <h4 class="card-title mt-1"><strong>MDB - GENERAL
                            </strong></h4>
                        </div>
                        <div class="col-md-12">
                          <h6 class="card-title"> GENERAL FABRICATION PROCEDURE</h6>
                        </div>

                      </div>
                    </div>
                  </div>
                </a>
              </div>

              <div class="col-md-6 mt-3">
                <?php
                $link = site_url('mdb/mdb_jacket_new/');
                ?>
                <a href="<?= $link ?>" target="_blank">
                  <div class="card shadow-sm card_link">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <h4 class="card-title mt-1"><strong>MDB - JACKET
                            </strong></h4>
                        </div>

                        <div class="col-md-12">
                          <h6 class="card-title">MDB INDEX B (SPECIFIC) JACKET</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>



              <?php $no = 1;
              foreach ($deck_elevation as $key => $value) : ?>
                <div class="col-md-4 mt-3">
                  <?php
                  $link = site_url('mdb/mdb_deck_new/' . $value['id']);
                  ?>
                  <a href="<?= $link ?>" target="_blank">
                    <div class="card shadow-sm card_link">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <h4 class="card-title mt-1"><strong>MDB - <?= strtoupper($value['name']) ?>

                              </strong></h4>
                          </div>
                          <div class="col-md-12">
                            <h6 class="card-title">MDB INDEX B (SPECIFIC) <?= strtoupper($value['name']) ?></h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              <?php $no++;
              endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>