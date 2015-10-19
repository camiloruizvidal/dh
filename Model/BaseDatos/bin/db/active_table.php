<?php
 
include_once Config::$home_lib.'adodb5'.Config::$ds.'adodb-active-record.inc.php'; 
 
ADOdb_Active_Record::SetDatabaseAdapter(App::$base->getADOdb());
 
class atable extends ADODB_Active_Record 
{
 	function Save()
 	{
 		// Agregar el generador a la llave primaria en insercion
 		// el generador debe llamarse GEN_(Campo PK) 		
 		if(App::$base -> driver == 'firebird')
		{	
 			$ids = $this -> DB() -> MetaPrimaryKeys($this -> _table);  // PK
 			$id = (count($ids) > 0)?$ids[0]:'';
 		
 			if ((!$this -> _saved) && ($id != ''))
 		 	{ $id = strtolower($id);
 		   		$gen = 'GEN_'.strtoupper($id); 		   
 		   		$this -> $id = $this -> DB() -> GenID($gen);
 		 	}
		}
		  
		if((App::$base -> driver == 'postgres') || (App::$base -> driver == 'postgres8'))
		{
 			$ids = $this -> DB() -> MetaPrimaryKeys($this -> _table);  // PK
 			$id = (count($ids) > 0)?$ids[0]:'';
 		
 			if((!$this->_saved) && ($id != ''))
 		 	{ $gen =  $this -> _table.'_'.$id.'_seq';   //formato: tbl_nombretabla_id_campoid_seq
		      $gen = strtolower($gen);		   
 		   	  $this -> $id = $this -> DB() -> GenID($gen);
 		 	}
		}  
 		parent::Save();
 		return $this;
 	}
 	
	public static function Make($name) 
	{
	    return new atable($name);
	}  	
}
 
 
 
?>
