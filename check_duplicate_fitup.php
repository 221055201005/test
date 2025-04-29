
<?php 
  // $conn = pg_connect("host=10.5.255.14 port=5432 dbname=pcms_v21 user=postgres password=@DevTeam4321.");    
?>
	
	<script type="text/javascript" src="assets/jquery/jquery-3.4.1.min.js"></script>

    <!-- Datatable -->
    <link href="assets/datatables/jquery.dataTables.min.css" rel="stylesheet">
    <script type="text/javascript" src="assets/datatables/jquery.dataTables.min.js"></script>

    <center>

    	<h1>Data Duplicate Status</h1>

    <div style="width:100%;">

		  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0" style='text-align:center;'>
                <thead>
                  <tr>
                    <th>Submission ID - OLD</th>                                  
                    <th>Submission ID - New</th>                                  
                    <th>Date Request</th>                                  
                    <th>Drawing No</th>                                  
                    <th>Deck Elevation / Service Line</th>                                  
                    <th>Total Data</th>                              
                    <th>id_joint</th>                              
                  </tr>
                </thead>
                <tbody>

                <?php 
                    /// get master report
 
                      $requery = "SELECT * from master_report_no where project = '21' and category ='fitup_rfi'";
                      $requery_view = pg_query($conn, $requery); 
                      while($review = pg_fetch_array($requery_view)){   
                          $save_new_submission_no[$review['project']][$review['company_id']][$review['discipline']][$review['type_of_module']][$review['deck_elevation']]["fitup_rfi"] = $review['report_no'];
                      }
                      
                ?>


                  <?php   
                  $start_no = '0';
                    $query = "select 
                         pf.submission_id,
                         max(pj.project) as project,
                         max(pj.discipline) as discipline,
                         max(pj.type_of_module) as type_of_module,
                         max(pj.deck_elevation) as deck_elevation,
                         max(pj.company_id) as company_id,
                        pf.date_request, 
                        pf.drawing_no, 
                        count(pf.id_joint) as total_data,
                        pj.deck_elevation 
                      from pcms_fitup pf join pcms_joint pj on pf.id_joint = pj.id 
                      where pf.project_code = 21 and status_inspection > 0 and status_resubmit IN (0,1) and deck_elevation = '38'
                      group by pf.submission_id,pf.drawing_no,pf.date_request, pj.deck_elevation order by date_request ASC";
                    $query_view = pg_query($conn, $query);
                    $total_spec_category = pg_num_rows($query_view);
                    while($view = pg_fetch_array($query_view)){  

                      $start_no++;
                     $next_no =  str_pad($start_no, 6, '0', STR_PAD_LEFT);

                     $id_group = array();
                     $project_up        = $view["project"];
                     $submission_id_up  = $view["submission_id"];
                     $date_request_up   = $view["date_request"];
                     $drawing_no_up     = $view["drawing_no"];
                     $get_id_joint = "SELECT * from pcms_fitup where project_code ='".$project_up."' and submission_id='".$submission_id_up."' and date_request='".$date_request_up."'";
                     $get_view = pg_query($conn, $get_id_joint); 
                     while($view_id = pg_fetch_array($get_view)){   
                      $id_group[] = $view_id['id_joint']; 
                     }
                     
                     $new_submission_id_update = $save_new_submission_no[$view['project']][$view['company_id']][$view['discipline']][$view['type_of_module']][$view['deck_elevation']]["fitup_rfi"].$next_no;

                    

                     $id_joint_implode = implode(",",$id_group);
                     $update_proc = "UPDATE pcms_fitup SET submission_id = '".$new_submission_id_update."' where id_joint IN (".$id_joint_implode.")";
                    //  $update_proc = "SELECT * from pcms_fitup where id_joint IN (".$id_joint_implode.")";
                        // $update = pg_query($conn, $update_proc); 
                    //  while($test = pg_fetch_array($update)){
                    //    print_r($test['submission_id']);
                    //  }
                    
                     
                   ?>
                      <tr>
                        <td><?php echo $view['submission_id']; ?></td>
                        <td><?php echo $new_submission_id_update; ?></td>
                        <td><?php echo $view['date_request']; ?></td>
                        <td><?php echo $view['drawing_no']; ?></td>
                        <td><?php echo $view['deck_elevation']; ?></td> 
                        <td><?php echo $view['total_data']; ?></td> 
                        <td><?php print_r($id_group); ?></td> 
                      </tr> 
                  <?php  
                       } 
                   ?>

                </tbody>
    	</table> 
 
	</div>

	</center>
  
 

<script>
    $('#dataTable').DataTable( {
      "paging": false,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });

    $('#dataTablex').DataTable( {
      "paging": false,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
</script>