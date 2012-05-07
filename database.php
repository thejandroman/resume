<?php

	function run_sql($sql_string)
	{
		mysql_connect("localhost", "root", "root");
		$result = mysql_query($sql_string);
		//mysql_close();
		return $result;
	}
	function select_templates()
	{
		return run_sql("select * from resamaze.templates");
	}
?>