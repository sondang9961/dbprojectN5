<?php
	if(isset($_GET["cat"]))
	{
		$maTheLoaiCon=$_GET["cat"];
		include("../Connectdb/open.php");
		$result=mysqli_query($con,"select * from tbltheloaicon where maTheLoaiCon=$maTheLoaiCon");
		$tlc=mysqli_fetch_array($result);
		$resulttl=mysqli_query($con,"select * from tbltheloai");
		include("../Connectdb/close.php");
	}
	else
	{
		header("Location:danhSachTheLoai.php");
	}
	session_start();
	if($_SESSION["phanQuyen"]==0)
	header ("location:../giaoDien/index.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo($tlc["tenTheLoaiCon"]); ?></title>
<link rel="shortcut icon" href="/dbprojectN5/Images/favicon.JPG"  />
</head>

<body>
<center>
	<h1>Chỉnh Sửa Thể Loại Con</h1>
	<form action="chinhSuaTheLoaiConProcess.php" id="chinhSuaTheLoaiCon">
		<table>
			<tr>
				<td><input type="hidden" name="txtMaTheLoaiCon" value="<?php echo($tlc["maTheLoaiCon"]); ?>"></td>
			</tr>
			<tr>
				<td>Tên Thể Loại Con: </td>
				<td><input type="text" name="txtTenTheLoaiCon" id="txtTenTheLoaiCon" value="<?php echo($tlc["tenTheLoaiCon"]); ?>"></td>
			</tr>
			<tr>
				<td>Thuộc Thể Loại: </td>
				<td>
					<select name="ddlMaTheLoai">
	<?php
						while($tl=mysqli_fetch_array($resulttl))
						{
	?>
							<option value="<?php echo($tl["maTheLoai"]); ?>"<?php if($tlc["maTheLoai"]==$tl["maTheLoai"]) { ?>selected="selected"<?php } ?>><?php echo($tl["tenTheLoai"]); ?></option>
	<?php
						}
	?>
					</select>
				</td>
			</tr>
			<tr>
				<td><input type="button" value="Chỉnh Sửa" onclick="validate()"></td>
				<td><button type="button" onClick="location.href='quanLy.php?dstl'">Quay Lại</button></td>
			</tr>
		</table>
	</form>
</center>
</body>
</html>
<script type="text/javascript">
	function validate(){
		var dem=0;
		var tenTheLoaiCon=document.getElementById("txtTenTheLoaiCon").value;
		if(tenTheLoaiCon.length==0){
			alert("Bạn chưa nhập tên thể loại con!");
		}
		else if(tenTheLoaiCon.length!=0){
			document.getElementById("chinhSuaTheLoaiCon").submit();
		}
	}
</script>