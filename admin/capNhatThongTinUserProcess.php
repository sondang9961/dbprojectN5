<?php
	session_start();
	if(isset($_POST["txtemail"]) && isset($_POST["txtten"]) && isset($_POST["txtngaySinh"]) && isset($_POST["rdbGt"]) && isset($_POST["txtsdt"]) && isset($_POST["txtdiachi"]) && isset($_POST["txtquyen"]) && isset($_POST["TinhTrang"]) && $_SESSION["phanQuyen"]!=0)
	{
		include ("../Connectdb/open.php");
		$maUser=$_POST["txtmauser"];
		$email=$_POST["txtemail"];
		$ten=$_POST["txtten"];
		$gioiTinh=$_POST["rdbGt"];
		$ngaySinh=$_POST["txtngaySinh"];
		$sdt=$_POST["txtsdt"];
		$diaChi=$_POST["txtdiachi"];
		$quyen=$_POST["txtquyen"];
		$tinhTrangUser=$_POST["TinhTrang"];
		if($ngaySinh != 0)
		{
			mysqli_query($con,"update tbluser set ngaySinh='$ngaySinh' where maUser=$maUser");
		}
		else
		{
			mysqli_query($con,"update tbluser set ngaySinh=null where maUser=$maUser");
		}
		mysqli_query($con,"update tbluser set email='$email', tenUser='$ten', gioiTinh=$gioiTinh, sdt='$sdt', diaChi='$diaChi', maQuyen=$quyen, tinhTrangUser=$tinhTrangUser where maUser=$maUser");;
		include ("../Connectdb/close.php");
		$urladmin=$_SESSION["urladmin"];
		header("Location:quanLy.php?dsuser$urladmin");
	}
	else if (isset($_POST["TinhTrang"]) && isset($_POST["txtmauser"]))
	{
		include ("../Connectdb/open.php");
		$maUser=$_POST["txtmauser"];
		$tinhTrangUser=$_POST["TinhTrang"];	
		mysqli_query($con,"update tbluser set tinhTrangUser=$tinhTrangUser where maUser=$maUser");
		include ("../Connectdb/close.php");
		$urladmin=$_SESSION["urladmin"];
		header("Location:quanLy.php?dsuser$urladmin");
	}
	else	
		header ("Location:quanLy.php?dsuser.php");
?>