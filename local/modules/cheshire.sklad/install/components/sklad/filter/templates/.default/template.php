<?php

foreach($arResult as $arFilter) {
    $list = [];
    foreach($arFilter['VALUES'] as $val) {
        $list[] = ['name' => trim($val['NAME']), 'value'=> trim($val['VALUE']), 'active' => (bool)$val['ACTIVE']];
    }
    
    $json[] = [
        'name' => trim($arFilter['NAME']),
        'code' => strtolower($arFilter['CODE']),
        'list' => $list
    ];
}

echo json_encode($json);
