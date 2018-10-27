<!DOCTYPE html>
<?php
include("db.php");
?>
<html>
<head>
	<title>mcuOne Datenbank - Neues Bauteil hinzufügen</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<table>
	<tr>
		<td>Name: </td>
		<td><input type="text" name="comp_name"></td>
	</tr>
	<tr>
		<td>Description: </td>
		<td><textarea></textarea></td>
	</tr>
	<tr>
		<td>Hersteller: </td>
		<td><input type="text" name="manu_name"></td>
	</tr>
	<tr>
		<td>Kategorie: </td>
		<td>
			<select>
				<?php
				$query = $db->query("SELECT * FROM categories");
				while ($row = $query->fetchArray())
				    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
				?>
			</select>
		</td>
	</tr>

</table>
<a href="/"><button>Start</button></a>
</body>
</html>