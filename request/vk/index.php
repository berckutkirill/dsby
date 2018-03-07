<?php
set_time_limit(0);
$uid = uniqid();
header("Content-Type: text/plain; charset=cp1251");
header("Content-Disposition: attachment; filename=file{$uid}.txt");
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");



CModule::includeModule('iblock');
$av['1'] = "preorder";
$av['2'] = "in stock";


$arSelect = Array('ID', 'NAME', 'DATE_ACTIVE_FROM', 'DETAIL_PICTURE', 'DETAIL_TEXT', 'CODE');
$arFilter = Array('IBLOCK_ID'=>22, 'ACTIVE_DATE'=>'Y', 'ACTIVE'=>'Y');
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
    $arProps = $ob->getProperties();
	$MIN_PRICE = getOffersWithMinPrice($arFields['ID']);
    $items[] = [
        'id' => $arFields['ID'],
        'title' => $arFields['NAME'],
        'availability' => $av[$arFields['IN_STOCK']['VALUE_XML_ID']]?$av[$arFields['IN_STOCK']['VALUE_XML_ID']]:'out of stock',
        'condition' => 'new',
        'description' => $arFields['DETAIL_TEXT'],
		'link' => "https://{$_SERVER['HTTP_HOST']}/catalog-dverei/stalnaya-liniya/{$arFields['CODE']}.html",
        'image_link' => makeImage($MIN_PRICE['DETAIL_PICTURE_ID']),
		'image_link2' => makeImage($MIN_PRICE['DETAIL_PICTURE2_ID']),
        'price' => $MIN_PRICE["MIN_PRICE"]["VALUE"].' RUB',
        'brand' => 'Стальная линия'
    ];
}

function makeImage($imgId) {
	$img = CFile::GetPath($imgId);
    if(!file_exists(__DIR__."/img/".$imgId.".jpg")) {
		CFile::ResizeImageFile(
            $sourceFile = $_SERVER['DOCUMENT_ROOT'].$img,
            $destinationFile = __DIR__."/mini_watermark.jpg",
            $arSize = ['width'=>600, 'height'=>550],
            $resizeType = BX_RESIZE_IMAGE_PROPORTIONAL,
            $arWaterMark = [],
            $jpgQuality=false,
            $arFilters =false
        );
        CFile::ResizeImageFile(
            $sourceFile = __DIR__."/Blank-space-600x600.jpg",
            $destinationFile =  __DIR__."/img/".$imgId.".jpg",
            $arSize = ['width'=>600, 'height'=>600],
            $resizeType = BX_RESIZE_IMAGE_PROPORTIONAL,
            $arWaterMark = [],
            $jpgQuality=false,
            $arFilters = [
               ["name" => "watermark", 'size' => 'real', "position" => "center", "file"=>__DIR__."/mini_watermark.jpg"]
            ]
        );

    }
    return "https://{$_SERVER['HTTP_HOST']}/request/vk/img/{$imgId}.jpg";
}

$fp = fopen("php://output", "w");
$line = "id,title,availability,condition,description,link,image_link,image_link2,price,brand";
fputcsv($fp, split(',', $line),"	");

foreach($items as $item) {
	if(!$item["price"]) continue;
	if(!$item["title"]) continue;
	if(!$item["description"]) continue;
	$item["price"] = round($item["price"] / 10000, 2);
	$line = array($item["id"], $item["title"], $item["availability"], $item["condition"], $item["description"], $item["link"], $item["image_link"],$item["image_link2"], $item["price"], $item["brand"]);
	fputcsv($fp, $line,"	");
}

fclose($fp);