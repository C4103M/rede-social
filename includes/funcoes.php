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

  function maiusculo($string){
    $string = strtoupper ($string);
    $string = str_replace ("á","Á",$string);
    $string = str_replace ("é","É",$string);
    $string = str_replace ("í","Í",$string);
    $string = str_replace ("ó","Ó",$string);
    $string = str_replace ("ú","Ú",$string);
    $string = str_replace ("â","Â",$string);
    $string = str_replace ("ê","Ê",$string);
    $string = str_replace ("ô","Ô",$string);
    $string = str_replace ("î","Î",$string);
    $string = str_replace ("Û","U",$string);
    $string = str_replace ("ã","Ã",$string);
    $string = str_replace ("õ","Õ",$string);
    $string = str_replace ("ç","Ç",$string);
    $string = str_replace ("á","Á",$string);
    $string = str_replace ("à","À",$string);
    return $string;
  }


  ?>
