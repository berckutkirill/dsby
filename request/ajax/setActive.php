<?php

set_time_limit(0);
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$data = GetHBlock(17, [], ["ID" => "ASC"]);

$hlblock = HL\HighloadBlockTable::getById(17)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

foreach ($data as $row) {

    $data = [
        "UF_ACTIVE" => 1
    ];
    $entity_data_class::update($row["ID"], $data);
}
