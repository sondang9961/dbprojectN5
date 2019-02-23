<?php
	session_start();
	if(isset($_GET["id"]))
	{
		$maBaiViet=$_GET["id"];
		include("../Connectdb/open.php");
		$result=mysqli_query($con,"select * from tblbaiviet where maBaiViet=$maBaiViet");
		$bv=mysqli_fetch_array($result);
		include("../Connectdb/close.php");
	}
	else
	{
		header("Location:danhSachBaiViet.php");
	}
	if($_SESSION["phanQuyen"]==0)
	header ("location:../giaoDien/index.php");
?>
<!doctype html>
<html>
<head>
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=vooet7r7k164f9m1omlbo3i7lpos6w642lzqvcjscjgossef"></script>
  <script>
	tinymce.init({
    selector: '#txtNoiDung',
    plugins: 'image code',
    
    // without images_upload_url set, Upload tab won't show up
    images_upload_url: 'upload.php',
    
    // override default upload handler to simulate successful upload
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;
      
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', 'upload.php');
      
        xhr.onload = function() {
            var json;
        
            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }
        
            json = JSON.parse(xhr.responseText);
        
            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }
        
            success(json.location);
        };
      
        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
      
        xhr.send(formData);
    },
});
</script>
<meta charset="utf-8">
<title><?php echo ($bv["tenBaiViet"]); ?></title>
<link rel="stylesheet" type="text/css" href="../style.css" />
<link rel="shortcut icon" href="/dbprojectN5/Images/favicon.JPG"  />
</head>

<body>
<center>
	<h1>Chỉnh Sửa Bài Viết</h1>
    <div style="float:right">
	<form method="POST" enctype="multipart/form-data">	
    <div style="float:left">
	<table width="655px">
		<tr>
			<td>Đăng Ảnh Đại Diện: </td>
			<td>
				<input type="hidden" name="txtLink" value="2">
				<input type="hidden" name="txtmaBaiViet" value="<?php echo($bv["maBaiViet"]); ?>">
				<input type="file" name="fileToUpload" id="fileToUpload">
	 			<input type="submit" formaction="../admin/uploadAnhDaiDien.php" value="Upload Image" name="submit"><br>
	 			<i>*Lưu ý: Đăng ảnh trước khi viết hay chỉnh sửa nội dung*</i>
	 		</td>
	 	</tr>
	 </table>
     </div>
	</form>
	<form method="post" id="frm" action="chinhSuaBaiVietProcess.php">
		<table>
			<tr>
				<td><input type="hidden" name="txtmaBaiViet" value="<?php echo($bv["maBaiViet"]); ?>"></td>
			</tr>
			<tr>
				<td>Tên Bài Viết: </td>
				<td><input type="text" size="75%" name="txtTenBaiViet" id="txtTenBaiViet" value="<?php echo $bv["tenBaiViet"]; ?>"></td>
                <td width="35%"><span id="errTen" class="err"></span></td>
			</tr>
			<tr>
				<td>Ảnh Hiển Thị: </td>
				<td>
					<input type="hidden" name="txtAnh" id="txtAnh" value="<?php if(isset($_GET["anh"])) echo($_GET["anh"]); else echo($bv["anh"]); ?>">
					<img src="<?php if(isset($_GET["anh"])) echo($_GET["anh"]); else echo($bv["anh"]); ?>" height="100px">
				</td>
                <td><span id="errAnh" class="err"></span></td>
			</tr>
			<tr>
				<td>Thể Loại: </td>
				<td><select name="ddlTheLoaiCon">
	<?php
					include("../Connectdb/open.php");
					$resulttl=mysqli_query($con,"select * from tbltheloai");
					while($tl=mysqli_fetch_array($resulttl))
					{
	?>
						<optgroup label="<?php echo($tl["tenTheLoai"]); ?>">
	<?php
						$maTheLoai=$tl["maTheLoai"];
						$resulttlc=mysqli_query($con,"select * from tbltheloaicon where maTheLoai=$maTheLoai");
						while($tlc=mysqli_fetch_array($resulttlc))
						{
	?>
							<option value="<?php echo($tlc["maTheLoaiCon"]); ?>"<?php if($bv["maTheLoaiCon"]==$tlc["maTheLoaiCon"]) { ?>selected="selected"<?php } ?>><?php echo($tlc["tenTheLoaiCon"]); ?></option>
	<?php
						}
	?>
						</optgroup>
	<?php
					}
					include("../Connectdb/close.php");
	?>
					</select>
				</td>
			</tr>
			

			<tr>
				<td>Mô Tả: </td>
				<td><textarea cols="70" rows="3" name="txtMoTa" id="txtMoTa"><?php echo $bv["moTa"]; ?></textarea></td>
                <td><span id="errMoTa" class="err"></span></td>
			</tr>
			<tr>
				<td>Nội Dung: </td>
				<td><textarea cols="70" rows="15" name="txtNoiDung" id="txtNoiDung"><?php echo base64_decode($bv["noiDung"]); ?></textarea></td>
			</tr>
            <tr>
            	<td>Tình trạng:</td>
                <td><input type="radio" name="rdbTinhTrang" value="0" <?php if($bv["tinhTrangBv"]==0){?> checked="checked" <?php } ?>>Chưa duyệt
                	<input type="radio" name="rdbTinhTrang" value="1" <?php if($bv["tinhTrangBv"]==1){?> checked="checked" <?php } ?>>Đã duyệt
                </td>
            </tr>
            <tr height="30px">
				<td></td>
			</tr>
			<tr>
				<td><input type="button" onclick="validate()" value="Chỉnh Sửa"></td>
				<?php $urladmin=$_SESSION["urladmin"]; ?>
				<td><button type="button" onClick="location.href='quanLy.php?dsbv<?php echo($urladmin)?>'">Quay Lại</button></td>
			</tr>
		</table>
   </div> 
	</form>
</center>
</body>
</html>
<script>
	function validate()
	{
		var dem=0;
		var tenBv=document.getElementById("txtTenBaiViet").value;	
		var anh=document.getElementById("txtAnh").value;
		var moTa=document.getElementById("txtMoTa").value;		
		var errTen=document.getElementById("errTen");	
		var errAnh=document.getElementById("errAnh");
		var errMoTa=document.getElementById("errMoTa");
		//validate
		//ten
		if(tenBv.length==0)
		{
			errTen.innerHTML="Không được để trống!";	
		}
		else if(tenBv.length>=150)
		{
			errTen.innerHTML="Không được quá 150 ký tự!";	
		}
		else
		{
			errTen.innerHTML="";	
			dem++;
		}
		//anh
		if(anh.length==0)
		{
			errAnh.innerHTML="Chưa đăng ảnh!";	
		}
		else
		{
			errAnh.innerHTML="";	
			dem++;
		}
		//mota
		if(moTa.length==0)
		{
			errMoTa.innerHTML="Không được để trống!";	
		}
		else if(moTa.length>=250)
		{
			errMoTa.innerHTML="Không được quá 250 ký tự!";	
		}
		else
		{
			errMoTa.innerHTML="";	
			dem++;
		}
		if(dem==3)
		{
			document.getElementById("frm").submit();	
		}
	}
</script>