</!DOCTYPE html>
<?php 
include("db.php");
?>
<html>
<head>
	<title>mcuOne Database</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Header Logo und Text  -->
<table align="center">
	<tr>
		<td><img alt="self-Logo" src="images/logo.svg" style="padding-right: 10px;"></td>
		<td><p style="font-size: 32px; text-shadow: 2px 2px 8px black">mcuOne Database</p></td>
	</tr>

</table>

<table align="center">
	<tr>
		<td><input type="text" name=""  onkeyup="showHint(this.value)" id="search_box" placeholder="Suche..."></td>
	</tr>
	<tr>
		<td align="center"><a href="new_component.php"><button>Bauteil hinzufügen</button></a></td>
	</tr>
</table>
<script>
function js_link(str_id){
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            	document.getElementById("categories").style.display = "none";
        		document.getElementById("categories").style.visibility = "hidden";
                document.getElementById("txtHint").innerHTML = this.responseText;
                document.getElementById("txtHint").style.removeProperty( 'display' );
    			document.getElementById("txtHint").style.visibility = "visible";
            }
        };
        xmlhttp.open("GET", "search.php?categorie=" + str_id, true);
        xmlhttp.send();
}
function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        document.getElementById("categories").style.removeProperty( 'display' );
        document.getElementById("categories").style.visibility = "visible";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        document.getElementById("categories").style.display = "none";
        document.getElementById("categories").style.visibility = "hidden";
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
                document.getElementById("txtHint").style.removeProperty( 'display' );
    			document.getElementById("txtHint").style.visibility = "visible";
            }
        };
        xmlhttp.open("GET", "search.php?q=" + str, true);
        xmlhttp.send();
    }

}

function start(){
	document.getElementById("txtHint").style.display = "none";
    document.getElementById("txtHint").style.visibility = "hidden";
	document.getElementById("categories").style.removeProperty( 'display' );
    document.getElementById("categories").style.visibility = "visible";
}
</script>
<center>
	<span id="categories">

		<?php
		$query = $db->query("SELECT * FROM categories");
		while ($row = $query->fetchArray())
		    echo '<span id="js_link" onclick="js_link('.$row['id'].')">'.$row['name'].'</span><br>';
		?>
	
</span>
<style type="text/css">
	#js_link:hover{
	cursor: pointer;
}
</style>
</center>
<span id="txtHint"></span>

<span id="js_link" onclick="start()">Zurück</span>
</body>
</html>