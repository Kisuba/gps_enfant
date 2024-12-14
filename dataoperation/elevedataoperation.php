<?php
include './../models/bdmodel.php';
 include './../models/elevemodel.php';

  $model = new Eleve();
if($_POST['action'] == 'fetch'){	
	$rows = $model->fetch();
	$i = 1;
          if(!empty($rows)){
            foreach ($rows as $row) {
    
            $id = $row["id"];
            $nom=$row["nom"];
			$postnom=$row["postnom"];
            $prenom =  $row["prenom"];
            $addr = $row["adresse"];
            $photo = $row["photo"];
           // $long = $row["longitude"];;
            
            $data [] = array(
			'Id'=>$i++,
			'Nom'=> $nom,
			'Postnom'=>$postnom,
			'Prenom'=>$prenom,
			'Adresse'=>$addr,
			'Photo'=>"<img style='width:60px; height: 60px; border-radius: 360px;' src='./eleve_photo/$photo'>",
			'Action'=>"<div class='dropdown'>
											<a class='btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle' href='#'' role='button' data-toggle='dropdown'>
												<i class='dw dw-more'></i>
											</a>
											<div class='dropdown-menu dropdown-menu-right dropdown-menu-icon-list'>
												
												<a class='dropdown-item' onclick='updateeleve($id)'><i class='dw dw-edit2'></i> Edit</a>
												<a class='dropdown-item' onclick='deleteeleve($id)'><i class='dw dw-delete-3'></i> Delete</a>
											</div>
										</div>"
		); 
			}
	 
			
	$response = array(
		"iTotalDisplayRecords" =>1,
		"aaData" => $data
	);
	echo json_encode($response);
	}
}

if($_POST['action'] == 'insert'){
	
	 $nom = $_POST['nom'];
	 $postnom = $_POST['postnom'];
	 $prenom = $_POST['prenom'];

	 $adresse = htmlspecialchars($_POST['adresse']);
	
	 $image=$_FILES['photo']['name'];
     $image_tmp=$_FILES['photo']['tmp_name'];

  move_uploaded_file($image_tmp, "../eleve_photo/$image");
 	$model->insert($nom, $postnom, $prenom, $adresse, $image);
	}

if($_POST['action'] === 'getelevebyid'){
 	echo $model->getelevebyid($_POST['id']);
}

if($_POST['action'] === 'delete'){
	$model->remove_photo($id);
 	$model->delete($_POST);
}

if($_POST['action'] == 'update'){

	$id = $_POST['l_id'];
	$nom = $_POST['l_nom'];
	$postnom = $_POST['l_postnom'];
	$prenom = $_POST['l_prenom'];
	$adresse = $_POST['l_adresse'];
	
	if(!empty($_FILES['new_photo']['name'])){
	 // Étape 1: Récupérer le nom de l'ancienne image
	 $model->remove_photo($id);
	 

	$image = $_FILES['new_photo']['name'];
	$image_tmp=$_FILES['new_photo']['tmp_name'];

  	move_uploaded_file($image_tmp, "../eleve_photo/$image");
 	$model->update($id,$nom,$postnom,$prenom,$adresse,$image);
	} else{
	
	$image = '';  	
 	$model->update($id,$nom,$postnom,$prenom,$adresse,$image);
	}
}

?>
