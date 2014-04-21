<?php
include_once("../include/connect.php");
if(isset($_POST['delete']) && isset($_POST['id'])){
		$query = "DELETE FROM product WHERE ID = $_POST[id]"; 
		$delete = $mysqli->query($query);
		if(is_file($_POST['image']))
		{
		$deleteImage = unlink($_POST['image']);
		} 
		if(is_link("picture/".$_POST['id']))
		{
		$deleteFolder = rmdir("picture/".$_POST['id']);
		}
	}
	header('Location: index.php');
?>