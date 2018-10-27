<?php
include("db.php");
if(isset($_GET['q'])){
	$search = $_GET['q'];
	$query = $db->query("SELECT * FROM items WHERE name LIKE '%".$search."%' OR description LIKE '%".$search."%' OR tags LIKE '%".$search."%'");
	
	if(!$query->fetchArray() == false){
		$query = $db->query("SELECT * FROM items WHERE name LIKE '%".$search."%' OR description LIKE '%".$search."%' OR tags LIKE '%".$search."%'");
while ($row = $query->fetchArray()) {
		echo $row['name']."<br>";
	}
	} else {
		echo "Kein treffer";
	}
	
} else if(isset($_GET['categorie'])){
	$query = $db->query("SELECT * FROM items");
	while ($row = $query->fetchArray()){
		if($row['categorie'] == $_GET['categorie']){
			echo '<span>'.$row['name'].'</span><br>';
		}
	}
		
	
}
?>