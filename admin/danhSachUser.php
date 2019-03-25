<?php
	if($_SESSION["phanQuyen"]==0)
	{
	header ("location:../giaoDien/index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if($_SESSION["phanQuyen"]==3) {?>Danh sách người dùng <?php } else { ?> Danh sách Biên tập viên và người đọc <?php } ?></title>
<link rel="shortcut icon" href="/dbprojectN5/Images/favicon.JPG"  />
</head>
<body>
<center>
	<h1><?php if($_SESSION["phanQuyen"]==3) {?>Danh sách người dùng <?php } else { ?> Danh sách Biên tập viên và người đọc <?php } ?></h1>
</center>
	<form id="danhSachUser">
	<b>Lọc: </b>
		<input type="hidden" name="dsuser">
		<input type="search" value="<?php if(isset($_GET["txtSearch"])) echo $_GET["txtSearch"]; ?>" name="txtSearch" placeholder="Theo tên hoặc username..." size="21" />
		<input type="search" value="<?php if(isset($_GET["txtSearchDc"])) echo $_GET["txtSearchDc"]; ?>" name="txtSearchDc"  placeholder="Theo địa chỉ..." />
		<input type="search" value="<?php if(isset($_GET["txtSearchEmail"])) echo $_GET["txtSearchEmail"]; ?>" name="txtSearchEmail" placeholder="Theo Email..." size="22" />
		<input type="date" value="<?php if(isset($_GET["txtSearchNgaySinh"])) echo $_GET["txtSearchNgaySinh"]; ?>" name="txtSearchNgaySinh" size="22" />
		<select name="ddlGt" id="ddlGt">
			<?php if(isset($_GET["ddlGt"])) $gt =  $_GET["ddlGt"]; else $gt = -1; ?>
			<option value="-1">Giới tính</option>
			<option value="1" <?php if($gt == 1) { ?> selected="selected" <?php } ?>>Nam</option>
			<option value="2" <?php if($gt == 2) { ?> selected="selected" <?php } ?>>Nữ</option>
			<option value="0" <?php if($gt == 0) { ?> selected="selected" <?php } ?>>Khác</option>
		</select>
		<select name="ddlQuyen" id="ddlQuyen">
				<?php if(isset($_GET["ddlQuyen"])) $quyen =  $_GET["ddlQuyen"]; else $quyen = -1; ?>
				<option value="-1">Quyền</option>
				<option value="0" <?php if($quyen == 0) { ?> selected="selected" <?php } ?>>Người đọc</option>
				<option value="1" <?php if($quyen == 1) { ?> selected="selected" <?php } ?>>Biên tập viên</option>
				<?php if($_SESSION["phanQuyen"]==3) { ?>
				<option value="2" <?php if($quyen == 2) { ?> selected="selected" <?php } ?>>Admin</option>
				<?php }?>
		</select>
		<select name="ddlTT" id="ddlTT">
				<?php if(isset($_GET["ddlTT"])) $tt =  $_GET["ddlTT"]; else $tt = -1; ?>
				<option value="-1">Tình trạng</option>
				<option value="0" <?php if($tt == 0) { ?> selected="selected" <?php } ?>>Bị chặn</option>
				<option value="1" <?php if($tt == 1) { ?> selected="selected" <?php } ?>>Hoạt động</option>
		</select>
		<input type="submit" value="Tìm kiếm" name="TimKiem"/>
		<button type="button" onclick="location.href='?dsuser'">Hiện tất cả</button>
	</form>
	<br>
	<?php
	include ("../Connectdb/open.php");
	if($_SESSION["phanQuyen"]==3)
	{
		$sql =" select * from tbluser where maQuyen<=2";
		$sqlTongUser="select count(*) as tongUser from tbluser where maQuyen<=2";
	}else if($_SESSION["phanQuyen"]==2)
	{	
		$sql =" select * from tbluser where maQuyen<2";
		$sqlTongUser="select count(*) as tongUser from tbluser where maQuyen<2";	
	}
	if(isset($_GET["txtSearch"]) && !empty($_GET["txtSearch"]))
	{
		$tenUserSearch=$_GET["txtSearch"];
		$sql .=" And (tenUser like '%$tenUserSearch%' or username='$tenUserSearch') ";
		$sqlTongUser .=" And (tenUser like '%$tenUserSearch%' or username='$tenUserSearch') ";		
	} if (isset($_GET["txtSearchDc"]) && !empty($_GET["txtSearchDc"]))
	{
		$diaChi=$_GET["txtSearchDc"];
		$sql .=" And diaChi like '%$diaChi%'";	
		$sqlTongUser .=" And diaChi like '%$diaChi%'";
	} if (isset($_GET["txtSearchEmail"]) && !empty($_GET["txtSearchEmail"]))
	{
		$email=$_GET["txtSearchEmail"];
		$sql .=" And email like '%$email%'";	
		$sqlTongUser .=" And email like '%$email%'";
	}
	if (isset($_GET["txtSearchNgaySinh"]) && !empty($_GET["txtSearchNgaySinh"]))
	{
		$ngaySinh=$_GET["txtSearchNgaySinh"];
		$sql .=" And ngaySinh like '%$ngaySinh%'";	
		$sqlTongUser .=" And ngaySinh like '%$ngaySinh%'";
	}
	if (isset($_GET["ddlGt"]) && $_GET["ddlGt"] != -1)
	{
		$gioiTinh=$_GET["ddlGt"];
		$sql .=" And gioiTinh = $gioiTinh ";	
		$sqlTongUser .=" And gioiTinh = $gioiTinh ";
	}
	if (isset($_GET["ddlQuyen"]) && $_GET["ddlQuyen"] != -1)
	{
		$maQuyen=$_GET["ddlQuyen"];
		$sql .=" And maQuyen = $maQuyen";	
		$sqlTongUser .=" And maQuyen = $maQuyen";
	}
	if (isset($_GET["ddlTT"]) && $_GET["ddlTT"] != -1)
	{
		$tinhTrangUser=$_GET["ddlTT"];
		$sql .=" And tinhTrangUser = $tinhTrangUser";
		$sqlTongUser .=" And tinhTrangUser = $tinhTrangUser";	
	}
	$resultTongUser=mysqli_query($con,$sqlTongUser);
	$rowTongUser=mysqli_fetch_array($resultTongUser);
	$tongUser=$rowTongUser["tongUser"];
	$soUser1trang=8;
	$tongSoTrang=ceil($tongUser/$soUser1trang);
	$start=0;
	$page=1;
	if (isset($_GET["page"]))
	{
		$page=$_GET["page"];
		$start=($_GET["page"]-1)*$soUser1trang;
	}
	$_SESSION["urladmin"]="&page=$page";
	$sql .=" order by maUser desc limit $start, $soUser1trang";
	$result=mysqli_query($con,$sql);
	$dem=mysqli_num_rows($result);
	if($dem!=0)
	{
	?>
<center>
	<table border="1" cellspacing="0">
		<tr>
			<th width="3%">Mã user</th>
			<th width="12%">Tên user</th>
			<th width="6%">Ngày sinh</th>
			<th width="3%">Giới tính</th>
			<th width="20%">Địa chỉ</th>
			<th width="14%">Email</th>
			<th width="7%">Số điện thoại</th>
			<th width="10%">Username</th>
			<th width="7.5%">Quyền</th>
			<th width="6.5%">Tình trạng</th>
			<th width="6.25%">Chức năng</th>
		</tr>
	<?php	
	while ($user=mysqli_fetch_array($result))
		{
	?>
		<tr>
			<td><?php echo($user["maUser"]);?></td>
			<td><?php echo($user["tenUser"]);?></td>
			<td><?php echo($user["ngaySinh"]);?></td>
			<td><?php if($user["gioiTinh"]==1) echo ("Nam"); else if($user["gioiTinh"]==2) echo ("Nữ");else if($user["gioiTinh"]==0) echo ("Khác");?></td>
			<td><?php echo($user["diaChi"]);?></td>
			<td><?php echo($user["email"]);?></td>
			<td><?php echo($user["sdt"]);?></td>
			<td><?php echo($user["username"]);?></td>
			<td>
				<?php
					if($_SESSION["phanQuyen"]==3)
					{
						if($user["maQuyen"]==0) echo("Người đọc"); 
						else if($user["maQuyen"]==1) echo ("Biên tập viên");
						else if($user["maQuyen"]==2) echo ("Admin");
					}else if($_SESSION["phanQuyen"]==2)
					{
						if($user["maQuyen"]==0) echo("Người đọc");
						else if($user["maQuyen"]==1) echo ("Biên tập viên");	
					}
				?>
			</td>
			<td>
				<form method="post" action="capNhatThongTinUserProcess.php">
				 <input type="hidden" id="txtmauser" name="txtmauser" value="<?php echo($user["maUser"]); ?>">
					<select name="TinhTrang" onchange="this.form.submit();">
						<option value="0" <?php if($user["tinhTrangUser"]==0) { ?> selected="selected" <?php } ?>>Bị chặn</option>
						<option value="1" <?php if($user["tinhTrangUser"]==1) { ?> selected="selected" <?php } ?>>Hoạt động</option>
					</select>
				</form>
			</td>
			<td align="center">
			<button type="button" onclick="location.href='capNhatThongTinUser.php?id=<?php echo($user["maUser"]); ?>'">Chỉnh sửa</button></td>
		</tr>
	<?php
		}
	}else echo "<center><h2>Không tìm thấy kết quả</h2></center>";
	?>
	</table><br />
	<?php
	$urladmin ="";
	if(isset($tenUserSearch)) $urladmin .= "&txtSearch=$tenUserSearch";
	if(isset($diaChi)) $urladmin .= "&txtSearchDc=$diaChi";
	if(isset($gt)) $urladmin .= "&ddlGt=$gt";
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
			<td><button type="button" onClick="location.href='?dsuser<?php echo("$prev"); ?>'">Prev</button></td>
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
					<button type="button" onClick="location.href='?dsuser<?php echo("&page=$i"); ?>'">
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
					<button type="button" onClick="location.href='?dsuser<?php echo($pageloop); ?>'">
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
			<td><button type="button" onClick="location.href='?dsuser<?php echo($next); ?>'">Next</button></td>

	<?php
			}
	?>
		</tr>
	</table>
	<table style="margin-left:100px; margin-top:1px; ">
		<tr>
			<form>
				<td>
                		<input type="hidden" name="dsuser">
					<?php
						if(isset($tenUserSearch)) echo("<input type='hidden' name='txtSearch' value='$tenUserSearch'>");
						if(isset($diaChi)) echo("<input type='hidden' name='txtSearchDc' value='$diaChi'>");
						if(isset($gt)) echo("<input type='hidden' name='ddlGt' value='$gt'>");
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
