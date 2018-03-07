<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$CART = $APPLICATION->IncludeComponent(
	"my:catalog.cart",
	"",
	Array("ACTION" => "FLUSH")
);

if(empty($CART["IDS"])) return;

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM");
$arFilter = Array("ID" => $CART["IDS"]);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement()) { 

  $arFields = $ob->GetFields();
  $Properties = $ob->GetProperties();
  $id = $arFields["ID"];

  foreach($Properties["SKLAD_OPENER"]["VALUE"] as $s => $SKLAD_OPENER) {
    if($Properties["SKLAD_WIDTH"]["VALUE"]) {
      foreach($Properties["SKLAD_WIDTH"]["VALUE"] as $w => $SKLAD_WIDTH) {
        $w_xid = $Properties["SKLAD_WIDTH"]["VALUE_XML_ID"][$w];
        $s_xid = $Properties["SKLAD_OPENER"]["VALUE_XML_ID"][$s];

        if(!$CART["ITEMS"][$id."_".$s_xid."_".$w_xid]) continue;
        if($Properties["SKLADSKAYA"]["VALUE"] == "Y") $status = "склад"; else $status = "конструктор";


        $Fields = array("ID" => $id."_".$s_xid."_".$w_xid, "SKLAD_OPENER" => $SKLAD_OPENER, "SKLAD_WIDTH" => $SKLAD_WIDTH, "PRICE" => $CART["RESULT"]["ITEMS"][$arFields["ID"]]["PRICE"], "NAME" => $arFields["NAME"], "STATUS" => $status);
        $Fields["TOTAL_PRICE"] = $CART["RESULT"]["ITEMS"][$arFields["ID"]]["PRICE"] * $CART["ITEMS"][$id."_".$s_xid."_".$w_xid];
		$Fields["QUANTITY"] = $CART["ITEMS"][$id."_".$s_xid."_".$w_xid];
        $arResult["ITEMS"][] = $Fields;
      }
    }
  }
}
$name = $USER->GetLogin();
$uid = $USER->GetId();

$mess = "<h1>Заказ от ".$name."</h1>
		<table border='1'>
		<tr>
			<th>Наименование двери</th>
			<th>Статус</th>
			<th>Стоимость (Br)</th>
			<th>Кол-во (шт)</th>
			<th>Общая стоимость (Br)</th>
		</tr>";
		foreach($arResult["ITEMS"] as $arItem) { 
$mess .="<tr>
		<td>".$arItem["NAME"]."</td>
			<td>".$arItem["STATUS"]."</td>
			<td>".formatter($arItem["PRICE"], false)."</td>
			<td>".$CART["ITEMS"][$arItem["ID"]]."</td>
			<td>".formatter($arItem["PRICE"] * $CART["ITEMS"][$arItem["ID"]], false)."</td>
		</tr>";
		} 
$mess .= "</table>";

			$el = new CIBlockElement;
			$PROP = array();  
			$PROP[152] = $uid; 
			$PROP[153] = 54;
			$PROP[155] = preg_replace("#[^\d]#","",$CART["RESULT"]["TOTAL_PRICE"]);
			$arLoadProductArray = Array(
			  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
			  "IBLOCK_ID"      => 14,
			  "PROPERTY_VALUES"=> $PROP,
			  "NAME"           => $name,
			  "ACTIVE"         => "Y",
			  "PREVIEW_TEXT"   => $mess,
			  "DETAIL_TEXT"    => serialize($arResult),
			  );
	
			$PRODUCT_ID = $el->Add($arLoadProductArray);
if($PRODUCT_ID) {

	$arEventFields = array(
		"MESSAGE"=>$mess,
	);

		CEvent::Send("ZAKAZ", "s1", $arEventFields);
		LocalRedirect("/thank/?order=client");
	} else {
		LocalRedirect("/");
	}
?>