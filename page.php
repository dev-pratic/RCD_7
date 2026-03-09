<?php
# Page
include_once 'color.php';
include_once 'session.php';
include_once 'head.php';
include_once 'body.php';

$NO_REPOSITION_CORPO = false;
$BOOTSTRAP = false;

class page extends generic {
	private $title = "SEM TÍTULO";
	private $loadJava = true;
	private $loadCss = true;
	private $resetAutoSave = false;
	private $readOnly = false;
	private $imprimir = false;
	private $autoCompleteOff = true;
	private $uppercase = true;
	private $isParent = false;
	private $bootstrap = false;
	public $head;
	public $color;
	public $body;
	public $session;
	public $s;
	public $linksJs = array();
	public $path;
	
	function __construct($name){
		global $PATH;
		global $PATHB;
		
		$this->name = $name;
		$this->newObj($this,"PAGE_".$this->name,"page","html");
		$name = "session";
		$this->session = new session();
		$this->s = $this->session;
		$this->newObj($this->session,$name,"session","PAGE_".$this->name);
		$name = "head";
		$this->head = new head($name);
		$this->newObj($this->head,$name,"head","PAGE_".$this->name);
		$this->head->linkIco(@$PATH.@$PATHB."imagens/fav/");
		$name = "body";
		$this->body = new body($this->name);
		$this->newObj($this->body,$this->name,"body","PAGE_".$this->name);
		$this->color = new color();
		$this->nivel = -1;
		global $PAGENAME;
		if($this->session->getSession("PRINT",$PAGENAME)){
			$this->imprimir = true;
			$this->body->imprimir();
		}
	}

	public function getBootstrap(){
		return $this->bootstrap;
	}
	
	public function useBootstrap(){
		global $BOOTSTRAP;

		$BOOTSTRAP = true;
		$this->bootstrap = true;
	}
	
	public function getIsParent(){
		return $this->isParent;
	}
	
	public function setAsParent(){
		$this->isParent = true;
	}
	
	public function imprimir(){
		$this->imprimir = true;
	}
	public function getAutocompleteOff(){
		return $this->autoCompleteOff;
	}
	
	public function getUpperCase(){
		return $this->uppercase;
	}
	
	public function setReadOnly(){
		$this->readOnly = true;
	}
	public function getReadOnly(){
		return $this->readOnly;
	}
	public function getResetAutoSave(){
		return $this->resetAutoSave;
	}
	public function getLoadCss(){
		return $this->loadCss;
	}
	public function getLoadJava(){
		return $this->loadJava;
	}
	public function setOnLoadFunction($obj){
		$this->body->java->setOnLoad();
		$this->body->java->setFunctionObjInvisible();
		$this->body->objAction = $obj;
	}
	public function setOnLoadFunctionB($obj){
		$this->body->onLoadFunction = $obj;
	}
    public function getPageName(){
        return "PAGE_".$this->name;
    }
    public function meta($arg1,$arg2="",$arg3=""){
        $this->head->meta($arg1,$arg2,$arg3);
	}
	public function setPath($path){
		$this->head->setPath($path);
	}
	public function linkIco($address,$force=false){
		if($force===false){
			$this->head->linkIco($address);
		}else{
			$this->head->linkIco($address.$this->getStatus());
		}
	}
	public function linkCss($address,$withoutPath=false,$force=false,$before=false){
		if($force===false){
			$this->head->linkCss($address,$withoutPath,$before);
		}else{
			$this->head->linkCss($address.$this->getStatus(),$withoutPath,$before);
		}
	}
	public function linkJs($address,$before=false,$force=false){
		$id = count($this->linksJs);
		if($force===false){
			$this->linksJs[$id]['address'] = $this->path.$address;
		}else{
			$this->linksJs[$id]['address'] = $this->path.$address.$this->getStatus();
		}
		$this->linksJs[$id]['before'] = $before;
	}
	public function setTitle($title){
		$this->title = $title;
	}
	public function getStatus(){
		global $_ENVIRONMENT;
		global $_ENVIRONMENT_FORCED;
		global $REPORTING_ERROR;
		if(isset($_ENVIRONMENT)){
			if($_ENVIRONMENT===true){
				if($this->session->getSession("ENVIRONMENT_NO_FORCED")!="1" || $_ENVIRONMENT_FORCED===true){
					return "?".time();
				}else{
					return "";
				}
			}else{
				return "";
			}
		}else if($REPORTING_ERROR){
			if($this->session->getSession("ENVIRONMENT_NO_FORCED")!="1"){
				return "?".time();
			}else{
				return "";
			}
		}else{
			return "";
		}
	}
	public function End($parent=false,$isCore=false,$showCountSelect=false){
		global $page;
		global $PAGENAME;
		global $NO_REPOSITION_CORPO;
		global $CURL_EXECTED;
		global $PATH;
		global $PATHB;
		global $REPORTING_ERROR;
		global $_SECURITY;
		global $countSelect;
		global $_ENVIRONMENT;
		global $_ENVIRONMENT_FORCED;

		if(!isset($PATHB)){
			$PATHB = "";
		}

		if($showCountSelect===true){
			msgSuccess("Total Select: ".$countSelect);
		}

		$manutencao = false;
		if(isset($_SECURITY[0])){
			if(isset($_SECURITY[0]['manutencao'])){
				if($_SECURITY[0]['manutencao']===true){
					if($page->session->getSession("manutencao","manutencao")!="b776c7b56c8737330c3da3fecc9477de8a7489e4a812be61bc0b2747c6edeef5"){
						$manutencao = true;
					}
				}
			}
		}
				
		if($manutencao===false){
			$corpo = $this->getObj("corpo");
			if($corpo!==false && $this->imprimir!==true && !$this->session->getSession("PRINT",$PAGENAME) && !$NO_REPOSITION_CORPO){
				if($this->bootstrap){
					$corpo->css->setPosition(0, 90,"relative");
				}else{
					$corpo->css->setPosition(0, 80,"relative");
				}
			}
			$this->e("<!doctype html>");
			$this->e("<html lang=\"pt-BR\">");
			$this->e("<title>".$this->title."</title>");
			global $NO_GET_WIDTH;
			if($this->bootstrap){
				$online = false;

				if(isset($_SECURITY[0])){
					if(isset($_SECURITY[0]['online'])){
						if($_SECURITY[0]['online']===true){
							$online = true;
						}
					}
				}

				if($online===true){
					$this->head->linkCss("http://prospera.net.br/RCD_7/bootstrap/css/bootstrap.css".$this->getStatus(),true);
				}else{
					$this->head->linkCss("../RCD_7/bootstrap/css/bootstrap.css".$this->getStatus());
				}
			}

			global $isPaginaNormal;
			if(!isset($isPaginaNormal)){
				if($parent===false){
					$this->head->linkCss("class/generic.css".$this->getStatus());
				}
			}else if($isPaginaNormal==1){
				$this->head->linkCss("class/generic.css".$this->getStatus());
			}
			$this->endObj("PAGE_".$this->name,"head");
			if(!$this->bootstrap){
				$this->e("<style>");
				$this->endObj("","style");
				$this->e("</style>");
			}else{
				if(isset($_SECURITY[0])){
					if(isset($_SECURITY[0]['NO_IGNORE_STYLES'])){
						if($_SECURITY[0]['NO_IGNORE_STYLES']===true){
							$this->e("<style>");
							$this->endObj("","style");
							$this->e("</style>");
						}
					}
				}
			}
			if(isset($this->linksJs)){
				foreach ($this->linksJs as $key => $value){
					if($this->linksJs[$key]['before']===true){
						$this->e("<script language=\"JavaScript\" src=\"".$this->linksJs[$key]['address']."\"  charset=\"UTF-8\"></script>");
					}
				}
			}
			$this->endObj("PAGE_".$this->name);
			if(isset($this->linksJs)){
				foreach ($this->linksJs as $key => $value){
					if($this->linksJs[$key]['before']===false){
						$this->e("<script language=\"JavaScript\" src=\"".$this->linksJs[$key]['address']."\"  charset=\"UTF-8\"></script>");
					}
				}
			}
			$this->e("<script language=\"javascript\">");
			$this->endObj("","java");
			$this->e("</script>");
			if($this->bootstrap){
				$online = false;

				if(isset($_SECURITY[0])){
					if(isset($_SECURITY[0]['online'])){
						if($_SECURITY[0]['online']===true){
							$online = true;
						}
					}
				}

				if($online===true){
					$this->e("<script src=\"http://prospera.net.br/RCD_7/bootstrap/js/jquery-3.3.1.slim.min.js".$this->getStatus()."\"></script>",$this->nivel + 1);
					$this->e("<script src=\"http://prospera.net.br/RCD_7/bootstrap/js/bootstrap.min.js".$this->getStatus()."\"></script>",$this->nivel + 1);
				}else{
					$this->e("<script src=\"".$PATH.$PATHB."../RCD_7/bootstrap/js/jquery-3.3.1.slim.min.js".$this->getStatus()."\"></script>",$this->nivel + 1);
					$this->e("<script src=\"".$PATH.$PATHB."../RCD_7/bootstrap/js/bootstrap.min.js".$this->getStatus()."\"></script>",$this->nivel + 1);
				}
			}
			if(isset($_ENVIRONMENT)){
				if($_ENVIRONMENT===true){
					if($this->session->getSession("ENVIRONMENT_NO_FORCED")!="1" || $_ENVIRONMENT_FORCED===true){
						$this->e("<head>");
						$this->e("<meta http-equiv=\"cache-control\" content=\"no-cache\" />",$this->nivel + 1);
						$this->e("<meta http-equiv=\"pragma\" content=\"no-cache\" />",$this->nivel + 1);
						$this->e("</head>");
					}
				}
			}
			if($this->imprimir===true){
				$this->e("
				<SCRIPT LANGUAGE=\"JavaScript\">
					window.print();
				</SCRIPT>
				");
			}
			if($parent){
				if($parent!==true){
					if($isCore===false){
						$this->e("
						<SCRIPT LANGUAGE=\"JavaScript\">
							parent.document.getElementById('".$parent."').innerHTML = document.body.innerHTML;
							parent.closeBaseCarregando();
						</SCRIPT>
						");
					}else{
						$this->e("
						<SCRIPT LANGUAGE=\"JavaScript\">
							parent.document.getElementById('".$parent."').innerHTML = document.body.innerHTML;
							parent.closeBaseCarregandoCore();
						</SCRIPT>
						");
					}
				}
			}else{
				$this->e("
					<SCRIPT LANGUAGE=\"JavaScript\">
						var globalActionYes;
						var globalActionNo;
						var msgGate = false;
						function msg(msg,type,actionYes,actionNo,condition,msgB){
							try{
								msgGate = true;
								var baseMsgId = document.getElementById('baseMsg');
								var baseBaseMsgId = document.getElementById('baseBaseMsg');
								var msgId = document.getElementById('msg');
								var textoMsgId = document.getElementById('textoMsg');
								var textoMsgBid = document.getElementById('textoMsgB');
								var yesId = document.getElementById('btYes');
								var noId = document.getElementById('btNo');
								/*var botoesMsgId = document.getElementById('botoesMsg');
							
								botoesMsgId.style.display = 'block';*/
								
								if(typeof condition!=='undefined'){
									if(condition!=false){
										yesId.innerHTML = 'Sim';
										noId.innerHTML = 'Não';
									}else{
										yesId.innerHTML = 'Ok';
										noId.innerHTML = 'Cancelar';
									}
								}else{
									yesId.innerHTML = 'Ok';
									noId.innerHTML = 'Cancelar';
								}
							
								textoMsgId.innerHTML = msg;
								
								/*if(typeof msgB!=='undefined'){
									textoMsgBid.innerHTML = msgB;
								}else{
									textoMsgBid.innerHTML = '';
								}*/
							
								if(type==1){
									baseBaseMsgId.style.backgroundColor = 'rgb(20,100,20)';
								}else if(type==-1){
									baseBaseMsgId.style.backgroundColor = 'rgb(120,10,10)';
								}else{
									baseBaseMsgId.style.backgroundColor = 'rgb(0,40,70)';
								}
							
								baseMsgId.style.display = 'block';
								msgId.style.display = 'block';
							
								if(typeof actionNo==='undefined'){
									actionNo = actionYes;
								}
								
								globalActionYes = actionYes;
								globalActionNo = actionNo;
							}catch(e){
								alert('msg: ' + e);
							}
						}
						function exeActionYes(){
							if(globalActionYes=='close'){
								msgClose();
							}else if(globalActionYes=='aprovar'){
								aprovar();
							}else if(globalActionYes=='ativar'){
								ativar();
							}else if(globalActionYes=='desativar'){
								desativar();
							}else if(globalActionYes=='desaprovar'){
								desaprovar();
							}else if(globalActionYes=='desfaturar'){
								desfaturar();
							}else if(globalActionYes=='faturar'){
								faturar();
							}else if(globalActionYes=='bloquear'){
								bloquear();
							}else if(globalActionYes=='resetar'){
								resetar();
							}else if(globalActionYes=='liberar'){
								liberar();
							}else if(globalActionYes=='estornar'){
								estornar();
							}else if(globalActionYes=='concluir'){
								concluir();
							}else if(globalActionYes=='alterar'){
								alterar();
							}else if(globalActionYes=='naoAlterar'){
								naoAlterar();
							}else if(globalActionYes=='forcado'){
								forcado();
							}else{
								go(globalActionYes);
							}
						}
						
						function exeActionNo(){
							if(globalActionNo=='close'){
								msgClose();
							}else if(globalActionNo=='ativar'){
								ativar();
							}else if(globalActionNo=='desativar'){
								desativar();
							}else if(globalActionNo=='bloquear'){
								bloquear();
							}else if(globalActionNo=='resetar'){
								resetar();
							}else if(globalActionNo=='liberar'){
								liberar();
							}else if(globalActionNo=='estornar'){
								estornar();
							}else if(globalActionNo=='concluir'){
								concluir();
							}else if(globalActionNo=='alterar'){
								alterar();
							}else if(globalActionNo=='naoAlterar'){
								naoAlterar();
							}else if(globalActionNo=='forcado'){
								forcado();
							}else{
								go(globalActionNo);
							}
						}

						function msgClose(){
							var msgId = document.getElementById('baseMsg');
							msgId.style.display = 'none';
						}

						document.getElementById('btYes').addEventListener('click', function(){
							if(msgGate===true){
								msgGate = false;
								exeActionYes();
							}
						}, true);

						document.getElementById('btNo').addEventListener('click', function(){
							if(msgGate===true){
								msgGate = false;
								exeActionNo();
							}
						}, true);
					</SCRIPT>
				");
			}
			$this->e("</html>");
			$this->e("<!-- SCREEN WIDTH: ".$this->session->getSession("SW")." -->",0,0);
			
			if(isset($_ENVIRONMENT)){
				if($_ENVIRONMENT===true){
					if($this->session->getSession("ENVIRONMENT_NO_FORCED")!="1" || $_ENVIRONMENT_FORCED===true){
						global $OBJ;
						global $HTML;
						for($i=0;$i<count($OBJ);$i++){
							$name = $OBJ[$i]['name'];
							$type = $OBJ[$i]['type'];
							$father = $OBJ[$i]['father'];
							#if($type=="style" || $type=="java"){
								$this->e("<!-- OBJ ".$i." - TYPE: ".$type." - FATHER: ".$father." - NAME: ".$name." -->");
							#}
						}
						global $TYPE_SETTED;
						for($i=0;$i<count($TYPE_SETTED);$i++){
							$this->e("<!-- TYPE.: ".$TYPE_SETTED[$i]." -->");
						}
						
						$MEMORY = $this->memoryUsage();
						$BYTES_PAGE = $this->getBytesPage();

						$this->e("<!-- MEMORY.: ".$MEMORY." -->");
						$this->e("<!-- BYTES PAGE.: ".$BYTES_PAGE." -->");
						
						$MEMORY = $this->memoryUsage(true);
						$BYTES_PAGE = $this->getBytesPage(true);

						global $TIME_LOAD_START;
						$TIME_LOAD_END = microtime_float();

						$TIME = ($TIME_LOAD_END - $TIME_LOAD_START);
						
						$this->e("<!-- TIME.: ".$TIME." -->");

						/*if($this->s->getLoginId()){
							global $idsa;
							global $PAGENAME;
							global $_SECURITY;

							$DATA_CRIACAO = mktime(0,0,0,date("n"),date("d"),date("Y"));

							$selSegPage = new iSelect($idsa,"sistema_carga");
							$selSegPage->where("dataCriacao","=",$DATA_CRIACAO);
							$selSegPage->setAnd("pageName","=",$PAGENAME,true);

							if($selSegPage->exe()!==false){
								if($selSegPage->getNumRows()==0){
									$insSegPage = new iInsert($idsa,"sistema_carga");
									$insSegPage->set("dataCriacao",$DATA_CRIACAO);
									$insSegPage->set("pageName",$PAGENAME);
									if($_SECURITY[0]['localHost']=="192.168.1.40"){
										$insSegPage->set("time",$TIME);
										$insSegPage->set("memory",$this->clearNumber($MEMORY,true));
										$insSegPage->set("bytesPage",$this->clearNumber($BYTES_PAGE,true));
										$insSegPage->set("occurrences","1");
										$insSegPage->set("mediumTime",$TIME);
										$insSegPage->set("mediumMemory",$this->clearNumber($MEMORY,true));
										$insSegPage->set("mediumBytesPage",$this->clearNumber($BYTES_PAGE,true));
									}else{
										$insSegPage->set("timeB",$TIME);
										$insSegPage->set("memoryB",$this->clearNumber($MEMORY,true));
										$insSegPage->set("bytesPageB",$this->clearNumber($BYTES_PAGE,true));
										$insSegPage->set("occurrencesB","1");
										$insSegPage->set("mediumTimeB",$TIME);
										$insSegPage->set("mediumMemoryB",$this->clearNumber($MEMORY,true));
										$insSegPage->set("mediumBytesPageB",$this->clearNumber($BYTES_PAGE,true));
									}
									
									if($insSegPage->exe()===false){
										$this->e("<!-- TESTE 2: ".$idsa->getError(1)." -->");
									}
								}else{
									$rowSegPage = $selSegPage->read();

									$updSegPage = new iUpdate($idsa,"sistema_carga");
									$updSegPage->where("idSistemaCarga","=",$rowSegPage['idSistemaCarga']);
									if($_SECURITY[0]['localHost']=="192.168.1.40"){
										$updSegPage->set("time",($rowSegPage['time'] + $TIME));
										$updSegPage->set("memory",($rowSegPage['memory'] + $this->clearNumber($MEMORY,true)));
										$updSegPage->set("bytesPage",($rowSegPage['bytesPage'] + $this->clearNumber($BYTES_PAGE,true)));
										$updSegPage->set("occurrences",($rowSegPage['occurrences'] + 1));
										$updSegPage->set("mediumTime",($rowSegPage['time'] + $TIME)/($rowSegPage['occurrences'] + 1));
										$updSegPage->set("mediumMemory",($rowSegPage['memory'] + $this->clearNumber($MEMORY,true))/($rowSegPage['occurrences'] + 1));
										$updSegPage->set("mediumBytesPage",($rowSegPage['bytesPage'] + $this->clearNumber($BYTES_PAGE,true))/($rowSegPage['occurrences'] + 1));
									}else{
										$updSegPage->set("timeB",($rowSegPage['timeB'] + $TIME));
										$updSegPage->set("memoryB",($rowSegPage['memoryB'] + $this->clearNumber($MEMORY,true)));
										$updSegPage->set("bytesPageB",($rowSegPage['bytesPageB'] + $this->clearNumber($BYTES_PAGE,true)));
										$updSegPage->set("occurrencesB",($rowSegPage['occurrencesB'] + 1));
										$updSegPage->set("mediumTimeB",($rowSegPage['timeB'] + $TIME)/($rowSegPage['occurrencesB'] + 1));
										$updSegPage->set("mediumMemoryB",($rowSegPage['memoryB'] + $this->clearNumber($MEMORY,true))/($rowSegPage['occurrencesB'] + 1));
										$updSegPage->set("mediumBytesPageB",($rowSegPage['bytesPageB'] + $this->clearNumber($BYTES_PAGE,true))/($rowSegPage['occurrencesB'] + 1));
									}
									
									if($updSegPage->exe()===false){
										$this->e("<!-- TESTE 3: ".$idsa->getError(1)." -->");
									}
								}
							}else{
								$this->e("<!-- TESTE 1: ".$idsa->getError(1)." -->");
							}
						}*/
					}
				}
			}
			
			if($page->session->getSession("PRINT",$PAGENAME)){
				$page->session->unSetSession("PRINT",$PAGENAME);
			}
		}else{
			$this->e("<!doctype html>");
			$this->e("<html lang=\"pt-BR\">");
			$this->e("<title>Em Manutenção</title>");
			
			$online = false;

			if(isset($_SECURITY[0])){
				if(isset($_SECURITY[0]['online'])){
					if($_SECURITY[0]['online']===true){
						$online = true;
					}
				}
			}

			if($online===true){
				$this->head->linkCss("http://prospera.net.br/RCD_7/bootstrap/css/bootstrap.css".$this->getStatus(),true);
			}else{
				$this->head->linkCss($PATH."../RCD_7/bootstrap/css/bootstrap.css".$this->getStatus());
			}

			$this->endObj("PAGE_".$this->name,"head");
			$this->e("<body>");
			$this->e("<div style=\"padding:30px;text-align:center;\"><b>Em Manutenção</b></div>");
			$this->e("</body>");
			$this->e("</html>");
		}
	}
    public function memoryUsage($forceMB=false){
        $memory = memory_get_usage();
        
		if($forceMB===false){
			if($memory < 1024){
				$textMemory = $memory." Bytes";
			}elseif ($memory < 1048576){
				$textMemory = round($memory / 1024, 2)." KB";
			}else{
				$textMemory = round($memory / 1048576, 2) . " MB";
			}

			return $textMemory;
		}else{
			return round($memory / 1048576, 2);
		}
    }
}