<div class="table-responsive overflow-auto">
  <table class="table table-hover text-center dataTable">
    <thead class="bg-green-smoe text-white">
      <th>Client Doc No</th>
      <th>Drawing No</th>
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
      "url": "<?php echo base_url();?>mechanical_completion/load_attachment_eng_shopdrawing",
      "type": "POST",
      "data":{
          "page" : 'list',
      }
    },
  })
</script>