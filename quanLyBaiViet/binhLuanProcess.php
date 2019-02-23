<?php
session_start();
if(isset($_GET["txtComment"]) && isset($_GET["id"]))
{
	$comment=$_GET["txtComment"];
	$id=$_GET["id"];
	$maUser=$_SESSION["idUser"];
	include ("../Connectdb/open.php");
	mysqli_query($con,"INSERT INTO tblcomment(noiDungComment, maBaiViet, maUser) VALUES ('$comment',$id,$maUser)");
	include ("../Connectdb/close.php");
	header ("location:../giaoDien/?id=$id#binhLuan");
}

