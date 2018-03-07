<?php

use Cheshire\Sklad\SkladUserRoles;
use Bitrix\Main\Loader;

class SkladFilterComponent extends CBitrixComponent {

    private $props;

    private function makeFilter($row, $PROPERTIES = [], &$filter) {

        foreach ($this->arParams['FILTER_FIELDS'] as $field) {
            if ($PROPERTIES['FIELDS'][$field]) {
                if (!$filter[$field]) {
                    $filter[$field] = ['NAME' => $PROPERTIES['FIELDS'][$field]['NAME'], 'CODE' => $field];
                }

                if (!in_array(['NAME' => $PROPERTIES['FIELDS'][$field]['VALUE'],
                            'VALUE' => $PROPERTIES['FIELDS'][$field]['VALUE']], $filter[$field]['VALUES'])) {

                    $filter[$field]['VALUES'][] = ['NAME' => $PROPERTIES['FIELDS'][$field]['VALUE'],
                        'VALUE' => $PROPERTIES['FIELDS'][$field]['VALUE']];
                }
            }
        }

        unset($field);
        
        foreach ($this->arParams['FILTER_PROPERTIES'] as $field) {
            if ($PROPERTIES['PROPS'][$field]['VALUE']) {

                if (!$filter[$field]) {
                    $filter[$field] = ['NAME' => $PROPERTIES['PROPS'][$field]['NAME'], 'CODE' => $field];
                }
                if ($PROPERTIES['PROPS'][$field]['PROPERTY_TYPE'] == 'L') {
                    $PROPERTIES['PROPS'][$field]['NAME'] = $PROPERTIES['PROPS'][$field]['VALUE_ENUM'];
                } elseif ($PROPERTIES['PROPS'][$field]['PROPERTY_TYPE'] == 'S') {
                    $PROPERTIES['PROPS'][$field]['NAME'] = $PROPERTIES['PROPS'][$field]['VALUE'];
                } else {
                    continue;
                }
                $filter[$field]['VALUES'][] = ['NAME' => $PROPERTIES['PROPS'][$field]['NAME'],
                    'VALUE' => $PROPERTIES['PROPS'][$field]['VALUE']];
            }
        }
        unset($field);
    }

    private function getElProps($ID, $IBLOCK_ID, $FILTER_PROPERTIES, &$filter) {

        $ob = CIBlockElement::GetProperty($IBLOCK_ID, $ID, ["sort" => "ASC"]);

        while ($property = $ob->Fetch()) {
            if (!in_array($property['CODE'], $FILTER_PROPERTIES) || !$property['VALUE']) {
                continue;
            }
            $property['VALUE'] = trim($property['VALUE']);
            $property['NAME'] = trim($property['NAME']);
            if (!$filter[$property['CODE']]) {
                $filter[$property['CODE']] = [
                    'NAME' => $property['NAME'],
                    'CODE' => $property['CODE'],
                    'PROPERTY_TYPE' => $property['PROPERTY_TYPE']
                ];
            }
           
            
            if ($this->props[$property['CODE']][$property['VALUE']]) {
                $this->props[$property['CODE']][$property['VALUE']]++;
            } else {
                $this->props[$property['CODE']][$property['VALUE']] = 1;
                $filter[$property['CODE']]['VALUES'][] = [
                    'NAME' => $property['VALUE_ENUM'],
                    'VALUE' => $property['VALUE'],
                    'VALUE_XML_ID' => $property['VALUE_XML_ID']
                ];
            }
        }
        
    }

    private function getUsers() {
        global $USER;
        if (!$USER->IsAuthorized()) {
            return;
        }

        $cache = new \CPHPCache();
        $cache_time = 3600 * 24; // кэш на сутки
        $cache_id = 'sklad_filter_user' . $USER->getId(); // кэш для user
        $cache_path = '/sklad_filter_user/';

        if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path)) {
            $res = $cache->GetVars();
            if (is_array($res['users']) && (count($res['users']) > 0)) {
                $response = $res['users'];
            }
        }
        if (empty($response)) {
            $response = [];
            $filter = ["ACTIVE" => "Y",
                "GROUPS_ID" => SkladUserRoles::getRoleId(SkladUserRoles::MANAGER)];
            $rsUsers = CUser::GetList(($by = "personal_country"), ($order = "desc"), $filter); // выбираем пользователей
            while ($user = $rsUsers->GetNext()) {
                $response[] = ['NAME' => $user['NAME'], 'VALUE' => $user['ID']];
            }
            if ($cache_time > 0) {
                $cache->StartDataCache($cache_time, $cache_id, $cache_path);
                $cache->EndDataCache(['users' => $response]);
            }
        }

        return $response;
    }

    public function executeComponent() {
        if ((!$this->arParams['FILTER_FIELDS'] && !$this->arParams['FILTER_PROPERTIES']) || !$this->arParams['IBLOCK_ID']) {
            return false;
        }
        if (!Loader::includeModule('cheshire.sklad')) {
            throw new Exception("Moule not found");
        }
        global $USER;
        $context = \Bitrix\Main\Application::getInstance()->getContext();
        $request = $context->getRequest();
        $arrQ = $request->getQueryList()->toArray();
        ksort($arrQ);
        $str = http_build_query($arrQ);
        $filter = [];
        $this->clear_cache = $request->get('clear_cache');


        $cache = new \CPHPCache();
        $cache_time = 3600 * 24 * 0; // кэш на сутки
        $cache_id = 'sklad_filter' . $this->arParams['IBLOCK_ID'] . $str . $this->arParams['FILTER_FOR']; // кэш для IBLOCK_ID
        $cache_path = '/sklad_filter/';

        if (!$this->clear_cache) {
            if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path)) {
                $res = $cache->GetVars();
                if (is_array($res['filter']) && (count($res['filter']) > 0)) {
                    $filter = $res['filter'];
                }
            }
        }

        if (empty($filter)) {
            
            Loader::includeModule('iblock');
            if ($this->arParams['FILTER_FOR'] == 'orders') {
                    $filter['OBJECTS'] = ['NAME' => 'Фильтр по объектам', 'CODE' => 'USER_ID'];
                    $filter['OBJECTS']['VALUES'] = $this->getUsers();
            } else {
                $ob = Bitrix\Iblock\ElementTable::getList([
                            'select' => ['ID', 'IBLOCK_ID', 'NAME'],
                            'filter' => ['IBLOCK_ID' => $this->arParams['IBLOCK_ID']],
                            'order' => ['NAME' => 'ASC']
                ]);

                while ($row = $ob->fetch()) {
                    
                    $PROPERTIES["FIELDS"]['NAME'] = ["NAME" => "Фильтр по названию", "VALUE" => trim($row["NAME"])];
                    $PROPERTIES["PROPS"] = $this->getElProps($row['ID'], $row['IBLOCK_ID'], $this->arParams['FILTER_PROPERTIES'], $filter);
                    $this->makeFilter($row, $PROPERTIES, $filter);
                }

                ksort($filter);
                foreach ($filter as $k => $arr) {
                    $active = false;
                    usort($arr['VALUES'], function($a, $b) {
                        if ($a['NAME'] < $b['NAME']) {
                            return -1;
                        } elseif($a['NAME'] > $b['NAME']) {
                            return 1;
                        };
                        
                        return 0;
                    });
                    $filter[$k] = $arr;
                    if (is_array($request->get($k))) {
                        foreach ($arr['VALUES'] as $key => $val) {
                            if (in_array($val['VALUE'], $request->get($k))) {
                                $filter[$k]['VALUES'][$key]['ACTIVE'] = true;
                            }
                        }
                    } elseif ($request->get($k)) {
                        foreach ($arr['VALUES'] as $key => $val) {

                            if (trim($request->get($k)) == trim($val['VALUE'])) {
                                $filter[$k]['VALUES'][$key]['ACTIVE'] = true;
                            }
                        }
                    }
                }
            }
            if ($cache_time > 0) {
                $cache->StartDataCache($cache_time, $cache_id, $cache_path);
                $cache->EndDataCache(['filter' => $filter]);
            }
        }

        foreach ($filter as $prop) {
            foreach ($prop['VALUES'] as $val) {
                if ($val['ACTIVE']) {
                    $arrFilter[$prop['CODE']][] = $val['VALUE'];
                }
            }
        }

        $this->arResult = $filter;
        $this->includeComponentTemplate();
        return $arrFilter;
    }

}
