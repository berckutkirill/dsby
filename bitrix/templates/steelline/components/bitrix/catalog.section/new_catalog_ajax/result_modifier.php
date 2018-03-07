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
$arResult["FILTER"] = [
	"ON_SHARE" => ['active' => $_GET["filter"]["ON_SHARE"]?true:false],
	"IN_STOCK" => ['active' => $_GET["filter"]["IN_STOCK"]?true:false],
	"NEW" => ['active' => $_GET["filter"]["NEW"]?true:false],
	"HIT" => ['active' => $_GET["filter"]["HIT"]?true:false]
];

$response = [
	"SECTION_CODE" => $arParams["SECTION_CODE"],
	"NAME" => $arResult["NAME"]?$arResult["NAME"]:"Каталог входных дверей",
	"ITEMS" => []
];


function forBlur($fid) {
$file = CFile::ResizeImageGet($fid, array('width'=>15, 'height'=>30), BX_RESIZE_IMAGE_PROPORTIONAL);
return $file['src'];
}
function getFilter() {
	
}
foreach($arResult["ITEMS"] as $arItem) {
	usort($arItem["OFFERS"], 'minP');
	foreach ($arItem["OFFERS"] as &$offer) {
		if ($offer["DETAIL_PICTURE"]["SRC"] && $offer["PROPERTIES"]["DECOR_PHOTO_IN"]["VALUE"]) {
			$offer["DETAIL_PICTURES"] = [
				["SRC" => $offer["DETAIL_PICTURE"]["SRC"], "ALT" => $offer["DETAIL_PICTURE"]["ALT"]],
				["SRC" => CFile::GetPath($offer["PROPERTIES"]["DECOR_PHOTO_IN"]["VALUE"]), "ALT" => $offer["NAME"]]
			];
			$offer["PREVIEV_PICTURES"] = [
				["SRC" => forBlur($offer["DETAIL_PICTURE"]["ID"]) , "ALT" => $offer["NAME"]],
				["SRC" => forBlur($offer["PROPERTIES"]["DECOR_PHOTO_IN"]["VALUE"]), "ALT" => $offer["NAME"]]
			];
			if (!$arItem["DETAIL_PICTURE_OUT"]) {
				$arItem["DETAIL_PICTURE"] = $offer["DETAIL_PICTURE"];
				$arItem["DETAIL_PICTURE_OUT"] = ["SRC" => CFile::GetPath($offer["PROPERTIES"]["DECOR_PHOTO_IN"]["VALUE"]), "ALT" => $offer["NAME"]];
			}
		}
		$offers[] = [
			"DETAIL_PICTURES" => $offer["DETAIL_PICTURES"],
			"PREVIEV_PICTURES" => $offer["PREVIEV_PICTURES"]
		];
	}

	$response["ITEMS"][] = [
		"ID" => $arItem["ID"],
		"NAME" => $arItem["NAME"],
		"PROPERTIES" => [
			"APPOINTMENT" => $arItem["PROPERTIES"]["APPOINTMENT"],
			"DESTINATION_ICON" => implode(" ", $arItem["PROPERTIES"]["DESTINATION_ICON"]["VALUE_XML_ID"]),
			"DETAIL_PAGE_URL" => $arItem["DETAIL_PAGE_URL"],
			"PREVIEW_PHOTO_IN" => CFile::GetPath($arItem["PROPERTIES"]["PREVIEW_PHOTO_IN"]["VALUE"]),
			"BASE_EQUIPMENT" => $arItem["PROPERTIES"]["BASE_EQUIPMENT"],
			"IN_STOCK" => $arItem["PROPERTIES"]["IN_STOCK"],
		],
		"MIN_PRICE" => $arItem["MIN_PRICE"],
		"OFFERS" => $offers
	];
}
$arResult = $response;