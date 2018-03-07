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

?>

<script src="https://api-maps.yandex.ru/2.1.3/?lang=ru_RU" type="text/javascript"></script>
<script>
var data = <?=$data?>;
</script>
<div class="map_app">
			<div class="wrap">
				<p class="title">Где купить входные двери  «Стальная линия»</p>
				<div class="map_big" id="map" style="width:1180px; height:700px">

				</div>
				<div class="point_list">
					<!--h2>Выберите область</h2>
					<select class="citySelect">
						<option value="Россия" selected>Все регионы</option>
						<?foreach($arResult["SELECT"] as $obl => $addrs){?>
					 <optgroup label="<?=$obl?>">
					    <option value="<?=$obl?>"><?=$obl?></option>
					  <optgroup>
						<? } ?>
					</select-->
					<ul class="wrap_obj">
						<?foreach($arResult['ITEMS'] as $arItem) {?>
						<li id="block_<?=$arItem["ID"]?>" class="block block_arrow" data-id="<?=$arItem["ID"]?>">
							<p class="h3" ><?=$arItem["NAME"]?></p>
							<?foreach($arItem["PROPERTIES"]["ADRESS"]["~VALUE"] as $val) { ?>
								<p class="adr"><?=$val?></p>
							<? } ?>
							<p class="phone">
							<?foreach($arItem["PROPERTIES"]["PHONES"]["VALUE"] as $val) { ?>
								<span><?=$val?></span>
							<? } ?>
							</p>
							<?if($arItem["PROPERTIES"]["WORK_TIME"]["VALUE"]) { ?>
							<p class="time">
							<?foreach($arItem["PROPERTIES"]["WORK_TIME"]["VALUE"] as $val) { ?>
								<?=$val?><br>
							<? } ?>
							</p>
							<? } if($arItem["PROPERTIES"]["EMAIL_TO"]["VALUE"]) { ?>
							<p class="email">
								<?=$arItem["PROPERTIES"]["EMAIL_TO"]["VALUE"]?>
							</p>
							<? } if($arItem["PROPERTIES"]["COUNT_MODELS"]["VALUE"]) { ?>
							<p class="site"><?=$arItem["PROPERTIES"]["COUNT_MODELS"]["NAME"]?>: <?=$arItem["PROPERTIES"]["COUNT_MODELS"]["VALUE"]?></p>
							<? } ?>
						</li>
						<? } ?>
					</ul>
				</div>
			</div>
		</div>
<?
}