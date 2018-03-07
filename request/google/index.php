<?php
set_time_limit(0);
header("Content-Type: text/plain; charset=cp1251");
header("Content-Disposition: attachment; filename=file.txt");
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");



CModule::includeModule('iblock');
$av['1'] = "preorder";
$av['2'] = "in stock";


$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", 'DETAIL_PICTURE', 'DETAIL_TEXT', 'CODE');
$arFilter = Array("IBLOCK_ID"=>22, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_DOUBLE" => false, "!SECTION_ID" => 40);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
	$arFields = $ob->GetFields();
    $arProps = $ob->getProperties();
    $IDS[] = $arFields["ID"];    
        $items[] = [
            'id' => $arFields['ID'],
            'title' => $arFields['NAME'],
            'link' => 'https://ds-steelline.by/catalog-dverei/stalnaya-liniya/'.$arFields['CODE'].'.html'
        ];
        
}

$arSelect = ["ID", "IBLOCK_ID", "NAME", "SORT", "PROPERTY_CML2_LINK", "DETAIL_PICTURE", "CATALOG_GROUP_1"];
$arFilter = ["PROPERTY_CML2_LINK" => $IDS, "IBLOCK_ID" => 21, "ACTIVE" => "Y"];
$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
	if($arFields['CATALOG_PRICE_1'] > 0) {
		$prices[$arFields["PROPERTY_CML2_LINK_VALUE"]][] = [$arFields['CATALOG_PRICE_1'], $arFields["DETAIL_PICTURE"]];
	}
}

foreach($prices as &$price) {
	usort($price, function($a, $b) {
		if($a[0] == $b[0]) {
			return 0;
		}
		return $a[0] - $b[0];
	});

}


foreach($items as &$item) {
	$item['price'] = $prices[$item['id']][0][0].' BYN';
	$item['image_link'] = makeImage($prices[$item['id']][0][1]);
}

function makeImage($imgId){
    if(!file_exists($_SERVER['DOCUMENT_ROOT']."/request/facebook/img/".$imgId.".jpg")) {
        $img = CFile::GetPath($imgId);
        
        CFile::ResizeImageFile(      // уменьшение водяного знака
            $sourceFile = $_SERVER['DOCUMENT_ROOT'].$img,
            $destinationFile = $_SERVER['DOCUMENT_ROOT']."/request/facebook/mini_watermark.jpg",
            $arSize = ['width'=>600, 'height'=>550],
            $resizeType = BX_RESIZE_IMAGE_PROPORTIONAL,
            $arWaterMark = [],
            $jpgQuality=false,
            $arFilters =false
        );
        CFile::ResizeImageFile( 
            $sourceFile = $_SERVER['DOCUMENT_ROOT']."/request/facebook/Blank-space-600x600.jpg",
            $destinationFile =  $_SERVER['DOCUMENT_ROOT']."/request/facebook/img/".$imgId.".jpg",
            $arSize = ['width'=>600, 'height'=>600],
            $resizeType = BX_RESIZE_IMAGE_PROPORTIONAL,
            $arWaterMark = [],
            $jpgQuality=false,
            $arFilters = [
               ["name" => "watermark", 'size' => 'real', "position" => "center", "file"=>$_SERVER['DOCUMENT_ROOT']."/request/facebook/mini_watermark.jpg",]
            ]
        );
        
    }
    return 'https://ds-steelline.by/request/facebook/img/'.$imgId.'.jpg';
}

$fp = fopen("php://output", "w");
$line = "ID,Item title,Final URL,Image URL,Price,Item address";
fputcsv($fp, split(',', $line),"	");

foreach($items as $item){
	if(!$item["price"]) continue;
	if(!$item["title"]) continue;

	$line = array($item["id"], $item["title"], $item["link"], $item["image_link"], $item["price"], "Минск, пр.Дзержинского, 131/624, 220025, Беларусь");
	fputcsv($fp, $line,"	");
}

fclose($fp);