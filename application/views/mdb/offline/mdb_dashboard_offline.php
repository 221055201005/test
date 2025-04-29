<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="IT Developer SMOE">
  <title><?php echo $meta_title ?></title>
  <link rel="shortcut icon" href="img/favicon.png" />
  <link href="assets/css/all.min.css" rel="stylesheet">
</head>

<body>
  <style>
		body{
			background-color: whitesmoke;
			font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
			color: #212529;
		}
		.container{
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.flex-container {
			height: 90vh;
			width: 100%;
			max-width: 1200px;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
		}
		.flex-row {
			width: 100%;
			display: flex;
			flex-direction: row;
			justify-content: center;
			align-items: center;
			margin: 0 -15px; 
		}
		.col-50{
			flex: 50%;
			text-align: center;
			padding: 0 15px; 
		}
		.col-33{
			flex: 33%;
			text-align: center;
			padding: 0 15px; 
		}
		.card{
			border: 1px solid rgba(0,0,0,.125);
			border-radius: 0.25rem;
			padding: 1.25rem;
			margin-top: 1rem;
			background-color: #fff;
    	background-clip: border-box;
			box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
		}
		.card h4{
			font-size: 1.5rem;
			line-height: 1.2;
			margin-top: 0.25rem;
			margin-bottom: 0.75rem;
		}
		.card h6{
			font-size: 1rem;
			line-height: 1.2;
			margin-top: 0;
			margin-bottom: 0.75rem;
		}
		@media (max-width: 768px) {
			.flex-row {
				flex-wrap: wrap;
			}
			.col-33, .col-50{
				flex: 100%;
			}
		}
		a, a:hover {
			text-decoration: none;
			color: black;
		}
		a {
			background-color: transparent;
		}
		.card:hover{
			filter: brightness(90%);
		}
	</style>
	<div class="container">
		<div class="flex-container">
			<h1>DOSSIER OFFLINE</h1>
			<div class="flex-row">
				<div class="col-50">
					<a href="mdb_index_a.html">
						<div class="card">
							<h4><strong>MDB - GENERAL </strong></h4>
							<h6> GENERAL FABRICATION PROCEDURE</h6>
						</div>
					</a>
				</div>
				<div class="col-50">
					<a href="mdb_index_b_jacket.html">
						<div class="card">
							<h4><strong>MDB - JACKET </strong></h4>
							<h6> MDB INDEX B (SPECIFIC) JACKET</h6>
						</div>
					</a>
				</div>
			</div>
			<div class="flex-row">
				<div class="col-33">
					<a href="mdb_index_b_deck_1.html">
						<div class="card">
							<h4><strong>MDB - DECK 1</strong></h4>
							<h6> MDB INDEX B (SPECIFIC) DECK 1</h6>
						</div>
					</a>
				</div>
				<div class="col-33">
					<a href="mdb_index_b_deck_2.html">
						<div class="card">
							<h4><strong>MDB - DECK 2</strong></h4>
							<h6> MDB INDEX B (SPECIFIC) DECK 2</h6>
						</div>
					</a>
				</div>
				<div class="col-33">
					<a href="mdb_index_b_deck_3.html">
						<div class="card">
							<h4><strong>MDB - DECK 3</strong></h4>
							<h6> MDB INDEX B (SPECIFIC) DECK 3</h6>
						</div>
					</a>
				</div>
			</div>
			<div class="flex-row">
				<div class="col-33">
					<a href="mdb_index_b_deck_4.html">
						<div class="card">
							<h4><strong>MDB - DECK 4</strong></h4>
							<h6> MDB INDEX B (SPECIFIC) DECK 4</h6>
						</div>
					</a>
				</div>
				<div class="col-33">
					<a href="mdb_index_b_deck_5.html">
						<div class="card">
							<h4><strong>MDB - DECK 5</strong></h4>
							<h6> MDB INDEX B (SPECIFIC) DECK 5</h6>
						</div>
					</a>
				</div>
				<div class="col-33">
					<a href="mdb_index_b_deck_6.html">
						<div class="card">
							<h4><strong>MDB - DECK 6</strong></h4>
							<h6> MDB INDEX B (SPECIFIC) DECK 6</h6>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
  <script type="text/javascript" src="assets/jquery-3.4.1.min.js"></script>
</body>

</html>