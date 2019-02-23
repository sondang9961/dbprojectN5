<?php
	if(isset($_GET["pcat"]) && $_SESSION["phanQuyen"]==0)
	{
		$maTheLoai=$_GET["pcat"];
		include("../Connectdb/open.php");
		mysqli_query($con,"delete from tbltheloaicon where maTheLoai=$maTheLoai");
		mysqli_query($con,"delete from tbltheloai where maTheLoai=$maTheLoai");
		include("../Connectdb/close.php");
		header("Location:quanLy.php?dstl");
	}
	else
	{
		header("Location:quanLy.php?dstl");
	}
?>