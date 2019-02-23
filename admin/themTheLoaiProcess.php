<?php
	session_start();
	if(isset($_POST["txtTenTheLoai"]) && $_SESSION["phanQuyen"]!=0)
	{
		$tenTheLoai=$_POST["txtTenTheLoai"];
		$anh=$_POST["txtAnh"];
		include("../Connectdb/open.php");
		$result=mysqli_query($con,"insert into tbltheloai(tenTheLoai,anhTheLoai) values ('$tenTheLoai','$anh')");
		include("../Connectdb/close.php");
		header("Location:quanLy.php?dstl");
	}
	else
	{
		header("Location:quanLy.php?dstl");
	}
?>