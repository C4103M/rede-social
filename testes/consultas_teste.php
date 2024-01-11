<?php
include "conexao.php";
$conexao = conecta_mysql();
$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conexao,$sql);
if($resultado){
	$usuarios = array();
	//print_r($usuarios);
	while($linha = mysqli_fetch_array($resultado,MYSQLI_ASSOC) ){
		$usuarios[] = $linha;
	}
	//print_r($usuarios);
	//echo $quant_registros = count($usuarios);
echo "Lista de todos os usuários: <br/> <br/>";
	foreach ($usuarios as $dados_usuario) {
		print "Nome:" .$dados_usuario["usuario"];
		print "<br>Email :".$dados_usuario["email"];
		print"<br/><br/>";
	}

}
else{
	echo "Erro na consulta";
}
?>
