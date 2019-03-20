<?php 

	class BTTask {
		private $id;
		private $idStatus;
		private $description;
		private $dateRegistered;

		public function __get($attribute) {
			return $this->$attribute;
		}

		public function __set($attribute, $value) {
			$this->$attribute = $value;
		}
	}


?>