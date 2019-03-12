<div class="pre">
<h3>Criar Utilizador Sistema</h3>
<form method="post">
<label>Nome Utilizador</label>
<input type="text" name="username" placeholder="Utilizador:" required>
<label>Password</label>
<input type="password" name="password" placeholder="Password:" required>
<label>Tipo de Utilizador:</label>
<select name="tipo">
	<option value="1">Administrador</option>
	<option value="2">Utilizador</option>
</select>
<input type="submit" name="novoutilizador" value="Criar Utilizador">
</form>
</div>
<?php
if(isset($_POST["novoutilizador"])){
	include 'connections/conn.php';
	mysqli_query($conn,"INSERT INTO login (username, password, tipo) values ('$_POST[username]','$_POST[password]','$_POST[tipo]')");
	echo '<meta http-equiv="refresh" content="0;url=index.php?adm=3">';
}
?>


<div class="conteudo">
<h3>Consulta de Utilizadores</h3>
<ul>
<?php
include 'connections/conn.php';
$users = mysqli_query($conn,"SELECT id, username FROM login WHERE tipo = '2'");
while($user = mysqli_fetch_array($users)){
	echo '<li><form method="post">'.$user["username"].' <input type="hidden" name="id" value="'.$user["id"].'"><input type="submit" name="eliminautilizador" value="Eliminar"></form></li>';
}
?>
</ul>
</div>
<?php
//Eliminar Utilizador
if(isset($_POST["eliminautilizador"])){
	include 'connections/conn.php';
	mysqli_query($conn,"DELETE FROM login WHERE id = '$_POST[id]'");
	echo '<script>alert("Utilizador Eliminado com  Sucesso!");</script>';
	echo '<meta http-equiv="refresh" content="0;url=index.php?adm=3">';
}	
?>