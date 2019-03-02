<?php
	if($_SESSION["phanQuyen"]==0)
	header ("location:../giaoDien/index.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Danh Sách Thể Loại</title>
<link rel="shortcut icon" href="/dbprojectN5/Images/favicon.JPG"  />
</head>

<body>
<center>
	<h1>Danh Sách Thể Loại</h1>
	<table>
		<tr>
			<td>
	<?php
			include("../Connectdb/open.php");
			$resulttl=mysqli_query($con,"select * from tbltheloai");
			while($tl=mysqli_fetch_array($resulttl))
			{
				
				$maTheLoai=$tl["maTheLoai"];
				$resultsltl=mysqli_query($con,"select count(*) as tongBv from (select maBaiViet from tblTheLoai inner join (select tblTheLoaiCon.maTheLoaiCon, tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maTheLoai, tinhTrangBv from tblBaiViet inner join tblTheLoaiCon on tblBaiViet.maTheLoaiCon = tblTheLoaiCon.maTheLoaiCon)a on tblTheLoai.maTheLoai = a.maTheLoai where a.maTheLoai = $maTheLoai)b");
				$sltl=mysqli_fetch_array($resultsltl);
	?>
				<table border="1" cellspacing="0" width="100%">
					<tr>
						<th colspan="2">Thể loại</th>
						<th>Số lượng BV</th>
	<?php
					if($_SESSION["phanQuyen"]>1) 
					{ 
	?>
						<th colspan="2">Chức năng</th>
	<?php 
					}
	?>
					</tr>
					<tr align="center">
						<td width="25%"><h3><?php echo($tl['tenTheLoai']); ?></h3></td>
						<td width="5%"><img src="<?php echo($tl['anhTheLoai']); ?>" height="25px"></td>
						<td width="30%"><?php echo($sltl['tongBv']); ?></td>
	<?php
					if($_SESSION["phanQuyen"]>1) 
					{
	?>
						<td height="28px"><button type="button" onClick="location.href='chinhSuaTheLoai.php?pcat=<?php echo($maTheLoai); ?>'">Chỉnh Sửa</button></td>
 						<td>
 	<?php
						if ($sltl['tongBv']==0)
						{
	?>
							<button type="button" onClick="if(confirm('Bạn có chắc chắn muốn xóa!'))location.href='xoaTheLoaiProcess.php?pcat=<?php echo($maTheLoai); ?>'">Xóa</button>
	<?php
						}
						else
						{
	?>
							<button type="button" onClick="xoa()">Xóa</button>
							<script>
								function xoa()
								{
									alert ("Bạn không thể xóa được vì đã có bài viết thuộc thể loại này!")
								}
							</script>
	<?php
						}
	?>
						</td>
	<?php
					}
	?>
					</tr>
					<tr>
						<th colspan="2">Thể loại con</th>
						<th></th>
	<?php
					if($_SESSION["phanQuyen"]>1) 
					{ 
	?>
						<th colspan="3"></th>
	<?php 
					}
	?>
					</tr>
	<?php
				$resulttlc=mysqli_query($con,"select * from tbltheloaicon where maTheLoai=$maTheLoai");
				while($tlc=mysqli_fetch_array($resulttlc))
				{
					$maTheLoaiCon=$tlc['maTheLoaiCon'];
					$resultsltlc=mysqli_query($con,"select count(*) as tongBv from tblbaiviet where matheloaicon=$maTheLoaiCon");
					$sltlc=mysqli_fetch_array($resultsltlc);
	?>
            		<tr align="center">
		                <td colspan="2"><?php echo($tlc['tenTheLoaiCon']); ?></td>
						<td><?php echo($sltlc['tongBv']); ?></td>
    <?php 
					if($_SESSION["phanQuyen"]>1)
					{ 
    ?>
						<td><button type="button" onClick="location.href='chinhSuaTheLoaiCon.php?cat=<?php echo($maTheLoaiCon); ?>'">Chỉnh Sửa</button></td>
						<td>
	<?php
						if ($sltlc['tongBv']==0)
						{
	?>
                			<button type="button" onClick="if(confirm('Bạn có chắc chắn muốn xóa!'))location.href='xoaTheLoaiConProcess.php?cat=<?php echo($maTheLoaiCon); ?>'">Xóa</button>
	<?php
						}
						else
						{
	?>
							<button type="button" onClick="xoaTlc()">Xóa</button>
							<script>
								function xoaTlc()
							{
								alert ("Bạn không thể xóa được vì đã có bài viết thuộc thể loại này!");	
							}
							</script>
	<?php
						}
	?>
						</td>
	<?php
					}
	?>
					</tr>
	<?php
				}
	?>
				</table>
				<br>
	<?php
			}
			include("../Connectdb/close.php");
	?>
			</td>
	<?php
		if ($_SESSION["phanQuyen"]>1)
		{
	?>
			<td valign="top" width="800px">
				<div style="padding-left:100px; position:fixed">
					<h1>Thêm thể loại</h1>
					<form  method="post" enctype="multipart/form-data">
						<table>
							<tr>
								<td>Đăng Ảnh Thể Loại: </td>
								<td>
									<input type="hidden" name="txtLink" value="3">
									<input type="file" name="fileToUpload" id="fileToUpload">
									<input type="submit" formaction="uploadAnhTheLoai.php" value="Đăng Ảnh" name="submit">
								</td>
							</tr>
						</table>
					</form>
					<form action="themTheLoaiProcess.php" method="post" >
						<table>
							<tr>
								<td>Tên thể loại:</td>
								<td><input type="text" name="txtTenTheLoai" ></td>
							</tr>
							<tr>
								<td height="120" valign="top">Ảnh:</td>
								<td>
									<input type="hidden" name="txtAnh" value="<?php if(isset($_GET["anhTheLoai"])) echo($_GET["anhTheLoai"]); ?>">
									<img src="<?php if(isset($_GET["anhTheLoai"])) echo($_GET["anhTheLoai"]);?>" height="30px">
								</td>
							</tr>
							<tr>
								<td><input type="submit" value="Thêm"></td>
							</tr>
						</table>
					</form>
					<h1>Thêm thể loại con</h1>
					<form action="themTheLoaiConProcess.php">
						<table>
							<tr>
								<td>Tên thể loại con:</td>
								<td><input type="text" name="txtTenTheLoaiCon"></td>
							</tr>
							<tr>
								<td>Thuộc Thể Loại: </td>
								<td>
									<select name="ddlMaTheLoai">
	<?php
									include("../Connectdb/open.php");
									$resulttl=mysqli_query($con,"select * from tbltheloai");
									include("../Connectdb/close.php");
									while($tl=mysqli_fetch_array($resulttl))
									{
	?>
										<option value="<?php echo($tl["maTheLoai"]); ?>"><?php echo($tl["tenTheLoai"]); ?></option>
	<?php
									}
	?>
									</select>
								</td>
							</tr>
							<tr>
								<td><input type="submit" value="Thêm"></td>
							</tr>
						</table>
					</form>
				</div>
			</td>
	<?php
		}
	?>
		</tr>
	</table>
</center>
</body>
</html>