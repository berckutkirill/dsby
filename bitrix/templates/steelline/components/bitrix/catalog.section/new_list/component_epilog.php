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
