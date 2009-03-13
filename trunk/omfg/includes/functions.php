<?php
function get_section($section, $action)
{
	global $MyPes;
	if ($section)
	{
		$include_file = MOD_DIR . "/$section/index.php";
		if (file_exists($include_file))
		{
			include(MOD_DIR . "/$section/index.php");
		}
		else 
		{
			include(TPL_DIR . "/404.html");
		}
	}
	else
	{
		include(DEFAULT_PAGE);
	}
}

function printr($text, $exit=NULL)
{
	echo "<pre>";
	print_r($text);
	echo "</pre>";
	if ($exit) 
	{
		exit;
	}
}
?>
