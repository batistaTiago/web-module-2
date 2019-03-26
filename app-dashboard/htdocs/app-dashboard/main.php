<?php

class BTDashboard implements \JsonSerializable {
	private $dataInicio = null;
	private $dataFim = null;

	private $numVendas = null;
	private $totalVendas = null;
	private $totalDespesas = null;


	public function __get($attribute) {
		return $this->$attribute;
	}

	public function __set($attribute, $value) {
		return $this->$attribute = $value;
	}


	public function jsonSerialize() {
		return get_object_vars($this);
	}

}

class BTDataBaseConnection {
	private $host = 'localhost';
	private $databaseName = 'dashboard';
	private $user = 'root';
	private $pass = '';

	public function connect() {
		try {
			$connection = new PDO(
				"mysql:host=$this->host;dbname=$this->databaseName", 
				$this->user, 
				$this->pass);
			$connection->exec('set charset set utf8');

			return $connection;

		} catch (PDOException $e) {
			echo '<pre>';
			print_r($e);
			echo '</pre>';
		}
	}
}

class BTDataBase {
	private $connection;
	private $dashboard;

	public function __construct(BTDataBaseConnection $connection, BTDashboard $dashboard) {
		$this->connection = $connection->connect();
		$this->dashboard = $dashboard;
	}

	public function getNumeroVendas() {
		$query = '
		SELECT COUNT(*) AS nVendas 
		FROM tb_vendas 
		WHERE data_venda 
		BETWEEN ? AND ?';

		$statement = $this->connection->prepare($query);
		$statement->bindValue(1, $this->dashboard->__get('dataInicio'));
		$statement->bindValue(2, $this->dashboard->__get('dataFim'));
		$statement->execute();

		return $statement->fetch(PDO::FETCH_OBJ)->nVendas;
	}



	public function getTotalVendas() {
		$query = '
		SELECT SUM(total) AS totalVendas 
		FROM tb_vendas 
		WHERE data_venda 
		BETWEEN ? AND ?';

		$statement = $this->connection->prepare($query);
		$statement->bindValue(1, $this->dashboard->__get('dataInicio'));
		$statement->bindValue(2, $this->dashboard->__get('dataFim'));
		$statement->execute();

		return $statement->fetch(PDO::FETCH_OBJ)->totalVendas;
	}

	public function getTotalDespesas() {
		$query = '
		SELECT SUM(total) as totalDespesas
		FROM tb_despesas 
		WHERE data_despesa 
		BETWEEN ? AND ?';

		$statement = $this->connection->prepare($query);
		$statement->bindValue(1, $this->dashboard->__get('dataInicio'));
		$statement->bindValue(2, $this->dashboard->__get('dataFim'));

		$statement->execute();

		return $statement->fetch(PDO::FETCH_OBJ)->totalDespesas;
	}
}


$connection = new BTDataBaseConnection();
$dashboard = new BTDashboard();

$competencia = explode('-', $_GET['competencia']);
$ano = $competencia[0];
$mes = $competencia[1];
$diasNoMes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

$dashboard->__set('dataInicio', "$ano-$mes-01");
$dashboard->__set('dataFim', "$ano-$mes-$diasNoMes");

$db = new BTDataBase($connection, $dashboard);

$dashboard->__set('numVendas', $db->getNumeroVendas());
$dashboard->__set('totalVendas', $db->getTotalVendas());
$dashboard->__set('totalDespesas', $db->getTotalDespesas());

print_r(json_encode($dashboard));

?>