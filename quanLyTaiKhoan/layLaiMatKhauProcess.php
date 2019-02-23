<?php
	if(isset($_POST["txtuser"]) && isset($_POST["txtemail"]))
	{
		$username=$_POST["txtuser"];
		$email=$_POST["txtemail"];
		include ("../Connectdb/open.php");
		//Kiểm tra xem có tồn tại username và email trong dtbase k
		$result=mysqli_query($con,"select * from tbluser where username='$username' and email = '$email'");
		$dem=mysqli_num_rows($result);
		if($dem==0)	
		{
?>
            <?php header ("location:../giaoDien/index.php?llmk&err=1"); ?>
<?php	
		}
		//Nếu tồn tại thì lấy pass word cũ về
		else
		{
			$resultLayMk=mysqli_query($con,"SELECT pass FROM tbluser WHERE username='$username' AND email='$email'");
			$mk=mysqli_fetch_array($resultLayMk);
			$pass=$mk["pass"];
			header("location:../giaoDien/index.php?dn&mk=$pass");			
		}
	}
?>