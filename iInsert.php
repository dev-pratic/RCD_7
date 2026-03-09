<?php
# Insert :: DataBase
class iInsert extends generic {
	private $dataSet;
	private $columns = array();
	private $values = array();
	private $Check = array();
    private $newId;
    private $idMultiInsert = false;
    private $mysqli;
    private $numRows;
    private $sql = "INSERT INTO";
	
	function __construct($dataSet,$table,$filial=true){
		global $page;
		global $_SECURITY;
		global $_ROUTE;
		global $_SRV;

		$this->dataSet = $dataSet;
		$this->table = $table;

		if(isset($_SECURITY[0])){
			if(isset($_SECURITY[0]['autoFilial'])){
				if($_SECURITY[0]['autoFilial']!==true && $filial!="forced"){
					$filial = false;
				}
			}
		}

		if($filial===true || $filial=="forced"){
			//$this->insert("filial",$page->session->getLoginFilial());
		}
	}
	
	public function exe($execute=true){
		global $_READONLY;
		global $_ROUTE;
		global $_SRV;
		global $_SECURITY;

		$this->dataSet->restoreSeg();
		if(isset($_ROUTE[$this->table])){
			if(isset($_SRV[$_ROUTE[$this->table]])){
				$this->dataSet->setConnection(
					$_SRV[$_ROUTE[$this->table]]['host'],
					$_SRV[$_ROUTE[$this->table]]['user'],
					$_SRV[$_ROUTE[$this->table]]['pass'],
					$_SRV[$_ROUTE[$this->table]]['base'],
					$_SRV[$_ROUTE[$this->table]]['port']
				);
			}
		}

		if(!isset($_READONLY)){
			$_READONLY = false;
		}

		if($_READONLY===true){
			$this->dataSet->setError("SISTEMA TRAVADO EM SOMENTE LEITURA");
			return false;
		}else{
			if($this->dataSet->sqlServer===true){
				$gateColumnID = true;
				for($i=0;$i<count($this->columns);$i++){
					if($this->table."_ID"==$this->columns[$i]){
						$gateColumnID = false;
					}
				}

				if($this->table=="DOCUMENTOSCAMPOSVALORES"){
					$gateColumnID = false;
					
					/*$sel = new iSelect($this->dataSet,"DOCUMENTOSCAMPOSVALORES",false);
					$sel->columns("DCV_ID");
					$sel->limit(1);
					$sel->order("DCV_ID","DESC");

					if($sel->exe()!==false){
						$row = $sel->read();

						$this->set("DCV_ID",($row["DCV_ID"]+1));
					}*/

					$sel = new iSelect($this->dataSet,"DOCUMENTOSCAMPOSVALORES",false);
					$sel->fast();
					$sel->setSql("SELECT MAX(DCV_ID) AS DCV_ID FROM DOCUMENTOSCAMPOSVALORES;");
					
					if($sel->exe(false,true)!==false){
						$row = $sel->read();
	
						$this->set("DCV_ID",($row["DCV_ID"]+1));
					}
				}

				if($this->table=="PARTICIPANTESCAMPOSVALORES"){
					$gateColumnID = false;
					
					/*$sel = new iSelect($this->dataSet,"PARTICIPANTESCAMPOSVALORES",false);
					$sel->columns("PVC_ID");
					$sel->limit(1);
					$sel->order("PVC_ID","DESC");

					if($sel->exe()!==false){
						$row = $sel->read();

						$this->set("PVC_ID",($row["PVC_ID"]+1));
					}*/

					$sel = new iSelect($this->dataSet,"PARTICIPANTESCAMPOSVALORES",false);
					$sel->fast();
					$sel->setSql("SELECT MAX(PVC_ID) AS PVC_ID FROM PARTICIPANTESCAMPOSVALORES;");
					
					if($sel->exe(false,true)!==false){
						$row = $sel->read();
	
						$this->set("PVC_ID",($row["PVC_ID"]+1));
					}
				}

				if($this->table=="DOCUMENTOSITENSCAMPOSVALORES"){
					$gateColumnID = false;
					
					/*$sel = new iSelect($this->dataSet,"DOCUMENTOSITENSCAMPOSVALORES",false);
					$sel->columns("DIV_ID");
					$sel->limit(1);
					$sel->order("DIV_ID","DESC");

					if($sel->exe()!==false){
						$row = $sel->read();

						$this->set("DIV_ID",($row["DIV_ID"]+1));
					}*/

					$sel = new iSelect($this->dataSet,"DOCUMENTOSITENSCAMPOSVALORES",false);
					$sel->fast();
					$sel->setSql("SELECT MAX(DIV_ID) AS DIV_ID FROM DOCUMENTOSITENSCAMPOSVALORES;");
					
					if($sel->exe(false,true)!==false){
						$row = $sel->read();
	
						$this->set("DIV_ID",($row["DIV_ID"]+1));
					}
				}

				if($gateColumnID===true){
					if(isset($_SECURITY)){
						if(isset($_SECURITY[1])){	
							if(isset($_SECURITY[1]['hostB'])){
								/*$idsb = new iDataBase("iDataSetColumnID");
								$idsb->setConnection($_SECURITY[1]['hostB'],$_SECURITY[1]['userB'],$_SECURITY[1]['passB'],$_SECURITY[1]['baseB'],$_SECURITY[1]['portB']);*/

								/*$sel = new iSelect($this->dataSet,$this->table,false);
								$sel->columns($this->table."_ID");
								$sel->limit(1);
								$sel->order($this->table."_ID","DESC");

								if($sel->exe()!==false){
									$row = $sel->read();

									$this->set($this->table."_ID",($row[$this->table."_ID"]+1));
								}*/

								$sel = new iSelect($this->dataSet,$this->table,false);
								$sel->fast();
								$sel->setSql("SELECT MAX(".$this->table."_ID) AS ".$this->table."_ID FROM ".$this->table.";");
								
								if($sel->exe(false,true)!==false){
									$row = $sel->read();

									$this->set($this->table."_ID",($row[$this->table."_ID"]+1));
									$this->newId = ($row[$this->table."_ID"]+1);
								}
							}
						}
					}
				}
			}

			if($this->idMultiInsert===false){
				$this->sql .= " ".$this->table." (";
				for($i=0;$i<count($this->columns);$i++){
					if($i>0){
						$this->sql .= ",";
					}
					$this->sql .= $this->columns[$i];
				}
				$this->sql .= ") VALUES (";
				for($i=0;$i<count($this->values);$i++){
					if($this->Check[$i]===true && $this->values[$i]==""){
						$this->values[$i] = 0;
					}
					if($this->Check[$i]>0){
						if(strlen($this->values[$i])>$this->Check[$i]){
							$this->values[$i] = substr($this->values[$i], 0, $this->Check[$i]);
						}
					}
					if($i>0){
						$this->sql .= ",";
					}
					if($this->values[$i]=="" && $this->values[$i]!="0"){
						$this->sql .= "NULL";
					}else{
						$this->sql .= "'".$this->values[$i]."'";
					}
				}
				$this->sql .= ")";
			}else{
				$this->sql .= " ".$this->table." (";
				foreach ($this->columns as $key => $value){
					for($i=0;$i<count($value);$i++){
						if($i>0){
							$this->sql .= ",";
						}
						$this->sql .= $value[$i];
					}
					break;
				}
				$this->sql .= ") VALUES ";
				$first = 1;
				
				foreach ($this->columns as $key => $value){
					if($first==1){
						$first = 0;
						$this->sql .= "(";
					}else{
						$this->sql .= ",(";
					}
					for($i=0;$i<count($this->values[$key]);$i++){
						if($this->Check[$key][$i]===true && $this->values[$key][$i]==""){
							$this->values[$key][$i] = 0;
						}
						if($this->Check[$key][$i]>0){
							if(strlen($this->values[$key][$i])>$this->Check[$key][$i]){
								$this->values[$key][$i] = substr($this->values[$key][$i], 0, $this->Check[$key][$i]);
							}
						}
						if($i>0){
							$this->sql .= ",";
						}
						$this->sql .= "'".$this->values[$key][$i]."'";
					}
					$this->sql .= ")";
				}
			}
			if($execute===true){
				if($this->dataSet->sqlServer===false){
					$this->mysqli = $this->dataSet->connect();
					if($this->mysqli===false){
						return false;
					}else{
						@$this->res = $this->mysqli->query($this->sql);
						if($this->res===false){
							$this->dataSet->setError("(".$this->mysqli->errno.") ".$this->mysqli->error."<br><br>{ ".$this->sql." }");
							return false;
						}else{
							$this->numRows = $this->mysqli->affected_rows;
							$this->newId = $this->mysqli->insert_id;
							return true;
						}
					}
				}else{
					$this->res = $this->dataSet->exeQuery($this->sql);
					if($this->res===false){
						return false;
					}else{
						$this->numRows = sqlsrv_num_rows($this->res);
						return $this->res;
					}
				}
			}
		}
	}
	public function set($column,$value,$check=false,$multiInsert=false){
		$this->insert($column,$value,$check,$multiInsert);
	}
	public function insert($column,$value,$check=false,$multiInsert=false){
		$value = addslashes($value);
		if(strlen($column)>0){
			if($multiInsert===false){
				$searched = false;
				foreach($this->columns as $k => $v){
					if($v==$column){
						$searched = true;
					}
				}
				if($searched===false){
					$idColumn = count($this->columns);
					$this->columns[$idColumn] = $column;
					$this->values[$idColumn] = $value;
					$this->Check[$idColumn] = $check;
				}
			}else{
				if(!isset($this->columns[$this->idMultiInsert])){
					$this->columns[$this->idMultiInsert] = array();
				}
				$searched = false;
				foreach($this->columns[$this->idMultiInsert] as $k => $v){
					if($v==$column){
						$searched = true;
					}
				}
				if($searched===false){
					$idColumn = count($this->columns[$this->idMultiInsert]);
					$this->columns[$this->idMultiInsert][$idColumn] = $column;
					$this->values[$this->idMultiInsert][$idColumn] = $value;
					$this->Check[$this->idMultiInsert][$idColumn] = $check;
				}
			}
		}
	}
	
	public function getNewId(){
		return $this->newId;
	}
	
	public function getNumRows(){
		return $this->numRows;
	}
	
	public function getSql($access=false){
		global $REPORTING_ERROR;
		global $page;
	
		if(($REPORTING_ERROR==1 && $page->session->getLoginTipo()==2) || $page->session->getLoginTipo()==2 || $access===true){
			return $this->sql;
		}else{
			return null;
		}
	}
	
	public function setMultiInsert($id){
		$this->idMultiInsert = $id;
	}
}
