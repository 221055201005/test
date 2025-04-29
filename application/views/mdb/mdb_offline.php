<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="card-title m-0"><?= $meta_title ?></h6>
          </div>
          <div class="card-body bg-white">
            <form action="<?= site_url('mdb/mdb_offline_process') ?>" method="post" onsubmit="sweetalert('loading', 'Please wait ...')">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted">Category</label>
                    <div class="col-xl">
											<select class="form-control" name="category" required>
												<option value="">---</option>
												<option value="mdb_assets">MDB Assets</option>
												<option value="mdb_dashboard">MDB Dashboard</option>
												<option value="mdb_general">MDB Index A - General Fabrication Procedure</option>
												<option value="mdb_jacket">MDB Index B - (Specific) Jacket</option>
												<option value="mdb_deck">MDB Index B - (Specific) All Deck</option>
												<option value="mdb_deck_5">MDB Index B - (Specific) Deck 1</option>
												<option value="mdb_deck_6">MDB Index B - (Specific) Deck 2</option>
												<option value="mdb_deck_7">MDB Index B - (Specific) Deck 3</option>
												<option value="mdb_deck_8">MDB Index B - (Specific) Deck 4</option>
												<option value="mdb_deck_9">MDB Index B - (Specific) Deck 5</option>
												<option value="mdb_deck_10">MDB Index B - (Specific) Deck 6</option>
											</select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <hr>
                  <div class="float-right">
                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Process</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
</script>