<?php

//Declaracao de variaveis de ligacao
$servername = "azuresqldb12.database.windows.net";
$username = "chicoizy";
$password = "_Alface1";

$conn = mysqli_connect($servername,$username, $password);
//Verificar a ligacao
if(!$conn){
	die("Erro de Ligação: ".mysqli_connect_error());
}
mysqli_select_db($conn,"demo");
mysqli_set_charset($conn,"utf8");

?>
