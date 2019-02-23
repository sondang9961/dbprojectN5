<?php
	$_SESSION["url"]="";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../style.css" />
</head>

<body>
<?php
		include("..\Connectdb\open.php");
		$resultTheLoai=mysqli_query($con,"select * from tbltheloai");
	?>
<table>
  <?php
	while ($theLoai=mysqli_fetch_array($resultTheLoai))
		{
		$maTheLoai=$theLoai["maTheLoai"];
		$resultsltl=mysqli_query($con,"select count(*) as tongBv from (select maBaiViet from tblTheLoai inner join (select tblTheLoaiCon.maTheLoaiCon, tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maTheLoai, tinhTrangBv from tblBaiViet inner join tblTheLoaiCon on tblBaiViet.maTheLoaiCon = tblTheLoaiCon.maTheLoaiCon)a on tblTheLoai.maTheLoai = a.maTheLoai where a.maTheLoai = $maTheLoai and tinhTrangBv=1)b");
		$sltl=mysqli_fetch_array($resultsltl);
		$demBv=$sltl["tongBv"];
		if($demBv!=0)
		{
	?>
  <tr>
    <td style="border-bottom:1px black solid">
       		<a href="?pcat=<?php echo($theLoai["maTheLoai"]);?>" id="a6"><?php echo($theLoai["tenTheLoai"]); ?></a>
    </td>
  </tr>
  <tr>
    <td><table>
        <tr>
          <?php
				$dem=0;
				$maTheLoai=$theLoai["maTheLoai"];
				$result=mysqli_query($con,"select * from tblTheLoai inner join (select tblTheLoaiCon.maTheLoaiCon, tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maTheLoai, tinhTrangBv, ngayDangBai from tblBaiViet inner join tblTheLoaiCon on tblBaiViet.maTheLoaiCon = tblTheLoaiCon.maTheLoaiCon)a on tblTheLoai.maTheLoai = a.maTheLoai where a.maTheLoai = $maTheLoai and tinhTrangBv=1 order by maBaiViet desc limit 4");
				while ($bv=mysqli_fetch_array($result))
				{
					$dem++;
				?>
          <td valign="top"><table width="370px"; height="200px" >
              <tr valign="top">
                <td colspan="2" height="60px" valign="top"><a href="?id=<?php echo ($bv["maBaiViet"]); ?>" style="font-size:18px; font-weight:bold"><?php echo $bv["tenBaiViet"]; ?></a></td>
              </tr>
              <tr>
                <td valign="top"><a href="?id=<?php echo ($bv["maBaiViet"]); ?>"><img src="<?php echo ($bv["anh"]); ?>" height="150px" width="150px" /></a></td>
                <td valign="top">
                	<table>
                    	<tr>
                            <td valign="top" height="108px"><a href="?id=<?php echo ($bv["maBaiViet"]); ?>"><?php echo $bv["moTa"]; ?></a></td>
                        </tr>
                        <tr>
                            <td><a href='?cat=<?php echo($bv["maTheLoaiCon"]);?>' id="a7"><?php echo ($bv["tenTheLoaiCon"]); ?></a></td>
                        </tr>
						<tr>
                        	<td align="right" style="color:#999; font-size:12px"><?php echo($bv["ngayDangBai"]); ?></td>
                        </tr>
                    </tr></table></td>
              </tr>
            </table></td>
          <?php
					if($dem%2==0)
					{
				?>
        </tr>
        <tr>
          <?php
					}
				}
		  ?>
        </tr>
      </table><br /><br /></td>
 </tr>
  <?php
		}
		}
  ?>        
</table>
<?php
		include("..\Connectdb\close.php");
	?>
</body>
</html>