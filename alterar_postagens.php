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
			<?php print"Hoje é ".date("d/M/Y").", horário atual: ".date("H:i");?>
		</div>
		<?php
		$id_usuario = $_SESSION['codigo'];
		include_once "conexao.php";
		$conexao = conecta_mysql();
		$sql = "SELECT * FROM postagem where id_usuario=$id_usuario
		order by data_inclusao desc";
		$resultado = mysqli_query($conexao,$sql);
		if($resultado){
			$mensagens = array();
			while($linha = mysqli_fetch_array($resultado,MYSQLI_ASSOC) ){
				$mensagens[] = $linha;
			}
			foreach ($mensagens as $mensagem) {
				print "<div id='postagem' class='clear tamanho-450'>";
				print "Código da Postagem: " .$mensagem["id_postagem"];
				print "<br>Código do Usuário: ".$mensagem["id_usuario"];
				print "<br>Texto da Postagem: ".$mensagem["texto_postagem"];
				print "<br>Data da Postagem: ".$mensagem["data_inclusao"];
				print "<br><a href='alterar_postagens_confirmar.php?id_postagem="
				.$mensagem["id_postagem"]."'>Alterar</a>";
				print"</div>";
			}
		} //fechando o if do resultado da consulta
		else{
			print "<script language='javascript'>alert('Erro na consulta')</script>";
		}
		?>
	</div> <!-- Div Área principal -->
</body>
</html>
