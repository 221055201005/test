
<div class="table-responsive overflow-auto">
  <table id="table_materialx" class="table table-hover text-center" style="width:100%">
    <thead class="bg-green-smoe text-white">
      <th>Project</th>
      <th>Report Number</th>
      <th>Drawing Number</th>
      <th>Discipline</th>
      <th>Module</th>
      <th>Type of Module</th>
      <th>Deck Elevation / Service Line</th>
      <!-- <th>Company</th> -->
      <th>Rev No.</th>
      <th>Inspection By</th>
      <th>Inspection Date</th>
      <th>Status Inspection</th>
      <th>Status Invitation</th>
      <th style="min-width: 210px;">Action</th>
    </thead>
  </table>
</div>
<script>
$(document).ready(function() {
  $("#table_materialx").DataTable({
    processing: true,
    serverSide: true,
    order: [],
    ajax: {
      url: "<?= site_url($serverside) ?>",
      type: "POST",
    }
  })
})
</script>