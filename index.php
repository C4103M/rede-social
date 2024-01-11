<!DOCTYPE html!>
<html lang="pt-br">

<head>
	<meta charset="utf-8" />
	<meta name="author" content="Caio" />
	<meta name="description" content="Descrição" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="Palavras, chaves" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<title>Connectopia</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body>
	<header>
		<?php include "includes/menu.php" ?>
	</header> 
	<section>
		<div id="login">
            <form class="card" action="" method="post">
                <div class="card-header">
                    <h2>Login</h2>
                </div>
                <div class="card-content">
                    <div class="card-content-area">
                        <label for="usuario">Usuário</label>
                        <input id="usuario" type="email" name="email" autocomplete="off" autofocus>
                    </div>
                    <div class="card-content-area">
                        <label for="password">Senha</label>
                        <input type="password" name="senha" id="password" autocomplete="off">
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="Login" class="submit">
                    <a href="cadastro_usuario.php" class="cad">Não possui conta? Cadastre-se</a>
                </div>
            </form>
        </div>


		<?php
		session_start();
		include "conexao.php";
		if (isset($_POST["email"])) {
			$email = $_POST["email"];
			$senha = md5($_POST["senha"]);

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
				} else {
					echo "<script language='javascript'> alert('E-mail ou senha incorreto!') </script>";
				}
			} else {
				print "Erro na execução da consulta, favor entrar em contato com o admin do site";
			}
		} //fechando o isset
		?>
	</section>

</body>

</html>