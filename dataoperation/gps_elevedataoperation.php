<?php
include './../models/bdmodel.php';
 include './../models/gps_elevemodel.php';

  $model = new Gps_eleve();
if($_POST['action'] == 'fetch'){	
	$rows = $model->fetch();
	$i = 1;
          if(!empty($rows)){
            foreach ($rows as $row) {
    
            $id = $row["id"];
            $idbrac = $row["id_bracelet"];
            $nom= $row["nom"];
			$postnom=$row["postnom"];
            $prenom =  $row["prenom"];
            $addr = $row["adresse"];
            $photo = $row["photo"];

			   $lat = $row["longs"];
           	   $long = $row["lat"];
           
			
            $data [] = array(
			'Id'=>$i++,
			'Bracelet'=>$idbrac,
			'Nom'=> $nom,
			'Postnom'=>$postnom,
			'Prenom'=>$prenom,
			'Adresse'=>$addr,
			'Photo'=>"<img style='width:60px; height: 60px; border-radius: 360px;' src='./eleve_photo/$photo'>",
			'Action'=>  "<div class='dropdown'>
											<a class='btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle' href='#' role='button' data-toggle='dropdown'>
												<i class='dw dw-more'></i>
											</a>
											<div class='dropdown-menu dropdown-menu-right dropdown-menu-icon-list'>
												
												
												<a class='dropdown-item' onclick='delete_eleve_gps($id)'><i class='dw dw-delete-3'></i> Delete</a>
										 	
												<a class='dropdown-item' onclick='voir_eleve_gps(\"$nom\",\"$postnom\",\"$prenom\",\"$photo\",$lat,$long)'><i class='dw dw-eye'></i> Voir</a>
											</div>
										</div>"
		); } 
	$response = array(
		"iTotalDisplayRecords" =>1,
		"aaData" => $data
	);
	echo json_encode($response);
	
	}
}

if($_POST['action'] == 'fetch2'){	
	$criteria1 = $_POST['criteria1'];
	$criteria2 = $_POST['criteria2'];
	$rows = $model->fetch2($criteria1,$criteria2);
	$i = 1;
          if(!empty($rows)){
            foreach ($rows as $row) {
              
            $idbrac = $row["bracelet"];
            $nom= $row["nom"];
			$postnom=$row["postnom"];
            $prenom =  $row["prenom"];
            $addr = $row["adresse"];
            $photo = $row["photo"];

			$lat1 = $row["latpr"];
			$lat2 = $row["latd"];

			$long1 = $row["longpr"];
			$long2 = $row["longd"];
           
			$distance = haversineGreatCircleDistance($lat2,$long2,$lat1,$long1);
           
			$data [] = array(
			
			'Photo'=>"<img style='width:60px; height: 60px; border-radius: 360px;' src='./eleve_photo/$photo'>",
			'Bracelet'=>$idbrac,
			'Nom'=> $nom,
			'Postnom'=>$postnom,
			'Prenom'=>$prenom,
			'Adresse'=>$addr,
			'Distance'=>rtrim(rtrim(number_format($distance, 5), '0'), '.') .' km',
			
		); } 
	$response = array(
		"iTotalDisplayRecords" =>1,
		"aaData" => $data
	);
	echo json_encode($response);
	
	}
}

if($_POST['action'] === 'insert'){

 	$model->insert($_POST);
 }
 if($_POST['action'] === 'getgpselevebyid'){

 	echo $model->getgpselevebyid($_POST['id']);
}
if($_POST['action'] === 'update'){

 	$model->update($_POST);
}

if($_POST['action'] === 'delete'){

 	$model->delete($_POST);
}

function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371) {
    // Conversion des degrés en radians
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    // Calcul des différences
    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    // Application de la formule de Haversine
    $a = sin($latDelta / 2) * sin($latDelta / 2) +
         cos($latFrom) * cos($latTo) *
         sin($lonDelta / 2) * sin($lonDelta / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    // Retourne la distance en kilomètres
    return $earthRadius * $c;
}
?>
