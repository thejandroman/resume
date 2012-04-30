<?php

function connect(){
try {
    return new PDO("mysql:dbname=resamaze;host=localhost", "root", "root" );
	
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
	}
	function run_sql($sql_string)
	{
		$db = connect();
		return $db->query($sql_string);
	}
	function select_templates()
	{
		return query("select * from templates");
	}
?>