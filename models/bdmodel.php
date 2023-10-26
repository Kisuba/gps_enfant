<?php
	//
	/*
	 * 
	 */
	class Bdmodel 
	{
		
			private $dbhost = "localhost"; 
		    private $dbname = "gpsenfant";    // Database name
		    private $dbuser = "root";                    // Database username
		    private $password = "";
			
            protected $conn;

            public function __construct(){
            	try {
            		$this->conn =  new PDO("mysql:host=".$this->dbhost.";dbname=".$this->dbname."","".$this->dbuser."", "".$this->password."");
            		
            	} catch (Exception $e) {
	            	echo "connection failed" . $e->getMessage();
            }

        }

          
	}


?>