<?

use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;
use Bitrix\Iblock;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$result["NAME"] = $arResult["NAME"];
$result["DETAIL_PAGE_URL"] = $arResult["DETAIL_PAGE_URL"];

$result["PRICE"] = $arResult["OFFERS"][0]["MIN_PRICE"]["VALUE"];
$result["DISCOUNT_PRICE"] = $arResult["OFFERS"][0]["MIN_PRICE"]["DISCOUNT_VALUE"];
$result["DISCOUNT_DIFF"] = $arResult["OFFERS"][0]["MIN_PRICE"]["DISCOUNT_DIFF"];

$result["CONCEPT_PICTURE_INTERIOR_BIG"] = CFile::GetPath($arResult["PROPERTIES"]["CONCEPT_PICTURE_INTERIOR"]["VALUE"]);
//$result["CONCEPT_PICTURE_INTERIOR_SMALL"] = getResizeImage($arResult["PROPERTIES"]["CONCEPT_PICTURE_INTERIOR"]["VALUE"], 1290, 860);

$file = CFile::ResizeImageGet($arResult["PROPERTIES"]["CONCEPT_PICTURE_INTERIOR"]["VALUE"], array('width' => 1170, 'height' => 780), BX_RESIZE_IMAGE_PROPORTIONAL, true);
$result["CONCEPT_PICTURE_INTERIOR_SMALL"] = $file["src"];

$files = CFile::ResizeImageGet($arResult["PROPERTIES"]["CONCEPT_PICTURE_INTERIOR"]["VALUE"], array('width' =>146, 'height' => 97.5), BX_RESIZE_IMAGE_PROPORTIONAL, true);
$result["CONCEPT_PICTURE_INTERIOR_SMALL_RESIZE"] = $files["src"];

if (!empty($arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE"])) {
    $i = 0;
    foreach ($arResult["PROPERTIES"]["DESTINATION_ICON"]["~VALUE"] as $key => $dest) {
        /*   if ($concept_stock) {
          if ($arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE_XML_ID"][$key] == "concept" || $arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE_XML_ID"][$key] == "stock")
          continue;
          if ($i == 0) {
          $destination = $dest;
          $i++;
          } else {
          $destination .= " · " . $dest;
          }
          } else { */
        if ($key == 0) {
            $destination = $dest;
        } else {
            $destination .= ", " . $dest;
        }
//        }
    }
    $result["DESTINATION_ICON"] = $destination;
}

/*
  $result["PICTURE_WITHIN_SMALL"] = getResizeImage($arResult["PREVIEW_PICTURE"]["ID"], 109, 211);
  $result["PICTURE_OUTSIDE_SMALL"] = getResizeImage($arResult["PROPERTIES"]["PREVIEW_PHOTO_IN"]["VALUE"], 109, 211);

  $result["PICTURE_WITHIN_BIG"] = getResizeImage($arResult["PREVIEW_PICTURE"]["ID"], 218, 422);
  $result["PICTURE_OUTSIDE_BIG"] = getResizeImage($arResult["PROPERTIES"]["PREVIEW_PHOTO_IN"]["VALUE"], 218, 422);
 */
$result["PICTURE_WITHIN_SMALL"] = CFile::GetPath($arResult["PROPERTIES"]["PHOTO_ON_MAIN_OUTSIDE"]["VALUE"]);
$result["PICTURE_OUTSIDE_SMALL"] = CFile::GetPath($arResult["PROPERTIES"]["PHOTO_ON_MAIN_WITHIN"]["VALUE"]);

$file_s = CFile::ResizeImageGet($arResult["PROPERTIES"]["PHOTO_ON_MAIN_OUTSIDE"]["VALUE"], array('width' => 109, 'height' => 210), BX_RESIZE_IMAGE_PROPORTIONAL, true);
$result["PICTURE_WITHIN_BIG"] = $file_s["src"];
//print_r($file_s);

$file_s_1 = CFile::ResizeImageGet($arResult["PROPERTIES"]["PHOTO_ON_MAIN_WITHIN"]["VALUE"], array('width' => 109, 'height' => 210), BX_RESIZE_IMAGE_PROPORTIONAL, true);
$result["PICTURE_OUTSIDE_BIG"] = $file_s_1["src"];

unset($file_s, $file_s_1);

$arResult = [];
$arResult = $result;

//print_r($arResult);
