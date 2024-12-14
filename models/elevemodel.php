<?php

class Eleve extends Bdmodel
	{

		    public function fetch()
            {
            	$data = null;

            	$query = "select * from eleves order by id asc";
                 if($result = $this->conn->query($query)){
                 	while($row = $result->fetch(PDO::FETCH_ASSOC)){
                 		$data[] = $row;
                 	}

                 }
                 return $data;
            }

            public function fetch_elve_in_brac(){
                 $data = null;

                $query = "select e.id as id, e.nom as nom, brac.id_bracelet as bracelet from eleves e inner join gps_eleves g on g.id_eleve = e.id inner join bracelet brac on brac.id = g.id_bracelet where brac.id_bracelet in (select identBrac from datagps)";
                 if($result = $this->conn->query($query)){
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $data[] = $row;
                    }

                 }
                 return $data;
            }

            public function fetch_eleve_brac()
            {

                $data = null;

                $query = "select * from eleves where id not in (select id_eleve from gps_eleves)";
                 if($result = $this->conn->query($query)){
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $data[] = $row;
                    }

                 }
                 return $data;

            }
            public function insert($nom, $postnom, $prenom, $adresse, $image)
            { 
                   // code...
                        $query = "insert into eleves (nom, postnom, prenom, adresse, photo) values ('$nom', '$postnom', '$prenom', '$adresse', '$image')";
                        if($result = $this->conn->query($query)){
        
                                                                                  
                        }else{
                            echo "<script>alert('echec');</script>";
                        }
                    //}
               // }

            }
            //update
            public function remove_photo($id){
                $query = "select photo from eleves where id = '$id'";
                              
                if($result = $this->conn->query($query)){
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $old_image = $row['photo'];

                        $old_image_path = "../eleve_photo/$old_image";
                        if (file_exists($old_image_path)) {
                            unlink($old_image_path); // Supprime le fichier
                        }
                    }

                 }
		 // Étape 2: Supprimer l'ancienne image si elle existe
                
	
	        }
            
             public function update($id,$nom,$postnom,$prenom,$adresse,$image)
            { 
                if($image != '')
                {

                         $query = "update eleves set nom = '$nom', postnom='$postnom', prenom='$prenom', adresse='$adresse', photo = '$image' where id = '$id'";
                
                        if($result = $this->conn->query($query)){
                                                                                  
                        }else{
                            echo "<script>alert('echec');</script>";
                        }
                }else{
                    
                        $query = "update eleves set nom = '$nom', postnom='$postnom', prenom='$prenom', adresse='$adresse' where id = '$id'";
                
                        if($result = $this->conn->query($query)){
                                                                                  
                        }else{
                            echo "<script>alert('echec');</script>";
                        }
                }
                   
            }

            public function getelevebyid($id){

                 $query = "select * from eleves where id = $id";
                 $result = $this->conn->query($query);
                 $row = $result->fetch(PDO::FETCH_ASSOC);
                 return json_encode($row);
            }
            public function delete($data)
            {
                
                    // code...
                     
                    
                     // code...
                        $id = $data['id'];
                       
                        $query = "delete from eleves where id = $id";
                        if($result = $this->conn->query($query)){
                                                           
                        }else{
                            echo "<script>alert('echec');</script>";
                        }
                    
                

            }
            public function fetch1(){
                $data = null;

            	$query = "select count(*) as id from eleves order by id asc";
                 if($result = $this->conn->query($query)){
                 	while($row = $result->fetch(PDO::FETCH_ASSOC)){
                 		$data[] = $row;
                 	}

                 }
                 return $data;
            }

            public function bracelet(){
                $data = null;

            	$query = "select count(*) as id from bracelet order by id asc";
                 if($result = $this->conn->query($query)){
                 	while($row = $result->fetch(PDO::FETCH_ASSOC)){
                 		$data[] = $row;
                 	}

                 }
                 return $data;
            }

            public function eleve_bracelet(){
                $data = null;

            	$query = "select count(*) as id from gps_eleves order by id asc";
                 if($result = $this->conn->query($query)){
                 	while($row = $result->fetch(PDO::FETCH_ASSOC)){
                 		$data[] = $row;
                 	}

                 }
                 return $data;
            }

            public function admin(){
                $data = null;

            	$query = "select count(*) as id from admin order by id asc";
                 if($result = $this->conn->query($query)){
                 	while($row = $result->fetch(PDO::FETCH_ASSOC)){
                 		$data[] = $row;
                 	}

                 }
                 return $data;
            }
    }
   
?>
