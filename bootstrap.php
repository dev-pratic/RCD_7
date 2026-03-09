<?php
if(!isset($statusText)){
	$statusText = array();
}

if(count($statusText)==0){
	$statusText = array(
		-1 => "CADASTRO",
		0 => "DESATIVADO",
		1 => "ATIVO",
		2 => "BLOQUEADO"
	);

	$statusColor = array(
		-1 => COLOR_LIGHT_SILVER,
		0 => COLOR_WHITE,
		1 => COLOR_WHITE,
		2 => COLOR_WHITE
	);

	$statusBackgroundColor = array(
		-1 => COLOR_DARK_SILVER,
		0 => COLOR_RED,
		1 => COLOR_GREEN,
		2 => COLOR_PURPLE
	);
}

if(!defined("pularLinha")){
	define("pularLinha","tblLayOutSpcTr");
}

class bootstrap extends generic {
	private $father;
	private $readOnly = false;
	private $autoSave = false;
	private $resetAutoSave = false;
	private $linesHtml = array();
	private $openLine = false;
	private $openCell = false;
	private $openForm = false;
	private $openSpace = false;
	private $nivelInterno = false;
	private $allObj = array();
	private $uppercase = true;
	private $autoCompleteOff = true;
	private $noGenerateLayout = false;
	private $widthGeral = false;
	private $quebraPagina = false;
	private $contQuebraPagina = false;
	private $contQuebraPaginaTemp = 0;
	private $firstQuebraPagina = true;
	private $outSideTableText = false;
	private $withoutCell = false;
	private $listName = false;
	private $viewAll = false;
	private $comboBoxPanel = false;
	private $img = array();
	private $lastId = false;
	private $nameOrigin = array();
	public $asNotRequired = array();
	public $asUnique = array();
	public $asMoney = array();
	public $asNumber = array();
	public $comboBox = array();
	public $form = array();
	public $optionComboBox = array();
	public $textBox = array();
	public $date = array();
	public $file = array();
	public $checkBox = array();
	public $video = array();
	public $textBoxMultiLine = array();
	public $space = array();
	public $button = array();
	public $css;
	public $java;
	public $width = false;
	public $height = false;
	public $border = 0;
	public $cellpadding = 0;
	public $cellspacing = 0;
	public $list = array();
	
	function __construct($father,$name,$subLayer=0,$nivel=0,$useBootstrap=true){
		global $page;

		if($page->getBootstrap()!==true && $useBootstrap===true){
			$page->useBootstrap();
		}
		
		$this->father = $father;
		$this->subLayer = $subLayer;
		$this->type = "bootstrap";
		if($this->father!==false){
			$this->layer = $this->father->getFatherLayer();
			$this->nivel = $this->father->getNivel();
			$this->table = $this->father->getTable();
			$this->formName = $this->father->getFormName();
			$this->resetAutoSave = $this->father->getResetAutoSave();
			$this->readOnly = $this->father->getReadOnly();
			$this->autoCompleteOff = $this->father->getAutocompleteOff();
			$this->uppercase = $this->father->getUpperCase();
		}else{
			$this->nivel = $nivel;
		}
		$this->nivelInterno = $this->nivel;
		$this->name = $name;
		$this->css = new style($this->name);
		$this->newObj($this->css,"STYLE_".$this->name,"style",$this->name);
		$this->java = new java();
		$this->newObj($this->java,"JAVA_".$this->name,"java",$this->name);
		$this->newObj($this,$this->name,"bootstrap",$this->father->getName());
	}

	public function insertHTML($html,$name){
		$html .= "@insertHTML".$name."#";
		$this->linesHtml[$this->lastId]['html'] = str_replace("@insertHTML".$name."#",$html,$this->linesHtml[$this->lastId]['html']);
	}

	public function getAutocompleteOff(){
		return $this->autoCompleteOff;
	}

	public function getReadOnly(){
		return $this->readOnly;
	}
	public function getResetAutoSave(){
		return $this->resetAutoSave;
	}
	public function getUpperCase(){
		return $this->uppercase;
	}
	
	public function setWithoutCell(){
		$this->withoutCell = true;
	}
	
	public function outSideTable($text){
		$this->outSideTableText = $text;
	}
	
	public function quebraPagina($cont=false){
		if($cont!==false){
			$cont--;
		}
		$this->quebraPagina = true;
		$this->contQuebraPagina = $cont;
	}
	
	public function setWidthGeral($width="100%"){
		$this->widthGeral = $width;
	}
	
	public function setNoGenerateLayout(){
		$this->noGenerateLayout = true;
	}
	
	public function setGoToPanel($button,$panel,$form,$includeReset=false){
		global $page;
		global $PATH;
		global $c;
		global $FOLDER;
		
		$page->session->setSession("C",$c);
		
		$preInclude = substr(THIS, 0,(strrpos(THIS,"/")+1));
		$preInclude = str_replace("/".$FOLDER."/", "../", $preInclude);
		
		if($includeReset!==false){
			$this->java->setGoToPage("click", $button,$PATH."../RCD_7/iFormScriptInsertUpdate.php","RESET_THIS_FORM",$preInclude.$includeReset,false,"&PANEL=".$panel."&FORM=".$form,false,false,"objCorelyt".$form."0");
		}else{
			$this->java->setGoToPage("click", $button,$PATH."../RCD_7/iFormScriptInsertUpdate.php","RESET_THIS_FORM","1",false,"&PANEL=".$panel."&FORM=".$form,false,false,"objCorelyt".$form."0");
		}
	}
	
	public function viewAll(){
		global $page;
		global $PAGENAME;
		
		$this->viewAll = true;
		
		$this->button("btVerTodosD".$this->name,"Ver Todos");
		$this->java->setObjInvisible("click", "btVerTodosD".$this->name, "btVerTodosD".$this->name);
		$this->java->setObjVisible("click", "btVerTodosD".$this->name, "btVerTodosA".$this->name);
		if($page->session->getSession("VER_TODOS".$this->name,$PAGENAME)){
			$this->addStyles("btVerTodosD".$this->name, displayNone);
		}
		
		$this->button("btVerTodosA".$this->name,"Ver Todos", btActive);
		$this->java->setObjInvisible("click", "btVerTodosA".$this->name, "btVerTodosA".$this->name);
		$this->java->setObjVisible("click", "btVerTodosA".$this->name, "btVerTodosD".$this->name);
		if(!$page->session->getSession("VER_TODOS".$this->name,$PAGENAME)){
		 	$this->addStyles("btVerTodosA".$this->name, displayNone);
		}
	}
	
	public function listTable($name,$dataSet,$table,$execute=true,$title=false,$width=false,$id=false,$form=false,$panelForm=false,$withOutSubTitle=false){
		global $page;
		global $menuCore;
		global $PATH;
		global $PAGENAME;

		$this->listName = $name;
		
		$this->list[$name]['name'] = $name;
		$this->list[$name]['dataSet'] = $dataSet;
		$this->list[$name]['dataSetName'] = $dataSet->getDataSetName();
		$this->list[$name]['table'] = $table;
		$this->list[$name]['title'] = $title;
		$this->list[$name]['width'] = $width;
		$this->list[$name]['id'] = $id;
		$this->list[$name]['pagename'] = $PAGENAME;
		$this->list[$name]['path'] = $PATH;
		$this->list[$name]['form'] = $form;
		$this->list[$name]['panelForm'] = $panelForm;
		$this->list[$name]['withOutSubTitle'] = $withOutSubTitle;
		
		$page->session->setSession($name."_OBJ_".$name,$this->list[$name]);
		
		$this->space("td".$name);
		
		$this->java->core(false, $name, "td".$name,  $PATH."../RCD_7/iDataTableAdapterCore.php","","parameter","","noRefresh=1&SLT_NAME=".$name."&".$name."_DATASET=".$dataSet->getDataSetName()."&".$name."_TABLE=".$table,false,true,$execute);
	}
	
	public function listTableIdKey($column,$parameter,$pagename=false,$operator="="){
		global $page;
		global $PAGENAME;
		
		if($pagename===false){
			$pagename = $PAGENAME;
		}
		
		$id = count(@$this->list[$this->listName]['idKey']);
		
		$this->list[$this->listName]['idKey'][$column.$id]['column'] = $column;
		$this->list[$this->listName]['idKey'][$column.$id]['parameter'] = $parameter;
		$this->list[$this->listName]['idKey'][$column.$id]['pagename'] = $pagename;
		$this->list[$this->listName]['idKey'][$column.$id]['operator'] = $operator;
		
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableColumnFake($column,$fake){
		global $page;
		
		$this->list[$this->listName]['fake'][$column] = $fake;
		
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableColumnAsTel($column){
		global $page;
	
		$this->list[$this->listName]['asTel'][$column] = $column;
	
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableColumns($columns){
		global $page;
	
		$this->list[$this->listName]['columns'] = $columns;
	
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableOrder($order,$type=false,$table=false){
		global $page;
	
		$this->list[$this->listName]['order']['order'] = $order;
		$this->list[$this->listName]['order']['type'] = $type;
		$this->list[$this->listName]['order']['table'] = $table;
	
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableWhere($where,$value,$operator="="){
		global $page;
	
		$this->list[$this->listName]['where']['where'] = $where;
		$this->list[$this->listName]['where']['operator'] = $operator;
		$this->list[$this->listName]['where']['value'] = $value;
	
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableLimit($limit){
		global $page;
	
		$this->list[$this->listName]['limit']['limit'] = $limit;
	
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableAnd($column,$value,$operator="="){
		global $page;
	
		$id = count(@$this->list[$name]['and']);
		$this->list[$this->listName]['and'][$column.$id]['column'] = $column;
		$this->list[$this->listName]['and'][$column.$id]['operator'] = $operator;
		$this->list[$this->listName]['and'][$column.$id]['value'] = $value;
	
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableJoin($table,$where,$value,$operator="="){
		global $page;
	
		$id = count(@$this->list[$this->listName]['join']);
		$this->list[$this->listName]['join'][$id]['table'] = $table;
		$this->list[$this->listName]['join'][$id]['where'] = $where;
		$this->list[$this->listName]['join'][$id]['operator'] = $operator;
		$this->list[$this->listName]['join'][$id]['value'] = $value;
	
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableJoinColumns($table,$columns,$as=false){
		global $page;
	
		$id = count(@$this->list[$this->listName]['joinColumns']);
		$this->list[$this->listName]['joinColumns'][$id]['table'] = $table;
		$this->list[$this->listName]['joinColumns'][$id]['columns'] = $columns;
		$this->list[$this->listName]['joinColumns'][$id]['as'] = $as;
	
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableExpressionPre($expression){
		global $page;
	
		$id = count(@$this->list[$this->listName]['expressionPre']);
	
		$this->list[$this->listName]['expressionPre'][$id] = $expression;
	
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableExpressionPost($expression){
		global $page;
	
		$id = count(@$this->list[$this->listName]['expressionPost']);
		
		$this->list[$this->listName]['expressionPost'][$id] = $expression;
	
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableColumnDate($column,$by="timestamp",$mode="abb4"){
		global $page;
	
		$this->list[$this->listName]['date'][$column]['enable'] = true;
		$this->list[$this->listName]['date'][$column]['by'] = $by;
		$this->list[$this->listName]['date'][$column]['mode'] = $mode;
	
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableColumnMask($column,$maskArray){
		global $page;
	
		$this->list[$this->listName]['mask'][$column] = $maskArray;
	
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableFormatCondition($column,$value,$sign=true,$affectLine=false,$operator="="){
		global $page;
	
		$id = count(@$this->list[$this->listName]['formatCondition']);
		$this->list[$this->listName]['formatCondition'][$column.$id]['where'] = $column;
		$this->list[$this->listName]['formatCondition'][$column.$id]['value'] = $value;
		$this->list[$this->listName]['formatCondition'][$column.$id]['sign'] = $sign;
		$this->list[$this->listName]['formatCondition'][$column.$id]['affectLine'] = $affectLine;
		$this->list[$this->listName]['formatCondition'][$column.$id]['operator'] = $operator;
	
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableActionOnClik($column,$parameter,$columns,$form,$panel,$pagename=false,$type="FILL"){
		global $page;
		global $PATH;
		global $c;
		
		$page->session->setSession("C",$c);
	
		$id = count(@$this->list[$this->listName]['actionOnClick']);
		$this->list[$this->listName]['actionOnClick'][$column.$id]['type'] = "goToPage";
		$this->list[$this->listName]['actionOnClick'][$column.$id]['path'] = $PATH;
		$this->list[$this->listName]['actionOnClick'][$column.$id]['column'] = $column;
		$this->list[$this->listName]['actionOnClick'][$column.$id]['parameter'] = $parameter;
		$this->list[$this->listName]['actionOnClick'][$column.$id]['columns'] = $columns;
		$this->list[$this->listName]['actionOnClick'][$column.$id]['form'] = $form;
		$this->list[$this->listName]['actionOnClick'][$column.$id]['pagename'] = $pagename."&PAGENAME=".$pagename."&PARAMETER=".$parameter."&PANEL=".$panel."&TYPE=".$type."&DATASET=".$this->list[$this->listName]['dataSet']->getDataSetName()."&TABLE=".$this->list[$this->listName]['table']."&FORM=".$form;
			
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableAddButton($name,$script,$parameter,$column,$target=false){
		global $page;
		global $PATH;
	
		$id = count(@$this->list[$this->listName]['button']);
		$this->list[$this->listName]['button'][$column.$id]['name'] = $name;
		$this->list[$this->listName]['button'][$column.$id]['script'] = $script;
		$this->list[$this->listName]['button'][$column.$id]['column'] = $column;
		$this->list[$this->listName]['button'][$column.$id]['parameter'] = $parameter;
		$this->list[$this->listName]['button'][$column.$id]['target'] = $target;
			
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableActionOnClikResetObj($objToSend,$typeObj,$columnValue,$columnDescription,$columnDescriptionB=false,$columnDescriptionC=false){
		global $page;
		global $PATH;
		global $c;
	
		$page->session->setSession("C",$c);
		
		$this->java->setFunctionCloseObj();
		$this->java->setFunctionReset(false,"comboBox");
	
		$id = count(@$this->list[$this->listName]['actionOnClick']);
		$this->list[$this->listName]['actionOnClick'][$objToSend.$id]['type'] = "copyValueToObj";
		$this->list[$this->listName]['actionOnClick'][$objToSend.$id]['objToSend'] = $objToSend;
		$this->list[$this->listName]['actionOnClick'][$objToSend.$id]['typeObj'] = $typeObj;
		$this->list[$this->listName]['actionOnClick'][$objToSend.$id]['columnValue'] = $columnValue;
		$this->list[$this->listName]['actionOnClick'][$objToSend.$id]['columnDescription'] = $columnDescription;
		$this->list[$this->listName]['actionOnClick'][$objToSend.$id]['columnDescriptionB'] = $columnDescriptionB;
		$this->list[$this->listName]['actionOnClick'][$objToSend.$id]['columnDescriptionC'] = $columnDescriptionC;
			
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableColumnHidden($column){
		global $page;
	
		$this->list[$this->listName]['hidden'][$column] = true;
	
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableColumnAlign($column,$align){
		global $page;
	
		$this->list[$this->listName]['align'][$column] = $align;
	
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableColumnWidth($column,$width){
		global $page;
	
		$this->list[$this->listName]['widths'][$column] = $width;
	
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function listTableColumnCpfCnpj($column){
		global $page;
	
		$this->list[$this->listName]['cpfCnpj'][$column] = true;
	
		$page->session->setSession($this->listName."_OBJ_".$this->listName,$this->list[$this->listName]);
	}
	
	public function checkBox($name,$column=false,$class="checkBox",$type="checkBox",$value=false,$display=false,$disabled=false,$readOnly=false,$styles=false){
		$this->checkBox[$name]['name'] = $name;
		$this->checkBox[$name]['column'] = $column;
		$this->checkBox[$name]['class'] = $class;
		$this->checkBox[$name]['type'] = $type;
		$this->checkBox[$name]['value'] = $value;
		$this->checkBox[$name]['display'] = $display;
		if($disabled!==false){
			$disabled = " disabled=\"disabled\"";
		}
		$this->checkBox[$name]['disabled'] = $disabled;
		if($readOnly!==false){
			$readOnly = " readonly=\"readonly\"";
		}
		$this->checkBox[$name]['readOnly'] = $readOnly;
		$this->checkBox[$name]['styles'] = $styles;
		$this->checkBox[$name]['typeColumn'] = false;
		$this->checkBox[$name]['uppercase'] = $this->uppercase;
		$this->checkBox[$name]['unique'] = false;
		$this->checkBox[$name]['whreForCheckUnique'] = false;
		$this->checkBox[$name]['operatorForCheckUnique'] = false;
		$this->checkBox[$name]['valueForCheckUnique'] = false;
		$this->checkBox[$name]['require'] = true;
		$this->checkBox[$name]['minLen'] = false;
	
		$id = count($this->linesHtml);
		$this->linesHtml[$id]['html'] = "@obj#".$name."#obj@@type#checkBox#type@";
		$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
	
		$this->allObj[$name]['name'] = $name;
		$this->allObj[$name]['type'] = "checkBox";
		$this->allObj[$name]['ignorePost'] = false;
	
		if($column){
			$this->setColumn($name, $column);
		}
	}

	public function ignoreStyles($name){
		if($this->allObj[$name]['type'] == "comboBox"){
			foreach ($this->comboBox as $keyB => $valueB){
				if($keyB==$name){
					$this->comboBox[$keyB]['ignoreStyles'] = true;
				}
			}
		}
		if($this->allObj[$name]['type'] == "textBox"){
			foreach ($this->textBox as $keyB => $valueB){
				if($keyB==$name){
					$this->textBox[$keyB]['ignoreStyles'] = true;
				}
			}
		}
		if($this->allObj[$name]['type'] == "textBoxMultiLine"){
			foreach ($this->textBoxMultiLine as $keyB => $valueB){
				if($keyB==$name){
					$this->textBoxMultiLine[$keyB]['ignoreStyles'] = true;
				}
			}
		}
	}
	public function ignorePost($name){
		$this->allObj[$name]['ignorePost'] = true;
	}
	
	public function inSideHiperLink($text,$href="",$target="",$tab=0){
		if($target==""){
			$text = "<a href=\"".$href."\" target=\"".$target."\" onClick=\"openBaseCarregando();\">".$text;
		}else{
			$text = "<a href=\"".$href."\" target=\"".$target."\">".$text;
		}
		for($i=1;$i<=$tab;$i++){
			$text = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$text;
		}
		return $text."</a>";
	}
	
	public function inSideP($text,$class="",$tab=0){
		for($i=1;$i<=$tab;$i++){
			$text = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$text;
		}
		$id = count($this->linesHtml);
		$this->linesHtml[$id]['html'] = "<p class='".$class."'>".$text."</p>";
		$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
	}
	
	public function unSetUppercase($name=false){
		if($name===false){
			$this->uppercase = false;
		}else{
			if($this->allObj[$name]['type'] == "comboBox"){
				foreach ($this->comboBox as $keyB => $valueB){
					if($keyB==$name){
						$this->comboBox[$keyB]['uppercase'] = false;
					}
				}
			}
			if($this->allObj[$name]['type'] == "textBox"){
				foreach ($this->textBox as $keyB => $valueB){
					if($keyB==$name){
						$this->textBox[$keyB]['uppercase'] = false;
					}
				}
			}
			if($this->allObj[$name]['type'] == "textBoxMultiLine"){
				foreach ($this->textBoxMultiLine as $keyB => $valueB){
					if($keyB==$name){
						$this->textBoxMultiLine[$keyB]['uppercase'] = false;
					}
				}
			}
		}
	}
	
	public function video($name,$interface=false,$device=0,$class=false,$baseWidth=false,$baseHeight=false,$scroll=true,$inverter=true,$addParam=false){
		global $PATH;
		global $page;
		global $menuCore;
		global $PAGENAME;
		
		$this->video[$name]['name'] = $name;
		if($interface===false){
			$this->video[$name]['interface'] = "";
		}else{
			$this->video[$name]['interface'] = "&INTERFACE=".$this->stringToUpper($interface);
		}
		$this->video[$name]['device'] = $device;
		$this->video[$name]['class'] = $class;
		$this->video[$name]['styles'] = "";
		if($scroll===true){
			$this->video[$name]['styles'] .= "overflow:scroll;";
		}
		if($baseWidth!==false){
			$this->video[$name]['styles'] .= "width:".$baseWidth.";";
		}
		if($baseHeight!==false){
			$this->video[$name]['styles'] .= "height:".$baseHeight.";";
		}
		if($inverter===true){
			$this->video[$name]['styles'] .= "-moz-transform: scaleX(-1);-o-transform: scaleX(-1);-webkit-transform: scaleX(-1);transform: scaleX(-1);";
		}
		
		if($addParam===false){
			$this->video[$name]['addParam'] = $addParam;
		}else{
			$this->video[$name]['addParam'] = "&".$addParam;
		}
				
		$id = count($this->linesHtml);
		$this->linesHtml[$id]['html'] = "@obj#".$name."#obj@@type#video#type@";
		$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
	
		$this->allObj[$name]['name'] = $name;
		$this->allObj[$name]['type'] = "video";
		$this->allObj[$name]['ignorePost'] = false;
		
		$this->java->core("click", "basePreview", "qrCodeResult", $PATH."qrcode.php","",false,"","DIGITAR=1@".$PAGENAME,false,true,false);
	}
	
	public function autoSave($nameObj,$event,$preValue=false){
		global $PATH;
		global $PAGENAME;
		global $page;
	
		$this->autoSave = true;
	
		if($this->resetAutoSave===true){
			$page->session->unSetSession("OBJ_".$nameObj,$PAGENAME);
		}
	
		if($preValue!==false && !$page->session->getSession("OBJ_".$nameObj,$PAGENAME)){
			$page->session->setSession("OBJ_".$nameObj,$preValue,$PAGENAME);
		}
		$this->java->setReloadScript($event, $nameObj, $nameObj."XYZ", @$PATH."sistema/plugin/autoSave.php",$nameObj,"VALUE","","UNIVERSAL&OBJ_NAME=".$nameObj."@UNIVERSAL&PN=".$PAGENAME."@UNIVERSAL");
		$this->value($nameObj,$page->session->getSession("OBJ_".$nameObj,$PAGENAME));
	}
	public function checkOpenCloseTag($line=false,$cell=false,$form=false,$space=false,$force=false){
		if(($this->openSpace===true && $space===true) || $force===true){
			$this->openSpace = false;
			if($force===true){
				$this->nivelInterno--;
				$id = count($this->linesHtml) - 1;
			}else{
				$id = count($this->linesHtml);
			}
			$this->nivelInterno--;
			$this->linesHtml[$id]['html'] = "</div>";
			$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
		}
		if($this->openCell===true && $cell===true){
			$this->openCell = false;
			$id = count($this->linesHtml);
			$this->nivelInterno--;
			$this->linesHtml[$id]['html'] = "</div>";
			$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
		}
		if($this->openForm===true && $form===true){
			$this->openForm = false;
			$id = count($this->linesHtml);
			$this->nivelInterno--;
			$this->linesHtml[$id]['html'] = "</form>";
			$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
		}
		if($this->openLine===true && $line===true){
			$this->openLine = false;
			if($this->withoutCell===true){
				$id = count($this->linesHtml);
				$this->nivelInterno--;
				$this->linesHtml[$id]['html'] = "</td>";
				$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
				$this->nivelInterno--;
			}else{
				/*$id = count($this->linesHtml);
				$this->nivelInterno--;
				$this->linesHtml[$id]['html'] = "</tr>";
				$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
				$id = count($this->linesHtml);
				$this->linesHtml[$id]['html'] = "</table>";
				$this->linesHtml[$id]['nivel'] = $this->nivelInterno--;
				$id = count($this->linesHtml);
				$this->linesHtml[$id]['html'] = "</td>";
				$this->linesHtml[$id]['nivel'] = $this->nivelInterno--;*/
				$this->nivelInterno--;
			}
			$id = count($this->linesHtml);
			$this->linesHtml[$id]['html'] = "</div>";
			$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
		}
	}
	public function setColumn($objName,$column){
		$form = $this->getObj($this->formName);
		if($form){
			$objDataSet = $form->getDataSet();
		}else{
			$objDataSet = false;
		}
		if($objDataSet){
			if($objDataSet->versao=="i"){
				$lc = new iSelect($objDataSet, $this->table);
				$lc->listColumn();
				$lc->where("Field", "=", "'".$column."'");
				$lc->exe();
				$maxlen = $lc->getFieldSize();
				$typeColumn = $this->stringToUpper($lc->getFieldType());
			}else{
				$lc = $objDataSet->listColumn($this->table);
				$lc->setWhere("Field", "=", "'".$column."'");
				$lc->Exe();
				$maxlen = $lc->getFieldSize();
				$typeColumn = $this->stringToUpper($lc->getFieldType());
			}
		}
		if($this->allObj[$objName]['type'] == "comboBox"){
			foreach ($this->comboBox as $keyB => $valueB){
				if($keyB==$objName){
					$this->comboBox[$keyB]['typeColumn'] = @$typeColumn;
				}
			}
		}
		if($this->allObj[$objName]['type'] == "textBox"){
			foreach ($this->textBox as $keyB => $valueB){
				if($keyB==$objName){
					$this->textBox[$keyB]['maxlen'] = @$maxlen;
					$this->textBox[$keyB]['typeColumn'] = @$typeColumn;
				}
			}
		}
		if($this->allObj[$objName]['type'] == "textBoxMultiLine"){
			foreach ($this->textBoxMultiLine as $keyB => $valueB){
				if($keyB==$objName){
					$this->textBoxMultiLine[$keyB]['maxlen'] = @$maxlen;
					$this->textBoxMultiLine[$keyB]['typeColumn'] = @$typeColumn;
				}
			}
		}
	}
	public function form($name,$method="post",$action=false,$target="_top",$disabled=false,$readOnly=false,$styles=false){
		$this->form[$name]['name'] = $name;
		$this->form[$name]['method'] = $method;
		$this->form[$name]['action'] = $action;
		$this->form[$name]['target'] = $target;
		$this->form[$name]['disabled'] = $disabled;
		$this->form[$name]['readOnly'] = $readOnly;
		$this->form[$name]['styles'] = $styles;
		$id = count($this->linesHtml);
		$this->linesHtml[$id]['html'] = "@obj#".$name."#obj@@type#form#type@";
		$this->linesHtml[$id]['nivel'] = $this->nivelInterno++;
	
		$this->allObj[$name]['name'] = $name;
		$this->allObj[$name]['type'] = "form";
		$this->allObj[$name]['ignorePost'] = false;
		$this->openForm = true;
	}
	public function line($class="",$idLine=false,$forcedClose=false){
		$this->checkOpenCloseTag(true,true,true,true);
		
		/*if($width!==false || $this->widthGeral!==false){
			if($this->widthGeral!==false){
				$width = $this->widthGeral;
			}
			$width = " width=\"".$width."\"";
		}else{
			$width = "";
		}*/
		
		$id = count($this->linesHtml);
		$idL = $id;
		if($this->quebraPagina===false){
			$this->linesHtml[$id]['html'] = "<div".($idLine ? " id=\"".$idLine."\"" : "")." class=\"form-row ".$class."\">";
		}else{
			if($this->contQuebraPagina===false){
				$this->linesHtml[$id]['html'] = "<div style=\"page-break-after: always\"></div>\n<tr id=\"L".$this->name.$idL."\" name=\"L".$this->name.$idL."\">";
			}else{
				if($this->contQuebraPaginaTemp<=$this->contQuebraPagina){
					$this->contQuebraPaginaTemp++;
					$this->linesHtml[$id]['html'] = "<tr id=\"L".$this->name.$idL."\" name=\"L".$this->name.$idL."\">";
				}else{
					$this->contQuebraPaginaTemp = 1;
					/*if($this->firstQuebraPagina===true){
						$this->firstQuebraPagina = false;
						$this->linesHtml[$id]['html'] = "<tr id=\"L".$this->name.$idL."\" name=\"L".$this->name.$idL."\">";
					}else{*/
						$this->linesHtml[$id]['html'] = "<div style=\"page-break-after: always\"></div>\n<tr id=\"L".$this->name.$idL."\" name=\"L".$this->name.$idL."\">";
					#}
				}
			}
		}
		if($forcedClose===true){
			$this->linesHtml[$id]['html'] .= "</div></div>";
		}
		$this->linesHtml[$id]['nivel'] = $this->nivelInterno++;
		/*$id = count($this->linesHtml);
		$this->linesHtml[$id]['html'] = "<td id=\"CL".$this->name.$idL."\" name=\"CL".$this->name.$idL."\" class=\"".$class."\"".$width.">";
		$this->linesHtml[$id]['nivel'] = $this->nivelInterno++;
		if($this->withoutCell===false){
			$id = count($this->linesHtml);
			if($this->cellpadding!==false){
				$cellpadding = " cellpadding=\"".$this->cellpadding."\"";
			}else{
				$cellpadding = "";
			}
			if($this->cellspacing!==false){
				$cellspacing = " cellspacing=\"".$this->cellspacing."\"";
			}else{
				$cellspacing = "";
			}
			$this->linesHtml[$id]['html'] = "<table id=\"TL".$this->name.$idL."\" name=\"TL".$this->name.$idL."\"".$cellpadding.$cellspacing.$width.">";
			$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
			$id = count($this->linesHtml);
			$this->linesHtml[$id]['html'] = "<tr id=\"LL".$this->name.$idL."\" name=\"LL".$this->name.$idL."\">";
			$this->linesHtml[$id]['nivel'] = $this->nivelInterno++;
		}*/
		$this->openLine = true;
	}
	public function card($title,$cols="12,12,12,12,12",$style=false,$name=false,$togger=false,$forcedDisplayNone=false,$forcedDisplayNoneOnlyFirstTime=false,$forcedCloseDiv=false,$styleBody=false,$styleOnlyOnCard=false){
		$this->checkOpenCloseTag(false,true,false,true);

		global $page;
		global $PAGANAME;

		$nameHeader = false;
		$nameBody = false;
		$nameOrigin = $name;

		$this->nameOrigin[] = $name;

		if($name!==false){
			if($togger!==false){
				$togger = " <button id=\"".$name."_button\" class=\"btn btn-info\" type=\"button\" style=\"position:absolute;right:2%;top:6px;margin-top:0px;\">Ocultar / Mostrar</button>";
				$this->java->setObjVisibleTogger("click",$name."_button",$name."_body","flex",true,$forcedDisplayNoneOnlyFirstTime);
			}

			$nameHeader = " id=\"".$name."_header\"";
			$nameBody = " id=\"".$name."_body\"";
			$name = " id=\"".$name."\"";
		}

		if($forcedDisplayNoneOnlyFirstTime===true){
			if(!$page->s->g("forcedDisplayNoneOnlyFirstTimeCard".$name)){
				$page->s->s("forcedDisplayNoneOnlyFirstTimeCard".$name,"1");

				$forcedDisplayNone = true;
			}else{
				$forcedDisplayNone = false;
			}
		}
				
		if($this->withoutCell===false){
			$id = count($this->linesHtml);
			if($forcedCloseDiv===false){
				$this->linesHtml[$id]['html'] = "<div class=\"".$this->setCol($cols)."\">
				<div".$name." class=\"card\" style=\"".($styleOnlyOnCard===false ? $style : "")."\">
					<div".$nameHeader." class=\"card-header\" style=\"".$style."\">
						<b>".$title."</b>".$togger."
					</div>
					<div".$nameBody." style=\"".$styleBody."\" class=\"card-body form-row\"".($forcedDisplayNone===true ? " style=\"display:none;\"" : "").">";
			}else{
				$this->lastId = $id;
				$this->linesHtml[$id]['html'] = "<div class=\"".$this->setCol($cols)."\">
			<div".$name." class=\"card\" style=\"".($styleOnlyOnCard===false ? $style : "")."\">
				<div".$nameHeader." class=\"card-header\" style=\"".$style."\">
					<b>".$title."</b>".$togger."
				</div>
				<div".$nameBody." style=\"".$styleBody."\" class=\"card-body form-row\"".($forcedDisplayNone===true ? " style=\"display:none;position:relative;width:100%;overflow:auto;\"" : " style=\"position:relative;width:100%;overflow:auto;\"").">
					@insertHTML".$nameOrigin."#
				</div>
			</div>";
			}
			$this->linesHtml[$id]['nivel'] = $this->nivelInterno++;
			$this->openCell = true;
		}
	}
	public function cardSemToggler($title, $cols="12,12,12,12,12", $style=false, $name=false) {
		$this->checkOpenCloseTag(false, true, false, true);
	
		global $page;
		global $PAGANAME;
	
		$nameHeader = false;
		$nameBody = false;
	
		if ($name !== false) {
			$nameHeader = " id=\"" . $name . "_header\"";
			$nameBody = " id=\"" . $name . "_body\"";
			$name = " id=\"" . $name . "\"";
		}
		
		if ($this->withoutCell === false) {
			$id = count($this->linesHtml);
			$this->linesHtml[$id]['html'] = "
			<div class=\"" . $this->setCol($cols) . "\">
			<div" . $name . " class=\"card\" style=\"" . $style . "\">
			<div" . $nameHeader . " class=\"card-header\">
			<b>" . $title . "</b>
			</div>
			<div" . $nameBody . " class=\"card-body form-row\">";
			$this->linesHtml[$id]['nivel'] = $this->nivelInterno++;
			$this->openCell = true;
		}
	}
	
	public function inSide($text="",$newLine=1){
		$id = count($this->linesHtml);
		$this->linesHtml[$id]['html'] = $text;
		$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
		$this->linesHtml[$id]['newLine'] = $newLine;
	}
	public function inSideBold($text="",$totalLine=false){
		$id = count($this->linesHtml);
		if($totalLine===false){
			$this->linesHtml[$id]['html'] = "<b>".$text."</b>";
		}else{
			$this->linesHtml[$id]['html'] = "<div class=\"".$this->setCol("12,12,12,12,12")."\"><b>".$text."</b></div>";
		}
		$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
	}
	public function inSideH($text,$number=1,$tab=0,$newLine=1){
		for($i=1;$i<=$tab;$i++){
			$text = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$text;
		}
		
		$id = count($this->linesHtml);
		$this->linesHtml[$id]['html'] = "<h3>".$text."</h3>";
		$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
		$this->linesHtml[$id]['newLine'] = $newLine;
	}
	public function inSideSpan($text="",$class=false){
		$id = count($this->linesHtml);
		$this->linesHtml[$id]['html'] = "<span class=\"".$class."\">".$text."</span>";
		$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
	}	
	public function comboBox($name,$label=false,$cols="12,12,12,12,12",$class="",$value=false,$readOnly=false,$required=false,$multiple=false,$disabled=false,$styles=false,$java=false){
		if($readOnly===false){
			if($this->readOnly===true){
				$disabled = true;
			}
		}
		$this->comboBox[$name]['name'] = $name;
		$this->comboBox[$name]['column'] = false;
		$this->comboBox[$name]['label'] = $label;
		$this->comboBox[$name]['cols'] = $this->setCol($cols);
		if($required===false){
			$this->comboBox[$name]['required'] = "";
		}else{
			$this->comboBox[$name]['required'] = " required";
		}
		$this->comboBox[$name]['class'] = "form-control ".$class;		
		$this->comboBox[$name]['selectedIndex'] = false;
		if($multiple===true){
			$this->comboBox[$name]['multiple'] = ' multiple';
		}else{
			$this->comboBox[$name]['multiple'] = $multiple;
		}
		if($disabled!==false){
			$disabled = " disabled";
		}
		$this->comboBox[$name]['disabled'] = $disabled;
		if($readOnly!==false){
			$readOnly = " readonly=\"readonly\"";
		}
		$this->comboBox[$name]['readOnly'] = $readOnly;
		$this->comboBox[$name]['styles'] = $styles;
		$this->comboBox[$name]['typeColumn'] = false;
		$this->comboBox[$name]['uppercase'] = $this->uppercase;
		$this->comboBox[$name]['unique'] = false;
		$this->comboBox[$name]['whreForCheckUnique'] = false;
		$this->comboBox[$name]['operatorForCheckUnique'] = false;
		$this->comboBox[$name]['valueForCheckUnique'] = false;
		$this->comboBox[$name]['require'] = true;
		$this->comboBox[$name]['minLen'] = false;
		$this->comboBox[$name]['java'] = $java;
		
		$id = count($this->linesHtml);
		$this->linesHtml[$id]['html'] = "@obj#".$name."#obj@@type#comboBox#type@";
		$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
		
		$this->allObj[$name]['name'] = $name;
		$this->allObj[$name]['type'] = "comboBox";
		$this->allObj[$name]['ignorePost'] = false;
		
		if($value){
			$this->value($name, $value);
		}
		
		/*if($column){
			$this->setColumn($name, $column);
		}*/
	}
	public function optionComboBox($nameComboBox,$value,$desc=""){
		$idOption = count($this->optionComboBox);
		$this->optionComboBox[$idOption]['nameComboBox'] = $nameComboBox;
		$this->optionComboBox[$idOption]['value'] = $value;
		$this->optionComboBox[$idOption]['desc'] = $desc;
	}	
	public function setFillComboBox($nameComboBox,$columnId,$columnDesc,$dataSet,$table,$where,$operator,$value,$order=false,$orderType="ASC",$limit=false,$and=false,$or=false,$joinExpression=false,$filial=true){
		global $PAGENAME;
		global $page;
		
		$return = false;
		
		if($dataSet->versao=="i"){
			$columnDesc = explode("@", $columnDesc);
			if($order!==false){
				$order = explode("@", $order);
			}
			
			$sel = new iSelect($dataSet,$table,$filial);
			if($and!==false){
				$sel->setAnd("", $and);
			}
			if($or!==false){
				$sel->setOr("", "", $or);
			}
			$sel->where($where,$operator,$value);
			if($order!==false){
				foreach ($order as $keyC => $valueC){
					if(strpos($valueC,"NO_ORDER")===false){
						if(strpos($valueC,"#")===false){
							$sel->order($valueC,$orderType);
						}else{
							$sel->order(substr($valueC, 0, strpos($valueC,"#")),$orderType,substr($valueC, strpos($valueC,"#")+1,strlen($valueC)-strpos($valueC,"#")+1));
						}
						break;
					}
				}
			}
			if($limit!==false){
				$sel->limit($limit);
			}
			
			# JOIN EXPRESSION
			if($joinExpression!==false){
				$joinExpression = explode("@", $joinExpression);
				$sel->join($joinExpression[0], $joinExpression[1], "=", $joinExpression[2]);
				$sel->columnsJoin($joinExpression[3], $joinExpression[0]);
			}
			# FIM - JOIN EXPRESSION
			
			$res = $sel->exe();
			if($res===false){
				global $page;
				$page->e("erro ".$dataSet->getError(1));
				return false;
			}else{
				$firstRow = false;
				while($row = $sel->read()){
					$columnDescB = "";
					foreach ($columnDesc as $keyB => $valueB){
						$valueB = str_replace("NO_ORDER", "", $valueB);
						if(strpos($valueB,"#")!==false){
							$valueB = substr($valueB, 0, strpos($valueB,"#"));
						}
						if(strlen($columnDescB)>0){
							$columnDescB .= " - ";
						}
						if(strpos($valueB,"cpf")===false){
							$columnDescB .= $row[$valueB];
						}else{
							$columnDescB .= $this->formatCpfCnpj($row[$valueB]);
						}
					}
					$this->optionComboBox($nameComboBox, $row[$columnId],$columnDescB);
					$return[$row[$columnId]] = $columnDescB;
					if($firstRow===false){
						$firstRow = true;
					}
				}
			}
		}else{
			$sel = $dataSet->select($table);
			if($and!==false){
				$sel->setAnd("", $and);
			}
			if($or!==false){
				$sel->setOr("", "", $or);
			}
			$sel->setWhere($where,$operator,$value);
			if($order!==false){
				$sel->setOrder($order,$orderType);
			}
			if($limit!==false){
				$sel->setLimit($limit);
			}
			$res = $sel->Exe();
			if($res===false){
				return false;
			}else{
				$firstRow = false;
				while($row = $sel->read()){
					$this->optionComboBox($nameComboBox, $row[$columnId],$row[$columnDesc]);
					if($firstRow===false){
						$firstRow = true;
					}
				}
			}
		}
		
		return $return;
	}
	public function space($name,$align="left",$cols="12,12,12,12,12",$class=false,$styles="",$value=false,$closePreviews=false){
		$this->space[$name]['name'] = $name;
		$this->space[$name]['align'] = $align;
		$this->space[$name]['class'] = $class;
		$this->space[$name]['styles'] = $styles;
		$this->space[$name]['value'] = $value;
		$this->space[$name]['cols'] = $this->setCol($cols);
		$this->space[$name]['closePreviews'] = $closePreviews;

		$id = count($this->linesHtml);
		$this->linesHtml[$id]['html'] = "@obj#".$name."#obj@@type#space#type@";
		if($closePreviews===false){
			$this->linesHtml[$id]['nivel'] = $this->nivelInterno++;
		}else{
			$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
		}
	
		$this->allObj[$name]['name'] = $name;
		$this->allObj[$name]['type'] = "space";
		$this->allObj[$name]['ignorePost'] = false;
		$this->openSpace = true;
	}
	public function file($name,$label=false,$cols="12,12,12,12,12",$class="",$value=false,$readOnly=false,$required=false,$multiple=false,$disabled=false,$styles=false){
	#public function file($name,$column=false,$class="textBox",$type="file",$value=false,$disabled=false,$readOnly=false,$styles=false){
		$this->file[$name]['name'] = $name;
		$this->file[$name]['column'] = false;
		$this->file[$name]['class'] = $class;
		$this->file[$name]['type'] = "file";
		$this->file[$name]['value'] = $value;
		$this->file[$name]['maxlen'] = false;
		$this->file[$name]['label'] = $label;
		$this->file[$name]['cols'] = $this->setCol($cols);
		if($required===false){
			$this->file[$name]['required'] = "";
		}else{
			$this->file[$name]['required'] = " required";
		}
		if($disabled!==false){
			$disabled = " disabled=\"disabled\"";
		}
		$this->file[$name]['disabled'] = $disabled;
		if($readOnly!==false){
			$readOnly = " readonly=\"readonly\"";
		}
		$this->file[$name]['readOnly'] = $readOnly;
		$this->file[$name]['styles'] = $styles;
		$this->file[$name]['typeColumn'] = false;
		$this->file[$name]['uppercase'] = $this->uppercase;
		$this->file[$name]['unique'] = false;
		$this->file[$name]['whreForCheckUnique'] = false;
		$this->file[$name]['operatorForCheckUnique'] = false;
		$this->file[$name]['valueForCheckUnique'] = false;
		$this->file[$name]['require'] = true;
		$this->file[$name]['minLen'] = false;
	
		$id = count($this->linesHtml);
		$this->linesHtml[$id]['html'] = "@obj#".$name."#obj@@type#file#type@";
		$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
	
		$this->allObj[$name]['name'] = $name;
		$this->allObj[$name]['type'] = "file";
		$this->allObj[$name]['ignorePost'] = false;
	
		/*if($column){
			$this->setColumn($name, $column);
		}*/
	}
	public function img($name,$src,$cols="12,12,12,12,12",$class="",$value=false,$styles=false,$onClick=false,$classDivBase=false,$repeatOnClickToBase=false,$base64=false,$mimeType=""){
		$this->img[$name]['name'] = $name;
		$this->img[$name]['src'] = $src;
		$this->img[$name]['cols'] = $this->setCol($cols);
		$this->img[$name]['class'] = $class;
		$this->img[$name]['value'] = $value;
		$this->img[$name]['styles'] = $styles;
		$this->img[$name]['onClick'] = $onClick;
		$this->img[$name]['classDivBase'] = $classDivBase;
		$this->img[$name]['repeatOnClickToBase'] = $repeatOnClickToBase;
		$this->img[$name]['base64'] = $base64;
		$this->img[$name]['mimeType'] = $mimeType;

		$id = count($this->linesHtml);
		$this->linesHtml[$id]['html'] = "@obj#".$name."#obj@@type#img#type@";
		$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
		
		$this->allObj[$name]['name'] = $name;
		$this->allObj[$name]['type'] = "img";
		$this->allObj[$name]['ignorePost'] = false;
	}
	public function textBox($name,$label=false,$cols="12,12,12,12,12",$class="",$value=false,$readOnly=false,$maxlen=false,$required=false,$type="text",$disabled=false,$styles=false,$step=false,$digit=false,$buttonSize=false){
		if($readOnly===false){
			if($this->readOnly===true){
				$readOnly = true;
			}
		}
		$this->textBox[$name]['name'] = $name;
		$this->textBox[$name]['column'] = false;
		$this->textBox[$name]['label'] = $label;
		$this->textBox[$name]['cols'] = $this->setCol($cols);
		if($required===false){
			$this->textBox[$name]['required'] = "";
		}else{
			$this->textBox[$name]['required'] = " required";
		}
		$this->textBox[$name]['class'] = "form-control ".$class; // form-control-lg	
		$this->textBox[$name]['type'] = $type;
		$this->textBox[$name]['value'] = $value;
		$this->textBox[$name]['placeHolder'] = false;
		$this->textBox[$name]['focus'] = false;
		$this->textBox[$name]['maxlen'] = $maxlen;
		if($disabled!==false){ 
			$disabled = " disabled=\"disabled\""; 
		}
		$this->textBox[$name]['disabled'] = $disabled;
		if($readOnly!==false){
			$readOnly = " readonly=\"readonly\"";
		}
		$this->textBox[$name]['readOnly'] = $readOnly;
		$this->textBox[$name]['styles'] = $styles;
		$this->textBox[$name]['stylesMaster'] = "";
		$this->textBox[$name]['typeColumn'] = false;
		$this->textBox[$name]['uppercase'] = $this->uppercase;
		$this->textBox[$name]['unique'] = false;
		$this->textBox[$name]['whreForCheckUnique'] = false;
		$this->textBox[$name]['operatorForCheckUnique'] = false;
		$this->textBox[$name]['valueForCheckUnique'] = false;
		$this->textBox[$name]['require'] = true;
		$this->textBox[$name]['minLen'] = false;
		$this->textBox[$name]['ignoreStyles'] = false;
		if($type=="number" && $step===false){
			$step = "0.01";
		}
		$this->textBox[$name]['step'] = $step;
		$this->textBox[$name]['digit'] = $digit;
		$this->textBox[$name]['buttonSize'] = $buttonSize;
		$this->textBox[$name]['paramA'] = false;
		$this->textBox[$name]['paramB'] = false;
		
		$id = count($this->linesHtml);
		$this->linesHtml[$id]['html'] = "@obj#".$name."#obj@@type#textBox#type@";
		$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
		
		$this->allObj[$name]['name'] = $name;
		$this->allObj[$name]['type'] = "textBox";
		$this->allObj[$name]['ignorePost'] = false;
	}
	public function type($name,$type,$paramA=false,$paramB=false){
		if($this->allObj[$name]['type']=="textBox"){
			$this->textBox[$name]['type'] = $type;
			$this->textBox[$name]['paramA'] = $paramA;
			$this->textBox[$name]['paramB'] = $paramB;
		}else if($this->allObj[$name]['type']=="date"){
			$this->date[$name]['type'] = $type;
		}
	}
	public function leitor($name,$script){
		$this->type($name,"password");
			
		$this->addStyles($name,height."50px");
		$this->addStyles($name, textAlign.center);
		$this->addStyles($name, color.COLOR_BLUE);
		$this->ignoreStyles($name);
		$this->readOnly($name);

		$this->inSide("
			<iframe id=\"objCore".$name."0\" name=\"objCore".$name."0\" src=\"".$script."\" class=\"\" scrolling=\"yes\" frameborder=\"5\"></iframe>
			<script language=\"javascript\">
				var contAguarde = 0;
				var lendo = 0;	
						
				setInterval(function(){
					if(lendo==1 && contAguarde<4){
						contAguarde++;
					}else if(lendo==1){
						lendo = 2;
						contAguarde++;
						document.getElementById('qrCodeResult').style.border = '10px solid ".COLOR_YELLOW."';
						document.getElementById('qrCodeResult').style.backgroundColor = '".COLOR_YELLOW."';
						document.getElementById('qrCodeResult').innerHTML = '<span style=\"color:".COLOR_BLACK."\">Desculpe-nos a Demora!<br>Aguarde Carregando...</span>';
					}else if(lendo==2 && contAguarde<10){
						contAguarde++;	
					}else if(lendo==2){
						lendo = 0;
						document.getElementById('qrCodeResult').style.border = '10px solid ".COLOR_BLUE."';
						document.getElementById('qrCodeResult').style.backgroundColor = '".COLOR_BLUE."';
						document.getElementById('qrCodeResult').innerHTML = '<span style=\"color:".COLOR_WHITE."\">Por Favor, Leia o QR Code Novamente!</span>';
						/*core".$name."0.readOnly = false;*/
						core".$name."0.style.backgroundColor = '".COLOR_WHITE."';
						core".$name."0.value = '';
					}else{
						lendo = 0;
						contAguarde = 0;
					}
				},1000);
				
				var core".$name."0 = document.getElementById(\"".$name."\");
				var objCore".$name."0 = document.getElementById(\"objCore".$name."0\");
				var coreObjGetParameter".$name."0 = document.getElementById(\"".$name."\");
				core".$name."0.addEventListener(\"change\",function() { coreEvent".$name."0('qrCodeResult','".$script."','objCore".$name."0','');}, true);
				function coreEvent".$name."0(Objeto,Script,Parent,AddParameter){
					openBaseCarregando();
					core".$name."0.readOnly = true;
					core".$name."0.style.backgroundColor = '".COLOR_BLUE."';
					var trataValor = coreObjGetParameter".$name."0.value;
					coreObjGetParameter".$name."0.value = trataValor;
					trataValor = trataValor.replace(\"@\",\"$\");
					Script = Script + '?crc=' + trataValor + '@&INTERFACE=OP&TYPE=MAQ' + AddParameter;
					objCore".$name."0.src = Script;
				
					lendo = 1;
					document.getElementById('qrCodeResult').style.border = '10px solid ".COLOR_BLUE."';
					document.getElementById('qrCodeResult').style.backgroundColor = '".COLOR_BLUE."';
					document.getElementById('qrCodeResult').innerHTML = '<span style=\"color:".COLOR_WHITE."\">Aguarde Carregando...</span>';
				}
				
				function inicializa(){
					document.addEventListener('keydown', pegaTecla);
				}
				inicializa();
				
				function pegaTecla(){
					core".$name."0.focus();
					if(event.keyCode!=16 && event.keyCode!=17 && event.keyCode!=18 && event.keyCode!=123){
						if(event.keyCode==13){
							core".$name."0.blur();
							coreEvent".$name."0('qrCodeResult','".$script."','objCore".$name."0','');
						}else{
							if(event.keyCode==189){
								core".$name."0.value += '_';
							}else if(event.keyCode==190){
								core".$name."0.value += '.';
							}else if(event.keyCode>=96 && event.keyCode<=105){
								core".$name."0.value += (event.keyCode-96);
							}else{
								core".$name."0.value += String.fromCharCode(event.keyCode);
							}
						}
						/*var tecla = event.keyCode;
						alert(tecla);*/
					}
				}
			</script>

			<style>
				#objCore".$name."0{
					position:absolute;
					left:0%;
					top:100px;
					width:35%;
					height:500px;
					background-color:rgb(255,255,255);
					display:none;
					border:5px;
					border-style:solid;
					z-index:1100;
				}
				#qrCodeResult{
					text-align:center;
					margin-top:10px;
					font-size:20px;
					border-radius:5px;
				}
			</style>	
			
			<div class=\" col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\" style=\"text-align:left;\">
				<div id=\"qrCodeResult\" name=\"qrCodeResult\"></div>
			</div>
		");		
	}

	public function upload($name,$accept,$cols="12,12,12,12,12",$class="",$value=false,$addGet=false,$multiple=false){
		$this->upload[$name]['name'] = $name;
		$this->upload[$name]['accept'] = $accept;
		$this->upload[$name]['column'] = false;
		$this->upload[$name]['cols'] = $this->setCol($cols);
		$this->upload[$name]['class'] = $class;
		$this->upload[$name]['value'] = $value;
		$this->upload[$name]['addGet'] = $addGet;
		$this->upload[$name]['multiple'] = $multiple;

		$id = count($this->linesHtml);
		$this->linesHtml[$id]['html'] = "@obj#".$name."#obj@@type#upload#type@";
		$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
		
		$this->allObj[$name]['name'] = $name;
		$this->allObj[$name]['type'] = "upload";
		$this->allObj[$name]['ignorePost'] = false;
	}
	public function textBoxMultiLine($name,$label=false,$cols="12,12,12,12,12",$class="",$value=false,$readOnly=false,$maxlen=false,$required=false,$type="text",$disabled=false,$styles=false){
		if($readOnly===false){
			if($this->readOnly===true){
				$readOnly = true;
			}
		}
		$this->textBoxMultiLine[$name]['name'] = $name;
		$this->textBoxMultiLine[$name]['column'] = false;
		$this->textBoxMultiLine[$name]['label'] = $label;
		$this->textBoxMultiLine[$name]['cols'] = $this->setCol($cols);
		if($required===false){
			$this->textBoxMultiLine[$name]['required'] = "";
		}else{
			$this->textBoxMultiLine[$name]['required'] = " required";
		}
		$this->textBoxMultiLine[$name]['class'] = "form-control ".$class;//form-control-lg
		$this->textBoxMultiLine[$name]['type'] = "textBoxMultiLine";
		$this->textBoxMultiLine[$name]['focus'] = false;
		$this->textBoxMultiLine[$name]['value'] = $value;
		$this->textBoxMultiLine[$name]['maxlen'] = $maxlen;
		if($disabled!==false){
			$disabled = " disabled=\"disabled\"";
		}
		$this->textBoxMultiLine[$name]['disabled'] = $disabled;
		if($readOnly!==false){
			$readOnly = " readonly=\"readonly\"";
		}
		$this->textBoxMultiLine[$name]['readOnly'] = $readOnly;
		$this->textBoxMultiLine[$name]['styles'] = $styles;
		$this->textBoxMultiLine[$name]['typeColumn'] = false;
		$this->textBoxMultiLine[$name]['uppercase'] = $this->uppercase;
		$this->textBoxMultiLine[$name]['unique'] = false;
		$this->textBoxMultiLine[$name]['whreForCheckUnique'] = false;
		$this->textBoxMultiLine[$name]['operatorForCheckUnique'] = false;
		$this->textBoxMultiLine[$name]['valueForCheckUnique'] = false;
		$this->textBoxMultiLine[$name]['require'] = true;
		$this->textBoxMultiLine[$name]['minLen'] = false;
		$this->textBoxMultiLine[$name]['ignoreQuebraLinha'] = false;
		$this->textBoxMultiLine[$name]['ignoreStyles'] = false;
		
		$id = count($this->linesHtml);
		$this->linesHtml[$id]['html'] = "@obj#".$name."#obj@@type#textBoxMultiLine#type@";
		$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
	
		$this->allObj[$name]['name'] = $name;
		$this->allObj[$name]['type'] = "textBoxMultiLine";
		$this->allObj[$name]['ignorePost'] = false;
		
		/*if($column){
			$this->setColumn($name, $column);
		}*/
	}
	public function textBoxMultiLineAutoAjuste($name,$row=false){
		$countA = ceil($this->division(strlen($this->getData($name,$row)),100));
		$countB = 0;
		$countC = 0;
		str_replace("\n","",$this->getData($name),$countB);
		str_replace("<br>","",$this->getData($name),$countC);

		$totalCount = $countA + $countB + $countC;

		$this->addStyles($name,height.($totalCount<=3 ? "100px" : ($totalCount * 25)."px"));
	}
	public function date($name,$label=false,$cols="12,12,12,12,12",$class="",$value=false,$readOnly=false,$required=false,$disabled=false){
		if($readOnly===false){
			if($this->readOnly===true){
				$readOnly = true;
			}
		}
		$this->date[$name]['name'] = $name;
		$this->date[$name]['column'] = false;
		$this->date[$name]['label'] = $label;
		$this->date[$name]['cols'] = $this->setCol($cols);
		if($required===false){
			$this->date[$name]['required'] = "";
		}else{
			$this->date[$name]['required'] = " required";
		}
		$this->date[$name]['class'] = "form-control text-center ".$class;//form-control-lg
		$this->date[$name]['value'] = $value;
		if($disabled!==false){ 
			$disabled = " disabled=\"disabled\""; 
		}
		$this->date[$name]['disabled'] = $disabled;
		if($readOnly!==false){
			$readOnly = " readonly=\"readonly\"";
		}
		$this->date[$name]['readOnly'] = $readOnly;
		$this->date[$name]['type'] = "date";
		$this->date[$name]['styles'] = "";
		$this->date[$name]['ignoreStyles'] = false;
		
		$id = count($this->linesHtml);
		$this->linesHtml[$id]['html'] = "@obj#".$name."#obj@@type#date#type@";
		$this->linesHtml[$id]['nivel'] = $this->nivelInterno;
		
		$this->allObj[$name]['name'] = $name;
		$this->allObj[$name]['type'] = "date";
		$this->allObj[$name]['ignorePost'] = false;
	}
	public function button($name,$value,$class=false,$cols="12,12,12,12,12",$label=false,$disabled=false,$styles=false,$createLine=false,$java=false){
		$this->button[$name]['name'] = $name;
		$this->button[$name]['value'] = $value;
		$this->button[$name]['cols'] = $this->setCol($cols);
		$this->button[$name]['class'] = "btn w-100 ".$class;
		$this->button[$name]['label'] = $label;
		$this->button[$name]['disabled'] = $disabled;
		$this->button[$name]['styles'] = $styles;
		$this->button[$name]['createLine'] = $createLine;
		$this->button[$name]['java'] = $java;
		$id = count($this->linesHtml);
		$this->linesHtml[$id]['html'] = "@obj#".$name."#obj@@type#button#type@";
		$this->linesHtml[$id]['nivel'] = $this->nivelInterno;

		$this->allObj[$name]['name'] = $name;
		$this->allObj[$name]['type'] = "button";
		$this->allObj[$name]['ignorePost'] = false;
	}
	public function asNotRequired($name){
		if($this->allObj[$name]['type'] == "comboBox"){
			foreach ($this->comboBox as $keyB => $valueB){
				if($keyB==$name){
					$this->comboBox[$keyB]['require'] = false;
				}
			}
		}
		if($this->allObj[$name]['type'] == "textBox"){
			foreach ($this->textBox as $keyB => $valueB){
				if($keyB==$name){
					$this->textBox[$keyB]['require'] = false;
				}
			}
		}
		if($this->allObj[$name]['type'] == "textBoxMultiLine"){
			foreach ($this->textBoxMultiLine as $keyB => $valueB){
				if($keyB==$name){
					$this->textBoxMultiLine[$keyB]['require'] = false;
				}
			}
		}
	}
	public function asUnique($name,$where=false,$operator="=",$value=" 1"){
		if($this->allObj[$name]['type'] == "comboBox"){
			foreach ($this->comboBox as $keyB => $valueB){
				if($keyB==$name){
					$this->comboBox[$keyB]['unique'] = true;
					$this->comboBox[$keyB]['whereForCheckUnique'] = $where;
					$this->comboBox[$keyB]['operatorForCheckUnique'] = $operator;
					$this->comboBox[$keyB]['valueForCheckUnique'] = $value;
				}
			}
		}
		if($this->allObj[$name]['type'] == "textBox"){
			foreach ($this->textBox as $keyB => $valueB){
				if($keyB==$name){
					$this->textBox[$keyB]['unique'] = true;
					$this->textBox[$keyB]['whereForCheckUnique'] = $where;
					$this->textBox[$keyB]['operatorForCheckUnique'] = $operator;
					$this->textBox[$keyB]['valueForCheckUnique'] = $value;
				}
			}
		}
		if($this->allObj[$name]['type'] == "textBoxMultiLine"){
			foreach ($this->textBoxMultiLine as $keyB => $valueB){
				if($keyB==$name){
					$this->textBoxMultiLine[$keyB]['value'] = true;
					$this->textBoxMultiLine[$keyB]['whereForCheckUnique'] = $where;
					$this->textBoxMultiLine[$keyB]['operatorForCheckUnique'] = $operator;
					$this->textBoxMultiLine[$keyB]['valueForCheckUnique'] = $value;
				}
			}
		}
	}
	public function asMoney($name){
		$this->asMoney[$name]['name'] = $name;
	}
	public function asNumber($name,$digit=2){
		$this->asNumber[$name]['name'] = $name;
		$this->asNumber[$name]['digit'] = $digit;
	}
	public function maxlen($name,$maxlen){
	    if($this->allObj[$name]['type'] == "textBox"){
	        foreach ($this->textBox as $keyB => $valueB){
	            if($keyB==$name){
	                $this->textBox[$keyB]['maxlen'] = $maxlen;
	            }
	        }
	    }
	    if($this->allObj[$name]['type'] == "textBoxMultiLine"){
	        foreach ($this->textBoxMultiLine as $keyB => $valueB){
	            if($keyB==$name){
	                /*$value = str_replace("<br>", "\n", $value);
	                $value = str_replace("<BR>", "\n", $value);*/
	                $this->textBoxMultiLine[$keyB]['maxlen'] = $maxlen;
	            }
	        }
	    }
	}
	public function placeHolder($name,$placeHolder){
		if($this->allObj[$name]['type'] == "textBox"){
			foreach ($this->textBox as $keyB => $valueB){
				if($keyB==$name){
					$this->textBox[$keyB]['placeHolder'] = $placeHolder;
				}
			}
		}
	}
	public function focus($name){
		if($this->allObj[$name]['type'] == "textBox"){
			foreach ($this->textBox as $keyB => $valueB){
				if($keyB==$name){
					$this->textBox[$keyB]['focus'] = true;
				}
			}
		}
		if($this->allObj[$name]['type'] == "textBoxMultiLine"){
			foreach ($this->textBoxMultiLine as $keyB => $valueB){
				if($keyB==$name){
					$this->textBoxMultiLine[$keyB]['focus'] = true;
				}
			}
		}
	}
	public function cols($name,$cols){
		if($this->allObj[$name]['type'] == "textBox"){
			foreach ($this->textBox as $keyB => $valueB){
				if($keyB==$name){
					$this->textBox[$keyB]['cols'] = $this->setCol($cols);
				}
			}
		}
		if($this->allObj[$name]['type'] == "textBoxMultiLine"){
			foreach ($this->textBoxMultiLine as $keyB => $valueB){
				if($keyB==$name){
					$this->textBoxMultiLine[$keyB]['cols'] = $this->setCol($cols);
				}
			}
		}
		if($this->allObj[$name]['type'] == "comboBox"){
			foreach ($this->comboBox as $keyB => $valueB){
				if($keyB==$name){
					$this->comboBox[$keyB]['cols'] = $this->setCol($cols);
				}
			}
		}
	}
	public function readOnly($name){
		if($this->allObj[$name]['type'] == "textBox"){
			$this->textBox[$name]['readOnly'] = " readonly=\"readonly\"";
		} 
		if($this->allObj[$name]['type'] == "date"){
			$this->date[$name]['readOnly'] = " readonly=\"readonly\"";
		}
		if($this->allObj[$name]['type'] == "textBoxMultiLine"){
			$this->textBoxMultiLine[$name]['readOnly'] = " readonly=\"readonly\"";
		}
		if($this->allObj[$name]['type'] == "comboBox"){
			$this->comboBox[$name]['readOnly'] = " disabled";
		}
	}
	public function addStyles($nameObj,$styles){
		if($this->allObj[$nameObj]['type'] == "button"){
			foreach ($this->button as $keyB => $valueB){
				if($keyB==$nameObj){
					$this->button[$keyB]['styles'] .= $styles;
					$this->button[$keyB]['styles'] = str_replace(";;", ";", $this->button[$keyB]['styles']);
				}
			}
		}
		if($this->allObj[$nameObj]['type'] == "comboBox"){
			foreach ($this->comboBox as $keyB => $valueB){
				if($keyB==$nameObj){
					$this->comboBox[$keyB]['styles'] .= $styles;
					$this->comboBox[$keyB]['styles'] = str_replace(";;", ";", $this->comboBox[$keyB]['styles']);
				}
			}
		}
		if($this->allObj[$nameObj]['type'] == "date"){
			foreach ($this->date as $keyB => $valueB){
				if($keyB==$nameObj){
					$this->date[$keyB]['styles'] .= $styles;
					$this->date[$keyB]['styles'] = str_replace(";;", ";", $this->date[$keyB]['styles']);
				}
			}
		}
		if($this->allObj[$nameObj]['type'] == "textBox"){
			foreach ($this->textBox as $keyB => $valueB){
				if($keyB==$nameObj){
					$this->textBox[$keyB]['styles'] .= $styles;
					$this->textBox[$keyB]['styles'] = str_replace(";;", ";", $this->textBox[$keyB]['styles']);
				}
			}
		}
		if($this->allObj[$nameObj]['type'] == "textBoxMultiLine"){
			foreach ($this->textBoxMultiLine as $keyB => $valueB){
				if($keyB==$nameObj){
					$this->textBoxMultiLine[$keyB]['styles'] .= $styles;
					$this->textBoxMultiLine[$keyB]['styles'] = str_replace(";;", ";", $this->textBoxMultiLine[$keyB]['styles']);
				}
			}
		}
		if($this->allObj[$nameObj]['type'] == "space"){
			foreach ($this->space as $keyB => $valueB){
				if($keyB==$nameObj){
					$this->space[$keyB]['styles'] .= $styles;
					$this->space[$keyB]['styles'] = str_replace(";;", ";", $this->space[$keyB]['styles']);
				}
			}
		}
	}
	public function addStylesMaster($nameObj,$styles){
		/*if($this->allObj[$nameObj]['type'] == "button"){
			foreach ($this->button as $keyB => $valueB){
				if($keyB==$nameObj){
					$this->button[$keyB]['styles'] .= $styles;
					$this->button[$keyB]['styles'] = str_replace(";;", ";", $this->button[$keyB]['styles']);
				}
			}
		}
		if($this->allObj[$nameObj]['type'] == "comboBox"){
			foreach ($this->comboBox as $keyB => $valueB){
				if($keyB==$nameObj){
					$this->comboBox[$keyB]['styles'] .= $styles;
					$this->comboBox[$keyB]['styles'] = str_replace(";;", ";", $this->comboBox[$keyB]['styles']);
				}
			}
		}
		if($this->allObj[$nameObj]['type'] == "date"){
			foreach ($this->date as $keyB => $valueB){
				if($keyB==$nameObj){
					$this->date[$keyB]['styles'] .= $styles;
					$this->date[$keyB]['styles'] = str_replace(";;", ";", $this->date[$keyB]['styles']);
				}
			}
		}*/
		if($this->allObj[$nameObj]['type'] == "textBox"){
			if(isset($this->textBox[$nameObj])){
				$this->textBox[$nameObj]['stylesMaster'] .= $styles.";";
				$this->textBox[$nameObj]['stylesMaster'] = str_replace(";;", ";", $this->textBox[$nameObj]['stylesMaster']);
				$this->textBox[$nameObj]['stylesMaster'] = str_replace(";;", ";", $this->textBox[$nameObj]['stylesMaster']);
			}
		}
		/*if($this->allObj[$nameObj]['type'] == "textBoxMultiLine"){
			foreach ($this->textBoxMultiLine as $keyB => $valueB){
				if($keyB==$nameObj){
					$this->textBoxMultiLine[$keyB]['styles'] .= $styles;
					$this->textBoxMultiLine[$keyB]['styles'] = str_replace(";;", ";", $this->textBoxMultiLine[$keyB]['styles']);
				}
			}
		}
		if($this->allObj[$nameObj]['type'] == "space"){
			foreach ($this->space as $keyB => $valueB){
				if($keyB==$nameObj){
					$this->space[$keyB]['styles'] .= $styles;
					$this->space[$keyB]['styles'] = str_replace(";;", ";", $this->space[$keyB]['styles']);
				}
			}
		}*/
	}
	public function disable($nameObj){
		if($this->allObj[$nameObj]['type'] = "button"){
			foreach ($this->button as $keyB => $valueB){
				if($keyB==$nameObj){
					$this->button[$keyB]['disabled'] = true;
				}
			}
		}
		if($this->allObj[$nameObj]['type'] = "comboBox"){
			foreach ($this->comboBox as $keyB => $valueB){
				if($keyB==$nameObj){
					$this->comboBox[$keyB]['disabled'] = " disabled=\"disabled\"";
				}
			}
		}
		if($this->allObj[$nameObj]['type'] = "textBox"){
			foreach ($this->textBox as $keyB => $valueB){
				if($keyB==$nameObj){
					$this->textBox[$keyB]['disabled'] = " disabled=\"disabled\"";
				}
			}
		}
		if($this->allObj[$nameObj]['type'] = "textBoxMultiLine"){
			foreach ($this->textBoxMultiLine as $keyB => $valueB){
				if($keyB==$nameObj){
					$this->textBoxMultiLine[$keyB]['styles'] = " disabled=\"disabled\"";
				}
			}
		}
	}
	
	public function minLen($name,$minLen){
		if($this->allObj[$name]['type'] == "comboBox"){
			foreach ($this->comboBox as $keyB => $valueB){
				if($keyB==$name){
					$this->comboBox[$keyB]['minLen'] = $minLen;
				}
			}
		}
		if($this->allObj[$name]['type'] == "textBox"){
			foreach ($this->textBox as $keyB => $valueB){
				if($keyB==$name){
					$this->textBox[$keyB]['minLen'] = $minLen;
				}
			}
		}
		if($this->allObj[$name]['type'] == "textBoxMultiLine"){
			foreach ($this->textBoxMultiLine as $keyB => $valueB){
				if($keyB==$name){
					$this->textBoxMultiLine[$keyB]['minLen'] = $minLen;
				}
			}
		}
	}
	
	public function requireOff($name){
		if($this->allObj[$name]['type'] == "comboBox"){
			foreach ($this->comboBox as $keyB => $valueB){
				if($keyB==$name){
					$this->comboBox[$keyB]['require'] = false;
				}
			}
		}
		if($this->allObj[$name]['type'] == "textBox"){
			foreach ($this->textBox as $keyB => $valueB){
				if($keyB==$name){
					$this->textBox[$keyB]['require'] = false;
				}
			}
		}
		if($this->allObj[$name]['type'] == "textBoxMultiLine"){
			foreach ($this->textBoxMultiLine as $keyB => $valueB){
				if($keyB==$name){
					$this->textBoxMultiLine[$keyB]['require'] = false;
				}
			}
		}
	}
	
	public function unique($name,$where,$operator="=",$value="1"){
		if($this->allObj[$name]['type'] == "comboBox"){
			foreach ($this->comboBox as $keyB => $valueB){
				if($keyB==$name){
					$this->comboBox[$keyB]['unique'] = true;
					$this->comboBox[$keyB]['whereForCheckUnique'] = $where;
					$this->comboBox[$keyB]['operatorForCheckUnique'] = $operator;
					$this->comboBox[$keyB]['valueForCheckUnique'] = $value;
				}
			}
		}
		if($this->allObj[$name]['type'] == "textBox"){
			foreach ($this->textBox as $keyB => $valueB){
				if($keyB==$name){
					$this->textBox[$keyB]['unique'] = true;
					$this->textBox[$keyB]['whereForCheckUnique'] = $where;
					$this->textBox[$keyB]['operatorForCheckUnique'] = $operator;
					$this->textBox[$keyB]['valueForCheckUnique'] = $value;
				}
			}
		}
		if($this->allObj[$name]['type'] == "textBoxMultiLine"){
			foreach ($this->textBoxMultiLine as $keyB => $valueB){
				if($keyB==$name){
					$this->textBoxMultiLine[$keyB]['value'] = true;
					$this->textBoxMultiLine[$keyB]['whereForCheckUnique'] = $where;
					$this->textBoxMultiLine[$keyB]['operatorForCheckUnique'] = $operator;
					$this->textBoxMultiLine[$keyB]['valueForCheckUnique'] = $value;
				}
			}
		}
	}

	public function setIgnoreQuebraLinha($name){
		if($this->allObj[$name]['type'] == "textBoxMultiLine"){
			foreach ($this->textBoxMultiLine as $keyB => $valueB){
				if($keyB==$name){
					$this->textBoxMultiLine[$keyB]['ignoreQuebraLinha'] = true;
				}
			}
		}
	}
	
	public function value($name,$value,$type=false){
		if($this->allObj[$name]['type'] == "textBox"){
			if($type=="date"){
				$this->ignorePost($name);
				$this->type($name,"date");
				if(strlen($value)>0){
					$value = $this->formatDateTime($value,"usa_rc");
				}
			}else if($type=="datetime"){
				$this->ignorePost($name);
				$this->type($name,"datetime-local");
				if(strlen($value)>0){
					$value = $this->formatDateTime($value,"usa_rfc");
				}
			}
			$this->textBox[$name]['value'] = $value;
		} 
		if($this->allObj[$name]['type'] == "date"){
			if($type=="date"){
				$this->ignorePost($name);
				$this->type($name,"date");
				if(strlen($value)>0){
					$value = $this->formatDateTime($value,"usa_rc");
				}
			}else if($type=="datetime"){
				$this->ignorePost($name);
				$this->type($name,"datetime-local");
				if(strlen($value)>0){
					$value = $this->formatDateTime($value,"usa_rfc");
				}
			}
			$this->date[$name]['value'] = $value;
		}
		if($this->allObj[$name]['type'] == "textBoxMultiLine"){
			$this->textBoxMultiLine[$name]['value'] = $value;
		}
		if($this->allObj[$name]['type'] == "comboBox"){
			$this->comboBox[$name]['selectedIndex'] = $value;
		}
		if($this->allObj[$name]['type'] == "space"){
			$this->space[$name]['value'] = $value;
		}
		if($this->allObj[$name]['type'] == "checkBox"){
			$this->checkBox[$name]['value'] = $value;
		}
	}

	public function setClass($name,$class){
		if($this->allObj[$name]['type'] == "comboBox"){
			foreach ($this->comboBox as $keyB => $valueB){
				if($keyB==$name){
					$this->comboBox[$keyB]['class'] = $class;
				}
			}
		}
		if($this->allObj[$name]['type'] == "textBox"){
			foreach ($this->textBox as $keyB => $valueB){
				if($keyB==$name){
					$this->textBox[$keyB]['class'] = $class;
				}
			}
		}
		if($this->allObj[$name]['type'] == "textBoxMultiLine"){
			foreach ($this->textBoxMultiLine as $keyB => $valueB){
				if($keyB==$name){
					$this->textBoxMultiLine[$keyB]['class'] = $class;
				}
			}
		}
		if($this->allObj[$name]['type'] == "space"){
			foreach ($this->space as $keyB => $valueB){
				if($keyB==$name){
					$this->space[$keyB]['class'] = $class;
				}
			}
		}
		if($this->allObj[$name]['type'] == "button"){
			foreach ($this->button as $keyB => $valueB){
				if($keyB==$name){
					$this->button[$keyB]['class'] = $class;
				}
			}
		}
	}

	public function End(){
		global $PATH;
		global $page;
		global $menuCore;
		global $PAGENAME;
		
		if($this->viewAll===true){
			$this->java->setGoToPage("click", "btVerTodosD".$this->name, false, "FILTRO_STATUS", "6", false, "@".$PAGENAME."&".$this->listName."_ALL=1&VER_TODOS".$this->name."=1@".$PAGENAME."&noRefresh=1&SLT_NAME=".$this->listName,false,false,"objCore".$this->listName."0");
			$this->java->setGoToPage("click", "btVerTodosA".$this->name, false, "FILTRO_STATUS", "5", false, "@".$PAGENAME."&".$this->listName."_ALL=&VER_TODOS".$this->name."=@".$PAGENAME."&noRefresh=1&SLT_NAME=".$this->listName,false,false,"objCore".$this->listName."0");
		}
		
		$this->checkOpenCloseTag(true,true,true,true);
		
		if($this->width!==false || $this->widthGeral!==false){
			if($this->widthGeral!==false){
				$this->width = $this->widthGeral;
			}
			$width = " width=\"".$this->width."\"";
		}else{
			$width = "";
		}
		
		if($this->height!==false){
			$height = " height=\"".$this->height."\"";
		}else{
			$height = "";
		}
		
		if($this->cellpadding!==false){
			$cellpadding = " cellpadding=\"".$this->cellpadding."\"";
		}else{
			$cellpadding = "";
		}
		if($this->cellspacing!==false){
			$cellspacing = " cellspacing=\"".$this->cellspacing."\"";
		}else{
			$cellspacing = "";
		}		
		
		#$this->e("<table id=\"".$this->name."\" name=\"".$this->name."\"".$width.$height." border=\"".$this->border."\"".$cellpadding.$cellspacing.">",$this->nivel);
		foreach ($this->linesHtml as $key => $value){
			if(count($this->nameOrigin)>0){
				foreach($this->nameOrigin as $kAA => $vAA){
					if(strpos($this->linesHtml[$key]['html'],"@insertHTML")!==false){
						$this->linesHtml[$key]['html'] = str_replace("@insertHTML".$vAA."#","",$this->linesHtml[$key]['html']);
					}
				}
			}
			if(strpos($this->linesHtml[$key]['html'],"@obj#")!==false){
				$nameObj = $this->parseTextBetweenMulti("@obj#", "#obj@",$this->linesHtml[$key]['html']);
				$typeObj = $this->parseTextBetweenMulti("@type#", "#type@",$this->linesHtml[$key]['html']);
				if($typeObj=="comboBox"){
					if(strlen($this->comboBox[$nameObj]['selectedIndex'])==0){
						if($this->allObj[$nameObj]['ignorePost']===false){
							$this->comboBox[$nameObj]['selectedIndex'] = @$_POST[$this->comboBox[$nameObj]['name']];
						}
					}
					if($this->comboBox[$nameObj]['uppercase']===true){
						@$this->addStyles($nameObj, uppercase);
					}else{
						@$this->addStyles($nameObj, unSetUppercase);
					}
					$this->e("<div class=\"".$this->comboBox[$nameObj]['cols']."\" style=\"text-align:left;\">",$this->linesHtml[$key]['nivel']);
					if(strlen($this->comboBox[$nameObj]['label'])>0){
						$this->e("<label>".$this->comboBox[$nameObj]['label']."</label>",$this->linesHtml[$key]['nivel']);
					}
					$this->e("<select id=\"".$nameObj."\" name=\"".$nameObj.($this->comboBox[$nameObj]['multiple']==' multiple' ? "[]" : "")."\" class=\"".$this->comboBox[$nameObj]['class']." form-control-comboBox\"".$this->comboBox[$nameObj]['multiple'].$this->comboBox[$nameObj]['disabled'].$this->comboBox[$nameObj]['readOnly']." style=\"".$this->comboBox[$nameObj]['styles']."\" ".$this->comboBox[$nameObj]['java'].">",$this->linesHtml[$key]['nivel']);
					foreach ($this->optionComboBox as $keyB => $valueB){
						if($this->optionComboBox[$keyB]['nameComboBox']==$nameObj){
							$selected = "";
							if($this->optionComboBox[$keyB]['value']==$this->comboBox[$nameObj]['selectedIndex'] && strlen($this->optionComboBox[$keyB]['value'])==strlen($this->comboBox[$nameObj]['selectedIndex'])){ 
								$selected = " selected"; 
							}
							$this->e("<option value=\"".$this->optionComboBox[$keyB]['value']."\"".$selected.">".$this->optionComboBox[$keyB]['desc']."</option>",($this->linesHtml[$key]['nivel']+1));
						}
					}
				}				
				if($typeObj=="comboBox"){
					$this->e("</select>",$this->linesHtml[$key]['nivel']);
					$this->e("</div>",$this->linesHtml[$key]['nivel']);
				}
				if($typeObj=="form"){
					$this->e("<form id=\"".$this->form[$nameObj]['name']."\" name=\"".$this->form[$nameObj]['name']."\" method=\"".$this->form[$nameObj]['method']."\" action=\"".$this->form[$nameObj]['action']."\" target=\"".$this->form[$nameObj]['target']."\" style=\"".$this->form[$nameObj]['styles']."\">",$this->linesHtml[$key]['nivel']);
					$this->e("<input type=\"hidden\" id=\"FORM_".$this->form[$nameObj]['name']."\" name=\"FORM_".$this->form[$nameObj]['name']."\" value=\"1\" />",$this->linesHtml[$key]['nivel']+1);
				}
				if($typeObj=="space"){
					if($this->space[$nameObj]['closePreviews']!==false){
						$this->checkOpenCloseTag(false,false,false,true,true);
						$this->linesHtml[$key]['nivel']--;
						$this->e("</div>",$this->linesHtml[$key]['nivel']);
					}	
					$this->e("<div id=\"".$this->space[$nameObj]['name']."\" name=\"".$this->space[$nameObj]['name']."\" align=\"".$this->space[$nameObj]['align']."\" class=\"".$this->space[$nameObj]['cols']." ".$this->space[$nameObj]['class']."\" style=\"".$this->space[$nameObj]['styles']."\">".$this->space[$nameObj]['value'],$this->linesHtml[$key]['nivel']);
				}
				if($typeObj=="checkBox"){
					$autocompleteOff = "";
					if($this->autoCompleteOff===true){
						$autocompleteOff = " autocomplete=\"off\"";
					}
					$checked = "";
					if(strlen($this->checkBox[$nameObj]['value'])==0){
						if($this->allObj[$nameObj]['ignorePost']===false){
							$this->checkBox[$nameObj]['value'] = @$_POST[$this->checkBox[$nameObj]['name']];
						}
					}else{
						$checked = " checked";
					}
					$this->e("<div id=\"base".$this->checkBox[$nameObj]['name']."\" class=\"form-check form-check-inline\">",$this->linesHtml[$key]['nivel']);
					$this->e("<input type=\"".$this->checkBox[$nameObj]['type']."\" id=\"".$this->checkBox[$nameObj]['name']."\" name=\"".$this->checkBox[$nameObj]['name']."\" value=\"".$this->checkBox[$nameObj]['value']."\" class=\"form-check-input ".$this->checkBox[$nameObj]['class']."\"".$this->checkBox[$nameObj]['disabled'].$this->checkBox[$nameObj]['readOnly']." style=\"".$this->checkBox[$nameObj]['styles']."\"".$autocompleteOff.$checked." />",$this->linesHtml[$key]['nivel']);
					$this->e("<label class=\"form-check-label\" for=\"".$this->checkBox[$nameObj]['name']."\">".$this->checkBox[$nameObj]['display']."</label>",$this->linesHtml[$key]['nivel']);
					$this->e("</div>",$this->linesHtml[$key]['nivel']);
				}
				if($typeObj=="file"){
					$autocompleteOff = "";
					if($this->autoCompleteOff===true){
						$autocompleteOff = " autocomplete=\"off\"";
					}
					if(strlen($this->file[$nameObj]['value'])==0){
						if($this->allObj[$nameObj]['ignorePost']===false){
							$this->file[$nameObj]['value'] = @$_POST[$this->file[$nameObj]['name']];
						}
					}
					#$this->e("<input type=\"".$this->file[$nameObj]['type']."\" id=\"".$this->file[$nameObj]['name']."\" name=\"".$this->file[$nameObj]['name']."\" value=\"".$this->file[$nameObj]['value']."\" class=\"".$this->file[$nameObj]['class']."\" maxlength=\"".$this->file[$nameObj]['maxlen']."\"".$this->file[$nameObj]['disabled'].$this->file[$nameObj]['readOnly']." style=\"".$this->file[$nameObj]['styles']."\"".$autocompleteOff."/>",$this->linesHtml[$key]['nivel']);
					
					if($this->file[$nameObj]['uppercase']===true){
						@$this->addStyles($nameObj, uppercase);
					}else{
						@$this->addStyles($nameObj, unSetUppercase);
					}
					$this->e("<div class=\"".$this->file[$nameObj]['cols']."\">",$this->linesHtml[$key]['nivel']);
					if(strlen($this->file[$nameObj]['label'])>0){
						$this->e("<label>".$this->file[$nameObj]['label']."</label>",$this->linesHtml[$key]['nivel']);
					}
					$this->e("<input type=\"file\" id=\"".$this->file[$nameObj]['name']."\" name=\"".$this->file[$nameObj]['name']."\" value=\"".$this->file[$nameObj]['value']."\" class=\"".$this->file[$nameObj]['class']."\" maxlength=\"".$this->file[$nameObj]['maxlen']."\"".$this->file[$nameObj]['disabled'].$this->file[$nameObj]['readOnly']." style=\"".$this->file[$nameObj]['styles']."\"".$autocompleteOff.$this->file[$nameObj]['required']."/>",$this->linesHtml[$key]['nivel']);
					$this->e("</div>",$this->linesHtml[$key]['nivel']);
				}
				if($typeObj=="img"){
					$repeatOnClickToBase = "";
					if($this->img[$nameObj]['repeatOnClickToBase']===true){
						$repeatOnClickToBase = $this->img[$nameObj]['onClick'];
					}

					$this->e("<div class=\"".$this->img[$nameObj]['cols']."\" style=\"text-align:left;\" onClick=\"".$repeatOnClickToBase."\">",$this->linesHtml[$key]['nivel']);
					if($this->img[$nameObj]['classDivBase']!==false){
						$this->e("<div class=\"".$this->img[$nameObj]['classDivBase']."\" onClick=\"".$repeatOnClickToBase."\">",$this->linesHtml[$key]['nivel']);
					}
					$stylesB = "";
					$this->e("<img id=\"".$this->img[$nameObj]['name']."\" name=\"".$this->img[$nameObj]['name']."\" src=\"".($this->img[$nameObj]['base64']===true ? "data:".$this->img[$nameObj]['mimeType'].";base64, " : "").$this->img[$nameObj]['src']."\"alt=\"".$this->img[$nameObj]['value']."\" class=\"".$this->img[$nameObj]['class']."\" style=\"".$this->img[$nameObj]['styles'].$stylesB."\" onClick=\"".$this->img[$nameObj]['onClick']."\" />",$this->linesHtml[$key]['nivel']);
					if($this->img[$nameObj]['classDivBase']!==false){
						$this->e("</div>",$this->linesHtml[$key]['nivel']);
					}
					$this->e("</div>",$this->linesHtml[$key]['nivel']);
				}
				if($typeObj=="textBox"){
					$autocompleteOff = "";
					if($this->autoCompleteOff===true){
						$autocompleteOff = " autocomplete=\"off\"";
					}
					if(strlen($this->textBox[$nameObj]['value'])==0){
						if($this->allObj[$nameObj]['ignorePost']===false){
							$this->textBox[$nameObj]['value'] = @$_POST[$this->textBox[$nameObj]['name']];
						}
					}
					if($this->textBox[$nameObj]['uppercase']===true){
						@$this->addStyles($nameObj, uppercase);
					}else{
						@$this->addStyles($nameObj, unSetUppercase);
					}
					if($this->textBox[$nameObj]['placeHolder']!==false){
						$this->textBox[$nameObj]['placeHolder'] = " placeholder=\"".$this->textBox[$nameObj]['placeHolder']."\"";
					}
					if($this->textBox[$nameObj]['focus']!==false){
						$this->textBox[$nameObj]['focus'] = " autofocus";
					}
					$this->e("<div class=\"".$this->textBox[$nameObj]['cols']."\" style=\"text-align:left;".$this->textBox[$nameObj]['stylesMaster']."\">",$this->linesHtml[$key]['nivel']);
					if(strlen($this->textBox[$nameObj]['label'])>0 && $this->textBox[$nameObj]['type']!="id"){
						$this->e("<label id=\"label".$this->textBox[$nameObj]['name']."\" style=\"width:100%;\">".$this->textBox[$nameObj]['label']."</label>",$this->linesHtml[$key]['nivel']);
					}
					if($this->textBox[$nameObj]['step']===false){
						$this->textBox[$nameObj]['step'] = "";
					}else{
						$this->textBox[$nameObj]['step'] = " step=\"".$this->textBox[$nameObj]['step']."\"";
					}
					$stylesB = "";
					if($this->textBox[$nameObj]['ignoreStyles']===false && ($this->textBox[$nameObj]['readOnly']!==false || $this->textBox[$nameObj]['disabled']!==false) && $this->textBox[$nameObj]['type']!="status"){
						$stylesB = ";background-color:#ddd";
					}
					if($this->textBox[$nameObj]['type']=="number" && $this->textBox[$nameObj]['value']!="blank"){
						$stylesB .= ";text-align:right";
						
						if(strlen($this->textBox[$nameObj]['value'])==0){
							$this->textBox[$nameObj]['value'] = 0;
						}

						$tempValue = $this->textBox[$nameObj]['value'];
						$tempValue = str_replace("R$", "", $tempValue);
						$tempValue = str_replace(" ", "", $tempValue);
						$tempValue = str_replace(".", "#", $tempValue);
						$tempValue = str_replace(",", "@", $tempValue);
						if(strpos($tempValue,"@")!==false){
							$tempValue = str_replace("#", "", $tempValue);
							$tempValue = str_replace("@", ".", $tempValue);
						}else{
							$tempValue = str_replace("#", ".", $tempValue);
						}

						if($this->textBox[$nameObj]['paramA']!==false){
							$this->textBox[$nameObj]['digit'] = $this->textBox[$nameObj]['paramA'];
						}

						if($this->textBox[$nameObj]['paramB']!==false){
							$this->textBox[$nameObj]['step'] = " step=\"".$this->textBox[$nameObj]['paramB']."\"";
						}
						
						if($this->textBox[$nameObj]['digit']===false){
							$tempValue = round($tempValue,2);
							$tempValue = number_format($tempValue,2,".","");
						}else{
							$tempValue = round($tempValue,$this->textBox[$nameObj]['digit']);
							$tempValue = number_format($tempValue,$this->textBox[$nameObj]['digit'],".","");
						}
						
						$this->textBox[$nameObj]['value'] = $tempValue;
					}else if($this->textBox[$nameObj]['value']=="blank"){
						$stylesB .= ";text-align:right";
						$this->textBox[$nameObj]['value'] = "";
					}
					if($this->textBox[$nameObj]['value']=="" && isset($_POST[$nameObj])){
						if($this->allObj[$nameObj]['ignorePost']===false){
							$this->textBox[$nameObj]['value'] = $_POST[$nameObj];
						}
					}
					if($this->textBox[$nameObj]['type']=="id"){
						$before = false;
						$current = false;
						$after = false;
						$count = 0;
						if($this->textBox[$nameObj]['paramA']!==false){
							$lista = $page->session->getSession("tableMemory_".$this->textBox[$nameObj]['paramA'],$PAGENAME);
							if(is_array($lista)){
								foreach($lista as $kA => $vA){
									if(isset($vA[$nameObj])){
										if(strlen($vA[$nameObj])>0){
											$count++;
											if($vA[$nameObj]==$this->textBox[$nameObj]['value']){
												$current = $count;
											}else if($current===false){
												$before = $vA[$nameObj];
											}else if($after===false){
												$after = $vA[$nameObj];
											}
										}
									}
								}

								$page->s->s($nameObj."_before",$before);
								$page->s->s($nameObj."_after",$after);

								if(count($lista)>1){
									$this->addStyles($nameObj,cursor);
									$this->java->setObjVisible("click",$nameObj,"basepanel".$nameObj);

									$objTemp = new space($this,"panel".$nameObj);
									$objTemp->panel();

									$objChildTemp = new bootstrap($objTemp,"bpPanel".$nameObj);
									$objChildTemp->line();
									$objChildTemp->button($nameTemp = "fecharPanel".$nameObj,"Fechar","btn-warning","12,6,4,3,2");
									$objChildTemp->java->setObjInvisible("click",$nameTemp,"basepanel".$nameObj);

									$objChildTemp->line(pularLinha);

									$tTemp = new iDataTableAdapter($objChildTemp,$this->textBox[$nameObj]['paramA']."B");
									$tTemp->setSelect($lista,true);
									$tTemp->reloadSetting($page->session->getSession("tableMemorySetting_".$this->textBox[$nameObj]['paramA'],$PAGENAME));

									$colunaId = false;
									$colunasTabela = "";
									if(strlen($this->textBox[$nameObj]['paramB'])>0){
										$paramBTemp = explode(",",$this->textBox[$nameObj]['paramB']);
										$colunas = array();
										foreach($paramBTemp as $kZ => $vZ){
											$colunas[$vZ] = true;
										}

										$firstB = true;
										foreach($lista as $kX => $vX){
											if($firstB===true){
												$firstB = false;
												foreach($vX as $kW => $vW){
													if($colunaId===false){
														$colunaId = $kW;
													}
													if(!isset($colunas[$kW])){
														$tTemp->setColumnsHidden($kW);
													}else{
														if(strlen($colunasTabela)>0){
															$colunasTabela .= ",";
														}
														$colunasTabela .= $kW;
													}
												}
											}
										}
									}else{
										$firstB = true;
										foreach($lista as $kX => $vX){
											if($firstB===true){
												$firstB = false;
												foreach($vX as $kW => $vW){
													if($colunaId===false){
														$colunaId = $kW;
													}
													if(strlen($colunasTabela)>0){
														$colunasTabela .= ",";
													}
													$colunasTabela .= $kW;
												}
											}
										}
									}

									$tTemp->setActionOnClick(THIS,$colunaId,$colunaId,$colunasTabela,$PAGENAME);
								}
							}
						}
						if(strlen($this->textBox[$nameObj]['label'])>0 && $before===false && $after===false || $current===false){
							$this->e("<label id=\"".$this->textBox[$nameObj]['name']."Label\">".$this->textBox[$nameObj]['label']."</label>",$this->linesHtml[$key]['nivel']);
						}else{
							$this->e("<label id=\"".$this->textBox[$nameObj]['name']."Label\">".$this->textBox[$nameObj]['label']." (".$current."/".$count.")</label>",$this->linesHtml[$key]['nivel']);
						}
						$this->e("<div class=\"form-row\" style=\"padding:0px 5px 0px 5px;\">",$this->linesHtml[$key]['nivel']);
						$this->e("<button type=\"button\" id=\"".$this->textBox[$nameObj]['name']."_anterior\" name=\"".$this->textBox[$nameObj]['name']."_anterior\" class=\"btn ".($this->textBox[$nameObj]['buttonSize']===false ? "" : $this->textBox[$nameObj]['buttonSize']." ")."btn-secondary col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2\" style=\"margin-top:0px;border-top-right-radius:0px;border-bottom-right-radius:0px; height: 38px\" ".(($before===false || $current===false) ? "disabled=\"disabled\"" : "onClick=\"goToPage('".THIS."','".$nameObj."','".$before."','','@".$PAGENAME."','')\"")."><b><</b></button>",$this->linesHtml[$key]['nivel']);
						$this->e("<input type=\"text\" id=\"".$this->textBox[$nameObj]['name']."\" name=\"".$this->textBox[$nameObj]['name']."\" value=\"".$this->textBox[$nameObj]['value']."\" class=\"".$this->textBox[$nameObj]['class']." col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8\" maxlength=\"".$this->textBox[$nameObj]['maxlen']."\" readOnly=\"readOnly\" style=\"border-radius:0px;text-align:center;border:1px solid rgb(108,117,125);".$this->textBox[$nameObj]['styles'].$stylesB."\"".$autocompleteOff.$this->textBox[$nameObj]['required'].$this->textBox[$nameObj]['placeHolder'].$this->textBox[$nameObj]['focus'].$this->textBox[$nameObj]['step']." />",$this->linesHtml[$key]['nivel']);
						$this->e("<button type=\"button\" id=\"".$this->textBox[$nameObj]['name']."_proximo\" name=\"".$this->textBox[$nameObj]['name']."_proximo\" class=\"btn ".($this->textBox[$nameObj]['buttonSize']===false ? "" : $this->textBox[$nameObj]['buttonSize']." ")."btn-secondary col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2\" style=\"margin-top:0px;border-top-left-radius:0px;border-bottom-left-radius:0px; height: 38px\" ".(($after===false || $current===false) ? "disabled=\"disabled\"" : "onClick=\"goToPage('".THIS."','".$nameObj."','".$after."','','@".$PAGENAME."','')\"")."><b>></b></button>",$this->linesHtml[$key]['nivel']);
						$this->e("</div>",$this->linesHtml[$key]['nivel']);
					}else{
						if($this->textBox[$nameObj]['type']=="status"){
							global $status;
							global $statusText;
							global $statusColor;
							global $statusBackgroundColor;

							$statusTextTemp = $statusText;
							$statusColorTemp = $statusColor;
							$statusBackgroundColorTemp = $statusBackgroundColor;

							if($this->textBox[$nameObj]['paramA']===false){
								$statusTemp = $status;
							}else{
								$statusTemp = $this->textBox[$nameObj]['paramA'];
							}

							if($this->textBox[$nameObj]['paramB']=="statusB"){
								global $statusTextB;
								global $statusColorB;
								global $statusBackgroundColorB;

								$statusTextTemp = $statusTextB;
								$statusColorTemp = $statusColorB;
								$statusBackgroundColorTemp = $statusBackgroundColorB;
							}

							if(!is_numeric($statusTemp)){
								$statusTemp = -1;
							}

							$this->ignoreStyles($nameObj);
							$this->addStyles($nameObj,textAlign.center);
							$this->addStyles($nameObj,color.$statusColorTemp[$statusTemp]);
							$this->addStyles($nameObj,backGroundColor.$statusBackgroundColorTemp[$statusTemp]);

							$this->textBox[$nameObj]['value'] = $statusTextTemp[$statusTemp];
							$this->textBox[$nameObj]['type'] = "text";
							$this->textBox[$nameObj]['readOnly'] = " readonly=\"readonly\"";
							//$stylesB = ";border:1px";
						}else if($this->textBox[$nameObj]['type']=="cpfCnpj"){
							$this->addStyles($nameObj,textAlign.center);
							$this->textBox[$nameObj]['value'] = $this->formatCpfCnpj($this->textBox[$nameObj]['value']);
							$this->textBox[$nameObj]['type'] = "text";
							$this->textBox[$nameObj]['readOnly'] = " readonly=\"readonly\"";
							$stylesB = ";background-color:#ddd";
						}
						$this->e("<input type=\"".$this->textBox[$nameObj]['type']."\" id=\"".$this->textBox[$nameObj]['name']."\" name=\"".$this->textBox[$nameObj]['name']."\" value=\"".$this->textBox[$nameObj]['value']."\" class=\"".$this->textBox[$nameObj]['class'].($this->textBox[$nameObj]['type']=="datetime-local" ? " form-control-date" : ($this->textBox[$nameObj]['type']=="date" ? " form-control-date" : ($this->textBox[$nameObj]['type']=="datetime" ? " form-control-date" : "")))."\" maxlength=\"".$this->textBox[$nameObj]['maxlen']."\"".$this->textBox[$nameObj]['disabled'].$this->textBox[$nameObj]['readOnly']." style=\"".$this->textBox[$nameObj]['styles'].$stylesB."\"".$autocompleteOff.$this->textBox[$nameObj]['required'].$this->textBox[$nameObj]['placeHolder'].$this->textBox[$nameObj]['focus'].$this->textBox[$nameObj]['step']." />",$this->linesHtml[$key]['nivel']);
					}
					$this->e("</div>",$this->linesHtml[$key]['nivel']);
				}
				if($typeObj=="upload"){
					if($this->upload[$nameObj]['addGet']!==false){
						$this->upload[$nameObj]['addGet'] = "&".$this->upload[$nameObj]['addGet'];
					}else{
						$this->upload[$nameObj]['addGet'] = "";
					}
					$this->e("<div class=\"moldura ".$this->upload[$nameObj]['cols']."\" style=\"text-align: left;\">",$this->linesHtml[$key]['nivel']);
					$this->e("
						<div class=\"area-upload\">
							<input type=\"hidden\" id=\"phpFileUpload".$this->upload[$nameObj]['name']."\" name=\"phpFileUpload".$this->upload[$nameObj]['name']."\" value=\"upload.php?noRefresh=1&tipo=".$this->upload[$nameObj]['name']."&pagename=".$PAGENAME.$this->upload[$nameObj]['addGet']."\" />
							<label for=\"upload-file\" class=\"label-upload\" id=\"label".$this->upload[$nameObj]['name']."\">
								<i class=\"fas fa-cloud-upload-alt\"></i>
								<div class=\"texto\">Clique ou Arraste<br>".$this->upload[$nameObj]['value']."</div>
							</label>
							<input type=\"file\" accept=\"".$this->upload[$nameObj]['accept']."\" id=\"upload".$this->upload[$nameObj]['name']."\"".($this->upload[$nameObj]['multiple']===true ? " multiple" : "")." />
							<div class=\"lista-uploads\" id=\"list".$this->upload[$nameObj]['name']."\">
							</div>
						</div>
						<script>newUpload(\"upload".$this->upload[$nameObj]['name']."\",\"label".$this->upload[$nameObj]['name']."\",\"list".$this->upload[$nameObj]['name']."\",\"phpFileUpload".$this->upload[$nameObj]['name']."\",false,".($this->upload[$nameObj]['multiple']===true ? "false" : "true").");</script>
					",$this->linesHtml[$key]['nivel']);
					$this->e("</div>",$this->linesHtml[$key]['nivel']);
				}
				if($typeObj=="date"){
					$autocompleteOff = "";
					if($this->autoCompleteOff===true){
						$autocompleteOff = " autocomplete=\"off\"";
					}
					
					$stylesB = "";
					if($this->date[$nameObj]['ignoreStyles']===false && ($this->date[$nameObj]['readOnly']!==false || $this->date[$nameObj]['disabled']!==false)){
						$stylesB = ";background-color:#ddd";
					}
					
					if(strlen($this->date[$nameObj]['value'])=="blank"){
						$this->date[$nameObj]['value'] = "";
					}else if(strlen($this->date[$nameObj]['value'])==0){
						if(isset($_POST[$this->date[$nameObj]['name']])){
							if($this->allObj[$nameObj]['ignorePost']===false){
								$this->date[$nameObj]['value'] = $page->formatDateTime($_POST[$this->date[$nameObj]['name']],"usa_rc");
							}
						}else if($this->date[$nameObj]['value']!==false){
							$this->date[$nameObj]['value'] = $page->formatDateTime(time(),"usa_rc");
						}
					}else{
						if(is_numeric($this->date[$nameObj]['value'])){
							$this->date[$nameObj]['value'] = $page->formatDateTime($this->date[$nameObj]['value'],"usa_rc");
						}
					}
					
					$this->e("<div class=\"".$this->date[$nameObj]['cols']."\">",$this->linesHtml[$key]['nivel']);
					if(strlen($this->date[$nameObj]['label'])>0){
						$this->e("<label>".$this->date[$nameObj]['label']."</label>",$this->linesHtml[$key]['nivel']);
					}
					$this->e("<input type=\"".$this->date[$nameObj]['type']."\" id=\"".$this->date[$nameObj]['name']."\" name=\"".$this->date[$nameObj]['name']."\" value=\"".$this->date[$nameObj]['value']."\" class=\"".$this->date[$nameObj]['class']." form-control-date\"".$this->date[$nameObj]['readOnly']." style=\"".$this->date[$nameObj]['styles'].$stylesB."\"".$autocompleteOff.$this->date[$nameObj]['required']."/>",$this->linesHtml[$key]['nivel']);
					$this->e("</div>",$this->linesHtml[$key]['nivel']);
				}
				if($typeObj=="textBoxMultiLine"){
					$value = $this->textBoxMultiLine[$nameObj]['value'];
					if($this->textBoxMultiLine[$nameObj]['ignoreQuebraLinha']===false){
						$value = str_replace("<br>", "\n", $value);
					}
					/*$value = str_replace("\n\r", "$1", $value);
					$value = str_replace("\r\n", "$2", $value);
					$value = str_replace("\n", "$3", $value);
					$value = str_replace("\r", "$4", $value);#&#10;*/
					$this->textBoxMultiLine[$nameObj]['value'] = $value;
					if(strlen($this->textBoxMultiLine[$nameObj]['value'])==0){
						if($this->allObj[$nameObj]['ignorePost']===false){
							$this->textBoxMultiLine[$nameObj]['value'] = @$_POST[$this->textBoxMultiLine[$nameObj]['name']];
						}
					}
					if($this->textBoxMultiLine[$nameObj]['uppercase']===true){
						@$this->addStyles($nameObj, uppercase);
					}else{
						@$this->addStyles($nameObj, unSetUppercase);
					}
					$stylesB = "";
					if($this->textBoxMultiLine[$nameObj]['ignoreStyles']===false && ($this->textBoxMultiLine[$nameObj]['readOnly']!==false || $this->textBoxMultiLine[$nameObj]['disabled']!==false)){
						$stylesB = ";background-color:#ddd";
					}
					$this->e("<div class=\"".$this->textBoxMultiLine[$nameObj]['cols']."\" style=\"text-align: left;\">",$this->linesHtml[$key]['nivel']);
					if(strlen($this->textBoxMultiLine[$nameObj]['label'])>0){
						$this->e("<label>".$this->textBoxMultiLine[$nameObj]['label']."</label>",$this->linesHtml[$key]['nivel']);
					}	
					if($this->textBoxMultiLine[$nameObj]['focus']!==false){
						$this->textBoxMultiLine[$nameObj]['focus'] = " autofocus";
					}				
					$this->e("<textarea id=\"".$this->textBoxMultiLine[$nameObj]['name']."\" name=\"".$this->textBoxMultiLine[$nameObj]['name']."\" class=\"".$this->textBoxMultiLine[$nameObj]['class']."\" maxlength=\"".$this->textBoxMultiLine[$nameObj]['maxlen']."\"".$this->textBoxMultiLine[$nameObj]['disabled'].$this->textBoxMultiLine[$nameObj]['readOnly'].$this->textBoxMultiLine[$nameObj]['focus']." style=\"".$this->textBoxMultiLine[$nameObj]['styles'].$stylesB."\">".$this->textBoxMultiLine[$nameObj]['value']."</textarea>",$this->linesHtml[$key]['nivel']);
					$this->e("</div>",$this->linesHtml[$key]['nivel']);
				}
				if($typeObj=="button"){
					$br = "";
					if($this->button[$nameObj]['createLine']===true){
						$br = "<br><br>";
					}
					if($this->button[$nameObj]['disabled']===true){
						$this->button[$nameObj]['disabled'] = " disabled=\"disabled\"";
					}else{
						$this->button[$nameObj]['disabled'] = "";
					}
					$stylesTemp = "";
					if(strpos($this->button[$nameObj]['styles'],"@intop")!==false){
						$stylesTemp = str_replace("@intop","",$this->button[$nameObj]['styles']);
						$this->button[$nameObj]['styles'] = "";
					}
					$this->e("<div id=\"base".$this->button[$nameObj]['name']."\" name=\"base".$this->button[$nameObj]['name']."\" class=\"".$this->button[$nameObj]['cols']."\" style=\"".$stylesTemp."\">",$this->linesHtml[$key]['nivel']);
					if(strlen($this->button[$nameObj]['label'])>0){
						if($this->button[$nameObj]['label']===true){
							$this->button[$nameObj]['label'] = "";
						}
						$this->e("<label class=\"labelButton\">".$this->button[$nameObj]['label']."</label>",$this->linesHtml[$key]['nivel']);
					}
					$this->e($br."<button type=\"button\" id=\"".$this->button[$nameObj]['name']."\" name=\"".$this->button[$nameObj]['name']."\" class=\"".$this->button[$nameObj]['class']."\" align=\"center\" style=\"".$this->button[$nameObj]['styles']."\" ".$this->button[$nameObj]['java'].$this->button[$nameObj]['disabled'].">".$this->button[$nameObj]['value']."</button>",$this->linesHtml[$key]['nivel']);
					$this->e("</div>",$this->linesHtml[$key]['nivel']);
				}
				if($typeObj=="video"){	
					global $vW;
					#$ip = "https://192.168.1.5";
					#$ip = "https://localhost";
					#$ip = "https://192.168.1.75";
					#$ip = "https://192.168.0.102";
					#$ip = "192.168.1.135";
					$ip = $_SERVER['SERVER_NAME'];
					
					#<br>' + content + '".$this->video[$nameObj]['interface']."
					
					$this->e("
						<script type=\"text/javascript\">
							function beep() {
							  (new
								Audio(
									\"data:audio/wav;base64,//uQRAAAAWMSLwUIYAAsYkXgoQwAEaYLWfkWgAI0wWs/ItAAAGDgYtAgAyN+QWaAAihwMWm4G8QQRDiMcCBcH3Cc+CDv/7xA4Tvh9Rz/y8QADBwMWgQAZG/ILNAARQ4GLTcDeIIIhxGOBAuD7hOfBB3/94gcJ3w+o5/5eIAIAAAVwWgQAVQ2ORaIQwEMAJiDg95G4nQL7mQVWI6GwRcfsZAcsKkJvxgxEjzFUgfHoSQ9Qq7KNwqHwuB13MA4a1q/DmBrHgPcmjiGoh//EwC5nGPEmS4RcfkVKOhJf+WOgoxJclFz3kgn//dBA+ya1GhurNn8zb//9NNutNuhz31f////9vt///z+IdAEAAAK4LQIAKobHItEIYCGAExBwe8jcToF9zIKrEdDYIuP2MgOWFSE34wYiR5iqQPj0JIeoVdlG4VD4XA67mAcNa1fhzA1jwHuTRxDUQ//iYBczjHiTJcIuPyKlHQkv/LHQUYkuSi57yQT//uggfZNajQ3Vmz+ Zt//+mm3Wm3Q576v////+32///5/EOgAAADVghQAAAAA//uQZAUAB1WI0PZugAAAAAoQwAAAEk3nRd2qAAAAACiDgAAAAAAABCqEEQRLCgwpBGMlJkIz8jKhGvj4k6jzRnqasNKIeoh5gI7BJaC1A1AoNBjJgbyApVS4IDlZgDU5WUAxEKDNmmALHzZp0Fkz1FMTmGFl1FMEyodIavcCAUHDWrKAIA4aa2oCgILEBupZgHvAhEBcZ6joQBxS76AgccrFlczBvKLC0QI2cBoCFvfTDAo7eoOQInqDPBtvrDEZBNYN5xwNwxQRfw8ZQ5wQVLvO8OYU+mHvFLlDh05Mdg7BT6YrRPpCBznMB2r//xKJjyyOh+cImr2/4doscwD6neZjuZR4AgAABYAAAABy1xcdQtxYBYYZdifkUDgzzXaXn98Z0oi9ILU5mBjFANmRwlVJ3/6jYDAmxaiDG3/6xjQQCCKkRb/6kg/wW+kSJ5//rLobkLSiKmqP/0ikJuDaSaSf/6JiLYLEYnW/+kXg1WRVJL/9EmQ1YZIsv/6Qzwy5qk7/+tEU0nkls3/zIUMPKNX/6yZLf+kFgAfgGyLFAUwY//uQZAUABcd5UiNPVXAAAApAAAAAE0VZQKw9ISAAACgAAAAAVQIygIElVrFkBS+Jhi+EAuu+lKAkYUEIsmEAEoMeDmCETMvfSHTGkF5RWH7kz/ESHWPAq/kcCRhqBtMdokPdM7vil7RG98A2sc7zO6ZvTdM7pmOUAZTnJW+NXxqmd41dqJ6mLTXxrPpnV8avaIf5SvL7pndPvPpndJR9Kuu8fePvuiuhorgWjp7Mf/PRjxcFCPDkW31srioCExivv9lcwKEaHsf/7ow2Fl1T/9RkXgEhYElAoCLFtMArxwivDJJ+bR1HTKJdlEoTELCIqgEwVGSQ+hIm0NbK8WXcTEI0UPoa2NbG4y2K00JEWbZavJXkYaqo9CRHS55FcZTjKEk3NKoCYUnSQ 0rWxrZbFKbKIhOKPZe1cJKzZSaQrIyULHDZmV5K4xySsDRKWOruanGtjLJXFEmwaIbDLX0hIPBUQPVFVkQkDoUNfSoDgQGKPekoxeGzA4DUvnn4bxzcZrtJyipKfPNy5w+9lnXwgqsiyHNeSVpemw4bWb9psYeq//uQZBoABQt4yMVxYAIAAAkQoAAAHvYpL5m6AAgAACXDAAAAD59jblTirQe9upFsmZbpMudy7Lz1X1DYsxOOSWpfPqNX2WqktK0DMvuGwlbNj44TleLPQ+Gsfb+GOWOKJoIrWb3cIMeeON6lz2umTqMXV8Mj30yWPpjoSa9ujK8SyeJP5y5mOW1D6hvLepeveEAEDo0mgCRClOEgANv3B9a6fikgUSu/DmAMATrGx7nng5p5iimPNZsfQLYB2sDLIkzRKZOHGAaUyDcpFBSLG9MCQALgAIgQs2YunOszLSAyQYPVC2YdGGeHD2dTdJk1pAHGAWDjnkcLKFymS3RQZTInzySoBwMG0QueC3gMsCEYxUqlrcxK6k1LQQcsmyYeQPdC2YfuGPASCBkcVMQQqpVJshui1tkXQJQV0OXGAZMXSOEEBRirXbVRQW7ugq7IM7rPWSZyDlM3IuNEkxzCOJ0ny2ThNkyRai1b6ev//3dzNGzNb//4uAvHT5sURcZCFcuKLhOFs8mLAAEAt4UWAAIABAAAAAB4qbHo0tIjVkUU//uQZAwABfSFz3ZqQAAAAAngwAAAE1HjMp2qAAAAACZDgAAAD5UkTE1UgZEUExqYynN1qZvqIOREEFmBcJQkwdxiFtw0qEOkGYfRDifBui9MQg4QAHAqWtAWHoCxu1Yf4VfWLPIM2mHDFsbQEVGwyqQoQcwnfHeIkNt9YnkiaS1oizycqJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7 FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb//////////////////////////// /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=\"
								)).play();
							}
							function leituraOk(){
								beep();
								navigator.vibrate([500]);
							}
							function leituraNok(){
								navigator.vibrate([2000]);
							}
							function escondeBotao(){
								document.getElementById(\"habilitaCamera\").style.display = \"none\";
								document.getElementById(\"basePreview\").style.display = \"block\";
								document.getElementById(\"qrCodeResult\").style.display = \"block\";
							}
						</script>
						<div id=\"habilitaCamera\" align=\"center\" class=\"bigButton\" onclick=\"leituraOk();escondeBotao()\">Habilita Camera</div>
					",$this->linesHtml[$key]['nivel']);#leituraOk();
					$this->e("
						<script type=\"text/javascript\" src=\"".$PATH."../RCD_7/instascan/adapter.min.js\"></script>
						<script type=\"text/javascript\" src=\"".$PATH."../RCD_7/instascan/vue.min.js\"></script>
						<script type=\"text/javascript\" src=\"".$PATH."../RCD_7/instascan/instascan.min.js\"></script>
						<div id=\"basePreview\" style=\"".$this->video[$nameObj]['styles']."border:10px;border-style:solid;border-color:".COLOR_RED.";width:".$vW.";display:none;\">
							<video id=\"preview\" class=\"".$this->video[$nameObj]['class']."\"></video>
						</div>
						<script type=\"text/javascript\">
							var contAguarde = 0;
							var lendo = 0;	
									
							setInterval(function(){
								if(lendo==1 && contAguarde<4){
									contAguarde++;
								}else if(lendo==1){
									lendo = 2;
									contAguarde++;
									document.getElementById('basePreview').style.border = '10px solid ".COLOR_YELLOW."';
									document.getElementById('qrCodeResult').style.border = '10px solid ".COLOR_YELLOW."';
									document.getElementById('qrCodeResult').style.backgroundColor = '".COLOR_YELLOW."';
									document.getElementById('qrCodeResult').innerHTML = '<span style=\"color:".COLOR_BLACK."\">Desculpe-nos a Demora!<br>Aguarde Carregando...</span>';
								}else if(lendo==2 && contAguarde<10){
									contAguarde++;	
								}else if(lendo==2){
									lendo = 0;
									document.getElementById('basePreview').style.border = '10px solid ".COLOR_BLUE."';
									document.getElementById('qrCodeResult').style.border = '10px solid ".COLOR_BLUE."';
									document.getElementById('qrCodeResult').style.backgroundColor = '".COLOR_BLUE."';
									document.getElementById('qrCodeResult').innerHTML = '<span style=\"color:".COLOR_WHITE."\">Por Favor, Leia o QR Code Novamente!</span>';
								}else{
									lendo = 0;
									contAguarde = 0;
								}
							},1000);
									
							let scanner = new Instascan.Scanner(
								{
									video: document.getElementById('preview')
								}
							);
							scanner.addListener('scan', function(content) {
								lendo = 1;
								document.getElementById('basePreview').style.border = '10px solid ".COLOR_GREEN."';
								content = content.replace(\"@\",\"$\");
								content = content.replace(\"http://localhost:8090\",\"\");
								content = content.replace(\"http://168.194.229.222:8090\",\"\");
								content = content.replace(\"/PROFIABLE/PROFIABLE/M/qrcode.php?crc=\",\"\");
								document.getElementById('qrCodeResult').style.border = '10px solid ".COLOR_BLUE."';
								document.getElementById('qrCodeResult').style.backgroundColor = '".COLOR_BLUE."';
								document.getElementById('qrCodeResult').innerHTML = '<span style=\"color:".COLOR_WHITE."\">Aguarde Carregando...</span>';
								document.getElementById('objCorebasePreview0').src = 'https://".$ip."/PROFIABLE/PROFIABLE/M/qrcode.php?crc=' + content + '".$this->video[$nameObj]['interface'].$this->video[$nameObj]['addParam']."';
							});
							Instascan.Camera.getCameras().then(cameras => 
							{
								if(cameras.length > 0){
									scanner.start(cameras[".$this->video[$nameObj]['device']."]);
								}else{
									alert('Erro'); 
								}
							});
							example1();
						</script>
						<div id=\"baseDigitarCode\" align=\"center\" style=\"\">
							<b><span style=\"font-size:24px\"><br>Digite Aqui o Código</span></b><br>
							<input type=\"text\" id=\"tbDigitarCode\" class=\"textBox\" style=\"text-align:center;width:280px;margin-bottom:5px\"/><br>
							<div id=\"btEnviarCodeDigitado\" class=\"bigButton btGreen\">Enviar Código</div><br><br>
						</div>
						<div id=\"qrCodeResult\" class=\"classQrCodeResult\" style=\"display:none;\"></div>
					",$this->linesHtml[$key]['nivel']);
					$this->java->setGoToPage("click", "btEnviarCodeDigitado", $PATH."qrcode.php","CODE_DIGITADO",false,"","@".$PAGENAME,"","tbDigitarCode","objCorebasePreview0");
				}
				if($this->withoutCell===true && strpos($this->linesHtml[$key]['html'],"<tr")===false && strpos($this->linesHtml[$key]['html'],"</tr")===false && strpos($this->linesHtml[$key]['html'],"td")===false && strpos($this->linesHtml[$key]['html'],"div")===false && $typeObj!="button"){
					$this->e("</div>",$this->linesHtml[$key]['nivel']);
				}
			}else{
				if($this->withoutCell===true && strpos($this->linesHtml[$key]['html'],"<tr")===false && strpos($this->linesHtml[$key]['html'],"</tr")===false && strpos($this->linesHtml[$key]['html'],"td")===false && strpos($this->linesHtml[$key]['html'],"div")===false && strpos($this->linesHtml[$key]['html'],"msgInfo")===false){
					if(0){
						$borda = "border:1px;border-style:solid;";
					}else{
						$borda = "";
					}
					$this->e("<div style=\"float:left;margin-right:20px;min-height:60px;".$borda."\">",$this->linesHtml[$key]['nivel']);
					#$this->e("<div style=\"float:left;margin-right:20px;margin-bottom:5px;border:1px;border-style:solid;\">",$this->linesHtml[$key]['nivel']);
				}
				if(isset($this->linesHtml[$key]['newLine'])){
					if(@$this->linesHtml[$key]['newLine']!=0){
						$this->linesHtml[$key]['newLine'] = 1;
					}
				}else{
					$this->linesHtml[$key]['newLine'] = 1;
				}
				$this->e($this->linesHtml[$key]['html'],$this->linesHtml[$key]['nivel'],$this->linesHtml[$key]['newLine']);
			}
		}
		$this->endObj($this->name);
		#$this->e("</table>",$this->nivel);
		$this->e($this->outSideTableText,$this->nivel);
	}
}