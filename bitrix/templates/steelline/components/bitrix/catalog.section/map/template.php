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

<script src="https://api-maps.yandex.ru/2.1.3/?lang=ru_RU" data-skip-moving="true" type="text/javascript"></script>
<script>
var data = <?=$data?>;
</script>
<div class="map_app">
			<div class="wrap">
				<h1 class="title">Где купить входные двери  «Стальная линия»</h1>
				
				<div class="map_big" id="map" style="width:1180px; height:700px">

				</div>
				<div class="point_list">
					<!--h2>Выберите регион</h2>
					<select class="citySelect">
						<?foreach($arResult["SELECT"] as $obl => $addrs){?>
					  <optgroup label="<?=$obl?>">
						<?foreach($addrs as $addr){?>
					    <option value="<?= $addr?>"><?= $addr?></option>
						<? } ?>
					  </optgroup>
						<? } ?>
					</select-->
					<ul class="wrap_obj">
						<?foreach($arResult['ITEMS'] as $arItem) {?>
						<li id="block_<?=$arItem["ID"]?>" class="block block_arrow" data-id="<?=$arItem["ID"]?>">
							<h3 class="h3"><?=$arItem["NAME"]?></h3>
							<?foreach($arItem["PROPERTIES"]["ADRESS"]["~VALUE"] as $val) { ?>
								<p class="adr"><?=$val?></p>
							<? } ?>
							<p class="phone">
							<?foreach($arItem["PROPERTIES"]["PHONES"]["VALUE"] as $val) { ?>
								<span><a href="tel:<?=$val?>"><?=$val?></a></span>
							<? } ?>
							</p>
							<?if($arItem["PROPERTIES"]["WORK_TIME"]["VALUE"]) { ?>
							<p class="time">
							<?foreach($arItem["PROPERTIES"]["WORK_TIME"]["VALUE"] as $val) { ?>
								<?=$val?><br>
							<? } ?>
							</p>
							<? } if($arItem["PROPERTIES"]["COUNT_MODELS"]["VALUE"]) { ?>
							<p class="site"><?=$arItem["PROPERTIES"]["COUNT_MODELS"]["NAME"]?>: <?=$arItem["PROPERTIES"]["COUNT_MODELS"]["VALUE"]?></p>
							<? } ?>
							<b class="ajax_map" data-id="<?=$arItem["ID"]?>">Посмотреть фото магазина</b>
						</li>
						<? } ?>
					</ul>
				</div>
			</div>
		</div>
<div class="fade2"><i class="close"></i></div>
<div id="popup_place" class="popup"></div>
<?
}