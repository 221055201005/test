   <script>
       function append_drawing_links_if_any(rev,drawing_type) {
            var rev_oke = rev;
            if(drawing_type == 0){ 
                $(".add_drawing_ga_as").text(""); 
                var links = "<?= base_url_ftp_eng() ?>public_smoe/open_atc/2/<?= strtr($this->encryption->encrypt($activity_eng[$detail_fitup['drawing_no']]['id']), '+=/', '.-~') ?>/"+ rev_oke;
                $(".add_drawing_ga_as").append('<a target="_blank" href="'+links+'"><?= $detail_fitup['drawing_no'] ?> (Rev. '+ rev_oke +')</a>');
            } else if(drawing_type == 1){ 
                $(".add_drawing_ga_wm").text(""); 
                var links = "<?= base_url_ftp_eng() ?>public_smoe/open_atc/2/<?= strtr($this->encryption->encrypt($activity_eng[$detail_fitup['drawing_wm']]['id']), '+=/', '.-~') ?>/"+ rev_oke;
                $(".add_drawing_ga_wm").append('<a target="_blank" href="'+links+'"><?= $detail_fitup['drawing_wm'] ?> (Rev. '+ rev_oke +')</a>');
            }
        }
   </script>  
     <form action="<?php echo base_url();?>fitup/process_postpone_retransmitted" method="POST">

            <input type="hidden" name="drawing_no_modal" value='<?= $detail_fitup['drawing_no'] ?>' >
            <input type="hidden" name="drawing_wm_modal" value='<?= $detail_fitup['drawing_wm'] ?>'>
            <input type="hidden" name="discipline_modal" value='<?= $detail_fitup['discipline'] ?>'>
            <input type="hidden" name="module_modal" value='<?= $detail_fitup['module'] ?>'>
            <input type="hidden" name="type_of_module_modal" value='<?= $detail_fitup['type_of_module'] ?>'>
            <input type="hidden" name="report_number_modal" value='<?= $detail_fitup['report_number'] ?>'> 
            <input type="hidden" name="postpone_reoffer_no_modal" value='<?= $detail_fitup['postpone_reoffer_no'] ?>'> 
            <input type="hidden" name="status_retransmitted_modal" value='<?= $detail_fitup['status_retransmitted'] ?>'> 

            <input type="hidden" name="surveyor_creator_modal" value='<?= $detail_fitup['surveyor_creator'] ?>'> 
            <input type="hidden" name="surveyor_created_date_modal" value='<?= $detail_fitup['surveyor_created_date'] ?>'> 
            <input type="hidden" name="area_v2_modal" value='<?= $detail_fitup['area_v2'] ?>'> 
            <input type="hidden" name="location_v2_modal" value='<?= $detail_fitup['location_v2'] ?>'> 
            <input type="hidden" name="deck_elevation_modal" value='<?= $detail_fitup['deck_elevation'] ?>'> 
            <input type="hidden" name="status_inspection_modal" value='<?= $detail_fitup['status_inspection'] ?>'> 
            <input type="hidden" name="company_id" value='<?= $company_wp ?>'> 

            <b><i>Inspector Name :</i></b> <br/>
            <select name="inspector_id_modal"  class="select2 form-control" style="width: 100%" required>
              <option value="">---</option>
              <?php foreach ($user_list_inspector as $key => $value): ?> 
               <option value="<?= $value['id_user'] ?>" <?= ($detail_fitup['inspector_id'] == $value['id_user'] ? "selected" : null ) ?>><?= $value['full_name'] ?></option>
               <?php endforeach; ?>
            </select><br/>

            <b><i>Inspect Date :</i></b> <br/>
            <input type="date" name="inspect_date_modal" class="form-control" value="<?= date('Y-m-d') ?>"  required><br/>

            <b><i>Inspect Time : </i></b> <br/>
            <input type="time" name="inspect_time_modal" class="form-control" value="<?= date('H:i:s') ?>" required><br/>


            <b><i>Client Notification : </i></b> <br/>
            <select name="status_invitation_modal" class="form-control" style="width:100%" required>
                <option value="">~ Choice ~</option>
                <option value="0" <?= ($detail_fitup['status_invitation'] == 0 ? "selected" : null ) ?>>Notification - Client Invitation Witness</option>
                <option value="1" <?= ($detail_fitup['status_invitation'] == 1 ? "selected" : null ) ?>>Notification - SMOE Activity</option>
            </select><br/>

            <b><i>Legend Inspection Authority AS PER ITP : </i></b> <br/>
            <?php $data_legend = explode(";",$detail_fitup['legend_inspection_auth']); ?>
            <select name="legend_inspection_auth_modal[]" class="select2 form-control" id='legend_inspection_auth_modal' style="width:100%" multiple="" required>
                <option value="">~ Choice ~</option>
                <option value="0" <?= ($data_legend[0] == 1 ? "selected" : null) ?>>Hold Point</option>
                <option value="1" <?= ($data_legend[1] == 1 ? "selected" : null) ?>>Witness</option>
                <option value="2" <?= ($data_legend[2] == 1 ? "selected" : null) ?>>Monitoring</option>
                <option value="3" <?= ($data_legend[3] == 1 ? "selected" : null) ?>>Review</option>
            </select><br/>

            <b><i>Drawing GA/AS - Rev No : </i></b> <br/>
            <select name="drawing_rev_no_new" class="select2 form-control" style="width:100%" required onchange='append_drawing_links(this,0)'> 
                <option value="">~ Choice ~</option>
                <?php foreach($revision_gaas as $key => $value){ ?> 
                  <option value='<?= $value ?>' <?= ($detail_fitup['drawing_rev_no'] == $value ? "selected" : null) ?>><?= $value ?></option>
                <?php } ?> 
            </select><br/>

            <span class='add_drawing_ga_as'><?php if(isset($detail_fitup['drawing_rev_no'])){ ?><script>append_drawing_links_if_any("<?= $detail_fitup['drawing_rev_no'] ?>",0)</script><?php } else { ?>-<?php } ?></span><br/><br/>

            <b><i>Drawing Weld Map - Rev No : </i></b> <br/>
            <select name="drawing_wm_rev_approved_new" class="select2 form-control" style="width:100%" required onchange='append_drawing_links(this,1)'>
              <option value="">~ Choice ~</option> 
              <?php foreach($revision_weldmap as $key => $value){ ?> 
                <option value='<?= $value ?>' <?= ($detail_fitup['drawing_wm_rev_approved'] == $value ? "selected" : null) ?>><?= $value ?></option>
              <?php } ?>
            </select><br/>

            <span class='add_drawing_ga_wm'><?php if(isset($detail_fitup['drawing_wm_rev_approved'])){ ?><script>append_drawing_links_if_any("<?= $detail_fitup['drawing_wm_rev_approved'] ?>",1)</script><?php } else { ?>-<?php } ?></span><br/><br/>

            
            <b><i>Remarks : </i></b> <br/>
            <textarea name="invitation_remarks_modal" class="form-control"></textarea><br/>
  
        
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        </div>
      </form>

<script>
    $('.select2').select2({
        theme : 'bootstrap'
    })

    function append_drawing_links(rev,drawing_type) {
        var rev_oke = $(rev).val();
        if(drawing_type == 0){ 
            $(".add_drawing_ga_as").text(""); 
            var links = "<?= base_url_ftp_eng() ?>public_smoe/open_atc/2/<?= strtr($this->encryption->encrypt($activity_eng[$detail_fitup['drawing_no']]['id']), '+=/', '.-~') ?>/"+ rev_oke;
            $(".add_drawing_ga_as").append('<a target="_blank" href="'+links+'"><?= $detail_fitup['drawing_no'] ?> (Rev. '+ rev_oke +')</a>');
        } else if(drawing_type == 1){ 
            $(".add_drawing_ga_wm").text(""); 
            var links = "<?= base_url_ftp_eng() ?>public_smoe/open_atc/2/<?= strtr($this->encryption->encrypt($activity_eng[$detail_fitup['drawing_wm']]['id']), '+=/', '.-~') ?>/"+ rev_oke;
            $(".add_drawing_ga_wm").append('<a target="_blank" href="'+links+'"><?= $detail_fitup['drawing_wm'] ?> (Rev. '+ rev_oke +')</a>');
        }
    }

  
</script>
