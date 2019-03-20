<?php 


	class BTTaskService {

		private $conn;
		private $task;

		public function __construct(BTDataBaseConnection $connection, BTTask $task) {
			$this->conn = $connection->connect();
			$this->task = $task;
		}

		public function insert() {
			$query = 'insert into tb_tarefas(tarefa)value(:task)';
			$statement = $this->conn->prepare($query);
			$statement->bindValue(':task', $this->task->__get('description'));
			$statement->execute();
		}

		public function retrieve() {

			$query = 'select tb_tarefas.id, tb_status.status, tb_tarefas.tarefa 
					  from tb_tarefas
					  left join tb_status 
					  on (tb_tarefas.id_status = tb_status.id)';

			$statement = $this->conn->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_OBJ);
		}

		public function update() {
			echo '<pre>';
			print_r($this->task);
			echo '</pre>';

			$query = 'UPDATE tb_tarefas SET tarefa = :description WHERE id = :id';
			$statement = $this->conn->prepare($query);
			$statement->bindValue(':description', $this->task->__get('description'));
			$statement->bindValue(':id', $this->task->__get('id'));
			return $statement->execute();
		}

		public function remove() {
			
		}
	}


?>