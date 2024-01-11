<?php
function bomdia() {
  $ola = date("H");
  if ( ($ola >=18 and $ola <=23) or ($ola >= 0 and $ola <3)){
    return "Boa Noite!";
  }
  else if ($ola >=3 and $ola <=11 ){
    return "Bom dia!";
  }
  else if ($ola >=12 and $ola <=17 ){
    return "Boa Tarde!";
  }
}
?>
