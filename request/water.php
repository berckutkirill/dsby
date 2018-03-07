<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); 
die();
set_time_limit(0);
CModule::IncludeModule('iblock');

function GetListFiles() {

$IDS = [2195];
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PICTURE");
    $arFilter = Array("IBLOCK_ID"=>21, 'ID' => $IDS);
    
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $PROPERTIES = $ob->GetProperties();
		$r[] = $_SERVER["DOCUMENT_ROOT"].CFile::GetPath($arFields["DETAIL_PICTURE"]);
        $r[] = $_SERVER["DOCUMENT_ROOT"].CFile::GetPath($PROPERTIES["DECOR_PHOTO_IN"]["VALUE"]);
    }
    return array_unique($r);
}


$all_files = GetListFiles();

foreach ($all_files as $k => $img) {

    list($width, $height, $type, $attr) = getimagesize($img);
    $wtm = "watermarker";
    $rif = CFile::ResizeImageFile(
                    $sourceFile = $img, $destinationFile = $_SERVER['DOCUMENT_ROOT'] . "/upload/1.png", $arSize = array('width' => $width, 'height' => $height), $resizeType = BX_RESIZE_IMAGE_PROPORTIONAL, $arWaterMark = array(), $jpgQuality = false, $arFilters = Array(// нанесение водяного знака
                array("name" => "watermark", "position" => "bottomright", "size" => "real", "file" => $_SERVER['DOCUMENT_ROOT'] . "/upload/" . $wtm . ".png")
                    )
    );
    if ($rif) {
        unlink($img);
        rename($_SERVER['DOCUMENT_ROOT'] . "/upload/1.png", $img);
    }
}
