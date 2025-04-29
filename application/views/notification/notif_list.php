<style type="text/css">
  .table {
    font-size: 100% !important;
    padding: 2px !important;
  }

  .select2-container {
    font-size: 70% !important;
    width: 100px !important;
    height: 20px !important;
  }

  .select2 {
width:100%!important;
}

  .big-checkbox {width: 20px; height: 20px;}
</style>
<div id="content" class="container-fluid">

 

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          
            <h6 class="m-0"><?php echo "System Notification"; ?></h6>
          
        </div>
        <div class="card-body bg-white overflow-auto">
           
            <div class="row">
               <div class="col-12">
                <div class="form-group row">
                  
                    <?php 
                        foreach($date_notif as $value){ 
                        foreach($date_notif_all[$value] as $value_data){ 

                            if(isset($value_data['link_encrypt']) && !empty($value_data['link_encrypt'])){

                            $link_decrypt = $this->encryption->decrypt(strtr($value_data['link_encrypt'], '.-~', '+=/'));
                    ?> 
                            <a href="#" id='id_<?= $value_data['id_notif'] ?>' onclick="redirect_notification('<?= $value_data['link_encrypt'] ?>','<?= $value_data['id_notif'] ?>')" class="list-group-item list-group-item-action flex-column align-items-start <?= empty($value_data['status_read']) ? "unread" : null ?>">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><?= isset($master_notif[$value_data['master_group_id']]) ? $master_notif[$value_data['master_group_id']]['designation_apps_desc'] : "-" ?></h5>
                                <small>
                                <?php 
                                    $earlier  = new DateTime($value);
                                    $later    = new DateTime(date("Y-m-d")); 
                                    $abs_diff = $later->diff($earlier)->format("%a"); 

                                    if($value == date("Y-m-d")){
                                    echo "Today";
                                    } else {
                                    if($abs_diff > 1){
                                        echo $abs_diff." days ago";
                                    } else{
                                        echo $abs_diff." day ago";
                                    }
                                    }
                                ?> 
                                </small>
                            </div>
                            <small><?= isset($master_notif[$value_data['master_group_id']]) ? $master_notif[$value_data['master_group_id']]['category_apps']. " - ".date("d F y",strtotime($value)) : "-" ?></small>
                            <p class="mb-1"><?= $value_data['notification_text'] ?></p>
                                </a> 
                    <?php 
                        }
                        }
                        }
                    ?>
                   
                </div>
              </div>
             
            </div>
             
        </div>
      </div>
    </div>
  </div>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
