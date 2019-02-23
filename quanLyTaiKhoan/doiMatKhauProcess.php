<?php
	session_start();
	$maUser=$_SESSION["idUser"];
	$pass=$_POST["txtpass"];
	include ("../Connectdb/open.php");
	$result=mysqli_query($con,"select pass from tbluser where maUser=$maUser and pass='$pass'");
	$ktPass=mysqli_num_rows($result);
	if($ktPass==1)
	{
		$newPass=$_POST["txtNewPass"];
		mysqli_query($con,"UPDATE tbluser set pass='$newPass' WHERE maUser=$maUser");
		header ("location:../giaoDien/index.php?ttcn=1");
	}
	else
	{
		header ("location:../giaoDien/index.php?dmk=1");
	}
	include ("../Connectdb/close.php");
?>