<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../style.css" />
</head>

<body>
<?php
	include ("../Connectdb/open.php");
	if(isset($_GET["pcat"]))
	{
		$maTheLoai=$_GET["pcat"];
		$resultTongBv=mysqli_query($con,"select count(*) as tongBv from (select maBaiViet from tblTheLoai inner join (select tblTheLoaiCon.maTheLoaiCon, tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maTheLoai, tinhTrangBv from tblBaiViet inner join tblTheLoaiCon on tblBaiViet.maTheLoaiCon = tblTheLoaiCon.maTheLoaiCon)a on tblTheLoai.maTheLoai = a.maTheLoai where a.maTheLoai = $maTheLoai and tinhTrangBv=1)b");
		$_SESSION["url"]="?pcat=$maTheLoai";
	}
	else if(isset($_GET["cat"]))
	{
		$maTheLoaiCon=$_GET["cat"];
		$resultTongBv=mysqli_query($con,"select count(*) as tongBv from (select maBaiViet from tblTheLoai inner join (select tblTheLoaiCon.maTheLoaiCon, tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maTheLoai, tinhTrangBv from tblBaiViet inner join tblTheLoaiCon on tblBaiViet.maTheLoaiCon = tblTheLoaiCon.maTheLoaiCon)a on tblTheLoai.maTheLoai = a.maTheLoai where a.maTheLoaiCon = $maTheLoaiCon and tinhTrangBv=1)b");
		$_SESSION["url"]="?cat=$maTheLoaiCon";
	}
	if(isset($_GET["txtSearch"]))
	{
		$tenBaiViet=$_GET["txtSearch"];
		$tenBaiViet = str_replace('"','&quot;',$tenBaiViet);
        $tenBaiViet = str_replace("'","''",$tenBaiViet);
		$moTa=$_GET["txtSearch"];
		$moTa = str_replace('"','&quot;',$moTa);
        $moTa = str_replace("'","''",$moTa);
		$sql = "select count(*) as tongBv from (select maBaiViet from tblTheLoai inner join (select tblTheLoaiCon.maTheLoaiCon, tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maTheLoai, tinhTrangBv from tblBaiViet inner join tblTheLoaiCon on tblBaiViet.maTheLoaiCon = tblTheLoaiCon.maTheLoaiCon)a on tblTheLoai.maTheLoai = a.maTheLoai where tenBaiViet like '%$tenBaiViet%' or moTa like '%$moTa%' and tinhTrangBv=1)b";
		$resultTongBv=mysqli_query($con,$sql);
		$_SESSION["url"]="?txtSearch=$tenBaiViet";
	}
	$rowTongBv=mysqli_fetch_array($resultTongBv);
	$tongBv=$rowTongBv["tongBv"];
	$soBv1trang=4;
	$tongSoTrang=ceil($tongBv/$soBv1trang);
	$start=0;
	$page=1;
	if (isset($_GET["page"]))
	{
		$page=$_GET["page"];
		$start=($_GET["page"]-1)*$soBv1trang;
		$_SESSION["url"].="&page=$page";
	}
	if(isset($_GET["pcat"]))
	{
		$result=mysqli_query($con,"select * from tblTheLoai inner join (select tblTheLoaiCon.maTheLoaiCon, tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maTheLoai, tinhTrangBv, ngayDangBai from tblBaiViet inner join tblTheLoaiCon on tblBaiViet.maTheLoaiCon = tblTheLoaiCon.maTheLoaiCon)a on tblTheLoai.maTheLoai = a.maTheLoai where a.maTheLoai = $maTheLoai and tinhTrangBv=1 order by maBaiViet desc limit $start,$soBv1trang");
	}
	else if(isset($_GET["cat"]))
	{
		$result=mysqli_query($con,"select * from tblTheLoai inner join (select tblTheLoaiCon.maTheLoaiCon, tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maTheLoai, tinhTrangBv, ngayDangBai from tblBaiViet inner join tblTheLoaiCon on tblBaiViet.maTheLoaiCon = tblTheLoaiCon.maTheLoaiCon)a on tblTheLoai.maTheLoai = a.maTheLoai where a.maTheLoaiCon = $maTheLoaiCon and tinhTrangBv=1 order by maBaiViet desc limit $start,$soBv1trang");
	}
	if(isset($_GET["txtSearch"]))
		{
			$sql = "select * from tblTheLoai inner join (select tblTheLoaiCon.maTheLoaiCon, tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maTheLoai, tinhTrangBv, ngayDangBai from tblBaiViet inner join tblTheLoaiCon on tblBaiViet.maTheLoaiCon = tblTheLoaiCon.maTheLoaiCon)a on tblTheLoai.maTheLoai = a.maTheLoai where tenBaiViet like '%$tenBaiViet%' or moTa like '%$moTa%' and tinhTrangBv=1 limit $start,$soBv1trang";
			$result=mysqli_query($con,$sql);
			$ketQua=mysqli_num_rows($result);
			if ($ketQua==0)
				{
				?>
					<h3><center><?php echo "Không tìm thấy kết quả!";?></center></h3>
				<?php
                }
		}
	?> 
    <?php
	if(isset($_GET["pcat"]) || isset($_GET["cat"]) || $_GET["txtSearch"])
	{
	?>
    <table>
    <?php
	while ($bv=mysqli_fetch_array($result))
		{
	?>
		<tr>
			<td>
			<button type="button" id="a2"> <a href='?pcat=<?php echo($bv["maTheLoai"]);?>' id="a2">
			<?php echo ($bv["tenTheLoai"]); ?></a></button>
			<button type="button" id="a4"> <a href='?cat=<?php echo($bv["maTheLoaiCon"]);?>' id="a4"><?php echo ($bv["tenTheLoaiCon"]); ?></a></button>
			</td>
		</tr>
		<tr>	
			<td>	
				<table style=" #666666 solid 1px">
					<tr>
						<td rowspan="4" valign="top" ><a href="?id=<?php echo ($bv["maBaiViet"]); ?>"><img src="<?php echo ($bv["anh"]); ?>" height="150px" width="150px" /></a></td>
					</tr>
					<tr>
						<td height="30px" style="vertical-align:top; font-size:25px; font-weight:bold"><a href="?id=<?php echo ($bv["maBaiViet"]); ?>" style="text-decoration:none; color:#000000"><?php echo $bv["tenBaiViet"] ;?></a></td>
					</tr>
					<tr>
						<td valign="top" style=" vertical-align:top;padding-top:2px"><?php echo $bv["moTa"] ;?></td>
					</tr>
					<tr>
						<td valign="top" style="vertical-align:top;padding-top:2px; color:#999; font-size:14px"><?php echo ($bv["ngayDangBai"]) ;?></td>
					</tr>
				</table>
			</td>
		</tr>	
	<?php
		}
	?>	
	</table>
    <?php
	}
	if ($tongSoTrang>1) //Nếu tồn tại bài viết
	{
	?>
	<table style="margin-left:100px; margin-top:100px; ">
		<tr>
        	<td>Trang: </td>
	<?php
		$url ="";
		if(isset($_GET["pcat"])) $url .= "&pcat=$maTheLoai";
		if(isset($_GET["cat"])) $url .= "&cat=$maTheLoaiCon";
		if(isset($_GET["txtSearch"])) $url .= "&txtSearch=$tenBaiViet";
		//Những trường hợp đang lọc theo Thể loại, Thể loại con và Search theo tên sẽ bổ sung thêm vào đường link
		if($page > 1) //Trường hợp trang hiện tại không phải trang đầu
		{
			$i = $page - 1; //Lấy đánh số trang của trang trước đó
			$prev = "?page=$i"; //Lấy đường link
			$prev .= $url;
	?>
			<td><button type="button" onClick="location.href='<?php echo($prev); ?>'">Prev</button></td>
	<?php
		}
		if($page <= 2) $startpage = 1; //Trường hợp trang hiện tại là trang 1 và 2 thì lấy đánh số trang bắt đầu từ trang 1 trong vòng lặp hiện đường link đổi trang theo dạng nút
		else if($page == $tongSoTrang) $startpage = $page - 4; //Trường hợp trang hiện tại là trang cuối thì lấy đánh số trang bắt đầu từ trang hiện tại -4
		else if($page == $tongSoTrang - 1) $startpage = $page - 3; //Trường hợp trang hiện tại là trang cuối -1 thì lấy đánh số trang bắt đầu từ trang hiện tại -3
		else $startpage = $page - 2; //Trường hợp còn lại lấy đánh số trang bắt đầu từ trang hiện tại -2
		$endpage = $startpage + 4; //Đánh số trang cuối cùng sẽ hiện ra trong vòng lặp hiện đường link đổi trang theo dạng nút
		if($tongSoTrang > 5) //Trường hợp có tổng số trang trên 5
		{
		for ($i=$startpage; $i <= $endpage; $i++) //Thì vòng lặp hiện đường link đổi trang theo dạng nút sẽ theo 2 điểm xác định ở trên
			{
			$i = $startpage;
			$pageloop = "?page=$i";
			$pageloop .= $url;
	?>
				<td>
                    <button type="button" onClick="location.href='<?php echo($pageloop); ?>'">
						<?php echo ($i); ?>
                    </button>
				</td>
	<?php
			}
		}
		else //Trường hợp có tổng số trang 5 trở xuống
		{
		for ($i=1; $i <= $tongSoTrang; $i++) //Thì vòng lặp hiện đường link đổi trang theo dạng nút sẽ đi từ trang đầu đến trang cuối
			{
			$pageloop = "?page=$i";
			$pageloop .= $url;
	?>
				<td>
                    <button type="button" onClick="location.href='<?php echo($pageloop); ?>'">
                        <?php echo ($i); ?>
                    </button>
				</td>
	<?php
			}
		}
			if($page < $tongSoTrang) //Trường hợp trang hiện tại không phải trang cuối
			{
			$i = $page + 1; //Lấy đánh số trang của trang tiếp theo
			$next = "?page=$i"; //Lấy đường link
			$next .= $url;
	?>
			<td><button type="button" onClick="location.href='<?php echo($next); ?>'">Next</button></td>

	<?php
			}
	?>
		</tr>
	</table>
	<table style="margin-left:100px; margin-top:1px; ">
		<tr>
			<form>
				<td>
					<?php
						if(isset($_GET["pcat"])) echo("<input type='hidden' name='pcat' value='$maTheLoai'>");
						if(isset($_GET["cat"])) echo("<input type='hidden' name='cat' value='$maTheLoaiCon'>");
						if(isset($_GET["txtSearch"])) echo("<input type='hidden' name='txtSearch' value='$tenBaiViet'>");
						//Những trường hợp đang lọc theo Thể loại, Thể loại con và Search theo tên sẽ bổ sung thêm vào đường link
					?>
					<select name="page">
					<?php
						for($i=1; $i <= $tongSoTrang; $i++) //Vòng lặp đổi trang theo dạng drop down list, hiện ra toàn bộ số trang
						{
					?>
							<option value="<?php echo($i); ?>"<?php if($page==$i) { ?>selected="selected"<?php } ?>><?php echo($i); ?></option>

					<?php
						}
					?>
					</select>
				</td>
				<td><input type="submit" value="Sang trang"</td>
			</form>
		</tr>
	</table>
	<?php
		}
		include ("../Connectdb/close.php");
	?>
</body>
</html>