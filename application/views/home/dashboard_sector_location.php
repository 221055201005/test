<style>
  @media (max-width: 767.99px) {
    .row{
      margin-top: -15px;
      margin-bottom: -15px;
    }
    .row.mt-30{
      margin-top: 15px;
      /* margin-bottom: 15px; */
    }
    [class*="col-"]{
      padding-top: 15px;
      padding-bottom: 15px;
    }
  }
  @media (min-width: 768px) {
    .mt-30{
      margin-top: 30px;
    }
  }
  #content, .form-control{
    font-size: 0.7rem;
  }
  .font-7{
    font-size: 0.7rem;
  }
  button.font-7{
    padding: 0.1rem 0.2rem;
  }
  h1.num_fabrication_high{
    text-align: center;
    font-size: 3rem;
    color: #535c68;
    font-weight: bold;
    white-space: nowrap;
  }
  .num_fabrication_subtitle{
    width: 100%;
    text-align: center;
    color: #535c68;
    font-size: 9px;
  }
  .table td, .table th{
    padding: 0.25rem;
  }
  .table thead{
    position: sticky;
    top: 0;
  }
  .bg-success-dashboard{
    background-color: #20bf6b;
  }
  .num_fabrication_witness{
    background-color: #2bcbba;
    color: white;
    font-weight: bold;
    padding: 2px;
  }
  .num_fabrication_activity{
    background-color: #4b7bec;
    color: white;
    font-weight: bold;
    padding: 2px;
  }
  .num_fabrication_ndt{
    font-weight: bold;
    padding: 2px;
    border: 1px solid #778ca3;
  }
  
  .nav-pills .nav-link {
    color: #000;
    border-bottom: 2px solid #007bff;
    border-radius: 0px;
    min-width: 200px;
    text-align: center;
    box-shadow: inset 0 0 0 0 #007bff;
    -webkit-transition: ease-out 0.2s;
    -moz-transition: ease-out 0.2s;
    transition: ease-out 0.2s;
  }
  .nav-pills .nav-link:hover {
    color: #fff;
    box-shadow: inset 0 -100px 0 0 #007bff;
  }
  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link {
    color: #fff;
    background: #007bff;
    border-bottom: 2px solid #007bff;
    border-radius: 0px;
  }

  .table-sector{
    table-layout: fixed;
    width: 100%;
    text-align: center;
    font-size: 2rem;
    font-weight: bold;
  }
  .table-sector td{
    height: 100px;
  }
  .table-sector.inner td{
    color: white;
    font-size: .7rem;
    height: 100px;
    border: 2px solid #fff;
    cursor: pointer;
    -webkit-transition: ease-out 0.2s;
    -moz-transition: ease-out 0.2s;
    transition: ease-out 0.2s;
  }
  .table-sector.inner td:hover{
    color: #fff;
  }
  .table-sector.inner td.bg-start, .bg-cell-start{
    background-color: #eb3b5a;
  }
  .table-sector.inner td.bg-low, .bg-cell-low{
    background-color: #fa8231;
  }
  .table-sector.inner td.bg-medium, .bg-cell-medium{
    background-color: #fed330;
  }
  .table-sector.inner td.bg-high, .bg-cell-high{
    background-color: #0fb9b1;
  }
  .table-sector.inner td.bg-finish, .bg-cell-finish{
    background-color: #20bf6b;
  }
  .table-sector.inner td.bg-blank, .bg-cell-blank{
    background-color: #a5b1c2;
  }
  .table-sector.inner td.dark{
    filter: brightness(60%);
  }
</style>
<div id="content" class="container-fluid">
  <div class="bg-white p-3 shadow-sm">
    <h4 class="text-center font-weight-bold mt-0 mb-3">Production & Quality Dashboard</h4>
    <?= $tabmenu ?>
  </div>
  <br/>
  <div class="row">
    <div class="col-md-2">
      <div class="card my-2 border-0 shadow-sm">
        <div class="card-body bg-white p-2">
          <form id="form_sector">
            <div class="form-group">
              <label class="font-weight-bold">Type</label>
              <select class="form-control" name="type" onchange="submit_form()">
                <option value="fabrication" <?= ($get['type'] == 'fabrication' ? 'selected' : '') ?>>Fabrication</option>
                <!-- <option value="dimension" <?= ($get['type'] == 'dimension' ? 'selected' : '') ?>>Dimension Control</option> -->
                <option value="ndt" <?= ($get['type'] == 'ndt' ? 'selected' : '') ?>>NDT</option>
              </select>
            </div>
            <div class="form-group">
              <label class="font-weight-bold">Deck</label>
              <select class="form-control" name="deck_elevation" onchange="submit_form()">
                <?php foreach ($deck_elevation_list as $key => $value): ?>
                  <option value="<?= $value['id'] ?>" <?= ($get['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?= $value['name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </form>
        </div>
      </div>
      <div class="card my-2 border-0 shadow-sm">
        <div class="card-body bg-white p-2">
          <div class="p-1">
            <span class="mr-2 bg-cell-blank" style="width: 30px;">&nbsp;</span> No Joint
          </div>
          <div class="p-1">
            <span class="mr-2 bg-cell-start" style="width: 30px;">&nbsp;</span> 0% - 25%
          </div>
          <div class="p-1">
            <span class="mr-2 bg-cell-low" style="width: 30px;">&nbsp;</span> 26% - 50%
          </div>
          <div class="p-1">
            <span class="mr-2 bg-cell-medium" style="width: 30px;">&nbsp;</span> 51% - 75%
          </div>
          <div class="p-1">
            <span class="mr-2 bg-cell-high" style="width: 30px;">&nbsp;</span> 76% - 99%
          </div>
          <div class="p-1">
            <span class="mr-2 bg-cell-finish" style="width: 30px;">&nbsp;</span> 100%
          </div>
          <div class="p-1">
            <i>* Based on document report</i>
          </div>
        </div>
      </div>
      <div class="card my-2 border-0 shadow-sm">
        <div class="card-body bg-white p-2">
          <a href="<?= base_url() ?>home/dashboard_sector_location_detail/<?= strtr($this->encryption->encrypt($get['deck_elevation']), '+=/', '.-~') ?>/unset/<?= $get['type'] ?>/1" class="btn btn-sm btn-success btn-flat" target="_blank"><i class="fas fa-download"></i> Download All Sector Detail</a>
        </div>
      </div>
    </div>
    <div class="col-md">
      <div class="card my-2 border-0 shadow-sm">
        <div class="card-header bg-info">
          <h6 class="m-0 text-center text-white">MAPPING PROGRESS BASED ON DOCUMENT REPORT</h6>
        </div>
        <div class="card-body bg-white p-2">
          <?php
            $color_class = ["bg-start", "bg-low", "bg-medium", "bg-high", "bg-finish", "bg-blank"];
          ?>
          <table class="table-sector" border="0">
            <tr>
              <td></td>
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>4</td>
              <td>5</td>
              <td>6</td>
              <td>7</td>
              <td>8</td>
            </tr>
            <tr>
              <td>E</td>
              <td rowspan="5" colspan="8">
                <table class="table-sector inner" border="0">
                  <?php 
                    $letter_arr = [];
                    for ($i="A"; $i != "F"; $i++){
                      $letter_arr[] = $i;
                    }
                    $letter_arr = array_reverse($letter_arr);
                    foreach ($letter_arr as $i):
                  ?>
                    <tr>
                      <?php for ($x=1; $x <= 8; $x++): ?>
                        <?php
                          $color_id = 0;
                          if(isset($data_sector[$i.$x])){
                            if((@$data_sector[$i.$x]['complete']+0)/(@$data_sector[$i.$x]['total'] + 0)*100 == 100){
                              $color_id = 4;
                            }
                            elseif((@$data_sector[$i.$x]['complete']+0)/(@$data_sector[$i.$x]['total'] + 0)*100 > 75){
                              $color_id = 3;
                            }
                            elseif((@$data_sector[$i.$x]['complete']+0)/(@$data_sector[$i.$x]['total'] + 0)*100 > 50){
                              $color_id = 2;
                            }
                            elseif((@$data_sector[$i.$x]['complete']+0)/(@$data_sector[$i.$x]['total'] + 0)*100 > 25){
                              $color_id = 1;
                            }
                          }
                          else{
                            $color_id = 5;
                          }
                        ?>
                        <!-- <td onclick="go_to_detail('<?= $i.$x ?>')" class="<?= $color_class[$color_id] ?>" data-toggle="tooltip" data-placement="top" title="<?= @$data_sector[$i.$x]['complete']+0 ?> of <?= @$data_sector[$i.$x]['total']+0 ?> Joint"><?= $i.$x ?></td> -->
                        <td onclick="go_to_detail('<?= $i.$x ?>')" class="<?= $color_class[$color_id] ?>" data-toggle="tooltip" data-placement="top" title="<?= $i.$x ?> : <?= @$data_sector[$i.$x]['complete']+0 ?> of <?= @$data_sector[$i.$x]['total']+0 ?> Joint"><?= @$data_sector[$i.$x]['complete']+0 ?> of <?= @$data_sector[$i.$x]['total']+0 ?></td>
                      <?php endfor; ?>
                    </tr>
                  <?php endforeach; ?>
                </table>
              </td>
            </tr>
            <tr>
              <td>D</td>
            </tr>
            <tr>
              <td>C</td>
            </tr>
            <tr>
              <td>B</td>
            </tr>
            <tr>
              <td>A</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script>
  $(document).ready(function(){
    $(".table-sector.inner td").mouseenter(function(){
      $(".table-sector.inner td").addClass("dark");
      $(this).removeClass("dark");
    });
    $(".table-sector.inner").mouseleave(function(){
      $(".table-sector.inner td").removeClass("dark");
    });
  });
  
  function submit_form() {
    sweetalert('loading', 'Please Wait...');
    $('#form_sector').submit();
  }

  function go_to_detail(sector) {
    window.open('<?= base_url() ?>home/dashboard_sector_location_detail/<?= strtr($this->encryption->encrypt($get['deck_elevation']), '+=/', '.-~') ?>/'+sector+'/'+$('select[name=type]').val());
    // sweetalert('loading', 'Please Wait...');
    // window.location = '<?= base_url() ?>home/dashboard_sector_location_detail/<?= strtr($this->encryption->encrypt($get['deck_elevation']), '+=/', '.-~') ?>/'+sector+'/'+$('select[name=type]').val();
  }
</script>