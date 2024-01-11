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
		<div id="postagem">
			<form method="post" action="">
				<fieldset>
					<p>
						<input type="search" name="usuario" id="usuario" size="40" placeholder="Quem você está procurando?"/>
						<input type="submit" value="Procurar"/>
					</p>
				</fieldset>
			</form>
		</div>
		<?php
		//código para procurar usuários aqui
		include_once "conexao.php";
		if( isset($_POST['usuario']) ){
			$nome_usuario = $_POST['usuario'];
			$codigo_usuario = $_SESSION['codigo'];
			$conexao = conecta_mysql();
			#procurando todos os usuários
			//$sql = "SELECT codigo, usuario FROM usuarios where usuario='$usuario'";

			#Procurando todos os uauários, menos o que está pesquisando.
			$sql = "SELECT codigo, usuario FROM usuarios where usuario LIKE '%$nome_usuario%'
			AND codigo <> $codigo_usuario";
			$resultado = mysqli_query($conexao,$sql);
			if($resultado){
				$usuarios = array();
				while($linha = mysqli_fetch_array($resultado,MYSQLI_ASSOC) ){
					$usuarios[] = $linha;
				}

//procurando os usuários
				foreach ($usuarios as $usuario) {
					print "<div id='postagem' class='clear'>";
						print "<span class='negrito-maior'>".$usuario['usuario']."</span>";
						$codigo_usuario_seguindo = $usuario['codigo'];
						//a consulta abaixo verifica se os dois usuários já são amigos
						$sql = "SELECT * FROM usuarios_seguidores where id_usuario = '$codigo_usuario' and seguindo_id_usuario = $codigo_usuario_seguindo";
						$resultado2 = mysqli_query($conexao,$sql);
						$usuario_pesquisado = mysqli_fetch_array($resultado2);
						//a linha abaixo verifica se retornou algo do banco de dados
						if ( isset($usuario_pesquisado['id_usuario_seguidor']) ){
							print "<span><a href='procurar_pessoas_deixar_seguir.php?codigo=";
							print($usuario['codigo'])."'>Deixar_de_Seguir</a></span>";
						}
						else{
							print "<span><a href='procurar_pessoas_seguir.php?codigo=";
							print($usuario['codigo'])."'>Seguir</a></span>";
						}

					print'</div>';

				}
			} //fechando o if do resultado da consulta
			else{
				print "<script language='javascript'>alert('Nenhum Usuário Encontrado')</script>";
			}
		} //fechando o isset
		?>
	</div> <!-- Div Área principal -->
</body>
</html>
