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
				errUser.innerHTML="Username phải bao gồm cả số !";
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
				errTen.innerHTML="Không đúng định dạng";
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
				<td colspan="2" align="center"><h1>Đăng Ký</h1></td>
			</tr>
			<tr>
				<td>Username:</td>
				<td> <input type="text" id="txtuser" name="txtuser"></td>
                <td width="50%"><span id="errUser" class="err"></span></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td> <input type="password" id="txtpass" name="txtpass"></td>
                <td><span id="errPass" class="err"></span></td>
			</tr>
			<tr>
				<td>Nhập lại:</td>
				<td> <input type="password" id="txtNhapLai"  ></td>
                <td><span id="errNhapLai" class="err"></span></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td> <input type="email" id="txtemail" name="txtemail"></td>
                <td><span id="errEmail" class="err"></span></td>
			</tr>
			<tr>
				<td>Tên hiển thị:</td>
				<td> <input type="text" id="txtten" name="txtten"></td>
                <td><span id="errTen" class="err"></span></td>
			</tr>
			<tr>
				<td align="right">
                   <input type="button" onClick="validate()" value="Đăng ký"> 
                </td>
                <td>
                   <input type="reset">
                   <button type="button" onClick="location.href='../giaoDien/index.php'"> Quay lại</button>
                </td>
			</tr>
		</table><br>
	</form>
    </div>
</center>
</body>
</html>