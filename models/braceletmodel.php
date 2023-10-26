<?php
class Bracelet extends Bdmodel
	{
		
		    public function fetch()
            {
            	$data = null;

            	$query = "select * from bracelet";
                 if($result = $this->conn->query($query)){
                 	while($row = $result->fetch(PDO::FETCH_ASSOC)){
                 		$data[] = $row;
                 	}

                 }
                 return $data;
            }

            public function fetch_brac_eleve()
            {
                $data = null;

                $query = "select id, id_bracelet from bracelet where id not in (select id_bracelet from gps_eleves)";
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
                        
                        
                        $bracelet = $data['bracelet'];

                        $query = "insert into bracelet (id_bracelet) values ('$bracelet')";
                        if($result = $this->conn->query($query)){
        
                                                                                  
                        }else{
                            echo "<script>alert('echec');</script>";
                        }
                    //}
               // }

            }

            public function getbracbyid($id){

                 $query = "select * from bracelet where id = $id";
                 $result = $this->conn->query($query);
                 $row = $result->fetch(PDO::FETCH_ASSOC);
                 return json_encode($row);
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

             public function delete($data)
            {
                
                    // code...
                     
                    
                     // code...
                        $id = $data['id'];
                       
                        $query = "delete from bracelet where id = $id";
                        if($result = $this->conn->query($query)){
                                                           
                        }else{
                            echo "<script>alert('echec');</script>";
                        }
                    
                

            }
    }
?>

