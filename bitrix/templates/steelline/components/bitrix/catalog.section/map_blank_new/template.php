<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if (!empty($arResult['ITEMS']))
{
?>
<?
$array["type"] = "FeatureCollection";
$features = array();

foreach($arResult['ITEMS'] as $arItem)
{
	$id = $arItem["ID"];
	$name = $arItem["NAME"];
	$isSalon = $arItem["PROPERTIES"]["IS_SALON"]["VALUE"]?true:false;
	$baloon = htmlspecialchars_decode($arItem["PROPERTIES"]["BALOON_CONTENT"]["VALUE"]["TEXT"]);
	$cluster = $arItem["NAME"];
	$hint = $arItem["NAME"];
	$coordinates = explode(",", $arItem["PROPERTIES"]["COORDINATES"]["VALUE"]);
	$leftSelect[$id] = $arItem["PROPERTIES"]["ADRESS"]["VALUE"];
	$features[] = array(
			"type" => "Feature",
			"id" => $id,
			"isSalon" => $isSalon,
			"geometry" => array("type" => "Point", "coordinates" => $coordinates),
			"properties" => array("balloonContent" => $baloon, "clusterCaption" => $cluster, "hintContent" => $hint),
		);
}
$array["features"] = $features;
$data = json_encode($array, true);
$leftSelect = json_encode($leftSelect);
?>

<script src="https://api-maps.yandex.ru/2.1.3/?lang=ru_RU" type="text/javascript"></script>
<script>
var data = <?=$data?>;
var leftSelect = <?=$leftSelect?>;
for(var id in leftSelect) {
	$("#saloons").append("<option value='"+id+"'>"+leftSelect[id]+"</option>");
}

$("#saloons").on("change", function() {
	if($(this).val()) {
		$("#saloons").removeClass("err");
		doAction($(this).val(), "click");
	} else {
		$("#saloons").addClass("err");
	}
})
</script>
<div class="map_app">
	<div class="wrap">
		<div class="map_big" id="map" style="width:880px; height:500px"></div>
	</div>
</div>
<?
}