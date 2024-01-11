<?php
	function anti_injection($sql){
		$sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
		$sql = strip_tags($sql);//tira tags html e php
		$sql = addslashes($sql);//Adiciona barras invertidas a uma string
		return $sql;
	}
?>