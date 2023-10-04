<?php 

if(extension_loaded('gd') && function_exists('gd_info')){
	echo "gd Instaled";
}else{
	echo "gd not Instaled";
}

 ?>