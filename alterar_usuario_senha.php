<?php
session_start();
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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<title>PHP com BD</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>

	<?php include "includes/menu-login.php" ?>

	<div id="area-principal">
		<div id="postagem">
			<fieldset>
			<form method="post" action="">
				<p>
					<label>Alterar senha de <strong> <?php print$_SESSION["usuario"]?></strong></label>
				</p><br/>
				<p>
					<label>Nova Senha</label>
					<input type="password" name="senha" id="senha"/>
				</p>
				<p>
					<label>Repetir Nova Senha</label>
					<input type="password" name="senha2" id="senha2"/>
				</p>
				<input type="submit" value="Alterar"/>
				<input type="reset" value="Cancelar"/>
			</fieldset>
			</form>
		</div>
			<?php
			//código PHP aqui!
			include "conexao.php";
			if ( isset($_POST["senha"]) ){
				$codigo = $_SESSION["codigo"];
				$senha = $_POST["senha"];
				$senha2 = $_POST["senha2"];

			 	if (strlen($senha) < 1){
					print "<script language='javascript'> alert('A Senha não pode estar em branco!') </script>";
				}
				else if($senha != $senha2){
					print "<script language='javascript'> alert('As senhas não coincidem!') </script>";
				}
				else{
					$senha = md5($senha);
					$conexao = conecta_mysql();
					$sql = "UPDATE usuarios SET senha='$senha' where codigo = $codigo";
					if( mysqli_query($conexao,$sql) ){
						print"<script language='javascript'>alert('Senha Alterada com Sucesso!')</script>";
					}
					else{
						print"<script language='javascript'>alert('Erro ao Alterar o Usuário!')</script>";
					}
				}

			} //fechando o isset
			?>
	</div>
</body>
</html>
