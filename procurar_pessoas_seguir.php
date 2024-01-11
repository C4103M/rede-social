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
	<div id="div-area-principal">
		<div id="postagem" class="clear">
			<?php
			if ( isset($_GET['codigo']) ){
				$id_usuario = $_SESSION['codigo'];
				$id_usuario_seguir = $_GET['codigo'];
				include_once "conexao.php";
				$conexao = conecta_mysql();
				$sql = "INSERT INTO usuarios_seguidores (id_usuario, seguindo_id_usuario) values ('$id_usuario','$id_usuario_seguir')";
				$resultado = mysqli_query($conexao,$sql);
				if($resultado){
					print "Agora você está seguindo este usuário";
				}
			} //fechando o isset
			?>
		</div>

	</div> <!-- Div Área principal -->
</body>
</html>
