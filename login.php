<?php
session_start();
$email = $_GET["email"];
$senha = $_GET["senha"];
include "conexao.php";
$conexao = conecta_mysql();
$sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
$resultado_id = mysqli_query($conexao, $sql);
if ($resultado_id) {
	$dados_usuario = mysqli_fetch_array($resultado_id);
	if (isset($dados_usuario["usuario"])) {
		$_SESSION["codigo"] = $dados_usuario["codigo"];
		$_SESSION["usuario"] = $dados_usuario["usuario"];
		$_SESSION["email"] = $dados_usuario["email"];
		header("location:login_correto.php");
	}
}
?>