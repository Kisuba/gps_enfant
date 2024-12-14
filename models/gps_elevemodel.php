<?php
class Gps_eleve extends Bdmodel
	{

        public function fetch2($criteria1,$criteria2)
        {
     
      $data = null;
    //  $ladate = '';
    if($criteria1 == "" || $criteria2 ==""){
    $query = "
    SELECT 
    e.identBrac as bracelet,
    el.photo as photo,
    el.nom as nom,
    el.postnom as postnom,
    el.prenom as prenom,
    el.adresse as adresse,
    (SELECT latitude FROM datagps WHERE identBrac = e.identBrac ORDER BY id ASC LIMIT 1) AS longpr,
    (SELECT longitude FROM datagps WHERE identBrac = e.identBrac ORDER BY id ASC LIMIT 1) AS latpr,
    (SELECT latitude FROM datagps WHERE identBrac = e.identBrac ORDER BY id DESC LIMIT 1) AS longd,
    (SELECT longitude FROM datagps WHERE identBrac = e.identBrac ORDER BY id DESC LIMIT 1) AS latd
    FROM 
        (SELECT DISTINCT identBrac FROM datagps) e
    inner join bracelet br on br.id_bracelet = e.identBrac
    inner join gps_eleves gp on gp.id_bracelet = br.id
    inner join eleves el on el.id = gp.id_eleve
               
            ";
             if($result = $this->conn->query($query)){
                 while($row = $result->fetch(PDO::FETCH_ASSOC)){
                     $data[] = $row;
                 }

             }
             return $data;
            }else{
                
                $date1 = DateTime::createFromFormat('m/d/Y h:i A', $criteria1);
                $date2 = DateTime::createFromFormat('m/d/Y h:i A', $criteria2);

                if ($date1 !== false && $date2 !== false) {
                    // Formater la date au format désiré
                    $formattedDate1 = $date1->format('Y-m-d H:i:s');
                    $formattedDate2 = $date2->format('Y-m-d H:i:s');
       
    $query = "
    SELECT 
    e.identBrac as bracelet,
    el.photo as photo,
    el.nom as nom,
    el.postnom as postnom,
    el.prenom as prenom,
    el.adresse as adresse,
    (SELECT latitude FROM datagps WHERE identBrac = e.identBrac and reading_time BETWEEN '$formattedDate1' AND '$formattedDate2' ORDER BY id ASC LIMIT 1) AS longpr,
    (SELECT longitude FROM datagps WHERE identBrac = e.identBrac and reading_time BETWEEN '$formattedDate1' AND '$formattedDate2' ORDER BY id ASC LIMIT 1) AS latpr,
    (SELECT latitude FROM datagps WHERE identBrac = e.identBrac and reading_time BETWEEN '$formattedDate1' AND '$formattedDate2' ORDER BY id DESC LIMIT 1) AS longd,
    (SELECT longitude FROM datagps WHERE identBrac = e.identBrac and reading_time BETWEEN '$formattedDate1' AND '$formattedDate2' ORDER BY id DESC LIMIT 1) AS latd
    FROM 
        (SELECT DISTINCT identBrac, reading_time FROM datagps WHERE reading_time BETWEEN '$formattedDate1' AND '$formattedDate2') e
    inner join bracelet br on br.id_bracelet = e.identBrac
    inner join gps_eleves gp on gp.id_bracelet = br.id
    inner join eleves el on el.id = gp.id_eleve
    
    LEFT JOIN (
    SELECT identBrac, latitude, longitude, reading_time
    FROM datagps
    WHERE reading_time BETWEEN '$formattedDate1' AND '$formattedDate2'
    ORDER BY reading_time ASC
) first_coords ON e.identBrac = first_coords.identBrac AND e.reading_time = first_coords.reading_time
LEFT JOIN (
    SELECT identBrac, latitude, longitude, reading_time
    FROM datagps
    WHERE reading_time BETWEEN '$formattedDate1' AND '$formattedDate2'
    ORDER BY reading_time DESC
) last_coords ON e.identBrac = last_coords.identBrac AND e.reading_time = last_coords.reading_time
WHERE e.reading_time = (SELECT MIN(reading_time) FROM datagps WHERE reading_time BETWEEN '$formattedDate1' AND '$formattedDate2' AND identBrac = e.identBrac)
OR e.reading_time = (SELECT MAX(reading_time) FROM datagps WHERE reading_time BETWEEN '$formattedDate1' AND '$formattedDate2' AND identBrac = e.identBrac)
GROUP BY e.identBrac, el.photo, el.nom, el.postnom, el.prenom, el.adresse;
            ";
             if($result = $this->conn->query($query)){
                 while($row = $result->fetch(PDO::FETCH_ASSOC)){
                     $data[] = $row;
                 }

             }
             return $data;
                }
            }
        }
		
		    public function fetch()
            {
            	$data = null;

            	$query = "select g.id as id, b.id_bracelet as id_bracelet, g.id_eleve as id_eleve, e.nom as nom, e.postnom as postnom, e.prenom as prenom, e.adresse as adresse, e.photo as photo, dt.longitude as longs, dt.latitude as lat from gps_eleves g 
                inner join eleves e on e.id = g.id_eleve 
                inner join bracelet b on b.id = g.id_bracelet 
                inner join datagps dt on dt.identBrac = b.id_bracelet 
                where dt.reading_time in (select max(reading_time) as date_enreg from datagps GROUP by identBrac) 
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

