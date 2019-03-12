<?php
//Criacao de funcao a receber 2 parametros
function validarlogin($username, $password){
	// verificar preenchimento
	if(empty($username) || empty($password)){
		echo 'Os campos são de preenchimento obrigatório';
	}else{
		//echo $username;
		//echo $password;
		//Incluir ligacao a BD
		include 'connections/conn.php';
		//Ler a tabela de login
		$valida = mysqli_query($conn,"SELECT username, password, tipo FROM login WHERE username = '$_POST[username]' AND password = '$_POST[password]'");
		$validar = mysqli_fetch_array($valida);
		if(!$validar){//Os dados não são válidos
			echo 'Dados Inválidos. Tente Novamente.';
			echo '<script>alert("DADOS INVÁLIDOS");</script>';
		}else{//Dados corretos pode entrar
			$_SESSION["username"] = $validar["username"];
			$_SESSION["tipo"] = $validar["tipo"];
			//Refresh a pagina ou encaminhamento para X lugar
			mysqli_close($conn);
			echo '<meta http-equiv="refresh" content="0;url=index.php">';
			}
	}	
}
// Funcao de saida
function sair(){
	session_destroy();
	echo '<meta http-equiv="refresh" content="0;url=index.php">';
}

?>