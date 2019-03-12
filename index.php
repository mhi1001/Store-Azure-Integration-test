<?php
session_start();
include 'functions.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>Site Demo</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
<header>
	<div class="logotipo">Tralha Sortida</div>
	<div class="promo">Bem Vindos</div>
	<div class="social">
		<ul>s
			<a href="#"><li class="brandico-facebook-rect"></li></a>
			<a href="#"><li class="brandico-linkedin-rect"></li></a>
			<a href="#"><li class="brandico-vimeo-rect"></li></a>
		</ul>
	</div> 

</header>
<?php
if(@!$_SESSION["tipo"]){
	//Visitante - Construir menu
	echo '<nav>
			<ul>';
		
			include 'connections/conn.php';
			$menus = mysqli_query($conn,"SELECT id, menu FROM menus");
			while($menu = mysqli_fetch_array($menus)){
				echo '<li><a href="index.php?opt='.$menu["id"].'">'.$menu["menu"].'</a></li>';
			}


	echo'</ul>
		</nav>';
}else if($_SESSION["tipo"] == '2'){
	//Ha login de utilizador
	echo '<nav>
			<ul>';
		
			include 'connections/conn.php';
			$menus = mysqli_query($conn,"SELECT id, menu FROM menus");
			while($menu = mysqli_fetch_array($menus)){
				echo '<li><a href="index.php?opt='.$menu["id"].'">'.$menu["menu"].'</a></li>';
			}











	echo'</ul>;
		</nav>';
}else if($_SESSION["tipo"] == '1'){
	//Ha login de admin
	echo '<nav>
			<ul>
				<li><a href="index.php?adm=1">Criar Menus</a></li>
				<li><a href="index.php?adm=2">Conteudos</a></li>
				<li><a href="index.php?adm=3">Ver Utilizadores</a></li>
				<li><a href="index.php?adm=4">Suporte</a></li>
				<li><a href="index.php?adm=5">Gerir Produtos</a></li>
			</ul>
		</nav>';
}

?>


<main>
	<div class="topline">
		<div class="promotop"></div>
		<div class="login">
			<?php
			if(@!$_SESSION["tipo"]){
				echo '<form method="post">
				<input type="text" name="username" placeholder="Utilizador:">
				<input type="password" name="password" placeholder="password:">
				<input type="submit" name="login" value="Entrar">';
			}else{
				echo '<form method="post">
				Ola '.$_SESSION["username"].'
				<input type="submit" name="sair" value="Sair">
				<input type="submit" name="editar" value="Minha Conta">';
			}
			?>
			
			<?php
			//Verificar se foi clicado o login
			if(isset($_POST["login"])){
				validarlogin($_POST["username"],$_POST["password"]);
			}
			//Verificar se foi clicado o sair
			if(isset($_POST["sair"])){
				sair();
			}
			if(isset($_POST["editar"])){
				echo '<meta http-equiv="refresh" content="0;url=index.php?opt=99">';
			}
			?>
			</form>
		</div>
	</div>
	<div class="conteudos">
	<?php
		if(@$_SESSION["tipo"] == '1'){// admin logado
			@$adm = $_REQUEST["adm"];
			switch ($adm) {
				case '1':
					include 'adm/menus.php';
					break;
				case '2':
					include 'adm/conteudos.php';
					break;
				case '3':
					include 'adm/utilizadores.php';
					break;
				case '4':
					include 'adm/suporte.php';
					break;
				case '5':
					include 'adm/gerirprodutos.php';
					break;
				default:
					echo 'Bem Vindo Admin';
					break;
			}
		}else{
			@$opt =$_REQUEST["opt"];
			if($opt == '99'){
				//Editar Conta
				include 'connections/conn.php';
				$dadosutilizador = mysqli_fetch_array(mysqli_query($conn,"SELECT id, username, password, tipo FROM login WHERE username = '$_SESSION[username]'"));
				echo '<form method="post">';
				echo '<label>Username</label>';
				echo '<input type="text" name="username" value="'.$dadosutilizador["username"].'">';
				echo '<label>Senha</label>';
				echo '<input type="password" name="password" value="'.$dadosutilizador["password"].'">';
				echo '<input type="hidden" name="idutilizador" value="'.$dadosutilizador["id"].'">';
				echo '<input type="submit" name="editardados" value="Alterar Dados">';
				echo '</form>';
			}else{
			include 'connections/conn.php';
			$conteudos = mysqli_query($conn,"SELECT conteudo FROM conteudos WHERE idmenu = '$opt'");
			$conteudo = mysqli_fetch_array($conteudos);
			echo $conteudo["conteudo"];
			}
		}
	?>
	<?php
	if(isset($_POST["editardados"])){
		include 'connections/conn.php';
		mysqli_query($conn,"UPDATE login SET username='$_POST[username]', password = '$_POST[password]' WHERE id = '$_POST[idutilizador]' ");
		$_SESSION["username"] = $_POST["username"];
		echo '<script>alert("Os seus dados foram alterados com  Sucesso!");</script>';
		echo '<meta http-equiv="refresh" content="0;url=index.php">';
	}
	?>
	</div>


  
</main>
<footer>
	<div class="foo_esq">&copy;Atec 2018</div>
	<div class="foo_esq">Teste Avaliação GRSI017</div>
</footer>
</body>
</html>