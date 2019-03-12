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
			echo '<td>Editar</td>';
			echo '<td><form method="post">
				<input type="hidden" name="idproduto" value="'.$produto["id"].'">
				<input type="submit" name="apagarproduto" value="Apagar">
				</form></td>';
		echo '</tr>';
	}
	 
	if(isset($_POST["apagarproduto"])){
		include 'connections/conn.php';
		mysqli_query($conn,"DELETE FROM produtos WHERE id = '$_POST[idproduto]'");
		echo '<script>alert("Produto Eliminado com Sucesso!");</script>';
	echo '<meta http-equiv="refresh" content="0;url=index.php?adm=5">';
	}
?>
</table>

</div>

<div class="conteudo">
<h3>Criar Produtos</h3>
<form method="post">
	<label>Categoria:</label>
	<select name="categoria">
		<option value="Monitores">Monitores</option>
		<option value="Torres">Torres</option>
		<option value="Perifericos">Periféricos</option>
	</select>
	<label>Nome Produto:</label>
	<input type="text" name="nomeproduto" placeholder="Nome de Produto">
	<label>Descrição</label>
	<textarea name="descricao"></textarea>
	<label>Preço</label>
	<input type="text" name="preco" placeholder="10">€
	<input type="submit" name="carregarproduto" value="Inserir Produto">
</form>
<?php
if(isset($_POST["carregarproduto"])){
	include 'connections/conn.php';
	mysqli_query($conn,"INSERT INTO produtos (categoria, nome, descricao, preco) VALUES ('$_POST[categoria]','$_POST[nomeproduto]','$_POST[descricao]','$_POST[preco]')");
	echo '<script>alert("Produto Criado com Sucesso!");</script>';
	echo '<meta http-equiv="refresh" content="0;url=index.php?adm=5">';
}
?>
</div>