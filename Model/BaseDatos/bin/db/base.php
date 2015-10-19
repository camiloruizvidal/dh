<?php
 /***********************************************************
 * Clase generica para acceso a datos usando ADODB
 *
 * @author     Jimmy Andr�s campo Bravo  <info@oderlogica.com>
 * @copyright  1996-2014 Oderlogica - Todos los derechos reservados - www.oderlogica.com
 * @license    Este c�digo y sus derivados son propiedad de Oderlogica
 * @version    1.2
 ************************************************************/

include_once Config::$home_lib.'adodb5'.Config::$ds.'adodb.inc.php'; 
include_once Config::$home_lib.'adodb5'.Config::$ds.'adodb-exceptions.inc.php'; 

 class base 
 {
 		private $server; 
		private $user;         
		private $password;					
		private $database;
		private $sql_instruction;
		protected $adodb;
		public $rs;
		public $driver;
		
		function __construct($driver='postgres8')
		{
		   $this->adodb = ADONewConnection($driver);
		   $this->driver = $driver; 
		}
		
		public function getADOdb()
		{
		 return $this->adodb;
		}
		
		function debug_on($value)
		{
		 $this->adodb->debug = $value;
		}
		
 		function setup($server, $user, $pass, $db)
		{
		    $this->adodb->connect($server, $user, $pass, $db);
                    $this->adodb->EXECUTE("set names 'utf8'"); 
		  
		} 
		function dosql_raw($sql_instruction)
		{		
		   $this->rs = $this->adodb->Execute($sql_instruction);
		   return($this->rs);		
		}
		
		function dosql($sql_instruction, $params)   //previene sql injection
		{		
		   $this->rs = $this->adodb->Execute($sql_instruction, $params);
		   return($this->rs);		
		}
                public function Records($sql_instruction, $params)
                {
                    $Res=$this->dosql($sql_instruction, $params);
                    $Datos=array();
                    while(!$Res->EOF)
                    {
                        $Datos[]=$Res->fields;
                        @$Res->MoveNext();
                    }
                    return $Datos;
                }
                public function Record($sql_instruction, $params)
                {
                    $Res=$this->dosql($sql_instruction, $params);
                    $Datos=array();
                    if(!$Res->EOF)
                    {
                        $Datos=$Res->fields;
                    }
                    return $Datos;
                }
                private function DataTable($Array)
                {
                    $Datos=NULL;
                    foreach($Array as $key =>$Temp)
                    {
                        $Datos[]=$Temp;
                        $Datos["$key"]=$Temp;
                    }
                    return $Datos;
                }
		function TablaDatos($sql_instruction, $params=  array())   //previene sql injection
		{		
                    $this->rs = $this->adodb->Execute($sql_instruction, $params);
                    $Res=NULL;
                    while (@!$this->rs->EOF) 
                    {
                        $Res[] = @$this->DataTable($this->rs->fields);
                        @$this->rs->MoveNext();
                    }
                    return $Res;
                }
		
                
		function get_data($sql, $field='')
		{		 
	     $rs = $this->dosql($sql);
	     // print_r($rs);
	     if ($field == '')
	       { 
		    reset($rs->fields);
		    $res = current($rs->fields);
		   }
     	 else
	      $res = $rs->fields[$field];
	     // die("res - $res");		 
	     return($res); 
		}
		
		function Insert($table, $record, $where=false)
		{
		 $this->adodb->AutoExecute($table, $record, 'INSERT', $where);
		}

		function Update($table, $record, $where=false)
		{
		 $this->adodb->AutoExecute($table, $record,'UPDATE', $where);
		}	
		
		function InsUpd($table, $record, $key, $autoquote=false)
		{
		  $this->adodb->Replace($table, $record, $key, $autoquote);
		}
		
		function ErrorNo()
		{
		 return($this->adodb->ErrorNo());
		}
		
		function ErrorMsg()
		{
		 return($this->adodb->ErrorMsg());
		}
		
		function record_style($style)
		{if ($style=='fields') $this->adodb->SetFetchMode(ADODB_FETCH_ASSOC);
		 if ($style=='numbers') $this->adodb->SetFetchMode(ADODB_FETCH_NUM);
		 if ($style=='both') $this->adodb->SetFetchMode(ADODB_FETCH_BOTH);
	     if ($style=='default') $this->adodb->SetFetchMode(ADODB_FETCH_DEFAULT);
		}
}
?>
