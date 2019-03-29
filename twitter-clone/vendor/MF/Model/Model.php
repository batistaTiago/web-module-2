<?php


namespace MF\Model;

abstract class Model {

	protected $database;

	public function __construct(\PDO $db) {
		$this->database = $db;
	}
}


?>