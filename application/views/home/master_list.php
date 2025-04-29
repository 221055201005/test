<script type="text/javascript" src="<?php echo base_url() ?>assets/jquery/jquery-3.4.1.min.js"></script>

<!-- Datatable -->
<link href="<?php echo base_url() ?>assets/datatables/jquery.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url() ?>assets/datatables/jquery.dataTables.min.js"></script>
<center>
  <h1><?php echo $list_name ?> Code</h1>
  <div style="width:700px;">
    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0" cellpading=50>
      <thead>
        <tr>
          <th width="5px">No</th>
          <th width="50%"><?php echo $list_name ?> Code</th>
          <th><?php echo $list_name ?> Name</th>       
        </tr>
      </thead>
      <tbody>
        <?php

          $no=1;	
          foreach ($lists as $key => $value) {

          ?>
        <tr>
          <td>
            <?php echo $no; ?>                       
          </td>
          <td>
            <center>
              <input type="text" value='<?php echo $value["code"]; ?>' id="myInput<?php echo $no; ?>" readonly>
              <button style='background-color: #ffffa3;' onclick="copy_text('myInput<?php echo $no; ?>')">Copy Code</button>
              </center> 
          </td>
          <td>
            <?php echo $value["name"]; ?>               
          </td>
                      
        </tr>
        <?php $no++; ?>
        <?php } ?>

      </tbody>
    </table>

</div>

</center>
<script>
  function copy_text(btn) {
    var copyText = document.getElementById(btn);
    copyText.select();
    // copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    alert("Copied Code : " + copyText.value +"\nPaste to excel template file to import.");
  }

  $('#dataTable').DataTable({
    "order": [],
    "pageLength": -1,
    "paging": false,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true
  })
</script>