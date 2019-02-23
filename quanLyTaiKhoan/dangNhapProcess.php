<?php
	if(isset($_POST["txtuser"])&&isset($_POST["txtpass"]))
	{
		$user=$_POST["txtuser"];
		$pass=$_POST["txtpass"];
		include("../Connectdb/open.php");
		//Kiem tra xem username va pass co ton tai khong
		$result=mysqli_query($con,"select * from tblUser where username='$user' and pass='$pass'");
		$us=mysqli_fetch_array($result);
		$kttk=mysqli_num_rows($result);
		include("../Connectdb/close.php");
		if($kttk==0)
		{
			//Neu chua dang nhap (chua ton tai username va pass ) thi quay lai trang dang nhap
			header("Location:../giaoDien/index.php?dn&err=1");
		
		}
		else if ($us["tinhTrangUser"]==0)
		{
			header("Location:../giaoDien/index.php?dn&err=2");			
		}
		else if ($us["tinhTrangUser"]==1)
		{
			//Neu dang nhap roi thi chuyen den trang chu
			session_start();
			$_SESSION["username"]=$user;
			$_SESSION["idUser"]=$us["maUser"];
			$_SESSION["tenUser"]=$us["tenUser"];
			$_SESSION["phanQuyen"]=$us["maQuyen"];
			$url=$_SESSION["url"];
			if($_SESSION["phanQuyen"]>0)
			{
				header("Location:../admin/quanLy.php?dsbv");	
			}
			else
			header("Location:../giaoDien/index.php$url");
		}
	}
	else if(!isset($_POST["txtuser"])||!isset($_POST["txtpass"]))
	{
		header("Location:../giaoDien/index.php?");
	}
?>