<?php
	session_start();
	if(isset($_GET["id"]))
	{
		include("../Connectdb/open.php");
		$maUser = $_GET["id"];
		$result=mysqli_query($con,"select * from tbluser where maUser=$maUser");
		$user=mysqli_fetch_array($result);
		include ("../Connectdb/close.php");
	}
	else
	{
		header("location:../admin/danhSachUser.php");
	}
	if($_SESSION["phanQuyen"]==0)
		header("location:../giaoDien/index.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cập Nhật Thông Tin Người dùng</title>
<link rel="shortcut icon" href="/dbprojectN5/Images/favicon.JPG" />
</head>

<body>
<center>
	<h1>Cập Nhật Thông Tin Người dùng</h1>
	<form action="capNhatThongTinUserProcess.php" method="post">
		<table>
			<tr>
				<td> <input type="hidden" id="txtmauser" name="txtmauser" value="<?php echo($user["maUser"]); ?>"></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td> <input type="email" id="txtemail" name="txtemail" value="<?php echo($user["email"]); ?>"></td>
			</tr>
			<tr>
				<td>Họ Tên:</td>
				<td> <input type="text" id="txtten" name="txtten" value="<?php echo($user["tenUser"]); ?>"></td>
			</tr>
			<tr>
				<td>Ngày sinh:</td>
				<td><input type="date" name="txtngaySinh" value="<?php echo($user["ngaySinh"]); ?>"></td>
          </tr>
			</tr>
			<tr>
				<td>Giới tính:</td>
				 <td>
                    <input type="radio" name="rdbGt" value="0" <?php if($user["gioiTinh"] == 0) { ?> checked="checked" <?php } ?>>Khác
                    <input type="radio" name="rdbGt" value="1" <?php if($user["gioiTinh"] == 1) { ?> checked="checked" <?php } ?>>Nam 
                    <input type="radio" name="rdbGt" value="2" <?php if($user["gioiTinh"] == 2) { ?> checked="checked" <?php } ?>>Nữ
                </td>
			</tr>
			<tr>
				<td>Số Điện Thoại:</td>
				<td><input type="text" id="txtsdt" name="txtsdt" value="<?php echo($user["sdt"]); ?>"></td>
			</tr>
			<tr>
				<td valign="top">Địa Chỉ:</td>
				<td><textarea cols="35" rows="5" id="txtdiachi" name="txtdiachi"><?php echo($user["diaChi"]); ?></textarea></td>
			</tr>
			<tr>
				<td>Quyền:</td>
				<td>
					<select name="txtquyen">
						<option value="0" <?php if($user["maQuyen"]==0) { ?> selected="selected" <?php } ?>>Người đọc</option>
						<option value="1" <?php if($user["maQuyen"]==1) { ?> selected="selected" <?php } ?>>Biên tập viên</option>
						 <?php
						if($_SESSION["phanQuyen"]==3)
						{
						?>
                        <option value="2" <?php if($user["maQuyen"]==2) { ?> selected="selected" <?php } ?>>Admin</option>
                        <?php
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Tình trạng:</td>
				<td>
					<input type="radio" name="TinhTrang" <?php if($user["tinhTrangUser"]==0){ ?> checked="checked" <?php } ?> value="0" /> Chặn
                    <input type="radio" name="TinhTrang" <?php if($user["tinhTrangUser"]==1){ ?> checked="checked" <?php } ?> value="1" /> Hoạt động
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2">
					<input type="submit" value="Cập nhật"/>
					<button type="button" onclick="location.href='quanLy.php?dsuser'" >Quay lại</button>
				</td>
			</tr>
	</table>
	</form>
</center>
</body>
</html>
