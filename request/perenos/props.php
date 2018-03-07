<?php
die();
define("NEW_IBLOCK", 19);
$arrNeedProps = [
 "ARTICLE",
 "BARCODE",
 "SIDE_OPEN",
 "OTDELKA_VNUTRI_OTDELKA",
 "OTDELKA_VNUTRI_TOLSHINA",
 "OTDELKA_VNUTRI_MATERIAL",
 "OTDELKA_VNUTRI_COLOR",
 "OTDELKA_VNUTRI_FREZEROVKA",
 "OTDELKA_VNUTRI_PATINA",
 "OTDELKA_SNARUZHI_OTDELKA",
 "OTDELKA_SNARUZHI_TOLSHINA",
 "OTDELKA_SNARUZHI_MATERIAL",
 "OTDELKA_SNARUZHI_COLOR",
 "OTDELKA_SNARUZHI_FREZEROVKA",
 "OTDELKA_SNARUZHI_PATINA",
 "VIEW_OUTSIDE_DETAIL",
 "VIEW_OUTSIDE_ANONS",
 "WIDTH",
 "HEIGHT",
 "CHARAKTER_TINER",
 "NABOR_FURNITUR"
];
$arrPropsCode = [
"ID",
"CODE",
"XML_ID",
"IBLOCK_ID",
"NAME",
"ACTIVE",
"IS_REQUIRED",
"SORT",
"PROPERTY_TYPE",
"MULTIPLE",
"TIMESTAMP_X",
"DEFAULT_VALUE",
"ROW_COUNT",
"COL_COUNT",
"LIST_TYPE",
"MULTIPLE_CNT",
"FILE_TYPE",
"SEARCHABLE",
"FILTRABLE",
"LINK_IBLOCK_ID",
"WITH_DESCRIPTION",
"VERSION",
"USER_TYPE",
"HINT",
];



require_once(filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . "/bitrix/modules/main/include/prolog.php");
Bitrix\Main\Loader::includeModule('iblock');
$IBLOCK_ID = 4;
$properties = CIBlockProperty::GetList(Array("sort" => "asc", "name" => "asc"), Array("ACTIVE" => "Y", "IBLOCK_ID" => $IBLOCK_ID));
while ($prop_fields = $properties->GetNext()) {
    if(in_array($prop_fields["CODE"], $arrNeedProps)) {
        $prop_fields["IBLOCK_ID"] = NEW_IBLOCK;
        
        $arProp = [];
        foreach($arrPropsCode as $code) {
            if($prop_fields[$code]) {
                $arProp[$code] = $prop_fields[$code];
            }
        }
        
        if($prop_fields["PROPERTY_TYPE"] == "L") {
            $db_enum_list = CIBlockProperty::GetPropertyEnum($prop_fields["CODE"], [], ["IBLOCK_ID"=>$IBLOCK_ID]);
            while($ar_enum_list = $db_enum_list->GetNext())
            {
              $arProp["VALUES"][] = $ar_enum_list;
            }
        }
        
        
        
        $ibp = new CIBlockProperty;
        $PropID = $ibp->Add($arProp);
    }
}
