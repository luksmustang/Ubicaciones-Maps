<?php 
	
	class education	{
		private $id;
		private $nrocelula;
		private $ci;
		private $nombre;
		private $direccion;
		private $dia;
		private $hora;
		private $telefono;
		private $lat;
		private $lng;
		private $conn;
		private $tableName = "mapscelula";

		function setId($id) { $this->id = $id; }
		function getId() { return $this->id; }
		function setNrocelula($nrocelula) { $this->nrocelula = $nrocelula; }
		function getNrocelula() { return $this->nrocelula; }
		function setCi($ci) { $this->ci = $ci; }
		function getCi() { return $this->ci; }
		function setNombre($nombre) { $this->nombre = $nombre; }
		function getNombre() { return $this->nombre; }
		function setDireccion($direccion) { $this->direccion = $direccion; }
		function getDireccion() { return $this->direccion; }
		function setDia($dia) { $this->dia = $dia; }
		function getDia() { return $this->dia; }
		function setHora($hora) { $this->hora = $hora; }
		function getHora() { return $this->hora; }
		function setTelefono($telefono) { $this->telefono = $telefono; }
		function getTelefono() { return $this->telefono; }
		function setLat($lat) { $this->lat = $lat; }
		function getLat() { return $this->lat; }
		function setLng($lng) { $this->lng = $lng; }
		function getLng() { return $this->lng; }

		public function __construct() {
			require_once('db/DbConnect.php');
			$conn = new DbConnect;
			$this->conn = $conn->connect();
		}

		public function getMapscelulaBlankLatLng() {
			$sql = "SELECT * FROM $this->tableName WHERE lat IS NULL AND lng IS NULL";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getAllMapscelula() {
			
			$sql = "SELECT * FROM $this->tableName";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}


		public function updateMapscelulaWithLatLng() {
			$sql = "UPDATE $this->tableName SET lat = :lat, lng = :lng WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(':lat', $this->lat);
			$stmt->bindParam(':lng', $this->lng);
			$stmt->bindParam(':id', $this->id);

			if($stmt->execute()) {
				return true;
			} else {
				return false;
			}
		}
	}

?>