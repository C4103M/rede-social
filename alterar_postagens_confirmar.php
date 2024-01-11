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
		<?php
		//listando a mensagem pelo código recebido
		$id_postagem = $_GET['id_postagem'];
		include_once "conexao.php";
		$conexao = conecta_mysql();
		$sql = "SELECT * FROM postagem where id_postagem=$id_postagem";
		$resultado = mysqli_query($conexao,$sql);
		if($resultado){
			$mensagem = mysqli_fetch_array($resultado,MYSQLI_ASSOC);
		}
		?>
		<div id="postagem">
			<fieldset>
			<form method="post" action="">
				<p>
					<textarea id="mensagem" name="mensagem" maxlength="140" cols="70" rows="2"
					><?php
					print $mensagem['texto_postagem'];
					?></textarea>
				</p>
				<input type="submit" value="Alterar Mensagem"/>
				<input type="reset" value="Cancelar"/>
			</fieldset>
			</form>
			<?php
			//código PHP aqui!
			if ( isset($_POST["mensagem"]) ){
				$mensagem = $_POST["mensagem"];
				if (strlen($mensagem)>1){
					$conexao = conecta_mysql();
					$sql = "UPDATE postagem SET texto_postagem='$mensagem'
					WHERE id_postagem='$id_postagem'";

					if(mysqli_query($conexao,$sql) ){
						print "<script language='javascript'>alert('Mensagem Alterada!')</script>";
					}
					else{
						print "<script language='javascript'>alert('Erro ao Postar a mensagem')</script>";
					}
				} //fechando o if que testa se a mensagem possui mais de um caracter
				else{
					print "<script language='javascript'>alert('Você não digitou nenhuma mensagem!')</script>";
				}
			} //fechando o isset
			?>
		</div>
	</div> <!-- Div Área principal -->
</body>
</html>
