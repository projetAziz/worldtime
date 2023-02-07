<!DOCTYPE html>
<html lang="zxx">

<head>
	<!-- Required meta tags -->
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>World Time</title>
	<!-- plugin css for this page -->
	<link rel="stylesheet" href="./assets/vendors/mdi/css/materialdesignicons.min.css" />
	<link rel="stylesheet" href="./assets/vendors/aos/dist/aos.css/aos.css" />
	<!-- End plugin css for this page -->
	<link rel="shortcut icon" href="./assets/images/favicon.png" />
	<!-- inject:css -->
	<link rel="stylesheet" href="./assets/css/style.css">
	<!-- endinject -->
</head>

<body>
	<div class="container-scroller">
		<header id="header">
			<div class="container">
				<!-- partial:../partials/_navbar.html -->
				<?php
				include("./partials/_navbar.php");
				?>
				<!-- partial -->
			</div>
		</header>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="error-wrap">
						<div class="error-title">
							404 • Page not found
						</div>
						<p class="fs-15">
							Oops! La page que vous recherchez n'existe pas. Il pourrait avoir
							été déplacé ou supprimé. Essayez une recherche ci-dessous...
						</p>

						<div class="search-container">
							<input type="text" placeholder="Search.." name="search" />
							<button type="submit"><i class="mdi mdi-magnify"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- container-scroller ends -->
	<!-- partial:../partials/_footer.html -->

	<?php
	include("./partials/_footer.php");
	?>
	<!-- partial -->
	<!-- inject:js -->
	<script src="./assets/vendors/js/vendor.bundle.base.js"></script>
	<!-- endinject -->
	<!-- plugin js for this page -->

	<script src="./assets/vendors/aos/dist/aos.js/aos.js"></script>
	<!-- End plugin js for this page -->
	<!-- Custom js for this page-->
	<script src="./assets/js/demo.js"></script>
	<script src="./assets/js/jquery.easeScroll.js"></script>
	<script src="./assets/js/jquery.easeScroll.js"></script>
	<!-- End custom js for this page-->
</body>

</html>