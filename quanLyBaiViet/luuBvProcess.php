<?php
	session_start();
	if(isset($_GET["id"]))
	{
		$maBaiViet=$_GET["id"];
		$maUser=$_SESSION["idUser"];
		include ("../Connectdb/open.php");
		mysqli_query($con,"insert into tblbaivietduocluu (maBaiViet,maUser) values ($maBaiViet,$maUser)");
		$result=mysqli_query($con,"select * from tblbaiviet where maBaiViet=$maBaiViet");
		$bv=mysqli_fetch_array($result);
		$luotLuu=$bv["luotLuu"]+1;
		mysqli_query($con,"update tblbaiviet set luotLuu=$luotLuu where maBaiViet=$maBaiViet");
		include ("../Connectdb/close.php");
		header("location:../giaoDien/?id=$maBaiViet#luu");
	}
?>