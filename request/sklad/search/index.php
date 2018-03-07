<?php
require_once(filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . "/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->includeComponent('sklad:search', '', [
    'IBLOCK_ID' => STORE_IBLOCK_ID,
    'IBLOCK_TYPE' => 'catalog',
    'IBLOCK_FOR_SEARCH' => [
        STORE_OFFERS_IBLOCK_ID
    ]
]);
