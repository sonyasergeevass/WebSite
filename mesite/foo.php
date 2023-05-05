<?php
require_once 'funcs.php';

$file = 'book.txt';
$data = date('d.m.Y H:i');
if(isset($_POST['name'])):
	$name = $_POST['name'];
endif;
if(isset($_POST['secret'])):
	$secret = $_POST['secret'];
endif;

if(isset($_POST['txt'])):
	$text = strip_tags(trim($_POST['txt']));
endif;
if(isset($text)):
	$text =  str_replace("\n", "", $text);
endif;

$mess = '';




if (isset($_GET['page'])) {
	$page = $_GET['page'];
}else{
	$page = 1;
}

//$page = $_GET['page'];
$onepages = 20;
$from = ((int)$page -1) * $onepages;

$arr = get_mess();
// $arr = @file($file);
if (!is_array($arr)) $arr = [];
$cou = count($arr);

$first=(int)$page*$onepages-$onepages;
$last=((int)$page*$onepages-1);

$prev = (int)$page -1;
$post = (int)$page +1;

$pagesCount = ceil($cou / $onepages);

if (isset($_POST['add'])) {
if (!empty($name) && !empty($text)) {
	if ($secret != 'uhklaerhgaerhguilserhgioerhgio') {
		return false;
	}

	save_mess();
    
	$f = fopen($file, "a");
	fputs($f, '<div class="badge badge-warning badge-pill">'.$name.' '.$data.'</div><br><div class="alert alert-success mt-3 p-1 alert-mess">'.$text.'</div><br>'."\n");

	$random = time();
	if (!empty($page)) {
		Header("Location: http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}?page=$pagesCount&$random#form");
	exit;
	}
	
}else{

 		Header("Location: http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}?page=$pagesCount&name=null#form");
 }
}
if(isset($_POST['name'])):
	if ($_GET['name'] == 'null') {
		$mess = '<div class="alert alert-danger mt-3 p-1 d-block">Заполните все поля</div>';
	}
endif;

$notnum = !is_numeric($page);
if ($page == $notnum || $page > $pagesCount) {
	//$mess = '<div class="alert alert-danger mt-3 p-1 d-block">Не верный запрос</div>';
	Header("Location: http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}?page=$pagesCount&name=notnum#form");
}

if(isset($_POST['name'])):
	if ($_GET['name'] == 'notnum') {
		$mess = '<div class="alert alert-danger mt-3 p-1 d-block">Такой страницы здесь нет!</div>';
	}
endif;






