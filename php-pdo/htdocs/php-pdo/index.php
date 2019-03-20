<?php

	$dataSourceName = 'mysql:host=localhost;dbname=php_com_pdo';
	$userName = 'root';
	$password = '';

	try {
		$dataBase = new PDO($dataSourceName, $userName, $password);

		/* //Cria a tabela
		//ps - pode deixar mesmo se tiver criada, pois o PDO verifica os erros.
		//mas não recomenda-se

		$query = 'CREATE TABLE tb_usuarios(
		id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		nome VARCHAR(50) NOT NULL,
		email VARCHAR(100) NOT NULL,
		senha VARCHAR(32) NOT NULL)';

		$dataBase->exec($query);
		
		
		// Popula com usuarios dummy
		$query = "INSERT INTO tb_usuarios(nome, email, senha) values 
		('User 1', 'user1@system.com', 'userpass1'),
		('User 2', 'user2@system.com', 'userpass2'),
		('User 3', 'user3@system.com', 'userpass3'),
		('User 4', 'user4@system.com', 'userpass4'),
		('User 5', 'user5@system.com', 'userpass5') ";

		$dataBase->exec($query);
		*/

		$textQuery = 'SELECT * FROM tb_usuarios';
		$pdoStatement = $dataBase->query($textQuery);
		// $queryResults = $pdoStatement->fetchAll(PDO::FETCH_OBJ); // recupera como objetos

		/* percorre tudo com do{}while()
		do {
			$databaseEntry = $pdoStatement->fetch(PDO::FETCH_OBJ);
			echo '<pre>';
			print_r($databaseEntry);
			echo '</pre>';
		} while ($databaseEntry != null);
		*/

	} catch (PDOException $error) {
		echo 'code - ' . $error->getCode() . '<br>error - ' . $error->getMessage();
	}
	