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

	<!-- End plugin css for this page -->
	<link rel="shortcut icon" href="./assets/images/favicon.png" />

	<!-- inject:css -->
	<link rel="stylesheet" href="./assets/css/style.css">
	<!-- endinject -->
</head>

<?php
/* API en ligne  */
$query = "nouvelles";
$url = "https://newsapi.org/v2/everything?q=" . $query . "&apiKey=8e80651582684281be84964dfd220965&language=fr";
include("./function_curl.php");
$json = loadJson($url);


/* json local 
$url = "./json/nouvelles.json";
$json = file_get_contents($url);
*/
$jsonDecode = json_decode($json, true);
$articles = $jsonDecode["articles"];

?>

<body>
	<div class="container-scroller">
		<div class="main-panel">
			<?php
			include("./partials/_navbar.php");
			?>
			<div class="flash-news-banner">
				<div class="container">
					<div class="d-lg-flex align-items-center justify-content-between">
						<div class="d-flex align-items-center">
							<span class="badge badge-dark mr-3">Source </span>
							<p class="mb-0">
								<?php
								echo $articles[0]["source"]["name"];
								?>
							</p>
						</div>
						<div class="d-flex">
							<span class="mr-3 text-danger">
								<?php
								$date = new DateTime("now", new DateTimeZone('America/New_York'));
								echo $date->format('Y-m-d H:i:s');
								?>
							</span>
							<span class="text-danger">Quebec</span>
						</div>
					</div>
				</div>
			</div>
			<div class="content-wrapper">
				<div class="container">
					<div class="row" data-aos="fade-up">
						<div class="col-xl-8 stretch-card grid-margin">
							<div class="position-relative">

								<a href="<?php echo $articles[1]['url'] ?>">
									<img style="height: 500px; opacity:0.4;" src="<?php echo $articles[1]['urlToImage'] ?>" alt="banner"
										class="img-fluid" />
								</a>
								<div class="banner-content">
									<div class="badge badge-danger fs-12 font-weight-bold mb-3">
										nouvelles mondiales
									</div>
									<a href="<?php echo $articles[1]['url'] ?>" style="color: white;">
										<h1 class="mb-0">
											<?php
											echo substr($articles[1]["title"], 0, 50) . "...";
											?></h1>
									</a>
									<div class="fs-12">
										<span class="mr-2">Date </span>
										<?php
										$date = $articles[1]['publishedAt'];
										$date = substr($date, 0, 10);
										echo $date; ?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 stretch-card grid-margin">
							<div class="card bg-dark text-white">
								<div class="card-body">
									<h2>Dernières nouvelles</h2>

									<?php
									for ($i = 2; $i < 5; $i++) {
										if ($articles[$i]['urlToImage'] == null) {
											$articles[$i]['urlToImage'] = "./assets/images/image-not-found.png";
										}
									?>
									<div class="d-flex border-bottom-blue pt-3 pb-4 align-items-center justify-content-between">
										<div class="pr-3">
											<a href="<?php echo $articles[$i]['url'] ?>" style="color: white;">
												<h5>
													<?php
														echo substr($articles[$i]["title"], 0, 30) . "...";
														?></h5>
											</a>
											<div class="fs-12">
												<span class="mr-2">Date </span>
												<?php
													$date = $articles[$i]['publishedAt'];
													$date = substr($date, 0, 10);
													echo $date; ?>
											</div>
										</div>
										<div class="rotate-img">
											<a href="<?php echo $articles[$i]['url'] ?>">
												<img src="<?php echo $articles[$i]['urlToImage'] ?>" alt="thumb" class="img-fluid img-lg" />
											</a>
										</div>
									</div>
									<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="row" data-aos="fade-up">
						<?php
						include("./partials/_categories.php");
						?>
						<div class="col-lg-9 stretch-card grid-margin">
							<div class="card">

								<!-- pagination -->
								<span class="pagination">

									<?php
									$nbResultats = count($articles);
									$y = 4;

									/** Gestion des pages */
									if ((isset($_REQUEST['page'])) && (!empty($_REQUEST['page']))) {
										$page = $_GET['page'];
									} else {
										$page = 1;
									}
									?>
									<ul style="display:flex; font-size:20px; list-style: none;">
										<?php if ($page > 1) {
											$y = ($page * 2) + 1;
										?>
										<li style=" margin-right:385px; padding:10px; background-color:lightBlue;border-radius: 15px 50px ">
											<a href="./accueil.php?page=<?php echo $page - 1 ?>">
												<< Page Précente <?php echo ($page - 1) ?> </a>
										</li>
										<?php } ?>

										<?php if ($y < $nbResultats - 5) { ?>
										<li style="padding:10px; background-color:lightBlue;border-radius: 15px 50px ">
											<a href="accueil.php?page=<?php echo $page + 1 ?>">
												Page Suivante
												<?php echo ($page + 1) ?> >>
											</a>
										</li>
										<?php } ?>
									</ul>
									<hr>

									<?php $lastPage = floor($nbResultats / 6);
									?>

								</span>
								<!--end pagination -->
								<div class="card-body">
									<div class="card-body">
										<?php
										for ($i = $y; $i < ($y + 4); $i++) {
											if ($articles[$i]['urlToImage'] == null) {
												$articles[$i]['urlToImage'] = "./assets/images/image-not-found.png";
											}
										?>
										<div class="row">
											<div class="col-sm-4 grid-margin">
												<div class="position-relative">
													<div class="rotate-img">
														<a href="<?php echo $articles[$i]['url'] ?>">
															<img src="<?php echo $articles[$i]['urlToImage'] ?>" alt="thumb" class="img-fluid" />
														</a>
													</div>
													<div class="badge-positioned">
														<span class="badge badge-danger font-weight-bold">
															<?php
																if ($articles[$i]["author"] == null) {
																	$articles[$i]["author"] = "Nouvelle";
																}
																echo substr($articles[$i]["author"], 0, 20);
																?>
														</span>
													</div>
												</div>
											</div>
											<div class="col-sm-8  grid-margin">
												<a href="<?php echo $articles[$i]['url'] ?>" style="color: black;">
													<h2 class="mb-2 font-weight-600">
														<?php
															echo substr($articles[$i]["title"], 0, 70) . "...";
															?>
													</h2>
												</a>
												<div class="fs-13 mb-2">
													<span class="mr-2">Date </span>
													<?php
														$date = $articles[$i]['publishedAt'];
														$date = substr($date, 0, 10);
														echo $date; ?>
												</div>
												<p class="mb-0">
													<?php
														echo substr($articles[$i]["description"], 0, 100) . "...";
														?>
												</p>
											</div>
										</div>
										<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- main-panel ends -->
				<!-- container-scroller ends -->

			</div>
			<!-- partial:partials/_footer.html -->
			<?php
			include("./partials/_footer.php");
			?>
		</div>
	</div>
	<!-- inject:js -->
	<script src="assets/vendors/js/vendor.bundle.base.js"></script>
	<!-- endinject -->
	<!-- plugin js for this page -->
	<script src="assets/vendors/aos/dist/aos.js/aos.js"></script>
	<!-- End plugin js for this page -->
	<!-- Custom js for this page-->
	<script src="./assets/js/demo.js"></script>
	<script src="./assets/js/jquery.easeScroll.js"></script>
	<!-- End custom js for this page-->
</body>

</html>