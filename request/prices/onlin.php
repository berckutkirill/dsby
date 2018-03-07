<?php
ini_set("memory_limit", "512M");
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$currency = 'BYN';

$domain = "https://" . $_SERVER["HTTP_HOST"];
$j = 1;
$ofid = 10000;

//header("Content-Type:text/xml; charset=utf-8");
CModule::IncludeModule('iblock');

function getCatalog() {
    global $description;
    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_TEXT", "CODE", "IBLOCK_SECTION_ID", "IBLOCK_ID");
    $arFilter = Array("IBLOCK_ID" => 22, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "!SECTION_ID" => [54, 53, 51]);
    $res = CIBlockElement::GetList(Array("ID" => "ASC"), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $IDS[] = $arFields["ID"];
        $items[] = [
            'id' => $arFields['ID'],
            'title' => $arFields['NAME'],
            'link' => 'https://ds-steelline.by/catalog-dverei/stalnaya-liniya/' . $arFields['CODE'] . '.html'
        ];
        $arFields['link'] = 'https://ds-steelline.by/catalog-dverei/stalnaya-liniya/' . $arFields['CODE'] . '.html';
        $catalog[] = $arFields;
    }
    return $catalog;
}

$filter = array("IBLOCK_ID" => 22, "ACTIVE" => "Y", "IBLOCK_ACTIVE" => "Y", "GLOBAL_ACTIVE" => "Y");
$sectionIterator = CIBlockSection::GetList(array("LEFT_MARGIN" => "ASC"), $filter, false, array('ID', 'IBLOCK_SECTION_ID', 'NAME'));
while ($section = $sectionIterator->Fetch()) {
    $sections[$section["ID"]] = $section["NAME"];
}

function getOffers() {
    global $description;
    $arSelect = ["ID", "IBLOCK_ID", "NAME", "SORT", "PROPERTY_CML2_LINK", "CATALOG_GROUP_1", "PROPERTY_DECOR_ARTICLE"];
    $arFilter = ["PROPERTY_CML2_LINK" => $IDS, "IBLOCK_ID" => 21, "ACTIVE" => "Y"];
    $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arFields["text"] = $description[$arFields["PROPERTY_CML2_LINK_VALUE"]] . $prooopss;
        $offers[$arFields["PROPERTY_CML2_LINK_VALUE"]][] = $arFields;
    }
    return $offers;
}

$catalog = getCatalog();

$offers = getOffers();

require_once 'PHPExcel/PHPExcel.php';

$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0);
$active_sheet = $objPHPExcel->getActiveSheet();

$active_sheet->setTitle('Каталог');
$active_sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$active_sheet->getPageSetup()->SetPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

$active_sheet->getColumnDimension('A')->setWidth(30);
$active_sheet->getColumnDimension('B')->setWidth(30);
$active_sheet->getColumnDimension('C')->setWidth(30);
$active_sheet->getColumnDimension('D')->setWidth(30);
$active_sheet->getColumnDimension('E')->setWidth(10);
$active_sheet->getColumnDimension('F')->setWidth(30);
$active_sheet->setCellValue('A1', "Категория");
$active_sheet->setCellValue('B1', "Название");
$active_sheet->setCellValue('C1', "Описание для анонса");
$active_sheet->setCellValue('D1', "Артикул");
$active_sheet->setCellValue('E1', "Цена");
$active_sheet->setCellValue('F1', "Ссылка");
$i = 0;
foreach ($catalog as $item) {

    $description = htmlspecialchars($item["PREVIEW_TEXT"], ENT_XML1, 'UTF-8');
    if (is_array($offers[$item["ID"]])) {

        foreach ($offers[$item["ID"]] as $offer) {
            $descr = "";
            $descr = $offer["text"];

            $item['NAME'] = htmlspecialchars($item['NAME'], ENT_XML1, 'UTF-8');

            $row_next = $row_start + $i;
            $active_sheet->setCellValue('A' . $row_next, $sections[$item["IBLOCK_SECTION_ID"]]);
            $active_sheet->setCellValue('B' . $row_next, $item["NAME"]);
            $active_sheet->setCellValue('C' . $row_next, $descr);
            $active_sheet->setCellValue('D' . $row_next, $offer["PROPERTY_DECOR_ARTICLE_VALUE"]);
            $active_sheet->setCellValue('E' . $row_next, $offer["CATALOG_PRICE_1"]);
            $active_sheet->setCellValue('F' . $row_next, $item["link"]);
            $i++;
            /*
              $item["link"]
             * $offer["CATALOG_PRICE_1"]
             * $item["IBLOCK_SECTION_ID"]
             * $item["NAME"]
             * $offer["PROPERTY_DECOR_ARTICLE_VALUE"]
             * $descr
             */

            /*
              $xmloffers .= '<offer id="' . $offer["ID"] . '" available="' . $available . '">' .
              "\r\n" . '<url>' . $item["link"] . '</url>'
              . "\r\n" . '<price>' . $offer["CATALOG_PRICE_1"] . '</price>' .
              '<categoryId>' . $item["IBLOCK_SECTION_ID"] . '</categoryId>' . "\r\n" .
              '<name>' . "Стальная Линия " . $item["NAME"] . ($offer["PROPERTY_DECOR_ARTICLE_VALUE"] ? " (" . $offer["PROPERTY_DECOR_ARTICLE_VALUE"] . ")" : "") . '</name>' . "\r\n" .
              '<description>' . $descr . '</description>' . "\r\n" .
              '</offer>' . "\r\n"; */
        }
    } else {
        $descr = "";
        $descr = $item["DETAIL_TEXT"];

        $row_next = $row_start + $i;
        $active_sheet->setCellValue('A' . $row_next, $sections[$item["IBLOCK_SECTION_ID"]]);
        $active_sheet->setCellValue('B' . $row_next, $item["NAME"]);
        $active_sheet->setCellValue('C' . $row_next, $descr);
        $active_sheet->setCellValue('D' . $row_next, $item["PROPERTY_DECOR_ARTICLE_VALUE"]);
        $active_sheet->setCellValue('E' . $row_next, $item["CATALOG_PRICE_1"]);
        $active_sheet->setCellValue('F' . $row_next, $item["link"]);
        $i++;
    }
};

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setIncludeCharts(TRUE);
$objWriter->save("output.xlsx");
?>







