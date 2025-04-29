<?php $this->load->view('_partial/header');?>

<body style="background-color: whitesmoke;">
  <div class="wrapper pt-4">
    <div class="container" style="margin: auto;">
      <h1 class="text-center" style="font-size: 20vmin;"><i class="<?= $icon ?> text-info"></i> <i class="fas fa-times text-danger"></i></h1>
      <h1 class="text-center"><?= $text ?></h1>
      <div class="text-center mt-4">
        <a href="<?= link_portal() ?>" class="btn btn-info"><i class="fas fa-chevron-circle-left"></i> Back to Portal</a>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $("div.wrapper").css("min-height", "calc(100vh - "+$("footer").outerHeight()+"px)");
    });
  </script>

	<footer class="container-fluid bg-white py-2">
		<div class="row">
			<div class="col-12 col-md">
				<center><small class="d-block my-1 text-muted">&copy; 2024 - Seatrium - PRODUCTION CONTROL MANAGEMENT SYSTEM </small></center>
			</div>
		</div>
	</footer>
</body>
</html>