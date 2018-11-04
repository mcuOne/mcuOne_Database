<?php
include("db.php");
if(isset($_GET['q'])){
	$search = $_GET['q'];
	$query = $db->query("SELECT * FROM items WHERE name LIKE '%".$search."%' OR description LIKE '%".$search."%' OR tags LIKE '%".$search."%' OR package LIKE '%".$search."%'");
	
	if(!$query->fetchArray() == false){
		$query = $db->query("SELECT * FROM items WHERE name LIKE '%".$search."%' OR description LIKE '%".$search."%' OR tags LIKE '%".$search."%' OR package LIKE '%".$search."%'");
echo '<table border=0 id="content_table" align="center"><tr><th>Name</th><th>Beschreibung</th><th>Hersteller</th><th>Kategorie</th><th>Paket</th><th>Menge</th><th>Sektion</th><th>Datenblatt</th></tr>';
	$color = "#878787";
	while ($row = $query->fetchArray()){
		
			$query_cat = $db->query("SELECT * FROM categories WHERE id LIKE '".$row['categorie']."'");
			$row_cat = $query_cat->fetchArray();
			if ($color == "#878787"){
				$color = "#797979";
			} else {
				$color = "#878787";
			}
			echo '<tr style="background-color: '.$color.';"><td><span id="js_link" title="'.$row['id'].'" onclick="get_item(this.title)">'.$row['name'].'</span></td><td style="max-width: 300px;">'.$row['description'].'</td><td>'.$row['manufacturer'].'</td><td>'.$row_cat['name'].'</td><td>'.$row['package'].'</td><td align="center">'.$row['qty'].'</td><td align="center">'.$row['section'].'</td><td><a href="'.$row['datasheet'].'"><img src="images/pdf.png" /></a></td></tr>';
		
	}
		echo "</table>";
	} else {
		echo "Kein treffer";
	}
	
} else if(isset($_GET['categorie'])){
	$query = $db->query("SELECT * FROM items");
	echo '<table border=0 id="content_table" align="center"><tr><th>Name</th><th>Beschreibung</th><th>Hersteller</th><th>Kategorie</th><th>Paket</th><th>Menge</th><th>Sektion</th><th>Datenblatt</th></tr>';
	$color = "#878787";
	while ($row = $query->fetchArray()){
		if($row['categorie'] == $_GET['categorie']){
			$query_cat = $db->query("SELECT * FROM categories WHERE id LIKE '".$row['categorie']."'");
			$row_cat = $query_cat->fetchArray();
			if ($color == "#878787"){
				$color = "#797979";
			} else {
				$color = "#878787";
			}
			echo '<tr style="background-color: '.$color.';"><td><span id="js_link" title="'.$row['id'].'" onclick="get_item(this.title)">'.$row['name'].'</span></td><td style="max-width: 300px;">'.$row['description'].'</td><td>'.$row['manufacturer'].'</td><td>'.$row_cat['name'].'</td><td>'.$row['package'].'</td><td align="center">'.$row['qty'].'</td><td align="center">'.$row['section'].'</td><td><a href="'.$row['datasheet'].'"><img src="images/pdf.png" /></a></td></tr>';
		}
	}
		echo "</table>";
} else if(isset($_GET['item'])){
	$query = $db->query("SELECT * FROM items WHERE id LIKE '".$_GET['item']."'");
	$row = $query->fetchArray();

	?>
	<table border=0 id="content_table" align="center" width="80%">
		<tr bgcolor="#878787"><td>Name:</td><td colspan="5"><?php echo $row['name']; ?></td></tr>
		<tr bgcolor="#797979"><td colspan="5">Beschreibung:</td><td><?php echo $row['description']; ?></td></tr>
		<tr bgcolor="#878787"><td colspan="5">Hersteller:</td><td><?php echo $row['manufacturer']; ?></td></tr>
		<tr bgcolor="#797979"><td>Menge:</td><td><?php echo $row['qty']; ?></td><td>Packet:</td><td><?php echo $row['package']; ?></td><td>Sektion:</td><td><?php echo $row['section']; ?></td></tr>
		<tr><td colspan="6" >
			<object data="<?php echo $row['datasheet']; ?>" style="width:100%;height:800px">
			  <a href="<?php echo $row['datasheet']; ?>">PDF laden</a>
			</object>
		</td></tr>

	</table>
	<?php
	
}
?>