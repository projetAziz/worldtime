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

<?php
/* API en ligne  */
$query = "politique";
$url = "https://newsapi.org/v2/everything?q=" . $query . "&apiKey=8e80651582684281be84964dfd220965&language=fr";
include("./function_curl.php");
$jsonPolitique = loadJson($url);


/* json local 
$url = "./json/politique.json";
$jsonPolitique = file_get_contents($url);
*/
$jsonPolitiqueDecode = json_decode($jsonPolitique, true);
$articlesPolitique = $jsonPolitiqueDecode["articles"];
?>

<body>
	<div class="container-scroller">
		<div class="main-panel">
			<!-- partial:../partials/_navbar.html -->
			<?php
			include("./partials/_navbar.php");
			?>
			<!-- partial -->
			<div class="flash-news-banner">
				<div class="container">
					<div class="d-lg-flex align-items-center justify-content-between">
						<div class="d-flex align-items-center">
							<span class="badge badge-dark mr-3">Source </span>
							<p class="mb-0">
								<?php
								echo $articlesPolitique[0]["source"]["name"];
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
					<div class="col-sm-12">
						<div class="card" data-aos="fade-up">

							<!-- pagination -->
							<span class="pagination">

								<?php
								$nbResultats = count($articlesPolitique);
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
									<li style=" margin-right:640px; padding:10px; background-color:lightBlue;border-radius: 15px 50px ">
										<a href="./politique.php?page=<?php echo $page - 1 ?>">
											<< Page Précente <?php echo ($page - 1) ?> </a>
									</li>
									<?php } ?>
									<?php if ($y < $nbResultats - 5) { ?>
									<li style="padding:10px; background-color:lightBlue;border-radius: 15px 50px ">
										<a href="politique.php?page=<?php echo $page + 1 ?>">
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
								<div class="row">
									<div class="col-sm-12">
										<h1 class="font-weight-600 mb-4">
											Politique
										</h1>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-8">
										<?php
										for ($i = $y; $i < ($y + 5); $i++) {
											if ($articlesPolitique[$i]['urlToImage'] == null) {
												$articlesPolitique[$i]['urlToImage'] = "./assets/images/image-not-found.png";
											}
										?>
										<div class="row">
											<div class="col-sm-4 grid-margin">
												<div class="rotate-img">
													<a href="<?php echo $articlesPolitique[$i]['url'] ?>" style="color: black;">
														<img src="<?php echo $articlesPolitique[$i]['urlToImage'] ?>" alt="banner"
															class="img-fluid" />
													</a>
												</div>
											</div>
											<div class="col-sm-8 grid-margin">
												<a href="<?php echo $articlesPolitique[$i]['url'] ?>" style="color: black;">
													<h2 class="font-weight-600 mb-2">
														<?php echo $articlesPolitique[$i]['title'] ?>
													</h2>
												</a>
												<p class="fs-13 text-muted mb-0">
													<span class="mr-2">Date </span>

													<?php
														$date = $articlesPolitique[$i]['publishedAt'];
														$date = substr($date, 0, 10);
														echo $date; ?>
												</p>
												<p class="fs-15">

													<?php echo $articlesPolitique[$i]['description'] ?>
												</p>
											</div>
										</div>
										<?php
										}
										?>
									</div>
									<div class="col-lg-4">
										<h2 class="mb-4 text-primary font-weight-600">
											Dernières nouvelles
										</h2>
										<?php
										for ($i = 8; $i < 11; $i++) {
											if ($articlesPolitique[$i]['urlToImage'] == null) {
												$articlesPolitique[$i]['urlToImage'] = "./assets/images/image-not-found.png";
											}
										?>
										<div class="row">
											<div class="col-sm-12">
												<div class="border-bottom pb-4 pt-4">
													<div class="row">
														<div class="col-sm-8">
															<a href="<?php echo $articlesPolitique[$i]['url'] ?>" style="color: black;">
																<h5 class="font-weight-600 mb-1">
																	<?php echo $articlesPolitique[$i]['title'] ?>
																</h5>
															</a>
															<p class="fs-13 text-muted mb-0">
																<span class="mr-2">Date </span>
																<?php
																	$date = $articlesPolitique[$i]['publishedAt'];
																	$date = substr($date, 0, 10);
																	echo $date; ?>
															</p>
														</div>
														<div class="col-sm-4">
															<div class="rotate-img">
																<a href="<?php echo $articlesPolitique[$i]['url'] ?>" style="color: black;">
																	<img src="<?php echo $articlesPolitique[$i]['urlToImage'] ?>" alt="banner"
																		class="img-fluid" />
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<?php
										}
										?>
										<div class="trending">
											<h2 class="mb-4 text-primary font-weight-600">
												Tendance
											</h2>
											<?php
											for ($i = 11; $i < 13; $i++) {
												if ($articlesPolitique[$i]['urlToImage'] == null) {
													$articlesPolitique[$i]['urlToImage'] = "./assets/images/image-not-found.png";
												}
											?>
											<div class="mb-4">
												<div class="rotate-img">
													<a href="<?php echo $articlesPolitique[$i]['url'] ?>" style="color: black;">
														<img src="<?php echo $articlesPolitique[$i]['urlToImage'] ?>" alt="banner"
															class="img-fluid" />
													</a>
												</div>
												<h3 class="mt-3 font-weight-600">
													<?php echo $articlesPolitique[$i]['title'] ?>
												</h3>
												<p class="fs-13 text-muted mb-0">
													<span class="mr-2">date </span>
													<?php
														$date = $articlesPolitique[$i]['publishedAt'];
														$date = substr($date, 0, 10);
														echo $date; ?>
												</p>
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
				</div>
			</div>
			<!-- main-panel ends -->

			<!-- container-scroller ends -->

			<!-- partial:../partials/_footer.html -->
			<?php
			include("./partials/_footer.php");
			?>
			<!-- partial -->
		</div>
	</div>
	<!-- inject:js -->
	<script src="./assets/vendors/js/vendor.bundle.base.js"></script>
	<!-- endinject -->
	<!-- plugin js for this page -->

	<script src="./assets/vendors/aos/dist/aos.js/aos.js"></script>
	<!-- End plugin js for this page -->
	<!-- Custom js for this page-->
	<script src="./assets/js/demo.js"></script>
	<script src="./assets/js/jquery.easeScroll.js"></script>
	<!-- End custom js for this page-->
</body>

</html>