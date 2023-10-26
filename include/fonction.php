<?php 

			function enfantpos(){
				include 'dbwrite.php';

 				$sql = "select d.id as id, d.latitude as latitude, d.longitude as longitude, d.identBrac, 
 				e.nom as nom,e.postnom as postnom,e.prenom as prenom,e.adresse as adresse,e.photo as photo, gep.id_bracelet as id_bracelet,
 				gep.id_eleve as id_eleve
 				from gps_eleves gep 
 				inner join bracelet b on b.id = gep.id_bracelet 
 				inner join datagps d on d.identBrac = b.id_bracelet 
				inner join eleves e on e.id = gep.id_eleve 
 				where d.id in (select max(id) from datagps)";
                         $run_cats = mysqli_query($conn, $sql);
                                while ($row_cats = mysqli_fetch_array($run_cats)) {
                               
                                $long = $row_cats['longitude'];
                                $lat = $row_cats['latitude'];
                                $nom = $row_cats['nom'];
                                $postnom = $row_cats['postnom'];
                                $prenom = $row_cats['prenom'];
                                $adresse = $row_cats['adresse'];
                                $photo = $row_cats['photo'];
                               $rows[] = array(
					                
					                "lat" => $lat,
					                "long" => $long,
					                "nom" => $nom,
					                "postnom" => $postnom,
					                "prenom" => $prenom,
					                "adresse" => $adresse,
					                "photo" => $photo			                
					            );

                                echo "var pos_enfant = ";
						        echo json_encode($rows, JSON_NUMERIC_CHECK);
						        echo";\n";
						        echo
						        '
						        for(var i=0; i < pos_enfant.length; i++){
						             marker = L.marker([pos_enfant[i].long, pos_enfant[i].lat]).bindPopup("<h4>Eleves</h4>" + "<p>Nom : "+ "<b>" +pos_enfant[i].nom+"</b>"+ "</br>"+"Postnom : </b>"+"<b>"+pos_enfant[i].postnom+"</b>"+"</br>"+"Prenom : "+"<b>"+pos_enfant[i].prenom+"</b>"+"</br>"+"Adresse : "+"<b>"+pos_enfant[i].adresse+"</b>"+"</p></br><img style= width:200px; height: 50px; src=./eleve_photo/"+pos_enfant[i].photo+">").addTo(mymap).openPopup();
						        }
						        '; 
                             }
             }

             function enfantitin(){
				include 'dbwrite.php';
				
 				$sql = "select d.id as id, d.latitude as latitude, d.longitude as longitude, d.identBrac, 
 				e.nom as nom,e.postnom as postnom,e.prenom as prenom,e.adresse as adresse,e.photo as photo 
 				from datagps d 
 				inner join bracelet b on b.id_bracelet = d.identBrac 
 				inner join gps_eleves g on g.id_bracelet = b.id
				inner join eleves e on e.id = g.id_eleve
 				";
                         $run_cats = mysqli_query($conn, $sql);
                                while ($row_cats = mysqli_fetch_array($run_cats)) {
                               
                                $long = $row_cats['longitude'];
                                $lat = $row_cats['latitude'];
                                $nom = $row_cats['nom'];
                                $postnom = $row_cats['postnom'];
                                $prenom = $row_cats['prenom'];
                                $adresse = $row_cats['adresse'];
                                $photo = $row_cats['photo'];
                               $rows[] = array(
					                $long, 
					               $lat,
					              
					               			                
					            );

                                echo "var itn_enfant = ";
						        echo json_encode($rows, JSON_NUMERIC_CHECK);
						        echo";\n";
						       ; 
                             }
             }

             function departkm(){
             	              include 'dbwrite.php';
             	              $sql = "select latitude, longitude from datagps where id in (select min(id) from datagps)";
             	              $run_cats = mysqli_query($conn, $sql);
                                while ($row_cats = mysqli_fetch_array($run_cats)) {
                                	$long = $row_cats['longitude'];
                                	$lat = $row_cats['latitude'];
                                }

                                echo "var departlon = ".$long.";";

                                echo "var departlat = ".$lat.";"; 
             }
              function arriver(){
             	              include 'dbwrite.php';
             	              $sql = "select latitude, longitude from datagps where id in (select max(id) from datagps)";
             	              $run_cats = mysqli_query($conn, $sql);
                                while ($row_cats = mysqli_fetch_array($run_cats)) {
                                	$long = $row_cats['longitude'];
                                	$lat = $row_cats['latitude'];
                                }
                                echo "var arrivertlat = ".$long.";";
                                echo "var arriverlon = ".$lat.";";
             }
            
?>
