<?php
function conecta_mysql(){
	$host = "localhost";
	$usuario = "root";
	$senha = "";
	$nome_bd = "redesocial";

	$conexao = mysqli_connect($host,$usuario,$senha,$nome_bd);
	mysqli_set_charset($conexao, "utf8");
	//if( mysqli_connect_errno() ){
	//	print "Erro ao tentar conectar com o BD MYSQL: ".mysqli_connect_error();
	//}
	return $conexao;
}


?>
