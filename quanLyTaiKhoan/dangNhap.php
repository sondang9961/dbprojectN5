<?php

	if(isset($_SESSION["username"]))
	{
		//Da dang nhap thi vao luon trang chu
		header("Location:../giaoDien/index.php");
		if($_SESSION["phanQuyen"]>0)
		{
			include ("../admin/quanLy.php");
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link rel="stylesheet" type="text/css" href="../style.css" />
<link rel="shortcut icon" href="/dbprojectN5/Images/favicon.JPG"  />
</head>

<body>
<?php
	if(isset($_GET["err"]))
	{
		$err=$_GET["err"];
		if($err==1)
		{
?>
			<script type="text/javascript">
				alert("Sai username, password (Hoặc tài khoản chưa tồn tại) !");
			</script>
<?php
		}
		else if($err==2)
		{
?>
			<script type="text/javascript">
				alert("Tài Khoản của bạn đã bị chặn!");
			</script>
<?php
		}	
	}
	if($_GET["dn"]==2)
	{
		?>
        	<script type="text/javascript">
				alert("Đăng ký thành công!");
			</script>
        <?php
	}
if(isset($_GET["mk"]))
{
	$pass=$_GET["mk"];
?>
	<script>alert("Mật khẩu của bạn là : <?php echo $pass; ?>");</script>
<?php
}
?>
</script>	
<center>
<div id="dn">
<?php
	$maBaiViet=$_GET["dn"];
?>
	<form id="frm" action="../quanLyTaiKhoan/dangNhapProcess.php" method="post">
		<table>
			<tr>
				<td colspan="2"><h1>Login</h1></td>
			</tr>
			<tr>
				<td><b>Username:</b><br>
					<input type="text" name="txtuser" id="txtuser" />
				</td>
                <td width="65%"><br><span id="errUser" class="err" ></span></td>
			</tr>
			<tr>
				<td><b>Password:</b><br>
					<input type="password" name="txtpass" id="txtpass" />
				</td>
                <td><br><span id="errPass" class="err" ></span></td>
			</tr>
			<tr>
				<td colspan="2">
                <input type="button" onclick="validateDn()" value="Đăng nhập" class="confirmbt"/> 
                <input type="button" onclick="location.href='../giaoDien/index.php'" value="Quay lại" style="cursor: pointer" /></td>
			</tr>
            <tr>
            	<td colspan="2" >
            		<a href="?dk" style="color:blue">Chưa có tài khoản?</a><br>
            		<a href="?llmk" style="color:blue">Quên mật khẩu?</a>  
            	</td>
            </tr>
		</table>
	</form>
   </div>
</center>
</body>
</html>
<script>
	function validateDn(){
		var dem=0;
		var username=document.getElementById("txtuser").value;
		var pass=document.getElementById("txtpass").value;
		var errUser=document.getElementById("errUser");
		var errPass=document.getElementById("errPass");
		//validate
		if(username.length==0)
		{
			errUser.innerHTML="Bạn chưa nhập Username!";	
		}else
		{
			errUser.innerHTML="";
			dem++	
		}
		if(pass.length==0)
		{
			errPass.innerHTML="Bạn chưa nhập Password!";	
		}else
		{
			errPass.innerHTML="";
			dem++	
		}
		if(dem==2)
		{
			document.getElementById("frm").submit();	
		}
	}
</script>