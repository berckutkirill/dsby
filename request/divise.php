<?
die();
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule('iblock');
	$arSelect = Array("ID", "IBLOCK_ID", "CATALOG_GROUP_1");
    $arFilter = Array("IBLOCK_ID"=>21, 'ACTIVE' => "Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
		$newPrice = $arFields["CATALOG_PRICE_1"]/10000;

		$PRODUCT_ID = $arFields["ID"];
		$PRICE_TYPE_ID = 1;
		
		$arPFields = Array(
			"PRODUCT_ID" => $PRODUCT_ID,
			"CATALOG_GROUP_ID" => $PRICE_TYPE_ID,
			"PRICE" => $newPrice,
			"CURRENCY" => "BYN"
		);

		$resPrice = CPrice::GetList(
				array(),
				array(
						"PRODUCT_ID" => $PRODUCT_ID,
						"CATALOG_GROUP_ID" => $PRICE_TYPE_ID
					)
			);

		if ($arr = $resPrice->Fetch())
		{
			CPrice::Update($arr["ID"], $arPFields);
		}
		else
		{
			CPrice::Add($arPFields);
		}
    }

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>