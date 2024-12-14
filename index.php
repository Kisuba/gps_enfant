<?php
session_start();
//include './models/bdmodel.php';
 
?>
<?php

if(!(isset($_SESSION['nom']))){
header("Location: login");
}

?>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Acceuil</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
	
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- mini map -->
    <link rel="stylesheet" type="text/css" href="leaflet/Leaflet-MiniMap-master/src/Control.MiniMap.css" />

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="eleve_photo/logo.jpeg"  style="height:100%; width: 100%; text-align:center; " alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Chargement...
			</div>
		</div>
	</div>

	<?php include 'include/design/header.php';?>

	<?php include 'include/design/sidebar.php';?>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			
			<div class="row">
				<div class="col-xl-3 mb-30">
					<div class="card-box height-97-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								
								<img src="include/icons/User (1).png"/>
							</div>
							<div class="widget-data">
							<?php 
                   include './models/bdmodel.php';
									include './models/elevemodel.php';
										 $model = new Eleve();
										 	$rows = $model->fetch1();
											
												  if(!empty($rows)){
													foreach ($rows as $row) {
													
													$id = $row["id"];
													
												  
										?>
								<div class="h4 mb-0"><?php echo $id;?></div>
								<?php 					}
												}
								?>
								<div class="weight-600 font-14">Elèves</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-97-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
							<img src="include/icons/Analytics.png"/>
							</div>
							<div class="widget-data">
							<?php 
                  
									
										 $model = new Eleve();
										 	$rows = $model->bracelet();
											
												  if(!empty($rows)){
													foreach ($rows as $row) {
													
													$id = $row["id"];
													
												  
										?>
								<div class="h4 mb-0"><?php echo $id;?></div>
								<?php 					}
												}
								?>
								<div class="weight-600 font-14">Bracelet</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-97-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
							<img src="include/icons/User Circle.png"/>
							</div>
							<div class="widget-data">
							<?php 
                  
									
										 $model = new Eleve();
										 	$rows = $model->eleve_bracelet();
											
												  if(!empty($rows)){
													foreach ($rows as $row) {
													
													$id = $row["id"];
													
												  
										?>
								<div class="h4 mb-0"><?php echo $id;?></div>
								<?php 					}
												}
								?>
								<div class="weight-600 font-14">Bracelet / Elèves</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-97-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
							<img src="include/icons/approved-user.png"/>
							</div>
							<div class="widget-data">
							<?php 
                   
									
										 $model = new Eleve();
										 	$rows = $model->admin();
											
												  if(!empty($rows)){
													foreach ($rows as $row) {
													
													$id = $row["id"];
													
												  
										?>
							<div class="h4 mb-0"><?php echo $id;?></div>
							<?php 					}
												}
								?>
								<div class="weight-600 font-14">Utilisateurs</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 mb-30">
					<div class="card-box pd-30 pt-10 height-100-p">
						<h2></h2>
						<div id="map" style="width:100%!important; height:440px"></div>
				</div>
			</div>
			</div>
			
		<?php include 'include/design/footer.php';?>	
		</div>
	</div>
	<!-- js 
	 <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
					<div class="card-box pd-30 pt-12 height-100-p">
	 -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="vendors/scripts/dashboard.js"></script>

	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
	<script src="./leaflet/Leaflet-MiniMap-master/src/Control.MiniMap.js"></script>
	<script src="leaflet/leaflet.js"></script>

	<script>
		// Définir les coordonnées du marqueur
		var lat = -1.6797489;
		var long = 29.2168952;

		// Créer une icône personnalisée pour le marqueur
	var customIcon = L.icon({
		iconUrl: 'include/icons/school.png',
		iconSize: [32, 32], // Taille de l'icône en pixels
		//iconAnchor: [16, 32] // Point d'ancrage de l'icône
	});

		// Créer un marqueur avec les coordonnées spécifiées
		var marker = L.marker([lat, long], {icon: customIcon}).bindPopup("<h5>Complexe Scolaire Un Jour Nouveau</h5>").addTo(mymap).openPopup();

		toolltip = L.tooltip({permanent:true}).setContent("Complexe Scolaire Un Jour Nouveau");
		marker.bindTooltip(toolltip);

		var circle = L.circle([lat, long], {
			color: 'blue',
			fillColor: 'blue',
			fillOpacity: 0.2,
			radius: 500
		}).addTo(mymap);

		// Centrer la carte sur le marqueur
		mymap.setView([lat, long], 13);
	</script>
</body>
</html>