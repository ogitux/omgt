<?php
/**
 * Functions
 */


/**
 * get_section()
 * Get the section and the action for the web
 * 
 * @param $section Site section
 * @param $action Action from section
 * @return void
 */
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
/**
 * printr()
 * Print preformated text and allow to exit the code
 * 
 * @param $text Not Formated Text
 * @param $exit If exit is true then the function exit
 * @return void
 */
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
