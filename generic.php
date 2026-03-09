<?php
include_once 'colors.php';

# DEFINE HTTP
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
	$uri = 'https://';
} else {
	$uri = 'http://';
}
define("THIS",$_SERVER['SCRIPT_NAME']);
define("THIS_FILE",$_SERVER['SCRIPT_FILENAME']);
define("THIS_FULL",$uri.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']);
define("THIS_HOST",$_SERVER['HTTP_HOST']);
define("THIS_HOST_HTTP",$uri.$_SERVER['HTTP_HOST']);
define("THIS_HOST_FULL",$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']);

$thisHostFullFolder = $_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
$thisHostFullFolder = substr($thisHostFullFolder,0,(strrpos($thisHostFullFolder,"/")+1));

define("THIS_HOST_FULL_FOLDER",$thisHostFullFolder);

# DEFINE O TIME
define("TIMESTAMP","UNIX_TIMESTAMP()");
define("NOW","NOW()");

# DEFINE STYLES
define("backGroundColor",";background-color:");
define("bold","bold");
define("center","center");
define("color",";color:");
define("cursor",";cursor:pointer");
define("displayBlock",";display:block");
define("displayNone",";display:none");
define("fontSize",";font-size:");
define("fontWeight",";font-weight:");
define("height",";height:");
define("invisible",";display:none");
define("left","left");
define("textAlign",";text-align:");
define("right","right");
define("visible",";display:block");
define("width",";width:");
define("minWidth",";min-width:");
define("uppercase",";text-transform:uppercase");
define("unSetUppercase",";text-transform:none");
# FIM - DEFINE STYLES

# DEFINE ESPAÇOS E CLASSES
define("px","20");
define("py","80");
define("pxm","300");
define("pym","250");
define("E1","20");
define("btBlue","bigButton bigBtBlue");
define("btGreen","bigButton bigBtGreen");
define("btRed","bigButton bigBtRed");
define("btPurple","bigButton bigBtPurple");
define("btDarkGreen","bigButton bigBtDarkGreen");
define("btYellow","bigButton bigBtYellow");
define("btActive","bigButton buttonAtivo");
define("btDesactive","bigButton bigButtonDes");
define("tab","&nbsp;&nbsp;&nbsp;&nbsp;");

# DEFINE E-MAIL SEND
define("EMAIL_STANDARD","profiable@praticsuporte.com.br");

# DEFINE CAMINHO
define("SERVER_ANDRESS","http://svf01:8090/PROFIABLE/RELEASE/");
define("SERVER_ANDRESS_ENVIRONMENT","http://svf01:8090/PROFIABLE/ENVIRONMENT/");

# OUTRAS DEFINIÇÕES
define("administrador","<br>Por favor, informe o administrador do sistema.<br><br>");
define("span_orange_bold_open","<b><span style=\"color:".COLOR_ORANGE.";\">");
define("span_orange_bold_close","</b></span>");
define("span_light_red_bold_open","<b><span style=\"color:".COLOR_LIGHT_RED.";\">");
define("span_light_red_bold_close","</b></span>");

# VARIAVEIS GLOBAIS
$HTML = new html();
$BYTES_PAGE = 0;
$arrayMsgErrorFormStandard = array("","Os campos destacados em vermelho são obrigatório!","2","3","Os campos destacados em vermelho são inválidos!");
$CURL_EXECTED = false;

$ddd = array(
	"11" => "011",
	"12" => "012",
	"13" => "013",
	"14" => "014",
	"15" => "015",
	"16" => "016",
	"17" => "017",
	"18" => "018",
	"19" => "019",
	"21" => "021",
	"22" => "022",
	"24" => "024",
	"27" => "027",
	"28" => "028",
	"31" => "031",
	"32" => "032",
	"33" => "033",
	"34" => "034",
	"35" => "035",
	"37" => "037",
	"38" => "038",
	"41" => "041",
	"42" => "042",
	"43" => "043",
	"44" => "044",
	"45" => "045",
	"46" => "046",
	"47" => "047",
	"48" => "048",
	"49" => "049",
	"51" => "051",
	"53" => "053",
	"54" => "054",
	"55" => "055",
	"61" => "061",
	"62" => "062",
	"63" => "063",
	"64" => "064",
	"65" => "065",
	"66" => "066",
	"67" => "067",
	"68" => "068",
	"69" => "069",
	"71" => "071",
	"73" => "073",
	"74" => "074",
	"75" => "075",
	"77" => "077",
	"79" => "079",
	"81" => "081",
	"82" => "082",
	"83" => "083",
	"84" => "084",
	"85" => "085",
	"86" => "086",
	"87" => "087",
	"88" => "088",
	"89" => "089",
	"91" => "091",
	"92" => "092",
	"93" => "093",
	"94" => "094",
	"95" => "095",
	"96" => "096",
	"97" => "097",
	"98" => "098",
	"99" => "099",
);

$GET_SELECT_TIME = false;

# PARAMETROS DE TURNO
$TURNO_HORA = array(
	1 => 4,
	2 => 13,
	3 => 21
);
$TURNO_MIN = array(
	1 => 50,
	2 => 0,
	3 => 50
);
$TURNO_HORA_TOLERANCIA = array(
	1 => 5,
	2 => 13,
	3 => 22
);
$TURNO_MIN_TOLERANCIA = array(
	1 => 10,
	2 => 20,
	3 => 10
);

# PARAMETROS DE APONTAMENTO
$AP_HORA = array(
	0 => 0,
	1 => 2,
	2 => 4,
	3 => 7,
	4 => 9,
	5 => 11,
	6 => 13,
	7 => 15,
	8 => 17,
	9 => 19,
	10 => 21,
	11 => 23
);
$AP_MIN = array(
	0 => 0,
	1 => 0,
	2 => 50,
	3 => 0,
	4 => 0,
	5 => 0,
	6 => 0,
	7 => 0,
	8 => 0,
	9 => 0,
	10 => 50,
	11 => 59
);
$AP_SEG = array(
	0 => 0,
	1 => 0,
	2 => 0,
	3 => 0,
	4 => 0,
	5 => 0,
	6 => 0,
	7 => 0,
	8 => 0,
	9 => 0,
	10 => 0,
	11 => 59
);

# Generic
class generic {
	protected $name;
    protected $nivel;
    protected $type;
    protected $typeColumn = false;
	protected $layer;
    protected $table;
    protected $backGroundColorError;
    protected $formName;
    protected $minimumLength;
	protected $check;
    protected $state = array("AC","AL","AM","AP","BA","CE","DF","ES","GO","MA","MG","MS","MT","PA","PB","PE","PI","PR","SC","SE","SP","RJ","RN","RO","RR","RS","TO");
	public $alfabeto = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","X","Y","Z");
    protected $mesAbb = array("","Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez");
    protected $mesAbbIng = array("Jan" => 1,"Feb" => 2,"Mar" => 3,"Apr" => 4,"May" => 5,"Jun" => 6,"Jul" => 7,"Aug" => 8,"Sep" => 9,"Oct" => 10,"Nov" => 11,"Dec" => 12);
    protected $mes = array("","Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
    protected $whereForCheckUnique = "status";
    protected $operatorForCheckUnique = "=";
    protected $valueForCheckUnique = "1";
    private $typeSetted;
    private $chaveProfiable = array("a" => ".11","A" => ".39","e" => ".21","E" => ".41","j" => ".20","J" => ".48","o" => ".31","O" => ".51","t" => ".30","T" => ".59","y" => ".42","Y" => ".61");
	private $chaveProfiableCriptografada = false;
	private $gateUploadJs = false;
	
	public function clearNumber($number,$ignoreDot=false,$realBrasileiro=false){
        $number = str_replace("(", "", $number);
        $number = str_replace(")", "", $number);
		if($ignoreDot===false){
        	$number = str_replace(".", "", $number);
		}
        $number = str_replace("-", "", $number);
        $number = str_replace("/", "", $number);
		if($realBrasileiro===false){
        	$number = str_replace(",", "", $number);
		}else{
			$number = str_replace(",", ".", $number);
		}

		$number = str_replace(" ", "", $number);
		
		$newNumber = "";
		for($i=0;$i<strlen($number);$i++){
			if($this->verifyValue($number[$i],"NUM_LOCK")){
				$newNumber .= $number[$i];
			}
		}

        return $newNumber;
	}

	public function clearString($string,$removerAcento=true,$forced=false,$removerCaractereEspecial=false,$uppercase=false){
		if($uppercase===true){
			$string = $this->stringToUpper($string);
		}
		if($removerAcento===true){
			$string = $this->removeAcento($string);
		}
        $string = str_replace("'", "", $string);
		$string = str_replace("\"", "", $string);

		if($forced===true && $removerAcento===true){
			$newString = "";
			for($i=0;$i<strlen($string);$i++){
				if($this->verifyValue($string[$i],"ALPHA_NUM_PARENTESE_BARRA_CLEAN")){
					$newString .= $string[$i];
				}
			}
	
			$string = $newString;
		}else if($forced===true){
			$newString = "";
			for($i=0;$i<strlen($string);$i++){
				if($this->verifyValue($string[$i],"ALPHA_NUM_PARENTESE_BARRA_CLEAN_CARACTERES")){
					$newString .= $string[$i];
				}
			}
	
			$string = $newString;
		}

		if($removerCaractereEspecial===true){
			$newString = "";
			for($i=0;$i<strlen($string);$i++){
				if(!$this->verifyValue($string[$i],"NOT_LIKE")){
					$newString .= $string[$i];
				}
			}
	
			$string = $newString;
		}
		
        return $string;
	}

	public function clearEmail($email){
		$email = $this->stringToLower($email);
		$email = $this->clearString($email,true,false,true);
		$email = str_replace("(", "", $email);
        $email = str_replace(")", "", $email);
        $email = str_replace("/", "", $email);
        $email = str_replace(",", "", $email);
		$email = str_replace(" ", "", $email);
		
        return $email;
	}

	public function getData($column,$row=false,$digit=false,$ignorePost=false){
		global $_POST;

		if($row===false){
			global $row;
		}

		if(isset($_POST[$column]) && $ignorePost===false){
			$texto = $_POST[$column];

			$texto = str_replace("@YYYY#",date("Y"),$texto);

			if($digit!==false){
				$texto = round($texto,$digit);
			}

			return $texto;
		}else if(isset($row[$column])){
			$texto = $row[$column];

			$texto = str_replace("@YYYY#",date("Y"),$texto);

			if($digit!==false){
				$texto = round($texto,$digit);
			}

			return $texto;
		}else{
			return "";
		}
	}

	public function getFilial($filial,$number=0){
		$filial = $this->exeExplode("#@",$filial);
		$filial[0] = str_replace("@","",$filial[0]);
		$filial[0] = str_replace("#","",$filial[0]);
		return $filial[0];
	}
	
    public function verifyPermission($transation,$forced=false){
    	global $isPaginaNormal;
    	global $page;
    	global $idsa;
    	global $idss;
    	
    	$userType = $page->session->getSession('USER_TIPO');
    	
    	$selSeg = new iSelect($idss,"usuarios");
    	$selSeg->where("idUsuario", "=", $page->session->getLoginId());
    	
    	$resSelSeg = $selSeg->exe();
    	
    	if($resSelSeg===false){
    		if($isPaginaNormal==1){
    			showMsgNovo("Houve uma falha ao tentar carregar os dados do usuario!".administrador.$dataSet->getErro(1),"close");
    		}else{
    			showMsgWithoutStyle("Houve uma falha ao tentar carregar os dados do usuario!".administrador.$dataSet->getErro(1),"msgErro");
    		}
    		return false;
    	}else{
	    	$rowSeg = $selSeg->read();
	    	
	    	$selCSeg = new iSelect($idsa,"transacoes");
	    	$selCSeg->where("nome", "=", $transation, true);
	    	
	    	$resSelCSeg = $selCSeg->exe();
	    	
	    	if($resSelCSeg===false){
	    		if($isPaginaNormal==1){
	    			showMsgNovo("Houve uma falha ao tentar carregar a transação!".administrador.$dataSet->getErro(1),"close");
	    		}else{
	    			showMsgWithoutStyle("Houve uma falha ao tentar carregar a transação!".administrador.$dataSet->getErro(1),"msgErro");
	    		}
	    		return false;
	    	}else{
		    	if($selCSeg->getNumRows()>0 || ($page->session->getLoginTipo()==2 && ($page->stringToUpper($transation)=="PAGINAINICIAL" || $page->stringToUpper($transation)=="SISTEMA" || $page->stringToUpper($transation)=="SISTEMA_CADASTROS" || $page->stringToUpper($transation)=="SISTEMA_TRANSACOES" || $page->stringToUpper($transation)=="SISTEMA_USUARIOS"))){
		    		$rowCSeg = $selCSeg->read();
		    		if($rowCSeg['enable']==1){
		    			# Verifica se o usuário possui permissão para essa transação
		    			$gruposSeg = $rowSeg['permissaoGrupos'];
						$gruposSeg = $this->exeExplode(",",$gruposSeg);
		    	
		    			$selBSeg = new iSelect($idsa,"permissao_grupo");
		    			$selBSeg->columns("transacoes");
		    			$selBSeg->order("descricao");
						if(count($gruposSeg)>0){
							$selBSeg->where("idPermissaoGrupo", ">", "0");
							foreach ($gruposSeg as $keySeg => $valueSeg){
								$valueSeg = str_replace("@", "", $valueSeg);
								$valueSeg = str_replace("#", "", $valueSeg);
								$selBSeg->setOr("idPermissaoGrupo", "=", $valueSeg);
							}
						}else{
							$selBSeg->where("idPermissaoGrupo", "=", "0");
						}
		    			
		    			$resSelBSeg = $selBSeg->exe();
		    			
		    			if($resSelBSeg===false){
		    				if($isPaginaNormal==1){
		    					showMsgNovo("Houve uma falha ao tentar carregar as permissões de grupo!".administrador.$idsa->getError(1),"close");
		    				}else{
		    					showMsgWithoutStyle("Houve uma falha ao tentar carregar as permissões de grupo!".administrador.$idsa->getError(1),"msgErro");
		    				}
		    				return false;
		    			}else{
			    			$transacoesPermitidas = "";
			    			while($rowBSeg = $selBSeg->read()){
			    				$transacoesPermitidas .= $rowBSeg['transacoes'];
			    			}
			    				
			    			if(strstr($transacoesPermitidas,"@".$rowCSeg['idTransacao']."#")){
			    				return true;
			    			}else{
			    				if($transation=="paginaInicial" || ($userType==2 && $forced===true)){
			    					return true;
			    				}else{
			    					return false;
			    				}
			    			}
		    			}
		    		}else if($rowCSeg['enable']==0 && $page->session->getSession('USER_TIPO')==2){
		    			#$page->setTitle("Em Manutenção :: Profiable");
		    			return true;
		    		}else{
		    			return false;
		    		}
		    	}else{
		    		return false;
		    	}
	    	}
    	}
    }
    
	public function sendWebhook($webhook_url, $message) {
       /* $payload = json_encode(['content' => $message]);

        $ch = curl_init($webhook_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
        curl_close($ch);*/
		$response = true;

        return $response;
    }

    public function sendSms($from,$to,$msg,$id,$aggregateId,$authorization,$url=false){
    	if($url===false){
    		#$url="https://api-rest.zenvia.com/services/send-sms";
    		$url="http://api-rest.zenvia360.com.br/services/send-sms";
    	}
    	global $PATH;
    	global $CURL_EXECTED;
    	$CURL_EXECTED = true;
    	
    	if(!function_exists('curl_init')){
    		return false;#-1
    	}else{
    		# aggregateId:33185
    		# Authorization: cavalcanti.smsonline:umdumTPjdj
    		
    		$ch = curl_init();
    		
    		curl_setopt($ch, CURLOPT_URL, $url);
    		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
    		#curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    		#curl_setopt($ch, CURLOPT_CAINFO, getcwd().$PATH."../RCD_7/COMODORSACertificationAuthority.crt");
    		#curl_setopt($ch, CURLOPT_CAINFO, $_SERVER['DOCUMENT_ROOT']."cacert-2018-06-20.pem");
    		
    		curl_setopt($ch, CURLOPT_HEADER, FALSE);    		
    		
    		curl_setopt($ch, CURLOPT_POST, TRUE);
    		
    		curl_setopt($ch, CURLOPT_POSTFIELDS, "
	    		{
				  	\"sendSmsRequest\": {
					    \"from\": \"".$from."\",
					    \"to\": \"55".$to."\",
					    \"schedule\": \"".date("Y-m-d")."T".date("H:i:s")."\",
					    \"msg\": \"".$msg."\",
					    \"callbackOption\": \"NONE\",
					    \"id\": \"".$id."\",
						\"aggregateId\": \"".$aggregateId."\",
					    \"flashSms\": false
				  	}
				}
    		");
    		
    		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    				"Content-Type: application/json",
    				"Authorization: Basic ".base64_encode($authorization),
    				"Accept: application/json"
    		));
    		
    		$response = curl_exec($ch);
    		curl_close($ch);
    		
    		#global $corpo;
    		
    		if($response===false){
    			#$corpo->inSide("Teste");
    			return false;
    		}else{    			
    			#$corpo->inSide($response);
    			$objResponse = json_decode($response);
    			
    			if($objResponse->sendSmsResponse->detailCode=="000"){
    				return true;
    			}/*else if($objResponse->sendSmsResponse->detailCode=="013"){
    				return -2;
    			}else{
    				return $objResponse->sendSmsResponse->detailDescription;
    			}*/
    		}
    	}
    }
    
    public function profiableEncode($string,$noReinforce=true){
		global $_SECURITY;

		$chaveProfiable = $this->chaveProfiable;

		if(isset($_SECURITY)){
			if(isset($_SECURITY[0])){
				if(isset($_SECURITY[0]['chaveProfiable'])){
					if(is_array($_SECURITY[0]['chaveProfiable'])){
						$chaveProfiable = $_SECURITY[0]['chaveProfiable'];
					}
				}
			}
		}

		if($this->chaveProfiableCriptografada===false){
			$this->chaveProfiableCriptografada = $this->criptCommand($this->exeImplode("@",$chaveProfiable),false,false,false);
		}

		if(strlen($string)<8 && $noReinforce===false){
			$string = $string."@".$this->chaveProfiableCriptografada;
		}		

        $string = base64_encode($string);
        
        foreach ($chaveProfiable as $key => $value){
            $string = str_replace($key, $value, $string);
        }
        
        $string = str_replace("=", "_", $string);
        
        return $string;
	}

	public function compareCriptCommand($value,$valueCriptCommand,$withLogin=true,$key=false,$withTime=true){
		global $page;

		$time = "";
		if($withTime===true){
			$time = "_".date("Ymd");
		}

		$timeB = "";
		if($withTime===true){
			$timeB = "_".date("Ymd",(time()-3600));
		}

		if($key===false){
			$key = "";
		}else{
			$key = "_".$key;
		}

		if($withLogin===true){
			$compare = hash("sha256", $value."_1_".$page->session->getLoginId().$key.$time);
		}else{
			$compare = hash("sha256", $value."_1".$key.$time);
		}

		if($compare==$valueCriptCommand){
			return true;
		}else{
			if($withLogin===true){
				$compare = hash("sha256", $value."_1_".$page->session->getLoginId().$key.$timeB);
			}else{
				$compare = hash("sha256", $value."_1".$key.$timeB);
			}
	
			if($compare==$valueCriptCommand){
				return true;
			}else{
				return false;
			}
		}
	}
	
	public function criptCommand($value,$withLogin=true,$key=false,$withTime=true){
		global $page;

		$time = "";
		if($withTime===true){
			$time = "_".date("Ymd");
		}

		if($key===false){
			$key = "";
		}else{
			$key = "_".$key;
		}

		if($withLogin===true){
			return hash("sha256", $value."_1_".$page->session->getLoginId().$key.$time);
		}else{
			return hash("sha256", $value."_1".$key.$time);
		}
	}
    
    public function profiableDecode($string){
		if($string==null){
			return "";
		}else{
			global $_SECURITY;

			$chaveProfiable = $this->chaveProfiable;

			if(isset($_SECURITY)){
				if(isset($_SECURITY[0])){
					if(isset($_SECURITY[0]['chaveProfiable'])){
						if(is_array($_SECURITY[0]['chaveProfiable'])){
							$chaveProfiable = $_SECURITY[0]['chaveProfiable'];
						}
					}
				}
			}

			if(strlen($string)>0){
				$string = str_replace("_", "=", $string);
				
				foreach ($chaveProfiable as $key => $value){
					$string = str_replace($value, $key, $string);
				}
			}
			
			$string = base64_decode($string);
			
			if($this->chaveProfiableCriptografada===false){
				$this->chaveProfiableCriptografada = $this->criptCommand($this->exeImplode("@",$chaveProfiable),false,false,false);
			}

			$string = str_replace("@".$this->chaveProfiableCriptografada,"",$string);

			return $string;
		}
    }
    
    public function profiableEncodePlus($string){
    	$string = base64_encode($string);
    	
    	return $string;
    }
    
    public function profiableDecodePlus($string){
    	$string = base64_decode($string);
    
    	return $string;
    }
    
    public function receiveJson($objJson,$arrayIsNotRequired=false){
    	if(strlen($objJson)>0){
    		$objJson = json_decode($objJson);
    		$objRecusado = array();
    		$objAprovado = array();
    		foreach ($objJson as $key => $value){
    			$campo = false;
    			$valor = false;
    			foreach ($value as $keyB => $valueB){
    				if($campo===false){
    					$campo = $valueB;
    				}else{
    					$valor = str_replace("#", ",", $valueB);
    					$valorTemp = $valor;
    					$valorTemp = str_replace(",", "", $valorTemp);
    					$valorTemp = str_replace(".", "", $valorTemp);
    					if(is_numeric($valorTemp)){
    						$valor = $this->formatNumber($valor);
    					}
    				}
    			}
    			if(strlen($valor)<=0){
    				$searched = 0;
    				foreach ($arrayIsNotRequired as $keyC => $valueC){
    					if($campo==$valueC){
    						$searched = 1;
    						break;
    					}
    				}
    				if($searched==0){
	    				$id = count($objRecusado);
	    				$objRecusado[$id]['objToLoad'] = $campo;
	    				$objRecusado[$id]['value'] = $valor;
    				}
    			}else{
    				$id = count($objAprovado);
    				$objAprovado[$id]['objToLoad'] = $campo;
    				$objAprovado[$id]['value'] = $this->stringToUpper($valor);
    			}
    		}
    		if(count($objRecusado)>0){
    			$objJson = json_encode($objRecusado);
    			return $objJson;
    		}else{
    			return $objAprovado;
    		}
    	}else{
    		return false;
    	}
    }
    public function checkDuracao($duracao){
    	if($duracao>=0 && $duracao<=9000){
    		return $duracao;
    	}else if($duracao<0){
    		return -1;
    	}else{
    		return $duracao;
    	}
    }
    public function mediaAcumulativa($name,$valueAdd,$totalAmostra=10){
    	global $page;
    	global $PAGENAME;
    	
    	$valueAddA = 0;
    	$arrayValues = array();
    	$arrayValuesNew = array();
    	
    	if(!$page->session->getSession($name."_VALUE",$PAGENAME)){
    		$page->session->setSession($name."_VALUE",$valueAdd,$PAGENAME);
    	}else{
    		$valueAddA = $page->session->getSession($name."_VALUE",$PAGENAME);
    	}
    	
    	if(!$page->session->getSession($name,$PAGENAME)){
    		$page->session->setSession($name,$arrayValues,$PAGENAME);
    	}else{
    		$arrayValues = $page->session->getSession($name,$PAGENAME);
    	}
    	
    	$soma = 0;
    	$cont = 0;
    	foreach ($arrayValues as $key => $value){
    		$soma += $value;
    		$cont++;
    	}
    	$media = @($soma / $cont);
    	$diferenca = @($valueAdd / $media);
    	if($diferenca==0){
    		$valueAdd = $valueAdd;
    	}else if($diferenca<0.9){
    		$valueAdd = $media * 0.9;
    	}else if($diferenca>1.1){
    		$valueAdd = $media * 1.1;
    	}
    	$page->session->setSession($name."_VALUE",$valueAdd,$PAGENAME);
    	
    	if($valueAdd!=$valueAddA){
	    	if(count($arrayValues)<$totalAmostra){
	    		$id = count($arrayValues);
	    		$arrayValues[$id] = $valueAdd;
	    	}else{
	    		foreach ($arrayValues as $key => $value){
	    			if($key>0){
	    				$id = count($arrayValuesNew);
	    				$arrayValuesNew[$id] = $value;
	    			}
	    		}
	    		$id = count($arrayValuesNew);
	    		$arrayValuesNew[$id] = $valueAdd;
	    		$arrayValues = $arrayValuesNew;
	    	}
	    	$page->session->setSession($name,$arrayValues,$PAGENAME);
    	}
    	
    	$soma = 0;
    	$cont = 0;
    	foreach ($arrayValues as $key => $value){
    		$soma += $value;
    		$cont++;
    	}
    	$media = @($soma / $cont);
    	return $media;
    }
	public function division($v1,$v2,$digit=false){
		if(strlen($v1)==0){
			$v1 = 0;
		}
		if(strlen($v2)==0){
			$v2 = 0;
		}
		if($v2==0){
			return 0;
		}else if($digit===false){
			return $v1 / $v2;
		}else{
			return round($v1 / $v2,$digit);
		}
	}
	public function percent($v1,$v2,$digit=2){
		$percent = ($this->division($v1,$v2) - 1) * 100;
		$percent = round($percent,$digit);
		return $percent;
	}
    public function encodeFilial($arrayExtended="",$value="",$filial=false){
    	global $page;
    	if($filial===false){
    		$filial = $page->session->getLoginFilial();
    	}
    	$res = false;
    	$thisFilial = "@".$page->session->getLoginFilial()."#";
    	$arrayExtended = $this->exeExplode(",", $arrayExtended);
    	foreach ($arrayExtended as $keyB => $valueB){
    		if(strpos("#".$valueB, $thisFilial)){
    			$res = $keyB;
    			break;
    		}
    	}
    	if($res===false){
    		$id = count($arrayExtended);
    		$arrayExtended[$id] = "@".$filial."#".$value."#".$filial."@";
    	}else{
    		$arrayExtended[$res] = $thisFilial.$value.$thisFilial;
    	}
    	$arrayExtended = $this->exeImplode(",", $arrayExtended);
    	return $arrayExtended;
	}
	public function decodeFilial($arrayExtended=""){
		global $page;
		$res = false;
		$thisFilial = "@".$page->session->getLoginFilial()."#";
		$thisFilialEnd = "#".$page->session->getLoginFilial()."@";
		$arrayExtended = $this->exeExplode(",", $arrayExtended);
		foreach ($arrayExtended as $key => $value){
			if(strpos("#".$value, $thisFilial)){
				$res = $value;
				break;
			}
		}
		if($res===false){
			return $res;
		}else{
			$value = $this->parseTextBetweenMulti($thisFilial, $thisFilialEnd, $value);
			return $value;
		}
	}
    public function getBytesPage($forceMB=false){
    	global $BYTES_PAGE;
    	$bytes = $BYTES_PAGE;

		if($forceMB===false){
			if($bytes < 1024){
				$textBytes = $bytes." Bytes";
			}elseif ($bytes < 1048576){
				$textBytes = round($bytes / 1024, 2)." KB";
			}else{
				$textBytes = round($bytes / 1048576, 2) . " MB";
			}
			return $textBytes;
		}else{
			return round($bytes / 1048576,2);
		}
    }   
    public function getComment($comment){
    	$comment = $this->stringToUpper($comment);
    	return "<ul><li>COMENTARIOS: ".$comment."</li></ul>";
    }
	public function getHistoric($varOriginal,$varFinal,$campo,$varHistorico,$comConteudo=false){
		$incluirHistorico = false;
		if($varOriginal!=$varFinal){
			$incluirHistorico = true;
		}
		if($comConteudo===true && strlen($varFinal)==0){
			$incluirHistorico = false;
		}
		if($incluirHistorico===true){
			if(strlen($varHistorico)>0){
				$varHistorico .= ", ";
			}
			$varHistorico .= $campo.": ".$varOriginal;
		}
		return $varHistorico;
	}
    public function getHistText($type="c",$append="",$withoutAppend=false){
    	global $page;

		if($withoutAppend===false){
			if(strlen($append)>0){
				$append = " - ".$append;
			}
		}
    	
    	if(strtoupper($type)=="C"){
			return "# CRIADO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
		}else if(strtoupper($type)=="CAN"){
			return "# CANCELADO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
		}else if(strtoupper($type)=="DES"){
    		return "# DESABILITADO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
		}else if(strtoupper($type)=="HAB"){
    		return "# HABILITADO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
		}else if(strtoupper($type)=="M"){
    		return "# MODIFICADO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
    	}else if(strtoupper($type)=="E"){
    		return "# EXCLUÍDO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
    	}else if(strtoupper($type)=="D"){
    		return "# DESATIVADO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
    	}else if(strtoupper($type)=="A"){
    		return "# REATIVADO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
    	}else if(strtoupper($type)=="L"){
    		return "# LIBERADO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
    	}else if(strtoupper($type)=="EST"){
    		return "# ESTORNADO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
    	}else if(strtoupper($type)=="CON"){
    		return "# CONCLUÍDO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
    	}else if(strtoupper($type)=="APR"){
			return "# APROVADO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
		}else if(strtoupper($type)=="REP"){
    		return "# REPROVADO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
		}else if(strtoupper($type)=="ENT"){
			return "# ENTREGUE POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
		}else if(strtoupper($type)=="DAP"){
    		return "# DESAPROVADO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
    	}else if(strtoupper($type)=="INI"){
    		return "# INICIADA POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
    	}else if(strtoupper($type)=="REI"){
    		return "# REINICIADA POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
    	}else if(strtoupper($type)=="CNF1"){
    		return "# CONFERENCIA 1 POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
    	}else if(strtoupper($type)=="FCF1"){
    		return "# FALHA CONFERENCIA 1 POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
    	}else if(strtoupper($type)=="CNF2"){
    		return "# CONFERENCIA 2 POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
    	}else if(strtoupper($type)=="BXD"){
    		return "# BAIXADO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
    	}else if(strtoupper($type)=="BCK"){
    		return "# BLOQUEADO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
		}else if(strtoupper($type)=="EFE"){
    		return "# EFETIVADO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
		}else if(strtoupper($type)=="ENTV"){
			return "# ENTREVISTADO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
		}else if(strtoupper($type)=="ENC"){
			return "# ENCERRADO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
		}else if(strtoupper($type)=="FIN"){
			return "# FINALIZADO POR (".$page->session->getLoginId().") ".$page->session->getLoginName()." EM ".$this->getDateFull().$append;
    	}
    }
    
    public function getDateFull(){
    	return date("d/m/Y H:i:s");
    }
	
    public function arraySort($array, $on, $order=SORT_ASC){
    	if($order=="ASC"){
    		$order = SORT_ASC;
    	}else if($order=="DESC"){
    		$order = SORT_DESC;
    	}
	    $new_array = array();
	    $sortable_array = array();
	
		if(!is_array($array)){
			$array = array();
		}

	    if (count($array) > 0) {
	        foreach ($array as $k => $v) {
	            if (is_array($v)) {
	                foreach ($v as $k2 => $v2) {
	                    if ($k2 == $on) {
	                        $sortable_array[$k] = $v2;
	                    }
									}
							} else if (is_object($v)) {
									$sortable_array[$k] = $v->$on;
	            } else {
	                $sortable_array[$k] = $v;
	            }
	        }
	
	        switch ($order) {
	            case SORT_ASC:
	                asort($sortable_array);
	            break;
	            case SORT_DESC:
	                arsort($sortable_array);
	            break;
	        }
			
	        $cont = 0;
	        foreach ($sortable_array as $k => $v) {
	            $new_array[$cont] = $array[$k];
	            $cont++;
	        }
	    }
	
	    return $new_array;
	}
	
	public function arraySortMulti($array, $on, $on2, $order=SORT_ASC, $order2=SORT_ASC){
		if($order=="ASC"){
			$order = SORT_ASC;
		}else if($order=="DESC"){
			$order = SORT_DESC;
		}
		if($order2=="ASC"){
			$order2 = SORT_ASC;
		}else if($order2=="DESC"){
			$order2 = SORT_DESC;
		}
		
		$array = $this->arraySort($array, $on, $order);
		
		$onA = false;
		$newArray = array();
		$subArray = array();
		foreach ($array as $key => $value){
			if($onA===false){
				$onA = $array[$key][$on];
			}
			if($onA==$array[$key][$on]){
				$id = count($subArray);
				$subArray[$id] = $array[$key];
			}else{
				$subArray = $this->arraySort($subArray, $on2, $order2);
				foreach ($subArray as $keyB => $valueB){
					$idB = count($newArray);
					$newArray[$idB] = $valueB;
				}
				$onA = $array[$key][$on];
				$subArray = array();
				$id = count($subArray);
				$subArray[$id] = $array[$key];
			}
		}
		$subArray = $this->arraySort($subArray, $on2, $order2);
		foreach ($subArray as $keyB => $valueB){
			$idB = count($newArray);
			$newArray[$idB] = $valueB;
		}
		
		return $newArray;
	}
	
    public function getFirstDayMes($mes=false,$ano=false){
    	if($mes===false){
    		$mes = date("n");
    	}
    	if($ano===false){
    		$ano = date("Y");
    	}
    	return mktime(12,0,0,$mes,1,$ano);
    }
    public function getWeekDay($currentTime=false){
    	if($currentTime===false){
    		$currentTime = time();
    	}
    	return (date("w",$currentTime) + 1);
    }
    public function sendEmail($para,$assunto,$mensagem,$cc=false,$bcc=false,$de=false,$prenome="",$convencional=true,$usuario=false,$senha=false,$host="smtp.gmail.com"){
		if($convencional){
			if($de===false){
				$de = EMAIL_STANDARD;
				$prenome = "Profiable";
			}
			$cabecalho = "MIME-Version: 1.0\r\n";
			$cabecalho .= "Content-type: text/html; charset=ISO 8859-1\r\n";
			$cabecalho .= "from: ".$prenome." <".$de.">\r\n";
			$cabecalho .= "Reply-to: ".$prenome." <".$de.">\r\n";
			if($cc!==false){
				$cabecalho .= "Cc: ".$cc."\r\n";
			}
			if($bcc!==false){
				$cabecalho .= "Bcc: ".$Bcc."\r\n";
			}
			$cabecalho .= "X-Priority: 1\r\n";
			$cabecalho .= "X-MSMail-Priority: High\r\n";
			$cabecalho .= "Importance: High\r\n";
			
			$baseHTML = '
				<!doctype html>
				<html lang="pt-BR">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					<meta charset="UTF-8" />
					<meta http-equiv="cache-control" content="no-cache" />
					<meta http-equiv="pragma" content="no-cache" />
					<meta http-equiv="content-language" content="pt-br" />
				</head>
				<body>
					<div style="font-family:Calibri,Arial,Verdana;font-size:16px;color:'.COLOR_DARK_SILVER.';">
						@MSG#
					</div><br>

					<div style="text-align:justify;font-family:Calibri,Arial,Verdana;font-size:12px;color:'.COLOR_DARK_SILVER.';">
						---<br><br>As informações contidas nesta mensagem e no(s) arquivo(s) anexo(s) são confidenciais e de uso exclusivo do portador desse endereço de e-mail. Qualquer uso, cópia ou digulvação das informações nela contidas, na íntegra ou parcialmente, são proibidas e serão tratadas conforme legislação vigente.
					</div>
				</body>
				</html>
			';

			/* As informações contidas nesta mensagem e no(s) arquivo(s) anexo(s) são confidenciais e de propriedades da Ingram Micro e de uso exclusivamente à(s) pessoa(s) e/ou instituição(ões) acima indicada(s) e podem conter informações confidenciais e/ou privilegiadas. Se você não for o destinatário ou pessoa autorizada a recebê-la, queira, por favor retorná-la ao remetente e em seguida apagá-la definitvamente. Qualquer uso, cópia ou digulvação das informações nela contidas, na íntegra ou parcialmente, são proibidas e serão tratadas conforme legislação vigente. */

			$res = mail($para, $assunto, str_replace("@MSG#",$mensagem,$baseHTML), $cabecalho);
			if($res){
				return true;
			}else{
				return false;
			}
		}else if($usuario===false || $senha===false){
			return false;
		}else{
			require_once 'PHPMailer/_lib/class.phpmailer.php';

			$mail = new PHPMailer();
			$mail->charSet = "UTF-8";
			$mail->isSMTP();
			$mail->SMTPDebug = 1;
			$mail->Port = 465;
			$mail->Host = $host;
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'tls';
			$mail->Username = $usuario;
			$mail->Password = $senha;
			$mail->Priority = 1;
			$mail->AddCustomHeader("X-MSMail-Priority: High");
			$mail->AddCustomHeader("Importance: High");
			$mail->FromName = $prenome;
			$mail->From = $de;
			$mail->addReplyTo($de);
			$mail->addAddress($para, 'Para');

			if($cc!==false){
				$cc = $this->exeExplode(',',$cc);
				foreach($cc as $kB => $vB){
					$mail->addCC($vB, 'Cópia');
				}
			}
			
			if($bcc!==false){
				$bcc = $this->exeExplode(',',$bcc);
				foreach($bcc as $kB => $vB){
					$mail->addBCC($vB, 'Cópia Oculta');
				}
			}

			$mail->isHTML(true);
			$mail->Subject = $assunto;

			$baseHTML = '
				<!doctype html>
				<html lang="pt-BR">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					<meta charset="UTF-8" />
					<meta http-equiv="cache-control" content="no-cache" />
					<meta http-equiv="pragma" content="no-cache" />
					<meta http-equiv="content-language" content="pt-br" />
				</head>
				<body>
					<div style="font-family:Calibri,Arial,Verdana;font-size:16px;color:'.COLOR_DARK_SILVER.';">
						@MSG#
					</div><br>

					<div style="text-align:justify;font-family:Calibri,Arial,Verdana;font-size:12px;color:'.COLOR_DARK_SILVER.';">
						---<br><br>As informações contidas nesta mensagem e no(s) arquivo(s) anexo(s) são confidenciais e de uso exclusivo do portador desse endereço de e-mail. Qualquer uso, cópia ou digulvação das informações nela contidas, na íntegra ou parcialmente, são proibidas e serão tratadas conforme legislação vigente.
					</div>
				</body>
				</html>
			';

			$mail->Body = utf8_decode(str_replace("@MSG#",$mensagem,$baseHTML));
			/*$mail->AltBody = 'Para visualizar essa mensagem acesse http://site.com.br/mail';
			$mail->addAttachment('/tmp/image.jpg', 'nome.jpg');*/

			if(!$mail->Send()){
				echo "Message was not sent";
				echo "Mailer Error: " . $mail->ErrorInfo; 
				return false;
			}else{
				return true;
			}
		}
    }
    public function formatCpfCnpj($value){
    	if(strlen($value)==0){
    		return null;
    	}else{
			$value = $this->clearNumber($value); 
	    	if(strlen($value)>=13){
	    		if(strlen($value)==13){
	    			$value = "0".$value;
	    		}
	    		$value = substr($value, 0, 2).".".substr($value, 2, 3).".".substr($value, 5, 3)."/".substr($value, 8,4)."-".substr($value, 12);
	    	}else{
	    		$value = substr($value, 0, 3).".".substr($value, 3, 3).".".substr($value, 6, 3)."-".substr($value, 9);
	    	}
	    	return $value;
    	}
    }
    public function formatCnae($value){
    	if(strlen($value)==0){
    		return null;
    	}else{
    		$value = substr($value, 0, 2).".".substr($value, 2, 2)."-".substr($value, 4, 1)."-".substr($value, 5,2);
    		return $value;
    	}
    }
    public function formatCep($value){
    	if(strlen($value)==0){
    		return null;
    	}else{
	    	$value = substr($value, 0, 2).".".substr($value, 2, 3)."-".substr($value, 5, 3);
	    	return $value;
    	}
    }
    public function formatRgIe($value){
    	if(strlen($value)==0){
    		return null;
    	}else{
    		if(strlen($value)<=9){
    			$value = substr($value, 0, 2).".".substr($value, 2, 3).".".substr($value, 5, 3)."-".substr($value, 8, 1);
    		}else{
    			$valueFinal = "";
    			$i = 0;
    			while($i<strlen($value)){
    				if($i!=0){
    					$valueFinal .= ".";
    				}
    				$valueFinal .= substr($value, $i, 3);
    				$i += 3;
    			}
    			$value = $valueFinal;
    		}
    		return $value;
    	}
    }
	public function formatNumTel($value){
		return $this->formatAsNumTel($value);
	}
    public function formatAsNumTel($value){
    	$value = str_replace("(", "", $value);
    	$value = str_replace(")", "", $value);
    	$value = str_replace(" ", "", $value);
    	$value = str_replace("-", "", $value);
    	
    	if(is_numeric($value)){
			$numTel = $value;
	    	if(strlen($value)<=4){
	    		if($value==0){
	    			$numTel = "";
	    		}else{
	    			$numTel = $value;
	    		}
	    	}else{
	    		if(strlen($value)<=4){
	    			$numTel = substr($value,-4);
	    		}else if(strlen($value)>4 && strlen($value)<=8){
	    			$numTel = substr($value,-4);
	    			$numTel = substr(substr($value,-strlen($value)),0,strlen($value)-4)."-".$numTel;
	    		}else if(strlen($value)>4 && strlen($value)<=9){
	    			$numTel = substr($value,-4);
	    			$numTel = substr(substr($value,-strlen($value)),0,strlen($value)-4)."-".$numTel;
	    		}else if(strlen($value)==10 && substr($value,0,1)!=0){
	    			$numTel = substr($value,-4);
	    			$numTel = substr(substr($value,-8),0,4)."-".$numTel;
	    			$numTel = "(".substr($value,0,2).") ".$numTel;
	    		}else if(strlen($value)==11 && substr($value,0,1)!=0){
	    			$numTel = substr($value,-4);
	    			$numTel = substr(substr($value,-9),0,5)."-".$numTel;
	    			$numTel = "(".substr($value,0,2).") ".substr($numTel,0,1)." ".substr($numTel,1);
	    		}
	    	}
	    	return $numTel;
    	}else{
    		return $value;
    	}
    }
    public function isWeekDay($date,$by="timestamp"){
    	if($this->stringToUpper($by)=="TIMESTAMP"){
    		if(date("N",$date)==6 || date("N",$date)==7){
    			return false;
    		}else{
    			return true;
    		}
    	}
    }    
    public function getMes($numMes,$type="abb"){
    	if($numMes!=""){
	    	if($this->stringToUpper($type)=="ABB"){
	    		return $this->mesAbb[$numMes];
	    	}else{
	    		return $this->mes[$numMes];
	    	}
    	}else{
    		if($this->stringToUpper($type)=="ABB"){
    			return $this->mesAbb;
    		}else{
    			return $this->mes;
    		}
    	}
    }
    public function microtime_float(){
    	list($usec, $sec) = $this->exeExplode(" ", microtime());
    	return ((float)$usec + (float)$sec);
    }
	public function getProximoApontamento($tempoReal = 0){
		global $AP_HORA;
		global $AP_MIN;
		global $AP_SEG;

		if(!$tempoReal){
			$tempoReal = time();
			$tempo = time();
		}else{
			$tempo = $tempoReal;
		}
		$apontamento[1] = mktime($AP_HORA[1],$AP_MIN[1],$AP_SEG[1],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[2] = mktime($AP_HORA[2],$AP_MIN[2],$AP_SEG[2],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[3] = mktime($AP_HORA[3],$AP_MIN[3],$AP_SEG[3],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[4] = mktime($AP_HORA[4],$AP_MIN[4],$AP_SEG[4],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[5] = mktime($AP_HORA[5],$AP_MIN[5],$AP_SEG[5],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[6] = mktime($AP_HORA[6],$AP_MIN[6],$AP_SEG[6],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[7] = mktime($AP_HORA[7],$AP_MIN[7],$AP_SEG[7],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[8] = mktime($AP_HORA[8],$AP_MIN[8],$AP_SEG[8],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[9] = mktime($AP_HORA[9],$AP_MIN[9],$AP_SEG[9],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[10] = mktime($AP_HORA[10],$AP_MIN[10],$AP_SEG[10],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[11] = mktime($AP_HORA[11],$AP_MIN[11],$AP_SEG[11],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		for($i=1;$i<=11;$i++){
			if($AP_SEG[$i]==59){
				$apontamento[$i] = $apontamento[$i] + 1; 
			}
			if($apontamento[$i]>$tempoReal){
				return $apontamento[$i];
				break;
			}
		}
	}
	public function getApontamentoAnterior($tempoReal = 0){
		global $AP_HORA;
		global $AP_MIN;
		global $AP_SEG;

		if(!$tempoReal){
			$tempoReal = time();
			$tempo = time();
		}else{
			$tempo = $tempoReal;
		}
		$apontamento[0] = mktime($AP_HORA[0],$AP_MIN[0],$AP_SEG[0],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[1] = mktime($AP_HORA[1],$AP_MIN[1],$AP_SEG[1],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[2] = mktime($AP_HORA[2],$AP_MIN[2],$AP_SEG[2],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[3] = mktime($AP_HORA[3],$AP_MIN[3],$AP_SEG[3],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[4] = mktime($AP_HORA[4],$AP_MIN[4],$AP_SEG[4],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[5] = mktime($AP_HORA[5],$AP_MIN[5],$AP_SEG[5],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[6] = mktime($AP_HORA[6],$AP_MIN[6],$AP_SEG[6],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[7] = mktime($AP_HORA[7],$AP_MIN[7],$AP_SEG[7],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[8] = mktime($AP_HORA[8],$AP_MIN[8],$AP_SEG[8],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[9] = mktime($AP_HORA[9],$AP_MIN[9],$AP_SEG[9],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[10] = mktime($AP_HORA[10],$AP_MIN[10],$AP_SEG[10],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		$apontamento[11] = mktime($AP_HORA[11],$AP_MIN[11],$AP_SEG[11],date("n",$tempo),date("j",$tempo),date("Y",$tempo));
		for($i=0;$i<=11;$i++){
			if($AP_SEG[$i]==59){
				$apontamento[$i] = $apontamento[$i] + 1; 
			}
			if($apontamento[$i]>$tempoReal){
				if($i>0){
					return $apontamento[$i - 1];
				}else{
					return $apontamento[10];
				}
			}
		}
	}
	public function getTurno($dataAtual = 0){
		global $TURNO_HORA;
		global $TURNO_MIN;

		if($dataAtual==0){
			$dataAtual = time();
		}

		$horaTurno1 = $TURNO_HORA[1];
		$horaTurno2 = $TURNO_HORA[2];
		$horaTurno3 = $TURNO_HORA[3];
		
		$minTurno1 = $TURNO_MIN[1];
		$minTurno2 = $TURNO_MIN[2];
		$minTurno3 = $TURNO_MIN[3];

		$lastHour = date("H",$dataAtual);
		$minAtual = date("i",$dataAtual);

		if($lastHour==0){
			$last = 24;
		}
		
		if(($lastHour==$horaTurno1 && $minAtual>=$minTurno1) || ($lastHour>$horaTurno1 && $lastHour<$horaTurno2) || ($lastHour==$horaTurno2 && $minAtual<$minTurno2)){
			$turno = 1;
		}else if(($lastHour==$horaTurno2 && $minAtual>=$minTurno2) || ($lastHour>$horaTurno2 && $lastHour<$horaTurno3) || ($lastHour==$horaTurno3 && $minAtual<$minTurno3)){
			$turno = 2;
		}else if(($lastHour==$horaTurno3 && $minAtual>=$minTurno3) || $lastHour>$horaTurno3 || $lastHour<$horaTurno1 || ($lastHour==$horaTurno1 && $minAtual<$minTurno1)){
			$turno = 3;
		}

		return $turno;
	}
	public function getTurnoTolerancia($dataAtual = 0){
		global $TURNO_HORA_TOLERANCIA;
		global $TURNO_MIN_TOLERANCIA;

		if($dataAtual==0){
			$dataAtual = time();
		}

		$horaTurno1 = $TURNO_HORA_TOLERANCIA[1];
		$horaTurno2 = $TURNO_HORA_TOLERANCIA[2];
		$horaTurno3 = $TURNO_HORA_TOLERANCIA[3];
		
		$minTurno1 = $TURNO_MIN_TOLERANCIA[1];
		$minTurno2 = $TURNO_MIN_TOLERANCIA[2];
		$minTurno3 = $TURNO_MIN_TOLERANCIA[3];

		$lastHour = date("H",$dataAtual);
		$minAtual = date("i",$dataAtual);

		if($lastHour==0){
			$last = 24;
		}
		
		if(($lastHour==$horaTurno1 && $minAtual>=$minTurno1) || ($lastHour>$horaTurno1 && $lastHour<$horaTurno2) || ($lastHour==$horaTurno2 && $minAtual<$minTurno2)){
			$turno = 1;
		}else if(($lastHour==$horaTurno2 && $minAtual>=$minTurno2) || ($lastHour>$horaTurno2 && $lastHour<$horaTurno3) || ($lastHour==$horaTurno3 && $minAtual<$minTurno3)){
			$turno = 2;
		}else if(($lastHour==$horaTurno3 && $minAtual>=$minTurno3) || $lastHour>$horaTurno3 || $lastHour<$horaTurno1 || ($lastHour==$horaTurno1 && $minAtual<$minTurno1)){
			$turno = 3;
		}

		return $turno;
	}
	public function exeExplode($delimiter,$text=""){
		$arrayReturn = array();
		if(strlen($delimiter)==0){
			return $arrayReturn;
		}else if(strlen($text)==0){
			return $arrayReturn;
		}else if(strpos($text,$delimiter)===false){
			$arrayReturn[] = $text;
			return $arrayReturn;
		}else{
			$arrayReturn = explode($delimiter,$text);
			return $arrayReturn;
		}
	}
    public function exeImplode($delimiter,$array){
        $delimiterB = "";
		$res = "";
		if(is_array($array)){
			if(count($array)>0){
				foreach($array as $kA => $vA){
					if($vA!=""){
						$res .= $delimiterB.$vA;
						$delimiterB = $delimiter;
					}
				}
			}
		}
        return $res;
    }
    public function formatNumber($number,$digit=2,$mode="DECIMAL"){
    	$valor = $number;
		if(strlen($valor)==0){
			$valor = 0;
		}
    	#$mode = $this->stringToUpper($mode);
    	if($mode=="DECIMAL"){
	    	$valor = str_replace("R$", "", $valor);
	    	$valor = str_replace(" ", "", $valor);
	    	$valor = str_replace(".", "#", $valor);
	    	$valor = str_replace(",", ".", $valor);
	    	$valor = str_replace("#", "", $valor);
	    	$valor = round($valor,$digit);
    	}else if($mode=="DECIMAL_PT"){
	    	$valor = str_replace("R$", "", $valor);
	    	$valor = str_replace(" ", "", $valor);
	    	if(strpos($valor,",")){
	    		$valor = str_replace(".", "#", $valor);
	    	}
	    	$valor = str_replace(",", ".", $valor);
	    	$valor = str_replace("#", "", $valor);
	    	$valor = round($valor,$digit);
	    	$valor = number_format($valor,$digit,",",".");
		}else if($mode=="DECIMAL_USA"){
	    	$valor = str_replace("R", "", $valor);
			$valor = str_replace("$", "", $valor);
	    	$valor = str_replace(" ", "", $valor);
	    	$valor = str_replace(",", "", $valor);
	    	$valor = round($valor,$digit);
	    	$valor = number_format($valor,$digit,".","");
    	}else if($mode=="MONEY"){
    		$valor = round($valor,$digit);
    		$valor = number_format($valor,2,",",".");
    		$valor = "R$ ".$valor;
    	}
    	if(strlen($number)==0){
    		$valor = "";
    	}
    	return $valor;
    }
    public function formatDate($date,$by="",$mode=""){
    	# VERIFICA SE O $date VEIO COMO OBJETO
		if(is_object($date)){
    		if($by=="" && $mode==""){
    			return $date->format("d/m/Y_H:i:s");
    		}else if($by=="usa" && $mode=="timestamp"){
    			return mktime($date->format("H"),$date->format("i"),$date->format("s"),$date->format("m"),$date->format("d"),$date->format("Y"));
			}else if($by=="usa" && $mode=="usa"){
				$time = mktime($date->format("H"),$date->format("i"),$date->format("s"),$date->format("m"),$date->format("d"),$date->format("Y"));
				return date("Y-m-d H:i:s",$time);
    		}else if($by=="bra" && $mode=="abb4"){
    			return $date->format("d/m/Y");
			}else if($by=="bra" && $mode=="abb6"){
    			return $date->format("d/m/y");
			}else if($by=="bra" && $mode=="anoMes"){
    			return $date->format("Ym");
    		}
    	}else{
			if(is_array($date)){
				$date = $date['date'];
			}
	    	if($date==0 || $date=="" || $date==null || strlen($date)==0){
	    		return "";
	    	# ERA ASSIM ATÉ 09/11/2018
	    	#}else if($date<946692000 && is_numeric($date) && $mode!="timestamp"){
	    	#	return $date;
	    	}else{
		    	if((strlen($date)==10 && is_numeric($date)) || $by=="timestamp"){
		    		if($mode=="hour"){
		    			return date("H:i:s",$date);
		    		}else if($mode=="abb"){
		    			return date("d/m",$date)." - ".date("H:i",$date);
		    		}else if($mode=="abb2"){
		    			return date("m/Y",$date);
		    		}else if($mode=="abb3"){
		    			return date("d/m",$date);
		    		}else if($mode=="abb4"){
		    			return date("d/m/Y",$date);
		    		}else if($mode=="abb5"){
		    			return date("d/m",$date)." ".date("H:i",$date);
	    			}else if($mode=="abb6"){
	    				return date("d/m/y",$date);
	    			}else if($mode=="abb7"){
	    				return date("d/m_H:i",$date);
	    			}else if($mode=="abb8"){
	    				return date("d/m/y",$date)." - ".date("H:i",$date);
	    			}else if($mode=="abb9"){
	    				return date("d/m/y_H:i",$date);
    				}else if($mode=="timestamp" && $by=="usa"){
    					return date("m/d/Y",$date)." ".date("H:i:s",$date);
					}else if($mode=="timestamp" && $by=="bra"){
    					return date("d/m/Y",$date)." ".date("H:i:s",$date);
		    		}else{
		    			return date("d/m/Y",$date)."_".date("H:i:s",$date);
		    		}
		    	}else{
		    		if(strlen($date)>1){
				    	$date = str_replace("-", ",", $date);
				    	$date = str_replace("_", ",", $date);
				    	$date = str_replace(" ", ",", $date);
				    	$date = str_replace(":", ",", $date);
						$date = str_replace("/", ",", $date);
						$date = str_replace("T", ",", $date);
				    	$date = $this->exeExplode(",", $date);
				    	if($mode=="hour"){
				    		return $date[3].":".$date[4].":".$date[5];
				    	}else if($mode=="abb"){
				    		return $date[2]."/".$date[1]."/".substr($date[0],2);
			    		}else if($mode=="abb2"){
			    			return $date[2]."/".$date[1]."/".$date[0];
				    	}else if($mode=="timestamp" && $by=="usa"){
				    		if(@$date[0]<100){
				    			@$date[0] = @$date[0] + 2000;
				    		}

				    		return mktime(@$date[3],@$date[4],@$date[5],@$date[1],@$date[2],@$date[0]);
			    		}else if($mode=="timestamp" && $by=="bra"){
			    			if(@$date[2]<100){
			    				$date[2] = date("Y");
			    			}
			    			if(strlen(@$date[1])==0){
			    				$date[1] = date("n");
			    			}
			    			return mktime(@$date[3],@$date[4],@$date[5],@$date[1],@$date[0],@$date[2]);
				    	}else{
				    		return $date[2]."/".$date[1]."/".$date[0]."_".$date[3].":".$date[4].":".$date[5];
				    	}
		    		}else{
		    			return false;
		    		}
		    	}
	    	}
    	}
    }
    public function formatDateTime($time=0,$mode="usa"){
    	if($time==0){
    		$time = time();
    	}
    	if($mode=="usa"){
    		return date("Y-m-d H:i:s",$time);
    	}else if($mode=="usa_rc"){
			return date("Y-m-d",$time);
		}else if($mode=="usa_rfc"){
			return date("Y-m-d",$time)."T".date("H:i:s",$time);
    	}else if($mode=="bra"){
    		return date("d/m/Y H:i:s",$time);
    	}
    }
    public function getTime(){
    	return time();
    }
    public function formatTime($timeSeconds,$type="hour"){
    	$return = false;
    	if($type=="hour"){
    		$hour = floor($timeSeconds / 3600);
    		$minute = floor(($timeSeconds - ($hour * 3600)) / 60);
    		$second = round($timeSeconds - ($hour * 3600) - ($minute * 60),0);
    		$return = $this->zeroLeft($hour).":".$this->zeroLeft($minute).":".$this->zeroLeft($second);
    	}else if($type=="day"){
			$day = floor($timeSeconds / 86400);
			if($day<1){
				$hour = floor($timeSeconds / 3600);
				$minute = floor(($timeSeconds - ($hour * 3600)) / 60);
				$second = round($timeSeconds - ($hour * 3600) - ($minute * 60),0);
				$return = $this->zeroLeft($hour).":".$this->zeroLeft($minute).":".$this->zeroLeft($second);
			}else{
				$timeSeconds = $timeSeconds - ($day * 86400);
				$hour = floor($timeSeconds / 3600);
				$minute = floor(($timeSeconds - ($hour * 3600)) / 60);
				$second = round($timeSeconds - ($hour * 3600) - ($minute * 60),0);
				if($day==1){
					$return = $day." dia e ".$this->zeroLeft($hour).":".$this->zeroLeft($minute).":".$this->zeroLeft($second);
				}else{
					$return = $day." dias e ".$this->zeroLeft($hour).":".$this->zeroLeft($minute).":".$this->zeroLeft($second);
				}
			}
		}
    	return $return;
    }
    public function zeroLeft($value,$totalDigit=2){
    	$zero[2][0] = "0";
    	$zero[2][1] = "";
    	$zero[2][2] = "";
    	$zero[2][3] = "";
    	$zero[3][0] = "00";
    	$zero[3][1] = "0";
    	$zero[3][2] = "";
    	$zero[3][3] = "";
    	$zero[4][0] = "000";
    	$zero[4][1] = "00";
    	$zero[4][2] = "0";
    	$zero[4][3] = "";
    	$zero[5][0] = "0000";
    	$zero[5][1] = "000";
    	$zero[5][2] = "00";
    	$zero[5][3] = "0";
    	$zero[5][4] = "";
    	$zero[6][0] = "00000";
    	$zero[6][1] = "0000";
    	$zero[6][2] = "000";
    	$zero[6][3] = "00";
    	$zero[6][4] = "0";
    	$zero[6][5] = "";
    	$zero[7][0] = "000000";
    	$zero[7][1] = "00000";
    	$zero[7][2] = "0000";
    	$zero[7][3] = "000";
    	$zero[7][4] = "00";
    	$zero[7][5] = "0";
    	$zero[7][6] = "";
    	
    	if($value<10){
    		$value = @$zero[$totalDigit][0].$value;
    	}else if($value<100){
    		$value = $zero[$totalDigit][1].$value;
    	}else if($value<1000){
    		$value = $zero[$totalDigit][2].$value;
    	}else if($value<10000){
    		$value = $zero[$totalDigit][3].$value;
    	}else if($value<100000){
    		$value = @$zero[$totalDigit][4].$value;
    	}else if($value<1000000){
    		$value = @$zero[$totalDigit][5].$value;
    	}else if($value<10000000){
    		$value = $zero[$totalDigit][6].$value;
    	}
    	return $value;
    }
    public function getName(){
    	return $this->name;
    }
    public function getNumState($name){
        $name = $this->stringToUpper($name);
        $keySelected = "";
        foreach($this->state as $key => $value){
            if($value==$name){
                $keySelected = $key;
            }
        }
        return $keySelected;
    }
    public function getState($num){
    	return $this->state[$num];
    }
    public function getStateArray(){
    	return $this->state;
    }
    public function setMinimumLength($value){
        $this->minimumLength = $value;
    }
    public function getMinimumLength(){
        return $this->minimumLength;
    }
    public function getFormName(){
        return $this->formName;
    }
    public function getBackGroundColorError(){
		return $this->backGroundColorError;
	}
    public function getFatherLayer(){
		return $this->layer;
	}
    public function getTable(){
		return $this->table;
	}
    public function getNivel(){
		return $this->nivel + 1;
	}
	public function setNivel($nivel){
		$this->nivel = $nivel;
	}
	public function setOnlyAlpha(){
		$this->check = "ALPHA";
	}
	public function setOnlyNum(){
		$this->check = "NUM";
	}
	public function setAsNumTel(){
		$this->check = "NUM_TEL";
	}
	public function setOnlyAlphaNum(){
		$this->check = "ALPHA_NUM";
	}
	public function setAsEmail(){
		$this->check = "EMAIL";
	}
	public function goToPage($page){
		header("Location: ".$page);
	}
	public function goToPageJava($page,$timeout=0,$parent=false){
		if($parent===true){
			$parent = "parent.";
		}else{
			$parent = "";
		}
		$e = "<script language=\"javascript\">";
		if($timeout==0){
			$e .= $parent."document.location.href = '".$page."';";
		}else{
			$e .= "setTimeout(";
			$e .= "function(){";
			$e .= $parent."document.location.href = '".$page."';";
			$e .= "}";
			$e .= ",".$timeout.");";
		}
		$e .= "</script>";
		
		$this->e("<textarea style=\"width:200px;height:400px\">".$e."</textarea>");
		
		$this->e($e);
	}
	public function refresh($path=false){
		if($path===false){
			header("Location: ".$_SERVER['SCRIPT_NAME']);
		}else{
			header("Location: ".$path);
		}
	}
	public function parseTextBetween($firstArg,$secondArg,$text){
		/*$firstPos = strpos($text,$firstArg);
		$firstPos += (strlen($firstArg) - 1);
		$secondPos = strpos($text,$secondArg);
		$secondPos -= (strlen($secondArg) - 1);
		return substr($text,($firstPos + 1),($secondPos - 1));*/
		$firstPos = strpos($text,$firstArg);
		$firstPos += strlen($firstArg);
		$secondPos = strpos($text,$secondArg);
		$secondPos -= (strlen($secondArg) - 1);
		return substr($text,$firstPos,($secondPos - $firstPos));
	}
	public function parseTextBetweenMulti($firstArg,$secondArg,$text){
		$firstPos = strpos($text,$firstArg);
		$firstPos += (strlen($firstArg) - 1);
		$secondPos = strpos($text,$secondArg);
		$length = $secondPos - $firstPos;
		return substr($text,($firstPos + 1),($length - 1));
	}
	public function limitText($text,$limit,$filter=false,$toUpper=false,$respectSpace=false,$ellipsis=false){
		if($ellipsis===true){
			if(strlen($text)<=$limit){
				$ellipsis = false;
			}
		}
		
		if($respectSpace===true){
			if(strlen($text)>$limit){
				$temp = substr($text,$limit);
				if(strpos($temp," ")===false){
					$text = substr($text,0,$limit);
				}else{
					$text = substr($text,0,$limit+strpos($temp," ")+1);
				}
			}else{
				$text = substr($text,0,$limit);
			}
		}else{
			$text = substr($text,0,$limit);
		}

		if($toUpper===true){
			$text = $this->stringToUpper($text);
		}

		if($filter===true){
			$carac = array("<",">","Ã","Â","§","Ã","Â","¨","{","}","#");
			foreach($carac as $value){
				$text = str_replace($value,"",$text);
			}
		}

		if($ellipsis===false){
			return $text;
		}else{
			return $text."...";
		}
	}
	public function e($texto,$estrutura = 0,$n = 1,$return=false){
		global $BYTES_PAGE;
		$textoN = "";
		for($i=1;$i<=$estrutura;$i++){
        	$textoN .= "    ";                          
    	}  
    	$texto = @(string)$texto;
    	if($n) $texto .= "\n";
		$textoN .= $texto;
		$BYTES_PAGE += strlen($textoN);

		if($return===false){
			echo $textoN;
			return true;
		}else{
			return $textoN;
		}
	}
    public function br($num=1){
        $br = "";
        for($i=0;$i<$num;$i++){
            $br .= "<br>";
        }
        return $br;
    }
	protected function newObj($obj,$name,$type,$father){
		global $HTML;
		global $OBJ;
		if(!is_array($OBJ)){
			$OBJ = array();
		}
        if($type=="page"){
            $HTML->pageName = $name;
        }
		$HTML->$name = $obj;
		$objSetted = 0;
		for($i=0;$i<count($OBJ);$i++){
			if($OBJ[$i]['name']==$name && $OBJ[$i]['type']==$type){
				$objSetted = 1;
			}
		}
		if($objSetted==0){
			$idObj = count($OBJ);
			$OBJ[$idObj]['name'] = $name;
			$OBJ[$idObj]['type'] = $type;
			$OBJ[$idObj]['father'] = $father;
			$OBJ[$idObj]['maked'] = 0;
		}else{
			$this->e("Objeto ".$name." já existe!");
		}
	}
	protected function endObj($father,$type=""){
		global $HTML;
		global $OBJ;
		for($i=0;$i<count($OBJ);$i++){
            if($type!=""){
                if($OBJ[$i]['type']==$type && $OBJ[$i]['maked']==0){
                    $name = $OBJ[$i]['name'];
                    if($father==""){
	                    if($type=="java"){
					        $HTML->$name->End($this->typeSetted);
	                        $this->typeSetted = $HTML->$name->getTypeSettedChanged();
	                    }else if($type=="style"){
	                    	$OBJ[$i]['maked'] = 1;
	                        $HTML->$name->End();
	                    }else if($OBJ[$i]['father']==$father){
	                    	$OBJ[$i]['maked'] = 1;
	                        $HTML->$name->End();
	                    }
                    }else if($OBJ[$i]['father']==$father){
                    	if($type=="style" || $type=="head" || $type=="iframe"){
                    		$OBJ[$i]['maked'] = 1;
                    		$HTML->$name->End();
                    	}
                    }
                }
            }else{
			    if($OBJ[$i]['father']==$father && ($OBJ[$i]['type']!="style" && $OBJ[$i]['type']!="java") && $OBJ[$i]['maked']==0){
                    $name = $OBJ[$i]['name'];
                    $OBJ[$i]['maked'] = 1;
					if($OBJ[$i]['type']=="dataTableAdapter"){
						if($HTML->$name->getInCard()===false){
							$HTML->$name->End();
						}
					}else{
				    	$HTML->$name->End();
					}
			    }
            }
		}
	}
	protected function endObjForced($name,$nivel=""){
		global $HTML;
		global $OBJ;
		for($i=0;$i<count($OBJ);$i++){
			if($OBJ[$i]['name']==$name && $OBJ[$i]['maked']==0){
				$name = $OBJ[$i]['name'];
				#$OBJ[$i]['maked'] = 1;
				if($nivel!=""){
					$HTML->$name->setNivel($nivel);
				}
				$HTML->$name->End();
			}
		}
	}
	public function getObj($name){
		global $HTML;
        if(isset($HTML->$name)){
		    return $HTML->$name;
        }else{
            return false;
        }
	}
	public function extractStatus($status,$filial){
		$status = $this->exeExplode(",",$status);
		$newStatus = -1;
		foreach($status as $kC => $vC){
			if(strpos($vC,"@".$filial."#")!==false){
				$newStatus = str_replace("@".$filial."#","",$vC);
				$newStatus = str_replace("$","",$newStatus);
			}
		}
		return $newStatus;
	}
	protected function getLayer($layer,$subLayer){
		$numLayers = 5;
		$numSubLayers = 1000;
		$struct = $numLayers * $numSubLayers;
		$makeLayer = $struct - ($struct - ($layer * $numSubLayers) - $subLayer);
		return $makeLayer;
	}
	protected function fillLayer($layer){
		if($layer<=0){
			$layer = 1;
		}
		$layer--;
		return $layer;
	}
	protected function fillSubLayer($subLayer){
		if($subLayer<=0){
			$subLayer = 0;
		}
		return $subLayer;
	}
	protected function fillText($text){
		$carac = array("<",">","Ã‚Â§","Ã‚Â¨","{","}","#");
		foreach($carac as $value){
			$text = str_replace($value,"",$text);
		}
		return $text;
	}
	public function stringToUpper($text,$ignoreCaractereEspecial=false){		
		$arrayLow['à'] = "@#01";
		$arrayLow['á'] = "@#02";
		$arrayLow['â'] = "@#03";
		$arrayLow['ã'] = "@#04";
		$arrayLow['ç'] = "@#05";
		$arrayLow['è'] = "@#06";
		$arrayLow['é'] = "@#07";
		$arrayLow['ê'] = "@#08";
		$arrayLow['ì'] = "@#09";
		$arrayLow['í'] = "@#10";
		$arrayLow['î'] = "@#11";
		$arrayLow['ò'] = "@#12";
		$arrayLow['ó'] = "@#13";
		$arrayLow['ô'] = "@#14";
		$arrayLow['õ'] = "@#15";
		$arrayLow['ù'] = "@#16";
		$arrayLow['ú'] = "@#17";
		$arrayLow['û'] = "@#18";
		$arrayLow['ü'] = "@#19";
		$arrayLow['ý'] = "@#20";
		$arrayLow['°'] = "@#21";
		$arrayLow['º'] = "@#22";
		$arrayLow['ª'] = "@#23";
		
		foreach ($arrayLow as $key => $value){
			$text = str_replace($key, $value, $text);
		}
		
		$text = strtoupper($text);
		
		if($ignoreCaractereEspecial===false){
			$arrayUp['@#01'] = "À";
			$arrayUp['@#02'] = "Á";
			$arrayUp['@#03'] = "Â";
			$arrayUp['@#04'] = "Ã";
			$arrayUp['@#05'] = "Ç";
			$arrayUp['@#06'] = "È";
			$arrayUp['@#07'] = "É";
			$arrayUp['@#08'] = "Ê";
			$arrayUp['@#09'] = "Ì";
			$arrayUp['@#10'] = "Í";
			$arrayUp['@#11'] = "Î";
			$arrayUp['@#12'] = "Ò";
			$arrayUp['@#13'] = "Ó";
			$arrayUp['@#14'] = "Ô";
			$arrayUp['@#15'] = "Õ";
			$arrayUp['@#16'] = "Ù";
			$arrayUp['@#17'] = "Ú";
			$arrayUp['@#18'] = "Û";
			$arrayUp['@#19'] = "Ü";
			$arrayUp['@#20'] = "Ý";
			$arrayUp['@#21'] = "°";
			$arrayUp['@#22'] = "°";
			$arrayUp['@#23'] = "ª";
		}else{
			$arrayUp['@#01'] = "A";
			$arrayUp['@#02'] = "A";
			$arrayUp['@#03'] = "A";
			$arrayUp['@#04'] = "A";
			$arrayUp['@#05'] = "C";
			$arrayUp['@#06'] = "E";
			$arrayUp['@#07'] = "E";
			$arrayUp['@#08'] = "E";
			$arrayUp['@#09'] = "I";
			$arrayUp['@#10'] = "I";
			$arrayUp['@#11'] = "I";
			$arrayUp['@#12'] = "O";
			$arrayUp['@#13'] = "O";
			$arrayUp['@#14'] = "O";
			$arrayUp['@#15'] = "O";
			$arrayUp['@#16'] = "U";
			$arrayUp['@#17'] = "U";
			$arrayUp['@#18'] = "U";
			$arrayUp['@#19'] = "U";
			$arrayUp['@#20'] = "Y";
			$arrayUp['@#21'] = "O";
			$arrayUp['@#22'] = "O";
			$arrayUp['@#23'] = "A";
		}
			
		foreach ($arrayUp as $key => $value){
			$text = str_replace($key, $value, $text);
		}
		
		return $text;
	}
	public function stringToLower($text,$ignoreCaractereEspecial=false){
		$arrayUp['À'] = "@#01";
		$arrayUp['Á'] = "@#02";
		$arrayUp['Â'] = "@#03";
		$arrayUp['Ã'] = "@#04";
		$arrayUp['Ç'] = "@#05";
		$arrayUp['È'] = "@#06";
		$arrayUp['É'] = "@#07";
		$arrayUp['Ê'] = "@#08";
		$arrayUp['Ì'] = "@#09";
		$arrayUp['Í'] = "@#10";
		$arrayUp['Î'] = "@#11";
		$arrayUp['Ò'] = "@#12";
		$arrayUp['Ó'] = "@#13";
		$arrayUp['Ô'] = "@#14";
		$arrayUp['Õ'] = "@#15";
		$arrayUp['Ù'] = "@#16";
		$arrayUp['Ú'] = "@#17";
		$arrayUp['Û'] = "@#18";
		$arrayUp['Ü'] = "@#19";
		$arrayUp['Ý'] = "@#20";
		$arrayUp['°'] = "@#21";
		$arrayUp['º'] = "@#22";
		$arrayUp['ª'] = "@#23";
		
		foreach ($arrayUp as $key => $value){
			$text = str_replace($key, $value, $text);
		}
		
		$text = strtolower($text);
		
		if($ignoreCaractereEspecial===false){
			$arrayLow['@#01'] = "à";
			$arrayLow['@#02'] = "á";
			$arrayLow['@#03'] = "â";
			$arrayLow['@#04'] = "ã";
			$arrayLow['@#05'] = "ç";
			$arrayLow['@#06'] = "è";
			$arrayLow['@#07'] = "é";
			$arrayLow['@#08'] = "ê";
			$arrayLow['@#09'] = "ì";
			$arrayLow['@#10'] = "í";
			$arrayLow['@#11'] = "î";
			$arrayLow['@#12'] = "ò";
			$arrayLow['@#13'] = "ó";
			$arrayLow['@#14'] = "ô";
			$arrayLow['@#15'] = "õ";
			$arrayLow['@#16'] = "ù";
			$arrayLow['@#17'] = "ú";
			$arrayLow['@#18'] = "û";
			$arrayLow['@#19'] = "ü";
			$arrayLow['@#20'] = "ý";
			$arrayLow['@#21'] = "°";
			$arrayLow['@#22'] = "°";
			$arrayLow['@#23'] = "ª";
		}else{
			$arrayLow['@#01'] = "a";
			$arrayLow['@#02'] = "a";
			$arrayLow['@#03'] = "a";
			$arrayLow['@#04'] = "a";
			$arrayLow['@#05'] = "c";
			$arrayLow['@#06'] = "e";
			$arrayLow['@#07'] = "e";
			$arrayLow['@#08'] = "e";
			$arrayLow['@#09'] = "i";
			$arrayLow['@#10'] = "i";
			$arrayLow['@#11'] = "i";
			$arrayLow['@#12'] = "o";
			$arrayLow['@#13'] = "o";
			$arrayLow['@#14'] = "o";
			$arrayLow['@#15'] = "o";
			$arrayLow['@#16'] = "u";
			$arrayLow['@#17'] = "u";
			$arrayLow['@#18'] = "u";
			$arrayLow['@#19'] = "u";
			$arrayLow['@#20'] = "y";
			$arrayLow['@#21'] = "o";
			$arrayLow['@#22'] = "o";
			$arrayLow['@#23'] = "a";
		}
		
		foreach ($arrayLow as $key => $value){
			$text = str_replace($key, $value, $text);
		}
		
		return $text;
	}
	public function verifyValue($text,$type){
		$textOriginal = $text;
		$types['ALPHA'] = "# ABCDEFGHIJKLMNOPQRSTUVXYWZÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝàáâãäåæçèéêëìíîïðñòóôõöøùúûüý°°ª.,";
		$types['NUM'] = "#0123456789-.,";
		$types['NUM_LOCK'] = "#0123456789-.,";
		$types['NUM_TEL'] = "#0123456789()- ";
		$types['ALPHA_NUM'] = "# ABCDEFGHIJKLMNOPQRSTUVXYWZÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝàáâãäåæçèéêëìíîïðñòóôõöøùúûüý°°ª0123456789-.,";
		$types['ALPHA_NUM_PARENTESE'] = "# ABCDEFGHIJKLMNOPQRSTUVXYWZÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝàáâãäåæçèéêëìíîïðñòóôõöøùúûüý°°ª0123456789-.,()";
		$types['ALPHA_NUM_PARENTESE_CLEAN'] = "# ABCDEFGHIJKLMNOPQRSTUVXYWZ0123456789-.,()";
		$types['ALPHA_NUM_PARENTESE_BARRA_CLEAN'] = "# ABCDEFGHIJKLMNOPQRSTUVXYWZ0123456789-_.,()/\\";
		$types['ALPHA_NUM_PARENTESE_BARRA_CLEAN_CARACTERES'] = "# ABCDEFGHIJKLMNOPQRSTUVXYWZÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝàáâãäåæçèéêëìíîïðñòóôõöøùúûüý°°ª0123456789-_.,()/\\";
		$types['NOT_LIKE'] = "#!#$%&*(),;:><|[]";//"#!#$%&*(),;:><|\\/[]";
		$type = $this->stringToUpper($type);
		$text = $this->stringToUpper($text);
		if($type=="EMAIL"){
			$res = 0;
			$lastI = 0;
			for($i=0;$i<strlen($text);$i++){
				if(stripos("#@",$text[$i])){
					$res = 1;
					$lastI = $i;
				}
			}
			if($res==1){
				$res = 0;
				for($i=$lastI;$i<strlen($text);$i++){
					if(stripos("#.",$text[$i])){
						$res = 1;
					}
				}
			}
			if($res==1){
				if(strpos($textOriginal,"yahoo.com")!==false){
					if(strpos($textOriginal,"yahoo.com.br")===false){
						$res = 0;
					}
				}
			}
			if($res==1){
				if(strpos($textOriginal,"google.com")!==false){
					if(strpos($textOriginal,"google.com.br")!==false){
						$res = 0;
					}
				}
			}
			if($res==1){
				if(strpos($textOriginal,"gmail.com")!==false){
					if(strpos($textOriginal,"gmail.com.br")!==false){
						$res = 0;
					}
				}
			}
			if($res==1){
				if(strpos($textOriginal,"globo.com")!==false){
					if(strpos($textOriginal,"globo.com.br")!==false){
						$res = 0;
					}
				}
			}
			if($res==1){
				for($i=0;$i<strlen($textOriginal);$i++){
					if(stripos($types['NOT_LIKE'],$text[$i])!==false){
						$res = 0;
					}
				}
			}
			if($res==1){
				if(strlen($textOriginal)>=256){
					$res = 0;
				}
			}
		}else if($type=="TEL"){
			$res = 1;
			$text = $this->clearNumber($text);
			if(strlen($text)<10 || strlen($text)>11){
				$res = 0;
			}else if(strlen($text)==11 && substr($text,2,1)!=9){
				$res = 0;
			}
		}else if($type=="NAME"){
			$res = 1;
			for($i=0;$i<strlen($text);$i++){
				if(!stripos($types['ALPHA_NUM'],$text[$i])){
					$res = 0;
				}
			}
			if($res==1){
				$res = 0;
				$posSpc = strpos($text," ");
				$sizeText = strlen($text);
				if($posSpc>0 && ($posSpc+1)!=$sizeText){
					$res = 1;
				}
			}
		}else if($type=="ALPHA_NUM"){
			$resAlpha = 0;
			for($i=0;$i<strlen($text);$i++){
				if(stripos($types['ALPHA'],$text[$i])){
					$resAlpha = 1;
				}
			}
			$resNum = 0;
			for($i=0;$i<strlen($text);$i++){
				if(stripos($types['NUM'],$text[$i])){
					$resNum = 1;
				}
			}
			if($resAlpha==1 && $resNum==1){
				$res = 1;
			}else{
				$res = 0;
			}
		}else if($type=="ALPHA_NUM_PARENTESE"){
			$resAlpha = 0;
			for($i=0;$i<strlen($text);$i++){
				if(stripos($types['ALPHA_NUM_PARENTESE'],$text[$i])){
					$resAlpha = 1;
				}
			}

			if($resAlpha==1){
				$res = 1;
			}else{
				$res = 0;
			}
		}else if($type=="CPF_CNPJ"){
			if(!$this->verifyValue($text, "NUM")){
				$res = 0;
			}else if(strlen($text)!=11 && strlen($text)!=14){
				$res = 0;
			}else if(strlen($text)==11){
				// Extrai somente os números
				$cpf = $text;
				$cpf = preg_replace( '/[^0-9]/is', '', $cpf );
				
				// Verifica se foi informado todos os digitos corretamente
				if (strlen($cpf) != 11) {
					return false;
				}

				// Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
				if (preg_match('/(\d)\1{10}/', $cpf)) {
					return false;
				}

				// Faz o calculo para validar o CPF
				for ($t = 9; $t < 11; $t++) {
					for ($d = 0, $c = 0; $c < $t; $c++) {
						$d += $cpf[$c] * (($t + 1) - $c);
					}
					$d = ((10 * $d) % 11) % 10;
					if ($cpf[$c] != $d) {
						return false;
					}
				}
				return true;
			}else{
				$soma = 0;
				
				$soma += ($text[0] * 5);
				$soma += ($text[1] * 4);
				$soma += ($text[2] * 3);
				$soma += ($text[3] * 2);
				$soma += ($text[4] * 9);
				$soma += ($text[5] * 8);
				$soma += ($text[6] * 7);
				$soma += ($text[7] * 6);
				$soma += ($text[8] * 5);
				$soma += ($text[9] * 4);
				$soma += ($text[10] * 3);
				$soma += ($text[11] * 2);
			
				$d1 = $soma % 11;
				$d1 = $d1 < 2 ? 0 : 11 - $d1;
			
				$soma = 0;
				$soma += ($text[0] * 6);
				$soma += ($text[1] * 5);
				$soma += ($text[2] * 4);
				$soma += ($text[3] * 3);
				$soma += ($text[4] * 2);
				$soma += ($text[5] * 9);
				$soma += ($text[6] * 8);
				$soma += ($text[7] * 7);
				$soma += ($text[8] * 6);
				$soma += ($text[9] * 5);
				$soma += ($text[10] * 4);
				$soma += ($text[11] * 3);
				$soma += ($text[12] * 2);
			
			
				$d2 = $soma % 11;
				$d2 = $d2 < 2 ? 0 : 11 - $d2;
			
				if ($text[12] == $d1 && $text[13] == $d2) {
					return true;
				} else {
					return false;
				}
			}
		}else if($type=="SENHA"){
			$res = 1;
			$subText = substr($text,0,6);
			if(strlen($subText)<6){
				$res = 0;
			}else if($subText=="000000"){
				$res = 0;
			}else if($subText=="111111"){
				$res = 0;
			}else if($subText=="222222"){
				$res = 0;
			}else if($subText=="333333"){
				$res = 0;
			}else if($subText=="444444"){
				$res = 0;
			}else if($subText=="555555"){
				$res = 0;
			}else if($subText=="666666"){
				$res = 0;
			}else if($subText=="777777"){
				$res = 0;
			}else if($subText=="888888"){
				$res = 0;
			}else if($subText=="999999"){
				$res = 0;
			}else if($subText=="123456"){
				$res = 0;
			}else if(strpos($subText," ")!==false){
				$res = 0;
			}else if((!$this->verifyValue($text,"ALPHA") && !$this->verifyValue($text,"ALPHA_NUM")) || (!$this->verifyValue($text,"NUM") && !$this->verifyValue($text,"ALPHA_NUM"))){
				$res = 0;
			}
		}else if($type=="NUMERO_REDONDO"){
			$tempA = ceil($this->division($textOriginal,100))*100;
			if($tempA==$textOriginal){
				$res = 1;
			}else{
				$res = 0;
			}
		}else{
			$res = 1;
			for($i=0;$i<strlen($text);$i++){
				if(stripos(substr($types[$type],1),$text[$i])===false){
					$res = 0;
				}
			}
		}
		if($res){
			return true;
		}else{
			return false;
		}
	}
	
	public function setCol($cols){
		$setCol = "";
		if($cols){
			$cols = $this->exeExplode(",", $cols);
	
			for($i = 0;$i < count($cols);$i++) {
				if($i===0) { $setCol .= " col-" . $cols[$i]; }
				if($i===1) { $setCol .= " col-sm-" . $cols[$i]; }
				if($i===2) { $setCol .= " col-md-" . $cols[$i]; }
				if($i===3) { $setCol .= " col-lg-" . $cols[$i]; }
				if($i===4) { $setCol .= " col-xl-" . $cols[$i]; }
				if($i>=5){
					$setCol .= " ".$cols[$i];
				}
			}
		}
		return $setCol;
	}
	
	public function removeAcento($string){
		$comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ü', 'Ú');
		
		$semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');
		
		return str_replace($comAcentos, $semAcentos, $string);
	}
	
	public function rcd_mobile_device_detect($iphone=true,$android=true,$opera=true,$blackberry=true,$palm=true,$windows=true,$mobileredirect=false,$desktopredirect=false){
	  $mobile_browser   = false; // set mobile browser as false till we can prove otherwise
	
	  $user_agent       = $_SERVER['HTTP_USER_AGENT']; // get the user agent value - this should be cleaned to ensure no nefarious input gets executed
	
	  $accept           = $_SERVER['HTTP_ACCEPT']; // get the content accept value - this should be cleaned to ensure no nefarious input gets executed
	
	  switch(true){ // using a switch against the following statements which could return true is more efficient than the previous method of using if statements
	
	 
	
		case (preg_match('/ipod/i',$user_agent)||preg_match('/iphone/i',$user_agent)); // we find the words iphone or ipod in the user agent
	
		  $mobile_browser = $iphone; // mobile browser is either true or false depending on the setting of iphone when calling the function
	
		  if(substr($iphone,0,4)=='http'){ // does the value of iphone resemble a url
	
			$mobileredirect = $iphone; // set the mobile redirect url to the url value stored in the iphone value
	
		  } // ends the if for iphone being a url
	
		break; // break out and skip the rest if we've had a match on the iphone or ipod
	
	 
	
		case (preg_match('/android/i',$user_agent));  // we find android in the user agent
	
		  $mobile_browser = $android; // mobile browser is either true or false depending on the setting of android when calling the function
	
		  if(substr($android,0,4)=='http'){ // does the value of android resemble a url
	
			$mobileredirect = $android; // set the mobile redirect url to the url value stored in the android value
	
		  } // ends the if for android being a url
	
		break; // break out and skip the rest if we've had a match on android
	
	 
	
		case (preg_match('/opera mini/i',$user_agent)); // we find opera mini in the user agent
	
		  $mobile_browser = $opera; // mobile browser is either true or false depending on the setting of opera when calling the function
	
		  if(substr($opera,0,4)=='http'){ // does the value of opera resemble a rul
	
			$mobileredirect = $opera; // set the mobile redirect url to the url value stored in the opera value
	
		  } // ends the if for opera being a url 
	
		break; // break out and skip the rest if we've had a match on opera
	
	 
	
		case (preg_match('/blackberry/i',$user_agent)); // we find blackberry in the user agent
	
		  $mobile_browser = $blackberry; // mobile browser is either true or false depending on the setting of blackberry when calling the function
	
		  if(substr($blackberry,0,4)=='http'){ // does the value of blackberry resemble a rul
	
			$mobileredirect = $blackberry; // set the mobile redirect url to the url value stored in the blackberry value
	
		  } // ends the if for blackberry being a url 
	
		break; // break out and skip the rest if we've had a match on blackberry
	
	 
	
		case (preg_match('/(palm os|palm|hiptop|avantgo|plucker|xiino|blazer|elaine)/i',$user_agent)); // we find palm os in the user agent - the i at the end makes it case insensitive
	
		  $mobile_browser = $palm; // mobile browser is either true or false depending on the setting of palm when calling the function
	
		  if(substr($palm,0,4)=='http'){ // does the value of palm resemble a rul
	
			$mobileredirect = $palm; // set the mobile redirect url to the url value stored in the palm value
	
		  } // ends the if for palm being a url 
	
		break; // break out and skip the rest if we've had a match on palm os
	
	 
	
		case (preg_match('/(windows ce; ppc;|windows ce; smartphone;|windows ce; iemobile)/i',$user_agent)); // we find windows mobile in the user agent - the i at the end makes it case insensitive
	
		  $mobile_browser = $windows; // mobile browser is either true or false depending on the setting of windows when calling the function
	
		  if(substr($windows,0,4)=='http'){ // does the value of windows resemble a rul
	
			$mobileredirect = $windows; // set the mobile redirect url to the url value stored in the windows value
	
		  } // ends the if for windows being a url 
	
		break; // break out and skip the rest if we've had a match on windows
	
	 
	
		case (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|vodafone|o2|pocket|kindle|mobile|pda|psp|treo)/i',$user_agent)); // check if any of the values listed create a match on the user agent - these are some of the most common terms used in agents to identify them as being mobile devices - the i at the end makes it case insensitive
	
		  $mobile_browser = true; // set mobile browser to true
	
		break; // break out and skip the rest if we've preg_match on the user agent returned true 
	
	 
	
		case ((strpos($accept,'text/vnd.wap.wml')>0)||(strpos($accept,'application/vnd.wap.xhtml+xml')>0)); // is the device showing signs of support for text/vnd.wap.wml or application/vnd.wap.xhtml+xml
	
		  $mobile_browser = true; // set mobile browser to true
	
		break; // break out and skip the rest if we've had a match on the content accept headers
	
	 
	
		case (isset($_SERVER['HTTP_X_WAP_PROFILE'])||isset($_SERVER['HTTP_PROFILE'])); // is the device giving us a HTTP_X_WAP_PROFILE or HTTP_PROFILE header - only mobile devices would do this
	
		  $mobile_browser = true; // set mobile browser to true
	
		break; // break out and skip the final step if we've had a return true on the mobile specfic headers
	
	 
	
		case (in_array(strtolower(substr($user_agent,0,4)),array('1207'=>'1207','3gso'=>'3gso','4thp'=>'4thp','501i'=>'501i','502i'=>'502i','503i'=>'503i','504i'=>'504i','505i'=>'505i','506i'=>'506i','6310'=>'6310','6590'=>'6590','770s'=>'770s','802s'=>'802s','a wa'=>'a wa','acer'=>'acer','acs-'=>'acs-','airn'=>'airn','alav'=>'alav','asus'=>'asus','attw'=>'attw','au-m'=>'au-m','aur '=>'aur ','aus '=>'aus ','abac'=>'abac','acoo'=>'acoo','aiko'=>'aiko','alco'=>'alco','alca'=>'alca','amoi'=>'amoi','anex'=>'anex','anny'=>'anny','anyw'=>'anyw','aptu'=>'aptu','arch'=>'arch','argo'=>'argo','bell'=>'bell','bird'=>'bird','bw-n'=>'bw-n','bw-u'=>'bw-u','beck'=>'beck','benq'=>'benq','bilb'=>'bilb','blac'=>'blac','c55/'=>'c55/','cdm-'=>'cdm-','chtm'=>'chtm','capi'=>'capi','comp'=>'comp','cond'=>'cond','craw'=>'craw','dall'=>'dall','dbte'=>'dbte','dc-s'=>'dc-s','dica'=>'dica','ds-d'=>'ds-d','ds12'=>'ds12','dait'=>'dait','devi'=>'devi','dmob'=>'dmob','doco'=>'doco','dopo'=>'dopo','el49'=>'el49','erk0'=>'erk0','esl8'=>'esl8','ez40'=>'ez40','ez60'=>'ez60','ez70'=>'ez70','ezos'=>'ezos','ezze'=>'ezze','elai'=>'elai','emul'=>'emul','eric'=>'eric','ezwa'=>'ezwa','fake'=>'fake','fly-'=>'fly-','fly_'=>'fly_','g-mo'=>'g-mo','g1 u'=>'g1 u','g560'=>'g560','gf-5'=>'gf-5','grun'=>'grun','gene'=>'gene','go.w'=>'go.w','good'=>'good','grad'=>'grad','hcit'=>'hcit','hd-m'=>'hd-m','hd-p'=>'hd-p','hd-t'=>'hd-t','hei-'=>'hei-','hp i'=>'hp i','hpip'=>'hpip','hs-c'=>'hs-c','htc '=>'htc ','htc-'=>'htc-','htca'=>'htca','htcg'=>'htcg','htcp'=>'htcp','htcs'=>'htcs','htct'=>'htct','htc_'=>'htc_','haie'=>'haie','hita'=>'hita','huaw'=>'huaw','hutc'=>'hutc','i-20'=>'i-20','i-go'=>'i-go','i-ma'=>'i-ma','i230'=>'i230','iac'=>'iac','iac-'=>'iac-','iac/'=>'iac/','ig01'=>'ig01','im1k'=>'im1k','inno'=>'inno','iris'=>'iris','jata'=>'jata','java'=>'java','kddi'=>'kddi','kgt'=>'kgt','kgt/'=>'kgt/','kpt '=>'kpt ','kwc-'=>'kwc-','klon'=>'klon','lexi'=>'lexi','lg g'=>'lg g','lg-a'=>'lg-a','lg-b'=>'lg-b','lg-c'=>'lg-c','lg-d'=>'lg-d','lg-f'=>'lg-f','lg-g'=>'lg-g','lg-k'=>'lg-k','lg-l'=>'lg-l','lg-m'=>'lg-m','lg-o'=>'lg-o','lg-p'=>'lg-p','lg-s'=>'lg-s','lg-t'=>'lg-t','lg-u'=>'lg-u','lg-w'=>'lg-w','lg/k'=>'lg/k','lg/l'=>'lg/l','lg/u'=>'lg/u','lg50'=>'lg50','lg54'=>'lg54','lge-'=>'lge-','lge/'=>'lge/','lynx'=>'lynx','leno'=>'leno','m1-w'=>'m1-w','m3ga'=>'m3ga','m50/'=>'m50/','maui'=>'maui','mc01'=>'mc01','mc21'=>'mc21','mcca'=>'mcca','medi'=>'medi','meri'=>'meri','mio8'=>'mio8','mioa'=>'mioa','mo01'=>'mo01','mo02'=>'mo02','mode'=>'mode','modo'=>'modo','mot '=>'mot ','mot-'=>'mot-','mt50'=>'mt50','mtp1'=>'mtp1','mtv '=>'mtv ','mate'=>'mate','maxo'=>'maxo','merc'=>'merc','mits'=>'mits','mobi'=>'mobi','motv'=>'motv','mozz'=>'mozz','n100'=>'n100','n101'=>'n101','n102'=>'n102','n202'=>'n202','n203'=>'n203','n300'=>'n300','n302'=>'n302','n500'=>'n500','n502'=>'n502','n505'=>'n505','n700'=>'n700','n701'=>'n701','n710'=>'n710','nec-'=>'nec-','nem-'=>'nem-','newg'=>'newg','neon'=>'neon','netf'=>'netf','noki'=>'noki','nzph'=>'nzph','o2 x'=>'o2 x','o2-x'=>'o2-x','opwv'=>'opwv','owg1'=>'owg1','opti'=>'opti','oran'=>'oran','p800'=>'p800','pand'=>'pand','pg-1'=>'pg-1','pg-2'=>'pg-2','pg-3'=>'pg-3','pg-6'=>'pg-6','pg-8'=>'pg-8','pg-c'=>'pg-c','pg13'=>'pg13','phil'=>'phil','pn-2'=>'pn-2','pt-g'=>'pt-g','palm'=>'palm','pana'=>'pana','pire'=>'pire','pock'=>'pock','pose'=>'pose','psio'=>'psio','qa-a'=>'qa-a','qc-2'=>'qc-2','qc-3'=>'qc-3','qc-5'=>'qc-5','qc-7'=>'qc-7','qc07'=>'qc07','qc12'=>'qc12','qc21'=>'qc21','qc32'=>'qc32','qc60'=>'qc60','qci-'=>'qci-','qwap'=>'qwap','qtek'=>'qtek','r380'=>'r380','r600'=>'r600','raks'=>'raks','rim9'=>'rim9','rove'=>'rove','s55/'=>'s55/','sage'=>'sage','sams'=>'sams','sc01'=>'sc01','sch-'=>'sch-','scp-'=>'scp-','sdk/'=>'sdk/','se47'=>'se47','sec-'=>'sec-','sec0'=>'sec0','sec1'=>'sec1','semc'=>'semc','sgh-'=>'sgh-','shar'=>'shar','sie-'=>'sie-','sk-0'=>'sk-0','sl45'=>'sl45','slid'=>'slid','smb3'=>'smb3','smt5'=>'smt5','sp01'=>'sp01','sph-'=>'sph-','spv '=>'spv ','spv-'=>'spv-','sy01'=>'sy01','samm'=>'samm','sany'=>'sany','sava'=>'sava','scoo'=>'scoo','send'=>'send','siem'=>'siem','smar'=>'smar','smit'=>'smit','soft'=>'soft','sony'=>'sony','t-mo'=>'t-mo','t218'=>'t218','t250'=>'t250','t600'=>'t600','t610'=>'t610','t618'=>'t618','tcl-'=>'tcl-','tdg-'=>'tdg-','telm'=>'telm','tim-'=>'tim-','ts70'=>'ts70','tsm-'=>'tsm-','tsm3'=>'tsm3','tsm5'=>'tsm5','tx-9'=>'tx-9','tagt'=>'tagt','talk'=>'talk','teli'=>'teli','topl'=>'topl','tosh'=>'tosh','up.b'=>'up.b','upg1'=>'upg1','utst'=>'utst','v400'=>'v400','v750'=>'v750','veri'=>'veri','vk-v'=>'vk-v','vk40'=>'vk40','vk50'=>'vk50','vk52'=>'vk52','vk53'=>'vk53','vm40'=>'vm40','vx98'=>'vx98','virg'=>'virg','vite'=>'vite','voda'=>'voda','vulc'=>'vulc','w3c '=>'w3c ','w3c-'=>'w3c-','wapj'=>'wapj','wapp'=>'wapp','wapu'=>'wapu','wapm'=>'wapm','wig '=>'wig ','wapi'=>'wapi','wapr'=>'wapr','wapv'=>'wapv','wapy'=>'wapy','wapa'=>'wapa','waps'=>'waps','wapt'=>'wapt','winc'=>'winc','winw'=>'winw','wonu'=>'wonu','x700'=>'x700','xda2'=>'xda2','xdag'=>'xdag','yas-'=>'yas-','your'=>'your','zte-'=>'zte-','zeto'=>'zeto','acs-'=>'acs-','alav'=>'alav','alca'=>'alca','amoi'=>'amoi','aste'=>'aste','audi'=>'audi','avan'=>'avan','benq'=>'benq','bird'=>'bird','blac'=>'blac','blaz'=>'blaz','brew'=>'brew','brvw'=>'brvw','bumb'=>'bumb','ccwa'=>'ccwa','cell'=>'cell','cldc'=>'cldc','cmd-'=>'cmd-','dang'=>'dang','doco'=>'doco','eml2'=>'eml2','eric'=>'eric','fetc'=>'fetc','hipt'=>'hipt','http'=>'http','ibro'=>'ibro','idea'=>'idea','ikom'=>'ikom','inno'=>'inno','ipaq'=>'ipaq','jbro'=>'jbro','jemu'=>'jemu','java'=>'java','jigs'=>'jigs','kddi'=>'kddi','keji'=>'keji','kyoc'=>'kyoc','kyok'=>'kyok','leno'=>'leno','lg-c'=>'lg-c','lg-d'=>'lg-d','lg-g'=>'lg-g','lge-'=>'lge-','libw'=>'libw','m-cr'=>'m-cr','maui'=>'maui','maxo'=>'maxo','midp'=>'midp','mits'=>'mits','mmef'=>'mmef','mobi'=>'mobi','mot-'=>'mot-','moto'=>'moto','mwbp'=>'mwbp','mywa'=>'mywa','nec-'=>'nec-','newt'=>'newt','nok6'=>'nok6','noki'=>'noki','o2im'=>'o2im','opwv'=>'opwv','palm'=>'palm','pana'=>'pana','pant'=>'pant','pdxg'=>'pdxg','phil'=>'phil','play'=>'play','pluc'=>'pluc','port'=>'port','prox'=>'prox','qtek'=>'qtek','qwap'=>'qwap','rozo'=>'rozo','sage'=>'sage','sama'=>'sama','sams'=>'sams','sany'=>'sany','sch-'=>'sch-','sec-'=>'sec-','send'=>'send','seri'=>'seri','sgh-'=>'sgh-','shar'=>'shar','sie-'=>'sie-','siem'=>'siem','smal'=>'smal','smar'=>'smar','sony'=>'sony','sph-'=>'sph-','symb'=>'symb','t-mo'=>'t-mo','teli'=>'teli','tim-'=>'tim-','tosh'=>'tosh','treo'=>'treo','tsm-'=>'tsm-','upg1'=>'upg1','upsi'=>'upsi','vk-v'=>'vk-v','voda'=>'voda','vx52'=>'vx52','vx53'=>'vx53','vx60'=>'vx60','vx61'=>'vx61','vx70'=>'vx70','vx80'=>'vx80','vx81'=>'vx81','vx83'=>'vx83','vx85'=>'vx85','wap-'=>'wap-','wapa'=>'wapa','wapi'=>'wapi','wapp'=>'wapp','wapr'=>'wapr','webc'=>'webc','whit'=>'whit','winw'=>'winw','wmlb'=>'wmlb','xda-'=>'xda-',))); // check against a list of trimmed user agents to see if we find a match
	
		  $mobile_browser = true; // set mobile browser to true
	
		break; // break even though it's the last statement in the switch so there's nothing to break away from but it seems better to include it than exclude it
	
	 
	
	  } // ends the switch 
	
	 
	
	  // tell adaptation services (transcoders and proxies) to not alter the content based on user agent as it's already being managed by this script
	
	  header('Cache-Control: no-transform'); // http://mobiforge.com/developing/story/setting-http-headers-advise-transcoding-proxies
	
	  header('Vary: User-Agent, Accept'); // http://mobiforge.com/developing/story/setting-http-headers-advise-transcoding-proxies
	
	 
	
	  // if redirect (either the value of the mobile or desktop redirect depending on the value of $mobile_browser) is true redirect else we return the status of $mobile_browser
	
	  if($redirect = ($mobile_browser==true) ? $mobileredirect : $desktopredirect){
	
		header('Location: '.$redirect); // redirect to the right url for this device
	
		exit;
	
	  }else{ 
	
		return $mobile_browser; // will return either true or false 
	
	  }
	
	} // ends function mobile_device_detect

	public function areaUploadBloqueada(){
		$html = "
			<div align=\"center\" class=\"col-12\">
				<div class=\"area-upload\" style=\"width:100%;\">
					<label for=\"upload-file\" class=\"label-upload\" id=\"label-upload\">
						<i class=\"fas fa-cloud-upload-alt\"></i>
						<div class=\"texto msgErro\">Não permitido fazer upload! Fale com o administrador do sistema!</div>
					</label>
				</div>
			</div>
		";
        return $html;
    }

	public function areaUpload($name,$scriptUpload,$objToLoad=false,$goToPageUploaded=false,$childUploaded=false,$addInFunctionUploaded="",$sizeLimit=10485760,$mimeTypes="",$minWidth=0,$maxWidth=10000,$label=false,$msgErrorA=false){
		global $_SECURITY;
		global $uri;

		$uploadJs = "";
		if($this->gateUploadJs===false){
			$this->gateUploadJs = true;
			$uploadJs = "<script src=\"".$uri."".$_SECURITY[0]['supportHost']."/RCD_7/upload.js?".time()."\" charset=\"UTF-8\"></script>";
		}
    
    	if($_SECURITY[0]['localHost']!=$_SECURITY[0]['supportHost']){
			$html = $this->areaUploadBloqueada();
		}else{
			if(strlen($mimeTypes)>0){
				$mimeTypesTempA = $this->exeExplode(",",$mimeTypes);
				$mimeTypesTempB = "";
				foreach($mimeTypesTempA as $kA => $vA){
					if(strlen($mimeTypesTempB)>0){
						$mimeTypesTempB .= ",";
					}
					$mimeTypesTempB .= "'".$vA."'";
				}
				$mimeTypes = $mimeTypesTempB;
			}
      
			$html = "
				<div id=\"areaUpload".$name."\" name=\"areaUpload".$name."\"align=\"left\" class=\"col-12\">
					<div class=\"area-upload\" style=\"width:100%;\">
						<input type=\"hidden\" id=\"".$name."\" name=\"".$name."\" value=\"".$scriptUpload."\" />
						<label for=\"uploadFile".$name."\" class=\"label-upload\" id=\"labelUpload".$name."\">
							<i class=\"fas fa-cloud-upload-alt\"></i>
							<div class=\"texto\">".($label ? $label : "Clique ou Arraste<br>um Arquivo Aqui")."</div>
						</label>
						<input type=\"file\" id=\"uploadFile".$name."\" multiple />
						<div class=\"lista-uploads\" id=\"listaUploads".$name."\">
						</div>
					</div>
					".($objToLoad ? "<div id=\"".$objToLoad."\" name=\"".$objToLoad."\" style=\"width:100%;margin-top:20px;overflow:auto;\"></div>" : "")."
				</div>
				".$uploadJs."
				<script>
					function uploadCompleted".$name."(content){
						".($goToPageUploaded ? "goToPage('".$goToPageUploaded."','','','','','".($childUploaded ? $childUploaded : "")."');" : "")."
						".$addInFunctionUploaded."
					}
					var uploadConfig".$name." = uploadConfigStandard;
					uploadConfig".$name.".sizeLimit = ".$sizeLimit.";
					uploadConfig".$name.".mime_types = [".$mimeTypes."];
					uploadConfig".$name.".minWidth = ".$minWidth.";
					uploadConfig".$name.".maxWidth = ".$maxWidth.";

					newUpload(\"uploadFile".$name."\",\"labelUpload".$name."\",\"listaUploads".$name."\",\"".$name."\",uploadConfig".$name.",false,uploadCompleted".$name.",'".$msgErrorA."');
				</script>
			";
		}
    
    	return $html;
	}
}
# Html
class html extends generic {
	public $pageName;
}