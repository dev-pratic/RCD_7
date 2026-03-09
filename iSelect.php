<?php
$countSelect = 0;

# Select :: DataBase
class iSelect extends generic {
	private $column = array();
	private $columnB = "";
	private $columnBlock = false;
	private $where = false;
	private $gateWhere = false;
	private $operator;
	private $value;
	private $And = array();
	private $between = array();
    private $or = array();
	private $res;
    private $tableJoin = array();
    private $whereJoin = array();
    private $valueJoin = array();
    private $operatorJoin = array();
    private $typeJoin = array();
    private $dataBaseJoin = array();
    private $like = array();
    private $columnJoin = array();
	
	private $tableJoinB = array();
    private $whereJoinB = array();
    private $valueJoinB = array();
    private $operatorJoinB = array();
    private $typeJoinB = array();
    private $dataBaseJoinB = array();
	private $tableAsB = array();

    private $order = array();
    private $orderType = array();
    private $offSet = 0;
    private $limit = 1000;
    private $rand;
    private $withQuotation = false;
    private $orTable = array();
    private $as = array();
    private $tableAs = array();
    private $min = array();
    private $minAs = array();
    private $max = array();
    private $maxAs = array();
    private $multiplyColumnA = array();
    private $multiplyColumnB = array();
    private $multiplyAs = array();
    private $sumColumnA = array();
    private $sumColumnB = array();
    private $sumAs = array();
    private $divColumnA = array();
    private $divColumnB = array();
    private $divAs = array();
    private $expression = array();
    public $expressionPastWhere = array();
    private $group = array();
    private $orderTable;
    private $binary = false;
    private $dataSet;
    private $mysqli;
    private $numRows;
    private $listColumn = false;
    private $listDb = false;
    private $listTable = false;
    private $row = false;
    private $whereTable = false;
	private $nolock = false;
	private $timeFlush = 0;
	private $updateFlush = false;
	private $readFlush = false;
	private $rowFlush = array();
	private $insertFlush = false;
	private $execute = true;
	private $countFlush = 0;
	private $hashSqlFlush = false;
	private $timeStart = 0;
	private $timeEnd = 0;
	private $nameSelect = "";
	public $analise = false;
	
	function __construct($dataSet,$table=false,$filial=true,$nolock=false,$timeFlush=0,$nameSelect="",$analise=false){
		global $page;
		global $_SECURITY;
		global $countSelect;

		$countSelect++;

		$this->dataSet = $dataSet;
		$this->analise = $analise;
		$this->table = $table;
		$this->nolock = $nolock;
		$this->timeFlush = 0;//$timeFlush;
		if(strlen($nameSelect)>0){
			$this->nameSelect = $nameSelect."_".$countSelect;
		}else{
			$this->nameSelect = $countSelect;
		}

		if(isset($_SECURITY[0])){
			if(isset($_SECURITY[0]['autoFilial'])){
				if($_SECURITY[0]['autoFilial']!==true){
					$filial = false;
				}
			}
		}

		if($filial===true){
			if($table!==false){
				$this->setAnd($table.".filial","=",$page->session->getLoginFilial());
			}else{
				$this->setAnd("filial","=",$page->session->getLoginFilial());
			}
		}
	}

	public function setSql($sql){
		$this->sql = $sql;
	}	

	public function fast(){
		$this->dataSet->fast();
	}
	
	public function expression($expression){
		$id = count($this->expression);
		$this->expression[$id] = $expression;
	}
	
	public function group($columns,$tables=false){
		$this->group = explode(",",$columns);
		if($tables===false){
			$this->groupTable = explode(",",$this->table);
		}else{
			$this->groupTable = explode(",",$tables);
		}
	}
	
	public function setAnd($column,$operator,$value="",$withQuotation=false,$table=false,$binary=false){
		if($table){
			$table .= ".";
		}else{
			$table = "";
		}
	
		if($binary===true){
			$table = "BINARY ".$table;
		}
	
		if($withQuotation===false){
			$this->And[count($this->And)] = $table.$column.$operator.$value;
		}else{
			$this->And[count($this->And)] = $table.$column.$operator."'".$value."'";
		}
	}
	
	public function between($column,$dateA,$dateB,$mode=false,$table=false){
		if($table){
			$table .= ".";
		}
		if($this->stringToUpper($mode)=="TIMESTAMP"){
			$dateA = date("Y-m-d H:i:s",$dateA);
			$dateB = date("Y-m-d H:i:s",$dateB);
		}
		$this->between[count($this->between)] = " AND ".$table.$column." BETWEEN '".$dateA."' AND '".$dateB."'";
	}
	
	public function sum($columnA,$columnB=false,$table=false,$as=false){
		$id = count($this->sumColumnA);
		if($table!==false){
			$columnA = $table.".".$columnA;
			if($columnB!==false){
				$columnB = $table.".".$columnB;
			}
		}
		$this->sumColumnA[$id] = $columnA;
		$this->sumColumnB[$id] = $columnB;
		$this->sumAs[$id] = $as;
	}

	public function multiply($columnA,$columnB,$table=false,$as=false){
		$id = count($this->multiplyColumnA);
		if($table!==false){
			$columnA = $table.".".$columnA;
			$columnB = $table.".".$columnB;
		}
		$this->multiplyColumnA[$id] = $columnA; 
		$this->multiplyColumnB[$id] = $columnB;
		$this->multiplyAs[$id] = $as;
	}
	
	public function columns($columns){
		if($columns!==false){
			$this->column = explode(",",$columns);

			foreach($this->column as $kF => $vF){
				if(strlen($this->columnB)>0){
					$this->columnB .= ",";
				}
				$this->columnB .= "@".$vF."#";
			}
		}else{
			$this->columnBlock = true;
		}
	}
	
	public function columnsJoin($columns,$table,$as=""){
		if($columns!==false){
			$this->columnJoin[$table] = explode(",",$columns);
		}else{
			$this->columnJoin[$table] = $columns;
		}
		$this->as[$table] = explode(",",$as);
	}
	
	public function exe($teste=false,$gateSql=false){
		global $GET_SELECT_TIME;
		global $_ROUTE;
		global $_SRV;
		global $VERSION_PHP;

		$this->gateWhere = false;
		$this->execute = true;

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

		if($GET_SELECT_TIME===true){
			$this->timeStart = microtime_float();
		}

		if($gateSql===false){
			$this->sql = "SELECT ";
			if($this->listColumn===true){
				if($this->dataSet->sqlServer===false){
					$this->sql = "SHOW COLUMNS ";
				}else{
					$this->sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='";
					$this->gateWhere = true;
				}
			}else if($this->listDb===true){
				$this->sql = "SHOW DATABASES";
			}else if($this->listTable===true){
				if($this->dataSet->sqlServer===false){
					$this->sql = "SHOW TABLES";
				}else{
					$this->sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES";
				}
			}else{
				if(count($this->column)==0){
					if($this->columnBlock===false){
						$this->sql .= $this->table.".*";
					}
				}else{
					$delimiter = "";
					foreach($this->column as $key => $value){
						$this->sql .= $delimiter.$this->table.".".$value;
						$delimiter = ",";
					}
				}
				if(count($this->tableJoin)){
					if(count($this->columnJoin)==0){
						foreach($this->tableJoin as $key => $value){
							if($value!==false){
								$delimiter = "";
								if($this->sql!="SELECT "){
									$delimiter = ",";
								}
								$this->sql .= $delimiter.$value.".*";
							}
						}
					}else{
						foreach($this->tableJoin as $keyA => $valueA){
							$delimiter = ",";
							if($this->tableAs[$keyA]!=""){
								if($this->dataBaseJoin[$keyA]===false){
									foreach($this->columnJoin[$this->tableAs[$keyA]] as $keyB => $valueB){
										$delimiter = "";
										if($this->sql!="SELECT "){
											$delimiter = ",";
										}
										$this->sql .= $delimiter.$this->tableAs[$keyA].".".$valueB;
										if(@$this->as[@$this->tableAs[$keyA]][$keyB]!=""){
											$this->sql .= " AS ".$this->as[$this->tableAs[$keyA]][$keyB];
										}
									}
								}else{
									foreach($this->columnJoin[$this->tableAs[$keyA]] as $keyB => $valueB){
										$delimiter = "";
										if($this->sql!="SELECT "){
											$delimiter = ",";
										}
										if(@$this->as[@$this->tableAs[$keyA]][$keyB]!=""){
											if(strpos($this->columnB,"@".$this->as[$this->tableAs[$keyA]][$keyB]."#")===false){
												$this->sql .= $delimiter."'' AS ".$this->as[$this->tableAs[$keyA]][$keyB];
											}
										}else{
											if(strpos($this->columnB,"@".$valueB."#")===false){
												$this->sql .= $delimiter."'' AS ".$valueB;
											}
										}
									}
								}
							}else{
								if(isset($this->columnJoin[$valueA])){
									if($this->columnJoin[$valueA]!==false){
										if($this->dataBaseJoin[$keyA]===false){
											foreach($this->columnJoin[$valueA] as $keyB => $valueB){
												$delimiter = "";
												if($this->sql!="SELECT "){
													$delimiter = ",";
												}
												$this->sql .= $delimiter.$valueA.".".$valueB;
												if(@$this->as[$valueA][$keyB]!=""){
													$this->sql .= " AS ".$this->as[$valueA][$keyB];
												}
											}
										}else{
											foreach($this->columnJoin[$valueA] as $keyB => $valueB){
												$delimiter = "";
												if($this->sql!="SELECT "){
													$delimiter = ",";
												}
												
												if(@$this->as[$valueA][$keyB]!=""){
													$this->sql .= $delimiter."'' AS ".$this->as[$valueA][$keyB];
												}else{
													$this->sql .= $delimiter."'' AS ".$valueB;
												}
											}
										}
									}
								}
							}
						}
						if(count($this->columnJoin)>0){
							foreach ($this->columnJoin as $keyE => $valueE){
								if(strpos($keyE, ",")!==false){
									$tempTable = explode(",", $keyE);
									foreach($this->columnJoin[$keyE] as $keyF => $valueF){
										$this->sql .= $delimiter.$tempTable[$keyF].".".$valueF;
										if(@$this->as[$keyE][$keyF]!=""){
											$this->sql .= " AS ".$this->as[$keyE][$keyF];
										}
									}
								}
							}
						}
					}
				}
				
				if(count($this->min)){
					foreach ($this->min as $keyD => $valueD){
						$this->sql .= ",MIN(".$valueD.")";
						if($this->minAs[$keyD]!==false){
							$this->sql .= " AS ".$this->minAs[$keyD];
						}
					}
				}
				if(count($this->max)){
					foreach ($this->max as $keyD => $valueD){
						$this->sql .= ",MAX(".$valueD.")";
						if($this->maxAs[$keyD]!==false){
							$this->sql .= " AS ".$this->maxAs[$keyD];
						}
					}
				}
				if(count($this->multiplyColumnA)){
					foreach ($this->multiplyColumnA as $keyD => $valueD){
						$this->sql .= ",(".$this->multiplyColumnA[$keyD]."*".$this->multiplyColumnB[$keyD].")";
						if($this->multiplyAs[$keyD]!==false){
							$this->sql .= " AS ".$this->multiplyAs[$keyD];
						}
					}
				}
				if(count($this->sumColumnA)){
					foreach ($this->sumColumnA as $keyD => $valueD){
						if($this->sumColumnB[$keyD]!==false){
							$this->sql .= ",(".$this->sumColumnA[$keyD]."+".$this->sumColumnB[$keyD].")";
						}else{
							$this->sql .= ",SUM(".$this->sumColumnA[$keyD].")";
						}
						if($this->sumAs[$keyD]!==false){
							$this->sql .= " AS ".$this->sumAs[$keyD];
						}
					}
				}
				if(count($this->divColumnA)){
					foreach ($this->divColumnA as $keyD => $valueD){
						$this->sql .= ",(".$this->divColumnA[$keyD]."/".$this->divColumnB[$keyD].")";
						if($this->divAs[$keyD]!==false){
							$this->sql .= " AS ".$this->divAs[$keyD];
						}
					}
				}
				if(count($this->expression)){
					foreach ($this->expression as $keyD => $valueD){
						$delimiter = "";
						if($this->sql!="SELECT "){
							$delimiter = ",";
						}
						$this->sql .= $delimiter.$this->expression[$keyD];
					}
				}
			}
			if($this->listDb===false && $this->listTable===false){
				if($this->listColumn===true){
					if($this->dataSet->sqlServer===false){
						$this->sql .= " FROM ".$this->table;
					}else{
						$this->sql .= $this->table."'";
					}
				}else{
					$this->sql .= " FROM ".$this->table.($this->nolock ? " (NOLOCK)" : "");
				}
			}
			$tempA = "";
			if(count($this->tableJoin)){
				foreach($this->tableJoin as $key => $value){
					if($this->dataBaseJoin[$key]===false){
						if($this->tableAs[$key]!=""){
							$this->sql .= " ".$this->typeJoin[$key]." JOIN ".$value.($this->nolock ? " (NOLOCK)" : "")." AS ".$this->tableAs[$key]." ON ".$this->tableAs[$key].".".$this->whereJoin[$key].$this->operatorJoin[$key].$this->valueJoin[$key];
						}else{
							$this->sql .= " ".$this->typeJoin[$key]." JOIN ".$value.($this->nolock ? " (NOLOCK)" : "")." ON ".$value.".".$this->whereJoin[$key].$this->operatorJoin[$key].$this->valueJoin[$key];
						}
						if(strlen($tempA)>0){
							$tempA .= ",";
						}
						$tempA .= $value;
					}
				}
			}
	
			if($this->where){
				if($this->binary===true){
					$binary = "BINARY ";
				}else{
					$binary = "";
				}
				if($this->listColumn===false){
					$table = "";
					if(strlen($this->table)==0){
						$table = $this->table;
					}else if($this->whereTable!==false){
						if(strlen($this->whereTable)>0){
							$table = $this->whereTable.".";
						}
					}else{
						if($this->where!==false && $this->where!==true){
							$table = $this->table.".";
						}
					}
					if($this->withQuotation===false){
						$this->sql .= " WHERE ".$binary.$table.$this->where.$this->operator.$this->value;
					}else{
						$this->sql .= " WHERE ".$binary.$table.$this->where.$this->operator."'".$this->value."'";
					}
					$this->gateWhere = true;
				}else{
					if($this->withQuotation===false){
						$this->sql .= " WHERE ".$this->where.$this->operator.$this->value;
					}else{
						$this->sql .= " WHERE ".$this->where.$this->operator."'".$this->value."'";
					}
					$this->gateWhere = true;
				}
			}else if($this->listDb===false && $this->listTable===false && count($this->like)==0){
				if($this->dataSet->sqlServer===false){
					$this->sql .= " WHERE 1";
					$this->gateWhere = true;
				}
			}
			if(count($this->like)>0){
				if($this->gateWhere){
					for($i=0;$i<count($this->like);$i++){
						if($i==0){
							$this->sql .= " AND (";
							$this->sql .= $this->like[$i];
						}else{
							$this->sql .= " OR ".$this->like[$i];
						}
					}
					$this->sql .= ")";
				}else{
					for($i=0;$i<count($this->like);$i++){
						if($i==0){
							$this->gateWhere = true;
							$this->sql .= " WHERE (";
							$this->sql .= $this->like[$i];
						}else{
							$this->sql .= " OR ".$this->like[$i];
						}
					}
					$this->sql .= ")";
				}
			}
			if(count($this->And)>0){
				for($i=0;$i<count($this->And);$i++){
					if($this->gateWhere){
						$this->sql .= " AND ".$this->And[$i];
					}else{
						if($i==0){
							$this->gateWhere = true;
							$this->sql .= " WHERE ".$this->And[$i];
						}else{
							$this->sql .= " AND ".$this->And[$i];
						}
					}
				}
			}
			if($this->offSet>0){
				#$this->sql .= " AND ROWNUM >= 0";#.$this->offSet;
			}
			for($i=0;$i<count($this->expressionPastWhere);$i++){
				$this->sql .= " ".$this->expressionPastWhere[$i];
			}
			for($i=0;$i<count($this->between);$i++){
				$this->sql .= $this->between[$i];
			}
			if($this->or){
				$this->sql .= " AND ( ";
				for($i=0;$i<count($this->or);$i++){
					$table = false;
					if($this->orTable[$i]!==false){
						$table = $this->orTable[$i];
					}
					if($table!==false){
						$table .= ".";
					}
					if($i==0){
						$this->sql .= $table.$this->or[$i];
					}else{
						$this->sql .= " OR ".$table.$this->or[$i];
					}
				}
				$this->sql .= ")";
			}
			# Sistema de Agrupamento
			if(count($this->group)>0){
				$columnsAndTables = "";
				foreach ($this->group as $keyC => $valueC){
					if(strlen($columnsAndTables)>0){
						$columnsAndTables .= ",";
					}
					$columnsAndTables .= $this->groupTable[$keyC].".".$this->group[$keyC];
				}
				$this->sql .= " GROUP BY ".$columnsAndTables;
			}
			# Fim - Sistema de Agrupamento
			# Sistema de Ordenação
			if($this->orderTable===false && $this->orderTable!=""){
				$orderTable = $this->table;
			}else if($this->orderTable!=""){
				$orderTable = $this->orderTable;
			}else{
				$orderTable = "";
			}
			if($orderTable=="" && isset($this->order[0]) && isset($this->orderType[0])){
				$columnsAndTables = $this->order[0]." ".$this->orderType[0];
			}else{
				if(count($this->order)>1){
					foreach ($this->order as $keyC => $valueC){
						if(!isset($orderTable[$keyC])){
							$orderTable[$keyC] = $orderTable[0];
						}
						if(isset($columnsAndTables)){
							$columnsAndTables .= ",";
						}else{
							$columnsAndTables = "";
						}
						if(count($this->orderType)>1){
							$columnsAndTables .= $orderTable[$keyC].".".$this->order[$keyC]." ".$this->orderType[$keyC];
						}else{
							$columnsAndTables .= $orderTable[$keyC].".".$this->order[$keyC]." ".$this->orderType[0];
						}
					}
				}else if(count($this->order)==1){
					$columnsAndTables = $orderTable[0].".".$this->order[0]." ".$this->orderType[0];
				}
			}
			if($this->order && !$this->rand){
				$this->sql .= " ORDER BY ".$columnsAndTables;
			}
			if($this->rand && $this->order){
				$this->sql .= " ORDER BY ".$columnsAndTables.",rand()";
			}
			if($this->rand && !$this->order){
				$this->sql .= " ORDER BY rand()";
			}
			# Fim - Sistema de Ordenação
			if($this->limit!==false && $this->listColumn===false && $this->listDb===false && $this->listTable===false){
				if($this->dataSet->sqlServer===false){
					$this->sql .= " LIMIT ".$this->offSet.",".$this->limit;
				}else{
					if($this->offSet==0){
						if(strpos($this->sql,"TOP")===false || strpos($this->sql,"TOP")!=7){
							$this->sql = "SELECT TOP(".$this->limit.") ".substr($this->sql,6);
							//$this->sql = str_replace("SELECT", "SELECT TOP ".$this->limit, $this->sql);
						}
					}else{
						$this->sql .= " OFFSET ".$this->offSet." ROWS FETCH NEXT ".$this->limit." ROWS ONLY";
					}
				}
			}
	
			$this->countFlush = 0;
			$this->rowFlush = array();
	
			if($this->timeFlush>0){
				global $idsa;
	
				$this->hashSqlFlush = hash("sha256",$this->sql);
	
				$sel = new iSelect($idsa,"sistema_flush");
				$sel->where("hashSql","=",$this->hashSqlFlush,true);
	
				if($sel->exe()!==false){
					if($sel->getNumRows()==0){
						$this->insertFlush = true;
					}else{
						$row = $sel->read();
	
						if((time()-$row['dataModificacao'])>=$this->timeFlush){
							$this->updateFlush = true;
						}else{
							$this->rowFlush = json_decode($row['result'],true);
							$this->res = $row['res'];
							$this->numRows = $row['numRows'];
							$this->execute = false;
						}
					}
				}
			}
	
			#### ANALISE ###
			//if($this->analise===false){
			/*if($this->analise===false && $this->dataSet->sqlServer===true){
				global $_SECURITY;
	
				if(isset($_SECURITY)){
					if(isset($_SECURITY[1])){	
						if(isset($_SECURITY[1]['host'])){
							$idsa = new iDataBase("iDataSetS");
							$idsa->setConnection($_SECURITY[1]['host'],$_SECURITY[1]['user'],$_SECURITY[1]['pass'],$_SECURITY[1]['base'],$_SECURITY[1]['port']);
	
							$arquivo = substr($_SERVER['SCRIPT_FILENAME'],26);
	
							$selA = new iSelect($idsa,"analise_db",false,false,0,"",true);
							$selA->where("statusAnaliseDb","=","1");
							$selA->setAnd("tabela","=",$this->table,true);
							if(strlen($tempA)>0){
								$selA->setAnd("tabelaJoin","=",$tempA,true);
							}
							$selA->setAnd("arquivo","=",$arquivo,true);
	
							if($selA->exe()!==false){
								if($selA->getNumRows()==0){
									$insA = new iInsert($idsa,"analise_db");
									$insA->set("dataCriacao",time());
									$insA->set("dataModificacao",time());
									$insA->set("tabela",$this->table);
									$insA->set("tabelaJoin",$tempA);
									$insA->set("arquivo",$arquivo);
									$insA->set("sqlExecutado",$this->sql);
	
									$insA->exe();
								}
							}
						}
					}
				}
			}*/
			#### ANALISE ###
		}

		if($this->execute===true){
			if($this->dataSet->sqlServer===false){
				$this->mysqli = $this->dataSet->connect();
				if($this->mysqli===false){
					return false;
				}else{
					#######
					if(count($this->tableJoinB)==0){
						if($VERSION_PHP=="7.2"){
							@$this->res = $this->mysqli->query($this->sql);
						}else{
							try{
								$this->res = $this->mysqli->query($this->sql);
							}catch(Exception $e){
								$this->res = false;
							}
						}
						if($this->res===false){
							$this->dataSet->setError("(".$this->mysqli->errno.") ".$this->mysqli->error."<br><br>{ ".$this->sql." }");
							return false;
						}else{
							$this->numRows = $this->mysqli->affected_rows;
							return $this->res;
						}
					}else{
						@$this->res = $this->mysqli->query($this->sql);
						if($this->res===false){
							$this->dataSet->setError("(".$this->mysqli->errno.") ".$this->mysqli->error."<br><br>{ ".$this->sql." }");
							return false;
						}else{
							$this->numRows = $this->mysqli->affected_rows;
							if($this->numRows==0){
								return $this->res;
							}else{
								$rowArray = array();
								while($rowTemp = $this->read()){
									foreach($rowTemp as $kU => $vU){
										if(!isset($vU)){
											$rowTemp[$kU] = "";
										}
									}
									$rowArray[] = $rowTemp;
								} 

								/*foreach($rowArray[0] as $kT => $vT){
									if($kT=="idUsuarioDono"){
										echo $kT.": ".$vT."<br>";
										unset($rowArray[0][$kT]);
									}
								}*/

								$testeRes = 0;

								foreach($this->tableJoinB as $kA => $vA){
									//echo "Teste ".count($this->tableJoinB)."<br>";
									$tableTemp = $vA;
									if(strlen($this->tableAsB[$kA])>0){
										$tableTemp = $this->tableAsB[$kA];
									}				
									
									$newDataSet = new iDataBase("iDataSetTemp".$vA.$kA.time());
									$newDataSet->restoreConnection($this->dataSet->getConnection());

									$newDataSet->setDataBase($this->dataBaseJoinB[$kA]);

									$selB = new iSelect($newDataSet,$vA);
									$selB->limit(false);
									if(isset($this->columnJoin[$tableTemp])){
										$columnsTemp = "";
										$gateB = true;
										foreach($this->columnJoin[$tableTemp] as $kB => $vB){
											if(strlen($columnsTemp)>0){
												$columnsTemp .= ",";
											}
											$columnsTemp .= $vB;
											if(isset($this->as[$tableTemp][$kB])){
												if(strlen($this->as[$tableTemp][$kB])>0){
													$columnsTemp .= " AS ".$this->as[$tableTemp][$kB];
												}
											}
											if($vB==$this->whereJoinB[$kA]){
												$gateB = false;
											}
										}

										if($gateB===true){
											if(strlen($columnsTemp)>0){
												$columnsTemp = $this->whereJoinB[$kA]." AS ".$this->whereJoinB[$kA]."Seg,".$columnsTemp;
											}else{
												$columnsTemp = $this->whereJoinB[$kA]." AS ".$this->whereJoinB[$kA]."Seg,*";
											}
										}

										$selB->columns($columnsTemp);
									}

									if(count($rowArray)>0){
										//echo "passei 1<br>";
										$gate = false;
										$listaOr = array();
										foreach($rowArray as $kC => $vC){
											//echo "passei 2: ".$this->valueJoinB[$kA]."<br>";
											if(isset($vC[$this->valueJoinB[$kA]])){
												//echo "passei 3<br>";
												if(!isset($listaOr[$vC[$this->valueJoinB[$kA]]])){
													//echo "passei 4<br>";
													$listaOr[$vC[$this->valueJoinB[$kA]]] = true;
													if(strlen($vC[$this->valueJoinB[$kA]])>0){
														//echo "passei 5<br>";
														$gate = true;
														if(is_numeric($vC[$this->valueJoinB[$kA]])){
															$selB->setOr($this->whereJoinB[$kA],$this->operatorJoinB[$kA],$vC[$this->valueJoinB[$kA]]);
														}else{
															$selB->setOr($this->whereJoinB[$kA],$this->operatorJoinB[$kA],$vC[$this->valueJoinB[$kA]],true);
														}
													}
												}
											}
										}

										if($gate===true){
											if($selB->exe()===false){
												//echo "teste***".$newDataSet->getError(1);
											}else{
												//echo $selB->getSql();
												
												$joinArray = array();
												$joinArrayRowClean = false;
												while($rowB = $selB->read()){
													$rowTempB = $rowB;
													unset($rowTempB[$this->whereJoinB[$kA]."Seg"]);
													$joinArray[$rowB[$this->whereJoinB[$kA]."Seg"]] = $rowTempB;
													if($joinArrayRowClean===false){
														foreach($rowTempB as $kD => $vD){
															$joinArrayRowClean[$kD] = $kD;
														}
													}
												}

												foreach($rowArray as $kC => $vC){
													if(isset($joinArray[$vC[$this->valueJoinB[$kA]]])){
														foreach($joinArray[$vC[$this->valueJoinB[$kA]]] as $kE => $vE){
															$rowArray[$kC][$kE] = $vE;
														}
													}else{
														if($joinArrayRowClean!==false){
															foreach($joinArrayRowClean as $kE => $vE){
																$rowArray[$kC][$kE] = "";
															}
														}
													}
												}

												$this->countFlush = 0;
												$this->rowFlush = $rowArray;
												$this->res = 1;
												$this->numRows = count($rowArray);
												$this->execute = false;

												$testeRes = 1;
											}
										}else{
											$this->countFlush = 0;
											$this->rowFlush = $rowArray;
											$this->res = 1;
											$this->numRows = count($rowArray);
											$this->execute = false;

											$testeRes = 1;
										}
									}
								}

								return $testeRes;
							}
						}
					}
					#######
				}
			}else{
				if($VERSION_PHP=="7.2"){
					$this->res = $this->dataSet->exeQuery($this->sql);
				}else{
					try{
						$this->res = $this->dataSet->exeQuery($this->sql);
					}catch(Exception $e){
						$this->res = false;
					}
				}
				
				if($this->res===false){
					return false;
				}else{
					$this->numRows = sqlsrv_num_rows($this->res);
					return $this->res;
				}
			}
		}else{
			return $this->res;
		}
	}
	
	public function getFieldSize(){
		if($this->row===false){
			$this->row = $this->read();
			$column = $this->row;
		}else{
			$column = $this->row;
		}
		return $this->parseTextBetween("(",")",$column['Type']);
	}
	
	public function getFieldType(){
		if($this->row===false){
			$this->row = $this->read();
			$column = $this->row;
		}else{
			$column = $this->row;
		}
		if($pos = strpos($column['Type'], "(")){
			return substr($column['Type'], 0, $pos);
		}else{
			return $column['Type'];
		}
	}
	
	public function getNumRows(){
		return $this->numRows;
	}
	
	public function getSql($access=false){
		global $REPORTING_ERROR;
		global $page;
		
		if(($REPORTING_ERROR==1 && $page->session->getLoginTipo()==2) || $page->session->getLoginTipo()==2 || ($access===true)){
			return $this->sql;
		}else{
			return null;
		}
	}
	
	public function getTableSetted(){
		return $this->table;
	}
	
	public function join($table,$where,$operator,$value,$type="",$tableAs="",$dataBase=false,$tableValue=false){
		global $_ROUTE;
		global $_SRV;

		if($type==""){
			$type = "LEFT";
		}

		if(!isset($_ROUTE[$table])){
			$dataBase = false;
		}
		 
		$idJoin = count($this->tableJoin);
		$this->tableJoin[$idJoin] = $table;
		$this->whereJoin[$idJoin] = $where;
		$this->operatorJoin[$idJoin] = $operator;
		$this->valueJoin[$idJoin] = $value;
		$this->typeJoin[$idJoin] = $type;
		$this->tableAs[$idJoin] = $tableAs;
		$this->dataBaseJoin[$idJoin] = $dataBase;
		
		if($dataBase!==false){
			if($tableValue===false){
				if(strpos($value,$this->table)!==false){
					$value = str_replace($this->table.".","",$value);
				}
			}else{
				//$value = $tableValue.".".$value;
			}

			if(strlen($this->columnB)>0){
				if(strpos($this->columnB,"@".$value."#")===false){
					$this->column[] = $value;
				}
			}

			$idJoin = count($this->tableJoinB);
			$this->tableJoinB[$idJoin] = $table;
			$this->whereJoinB[$idJoin] = $where;
			$this->operatorJoinB[$idJoin] = $operator;
			$this->valueJoinB[$idJoin] = $value;
			$this->typeJoinB[$idJoin] = $type;
			$this->tableAsB[$idJoin] = $tableAs;
			$this->dataBaseJoinB[$idJoin] = $dataBase;
		}
	}
	
	public function like($column,$value,$type="%X%",$not=false,$table=false){
		/*$value = str_replace("#","%",$value);*/
		$value = str_replace("*","%",$value);
		if($not!==false){
			$not = " NOT";
		}else{
			$not = "";
		}
		if($table===false){
			$table = "";
		}else{
			$table = $table.".";
		}
		if($type=="%X%"){
			$this->like[count($this->like)] = $table.$column.$not." LIKE '%".$value."%'";
		}else if($type=="X%"){
			$this->like[count($this->like)] = $table.$column.$not." LIKE '".$value."%'";
		}else{
			$this->like[count($this->like)] = $table.$column.$not." LIKE '%".$value."'";
		}
	}
	
	public function limit($limit,$offSet=0){
		$this->offSet = $offSet;
		$this->limit = $limit;
	}
	
	public function listColumn(){
		$this->listColumn = true;
	}
	
	public function listDb(){
		$this->listDb = true;
	}
	
	public function listTable(){
		$this->listTable = true;
	}
	
	public function setOr($column,$operator,$value,$withQuotation=false,$table=false){
		$id = count($this->or);
		if($withQuotation===false){
			$this->or[$id] = $column.$operator.$value;
		}else{
			$this->or[$id] = $column.$operator."'".$value."'";
		}
		$this->orTable[$id] = $table;
	}
	
	public function order($order,$type="ASC",$table=false){
		$this->order = explode(",",$order);
		$this->orderType = explode(",",$type);
		if($table===false && $table!="" && $this->table){
			$this->orderTable = explode(",",$this->table);
		}else if($table!=""){
			$this->orderTable = explode(",",$table);
		}else{
			$this->orderTable = "";
		}
	}
	
	public function rand(){
		$this->rand = true;
	}
	
	public function read(){
		global $GET_SELECT_TIME;
		global $VERSION_PHP;

		if($this->execute===true){
			if($this->dataSet->sqlServer===false){
				if($this->res!==false){
					$row = $this->res->fetch_assoc();

					if($this->timeFlush>0){
						if($row){
							$this->rowFlush[$this->countFlush] = $row;
							$this->countFlush++;
						}else{
							if($this->insertFlush===true){
								global $idsa;

								$ins = new iInsert($idsa,"sistema_flush");
								$ins->set("dataCriacao",time());
								$ins->set("dataModificacao",time());
								$ins->set("hashSql",$this->hashSqlFlush);
								$ins->set("result",json_encode($this->rowFlush));
								$ins->set("res",true);
								$ins->set("numRows",$this->numRows);
								$ins->exe();
							}else if($this->updateFlush===true){
								global $idsa;

								$upd = new iUpdate($idsa,"sistema_flush");
								$upd->where("hashSql","=",$this->hashSqlFlush,true);
								$upd->set("dataModificacao",time());
								$upd->set("result",json_encode($this->rowFlush));
								$upd->set("res",true);
								$upd->set("numRows",$this->numRows);
								$upd->exe();
							}
						}
					}

					if($GET_SELECT_TIME===true){
						if(!$row){
							$this->timeEnd = microtime_float();
							$this->e($this->table." ".$this->nameSelect.": ".($this->timeEnd - $this->timeStart)."<br>");
						}
					}

					return $row;
				}else{
					return false;
				}
			}else{
				if($this->res!==false){
					if($VERSION_PHP=="7.2"){
						$row = @sqlsrv_fetch_array($this->res, SQLSRV_FETCH_ASSOC);
					}else{
						try{
							$row = sqlsrv_fetch_array($this->res, SQLSRV_FETCH_ASSOC);
						}catch(Exception $e){
							$row = false;
						}
					}
					if($row===false){
						$errors = sqlsrv_errors();
						foreach ($errors as $error){
							$this->dataSet->setError("(".$error['code'].") ".$error['message']);
						}
						return false;
					}else{
						if($this->timeFlush>0){
							if($row){
								$this->rowFlush[$this->countFlush] = $row;
								$this->countFlush++;
							}else{
								if($this->insertFlush===true){
									global $idsa;
	
									$ins = new iInsert($idsa,"sistema_flush");
									$ins->set("dataCriacao",time());
									$ins->set("dataModificacao",time());
									$ins->set("hashSql",$this->hashSqlFlush);
									$ins->set("result",json_encode($this->rowFlush));
									$ins->set("res",true);
									$ins->set("numRows",$this->numRows);
									$ins->exe();
								}else if($this->updateFlush===true){
									global $idsa;
	
									$upd = new iUpdate($idsa,"sistema_flush");
									$upd->where("hashSql","=",$this->hashSqlFlush,true);
									$upd->set("dataModificacao",time());
									$upd->set("result",json_encode($this->rowFlush));
									$upd->set("res",true);
									$upd->set("numRows",$this->numRows);
									$upd->exe();
								}
							}
						}
						if($GET_SELECT_TIME===true){
							if(!$row){
								$this->timeEnd = microtime_float();
								$this->e($this->table." ".$this->nameSelect.": ".($this->timeEnd - $this->timeStart)."<br>");
							}
						}

						return $row;
					}
				}else{
					return false;
				}
			}
		}else{
			if(isset($this->rowFlush[$this->countFlush])){
				$row = $this->rowFlush[$this->countFlush];
				$this->countFlush++;

				if($GET_SELECT_TIME===true){
					if(!$row){
						$this->timeEnd = microtime_float();
						$this->e($this->table." ".$this->nameSelect." (F - ".$this->hashSqlFlush."): ".($this->timeEnd - $this->timeStart)."<br>");
					}
				}

				return $row;
			}else{
				if($GET_SELECT_TIME===true){
					$this->timeEnd = microtime_float();
					$this->e($this->table." ".$this->nameSelect." (F - ".$this->hashSqlFlush."): ".($this->timeEnd - $this->timeStart)."<br>");
				}

				return false;
			}
		}
	}
	
	public function where($column,$operator,$value,$withQuotation=false,$binary=false,$table=false){
		$this->where = $column;
		$this->operator = $operator;
		$this->value = $value;
		$this->withQuotation = $withQuotation;
		$this->binary = $binary;
		$this->whereTable = $table;
	}
	
}
