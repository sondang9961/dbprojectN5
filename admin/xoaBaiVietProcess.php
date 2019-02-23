<?php
	if(isset($_GET["id"]) && $_SESSION["phanQuyen"]==0)
	{
		$maBaiViet=$_GET["id"];
		include("../Connectdb/open.php");
		mysqli_query($con,"delete from tblbaivietduocluu where maBaiViet=$maBaiViet");
		mysqli_query($con,"delete from tblcomment where maBaiViet=$maBaiViet");
		mysqli_query($con,"delete from tblbaiviet where maBaiViet=$maBaiViet");
		include("../Connectdb/close.php");
		$urladmin=$_SESSION["urladmin"];
		header("Location:quanLy.php?dsbv$urladmin");
	}
	else
	{
		header("Location:quanLy.php?dsbv");
	}
?>