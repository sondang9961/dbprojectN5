<?php
	session_start();
	if(isset($_GET["txtTenTheLoaiCon"])&&isset($_GET["ddlTheLoai"]) && $_SESSION["phanQuyen"]!=0)
	{
		$tenTheLoaiCon=$_GET["txtTenTheLoaiCon"];
		$maTheLoai=$_GET["ddlTheLoai"];
		include("../Connectdb/open.php");
		$result=mysqli_query($con,"insert into tbltheloaicon(tenTheLoaiCon,maTheLoai) values ('$tenTheLoaiCon',$maTheLoai)");
		include("../Connectdb/close.php");
		header("Location:quanLy.php?dstl");
	}
	else
	{
		header("Location:quanLy.php?dstl");
	}
?>