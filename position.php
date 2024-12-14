<?php
session_start();

?>
<?php

if(!(isset($_SESSION['nom']))){
header("Location: login");
}

?>
<?php include 'include/fonction.php';?>
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
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
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
			<div class="loader-logo"><img src="eleve_photo/logo.jpeg"   style="height:100%; width: 100%; text-align:center; " alt=""></div>
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
							<button type="button" class="btn btn-primary btn-sm" id="btnitineraire" style="width: 80px;font-weight: 800;color: white; text-decoration: none;"  aria-expanded="false">
							<!--<i class="fa fa-th-list"></i>-->
			                <img src="include/icons/business-man_8442067.png" alt="icon" />
							</button>
						 </div>

						 <div class="btn-group" id="dropdown" style="position: absolute;
			                top: 10px;
			                left: 150px;
			                z-index: 1000;
			                font-weight: 50px;
			                ">
							<button type="button" class="btn btn-primary btn-sm" onclick="btnkm()" style="width: 80px;font-weight: 800;color: white; text-decoration: none;"  aria-expanded="false">
							<!--<i class="fa fa-th-list"></i>-->
			                <img src="include/icons/route_15532938.png" alt="icon" />
							</button>
						 </div>


						 <div class="col-sm-2" id="list_itineraire" style="position: absolute;
				background-color: white;
                top: 96px;
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
													$bracelet = $row["bracelet"];
													$nom = $row["nom"];
												  
										?>
						<div class="custom-control custom-checkbox">
						<input class="custom-control-input" type="checkbox" onchange='trajet(this, "<?php echo $bracelet ;?>")' id="<?php echo $bracelet; ?>"/>
                        <label for="<?php echo $bracelet; ?>"  class="custom-control-label"><b><?php echo $nom ;?></b></label>
						</div>
													
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
			
			<?php include 'include/design/footer.php';?>
		</div>
	</div>
	<?php

  include "./include/modals/modalkm.php";
  
   ?>

	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	
	<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>

	<script src="src/plugins/jQuery-Knob-master/jquery.knob.min.js"></script>
	<script src="src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
	<script src="src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
	<script src="src/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
	<script src="src/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="vendors/scripts/dashboard2.js"></script>
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
	<script src="./leaflet/Leaflet-MiniMap-master/src/Control.MiniMap.js"></script>
	<script src="leaflet/leaflet.js"></script>

	<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="src/plugins/datatables/js/vfs_fonts.js"></script>
	<script src="vendors/scripts/datatable-setting.js"></script>
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
	
		function trajet(checkbox, itn) {
		var checkboxes = document.querySelectorAll('input[type="checkbox"]');
		//var distance2 = "1"; // Peut-être que vous voulez récupérer cette valeur d'une autre source
		
		if (checkbox.checked) {

			//desactiver tous les autres checkbox
			for (var i = 0; i < checkboxes.length; i++) {
					if (checkboxes[i] !== checkbox) {
						checkboxes[i].disabled = true;
					}
				}

				var tb2 = [];
				for (var i=0; i<itineraire.length; i++) {
				  if (itineraire[i].includes(itn)) {
					tb2.push(itineraire[i]);
				  }
				}
				//console.log(tb2);
				
				var tb3 = [];
				for (var i = 0; i < tb2.length; i++) {
				  var lastTwo = tb2[i].slice(-2);
				  tb3.push(lastTwo);
				}	

			ligne = L.polyline(tb3, {color: 'green'}).bindPopup(distance2).addTo(mymap);
		} else {
			ligne.remove();
		for (var i = 0; i < checkboxes.length; i++) {
					checkboxes[i].disabled = false;
					}
		}
		}

	function btnkm(){
		$('#bd-example-modal-lg1').modal('show');
	}

	
	
    </script>

	
<script>

$(document).ready(function(){

	
    datatypeeleve();
	
    

});
function datatypeeleve(){
        var myVariable = 'fetch2';
		var selectedCriteria1 = $('#datetime1').val(); 
		var selectedCriteria2 = $('#datetime2').val(); 

        var tableprofondeur = $('#table_eleve1').DataTable({
             "responsive": true, "lengthChange": false, "autoWidth": false,
              "destroy":true,
                "searching": true,
                dom: 'Bfrtip',
        buttons: [
            //"pdf", "print"
        ],
        
              "ajax":{
                  
                  url: 'dataoperation/gps_elevedataoperation.php',
                  type: 'POST',
                  data: {action: myVariable, criteria1:selectedCriteria1, criteria2:selectedCriteria2},
                  "error": function (xhr, error, thrown) {
        if(xhr.status == 404) {
          $('#example').html('<p>Aucune donnée trouvée</p>');
        }
      }
    
                  
              },
              columns:[


             
			  {data:'Photo'},
              {data:'Bracelet'},
              {data:'Nom'},
              {data:'Postnom'},
              {data:'Prenom'},
              {data:'Adresse'},
              {data:'Distance'},
			
              ],
              "language": {
      "zeroRecords": "Aucune donnée trouvée"
    }

        } );
		$('#datetime1').val('');
		$('#datetime2').val('');  
} 
  
    </script>

<style>
	div.flex-wrap{
		position:relative;
		float: left;
		margin-left: 10px;
	}
</style>
</body>
</html>