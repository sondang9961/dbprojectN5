<?php
	session_start();
	if(isset($_SESSION["idUser"])&&isset($_POST["txtmaBaiViet"])&&isset($_POST["txtTenBaiViet"])&&isset($_POST["ddlTheLoaiCon"])&&isset($_POST["txtMoTa"])&&isset($_POST["txtNoiDung"]) && isset($_POST["rdbTinhTrang"]) && $_SESSION["phanQuyen"]!=0)
	{
		$maBaiViet=$_POST["txtmaBaiViet"];
		$anh=$_POST["txtAnh"];
		$tenBaiViet=$_POST["txtTenBaiViet"]; 
		$tenBaiViet=str_replace("'","''",$tenBaiViet);
		$tenBaiViet=str_replace('"','&quot;',$tenBaiViet);
		$maTheLoaiCon=$_POST["ddlTheLoaiCon"];
		$moTa=$_POST["txtMoTa"];
		$moTa=str_replace("'","''",$moTa);
		$moTa=str_replace('"','&quot;',$moTa);
		$noiDung=$_POST["txtNoiDung"];
		$noiDung=base64_encode($noiDung);//Mã hóa và sang trang bài viết chi tiết sẽ giải mã
		$tinhTrang=$_POST["rdbTinhTrang"];
		include("../Connectdb/open.php");
		if (mysqli_query($con,"update tblbaiviet set tenBaiViet='$tenBaiViet', anh='$anh', maTheLoaiCon=$maTheLoaiCon, moTa='$moTa', noiDung='$noiDung', tinhTrangBv=$tinhTrang where maBaiViet=$maBaiViet"))
		echo "ok";
		include("../Connectdb/close.php");
		$urladmin=$_SESSION["urladmin"];
		header("Location:quanLy.php?dsbv$urladmin#$maBaiViet");
	}
	else if (isset($_POST["rdbTinhTrang"])&&isset($_POST["txtmaBaiViet"]))
	{
		$maBaiViet=$_POST["txtmaBaiViet"];
		$tinhTrang=$_POST["rdbTinhTrang"];
		include("../Connectdb/open.php");
		mysqli_query($con,"update tblbaiviet set tinhTrangBv=$tinhTrang where maBaiViet=$maBaiViet");
		include("../Connectdb/close.php");
		$urladmin=$_SESSION["urladmin"];
		header("Location:quanLy.php?dsbv$urladmin#$maBaiViet");	
	}
	else
	{
		header("Location:chinhSuaBaiViet.php");
	}
?>