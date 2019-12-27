<?php
	include("../Connectdb/open.php");
	$maUser = $_SESSION["idUser"];
	$result=mysqli_query($con,"select * from tbluser where maUser=$maUser");
	$user=mysqli_fetch_array($result);
	include ("../Connectdb/close.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo($user["tenUser"]); ?></title>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="shortcut icon" href="/dbprojectN5/Images/favicon.JPG"  />
</head>

<body>
<?php
	if($_GET["ttcn"]==1)
	{
?>
	<script>
		alert("Đổi mật khẩu thành công!");
	</script>
<?php
	}
?>
    <center><h1>Thông tin cá nhân</h1></center>
    <div id="ttcn">
        <form method="post" id="frm" action='../quanLyTaiKhoan/capNhatThongTinProcess.php'>
        <table>
          <tr>
            <td width="150px"><b>Tên hiển thị: </b></td>
            <td><input type="text" id="txtten" name="txtten"value="<?php echo($user["tenUser"]); ?>"></td>
            <td width="50%"><span id="errTen" class="err"></span></td>
          </tr>
          <tr>
            <td><b>Email: </b></td>
            <td><input type="email" id="txtemail" name="txtemail" value="<?php echo($user["email"]); ?>"></td>
            <td><span id="errEmail" class="err"></span></td>
          </tr>
          <tr>
            <td><b>Ngày Sinh: </b></td>
            <td><input type="date" name="txtngaySinh" value="<?php echo($user["ngaySinh"]); ?>"></td>
          </tr>
          <tr>
            <td><b>Giới Tính: </b></td>
            <td>
            <input type="radio" name="rdbGt" value="0" <?php if($user["gioiTinh"] == 0) { ?> checked="checked" <?php } ?>>Khác
            <input type="radio" name="rdbGt" value="1" <?php if($user["gioiTinh"] == 1) { ?> checked="checked" <?php } ?>>Nam 
			<input type="radio" name="rdbGt" value="2" <?php if($user["gioiTinh"] == 2) { ?> checked="checked" <?php } ?>>Nữ
			</td>
          </tr>
          <tr>
            <td><b>Số Điện Thoại: </b></td>
            <td><input type="text" id="txtsdt" name="txtsdt" value="<?php echo($user["sdt"]); ?>"></td>
            <td><span id="errSdt" class="err"></span></td>
          </tr>
          <tr>
            <td valign="top"><b>Địa Chỉ: </b></td>
            <td><textarea cols="21" rows="8" id="txtdiachi" name="txtdiachi"><?php echo($user["diaChi"]); ?></textarea></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input type="button" value="Cập nhật" onclick="validate()" class="confirmbt"/>
              <?php $url=$_SESSION["url"]; ?>
              <button type="button" <?php if(isset($_GET["ad"])){?>onclick="location.href='../admin/quanLy.php?dsbv'" <?php } ?> onclick="location.href='../giaoDien/index.php<?php echo($url); ?>'" style="cursor: pointer;">Quay lại</button></td>
          </tr>
        </table>
        </form>
        <br /><br />
      </div>
</body>
</html>
<script>
	function validate() {
		//1
		var dem=0;
		var ten=document.getElementById("txtten").value;	
		var email=document.getElementById("txtemail").value;
		var sdt=document.getElementById("txtsdt").value;	
		//2
		var errTen=document.getElementById("errTen");	
		var errEmail=document.getElementById("errEmail");
		var errSdt=document.getElementById("errSdt");	
		//3
		var regEmail=/^[a-zA-Z]+[a-zA-Z0-9_.]*@[a-zA-Z]+\.?[a-zA-Z]{2,3}\.[a-zA-Z]{2,3}$/;
		var regTen= /^[a-zA-Z]+\s?[a-zA-Z]+\s?[a-zA-Z]+\s?[a-zA-Z]+$/;
		var regSdt=/^((09|03|07|08|05|01)+([0-9]{8})\b)$/;
		//validate
		//ten
		if(ten.length==0)
		{
			errTen.innerHTML="Không được để trống";	
		}
		else
		{
			var kqTen=regTen.test(ten);
			if(kqTen)
			{
				errTen.innerHTML="";
				dem++;
			}
			else
				errTen.innerHTML="Nhập đầy đủ họ tên";
		}
		//Email
		if(email.length==0)
		{
			errEmail.innerHTML="Không được để trống";
		}else
		{
			var kqEmail=regEmail.test(email);
			if(kqEmail)
			{
				errEmail.innerHTML="";
				dem++;
			}
			else
				errEmail.innerHTML="Bạn phải nhập đúng email";
		}
		//sdt
		var kqSdt=regSdt.test(sdt);
		if(kqSdt)
		{
			errSdt.innerHTML="";
			dem++;
		}else 
		{
			errSdt.innerHTML="Số điện thoại không hợp lệ!";
		}
	if (dem==3)
		{
			document.getElementById("frm").submit();	
		}
	}
</script>