<?php
/*
         * Название объекта = PERSONAL_PROFESSION; name
         * Город = PERSONAL_CITY; city
         * Почтовый индекс = PERSONAL_ZIP; index
         * Адрес = WORK_STREET; address
         * Юридический адрес = PERSONAL_STREET; ur_address
         * ФИО контактного лица = PERSONAL_NOTES; fio
         * Контактный телефон = PERSONAL_PHONE; phone
         * Контактный адрес эл. ящика = EMAIL; email
         * Имя сверху справа = NAME; main_name
         * Роль = ROLE; role
*/


$arUser = [
    'id' => $arResult['ID'],
    'name' => $arResult['PERSONAL_PROFESSION'],
    'city' => $arResult['PERSONAL_CITY'],
    'index' => $arResult['PERSONAL_ZIP'],
    'address' => $arResult['WORK_STREET'],
    'ur_address' => $arResult['PERSONAL_STREET'],
    'main_name' => $arResult['NAME'],
    'phone' => $arResult['PERSONAL_PHONE'],
    'email' => $arResult['EMAIL'],
    'fio' => $arResult['PERSONAL_NOTES'],
    'role' => $arResult['ROLE'],
];

echo json_encode($arUser);
