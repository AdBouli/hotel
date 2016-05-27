<?php 

function prvar($var)
{
	echo '**<pre>';
	print_r($var);
	echo '</pre>**';
}

function prvard($var)
{
	echo '**<pre>';
	var_dump($var);
	echo '</pre>**';
}

?>