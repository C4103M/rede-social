<!DOCTYPE html!>
<html lang="pt-br">

<head>
	<meta charset="utf-8" />
	<meta name="author" content="Professor" />
	<meta name="description" content="Descrição" />
	<meta name="keywords" content="Palavras, chaves" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<title>PHP com BD</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<link rel="stylesheet" href="css/index.css">
</head>

<body>

	<?php include "includes/menu.php" ?>

	<div id="area-principal">
		<div id="login">
			<form class="card" action="" method="post">
				<div class="card-header">
					<h2>Cadastre-se</h2>
				</div>
				<div class="card-content">
					<div class="card-content-area">
						<label for="usuario">Nome de Usuário: </label>
						<input id="usuario" type="name" name="usuario" autocomplete="off" >
					</div>
					<div class="card-content-area">
						<label>E-mail: </label>
						<input type="email" name="email" id="email" />
					</div>
					<div class="card-content-area">
						<label for="password">Senha: </label>
						<input type="password" name="senha" id="password" autocomplete="off">
					</div>
					<div class="card-content-area">
						<label>Repetir a Senha: </label>
						<input type="password" name="senha2" id="senha2"/>
					</div>

					<div class="card-footer">
						<input type="submit" value="Login" class="submit">
						<a href="index.php" class="cad">Já possui conta? Entre</a>
					</div>
			</form>
		</div>


		<?php
		//código PHP aqui!
		include "conexao.php";
		if (isset($_POST["usuario"])) {
			$usuario = $_POST["usuario"];
			$email = $_POST["email"];
			$senha = $_POST["senha"];
			$senha2 = $_POST["senha2"];

			if (strlen($usuario) < 2) {
				print "<script language='javascript'> alert('Nome do usuário precisa ter pelo menos 2 caraceres') </script>";
			} else if (strlen($email) == 0) {
				print "<script language='javascript'> alert('O e-mail não pode estar em branco!') </script>";
			} else if (strlen($senha) < 1) {
				print "<script language='javascript'> alert('A Senha não pode estar em branco!') </script>";
			} else if ($senha != $senha2) {
				print "<script language='javascript'> alert('As senhas não coincidem!') </script>";
			} else {
				$senha = md5($senha);
				$conexao = conecta_mysql();
				$sql = "insert into usuarios(usuario,email,senha)
					values('$usuario','$email','$senha')";

				if (mysqli_query($conexao, $sql)) {
					//print"Usuário Cadastrado com Sucesso!";
					header("location:login.php?email=$email&senha=$senha");
				} else {
					print "Erro ao Registrar o Usuário!";
				}
			}
		} //fechando o isset
		?>
	</div>
</body>

</html>