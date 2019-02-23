<?php
	session_start();
	if(isset($_GET["txtMaTheLoaiCon"])&&isset($_GET["txtTenTheLoaiCon"])&&isset($_GET["ddlMaTheLoai"]) && $_SESSION["phanQuyen"]!=0)
	{
		$maTheLoaiCon=$_GET["txtMaTheLoaiCon"];
		$tenTheLoaiCon=$_GET["txtTenTheLoaiCon"];
		$maTheLoai=$_GET["ddlMaTheLoai"];
		include("../Connectdb/open.php");
		$result=mysqli_query($con,"update tbltheloaicon set tenTheLoaiCon='$tenTheLoaiCon', maTheLoai=$maTheLoai where maTheLoaiCon=$maTheLoaiCon");
		echo("update tbltheloaiCon set tenTheLoaiCon='$tenTheLoaiCon' and maTheLoai=$maTheLoai where maTheLoaiCon=$maTheLoaiCon");
		include("../Connectdb/close.php");
		header("Location:quanLy.php?dstl");
	}
	else
	{
		header("Location:quanLy.php?dstl");
	}
?>