<?php
	if(isset($_GET["pcat"]))
	{
		$maTheLoai=$_GET["pcat"];
		include("../Connectdb/open.php");
		$result=mysqli_query($con,"select * from tbltheloai where maTheLoai=$maTheLoai");
		$tl=mysqli_fetch_array($result);
		include("../Connectdb/close.php");
	}
	else
	{
		header("Location:danhSachTheLoai.php");
	}
	session_start();
	if(!isset($_SESSION["phanQuyen"]) || $_SESSION["phanQuyen"]==0)
	header ("location:../giaoDien/index.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo($tl["tenTheLoai"]); ?></title>
<link rel="stylesheet" type="text/css" href="../style.css" />
<link rel="shortcut icon" href="/dbprojectN5/Images/favicon.JPG"  />
</head>

<body>
<center>
	<h1>Chỉnh Sửa Thể Loại</h1>
	<form method="POST" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Đăng Ảnh Thể Loại: </td>
				<td>
					<input type="hidden" name="txtLink" value="4">
					<input type="hidden" name="pcat" value="<?php echo($tl["maTheLoai"]); ?>">
					<input type="file" name="fileToUpload" id="fileToUpload">
					<input type="submit" formaction="uploadAnhTheLoai.php" value="Đăng Ảnh" name="submit">
				</td>
			</tr>
		</table>
	</form>
	<form method="POST" action="chinhSuaTheLoaiProcess.php" id="chinhSuaTheLoai">
	<table>
		<input type="hidden" name="pcat" value="<?php echo($tl["maTheLoai"]); ?>">
		<tr>
			<td>Tên thể loại:</td>
			<td><input type="text" name="txtTenTheLoai" id="txtTenTheLoai" value="<?php echo $tl["tenTheLoai"]; ?>"></td>
			<td><span id="errTenTheLoai" class="err"></span></td>
		</tr>
		<tr>
			<td height="120" valign="top">Ảnh:</td>
			<td>
				<input type="hidden" name="txtAnh" value="<?php if(isset($_GET["anhTheLoai"])) echo($_GET["anhTheLoai"]); else echo($tl["anhTheLoai"]); ?>">
				<img src="<?php if(isset($_GET["anhTheLoai"])) echo($_GET["anhTheLoai"]); else echo($tl["anhTheLoai"]);?>" height="60px">
			</td>
		</tr>
		<tr>
			<td><input type="button" onclick="validate()" value="Sửa"></td>
			<td><button type="button" onclick="location.href='quanLy.php?dstl'">Quay lại</button></td>
		</tr>
	</table>
	</form>
</center>
</body>
</html>
<script type="text/javascript">
	function validate(){
		var dem=0;
		var tenTheLoai=document.getElementById("txtTenTheLoai").value;
		var errTenTheLoai=document.getElementById("errTenTheLoai");
		if(tenTheLoai.length==0){
			alert("Bạn chưa nhập tên thể loại!");
		}else if(tenTheLoai.length!=0)
			document.getElementById("chinhSuaTheLoai").submit();
	}
</script>