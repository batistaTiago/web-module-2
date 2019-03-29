<?php
namespace App\Models;

use MF\Model\Model;

class Tweet extends Model {

	private $id;
	private $id_usuario;
	private $tweet;
	private $data;

	public function __get($attribute) {
		return $this->$attribute;
	}

	public function __set($attribute, $value) {
		$this->$attribute = $value;
	}

	public function salvar() {
		$query = 'insert into tweets (id_usuario, tweet) values (?, ?)';
		$statement = $this->database->prepare($query);
		$statement->bindValue(1, $this->__get('id_usuario'));
		$statement->bindValue(2, $this->__get('tweet'));
		$statement->execute();

		return $this;

	}

	public function getAll() {
		$query = 'SELECT 
			tweets.id, tweets.id_usuario, tweets.tweet, tweets.data, usuarios.nome 
		FROM 
			tweets
		LEFT JOIN 
			usuarios 
		ON 
			(tweets.id_usuario = usuarios.id)
		WHERE 
			id_usuario = :id_usuario
		OR
			tweets.id_usuario in (
				SELECT 
					id_usuario_seguido 
				FROM 
					usuarios_seguidores
				WHERE 
					id_usuario = :id_usuario
			)
		ORDER BY 
			tweets.data DESC';


		$statement = $this->database->prepare($query);
		$statement->bindValue(':id_usuario', $this->__get('id_usuario'));
		$statement->execute();
		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}
}

?>