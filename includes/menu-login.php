<head>
	<link rel="stylesheet" href="css/menu.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<header>
	<div class="princ">
		<img src="img/Vector.svg" alt="Logo" class="logo">
		<div class="menu-mobile">
			<button id="expandir"><span class="material-symbols-outlined">menu</span></button>
			<button id="expandir2"><span class="material-symbols-outlined">close</span></button>
		</div>
		<nav>
			<div class="e1">
				<form method="post" action="" id="form">
					<p>
						<input type="search" name="usuario" id="usuario" class="input" size="40" placeholder="Quem você está procurando?" />
						<button type="submit" class="input-btn" id="input-search"><span class="material-symbols-outlined">search</span></button>
					</p>
				</form>
				<button class="input-btn" id="input-close"><span class="material-symbols-outlined">close</span></button>
				<button class="input-btn" id="input-open"><span class="material-symbols-outlined">search</span></button>
				
				<div class="menu">
					<a href="">Atualizar</a>
					<a href="login_correto.php">TimeLine</a>
					<a href="minhas_postagens.php">Minhas Postagens</a>
					<a href="configuracoes.php">Configurações</a>
					<a href="logout.php">Sair</a>
				</div>
				<button id="exp" class="input-btn"><span class="material-symbols-outlined">menu</span></button>
			</div>
			<script>
				const form = document.querySelector('#form');
				const btnOpen = document.querySelector('#input-open');
				const btnClose = document.querySelector('#input-close');
				const btnSearch = document.querySelector('#input-search');
				const expMenu = document.querySelector("#exp");
				const expMenu2 = document.querySelector(".menu");
				var menOpen = false;
				btnOpen.addEventListener("click", () => {
					form.style.display = 'block';
					btnOpen.style.display = 'none';
					btnClose.style.display = 'block';
					btnClose.style.height = '34px';
					expMenu.style.height = '34px';
				})
				btnClose.addEventListener("click", () =>{
					form.style.display = 'none';
					btnOpen.style.display = 'block';
					btnClose.style.display = 'none';
					

				})

				expMenu.addEventListener("click", () => {
					if (menOpen) {
						expMenu2.style.display = 'none';
						menOpen = false;
					} else {
						expMenu2.style.display = 'flex';
						menOpen = true;
					}
				});
			</script>
			<div class="e2">

			</div>
		</nav>
	</div>
	<div class="opc">
		<form method="post" action="">
			<p>
				<input type="search" name="usuario" id="usuario" class="input" size="40" placeholder="Quem você está procurando?" />
				<button type="submit" class="input-btn" id="input-search"><span class="material-symbols-outlined">search</span></button>
			</p>
		</form>
		<a href="">Atualizar</a>
		<a href="login_correto.php">TimeLine</a>
		<a href="minhas_postagens.php">Minhas Postagens</a>
		<a href="configuracoes.php">Configurações</a>
		<a href="logout.php">Sair</a>
	</div>
</header>

<?php
//código para procurar usuários aqui
include_once "conexao.php";
if (isset($_POST['usuario'])) {
	$nome_usuario = $_POST['usuario'];
	$codigo_usuario = $_SESSION['codigo'];
	$conexao = conecta_mysql();
	#procurando todos os usuários
	//$sql = "SELECT codigo, usuario FROM usuarios where usuario='$usuario'";

	#Procurando todos os uauários, menos o que está pesquisando.
	$sql = "SELECT codigo, usuario FROM usuarios where usuario LIKE '%$nome_usuario%'
			AND codigo <> $codigo_usuario";
	$resultado = mysqli_query($conexao, $sql);
	if ($resultado) {
		$usuarios = array();
		while ($linha = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
			$usuarios[] = $linha;
		}

		//procurando os usuários
		foreach ($usuarios as $usuario) {
			print "<div id='postagem' class='clear'>";
			print "<span class='negrito-maior'>" . $usuario['usuario'] . "</span>";
			$codigo_usuario_seguindo = $usuario['codigo'];
			//a consulta abaixo verifica se os dois usuários já são amigos
			$sql = "SELECT * FROM usuarios_seguidores where id_usuario = '$codigo_usuario' and seguindo_id_usuario = $codigo_usuario_seguindo";
			$resultado2 = mysqli_query($conexao, $sql);
			$usuario_pesquisado = mysqli_fetch_array($resultado2);
			//a linha abaixo verifica se retornou algo do banco de dados
			if (isset($usuario_pesquisado['id_usuario_seguidor'])) {
				print "<span><a href='procurar_pessoas_deixar_seguir.php?codigo=";
				print ($usuario['codigo']) . "'>Deixar_de_Seguir</a></span>";
			} else {
				print "<span><a href='procurar_pessoas_seguir.php?codigo=";
				print ($usuario['codigo']) . "'>Seguir</a></span>";
			}

			print '</div>';
			print("
					<script>form.style.display = 'block';
					btnOpen.style.display = 'none';
					</script>");
		}
	} //fechando o if do resultado da consulta
	else {
		print "<script language='javascript'>alert('Nenhum Usuário Encontrado')</script>";
	}
} //fechando o isset
?>

<script>
	const opc = document.querySelector('.opc');
	const b1 = document.querySelector('#expandir');
	const b2 = document.querySelector('#expandir2');
	b1.addEventListener("click", () => {
		const computedStyle = window.getComputedStyle(opc);
		if (computedStyle.display === 'none') {
			opc.style.display = 'flex';
			b1.style.display = 'none';
			b2.style.display = 'block';
		} else if (computedStyle.display === 'flex') {
			opc.style.display = 'none';
			b1.style.display = 'block';
			b2.style.display = 'none';
		}

	})
	b2.addEventListener("click", () => {
		const computedStyle = window.getComputedStyle(opc);
		if (computedStyle.display === 'none') {
			opc.style.display = 'flex';
			b1.style.display = 'none';
			b2.style.display = 'block';
		} else if (computedStyle.display === 'flex') {
			opc.style.display = 'none';
			b1.style.display = 'block';
			b2.style.display = 'none';
		}

	})
</script>