<?php
	if(isset($_POST["txtuser"])&&isset($_POST["txtpass"])&&isset($_POST["txtemail"])&&isset($_POST["txtten"]))
	{
		$user=$_POST["txtuser"];
		$pass=$_POST["txtpass"];
		$email=$_POST["txtemail"];
		$ten=$_POST["txtten"];
		include("../Connectdb/open.php");
		$result=mysqli_query($con,"select * from tbluser where username='$user'");
		$kttk=mysqli_num_rows($result);
		if($kttk==0)
		{
			mysqli_query($con,"insert into tblUser(username,pass,email,tenUser,gioiTinh) values('$user','$pass','$email','$ten',0)");
			header("Location:../giaoDien/index.php?dn=2");
		}
		else 
		{
			header("Location:../giaoDien/index.php?dk&err");
		}
		include("../Connectdb/close.php");
	}
	else
	{
		header("Location:../giaoDien/index.php");
	}
?>