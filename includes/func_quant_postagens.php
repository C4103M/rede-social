<?php
function total_postagens($codigo,$conexao){
  include_once "../conexao.php";
  $codigo = $codigo;
  $conexao = $conexao;
  $sql = "SELECT * FROM postagem where id_usuario=$codigo";
  $resultado = mysqli_query($conexao,$sql);
  if($resultado){
    $mensagens = array();
    while($linha = mysqli_fetch_array($resultado,MYSQLI_ASSOC) ){
      $mensagens[] = $linha;
    }
  }
  return count($mensagens);
}
?>
