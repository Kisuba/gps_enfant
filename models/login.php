<?php

include './../models/bdmodel.php'; 
session_start();
class Login extends Bdmodel
{
	
	public function fetch($data)
        {

			$username = $data["nom"];
			$password = sha1($data["motdepasse"]);
		

            	$query = "SELECT * FROM admin WHERE nom = :username AND mot_de_passe = :password";
				
				$stmt = $this->conn->prepare($query);
				
				$stmt->bindParam(':username', $username);
				$stmt->bindParam(':password', $password);
				
			// Exécution de la requête préparée SQL
				if ($stmt->execute()) {
					// Vérification si l'utilisateur existe dans la table "users"
					if ($stmt->rowCount() > 0) {
						
						echo "Login réussi !";
						
						$_SESSION['nom'] = $username;
					} else {
						echo "Login échoué. Veuillez vérifier vos informations de connexion.";
					}
				} else {
					echo "Erreur d'exécution de la requête.";
				}

				// Fermeture de la connexion à la base de données
				$pdo = null;
                
               
		}

}
$model = new Login();
if($_POST['action'] === 'login'){

 	$model->fetch($_POST);
}		

