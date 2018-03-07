<?php
require_once(filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . "/bitrix/modules/main/include/prolog_before.php");
CPageOption::SetOptionString("main", "nav_page_in_session", "N");
$action = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

$component = filter_input(INPUT_GET, 'component');



if (!$component) {
    $component = 'sklad:list';
}
if ($component == 'sklad:filter') {
    if ($action == 'GET') {
        $filter = $APPLICATION->includeComponent('sklad:filter', '', [
            'IBLOCK_ID' => STORE_OFFERS_IBLOCK_ID,
            'FILTER_PROPERTIES' => ['OPEN_SIDE', 'WIDTH'],
            'FILTER_FIELDS' => ['NAME'],
            'FILTER_FOR' => filter_input(INPUT_GET, 'for')
        ]);
    }
} else if ($component == 'sklad:list') {
    
        $APPLICATION->includeComponent('sklad:list', '', [
            'IBLOCK_ID' => STORE_IBLOCK_ID,
            'OFFERS_FILTER_PROPS' => $filter,
            'action' => $action,
            'PAGE_ELEMENT_COUNT' => 'all',
            'IBLOCK_OFFERS_ID' => STORE_OFFERS_IBLOCK_ID,
            'PRICE_CODE' => [0 => "BASE"],
            'ROUTE_ID' => 307,
            'OFFERS_FIELDS' => ['ID', 'IBLOCK_ID', 'NAME'],
            'NAV_PAGE_ELEMENT_COUNT' => 'all',
            'OFFERS_PROPERTIES' => ['308', '309', '310'],
        ]);
} else if ($component == 'sklad:orders') {
    $APPLICATION->includeComponent('sklad:documents', '', ['action' => $action, 'DOC_TYPE' => 'D']);
} else if ($component == 'sklad:user') {
    $APPLICATION->includeComponent('sklad:user', '', ['action' => $action]);
} else if ($component == 'sklad:search') {
    $APPLICATION->includeComponent('sklad:search', '', ['IBLOCK_TYPE' => 'catalog', 'IBLOCK_FOR_SEARCH' => STORE_OFFERS_IBLOCK_ID]);
} else if ($component == 'sklad:ships') {
    $APPLICATION->includeComponent('sklad:documents', '', ['action' => $action, 'DOC_TYPE' => 'A', 'getCount' => filter_input(INPUT_GET, 'count')]);
}