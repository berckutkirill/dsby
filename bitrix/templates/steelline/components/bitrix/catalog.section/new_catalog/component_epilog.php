<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$dmn = preg_replace("#PAGEN_1=[\d*]#","",$_SERVER["REQUEST_URI"]);
if(!empty($_GET['sort'])){
$patt = "#sort=[\w]*#";
	$sbp = preg_replace($patt,"sort=price",$dmn);
	$sbn = preg_replace($patt,"sort=name",$dmn);
} else {
	if(!empty($_GET)) {
		$sbp = $dmn."&sort=price";
	} else {
		$sbp = $dmn."?sort=price";
	}
}
if(!empty($_GET['order'])){
	if($_GET['order'] == "down"){
		$sbp = str_replace("order=down","order=up",$sbp);
		$sort = "up";
	} else {
		$sbp = str_replace("order=up","order=down",$sbp);
		$sort = "down";
	}
} else {
		$sbp = $sbp."&order=up";
}
?>
<script>
$(function(){

$("a.sort").attr("href","<?=$sbp?>");
})
<?if($_GET['sort']=="price") { ?> 
$("a.sort").addClass("active <?=$sort?>");
<? } ?>
</script>
<?
if($arResult['ID'] == 50) {
	if(filter_input(INPUT_COOKIE, "user_denied")) {
		return;
	}
	if(!$_SESSION['updated']) {
		$_SESSION['updated'] = time();
	}
	$_SESSION['in_catalog'] = true;
	if(!$_COOKIE['cnt_sess']) {
		setcookie('cnt_sess', 1, time()+3600 * 24 * 365);
	} else {
		if(time() - $_SESSION['updated'] >= TIME_FOR_POPUP) {
			$cnt = $_COOKIE['cnt_sess'] ? $_COOKIE['cnt_sess'] : 0;
			$cnt++;
			$_SESSION['updated'] = time();
			setcookie('cnt_sess', $cnt, time()+3600 * 24 * 365);
		}
	}
}