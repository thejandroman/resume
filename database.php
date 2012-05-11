<?php

	function run_sql($sql_string)
	{
		mysql_connect("localhost", "root", "root");
		mysql_select_db("resamaze");
		$result = mysql_query($sql_string);
		return $result;
	}
	function select_templates()
	{
		return run_sql("select * from templates");
	}
?>