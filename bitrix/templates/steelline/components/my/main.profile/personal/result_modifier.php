<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)die();?>
<?
CModule::IncludeModule("iblock");
if($USER->isAuthorized()){
$id = $USER->GetId();

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT");
$arFilter = Array("IBLOCK_ID"=>IntVal(13), "PROPERTY_USER_ID" => $USER->GetId(), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false,false, $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $arProps = $ob->GetProperties();

 $resu = array("ID" => $arFields["ID"],"NAME" => $arFields["NAME"], "ADRESS" => $arFields["PREVIEW_TEXT"], "FACE" => $arProps["CONT_FACE"]["VALUE"], "PHONES" => $arProps["CONT_PHONES"]["VALUE"]);
 $arResult["USER_MAGS"][] = $resu;
}

}