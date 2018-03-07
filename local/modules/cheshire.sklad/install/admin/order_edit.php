<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");
use Bitrix\Main\Application;
use Bitrix\Main\Entity\Base;
use \Bitrix\Main\Localization\Loc;

$CHESHIRE_SKLAD_RIGHT = $APPLICATION->GetGroupRight("cheshire.sklad");

if ($CHESHIRE_SKLAD_RIGHT == "D") {
    $APPLICATION->AuthForm(Loc::getMessage("ACCESS_DENIED"));
}
\Bitrix\Main\Loader::includeModule('cheshire.sklad');
Loc::loadMessages(__FILE__);

$errorMessage = array();
$appContext = Application::getInstance()->getContext();
$request = $appContext->getRequest();
    
$ID = '';
if ($request->get("ID")) {
    $ID = (string) $request->get("ID");
} else {
    LocalRedirect("cheshire.sklad_orders.php?lang=".LANGUAGE_ID);
}



$arFields = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $CHESHIRE_SKLAD_RIGHT == "W" && check_bitrix_sessid()) {

    if ($request->getPost("DATA") && check_bitrix_sessid()) {
        if (!Application::getConnection(\Cheshire\Sklad\StockBaskedTable::getConnectionName())->isTableExists(
                        Base::getInstance('\Cheshire\Sklad\StockBaskedTable')->getDBTableName()
                )
        ) {
            Base::getInstance('\Cheshire\Sklad\StockBaskedTable')->createDbTable();
        }
        $DB->StartTransaction();

        $arFields = [
            "USER_ID" => $request->getPost("USER_ID"),
            "DATE_UPDATE" => time(),
            "STATUS" => $request->getPost("STATUS")
        ];
        if ($ID) {
            $res = \Cheshire\Sklad\StockBaskedTable::update($ID, $arFields);
        }

        echo CAdminMessage::ShowMessage(array("MESSAGE" => Loc::getMessage("CHESHIRE_SKLAD_ROW_ADDED"), "TYPE" => "OK"));
    }



    if (!$res) {
        $DB->Rollback();
        if ($ex = $APPLICATION->GetException())
            $errorMessage[] = $ex->GetString();
        else
            $errorMessage[] = ($ID ? str_replace('#ID#', $ID, Loc::getMessage('BT_CURRENCY_EDIT_ERR_UPDATE')) : Loc::getMessage('BT_CURRENCY_EDIT_ERR_ADD')) . "<br>";
    } else {
        $DB->Commit();
        if (empty($request->getPost('apply')))
            LocalRedirect('/bitrix/admin/cheshire.sklad_order.php?lang=' . LANGUAGE_ID);

        LocalRedirect('/bitrix/admin/cheshire.sklad_order_edit.php?ID=' . $ID . '&lang=' . LANGUAGE_ID);
    }
}

global $USER;

$defaultValues = array(
    'USER_ID' => $USER->getId(),
    'DATE_UPDATE' => '',
    'STATUS' => ''
);

$APPLICATION->SetTitle(Loc::getMessage("CHESHIRE_SKLAD_EDIT_TITLE"));

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");
$order = $defaultValues;

$order = \Cheshire\Sklad\StockBaskedTable::getById($ID)->fetch();
   
if (empty($order)) {
    LocalRedirect("cheshire.sklad_orders.php?lang=".LANGUAGE_ID);
}
     


if (!empty($errorMessage)) {
    LocalRedirect("cheshire.sklad_orders.php?lang=".LANGUAGE_ID);
}

$aContext = array(
    array(
        "ICON" => "btn_list",
        "TEXT" => Loc::getMessage("MAIN_ADMIN_MENU_LIST"),
        "LINK" => "cheshire.sklad_order.php?lang=" . LANGUAGE_ID,
        "TITLE" => Loc::getMessage("MAIN_ADMIN_MENU_LIST")
    ),
);


    $aContext[] = array(
        "ICON" => "btn_new",
        "TEXT" => Loc::getMessage("MAIN_ADMIN_MENU_CREATE"),
        "LINK" => "order_edit.php?lang=" . LANGUAGE_ID,
        "TITLE" => Loc::getMessage("MAIN_ADMIN_MENU_CREATE")
    );

    if ($CHESHIRE_SKLAD_RIGHT == "W") {
        $aContext[] = array(
            "ICON" => "btn_delete",
            "TEXT" => Loc::getMessage("MAIN_ADMIN_MENU_DELETE"),
            "ONCLICK" => "javascript:if(confirm('" . getMessageJS("CONFIRM_DEL_MESSAGE") . "'))window.location='cheshire.sklad_order.php?action=delete&ID[]=" . CUtil::JSEscape($ID) . "&lang=" . LANGUAGE_ID . "&" . bitrix_sessid_get() . "';",
        );
    }

$context = new CAdminContextMenu($aContext);
$context->Show();

$aTabs = array(
	array("DIV" => "edit1", "TAB" => Loc::getMessage("CHESHIRE_SKLAD_ORDER_CURR"), "ICON"=>"", "TITLE"=>Loc::getMessage("CHESHIRE_SKLAD_ORDER_CURR"))
);

if (!empty($errorMessage)) {
    CAdminMessage::ShowMessage(implode('<br>', $errorMessage));
}
$tabControl = new CAdminTabControl("tabControl", $aTabs);


?>
<form method="post" action="<? $APPLICATION->GetCurPage() ?>">
    <? echo bitrix_sessid_post(); ?>
    <? echo GetFilterHiddens("filter_"); ?>
    <input type="hidden" name="ID" value="<? echo $ID ?>">
    <? if (strlen($return_url) > 0): ?><input type="hidden" name="return_url" value="<?= htmlspecialcharsbx($return_url) ?>"><? endif ?>

    <? $tabControl->Begin(); ?>
    <? $tabControl->BeginNextTab(); ?>
    <? if ($ID) { ?>
    <tr class="adm-detail-required-field">
        <td width="40%"><? echo Loc::getMessage("CHESHIRE_SKLAD_ORDER_ID") ?>:</td>
        <td width="60%">
                <?= $ID; ?>
        </td>
    </tr>
    <? } ?>
    <tr class="adm-detail-required-field">
        <td width="40%"><? echo Loc::getMessage("CHESHIRE_SKLAD_ORDER_USER_ID"); ?>:</td>
        <td width="60%">
            <input type="text" name="USER_ID" value="<? echo htmlspecialcharsbx($order['USER_ID']); ?>">
        </td>
    </tr>
    <tr>
        <td width="40%"><? echo Loc::getMessage("CHESHIRE_SKLAD_ORDER_DATE_UPDATE"); ?>:</td>
        <td width="60%">
            <input type="text" name="DATE_UPDATE" value="<? echo htmlspecialcharsbx($order['DATE_UPDATE']); ?>">
        </td>
    </tr>
   <tr>
        <td width="40%"><? echo Loc::getMessage("CHESHIRE_SKLAD_ORDER_STATUS"); ?>:</td>
        <td width="60%">
            <input type="text" name="SEO_TITLE" value="<? echo htmlspecialcharsbx($order['STATUS']); ?>">
        </td>
    </tr>
    <?
    $tabControl->EndTab();
    $tabControl->Buttons(array("disabled" => $CHESHIRE_SKLAD_RIGHT < "W", "back_url" => "/bitrix/admin/cheshire.sklad_order.php?lang=" . LANGUAGE_ID));
    $tabControl->End();
    ?>
</form>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php"); ?>