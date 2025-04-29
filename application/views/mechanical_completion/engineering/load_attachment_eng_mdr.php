<div class="table-responsive overflow-auto">
  <table class="table table-hover text-center dataTable">
    <thead class="bg-green-smoe text-white">
      <th>Cilent Doc No</th>
      <th>Reference No</th>
      <th>Contractor No</th>
      <th>Revision No</th>
      <th>Title</th>
      <th>Uploaded By</th>
      <th>Uploaded Date</th>
      <th></th>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>

<script>
  $('.dataTable').DataTable({
    order: [],
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "<?php echo base_url();?>mechanical_completion/load_attachment_eng_mdr",
      "type": "POST",
      "data":{
        "page" : 'list',
      }
    },
  })
</script>