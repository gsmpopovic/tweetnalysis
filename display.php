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
        <!--===============================================================================-->
		<!-- First Half -->
		<div class="col-md-6 p-0 bg-white h-md-100 overflow-auto">

		<div class="d-md-flex p-3 justify-content-center">
<h1> So, I was able to get X tweets.</h1>
			</div>

			<div class="d-md-flex p-3 justify-content-center">
				<!-- Ratings card --> 
				<div class="card">
					<div class="card-header"> - </div>
					<div class="card-body">
						<h5 class="card-title">Special title treatment</h5>
						<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
					</div>
				</div>
				<!-- Ratings card --> 
			</div>

			<div class="d-md-flex p-3 justify-content-center">
				<!-- Ratings card --> 
				<div class="card">
					<div class="card-header">
						Featured
					</div>
					<div class="card-body">
						<h5 class="card-title">Special title treatment</h5>
						<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
					</div>
				</div>
				<!-- Ratings card --> 
			</div>

			<div class="d-md-flex p-3 justify-content-center">
				<!-- Ratings card --> 
				<div class="card">
					<div class="card-header">
						Featured
					</div>
					<div class="card-body">
						<h5 class="card-title">Special title treatment</h5>
						<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
					</div>
				</div>
				<!-- Ratings card --> 
			</div>
			
		</div>

		<!-- First Half -->

		<!-- Second Half -->
		<div class="col-md-6 h-md-100 overflow-auto" style="background: #35bdff;">
			<div class="d-md-flex h-100 text-center justify-content-center">
				<div class="logoarea py-5">
					<!-- Tweet cards -->
				<?php require_once('dynamichtml.php');?>
					<!-- Tweet cards -->
				</div>
			</div>
		</div>
		<!-- Second Half -->
		<!--===============================================================================-->
	</div>
</body>
</html>