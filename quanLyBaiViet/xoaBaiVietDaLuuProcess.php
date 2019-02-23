<?php
	if(isset($_GET["idBvl"]))
	{
		$maBaiVietDuocLuu=$_GET["idBvl"];
		include ("../Connectdb/open.php");
		$result=mysqli_query($con,"select * from tblbaivietduocluu where maBaiVietDuocLuu=$maBaiVietDuocLuu");
		$bv=mysqli_fetch_array($result);
		$maBaiViet=$bv["maBaiViet"];
		mysqli_query($con,"delete from tblbaivietduocluu where maBaiVietDuocLuu=$maBaiVietDuocLuu");
		$result=mysqli_query($con,"select * from tblbaiviet where maBaiViet=$maBaiViet");
		$bv=mysqli_fetch_array($result);
		$luotLuu=$bv["luotLuu"]-1;
		echo($luotLuu);
		mysqli_query($con,"update tblbaiviet set luotLuu=$luotLuu where maBaiViet=$maBaiViet");
		include ("../Connectdb/close.php");
		if(isset($_GET["id"]))
		{
			$id=$_GET["id"];
			header ("location:../giaoDien/?id=$id&success=0#boLuu");
		}
		else header ("location:../giaoDien/?bvl=$maBaiVietDuocLuu#boLuu");
	}
?>