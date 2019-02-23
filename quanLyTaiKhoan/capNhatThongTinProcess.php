<?php
	session_start();
	$maUser=$_SESSION["idUser"];
	$tenUser=$_SESSION["username"];
	include ("../Connectdb/open.php");
		$email=$_POST["txtemail"];
		$ten=$_POST["txtten"];
		$gioiTinh=$_POST["rdbGt"];
		$ngaySinh=$_POST["txtngaySinh"];
		$sdt=$_POST["txtsdt"];
		$diaChi=$_POST["txtdiachi"];
		if($ngaySinh != 0)
		{
			mysqli_query($con,"update tbluser set ngaySinh='$ngaySinh' where maUser=$maUser");
		}
		else
		{
			mysqli_query($con,"update tbluser set ngaySinh=null where maUser=$maUser");
		}
		mysqli_query($con,"update tbluser set email='$email', tenUser='$ten', gioiTinh=$gioiTinh, sdt='$sdt', diaChi='$diaChi' where maUser=$maUser");
		include ("../Connectdb/close.php");
		header("location:../giaoDien/?ttcn=$tenUser");
?>