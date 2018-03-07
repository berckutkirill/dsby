<?php
print_r($arResult);
if (!empty($arResult)) {
    foreach ($arResult as $item) {
        $IDS[] = $item['ITEM_ID'];
    }
   
    if($IDS && !empty($IDS)) {
        $res = $APPLICATION->includeComponent('sklad:list', '', [
            'IBLOCK_ID' => STORE_IBLOCK_ID,
            'OFFERS_FILTER' => ['ID' => $IDS],
            'IBLOCK_OFFERS_ID' => STORE_OFFERS_IBLOCK_ID,
            'PRICE_CODE' => [0 => "BASE"],
            'OFFERS_FIELDS' => ['ID', 'IBLOCK_ID', 'NAME'],
            'ROUTE_ID' => 307,
            'OFFERS_PROPERTIES' => ['308', '309', '310'],
            'NOT_INCLUDE_TPL' => false
        ]);
    }
    
}