<!DOCTYPE html!>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta name="author" content="Professor"/>
	<meta name="description" content="Descrição"/>
	<meta name="keywords" content="Palavras, chaves"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<title>PHP com BD</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
	<?php include "includes/menu.php" ?>
	<div id="area-principal">
		<div id="postagem">
			<?php
				$erro = $_GET["erro"];
				//se o erro for igual a 1 indica que o login não foi feito.
				if($erro==1){
					print"E-mail e/ou senha incorreto(s)!";
				}
				if($erro==2){
					//print"Para cadastrar uma mensagem é necessário fazer login.";
					echo "<script language='javascript'>
					alert('Para cadastrar uma mensagem é necessário fazer login.')
					</script>";
				}
			?>
		</div>
	</div>
</body>
</html>
