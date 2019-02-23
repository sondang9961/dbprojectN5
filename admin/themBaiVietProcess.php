<?php
	session_start();
	if(isset($_SESSION["idUser"])&&isset($_POST["txtTenBaiViet"])&&isset($_POST["ddlTheLoaiCon"])&&isset($_POST["txtMoTa"])&&isset($_POST["txtNoiDung"]) && $_SESSION["phanQuyen"]!=0)
	{
		$maUser=$_SESSION["idUser"];
		$tenBaiViet=$_POST["txtTenBaiViet"];
		$anh=$_POST["txtAnh"];
		$maTheLoaiCon=$_POST["ddlTheLoaiCon"];
		$moTa=$_POST["txtMoTa"];
		$noiDung=$_POST["txtNoiDung"];
		$noiDung=base64_encode($noiDung);
		include("../Connectdb/open.php");
		$result=mysqli_query($con,"insert into tblbaiviet(maUser,tenBaiViet,anh,maTheLoaiCon,moTa,noiDung) values ($maUser,'$tenBaiViet','$anh',$maTheLoaiCon,'$moTa','$noiDung')");
		include("../Connectdb/close.php");
		header("Location:quanLy.php?dsbv");
	}
	else
	{
		header("Location:quanLy.php?tbv");
	}
?>