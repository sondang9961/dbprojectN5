<?php

	if(isset($_SESSION["username"]))
	{
		header("Location:../giaoDien/index.php");
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Đăng Ký</title>
<link rel="stylesheet" type="text/css" href="../style.css" />
<?php
	if(isset($_GET["err"]))
	{
?>
		<script type="text/javascript">
            alert("Tài khoản đã tồn tại!");
        </script>
<?php
	}
?>
<script type="text/javascript">
	function validate()
	{
		//1
		var dem=0;
		var userName=document.getElementById("txtuser").value;
		var pass=document.getElementById("txtpass").value;
		var nhapLai=document.getElementById("txtNhapLai").value;
		var email=document.getElementById("txtemail").value;
		var ten=document.getElementById("txtten").value;
		//2
		var errUser=document.getElementById("errUser");
		var errPass=document.getElementById("errPass");
		var errNhapLai=document.getElementById("errNhapLai");
		var errEmail=document.getElementById("errEmail");
		var errTen=document.getElementById("errTen");
		//3 
		var regUser =/^[a-zA-Z._0-9]+$/;
		var regPass =/^[a-zA-Z0-9]+$/;
		var regEmail=/^[a-zA-Z]+[a-zA-Z0-9_.]*@[a-zA-Z]+\.?[a-zA-Z]{2,3}\.[a-zA-Z]{2,3}$/;
		var regTen= /^[0-9]*[a-zA-Z]+\s?[a-zA-Z]+\s?[a-zA-Z]+\s?[a-zA-Z]+$/;
		//4
		//User
		if(userName.length==0)
		{
			errUser.innerHTML="Không được để trống";
		}
		else if(userName.length<6)
			{
				errUser.innerHTML="Phải có ít nhất 6 ký tự";
			}else
			{
				var kqUser=regUser.test(userName);
				if (kqUser)
				{
					errUser.innerHTML="";
					dem++;
				}
				else 
				errUser.innerHTML="Không đúng định dạng!";
			}
		//pass
		if(pass.length==0)
		{
			errPass.innerHTML="Không được để trống";
		}else
		{
			var kqPass=regPass.test(pass);
			if(kqPass)
			{
				errPass.innerHTML="";
				dem++;
			}
			else
				errPass.innerHTML="Không đúng định dạng"
		}
		//nhập lại
		if(nhapLai.length==0)
		{
			errNhapLai.innerHTML="Không được để trống";
		}else if(nhapLai != pass)
		{
			errNhapLai.innerHTML="Không khớp";
		}else
		{
			errNhapLai.innerHTML="";
			dem++;
		}	
		//email
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
				errEmail.innerHTML="Không đúng định dạng";
		}
		//ten
		if(ten.length==0)
		{
			errTen.innerHTML="Không được để trống";
		}else
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
		if(dem==5)
		{
			document.getElementById("frm").submit();
		}
	}
</script> 
<link rel="shortcut icon" href="/dbprojectN5/Images/favicon.JPG"  />
</head>

<body>
<center>
	<div id="dk">
	<form id="frm" method="post" action="../quanLyTaiKhoan/dangKyProcess.php">
		<table>
        	<tr>
				<td colspan="2"><h1>Đăng Ký</h1></td>
			</tr>
			<tr>
				<td style="padding-right: 12px">Username:<br>
					<input type="text" id="txtuser" name="txtuser" placeholder="Ví dụ: abc123...">
				</td>
                <td width="63%"><br><span id="errUser" class="err"></span></td>
			</tr>
			<tr>
				<td>Password:<br>
					<input type="password" id="txtpass" name="txtpass">
				</td>
                <td><br><span id="errPass" class="err"></span></td>
			</tr>
			<tr>
				<td>Nhập lại:<br>
					<input type="password" id="txtNhapLai"  >
				</td>
                <td><br><span id="errNhapLai" class="err"></span></td>
			</tr>
			<tr>
				<td>Email:<br>
					<input type="email" id="txtemail" name="txtemail" placeholder="Ví dụ: abc123@gmail.com...">
				</td>
                <td><br><span id="errEmail" class="err"></span></td>
			</tr>
			<tr>
				<td>Tên hiển thị:<br>
					<input type="text" id="txtten" name="txtten" placeholder="Ví dụ: Nguyen Van abc...">
				</td>
                <td><br><span id="errTen" class="err"></span></td>
			</tr>
			<tr>
				<td colspan="2">
                   <input type="button" onClick="validate()" value="Đăng ký" class="confirmbt"> 
                   <input type="reset" style="cursor: pointer">
                   <button type="button" onClick="location.href='../giaoDien/index.php'" style="cursor: pointer"> Quay lại</button><br>
                   <a href="?dn" style="color:blue">Đã có tài khoản, đăng nhập?</a><br>
                </td>
			</tr>
		</table><br>
	</form>
    </div>
</center>
</body>
</html>