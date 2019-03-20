<?php

	class BTDataBaseConnection {
		
		private $host = 'localhost';
		private $dataBaseName = 'php_com_pdo';
		private $user = 'root'; 
		private $pass = '';


		public function connect() {
			try {

				$connection = new PDO(
					"mysql:host=$this->host;dbname=$this->dataBaseName", 
					$this->user, 
					$this->pass);

				return $connection;

			} catch (PDOException $error) {
				echo $error->getMessage() . '<br>';
			}
		}
	}


?>