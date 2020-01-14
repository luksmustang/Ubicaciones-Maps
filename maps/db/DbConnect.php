<?php

	class DbConnect {
		private $host = 'localhost';
		private $dbName = 'maps';
		private $user = 'postgres';
		private $pass = '';
		private $port = '5432';

		public function connect() {
			try {
				$conn = new PDO('pgsql:host=' . $this->host . '; dbname=' . $this->dbName, $this->user, $this->pass);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conn;
			} catch( PDOException $e) {
				echo 'Database Error: ' . $e->getMessage();
			}
		}
	}
 ?>





