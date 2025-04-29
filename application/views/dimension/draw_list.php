<div id="content" class="container-fluid">
  <div class="row">

    <div class="col-md-12">

      <!-- START FILTER -->
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Filter Drawing</h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">    
          <form id="form_filter" method="POST" action="">
              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label">Project :</label>
                    <div class="col-xl">
                      <select class="form-control" name="project" required>
                        <option value="">---</option>
                        <?php foreach ($project_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$post['project'] == $value['id'] ? 'selected' : ($this->user_cookie[10] == $value['id'] ? 'selected' : '')) ?>><?php echo $value['project_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label">Discipline :</label>
                    <div class="col-xl">
                      <select class="custom-select" name="discipline">
                        <option value="">---</option>
                        <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$post['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div> 
              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label">Deck Elevation / Service Line :</label>
                    <div class="col-xl">
                            <select name="deck_elevation" class="select2" style="width:100%">
                              <option value="">---</option>
                              <?php foreach ($deck_list as $key => $value): ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == @$post['deck_elevation'] ? 'selected' : '' ?>>
                                <?= $value['name'] ?></option>
                              <?php endforeach; ?>
                            </select> 
                    </div>
                  </div>
                </div> 
                <div class="col-md">
                  <div class="form-group row"> 
                    <label class="col-xl-2 col-form-label"> </label>
                      <div class="col-xl">
                             
                      </div>                      
                  </div>
                </div>                    
              </div>
              <div class="row">
                <div class="col-md">
                  <div class="form-group row m-0">
                    <div class="col-xl text-right">
                      <button type="submit" name='submit' value='filter' class="btn btn-primary" title="Update"><i class="fa fa-search"></i> Filter</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- END FILTER -->

      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <?php  echo $this->session->flashdata('message');?>
            <table class="table table-hover text-center" id='drawing_list_dt'>
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th width="25%">Drawing No</th>                 
                  <th>Discipline</th> 
                  <th>Deck Elevation / Service Line</th>
                  <th>Action</th>
                </tr>
              </thead>
              
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script type="text/javascript">
     
          $('#drawing_list_dt').DataTable({
            "language": { 
                "infoFiltered": "" },
                "paging": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url();?>additional/draw_list_filter/",
                    "type": "POST",
                    "data":{
                          type_of_report: "<?= @$type_of_report ?>",
                          project: "<?= @$post['project'] ?>", 
                          deck_elevation: "<?= @$post['deck_elevation'] ?>",
                    },
                },
                "columnDefs": [{
                  "targets": [0],
                  "orderable": true,
                }, ],

          });

</script>
 
<script>
    $("select[name=module]").chained("select[name=project]");
</script>