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
			<form method="post" action="">
				<fieldset>
					<p>
						<label>Código do usuario</label>
						<input type="text" name="codigo" id="codigo" disabled value="<?php print$_SESSION["codigo"]?>"/>
					</p>
					<p>
						<label>E-mail do usuario</label>
						<input type="email" name="email" id="email" value="<?php print$_SESSION["email"]?>"/>
					</p>
					<input type="submit" value="Alterar"/>
					<input type="reset" value="Cancelar"/>
				</fieldset>
			</form>
		</div>
		<?php
		//código PHP aqui!
		include "conexao.php";
		if ( isset($_POST["email"]) ){
			$codigo = $_SESSION["codigo"];
			$email = $_POST["email"];
			if( strlen($email)<2 ){
				print "<script language='javascript'> alert('E-mail do usuário precisa ter pelo menos 2 caraceres') </script>";
			}
			else{
				$conexao = conecta_mysql();
				$sql = "SELECT * FROM usuarios SET where email = $email";
				if( mysqli_query($conexao,$sql) ){
					print"<script language='javascript'>alert('Este e-mail já existe, por favor escolha outro E-MAIL')</script>";
				}
				else{
					$sql = "UPDATE usuarios SET email='$email' where codigo = $codigo";
					if( mysqli_query($conexao,$sql) ){
						$_SESSION['email'] = $email;
						header("location:login_correto.php");
					}
					else{
						print"<script language='javascript'>alert('Erro ao Alterar o Usuário!')</script>";
					}
				}
			}
		} //fechando o isset
		?>
	</div>
</body>
</html>
