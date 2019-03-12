<div class="pre">
<h3>Conteudos Existentes</h3>
<form method="post">
	<select name="editamenu">
		<?php
		include 'connections/conn.php';
		$menus = mysqli_query($conn,"SELECT id, menu FROM menus");
		while($menu = mysqli_fetch_array($menus)){
			echo '<option value="'.$menu["id"].'">'.$menu["menu"].'</option>';
		}
		?>
	</select>


	<input type="submit" name="editarmenu" value="Editar">
</form>
<?php
	if(isset($_POST["editarmenu"])){
		include 'connections/conn.php';
		$conteudos = mysqli_query($conn,"SELECT conteudo, idmenu FROM conteudos WHERE idmenu = '$_POST[editamenu]'");
		$conteudo = mysqli_fetch_array($conteudos);
		echo '<form method="post">';
		echo '<textarea name="conteudoeditado">'.$conteudo["conteudo"].'</textarea>';
		echo '<input type="hidden" name="idmenu" value="'.$conteudo["idmenu"].'">';
		echo '<input type="submit" name="atualizarconteudo" value="Atualizar">';
		echo '</form>';
	}
	if(isset($_POST["atualizarconteudo"])){
		include 'connections/conn.php';
		mysqli_query($conn,"UPDATE conteudos SET conteudo = '$_POST[conteudoeditado]' WHERE idmenu = '$_POST[idmenu]'");
		echo '<meta http-equiv="refresh" content="0;url=index.php?adm=2">';
	}	
?>



</div>

<div class="conteudo">
<h3>Inserir Produtos Para Venda</h3>
<form method="post">
	<select name="menu">
	<?php
		include 'connections/conn.php';
		$menus = mysqli_query($conn,"SELECT id, menu FROM menus");
		while($menu = mysqli_fetch_array($menus)){
			echo '<option value="'.$menu["id"].'">'.$menu["menu"].'</option>';
		}
	?>
	</select>
	<textarea name="conteudo"></textarea>
	<input type="submit" name="carregarconteudo" value="Inserir Conteudo">
</form>
<?php
if(isset($_POST["carregarconteudo"])){
	include 'connections/conn.php';
	mysqli_query($conn,"INSERT INTO conteudos (idmenu, conteudo) VALUES ('$_POST[menu]','$_POST[conteudo]')");
	echo '<meta http-equiv="refresh" content="0;url=index.php?adm=2">';
}
?>
<br>
<br>
<br>
<br>

<div class="pre">
<h3>Produtos Existentes</h3>
<table border="0">
<tr>
	<td>Nome Produto</td>
	<td>Descricao</td>
	<td>Categoria</td>
	<td>Preço</td>
	<td></td>
	<td></td>
</tr>

<?php
	include 'connections/conn.php';
	$produtos = mysqli_query($conn,"SELECT id, categoria, nome, descricao, preco FROM produtos");
	while($produto = mysqli_fetch_array($produtos)){
		echo '<tr>';
			echo '<td>'.$produto["nome"].'</td>';
			echo '<td>'.$produto["descricao"].'</td>';
			echo '<td>'.$produto["categoria"].'</td>';
			echo '<td>'.$produto["preco"].'</td>';
			echo '<td><form method="post">
				</form></td>';
		echo '</tr>';
	}
?>

</table>

</div>
<br>
<br>
<br>





</div>