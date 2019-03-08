<?php
	if($_SESSION["phanQuyen"]==0)
	header ("location:../giaoDien/index.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Thêm Bài Viết</title>
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
<link rel="stylesheet" type="text/css" href="../style.css" />
<link rel="shortcut icon" href="/dbprojectN5/Images/favicon.JPG"  />
</head>

<body>
<center>
	<h1>Thêm Bài Viết</h1>
    <div style="float:right">
	<form method="POST" enctype="multipart/form-data">	
    <div style="float:left">
	<table width="655px">
		<tr>
			<td>Đăng Ảnh Đại Diện: </td>
			<td>
				<input type="hidden" name="txtLink" value="1">
				<input type="file" name="fileToUpload" id="fileToUpload">
	 			<input type="submit" formaction="uploadAnhDaiDien.php" value="Đăng Ảnh" name="submit"><br>
	 			<b><i style="color:#F00">*Lưu ý: Đăng ảnh trước khi viết hay chỉnh sửa nội dung*</i></b>
	 		</td>
	 	</tr>
	 </table>
     </div>
	</form>
	<form action="themBaiVietProcess.php" id="frm" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Tên Bài Viết: </td>
				<td><input type="text" size="75%" name="txtTenBaiViet" id="txtTenBaiViet"></td>
                <td width="35%"><span id="errTen" class="err"></span></td>
			</tr>
			<tr>
				<td>Ảnh Hiển Thị: </td>
				<td>
					<input type="hidden" name="txtAnh" id="txtAnh" value="<?php if(isset($_GET["anh"])) echo($_GET["anh"]); ?>">
					<img src="<?php if(isset($_GET["anh"])) echo($_GET["anh"]);?>" height="100px">
				</td>
                <td><span id="errAnh" class="err"></span></td>
			</tr>
			<tr>
				<td>Thể Loại: </td>
				<td><select name="ddlTheLoaiCon" id="ddlTheLoaiCon">
                	<option value="-1">--Thể loại--</option>
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
							<option value="<?php echo($tlc["maTheLoaiCon"]); ?>"><?php echo($tlc["tenTheLoaiCon"]); ?></option>
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
                <td><span id="errTheLoai" class="err"></span></td>
			</tr>
			<tr>
				<td>Mô Tả: </td>
				<td><textarea cols="77" rows="3" name="txtMoTa" id="txtMoTa"></textarea></td>
				<td><span id="errMoTa" class="err"></span></td>
			</tr>
			<tr>
				<td valign="top">Nội Dung: </td>
				<td>
					<textarea cols="70" rows="15" name="txtNoiDung" id="txtNoiDung"></textarea>
				</td>
				<td><span id="errNoiDung" class="err"></span></td>
			</tr>
			<tr>
				<td colspan=2 align="right">
					<input type="button" value="Thêm" onClick="validate()">
					<button type="button" onClick="location.href='danhSachBaiViet.php'">Quay Lại</button>
				</td>
			</tr>
		</table>
	</form>
    </div>
</center>
</body>
</html>
<script>
	function validate()
	{
		var dem=0;
		var tenBv=document.getElementById("txtTenBaiViet").value;	
		var anh=document.getElementById("txtAnh").value;
		var theLoai=document.getElementById("ddlTheLoaiCon").value;		
		var moTa=document.getElementById("txtMoTa").value;
		var errTen=document.getElementById("errTen");	
		var errAnh=document.getElementById("errAnh");
		var errTheLoai=document.getElementById("errTheLoai");
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
		//thể loại
		if(theLoai==-1)
		{
			errTheLoai.innerHTML="Chưa chọn thể loại!";	
		}
		else
		{
			errTheLoai.innerHTML="";	
			dem++;
		}
		//Mota
		if(moTa.length==0)
		{
			errMoTa.innerHTML="Không được để trống!";	
		}
		else
		{
			errMoTa.innerHTML="";	
			dem++;
		}
		if(dem==4)
		{
			document.getElementById("frm").submit();	
		}
	}
</script>