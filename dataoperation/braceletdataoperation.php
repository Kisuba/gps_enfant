<?php
include './../models/bdmodel.php';
 include './../models/braceletmodel.php';

  $model = new Bracelet();
if($_POST['action'] == 'fetch'){	
	$rows = $model->fetch();
	$i = 1;
          if(!empty($rows)){
            foreach ($rows as $row) {
    
            $id = $row["id"];
            $idbrac = $row["id_bracelet"];
           
           // $long = $row["longitude"];;
            
            $data [] = array(
			'Id'=>$i++,
			'Bracelet'=>$idbrac,
			
			'Action'=>"<div class='dropdown'>
											<a class='btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle' href='#'' role='button' data-toggle='dropdown'>
												<i class='dw dw-more'></i>
											</a>
											<div class='dropdown-menu dropdown-menu-right dropdown-menu-icon-list'>
												
												<a class='dropdown-item' onclick='updatebrac($id)'><i class='dw dw-edit2'></i> Edit</a>
												<a class='dropdown-item' onclick='deletebrac($id)'><i class='dw dw-delete-3'></i> Delete</a>
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
}if($_POST['action'] === 'insert'){

 	$model->insert($_POST);
 }
 if($_POST['action'] === 'getbracbyid'){

 	echo $model->getbracbyid($_POST['id']);
}
if($_POST['action'] === 'update'){

 	$model->update($_POST);
}

if($_POST['action'] === 'delete'){

 	$model->delete($_POST);
}
?>
