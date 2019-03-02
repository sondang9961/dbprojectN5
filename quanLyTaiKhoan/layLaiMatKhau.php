<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="../style.css" />
</head>

<body>
<?php
if(isset($_GET["err"]))
{
	$err=$_GET["err"];
	if($err==1)
	{
?>
	<script>alert("Username hoặc Email không đúng!");</script>
<?php	
	}
}
?>
<center>
<div id="llmk">
	<form id="frm" method="post" action="../quanLyTaiKhoan/layLaiMatKhauProcess.php">
		<table>
			<tr>
				<td colspan="2"><h1>Lấy lại mật khẩu</h1></td>
			</tr>
			<tr>
				<td>Username:<br>
					<input type="text" name="txtuser" id="txtuser" /></td>
                <td width="60%"><br><span id="errUser" class="err" ></span></td>
			</tr>
			<tr>
				<td>Email:<br>
					<input type="text" name="txtemail" id="txtemail" /></td>
                <td><br><span id="errEmail" class="err" ></span></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="button" onclick="validate()" value="Lấy lại mật khẩu" class="confirmbt"/>
					<input type="button" onclick="location.href='../giaoDien/index.php?dn'" value="Quay lại" />
				</td>
		</table>
	</form>
   </div>
</center>
</body>
</html>
<script>
	function validate() {
		var dem=0;
		var username=document.getElementById("txtuser").value;
		var email=document.getElementById("txtemail").value;
		var errUser=document.getElementById("errUser");
		var errEmail=document.getElementById("errEmail");
		if (username.length==0)
		{
			errUser.innerHTML="Bạn chưa nhập username!";	
		}
		else
		{
			errUser.innerHTML="";
			dem++;
		}
		if (email.length==0)
		{
			errEmail.innerHTML="Bạn chưa nhập email!";	
		}
		else
		{
			errEmail.innerHTML="";
			dem++;
		}
		if(dem==2)
		{
			document.getElementById("frm").submit();
		}
	}
</script>