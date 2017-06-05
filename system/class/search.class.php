<?php 
	include "../config/db.config.php";
	class Search{
		public $db;
		public function __construct(){
			$this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
			mysqli_query($this->db, "SET NAMES 'utf8'");
			if(mysqli_connect_errno()) {
				echo "Error: Could not connect to database.";
			exit;
			}
		}
		
		public function getResults($q) {
    		$sql = "SELECT * FROM data WHERE name like '%$q%' or description like '%$q%' order by ID LIMIT 6";
	        $result = mysqli_query($this->db,$sql);
			if($result->num_rows > 0){
			while($row = mysqli_fetch_object($result)){
echo '
<article>
	<div class="resultItem" data-id="'.$row->ID.'">
		<div class="itemLink"><a href="#">'; echo htmlspecialchars($row->name, ENT_QUOTES, 'UTF-8'); echo '</a></div>
	</div>
</article>
';
			}
		} else {
			echo '<div class="noResults">Results doesn\'t exist';
		}
		}
}
	

$search = new Search;
?>