<?php
	setcookie("admin","",time()-3600);
	header("Location: home.php");
?>