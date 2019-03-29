<?php
namespace App\Models;

use MF\Model\Model;

class Usuario extends Model {
	private $id;
	private $nome;
	private $email;
	private $senha;

	public function __get($attribute) {
		return $this->$attribute;
	}

	public function __set($attribute, $value) {
		$this->$attribute = $value;
	}

	public function salvar() {
		
		$query = '
		INSERT INTO usuarios (nome, email, senha) 
		values (?, ?, ?)';

		$statement = $this->database->prepare($query);
		$statement->bindValue(1, $this->__get('nome'));
		$statement->bindValue(2, $this->__get('email'));
		$statement->bindValue(3, $this->__get('senha'));
		
		return $statement->execute() == 1;
	}

	public function formularioValido() {
		if(strlen($this->__get('nome')) < 3) {
			return false;
		} else if(strlen($this->__get('email')) < 3) {
			return false;
		} else if(strlen($this->__get('senha')) < 3) {
			return false;
		} 
		return true;
	}

	public function getUsuarioPorEmail() {
		$query = 'SELECT * FROM usuarios WHERE email = ?';
		$statement = $this->database->prepare($query);
		$statement->bindValue(1, $this->__get('email'));
		$statement->execute();

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getUsuarioPorId() {
		$query = '
		SELECT 
			nome 
		AS 
			nome_usuario
		FROM 
			usuarios 
		WHERE 
			id = ?';
		$statement = $this->database->prepare($query);
		$statement->bindValue(1, $this->__get('id'));
		$statement->execute();

		return $statement->fetch(\PDO::FETCH_ASSOC);
	}

	public function getTotalTweets() {
		$query = '
		SELECT 
			COUNT(*)
		AS 
			total_tweets
		FROM
			tweets
		WHERE id_usuario = ?';
		
		$statement = $this->database->prepare($query);
		$statement->bindValue(1, $this->__get('id'));
		$statement->execute();

		return $statement->fetch(\PDO::FETCH_ASSOC);
	}

	public function getTotalSeguindo() {
		$query = '
		SELECT 
			COUNT(*)
		AS 
			total_seguindo
		FROM
			usuarios_seguidores
		WHERE id_usuario = ?';
		
		$statement = $this->database->prepare($query);
		$statement->bindValue(1, $this->__get('id'));
		$statement->execute();

		return $statement->fetch(\PDO::FETCH_ASSOC);
	}


	public function getTotalSeguidores() {
		$query = '
		SELECT 
			COUNT(*)
		AS 
			total_seguidores
		FROM
			usuarios_seguidores
		WHERE id_usuario_seguido = ?';
		
		$statement = $this->database->prepare($query);
		$statement->bindValue(1, $this->__get('id'));
		$statement->execute();

		return $statement->fetch(\PDO::FETCH_ASSOC);
	}

	public function autenticar() {
		$query = 'select id, nome, email, senha from usuarios where email = ? and senha = ?';
		$statement = $this->database->prepare($query);
		$statement->bindValue(1, $this->__get('email'));
		$statement->bindValue(2, $this->__get('senha'));
		$statement->execute();

		$result = $statement->fetch(\PDO::FETCH_ASSOC);

		if ($result != null) {
			$this->__set('nome', $result['nome']);
			$this->__set('id', $result['id']);
			return true;
		} else {
			$this->__set('nome', '');
			$this->__set('id', '');
			$this->__set('email', '');
			$this->__set('senha', '');
			return false;
		}
	}

	public function getAll() {
		$query = '
		SELECT 
			u.id, 
			u.nome, 
			u.email,

			(
			SELECT 
				COUNT(*) 
			FROM 
				usuarios_seguidores AS us 
			WHERE 
				us.id_usuario = :id_usuario
			AND 
				us.id_usuario_seguido = u.id
			) AS seguindo_sn 

		FROM 
			usuarios as u
		WHERE 
			u.nome LIKE :nome_usuario
		AND 
			u.id != :id_usuario';

		$statement = $this->database->prepare($query);
		$statement->bindValue(':nome_usuario', '%' . $this->__get('nome') . '%');
		$statement->bindValue(':id_usuario', $this->__get('id'));
		$statement->execute();
		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function seguirUsuario($id) {
		$query = '
			INSERT INTO usuarios_seguidores 
			(id_usuario, id_usuario_seguido)
			VALUES (?, ?)';

		$statement = $this->database->prepare($query);
		$statement->bindValue(1, $this->__get('id'));
		$statement->bindValue(2, $id);

		$statement->execute();

		return true;
	}

	public function deixarDeSeguirUsuario($id) {
		$query = '
			DELETE FROM usuarios_seguidores 
			WHERE id_usuario = ? AND id_usuario_seguido = ?';

		$statement = $this->database->prepare($query);
		$statement->bindValue(1, $this->__get('id'));
		$statement->bindValue(2, $id);

		$statement->execute();
	}
}

?>