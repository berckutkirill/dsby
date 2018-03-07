<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$FURNISH_INSIDE = CFile::GetPath($arResult["PROPERTIES"]["VIEW_INSIDE"]["VALUE"]);
$FURNISH_OUTSIDE = CFile::GetPath($arResult["PROPERTIES"]["VIEW_OUTSIDE"]["VALUE"]);
$DETAIL_2 = CFile::GetPath($arResult["PROPERTIES"]["VIEW_OUTSIDE_DETAIL"]["VALUE"]);

$hblock = GetHBlock(3);
foreach($hblock as $eq)
{
	$BASIC[$eq["UF_XML_ID"]] = $eq;
	$BASIC[$eq["UF_XML_ID"]]["FILE_SRC"] = CFile::GetPath($eq["UF_FILE"]);
}

$hblock = GetHBlock(6);
foreach($hblock as $eq)
{
	$VARIANTS[$eq["UF_XML_ID"]] = $eq;
	$VARIANTS[$eq["UF_XML_ID"]]["FILE_SRC"] = CFile::GetPath($eq["UF_FILE"]);
	$VARIANTS[$eq["UF_XML_ID"]]["UF_DOBOR_SRC"] = CFile::GetPath($eq["UF_DOBOR"]);
}

$SNAR = $VARIANTS[$arResult["PROPERTIES"]["FURNISH_OUTSIDE"]["VALUE"]];
$VNUTR = $VARIANTS[$arResult["PROPERTIES"]["FURNISH_INSIDE"]["VALUE"]];

$hblock = GetHBlock(4);
foreach($hblock as $eq)
{
	$NAD_KARTOI[$eq["UF_XML_ID"]] = $eq;
	$NAD_KARTOI[$eq["UF_XML_ID"]]["FILE_SRC"] = CFile::GetPath($eq["UF_FILE"]);
}

$hblock = GetHBlock(8);
foreach($hblock as $eq)
{
	$PICCHAR[$eq["UF_XML_ID"]] = $eq;
	$PICCHAR[$eq["UF_XML_ID"]]["FILE_SRC"] = CFile::GetPath($eq["UF_FILE"]);
}

foreach($PICCHAR as $code => $file)
{
	$FILE_TTH[$code]["FILE"] = $file["FILE_SRC"];
	$FILE_TTH[$code]["TEXT"] = $file["UF_DESCRIPTION"];
	$FILE_TTH[$code]["NAME"] = $file["UF_NAME"];
	$FILE_TTH[$code]["TOOLTIP"] = $file["UF_TOOLTIP"];
}

foreach($arResult["PROPERTIES"] as $code => $val)
{
	if(strpos($code,"CHARAKTER_") === 0)
	{
		if($val["VALUE"])
		{
			if($val["PROPERTY_TYPE"] == "S")
			{
				$TEXT_TTH[$code]["TEXT"] = $val["VALUE"];
				$TEXT_TTH[$code]["TOOLTIP"] = $val["HINT"];
				$TEXT_TTH[$code]["NAME"] = $val["NAME"];
			}
			elseif($val["PROPERTY_TYPE"] == "F")
			{
				$FILE_TTH[$code]["FILE"] = CFile::GetPath($val["VALUE"]);
				$FILE_TTH[$code]["TEXT"] = $val["DESCRIPTION"];
			
				$FILE_TTH[$code]["TOOLTIP"] = $arResult["PROPERTIES"]["TOOLTIP_".$code]["VALUE"]?$arResult["PROPERTIES"]["TOOLTIP_".$code]["VALUE"]:$val["HINT"];
				$FILE_TTH[$code]["NAME"] = $val["NAME"];
			}
		}

	}
	elseif(strpos($code,"DOPCHARAKTER_") === 0)
	{
		if($val["VALUE"])
		{
			if($code == "DOPCHARAKTER_FURNISH_OUTSIDE")
			{
				$FILE_TTH["CHARAKTER_FURNISH_OUTSIDE"]["FILE"] = $SNAR["FILE_SRC"];
				$FILE_TTH["CHARAKTER_FURNISH_OUTSIDE"]["TOOLTIP"] = $SNAR["UF_TOOLTIP"];
				$FILE_TTH["CHARAKTER_FURNISH_OUTSIDE"]["TEXT"] = $val["VALUE"];
				$FILE_TTH["CHARAKTER_FURNISH_OUTSIDE"]["NAME"] = $val["NAME"];
			}
			elseif($code == "DOPCHARAKTER_FURNISH_INSIDE")
			{
				$FILE_TTH["CHARAKTER_FURNISH_INSIDE"]["FILE"] = $VNUTR["FILE_SRC"];
				$FILE_TTH["CHARAKTER_FURNISH_INSIDE"]["TOOLTIP"] = $VNUTR["UF_TOOLTIP"];
				$FILE_TTH["CHARAKTER_FURNISH_INSIDE"]["TEXT"] = $val["VALUE"];
				$FILE_TTH["CHARAKTER_FURNISH_INSIDE"]["NAME"] = $val["NAME"];
			}
		}
	}
}
if($arResult["PROPERTIES"]["DOUBLE"]["VALUE"] == "Y")
{
	$FILE_TTH["STORONA"]["FILE"] = SITE_TEMPLATE_PATH."/img/dvupolnaya.png";
	$FILE_TTH["STORONA"]["TEXT"] = $arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["VALUE"]?$arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["VALUE"]:"Левое или правое";
	$FILE_TTH["STORONA"]["TOOLTIP"] = $arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["HINT"];
	$FILE_TTH["STORONA"]["NAME"] = "Направление открытия";
}
else
{
	$FILE_TTH["STORONA"]["FILE"] = SITE_TEMPLATE_PATH."/img/odnopolnaya.png";
	$FILE_TTH["STORONA"]["TEXT"] = $arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["VALUE"]?$arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["VALUE"]:"Левое или правое";
	$FILE_TTH["STORONA"]["NAME"] = "Направление открытия";
	$FILE_TTH["STORONA"]["TOOLTIP"] = $arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["HINT"];
}
$hblock = GetHBlock(7);
foreach($hblock as $eq)
{
	$NAME_FURNISH[$eq["UF_XML_ID"]]["NAME"] = $eq["UF_NAME"];
	$NAME_FURNISH[$eq["UF_XML_ID"]]["PRICE"] = intVal($eq["UF_DESCRIPTION"]);
}


$SHOW_PRICE = $arResult['PROPERTIES']['SHOW_PRICE']['VALUE'] != 'N';
?>

<div class="fix_area">
	<div class="wrap">
		<a href="<?=$arResult["DETAIL_PAGE_URL"]?>" >
		<div class="img">
			<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["NAME"]?>">
			<img src="<?=$DETAIL_2?>" alt="<?=$arResult["NAME"]?>">
		</div>
		<p class="name"><?=$arResult["NAME"]?></p>
		</a>
		<div class="prop">
			<span <?=in_array(3, $arResult["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?>><i>для квартиры</i></span>
			<span <?=in_array(2, $arResult["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?>><i>для дома</i></span>
			<span <?=in_array(1, $arResult["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?> ><i>для офиса</i></span>
		</div>
		<div class="status">
		
		
		
			<?if($arResult["PROPERTIES"]["IN_STOCK"]["VALUE_XML_ID"] == 2) { ?>
				<span >На складе в Минске</span>
			<? } else { ?>
				<span class="not">На складе в Минске</span>
			<? } ?>
			<?if($arResult["PROPERTIES"]["MODEL_IN"]["VALUE_XML_ID"] == 1) {?>
				<span>Модель в салоне</span>
			<? } else { ?>
				<span  class="not">Модель в салоне</span>
			<? } ?>
		</div>
		<a class="zakaz" onclick="addToCart('<?=$arResult["ID"]?>','<?=$arResult["NAME"]?>','<?=$arResult["BUY_URL"]?>'); return !ga.loaded;" href="<?=$arResult["BUY_URL"]?>">
			Заказать дверь
		</a>
		<? if($SHOW_PRICE) {?>
		<?if($arResult["MIN_PRICE"]["VALUE"] > $arResult["MIN_PRICE"]["DISCOUNT_VALUE"]) $class2 = "sale";?>
		<div class="cost <?=$class2?>">
			<?if($arResult["MIN_PRICE"]["VALUE"] > $arResult["MIN_PRICE"]["DISCOUNT_VALUE"]){?>
			<span class="price_old"><?=toPrice($arResult["MIN_PRICE"]["VALUE"]);?> Br</span>
			<? } ?>
			<span class="price"><?=toPrice($arResult["MIN_PRICE"]["DISCOUNT_VALUE"]);?> Br</span>
		</div>
		<? } ?>
	</div>
</div>
<script>
	$(function() {
		var top = $(document).scrollTop(),
			fix = $('.fix_area'),
			point = $('.tech').offset().top;
		top >= point ? fix.fadeIn(150):fix.fadeOut(150);
		$(document).scroll(function() {
			top = $(document).scrollTop();
			top >= point ? fix.fadeIn(150):fix.fadeOut(150);
		})
	})
</script>