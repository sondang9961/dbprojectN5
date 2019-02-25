<?php
	if(isset($_GET["maComment"])) 
	{
		include("../Connectdb/open.php");
		$maComment=$_GET["maComment"];
		mysqli_query($con,"DELETE FROM `tblcomment` WHERE maComment=$maComment");
		include("../Connectdb/close.php");
		header("location:../giaoDien/index.php?hdbl");
	}
	else
		header("location:../giaoDien/index.php?hdbl");
?>