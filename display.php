<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>Document</title>
	<link href="./assets/css/style.css" rel="stylesheet" type="text/css">
	<link href="./assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="./assets/css/bootstrap.css.map" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="d-md-flex h-md-100 align-items-center">

		<!-- First Half -->
		<div class="col-md-6 p-0 bg-indigo h-md-100 overflow-auto">
			<div class="d-md-flex h-100 p-5 text-center justify-content-center">
				
				<div class="logoarea py-5">
					<!-- Tweet cards -->
				<?php require_once('dynamichtml.php');?>
				</div>
			</div>
        </div>
        <!--===============================================================================-->
		<!-- Second Half -->
		<div class="col-md-6 p-0 bg-white h-md-100">
			<div class="d-md-flex h-md-100 p-5 justify-content-center">
				<div class="card">
					<div class="card-header">
						Featured
					</div>
					<div class="card-body">
						<h5 class="card-title">Special title treatment</h5>
						<p class="card-text">With supporting text below as a natural lead-in to additional content.</p><a class="btn btn-primary" href="#">Go somewhere</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>