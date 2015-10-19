<?php
include_once 'base.php';

Class BaseDemo
{
	public static function get()
	{
		$base = new base(Config::$driver);
	  	$base->setup(Config::$host, Config::$user, Config::$pass, Config::$base);
	  	$base->record_style('fields');
	  	$base->debug_on(Config::$debug);
	  	return $base;
	}
} 

?>
