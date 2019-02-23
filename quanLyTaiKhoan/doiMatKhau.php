<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Đổi mật khẩu</title>
<link rel="shortcut icon" href="/dbprojectN5/Images/favicon.JPG"  />
</head>

<body>
<?php
	if($_GET["dmk"]==1)
	{
?>
	<script>
		alert("Mật khẩu cũ không đúng!");
	</script>
<?php
	}

?>
<center>
<div id="dmk">
	<h1>Đổi mật khẩu</h1>
	<form method="post" id="frm" action="../quanLyTaiKhoan/doiMatKhauProcess.php">
	<table>
		<tr>
			<td>Nhập mật khẩu cũ:</td>
			<td><input type="password" id="txtpass" name="txtpass" /></td>
			<td style="position:fixed"><span id="errPass" class="err"></span></td>
		</tr>
		<tr>
			<td>Mật khẩu mới:</td>
			<td><input type="password" id="txtNewPass" name="txtNewPass" /></td>
			<td style="position:fixed"><span id="errNewPass" class="err"></span></td>
		</tr>
		<tr>
			<td>Nhập lại mật khẩu mới:</td>
			<td><input type="password" id="txtNhapLai" /></td>
			<td style="position:fixed"><span id="errNhapLai" class="err"></span></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" value="Đổi mật khẩu" onclick="validate()" />
			</td>
		</tr>
	</table>
	</form>
   </div><br />
</center>
</body>
</html>
<script type="text/javascript">
	function validate()
	{
		var dem=0;
		var pass=document.getElementById("txtpass").value;
		var newPass=document.getElementById("txtNewPass").value;
		var nhapLai=document.getElementById("txtNhapLai").value;
		var errPass=document.getElementById("errPass");
		var errNewPass=document.getElementById("errNewPass");
		var errNhapLai=document.getElementById("errNhapLai");
		//reg
		var regNewPass =/^[a-zA-Z0-9]+$/;
		if(pass.length==0)
			{
				errPass.innerHTML="Không được để trống";
			}
		else
			{
				errPass.innerHTML="";
				dem++;
			}
		if(newPass.length==0)
			{
				errNewPass.innerHTML="Không được để trống";
			}
		else
		{
			var kqNewPass=regNewPass.test(newPass);
			if(kqNewPass)
			{
				errNewPass.innerHTML="";
				dem++;
			}
			else
				errNewPass.innerHTML="Không đúng định dạng"
		}
		if(nhapLai.length==0)
			{
				errNhapLai.innerHTML="Không được để trống";
			}
		else if(newPass!=nhapLai)
			{
				errNhapLai.innerHTML="Không khớp";
			}
		else
			{
				errNhapLai.innerHTML="";
				dem++;
			}
		if (dem==3)
			{
				document.getElementById("frm").submit();
			}

	}
</script>