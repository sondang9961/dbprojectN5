<?php
	if(isset($_GET["cat"]) && $_SESSION["phanQuyen"]==0)
	{
		$maTheLoaiCon=$_GET["cat"];
		include("../Connectdb/open.php");
		mysqli_query($con,"delete from tbltheloaicon where maTheLoaiCon=$maTheLoaiCon");
		include("../Connectdb/close.php");
		header("Location:quanLy.php?dstl");
	}
	else
	{
		header("Location:quanLy.php?dstl");
	}
?>