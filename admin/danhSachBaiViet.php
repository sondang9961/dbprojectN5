<?php 
	$maUser=$_SESSION["idUser"];
	if($_SESSION["phanQuyen"]==0)
	header ("location:../giaoDien/index.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Trang quản trị</title>
<link rel="shortcut icon" href="/dbprojectN5/Images/favicon.JPG"  />
</head>

<body>
<center>
	<h1>Danh Sách Bài Viết</h1>

	<form>
	<b>Lọc: </b>
		<input type="hidden" name="dsbv">
		<input type="search" value="<?php if(isset($_GET["sTen"])) echo $_GET["sTen"]; ?>" name="sTen" placeholder="Theo tên bài viết..." size="30" />
		<input type="search" value="<?php if(isset($_GET["sMoTa"])) echo $_GET["sMoTa"]; ?>" name="sMoTa" placeholder="Theo mô tả..." />
		<?php if ($_SESSION["phanQuyen"]>1) { ?>
		<input type="search" value="<?php if(isset($_GET["sUser"])) echo $_GET["sUser"]; ?>" name="sUser" placeholder="Theo người viết bài..." />
		<?php }?>
		<input type="date" value="<?php if(isset($_GET["sNgayDangBai"])) echo $_GET["sNgayDangBai"]; ?>" name="sNgayDangBai"/>
		<select name="ddlPcat" class="required-entry" id="category" onchange="javascript: dynamicdropdown(this.options[this.selectedIndex].value);" onload="javascript: dynamicdropdown(this.options[this.selectedIndex].value);">
			<?php if(isset($_GET["ddlPcat"])) $pcat = $_GET["ddlPcat"]; else $pcat = -1; ?>
			<option value="-1">-Thể loại-</option>
	<?php
			include ("../Connectdb/open.php");
			$resultTl=mysqli_query($con,"select * from tbltheloai");
			while($tl=mysqli_fetch_array($resultTl))
			{
	?>
				<option value="<?php echo($tl["maTheLoai"]); ?>" <?php if($pcat == $tl["maTheLoai"]) { ?> selected="selected" <?php } ?>><?php echo($tl["tenTheLoai"]); ?></option>
	<?php		
			}
			include ("../Connectdb/close.php");
	?>
		</select>
		<input type="hidden" id="pcat" value="<?php echo($pcat); ?>">
		<script type="text/javascript" language="JavaScript">
			document.write('<select name="ddlCat" id="subcategory"><option value="-1">-Thể loại con-</option></select>');
		</script>
		<select name="ddlTT">
			<?php if(isset($_GET["ddlTT"])) $tt = $_GET["ddlTT"]; else $tt = -1; ?>
			<option value="-1">Tình trạng</option>
			<option value="0" <?php if($tt == 0) { ?> selected="selected" <?php } ?>>Chưa duyệt</option>
			<option value="1" <?php if($tt == 1) { ?> selected="selected" <?php } ?>>Đã duyệt</option>
			
		</select>
		<input type="submit" value="Tìm Kiếm">
		<button type="button" onclick="location.href='?dsbv'">Hiện tất cả</button>
	 </form> <br>	
	<?php
		include("../Connectdb/open.php");
		$maUser=$_SESSION["idUser"];
		if($_SESSION["phanQuyen"]==1)
		{
			$sqlTongBv="select count(*) as tongBv from (select maTheLoai, maTheLoaiCon, tenTheLoai,tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, b.maUser, ngayDangBai, tinhTrangBv, tenUser from tbluser inner join (select a.maTheLoai, a.maTheLoaiCon, tenTheLoai,tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maUser, ngayDangBai, tinhTrangBv from tbltheloai inner join (select tblTheLoaiCon.maTheLoaiCon, tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maTheLoai, maUser, ngayDangBai, tinhTrangBv from tblBaiViet inner join tblTheLoaiCon on tblBaiViet.maTheLoaiCon = tblTheLoaiCon.maTheLoaiCon)a on tblTheLoai.maTheLoai = a.maTheLoai)b on tbluser.maUser = b.maUser)c where maUser=$maUser";
			$sql="select * from tbluser inner join (select a.maTheLoai, maTheLoaiCon, tenTheLoai,tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maUser, ngayDangBai, tinhTrangBv from tbltheloai inner join (select maTheLoai, tblBaiViet.maTheloaiCon, tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maUser, ngayDangBai, tinhTrangBv from tblBaiViet inner join tblTheLoaiCon on tblBaiViet.maTheLoaiCon = tblTheLoaiCon.maTheLoaiCon)a on tblTheLoai.maTheLoai = a.maTheLoai)b on tbluser.maUser = b.maUser where tbluser.maUser=$maUser";
		}
		else
		{
			$sqlTongBv="select count(*) as tongBv from (select maTheLoai, maTheLoaiCon, tenTheLoai,tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, b.maUser, ngayDangBai, tinhTrangBv, tenUser from tbluser inner join (select a.maTheLoai, a.maTheLoaiCon, tenTheLoai,tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maUser, ngayDangBai, tinhTrangBv from tbltheloai inner join (select tblTheLoaiCon.maTheLoaiCon, tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maTheLoai, maUser, ngayDangBai, tinhTrangBv from tblBaiViet inner join tblTheLoaiCon on tblBaiViet.maTheLoaiCon = tblTheLoaiCon.maTheLoaiCon)a on tblTheLoai.maTheLoai = a.maTheLoai)b on tbluser.maUser = b.maUser)c where 1=1";
			$sql="select * from tbluser inner join (select a.maTheLoai, maTheLoaiCon, tenTheLoai,tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maUser, ngayDangBai, tinhTrangBv from tbltheloai inner join (select maTheLoai, tblBaiViet.maTheloaiCon, tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maUser, ngayDangBai, tinhTrangBv from tblBaiViet inner join tblTheLoaiCon on tblBaiViet.maTheLoaiCon = tblTheLoaiCon.maTheLoaiCon)a on tblTheLoai.maTheLoai = a.maTheLoai)b on tbluser.maUser = b.maUser where 1=1";	
		}
		if(isset($_GET["sTen"]) && !empty($_GET["sTen"]))
		{
			$sTen=$_GET["sTen"];
			$sTen = str_replace('"','&quot;',$sTen);
			$sTen = str_replace("'","''",$sTen);
			$sql .=" And tenBaiViet like '%$sTen%' ";
			$sqlTongBv .=" And tenBaiViet like '%$sTen%' ";
		}
		if (isset($_GET["sMoTa"]) && !empty($_GET["sMoTa"]))
		{
			$sMoTa=$_GET["sMoTa"];
			$sMoTa = str_replace('"','&quot;',$sMoTa);
			$sMoTa = str_replace("'","''",$sMoTa);
			$sql .=" And moTa like '%$sMoTa%'";
			$sqlTongBv .=" And moTa like '%$sMoTa%'";
		}
		if (isset($_GET["sUser"]))
		{
			$sUser=$_GET["sUser"];
			$sql .=" And tenUser like '%$sUser%'";
			$sqlTongBv .=" And tenUser like '%$sUser%'";
		}
		if (isset($_GET["sNgayDangBai"]))
		{
			$sNgayDangBai=$_GET["sNgayDangBai"];
			$sql .=" And ngayDangBai like '%$sNgayDangBai%'";
			$sqlTongBv .=" And ngayDangBai like '%$sNgayDangBai%'";
		}
		if (isset($_GET["ddlPcat"]) && $_GET["ddlPcat"] != -1)
		{
			$theLoai=$_GET["ddlPcat"];
			$sql .=" And maTheLoai = $theLoai";
			$sqlTongBv .=" And maTheLoai = $theLoai";
		}
		if (isset($_GET["ddlCat"]) && $_GET["ddlCat"] != -1)
		{
			$theLoaiCon=$_GET["ddlCat"];
			$sql .=" And maTheLoaiCon = $theLoaiCon";
			$sqlTongBv .=" And maTheLoaiCon = $theLoaiCon";
		}
		if (isset($_GET["ddlTT"]) && $_GET["ddlTT"] != -1)
		{
			$sql .=" And tinhTrangBv = $tt";
			$sqlTongBv .=" And tinhTrangBv = $tt";
		}
		$resultTongBv=mysqli_query($con,$sqlTongBv);
		$rowTongBv=mysqli_fetch_array($resultTongBv);
		$tongBv=$rowTongBv["tongBv"];
		$soBv1trang=8;
		$tongSoTrang=ceil($tongBv/$soBv1trang);
		$start=0;
		$page=1;
		if (isset($_GET["page"]))
		{
			$page=$_GET["page"];
			$start=($_GET["page"]-1)*$soBv1trang;
		}
		$_SESSION["urladmin"]="&page=$page";
		$sql .=" order by maBaiViet desc limit $start, $soBv1trang";
		$result=mysqli_query($con,$sql);
		$dem=mysqli_num_rows($result);
		if($dem!=0)
		{
		?>
	<table cellspacing="0" border="1" width="100%">
		<tr>
			<th>Mã Bài Viết</th>
			<th width="20%">Tên Bài Viết</th>
			<th>Ảnh</th>
			<th>Thể Loại</th>
			<th>Thể Loại Con</th>
			<th width="35%">Mô Tả</th>
			<th>Ngày Đăng Bài</th>
			<th>Người Viết Bài</th>
			<th>Tình Trạng</th>
			<th colspan="3">Chức Năng</th>
		</tr>
   <?php
		while($bv=mysqli_fetch_array($result))
		{
	?>
		<tr>
			<a name="<?php echo($bv["maBaiViet"]); ?>">
			<td><?php echo($bv["maBaiViet"]); ?></td>
			<td><?php echo ($bv["tenBaiViet"]); ?></td>
			<td><img src="<?php echo($bv["anh"]); ?>"width="100%"></td>
			<td><?php echo($bv["tenTheLoai"]); ?></td>
			<td><?php echo($bv["tenTheLoaiCon"]); ?></td>
			<td><?php echo substr($bv["moTa"],0,250)."..."; ?></td>
			<td><?php echo($bv["ngayDangBai"]); ?></td>
			<td><?php echo($bv["tenUser"]); ?></td>
			<td>
				<form method="post" action="chinhSuaBaiVietProcess.php">
					<input type="hidden" name="txtmaBaiViet" value="<?php echo($bv["maBaiViet"]); ?>">
					 <table>
					 <?php
					 if($_SESSION["phanQuyen"]==1)
					 {
					 ?>
					 <tr>
						<td><?php if($bv["tinhTrangBv"]==1) echo ("Đã duyệt"); else echo ("Chưa duyệt"); ?></td>
					 </tr>
					 <?php
					 }else {
					 ?>
					<tr>
						<td><input type="radio" name="rdbTinhTrang" <?php if($bv["tinhTrangBv"]==0){ ?> checked="checked" <?php } ?> value="0" onclick="this.form.submit();" /><br /> Chưa duyệt</td>
						<td><input type="radio" name="rdbTinhTrang" <?php if($bv["tinhTrangBv"]==1){ ?> checked="checked" <?php } ?> value="1" onclick="this.form.submit();" /><br /> Đã duyệt</td>
				   </tr> 
				   <?php
					 }
					?>
					</table>
				</form>
			</td></a>
			<th><button type="button" onClick="window.open('../giaoDien/index.php?id=<?php echo($bv["maBaiViet"]); ?>','_blank')" style="height:51px">Xem Nội Dung</button></th>
			<th>
				<?php if ($_SESSION["phanQuyen"]==1 && $bv["tinhTrangBv"]==1) { ?>
					<button type="button" onClick="return confirm('Bạn không thể chỉnh sửa vì bài viết đã duyệt!')" style="height:51px">Chỉnh Sửa</button> 
				<?php } else { ?>
					<button type="button" onClick="location.href='chinhSuaBaiViet.php?id=<?php echo($bv["maBaiViet"]); ?>'" style="height:51px">Chỉnh Sửa</button> 
				<?php } ?>
			</th>
			<th>
				<?php if ($_SESSION["phanQuyen"]==1 && $bv["tinhTrangBv"]==1) { ?>
					<button type="button" onClick="return confirm('Bạn không thể xóa vì bài viết đã duyệt!')" style="height:51px">Xóa</button> 
				<?php } else { ?>
					<button type="button" onClick="if(confirm('Bạn có chắc chắn muốn xóa!'))location.href='xoaBaiVietProcess.php?id=<?php echo($bv["maBaiViet"]); ?>'" style="height:51px">Xóa</button> 
				<?php } ?>
			</th>
			
		</tr>
	<?php
		}
		}else
		echo "<h2>Không tìm thấy kết quả!</h2>"
	?>
	</table>
	<?php
	$urladmin ="";
	if(isset($sTen)) $urladmin .= "&sTen=$sTen";
	if(isset($sMoTa)) $urladmin .= "&sMoTa=$sMoTa";
	if(isset($sUser)) $urladmin .= "&sUser=$sUser";
	if(isset($theLoai)) $urladmin .= "&ddlPcat=$theLoai";
	if(isset($theLoaiCon)) $urladmin .= "&ddlCat=$theLoaiCon";
	if(isset($tt)) $urladmin .= "&ddlTT=$tt";
	$_SESSION["urladmin"] .= $urladmin;
	if($tongSoTrang>1)
	{
	?>
	<table style="margin-left:100px; margin-top:100px; ">
	<tr>
		<td>Trang: </td>
	<?php
		if($page > 1)
		{
			$i = $page - 1;
			$prev = "&page=$i";
			$prev .= $urladmin;
	?>
			<td><button type="button" onClick="location.href='?dsbv<?php echo("$prev"); ?>'">Prev</button></td>
	<?php
		}
		if($page <= 2) $startpage = 1;
		else if($page == $tongSoTrang) $startpage = $page - 4;
		else if($page == $tongSoTrang - 1) $startpage = $page - 3;
		else $startpage = $page - 2;
		$endpage = $startpage + 4;
		if($tongSoTrang > 5)
		{
		for ($i=$startpage; $i <= $endpage; $i++)
			{
	?>
				<td>
					<button type="button" onClick="location.href='?dsbv<?php echo("&page=$i"); ?>'">
						<?php echo ($i); ?>
					</button>
				</td>
	<?php
			}
		}
		else
		{
		for ($i=1; $i <= $tongSoTrang; $i++)
			{
				$pageloop = "&page=$i";
				$pageloop .= $urladmin;

	?>
				<td>
					<button type="button" onClick="location.href='?dsbv<?php echo($pageloop); ?>'">
						<?php echo ($i); ?>
					</button>
				</td>
	<?php
			}
		}
			if($page < $tongSoTrang)
			{
			$i = $page + 1;
			$next = "&page=$i";
			$next .= $urladmin;
	?>
			<td><button type="button" onClick="location.href='?dsbv<?php echo($next); ?>'">Next</button></td>

	<?php
			}
	?>
		</tr>
	</table>
	<table style="margin-left:100px; margin-top:1px; ">
		<tr>
			<form>
				<td>
                		<input type="hidden" name="dsbv">
					<?php
						if(isset($sTen)) echo("<input type='hidden' name='sTen' value='$sTen'>");
						if(isset($sMoTa)) echo("<input type='hidden' name='sMoTa' value='$sMoTa'>");
						if(isset($sUser)) echo("<input type='hidden' name='sUser' value='$sUser'>");
						if(isset($theLoai)) echo("<input type='hidden' name='ddlPcat' value='$theLoai'>");
						if(isset($theLoaiCon)) echo("<input type='hidden' name='ddlCat' value='$theLoaiCon'>");
						if(isset($tt)) echo("<input type='hidden' name='ddlTT' value='$tt'>");
					?>
					<select name="page">
					<?php
						for($i=1; $i <= $tongSoTrang; $i++)
						{
					?>
							<option value="<?php echo($i); ?>"<?php if($page==$i) { ?>selected="selected"<?php } ?>><?php echo($i); ?></option>
					<?php
						}
					?>
					</select>
				</td>
				<td><input type="submit" value="Sang trang"</td>
			</form>
		</tr>
	</table>
	<?php
	}
		include ("../Connectdb/close.php");
	?>
</center>
</body>
</html>
<script language="javascript" type="text/javascript">
	function dynamicdropdown(listindex)
	{
		document.getElementById("subcategory").length = 0;
		switch (listindex)
		{
				case "-1":
					document.getElementById("subcategory").options[0]=new Option("-Thể loại con-","-1");
					break;
	<?php
			include ("../Connectdb/open.php");
			$resultTl=mysqli_query($con,"select * from tbltheloai");
			while($tl=mysqli_fetch_array($resultTl))
			{
	?>
				case "<?php echo($tl["maTheLoai"]); ?>" :
					document.getElementById("subcategory").options[0]=new Option("-Thể loại con-","-1");
	<?php
					$i = 0;
					$maTheLoai = $tl["maTheLoai"];
					$resultTlc=mysqli_query($con,"select * from tbltheloaicon where maTheLoai=$maTheLoai");
					while($tlc=mysqli_fetch_array($resultTlc))
					{
						$i += 1;
						$maTheLoaiCon = $tlc["maTheLoaiCon"];
						$tenTheLoaiCon = $tlc["tenTheLoaiCon"];
	?>
					document.getElementById("subcategory").options[<?php echo($i); ?>]=new Option("<?php echo($tenTheLoaiCon); ?>","<?php echo($maTheLoaiCon); ?>");
	<?php
					}
	?>
					break;
	<?php
			}
			include ("../Connectdb/close.php");
	?>
		}
		return true;
	}
</script>