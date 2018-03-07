<?php

/** @global CMain $APPLICATION */
use \Bitrix\Main\Application;
use \Bitrix\Main;
use \Bitrix\Main\Localization\Loc;

require_once(filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . "/bitrix/modules/main/include/prolog_admin_before.php");
$appContext = Application::getInstance()->getContext();
$request = $appContext->getRequest();



$CHESHIRE_SKLAD_RIGHT = $APPLICATION->GetGroupRight("cheshire.sklad");
if ($CHESHIRE_SKLAD_RIGHT == "D") {
    $APPLICATION->AuthForm(Loc::getMessage("ACCESS_DENIED"));
}
\Bitrix\Main\Loader::includeModule('cheshire.sklad');
Loc::loadMessages(__FILE__);

$adminListTableID = 'stock_basket';
$adminSort = new CAdminSorting($adminListTableID, 'ID', 'ASC');
$adminList = new CAdminList($adminListTableID, $adminSort);

if (!isset($by)) {
    $by = 'SORT';
}
if (!isset($order)) {
    $order = 'ASC';
}
$by = strtoupper($by);
$order = strtoupper($order);

$headerList = array();
$headerList['ID'] = array(
    "id" => "ID",
    "content" => "ID",
    "sort" => "ID",
    "default" => true
);

$headerList['USER_ID'] = array(
    "id" => "USER_ID",
    "content" => Loc::getMessage('CHESHIRE_SKLAD_FILTER_USER_ID'),
    "sort" => "USER_ID",
    "default" => true
);

$headerList['SORT'] = array(
    "id" => "DATE_UPDATE",
    "content" => Loc::getMessage('CHESHIRE_SKLAD_FILTER_DATE_UPDATE'),
    "sort" => "DATE_UPDATE",
    "default" => true
);
$headerList['AMOUNT_CNT'] = array(
    "id" => "STATUS",
    "content" => Loc::getMessage('CHESHIRE_SKLAD_FILTER_STATUS'),
    "default" => true
);

$adminList->AddHeaders($headerList);

if ($CHESHIRE_SKLAD_RIGHT == "W" && $arID = $adminList->GroupAction()) {

    if ($request->get('action_target') == 'selected') {
        $filterIterator = \Cheshire\Sklad\StockBaskedTable::getList(array(
                    'select' => array('ID')
        ));
        while ($filter = $filterIterator->fetch())
            $arID[] = $filter['ID'];
    }
    
    foreach ($arID as $ID) {
        $ID = (string) $ID;
        if ($ID == '') {
            continue;
        }

        if ($_REQUEST['action'] == "delete") {
            if (!\Cheshire\Sklad\StockBaskedTable::Delete($ID)) {
                if ($ex = $APPLICATION->GetException())
                    $adminList->AddGroupError($ex->GetString(), $ID);
                else
                    $adminList->AddGroupError(Loc::getMessage("DELETE_ERROR"), $ID);
            }
        }
    }
}


$navyParams = CDBResult::GetNavParams(CAdminResult::GetNavSize($adminListTableID));
$usePageNavigation = true;
if ($navyParams['SHOW_ALL']) {
    $usePageNavigation = false;
} else {
    $navyParams['PAGEN'] = (int) $navyParams['PAGEN'];
    $navyParams['SIZEN'] = (int) $navyParams['SIZEN'];
}


if ($usePageNavigation) {
    $countQuery = new Main\Entity\Query(\Cheshire\Sklad\StockBaskedTable::getEntity());
    $countQuery->addSelect(new Main\Entity\ExpressionField('CNT', 'COUNT(1)'));

    $totalCount = $countQuery->setLimit(null)->setOffset(null)->exec()->fetch();
    unset($countQuery);
    $total = (int) $totalCount['CNT'];
    if ($total > 0) {
        $totalPages = ceil($total / $navyParams['SIZEN']);
        if ($navyParams['PAGEN'] > $totalPages) {
            $navyParams['PAGEN'] = $totalPages;
        }
        $getListParams['limit'] = $navyParams['SIZEN'];
        $getListParams['offset'] = $navyParams['SIZEN'] * ($navyParams['PAGEN'] - 1);
    } else {
        $navyParams['PAGEN'] = 1;
        $getListParams['limit'] = $navyParams['SIZEN'];
        $getListParams['offset'] = 0;
    }
}

$filterIterator = new CAdminResult(
        \Cheshire\Sklad\StockBaskedTable::getList([
            "select" => ["ID", "USER_ID", "DATE_UPDATE", "STATUS"],
            'count_total' => true,
            'offset' => $getListParams['offset'],
            'limit' => $getListParams['limit'],
            'order' => array($by => $order)
        ]), $adminListTableID);

if ($usePageNavigation) {
    $filterIterator->NavStart($getListParams['limit'], $navyParams['SHOW_ALL'], $navyParams['PAGEN']);
    $filterIterator->NavRecordCount = $total;
    $filterIterator->NavPageCount = $totalPages;
    $filterIterator->NavPageNomer = $navyParams['PAGEN'];
} else {
    $filterIterator->NavStart();
}

$adminList->NavText($filterIterator->GetNavPrint(Loc::getMessage('CHESHIRE_SKLAD_PAGES')));

while ($arRes = $filterIterator->Fetch()) {
    $urlEdit = '/bitrix/admin/cheshire.sklad_order_edit.php?lang=' . LANGUAGE_ID . '&ID=' . $arRes['ID'];

    $arRows[$arRes['ID']] = $row = & $adminList->AddRow($arRes['ID'], $arRes, $urlEdit, Loc::getMessage('CHESHIRE_SKLAD_EDIT'));

    $row->AddViewField("ID", '<a href="' . $urlEdit . '" title="' . Loc::getMessage('CHESHIRE_SKLAD_EDIT') . '">' . $arRes['ID'] . '</a>');
    $row->AddViewField("USER_ID", htmlspecialcharsex($arRes["USER_ID"]));
    $row->AddViewField("DATE_UPDATE", htmlspecialcharsex($arRes['DATE_UPDATE']));
    $row->AddViewField("STATUS", htmlspecialcharsex($arRes['STATUS']));
    $arActions = array();

    $arActions[] = array(
        "ICON" => "edit",
        "DEFAULT" => "Y",
        "TEXT" => Loc::getMessage("MAIN_ADMIN_MENU_EDIT"),
        "ACTION" => $adminList->ActionRedirect($urlEdit)
    );
    if ($CHESHIRE_SKLAD_RIGHT == "W") {
        $arActions[] = array(
            "ICON" => "delete",
            "TEXT" => Loc::getMessage("MAIN_ADMIN_MENU_DELETE"),
            "ACTION" => "if(confirm('" . Loc::getMessage('CONFIRM_DEL_MESSAGE') . "')) " . $adminList->ActionDoGroup($arRes['ID'], "delete")
        );
    }
    $row->AddActions($arActions);
}




if ($CHESHIRE_SKLAD_RIGHT == "W") {
    $adminList->AddGroupActionTable(array("delete" => Loc::getMessage("MAIN_ADMIN_LIST_DELETE")));
}
$adminList->AddFooter(
        array(
            array("title" => Loc::getMessage("MAIN_ADMIN_LIST_SELECTED"), "value" => $filterIterator->SelectedRowsCount()),
            array("counter" => true, "title" => Loc::getMessage("MAIN_ADMIN_LIST_CHECKED"), "value" => "0"),
        )
);

$aContext = array(
    array(
        "ICON" => "btn_new",
        "TEXT" => Loc::getMessage("CHESHIRE_SKLAD_ADD"),
        "LINK" => "/bitrix/admin/cheshire.sklad_order_edit.php?lang=" . LANGUAGE_ID,
        "TITLE" => Loc::getMessage("CHESHIRE_SKLAD_ADD")
    )
);

$adminList->AddAdminContextMenu($aContext);

$adminList->CheckListMode();

$APPLICATION->SetTitle(Loc::getMessage("CHESHIRE_SKLAD_TITLE"));
require(filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . "/bitrix/modules/main/include/prolog_admin_after.php");

$adminList->DisplayList();

require(filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . "/bitrix/modules/main/include/epilog_admin.php");
