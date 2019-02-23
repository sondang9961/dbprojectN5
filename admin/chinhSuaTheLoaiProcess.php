<?php
	if(isset($_POST["pcat"]) && isset($_POST["txtTenTheLoai"]) || isset($_POST["txtAnh"]))
	{
		$maTheLoai=$_POST["pcat"];
		$tenTheLoai=$_POST["txtTenTheLoai"];
		$anh=$_POST["txtAnh"];
		include("../Connectdb/open.php");
		$sql="update tbltheloai set tenTheLoai='$tenTheLoai', anhTheLoai='$anh' where maTheLoai=$maTheLoai";
		mysqli_query($con,$sql);
		include("../Connectdb/close.php");
		header("Location:quanLy.php?dstl");
	}
	else
	{
		header("Location:quanLy.php?dstl");
	}
?>