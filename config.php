<?php
# Config
$LOCAL = 1;
if(!@$REPORTING_ERROR){
	error_reporting(0);
}

session_save_path(@$PATH.@$PATHB."../TMP");

if(isset($_SECURITY[0])){
	if(isset($_SECURITY[0]['horarioVerao'])){
		if($_SECURITY[0]['horarioVerao']===true){
			date_default_timezone_set("America/Fortaleza");
		}else{
			date_default_timezone_set("America/Sao_Paulo");
		}
	}else{
		date_default_timezone_set("America/Sao_Paulo");
	}
}else{
	date_default_timezone_set("America/Sao_Paulo");
}

