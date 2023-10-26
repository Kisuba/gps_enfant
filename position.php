<?php
session_start();

?>
<?php

if(!(isset($_SESSION['nom']))){
header("Location: login.php");
}

?>
<?php include'include/fonction.php';?>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Position</title>

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
	<link rel="stylesheet" type="text/css" href="src/plugins/jvectormap/jquery-jvectormap-2.0.3.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

	<link rel="stylesheet" type="text/css" href="leaflet/marker.css"/>
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
			<div class="loader-logo"><img src="eleve_photo/logo.png"  style="height:20%; width: 20%; text-align:center; margin-left:320px;" alt=""></div>
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
		<div class="xs-pd-20-10 pd-ltr-20">
			
			
			<div class="row">
				
				<div class="col-lg-12 col-md-12 col-sm-12 mb-30">
					<div class="card-box pd-30 pt-12 height-100-p">
						
						<div id="map" style="width:100%!important; height:600px">
							<div class="btn-group" id="dropdown" style="position: absolute;
			                top: 10px;
			                left: 60px;
			                z-index: 1000;
			                font-weight: 50px;
			                ">
							<button type="button" class="btn btn-primary btn-sm" id="btnitineraire" style="width: 220px;font-weight: 800;color: white; text-decoration: none;"  aria-expanded="false">
							<i class="fa fa-th-list"></i>
			                Les itinéraires
							</button>
						 </div>


						 <div class="col-sm-2" id="list_itineraire" style="position: absolute;
				background-color: white;
                top: 50px;
                left: 60px;
                z-index: 1000;
                font-weight: 600px;
				display:none;
                ">
                      <!-- checkbox -->
                      <div class="form-group">
					  </br>
					 
                   
                        <div class="custom-control custom-checkbox">
                        	<?php 
                   include './models/bdmodel.php';
									include './models/elevemodel.php';
										 $model = new Eleve();
										 	$rows = $model->fetch_elve_in_brac();
											
												  if(!empty($rows)){
													foreach ($rows as $row) {
											
													$id = $row["id"];
													$nom = $row["nom"];
												  
										?>

											<input class="custom-control-input" type="checkbox" onchange='trajet(this)' id="Aurel"/>
                          <label for="Aurel"  class="custom-control-label"><b><?php echo $nom ;?></b></label>
									
									<?php }} ?>

                        	
                          
                        </div>
                       
                      </div>
             			</div>

							<div class="leaflet-control map-coordinate" style=" 
                        color: black; 
                        position: absolute; 
                        bottom: 20px; 
                        left: 30px;
                        background-color: white;
                        border-radius: 0px;
                        font-size: 1em;
                        padding: 5px 15px;">
           
            				</div>
						</div>
					</div>
				</div>
			</div>
			
			
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/jQuery-Knob-master/jquery.knob.min.js"></script>
	<script src="src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
	<script src="src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
	<script src="src/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
	<script src="src/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="vendors/scripts/dashboard2.js"></script>
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
	<script src="./leaflet/Leaflet-MiniMap-master/src/Control.MiniMap.js"></script>
	<script src="leaflet/leaflet.js"></script>
	<script>
     var marker;
    
     //setInterval(() => {
        
       // if(marker){
          //  mymap.removeLayer(marker);
      //  }
  <?php  
  enfantitin();
  enfantpos();
  //enfantitin();

  departkm();

  arriver();
  ?>
 // var featuregroup = L.featureGroup([marker]).addTo(mymap).openPopup();
 // mymap.fitBounds(marker.getBounds());
  //console.log(featuregroup);
       //}, 5000);
  //calcule de la distance
  function distance(lat1, lon1, lat2, lon2) {
  const R = 6371; // Rayon de la Terre en km
  const dLat = (lat2 - lat1) * Math.PI / 180;
  const dLon = (lon2 - lon1) * Math.PI / 180;
  const a =
    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
    Math.sin(dLon / 2) * Math.sin(dLon / 2);
  const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  const distance = R * c;
  return distance;
}
//var departlon = -1.67683;var departlat = 29.2298;var arrivertlat = -1.67695;var arriverlon = 29.2299;
// Exemple d'utilisation :
const distance1 = distance(departlon, departlat, arrivertlat, arriverlon); // Distance entre Paris et Londres en km
console.log(distance1); // Affiche : 343.38
var distance2 = distance1.toString()+" "+"Km";
   var ligne;
  function trajet(checkbox) {
			  var checkboxes = document.querySelectorAll('input[type="checkbox"]');
			  //var distance2 = "1";
			  if (checkbox.checked) {
			  	ligne = L.polyline(itn_enfant, {color: 'green'}).bindPopup(distance2).addTo(mymap);

			  }else{
			  	ligne.remove();
			  	for (var i = 0; i < checkboxes.length; i++) {
				  checkboxes[i].disabled = false;
				}
			  }
			}
  
    </script>
</body>
</html>