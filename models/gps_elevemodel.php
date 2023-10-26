<?php
class Gps_eleve extends Bdmodel
	{
		
		    public function fetch()
            {
            	$data = null;

            	$query = "select g.id as id, b.id_bracelet as id_bracelet, g.id_eleve as id_eleve, e.nom as nom, e.postnom as postnom, e.prenom as prenom, e.adresse as adresse, e.photo as photo from gps_eleves g  
                    inner join eleves e on e.id = g.id_eleve  
                    inner join  bracelet b on b.id = g.id_bracelet 
                ";
                 if($result = $this->conn->query($query)){
                 	while($row = $result->fetch(PDO::FETCH_ASSOC)){
                 		$data[] = $row;
                 	}

                 }
                 return $data;
            }
            public function insert($data)
            { 
                //if (isset($_POST['ajoutprofondeur'])) {
                    // code...
                     
                    //if (isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['distance'])) {
                     // code...
                        
                        $eleve = $data['id_eleve'];
                        $bracelet = $data['id_bracelet'];

                        $query = "insert into gps_eleves (id_eleve,id_bracelet) values ('$eleve','$bracelet')";
                        if($result = $this->conn->query($query)){
        
                                                                                  
                        }else{
                            echo "<script>alert('echec');</script>";
                        }
                    //}
               // }

            }
            public function getgpselevebyid($id){
                 $query = "select * from gps_eleves where id = $id";
                 $result = $this->conn->query($query);
                 $row = $result->fetch(PDO::FETCH_ASSOC);
                 return json_encode($row);
            }
             public function delete($data)
            {
                
                    // code...
                     
                    
                     // code...
                        $id = $data['id'];
                       
                        $query = "delete from gps_eleves where id = $id";
                        if($result = $this->conn->query($query)){
                                                           
                        }else{
                            echo "<script>alert('echec');</script>";
                        }
                    
                

            }
            public function update($data)
            {
               

                     // code...
                        $id = $data['id'];

                        $bracelet = $data['bracelet'];
                       

                        $query = "update bracelet set id_bracelet = '$bracelet' where id = '$id'";
                        if($result = $this->conn->query($query)){
                            
                                                                                 
                        }else{
                            echo "<script>alert('echec');</script>";
                        }
                   
            }
    }
?>

