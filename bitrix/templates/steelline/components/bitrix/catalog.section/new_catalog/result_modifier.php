<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();


$array = array(
"3" => "1",
"5" => "3",
"7" => false,
);
$cnt = count($arResult["ITEMS"]);
foreach($array as $k => $v)
{
	if($k >= $cnt)
	{
		$nTopCount = $v;
		break;
	}
};

$hblock = GetHBlock(3);
foreach($hblock as $eq)
{
	$BASIC[$eq["UF_XML_ID"]] = $eq;
	$BASIC[$eq["UF_XML_ID"]]["FILE_SRC"] = CFile::GetPath($eq["UF_FILE"]);
}
$arResult["BASIC"] = $BASIC;

foreach($arResult["ITEMS"] as &$arItem) {
	$flat["CLASS"] = in_array("flat", $arItem["PROPERTIES"]["APPOINTMENT"]["VALUE_XML_ID"]) ? "class='active'":"";
	$flat["VALUE"] = getMessage("FOR_FLAT");

	$home["CLASS"] = in_array("home", $arItem["PROPERTIES"]["APPOINTMENT"]["VALUE_XML_ID"]) ? "class='active'":"";
	$home["VALUE"] = getMessage("FOR_HOME");

	$arItem["APPOINTMENTS"] = ["flat" => $flat, "home" => $home];
	if($arItem["OFFERS"]) {
		usort($arItem["OFFERS"], "minP");
		
		$arItem["MIN_PRICE"] = $arItem["OFFERS"][0]["MIN_PRICE"];
		$arItem["PREVIEW_PICTURE"]["SRC"] = $arItem["OFFERS"][0]["DETAIL_PICTURE"]["SRC"];
		$arItem["PROPERTIES"]["PREVIEW_PHOTO_IN"]["VALUE"] = $arItem["OFFERS"][0]["PROPERTIES"]["DECOR_PHOTO_IN"]["VALUE"];
	}
}

$nTopCount = $nTopCount?$nTopCount:6;
$arSelect = Array("ID","IBLOCK_ID", "NAME","DETAIL_PAGE_URL","DETAIL_PICTURE","PREVIEW_PICTURE", "ACTIVE_FROM");
$arFilter = Array("IBLOCK_ID"=>7, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_KLICKABLE_VALUE"=>"Y");
$res = CIBlockElement::GetList(Array("sort"=>"asc"), $arFilter, false, array("nTopCount"=>$nTopCount), $arSelect);
while($ob = $res->GetNextElement())
{
	$arFields = $ob->GetFields();
	$arProps = $ob->GetProperties();
	if($arProps["UNIKUM_URL"]["VALUE"]) $arFields["DETAIL_PAGE_URL"] = $arProps["UNIKUM_URL"]["VALUE"];

	$arFields["PROPERTIES"] = $arProps;
	$arFields["DISPLAY_ACTIVE_FROM"] = CIBlockFormatProperties::DateFormat($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($arFields["ACTIVE_FROM"]));
	$arFields["DISPLAY_ACTIVE_FROM"] = strtolower($arFields["DISPLAY_ACTIVE_FROM"]);
	$SIDEBAR_DOP[] = $arFields;
};



$this->SetViewTarget("DOP_SIDEBAR");
?>

<div class="dop_sidebar">
	<h3>Услуги салона</h3>
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include", 
		".default", 
		array(
			"COMPONENT_TEMPLATE" => ".default",
			"AREA_FILE_SHOW" => "file",
			"SIDEBAR_DOP" => $SIDEBAR_DOP,
			"PATH" => "/include/sidebar_dop.php",
			"EDIT_TEMPLATE" => "standard.php"
		),
		false
	);?>
</div>
<?$this->EndViewTarget();?>