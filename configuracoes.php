<?php
session_start();
include_once "conexao.php";
if ( !isset($_SESSION["codigo"])){
	header("location:index_erro.php?erro=2");
}
?>
<!DOCTYPE html!>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta name="author" content="Professor"/>
	<meta name="description" content="Descrição"/>
	<meta name="keywords" content="Palavras, chaves"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
	integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>PHP com BD</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>

	<?php include "includes/menu-login.php" ?>

	<div class="container">
		<div id="div-pessoal" class="borda-arredondada">
			Nome: <span class="negrito-maior"><?php print $_SESSION['usuario'];?></span> <br/>
			E-mail: <span class="italico"><?php print $_SESSION['email'];?></span> <br/>
			Código: <span class="italico"><?php print $_SESSION['codigo'];?></span><br/>
		</div>
		<div id="postagem" class="clear">
			<a href="alterar_usuario_nome.php">Alterar Nome do Usuário</a><br/><br/>
			<a href="alterar_usuario_senha.php">Alterar Senha do Usuário</a><br/><br/>
			<a href="alterar_usuario_email.php">Alterar E-mail do Usuário</a><br/><br/>
			<a href="alterar_postagens.php">Alterar Postagens</a><br/><br/>
			<a href="excluir_postagens-1.php">Excluir Postagens (Digitando Código)</a><br/><br/>
			<a href="excluir_postagens-2.php">Excluir Postagens (Automático)</a><br/>

		</div>
	</div> <!-- Div Área principal -->
</body>
</html>
