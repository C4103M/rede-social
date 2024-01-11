<?php
session_start();
include "includes/func_bom_dia.php";
include_once "conexao.php";
if ( !isset($_SESSION["codigo"])){
	header("location:index_erro.php?erro=2");
}
$id_usuario = $_SESSION["codigo"];
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
		<div id="div-pessoal" class="borda-arredondada">
			<span class="negrito-maior"><?php print $_SESSION['usuario'];?></span>
			<br/>
			<span class="italico"><?php print $_SESSION['email'];?></span> <br/><br/>
			<hr/><br/>
			<center>
				<table>
					<tr>
						<td width="100px" >TWEETS <br/> <?php
							$conexao = conecta_mysql();
							$sql = "SELECT * FROM postagem where id_usuario=$id_usuario";
							$resultado = mysqli_query($conexao,$sql);
							if($resultado){
								$mensagens = array();
								while($linha = mysqli_fetch_array($resultado,MYSQLI_ASSOC) ){
									$mensagens[] = $linha;
								}
							}
							print count($mensagens);			?>
						</td>
						<td width="100px">SEGUIDORES <br/> <?php
								$sql = "SELECT id_usuario FROM usuarios_seguidores where id_usuario=$id_usuario";
								$resultado2 = mysqli_query($conexao,$sql);
								if($resultado2){
									$seguidores = array();
									while($linha = mysqli_fetch_array($resultado2,MYSQLI_ASSOC) ){
										$seguidores[] = $linha;
									}
								}
								print count($seguidores);			?>
						</td>
					</tr>
				</table>
			</center>
		</div>
		<div id="div-postagem" class="borda-arredondada">
			<form method="post" action="">
				<p>
					<textarea id="mensagem" name="mensagem" maxlength="140" cols="50" rows="4"
					placeholder="<?php
					print bomdia()." O que você vai fuxicar hoje, ".$_SESSION['usuario'];
					?>"></textarea>
				</p>
				<input type="submit" value="Postar"/>
				<input type="reset" value="Cancelar"/>
			</form>
			<?php
			//código PHP aqui!
			$id_usuario = $_SESSION['codigo'];
			if ( isset($_POST["mensagem"]) ){
				$mensagem = $_POST["mensagem"];
				if (strlen($mensagem)>1){
					$conexao = conecta_mysql();
					$sql = "insert into postagem(id_usuario,texto_postagem)
					values('$id_usuario','$mensagem')";

					if(mysqli_query($conexao,$sql) ){
						print "<script language='javascript'>alert('Postagem Realizada!')</script>";
						//header("location: login_correto.php");
					}
					else{
						//print"Erro ao Postar a mensagem";
						print "<script language='javascript'>alert('Erro ao Postar a mensagem')</script>";
					}
				} //fechando o if que testa se a mensagem possui mais de um caracter
			}//fechando o isset
			?>
		</div>
		<div id="div-procurar-pessoa" class="borda-arredondada">
			<br/>
			<a href="procurar_pessoas.php">Procurar pessoas</a>
			<br/><br/>
		</div>
		<div id="postagem" class="clear tamanho-450">
			<?php print"Hoje é ".date("d/M/Y").", horário atual: ".date("H:i");?>
		</div>
		<?php
//Listando as postagens de todos os usuários
		$id_usuario = $_SESSION['codigo'];
		$sql = "SELECT seguindo_id_usuario FROM usuarios_seguidores where id_usuario = '$id_usuario'";
		$resultado = mysqli_query($conexao,$sql);
		$usuarios_que_sigo = array();
		while($linha = mysqli_fetch_array($resultado,MYSQLI_ASSOC) ){
			$usuarios_que_sigo[] = $linha;
		}
		//print_r($usuarios_que_sigo);
		foreach ($usuarios_que_sigo as $usuario_que_sigo) {
			//print "<div id='postagem' class='clear'>";
			$cod_usuario=$usuario_que_sigo['seguindo_id_usuario'];

			$sql = "SELECT u.usuario, p.texto_postagem, date_format(p.data_inclusao, '%d %b %Y, %T') as data_inclusao_formatada
			FROM postagem AS p JOIN usuarios as u ON (u.codigo=p.id_usuario)
			where id_usuario=$cod_usuario
			order by p.data_inclusao desc";
			$resultado = mysqli_query($conexao,$sql);

			if($resultado){
				$mensagens = array();
				while($linha = mysqli_fetch_array($resultado,MYSQLI_ASSOC) ){
					$mensagens[] = $linha;
				}
				foreach ($mensagens as $mensagem) {
					print "<div id='postagem' class='clear'>";
					print "<span class='italico'>".$mensagem["data_inclusao_formatada"]."</span>";
					print "<br><span class='negrito-maior'>".$mensagem['usuario']."</span>";
					print "<br/>".$mensagem["texto_postagem"];
					print"</div>";
				}
			} //fechando o if do resultado da consulta

		} //fechando foreach dos usuários que sigo.


		?>




	</div> <!-- Div Área principal -->
</body>
</html>
