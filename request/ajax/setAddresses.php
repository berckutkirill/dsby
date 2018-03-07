<?php
set_time_limit(0);
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
if(!empty($_POST)) {
    CModule::IncludeModule("highloadblock");
    $hlblock = HL\HighloadBlockTable::getById(17)->fetch();
    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();


    $data = [
		"UF_ACTIVE" => $_POST["UF_ACTIVE"],
		"UF_COUNTRY" => $_POST["UF_COUNTRY"],
        "UF_PLACE" => $_POST["UF_PLACE"],
        "UF_STREET" => $_POST["UF_STREET"],
        "UF_HOME_NUMBER" => $_POST["UF_HOME_NUMBER"],
        "UF_CORPUS" => $_POST["UF_CORPUS"],
        "UF_NAME" => $_POST["UF_NAME"],
        "UF_COORDS" => $_POST["UF_COORDS"][0].','.$_POST["UF_COORDS"][1]
    ];
    $entity_data_class::update($_POST['ID'], $data);
}
