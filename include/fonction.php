<?php 

			function enfantpos(){
				include 'dbwrite.php';

 				$sql = "select d.id as id, d.latitude as latitude, d.longitude as longitude, d.identBrac, e.nom as nom,e.postnom as postnom,
				e.prenom as prenom,e.adresse as adresse,e.photo as photo, gep.id_bracelet as id_bracelet, gep.id_eleve as id_eleve 
				from gps_eleves gep 
				inner join bracelet b on b.id = gep.id_bracelet 
				inner join datagps d on d.identBrac = b.id_bracelet 
				inner join eleves e on e.id = gep.id_eleve 
				where d.reading_time in (select max(reading_time) as date_enreg from datagps GROUP by identBrac)";
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
									toolltip = L.tooltip({permanent:true}).setContent(pos_enfant[i].nom +"  "+pos_enfant[i].postnom);
									marker.bindTooltip(toolltip);
								}
						        '; 

								
                             }
             }

             function enfantitin(){
				include 'dbwrite.php';
				
 				$sql = "select e.id as ident, d.id as id, d.latitude as latitude, d.longitude as longitude, d.identBrac as bracelet, 
 				e.nom as nom,e.postnom as postnom,e.prenom as prenom,e.adresse as adresse,e.photo as photo 
 				from datagps d 
 				inner join bracelet b on b.id_bracelet = d.identBrac 
 				inner join gps_eleves g on g.id_bracelet = b.id
				inner join eleves e on e.id = g.id_eleve
 				";
                         $run_cats = mysqli_query($conn, $sql);
                                while ($row_cats = mysqli_fetch_array($run_cats)) {
                                $id = $row_cats['ident'];
								$bracelet = $row_cats['bracelet'];
                                $long = $row_cats['longitude'];
                                $lat = $row_cats['latitude'];
                                $nom = $row_cats['nom'];
                                $postnom = $row_cats['postnom'];
                                $prenom = $row_cats['prenom'];
                                $adresse = $row_cats['adresse'];
                                $photo = $row_cats['photo'];
                               $rows[] = array(
									$bracelet, 
					                $long, 
					               	$lat
					              
					               			                
					            );

                                echo "var itineraire = ";
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

			 /*
			select e.id as id, e.nom as nom, brac.id_bracelet as bracelet, dt.id as ident, dt.latitude, dt.longitude from eleves e inner join gps_eleves g on g.id_eleve = e.id inner join bracelet brac on brac.id = g.id_bracelet inner join datagps dt on dt.identBrac = brac.id_bracelet where dt.id in (select min(id) from datagps) or (select min(id) from datagps)GROUP by dt.identBrac 
			
			SELECT (SELECT latitude FROM datagps ORDER BY id asc LIMIT 1) AS min_lat,(SELECT longitude FROM datagps ORDER BY id asc LIMIT 1) AS min_long, (SELECT latitude FROM datagps ORDER BY id DESC LIMIT 1) AS max_lat,(SELECT longitude FROM datagps ORDER BY id DESC LIMIT 1 ) AS max_long, identBrac from datagps group by identBrac;
			 */
?>



