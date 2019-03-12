<?php

$mysqli = new mysqli("servidordabasedados.database.windows.net", "chicoizy", "_Alface1", "basededadosdaloja");
if ($mysqli->connect_errno) {
	echo "Failed to connect sql: (" . $mysqli->connect_errno . ") ". $mysqli->connect_error;
}

?>
