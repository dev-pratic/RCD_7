<?php
$opacity = 90;

# Mensagem
$baseMsg = new space($page,"baseMsg","center");
$baseMsg->css->zIndex(998);
$baseMsg->css->setInvisible();
$baseMsg->css->setPosition(0, 0,"fixed");
$baseMsg->css->width("100%");
$baseMsg->css->height("100%");
$baseMsg->css->overflow("auto");

$baseBaseMsg = new space($baseMsg,"baseBaseMsg","center");
$baseBaseMsg->css->zIndex(999);
$baseBaseMsg->css->setPosition(0, 0,"fixed");
$baseBaseMsg->css->width("100%");
$baseBaseMsg->css->height("100%");
$baseBaseMsg->css->opacity($opacity);
$baseBaseMsg->css->backGroundColor("rgb(10,40,80)");
$msg = new space($baseMsg, "msg","center","msg");
$msg->css->zIndex(1000);
$msg->css->position("relative");
$msg->css->marginTop(20);
$textoMsg = new space($msg, "textoMsg","center","textoMsg");
$textoMsg->css->marginTop(10);
$textoMsg->css->fontSize(36);

# Condicional
if(!isset($classBtYes)){
	$classBtYes = btGreen." btn btn-lg btn-success";
}
if(!isset($classBtNo)){
	$classBtNo = btYellow." btn btn-lg btn-warning";
}

$condicional = new table($msg, "condicional");
$condicional->css->marginBottom(60);
$condicional->newLine();
$condicional->newCell();
$btYes = new button($condicional->getCellObj(),"btYes","Ok",$classBtYes);
$btYes->css->minWidth(40);
$btYes->css->fontSize(24);
$btYes->css->marginRight(20);
$btYes->java->setOnClick();
$condicional->newCell();
$btNo = new button($condicional->getCellObj(),"btNo","Cancelar",$classBtNo);
$btNo->css->minWidth(40);
$btNo->css->fontSize(24);
$btNo->java->setOnClick();

$space = new space($msg, "spaceB","center","textoMsg");

function showMsg($pxm=0,$pym=0,$myMsg="Nenhuma Mensagem",$pathCaseYes="",$pathCaseNo="",$type="n",$textAlign="center"){
	showMsgNovo($myMsg,$pathCaseYes,$pathCaseNo,$type,$textAlign);
}

function showMsgNovo($myMsg="Nenhuma Mensagem",$pathCaseYes="",$pathCaseNo="",$type="n",$textAlign="center",$objAffected=false,$backGroundColor=COLOR_ULTRA_DARK_RED){
	global $baseMsg;
	global $msg;
	global $textoMsg;
	global $btYes;
	global $btNo;
	global $PAGENAME;
	global $baseBaseMsg;
	global $js;
	global $page;

	if(!isset($js) || !isset($js->test)){
		$js = new javaExe(true,$page,"profiableJavaExeB");
	}
	
	$js->visible("baseMsg");
	$js->visible("msg");

	$textoMsg->inSide($myMsg);
	
	if($msg->stringToUpper($type)=="N"){
		$btYes->setValue("Ok");
		$btNo->setValue("Cancelar");
	}else if($msg->stringToUpper($type)=="Z"){
		$btYes->setValue("Ok");
		$btNo->setValue("Pedir Permissão");
	}else{
		$btYes->setValue("Sim");
		$btNo->setValue("Não");
	}
	
	if($pathCaseYes=="" && $pathCaseYes!==false){
		$pathCaseYes = $_SERVER['SCRIPT_NAME'];
		$btYes->java->setFunctionGoToPage($pathCaseYes);
		$btYes->java->setObjVisible("click", "btYes", "baseCarregando");
	}else if($pathCaseYes=="close"){
		$btYes->java->setFunctionCloseObj("baseMsg");
	}else if($pathCaseYes=="submitForm"){
		$btYes->java->setSubmitForm("click", "btYes", $objAffected);
		$btYes->java->setObjVisible("click", "btYes", "baseCarregando");
	}else if($pathCaseYes!==false){
		$btYes->java->setFunctionGoToPage($pathCaseYes);
		$btYes->java->setObjVisible("click", "btYes", "baseCarregando");
	}

	if($pathCaseNo==""){
		$pathCaseNo = $pathCaseYes;
		if($pathCaseNo=="" && $pathCaseNo!==false){
			$btNo->java->setFunctionGoToPage($pathCaseNo);
			$btNo->java->setObjVisible("click", "btNo", "baseCarregando");
		}else if($pathCaseNo=="close"){
			$btNo->java->setFunctionCloseObj("baseMsg");
		}else if($pathCaseNo!==false){
			$btNo->java->setFunctionGoToPage($pathCaseNo);
			$btNo->java->setObjVisible("click", "btNo", "baseCarregando");
		}
	}else if($pathCaseNo!==false){
		if($pathCaseNo=="close"){
			$btNo->java->setFunctionCloseObj("baseMsg");
		}else{
			$btNo->java->setFunctionGoToPage($pathCaseNo);
			$btNo->java->setObjVisible("click", "btNo", "baseCarregando");
		}
	}

	if($backGroundColor!==false){
		$js->setBackgroundColor("baseBaseMsg",$backGroundColor);
	}

	if($pathCaseYes==$pathCaseNo){
		$js->invisible("btNo");
	}

	return true;
}

function msgError($myMsg="Nenhuma Mensagem",$pathCaseYes="close",$pathCaseNo="close",$type="n",$textAlign="center",$objAffected=false,$backGroundColor=COLOR_ULTRA_DARK_RED){
	showMsgNovo($myMsg,$pathCaseYes,$pathCaseNo,$type,$textAlign,$objAffected,$backGroundColor);
}

function msgSuccess($myMsg="Nenhuma Mensagem",$pathCaseYes="close",$pathCaseNo="close",$type="n",$textAlign="center",$objAffected=false,$backGroundColor=COLOR_ULTRA_DARK_GREEN){
	showMsgNovo($myMsg,$pathCaseYes,$pathCaseNo,$type,$textAlign,$objAffected,$backGroundColor);
}

function refreshShowMsg($pageToGo=THIS,$myMsg="Nenhuma Mensagem",$pathCaseYes="",$pathCaseNo="",$type="n",$textAlign="center",$objAffected=false,$backGroundColor=COLOR_ULTRA_DARK_RED){
	global $page;
	global $PAGENAME;
	
	$page->session->setSession("SYSTEM_MSG",$myMsg);
	$page->session->setSession("SYSTEM_PATH_CASE_YES",$pathCaseYes);
	$page->session->setSession("SYSTEM_PATH_CASE_NO",$pathCaseNo);
	$page->session->setSession("SYSTEM_TYPE",$type);
	$page->session->setSession("SYSTEM_TEXT_ALIGN",$textAlign);
	$page->session->setSession("SYSTEM_OBJ_AFFECTED",$objAffected);
	$page->session->setSession("SYSTEM_BACKGROUNDCOLOR",$backGroundColor);
	
	$page->goToPage($pageToGo);
}

function msgErrorRefresh($pageToGo=THIS,$myMsg="Nenhuma Mensagem",$pathCaseYes="close",$pathCaseNo="close",$type="n",$textAlign="center",$objAffected=false,$backGroundColor=COLOR_ULTRA_DARK_RED){
	refreshShowMsg($pageToGo,$myMsg,$pathCaseYes,$pathCaseNo,$type,$textAlign,$objAffected,$backGroundColor);
}

function msgSuccessRefresh($pageToGo=THIS,$myMsg="Nenhuma Mensagem",$pathCaseYes="close",$pathCaseNo="close",$type="n",$textAlign="center",$objAffected=false,$backGroundColor=COLOR_ULTRA_DARK_GREEN){
	refreshShowMsg($pageToGo,$myMsg,$pathCaseYes,$pathCaseNo,$type,$textAlign,$objAffected,$backGroundColor);
}

if($page->session->getSession("SYSTEM_MSG")){
	showMsgNovo($page->session->getSession("SYSTEM_MSG"),$page->session->getSession("SYSTEM_PATH_CASE_YES"),$page->session->getSession("SYSTEM_PATH_CASE_NO"),$page->session->getSession("SYSTEM_TYPE"),$page->session->getSession("SYSTEM_TEXT_ALIGN"),$page->session->getSession("SYSTEM_OBJ_AFFECTED"),$page->session->getSession("SYSTEM_BACKGROUNDCOLOR"));

	$page->session->unSetSession("SYSTEM_MSG");
	$page->session->unSetSession("SYSTEM_PATH_CASE_YES");
	$page->session->unSetSession("SYSTEM_PATH_CASE_NO");
	$page->session->unSetSession("SYSTEM_TYPE");
	$page->session->unSetSession("SYSTEM_TEXT_ALIGN");
	$page->session->unSetSession("SYSTEM_OBJ_AFFECTED");
	$page->session->unSetSession("SYSTEM_BACKGROUNDCOLOR");
}

# Carregando
$baseCarregando = new space($page,"baseCarregando","center");
$baseCarregando->css->zIndex(998);
$baseCarregando->css->setInvisible();
$baseCarregando->css->setPosition(0, 0,"fixed");
$baseCarregando->css->width("100%");
$baseCarregando->css->height("100%");
$baseCarregandoScape = new space($baseCarregando,"baseCarregandoScape","center");
$baseCarregandoScape->java->setObjInvisible("dblclick","baseCarregandoScape","baseCarregando");
$baseCarregandoScape->css->zIndex(1500);
$baseCarregandoScape->css->setPosition(0, 0,"fixed");
$baseCarregandoScape->css->width("60px");
$baseCarregandoScape->css->height("60px");
$baseBaseCarregando = new space($baseCarregando,"baseBaseCarregando","center");
$baseBaseCarregando->css->zIndex(999);
$baseBaseCarregando->css->setPosition(0, 0,"fixed");
$baseBaseCarregando->css->width("100%");
$baseBaseCarregando->css->height("100%");
$baseBaseCarregando->css->opacity($opacity);
$baseBaseCarregando->css->backGroundColor("rgb(10,40,80)");
$carregando = new space($baseCarregando, "carregando","center","msg");
$carregando->css->zIndex(1000);
$carregando->css->position("relative");
$carregando->css->marginTop(120);
$textoCarregando = new space($carregando, "textoCarregando","center","textoMsg");
$textoCarregando->css->marginTop(10);
$textoCarregando->css->marginBottom(10);
$textoCarregando->css->fontSize(36);
$textoCarregando->inSideBold("Carregando...");

if(!isset($TIPO_CARREGANDO)){
	$msgTextoCarregando[0] = "<b>Carregando...<br>Desculpe-nos pela demora...</b>";
	$msgTextoCarregando[1] = "<b>Carregando...<br>Está demorando mais do que o normal...<br>Se preferir <a href=\"".THIS."\" style=\"color:".COLOR_ORANGE.";font-size:36px;\">clique aqui</a> para recarregar a página!</b>";
	$tempoMsgTextoCarregando[0] = 10;
	$tempoMsgTextoCarregando[1] = 60;
}else{
	if($TIPO_CARREGANDO==1){
		$msgTextoCarregando[0] = "<b>Carregando...<br>Desculpe-nos pela demora...</b>";
		$msgTextoCarregando[1] = "<b>Carregando...<br>Está demorando mais do que o normal...<br>Se preferir <a href=\"".THIS."\" style=\"color:".COLOR_ORANGE.";font-size:36px;\">clique aqui</a> para recarregar a página!</b>";
		$tempoMsgTextoCarregando[0] = 10;
		$tempoMsgTextoCarregando[1] = 60;
	}else{
		$msgTextoCarregando[0] = "<b>Carregando...<br>Esse relatório demora um pouco para ser carregado!</b>";
		$msgTextoCarregando[1] = "<b>Carregando...<br>Está demorando mais do que o normal!<br>Se preferir <a href=\"".THIS."\" style=\"color:".COLOR_ORANGE.";font-size:36px;\">clique aqui</a> para recarregar a página!</b>";
		$tempoMsgTextoCarregando[0] = 20;
		$tempoMsgTextoCarregando[1] = 600;
	}
}

$textoCarregando->inSide("
	<script language=\"javascript\">
		var objBaseCarregando = document.getElementById('baseCarregando');
		var objTextoCarregando = document.getElementById('textoCarregando');
		var statusBaseCarregando = 0;
		var avisoDemora = ".$tempoMsgTextoCarregando[0].";
		var avisoRecarregar = ".$tempoMsgTextoCarregando[1].";
		
		setInterval(function(){
			if(objBaseCarregando.style.display==\"block\" && statusBaseCarregando==0){
				statusBaseCarregando++;
			}else if(objBaseCarregando.style.display==\"block\" && statusBaseCarregando==avisoDemora){
				statusBaseCarregando = statusBaseCarregando + 1;
				objTextoCarregando.innerHTML = '".$msgTextoCarregando[0]."';
			}else if(objBaseCarregando.style.display==\"block\" && statusBaseCarregando<avisoRecarregar){
				statusBaseCarregando = statusBaseCarregando + 1;
			}else if(objBaseCarregando.style.display==\"block\" && statusBaseCarregando==avisoRecarregar){
				statusBaseCarregando = statusBaseCarregando + 1;
				objTextoCarregando.innerHTML = '".$msgTextoCarregando[1]."';
			}else if(objBaseCarregando.style.display!=\"block\"){
				statusBaseCarregando = 0;
				objTextoCarregando.innerHTML = '<b>Carregando...</b>';
			}
		},1000);
		
		var contOpen = 0;
		var contClose = 0;
		var contCloseB = 0;
		var timeoutClose = 1;
		contCloseB = timeoutClose;
		
		function openBaseCarregando(){
			contOpen = 1;
			objBaseCarregando.style.display = \"block\";
		}
		
		function closeBaseCarregando(){
			contOpen = 0;
		}
		
		setInterval(function(){
			if(contOpen==1 && contClose==0){
				contClose = 1;
				contCloseB = 0;				
			}else if(contOpen==1 && contClose==1){
				contCloseB = 0;	
			}else if(contCloseB<timeoutClose){
				contCloseB = contCloseB + 1;
			}else{
				contClose = 0;
				contCloseB = 0;
				objBaseCarregando.style.display = \"none\";
			}
		},100);
	</script>
");

$stlCorpoZ = new style("stlCorpoZ","#","corpoZ",$page);
$stlCorpoZ->fontSize(24);
$stlCorpoZ->color(COLOR_WHITE);

$BASE_CARREGANDO_CONT = true;