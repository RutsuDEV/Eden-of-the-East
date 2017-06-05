<?php 
	include "../../config/db.config.php";
	class Data{
		public $db;
		public function __construct(){
			$this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
			mysqli_query($this->db, "SET NAMES 'utf8'");
			if(mysqli_connect_errno()) {
				echo "Error: Could not connect to database.";
			exit;
			}
		}
		
		public function getData($id) {
    		$sql = "SELECT * FROM data WHERE ID = '$id' ORDER BY ID LIMIT 10";
	        $result = mysqli_query($this->db,$sql);
			while($row = mysqli_fetch_object($result)){
echo '
<article class="resultBlock">
	<div class="resultItem" data-id="'.$row->ID.'">
		<div class="itemLink"><a href="#">'; echo htmlspecialchars($row->name, ENT_QUOTES, 'UTF-8'); echo '</a></div>
		<div class="itemDescription">'; echo htmlspecialchars($row->description, ENT_QUOTES, 'UTF-8'); echo '</div>
	</div>
</article>
';
			}
		}
}
	

$data = new Data;
?>