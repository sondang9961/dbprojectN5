<?php
	if($_SESSION["phanQuyen"]==0)
	{
	header ("location:../giaoDien/index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<center>
	<h1>Thống kê lượt xem bài đăng theo tháng</h1>
</center>
<form>
    <table>
        <tr>
            <td><input type="hidden" name="thongKe"></td>
        </tr>
        <tr>
            <td>Từ: <input type="date" name="ngayBatDau"  /> </td>
            <td>Đến: <input type="date" name="ngayKetThuc" /> </td>
            <td><input type="submit" value="Tìm" /></td>
        </tr>
        <tr align="center">
            <td><?php if(isset($_GET["ngayBatDau"])) { $ngayBatDau=$_GET["ngayBatDau"]; echo($ngayBatDau); }?></td>
            <td><?php if(isset($_GET["ngayKetThuc"])) { $ngayKetThuc=$_GET["ngayKetThuc"]; echo($ngayKetThuc); }?></td>
        </tr>
        </table>
    <br /><br />
</form>
    <?php
    if(isset($_GET["ngayBatDau"]) && isset($_GET["ngayKetThuc"]))
    {
        include ("../Connectdb/open.php");
        $ngayBatDau=$_GET["ngayBatDau"];
        $ngayKetThuc=$_GET["ngayKetThuc"];
        $resultThongKe=mysqli_query($con,"select COUNT(*) as thongKe from tbluser inner join (select a.maTheLoai, maTheLoaiCon, tenTheLoai,tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maUser, ngayDangBai, tinhTrangBv, luotXem, luotLuu from tbltheloai inner join (select maTheLoai, tblBaiViet.maTheloaiCon, tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maUser, ngayDangBai, tinhTrangBv, luotXem, luotLuu from tblBaiViet inner join tblTheLoaiCon on tblBaiViet.maTheLoaiCon = tblTheLoaiCon.maTheLoaiCon)a on tblTheLoai.maTheLoai = a.maTheLoai)b on tbluser.maUser = b.maUser where ngayDangBai BETWEEN '$ngayBatDau' AND '$ngayKetThuc order by luotXem desc'");
        $start=0;
        $page=1;
        $soBv1Trang=8;
        if (isset($_GET["page"]))
        {
            $page=$_GET["page"];
            $start=($_GET["page"]-1)*$soBv1Trang;
        }
        
        $rowThongKe=mysqli_fetch_array($resultThongKe);
        $tongBv=$rowThongKe["thongKe"];
        $tongSoTrang=ceil($tongBv/$soBv1Trang);    
        $_SESSION["urladmin"]="&page=$page";
        $result=mysqli_query($con,"select * from tbluser inner join (select a.maTheLoai, maTheLoaiCon, tenTheLoai,tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maUser, ngayDangBai, tinhTrangBv, luotXem, luotLuu from tbltheloai inner join (select maTheLoai, tblBaiViet.maTheloaiCon, tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maUser, ngayDangBai, tinhTrangBv, luotXem, luotLuu from tblBaiViet inner join tblTheLoaiCon on tblBaiViet.maTheLoaiCon = tblTheLoaiCon.maTheLoaiCon)a on tblTheLoai.maTheLoai = a.maTheLoai)b on tbluser.maUser = b.maUser where ngayDangBai BETWEEN '$ngayBatDau' AND '$ngayKetThuc' ORDER BY luotXem DESC limit $start, $soBv1Trang");
        $dem=mysqli_num_rows($result);
        if($dem!=0)
        {
    ?>
       	<table border="1" cellspacing="0">
        	<tr>
            	<th>Mã</th>
                <th>Tên bài viết</th>
                <th>Ảnh</th>
                <th>Thể loại</th>
                <th>Ngày đăng bài</th>
                <th>Người viết bài</th>
                <th>Số lượt xem</th>  
                <th>Số lượt lưu</th>         
            </tr>
    <?php
        while ($thongKe=mysqli_fetch_array($result))
        {
    ?>
            <tr>
                <td><?php echo($thongKe["maBaiViet"]); ?></td>
                <td><?php echo($thongKe["tenBaiViet"]); ?></td>
                <td><img src="<?php echo($thongKe["anh"]); ?>" width="70px"></td>
                <td><?php echo($thongKe["tenTheLoai"]); ?></td>
                <td><?php echo($thongKe["ngayDangBai"]); ?></td>
                <td><?php echo($thongKe["tenUser"]); ?></td>
                <td><?php echo($thongKe["luotXem"]); ?></td>
                <td><?php echo($thongKe["luotLuu"]); ?></td>
            </tr>
    <?php
        }
    ?>
        </table>
    <?php
        }else echo "<center><h2>Không tìm thấy kết quả</h2></center>";
    }
    $urladmin ="";
    if(isset($ngayBatDau) && isset($ngayKetThuc)) $urladmin .= "&ngayBatDau=$ngayBatDau&ngayKetThuc=$ngayKetThuc";
    $_SESSION["urladmin"] .= $urladmin;
    if(isset($tongSoTrang) && $tongSoTrang>1)
    {
    ?>
    <table style="margin-left:100px; margin-top:100px; ">
    <tr>
        <td>Trang: </td>
    <?php
        if($page > 1)
        {
            $i = $page - 1;
            $prev = "&page=$i";
            $prev .= $urladmin;
    ?>
            <td><button type="button" onClick="location.href='?thongKe<?php echo("$prev"); ?>'">Prev</button></td>
    <?php
        }
        if($page <= 2) $startpage = 1;
        else if($page == $tongSoTrang) $startpage = $page - 4;
        else if($page == $tongSoTrang - 1) $startpage = $page - 3;
        else $startpage = $page - 2;
        $endpage = $startpage + 4;
        if($tongSoTrang > 5)
        {
        for ($i=$startpage; $i <= $endpage; $i++)
            {
    ?>
                <td>
                    <button type="button" onClick="location.href='?thongKe<?php echo("&page=$i"); ?>'">
                        <?php echo ($i); ?>
                    </button>
                </td>
    <?php
            }
        }
        else
        {
        for ($i=1; $i <= $tongSoTrang; $i++)
            {
                $pageloop = "&page=$i";
                $pageloop .= $urladmin;

    ?>
                <td>
                    <button type="button" onClick="location.href='?thongKe<?php echo($pageloop); ?>'">
                        <?php echo ($i); ?>
                    </button>
                </td>
    <?php
            }
        }
            if($page < $tongSoTrang)
            {
            $i = $page + 1;
            $next = "&page=$i";
            $next .= $urladmin;
    ?>
            <td><button type="button" onClick="location.href='?thongKe<?php echo($next); ?>'">Next</button></td>

    <?php
            }
    ?>
        </tr>
    </table>
    <table style="margin-left:100px; margin-top:1px; ">
        <tr>
            <form>
                <td>
                    <input type="hidden" name="thongKe">
                    <?php
                        if(isset($ngayBatDau)) echo("<input type='hidden' name='ngayBatDau' value='$ngayBatDau'>");
                        if(isset($ngayKetThuc)) echo("<input type='hidden' name='ngayKetThuc' value='$ngayKetThuc'>");
                        
                    ?>
                    <select name="page">
                    <?php
                        for($i=1; $i <= $tongSoTrang; $i++)
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