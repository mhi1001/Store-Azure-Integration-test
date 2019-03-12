<div class="pre">
<h3>Menus Existentes</h3>


<table>
<tr>
<td> Menu:</td>
<td></td>
<td></td>
</tr>
<?php // Listar Menus Existentes:
include 'connections/conn.php';
$menus = mysqli_query($conn,"SELECT id, menu FROM menus");
while($menu = mysqli_fetch_array($menus)){

	echo '<tr>';
		echo '<td><form method="post"><input type="text" value="'.$menu["menu"].'" name="menu">';
		echo '<input type="hidden" value="'.$menu["id"].'" name="id"></td>';
		echo '<td><input type="submit" value="Apagar" name="apagar"></td>';
		echo '<td><input type="submit" value="Alterar" name="alterar"></form></td>';
	echo '</tr>';
	
}
?>
</table>
<?php
//Apagar Registo
if(isset($_POST["apagar"])){
	include 'connections/conn.php';
	mysqli_query($conn,"DELETE FROM menus WHERE id = '$_POST[id]'");
	echo '<meta http-equiv="refresh" content="0;url=index.php?adm=1">';
}
// Atualizar Registo
if(isset($_POST["alterar"])){
	include 'connections/conn.php';
	mysqli_query($conn,"UPDATE menus SET menu = '$_POST[menu]' WHERE id = '$_POST[id]'");
	echo '<meta http-equiv="refresh" content="0;url=index.php?adm=1">';
}

?>


</div>
<div class="conteudo">
<h3>Criar Novo Menu</h3>
<form method="post">
<label>Nome de Menu:</label>
<input type="text" name="menu" placeholder="Menu:" required>
<input type="submit" value="Criar Menu" name="novomenu">
</form>
</div>
<?php
if(isset($_POST["novomenu"])){
	include 'connections/conn.php';//Chamada ligacao a BD
	mysqli_query($conn,"INSERT INTO menus (menu) VALUES ('$_POST[menu]')");
	echo '<script>alert("Menu Criado com Sucesso!");</script>';
}
?>