<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");
use Bitrix\Main\Application;
use Bitrix\Main\Entity\Base;
use \Bitrix\Main\Localization\Loc;

$CHESHIRE_MAIN_RIGHT = $APPLICATION->GetGroupRight("cheshire.main");

if ($CHESHIRE_MAIN_RIGHT == "D") {
    $APPLICATION->AuthForm(Loc::getMessage("ACCESS_DENIED"));
}
\Bitrix\Main\Loader::includeModule('cheshire.main');
Loc::loadMessages(__FILE__);

$errorMessage = array();
$appContext = Application::getInstance()->getContext();
$request = $appContext->getRequest();
    
$ID = '';
if ($request->get("ID")) {
    $ID = (string) $request->get("ID");
}


$arFields = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $CHESHIRE_MAIN_RIGHT == "W" && check_bitrix_sessid()) {

    if ($request->getPost("URL") && check_bitrix_sessid()) {
        if (!Application::getConnection(\Cheshire\Main\FilterTable::getConnectionName())->isTableExists(
                        Base::getInstance('\Cheshire\Main\FilterTable')->getDBTableName()
                )
        ) {
            Base::getInstance('\Cheshire\Main\FilterTable')->createDbTable();
        }
        $DB->StartTransaction();
        $arFields = [
            "URL" => $request->getPost("URL"),
            "H1" => $request->getPost("H1"),
            "SEO_TITLE" => $request->getPost("SEO_TITLE"),
            "SEO_KEYWORDS" => $request->getPost("SEO_KEYWORDS"),
            "SEO_DESCRIPTION" => $request->getPost("SEO_DESCRIPTION")
        ];
        if ($ID) {
            $res = \Cheshire\Main\FilterTable::update($ID, $arFields);
        } else {
            $result = \Cheshire\Main\FilterTable::add($arFields);
            $res = ($result !== '');
            $ID = $result->getId();
        }

        echo CAdminMessage::ShowMessage(array("MESSAGE" => Loc::getMessage("CHESHIRE_MAIN_ROW_ADDED"), "TYPE" => "OK"));
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
            LocalRedirect('/bitrix/admin/cheshire.main_filter.php?lang=' . LANGUAGE_ID);

        LocalRedirect('/bitrix/admin/cheshire.main_filter_edit.php?ID=' . $ID . '&lang=' . LANGUAGE_ID);
    }
}

$defaultValues = array(
    'URL' => '',
    'H1' => '',
    'SEO_TITLE' => '',
    'SEO_KEYWORDS' => '',
    'SEO_DESCRIPTION' => '',
);

if ($ID != '')
    $APPLICATION->SetTitle(Loc::getMessage("CHESHIRE_MAIN_EDIT_TITLE"));
else
    $APPLICATION->SetTitle(Loc::getMessage("CHESHIRE_MAIN_NEW_TITLE"));

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");
$filter = $defaultValues;
if ($ID != '') {
    $filter = \Cheshire\Main\FilterTable::getById($ID)->fetch();
   
    if (empty($filter)) {
        $ID = '';
        $filter = $defaultValues;
    }
     
}

if (!empty($errorMessage)) {
    $filter = $arFields;
}

$aContext = array(
    array(
        "ICON" => "btn_list",
        "TEXT" => Loc::getMessage("MAIN_ADMIN_MENU_LIST"),
        "LINK" => "cheshire.main_filter.php?lang=" . LANGUAGE_ID,
        "TITLE" => Loc::getMessage("MAIN_ADMIN_MENU_LIST")
    ),
);

if ($ID != '') {
    $aContext[] = array(
        "ICON" => "btn_new",
        "TEXT" => Loc::getMessage("MAIN_ADMIN_MENU_CREATE"),
        "LINK" => "filter_edit.php?lang=" . LANGUAGE_ID,
        "TITLE" => Loc::getMessage("MAIN_ADMIN_MENU_CREATE")
    );

    if ($CHESHIRE_MAIN_RIGHT == "W") {
        $aContext[] = array(
            "ICON" => "btn_delete",
            "TEXT" => Loc::getMessage("MAIN_ADMIN_MENU_DELETE"),
            "ONCLICK" => "javascript:if(confirm('" . getMessageJS("CONFIRM_DEL_MESSAGE") . "'))window.location='cheshire.main_filter.php?action=delete&ID[]=" . CUtil::JSEscape($ID) . "&lang=" . LANGUAGE_ID . "&" . bitrix_sessid_get() . "';",
        );
    }
}
$context = new CAdminContextMenu($aContext);
$context->Show();

$aTabs = array(
	array("DIV" => "edit1", "TAB" => Loc::getMessage("CHESHIRE_MAIN_FILTER_CURR"), "ICON"=>"", "TITLE"=>Loc::getMessage("CHESHIRE_MAIN_FILTER_CURR"))
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
        <td width="40%"><? echo Loc::getMessage("CHESHIRE_MAIN_FILTER_ID") ?>:</td>
        <td width="60%">
                <?= $ID; ?>
        </td>
    </tr>
    <? } ?>
    <tr class="adm-detail-required-field">
        <td width="40%"><? echo Loc::getMessage("CHESHIRE_MAIN_FILTER_URL"); ?>:</td>
        <td width="60%">
            <input type="text" name="URL" value="<? echo htmlspecialcharsbx($filter['URL']); ?>">
        </td>
    </tr>
    <tr>
        <td width="40%"><? echo Loc::getMessage("CHESHIRE_MAIN_FILTER_H1"); ?>:</td>
        <td width="60%">
            <input type="text" name="H1" value="<? echo htmlspecialcharsbx($filter['H1']); ?>">
        </td>
    </tr>
   <tr>
        <td width="40%"><? echo Loc::getMessage("CHESHIRE_MAIN_FILTER_SEO_TITLE"); ?>:</td>
        <td width="60%">
            <input type="text" name="SEO_TITLE" value="<? echo htmlspecialcharsbx($filter['SEO_TITLE']); ?>">
        </td>
    </tr>
    <tr>
        <td width="40%"><? echo Loc::getMessage("CHESHIRE_MAIN_FILTER_SEO_KEYWORDS"); ?>:</td>
        <td width="60%">
            <input type="text" name="SEO_KEYWORDS" value="<? echo htmlspecialcharsbx($filter['SEO_KEYWORDS']); ?>">
        </td>
    </tr>
    <tr>
        <td width="40%"><? echo Loc::getMessage("CHESHIRE_MAIN_FILTER_SEO_DESCRIPTION"); ?>:</td>
        <td width="60%">
            <input type="text" name="SEO_DESCRIPTION" value="<? echo htmlspecialcharsbx($filter['SEO_DESCRIPTION']); ?>">
        </td>
    </tr>
    <?
    $tabControl->EndTab();
    $tabControl->Buttons(array("disabled" => $CHESHIRE_MAIN_RIGHT < "W", "back_url" => "/bitrix/admin/cheshire.main_filter.php?lang=" . LANGUAGE_ID));
    $tabControl->End();
    ?>
</form>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php"); ?>