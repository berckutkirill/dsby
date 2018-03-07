<?php

use Cheshire\Sklad\SkladUserRoles;
use Bitrix\Main\Loader;

class SkladListComponent extends CBitrixComponent {

    private $props;
    private $clear_cache;

    private function getProps($PRODUCT_ID, $PRODUCT_IBLOCK_ID, $filter = []) {
        if (!$PRODUCT_ID || !$PRODUCT_IBLOCK_ID) {
            return [];
        }

        global $USER;
        $cache_props = new \CPHPCache();
        $cache_time = 3600 * 24; // кэш на сутки
        $cache_id = 'sklad_list_props' . md5($PRODUCT_ID . $PRODUCT_IBLOCK_ID . http_build_query($filter) . $USER->getId());
        $cache_path = '/sklad_list_props/';

        if (!$this->clear_cache) {
            if ($cache_time > 0 && $cache_props->InitCache($cache_time, $cache_id, $cache_path)) {
                $res = $cache_props->GetVars();

                if (is_array($res['props']) && (count($res['props']) > 0)) {
                    $props = $res['props'];
                }
            }
        }
        Bitrix\Main\Loader::includeModule('catalog');
        Bitrix\Main\Loader::includeModule('iblock');


        if (!$props || empty($props)) {

            $db_props = CIBlockElement::GetProperty($PRODUCT_IBLOCK_ID, $PRODUCT_ID, ['sort' => 'asc'], []);
            while ($ar_props = $db_props->fetch()) {
                if (!$ar_props['VALUE']) {
                    continue;
                }
                if ($ar_props['CODE'] == 'NABOR_FURNITUR') {
                    $ELEMENTS_IN = CIBlockElement::GetProperty(NABOR_IBLOCK_ID, $ar_props['VALUE'], ['sort' => 'asc'], ['CODE' => 'ELEMENTS_IN']);
                    while ($ELEMENT = $ELEMENTS_IN->fetch()) {

                        $prop = CIBlockElement::GetProperty(FURNITURE_IBLOCK_ID, $ELEMENT['VALUE'], ['sort' => 'asc'], ['CODE' => 'NAME']);
                        $nabor = \Bitrix\Iblock\ElementTable::getById($ELEMENT['VALUE']);

                        $valArr = ($nabor->fetch());
                        if ($propertyName = $prop->fetch()) {
                            $key = $propertyName['VALUE'];
                        }
                        $val = $valArr['PREVIEW_TEXT'];

                        $props['FURNISH'][] = [$key, $val];
                    }
                } else {
                    if (!$props[$ar_props['CODE']]) {
                        $props[$ar_props['CODE']] = [
                            'NAME' => $ar_props['NAME'],
                            'CODE' => $ar_props['CODE'],
                            'PROPERTY_TYPE' => $ar_props['PROPERTY_TYPE'],
                            'VALUE_XML_ID' => $ar_props['VALUE_XML_ID'],
                            'HINT' => $ar_props['HINT'],
                        ];
                        if ($ar_props['MULTIPLE'] == 'Y') {
                            $props[$ar_props['CODE']]['VALUE_ENUM'] = [$ar_props['VALUE_ENUM']];
                            $props[$ar_props['CODE']]['VALUE'] = [$ar_props['VALUE']];
                        } else {
                            $props[$ar_props['CODE']]['VALUE_ENUM'] = $ar_props['VALUE_ENUM'];
                            $props[$ar_props['CODE']]['VALUE'] = $ar_props['VALUE'];
                        }
                    } else {
                        $props[$ar_props['CODE']]['VALUE_ENUM'] = array_merge($props[$ar_props['CODE']]['VALUE_ENUM'], [$ar_props['VALUE_ENUM']]);
                        $props[$ar_props['CODE']]['VALUE'] = array_merge($props[$ar_props['CODE']]['VALUE'], [$ar_props['VALUE']]);
                    }

                    if ($ar_props['PROPERTY_TYPE'] == 'F') {
                        $props[$ar_props['CODE']]['SRC'] = CFile::GetPath($ar_props['VALUE']);
                    }
                }
            }

            if ($cache_time > 0) {
                $cache_props->StartDataCache($cache_time, $cache_id, $cache_path);
                $cache_props->EndDataCache(['props' => $props]);
            }
        }
        return $props;
    }

    private function preloadProps() {
        global $USER;
        $this->arParams['ROLE'] = SkladUserRoles::getRole($USER->getId());
        if ($this->arParams['ROLE'] == SkladUserRoles::ADMIN) {
            $this->RIGHTS['SKLAD'] = true;
        } else {
            if ($this->arParams['ROLE'] == SkladUserRoles::ADMIN) {
                $this->RIGHTS['SKLAD'] = true;
            } elseif ($this->arParams['ROLE'] == SkladUserRoles::MOGILEV) {
                $this->RIGHTS['SKLAD'] = true;
            } elseif ($this->arParams['ROLE'] == SkladUserRoles::SKLAD) {
                $this->RIGHTS['SKLAD'] = true;
            }
        }

        if (!$this->RIGHTS["WATCH_ALL"]) {
            $this->arParams['filter']['USER_ID'] = $USER->getId();
        }

        $this->arParams['PRICE_CODE'] = $this->arParams['PRICE_CODE'] ? $this->arParams['PRICE_CODE'] : [0 => 'BASE'];
        $this->arParams['OFFERS_FIELDS'] = $this->arParams['OFFERS_FIELDS'] ? $this->arParams['OFFERS_FIELDS'] : [];
        $this->arParams['OFFERS_PROPERTIES'] = $this->arParams['OFFERS_PROPERTIES'] ? $this->arParams['OFFERS_PROPERTIES'] : [];
        $this->arParams['STORE_ID'] = $this->arParams['STORE_ID'] ? $this->arParams['STORE_ID'] : 1;
        $this->arParams['ACTION_VARIABLE'] = $this->arParams['ACTION_VARIABLE'] ? $this->arParams['ACTION_VARIABLE'] : 'action';
        $this->arParams['PRODUCT_ID_VARIABLE'] = $this->arParams['PRODUCT_ID_VARIABLE'] ? $this->arParams['PRODUCT_ID_VARIABLE'] : 'id';
    }

    private function getProperties($ids) {
        if (!$ids) {
            return [];
        }
        global $DB;

        $in = '(' . implode(',', $ids) . ')';

        $strSql = 'SELECT ID, VALUE FROM  `b_iblock_property_enum` WHERE  `PROPERTY_ID` IN ' . $in;
        $ob = $DB->Query($strSql, false, __LINE__);
        while ($res = $ob->GetNext()) {
            $result[$res['ID']] = $res['VALUE'];
        }

        return $result;
    }

    private function getOffers() {
        global $DB;

        $product_table = 'b_catalog_product';
        $product_table_prefix = 'BC';
        $element_table = 'b_iblock_element';
        $element_table_prefix = 'BE';

        $property_table = 'b_iblock_element_property';
        $property_table_prefix = 'BP';

        $b_catalog_price = 'b_catalog_price';
        $b_catalog_price_prefix = 'BCP';


        $b_iblock_property = 'b_iblock_property';
        $b_iblock_property_prefix = 'BBP';

        $SelectFields = '';
        foreach ($this->arParams['OFFERS_FIELDS'] as $code) {
            if ($SelectFields) {
                $SelectFields .=',';
            }
            $SelectFields .= $element_table_prefix . '.' . $code;
        }
        unset($code);

        $whereProps = '';
        foreach ($this->arParams['OFFERS_FILTER_PROPS'] as $code => $val) {
            if ($whereProps) {
                $whereProps .= ' AND ';
            }
            $whereProps .= $property_table_prefix . '.' . $code . ' = ' . $val;
        }
        unset($val);
        $whereFields = '';
        foreach ($this->arParams['OFFERS_FILTER'] as $code => $val) {
            if ($whereFields) {
                $whereFields .= ' AND ';
            }
            if (is_array($val)) {
                $whereFields .= $element_table_prefix . '.' . $code . ' IN (' . implode(', ', $val) . ')';
            } else {
                $whereFields .= $element_table_prefix . '.' . $code . ' = ' . $val;
            }
        }
        unset($val);

        if ($SelectFields) {
            $SelectFields.= ', ';
        }
        $SelectFields.= $b_catalog_price_prefix . '.PRICE, ' . $b_catalog_price_prefix . '.CURRENCY ';
        $SelectFields.= ', ';
         $SelectFields.= $product_table_prefix . '.QUANTITY_RESERVED, ' . $product_table_prefix . '.QUANTITY ';
        $SelectFields.= ', ';
        $SelectFields.= $property_table_prefix . '.VALUE as VALUE_ID, '
                . $property_table_prefix . '.VALUE_ENUM as PROP_ID, '
                . $property_table_prefix . '.IBLOCK_PROPERTY_ID';
        $SelectFields.= ', ';
        $SelectFields.= $b_iblock_property_prefix . '.NAME as VALUE_NAME, ' . $b_iblock_property_prefix . '.CODE as VALUE_CODE';
        $strSql = 'SELECT ' . $SelectFields . ' FROM ' . $element_table . ' ' . $element_table_prefix
                . ' INNER JOIN ' . $b_catalog_price . ' ' . $b_catalog_price_prefix
                . ' ON ' . $b_catalog_price_prefix . '.PRODUCT_ID = ' . $element_table_prefix . '.ID'
                . ' LEFT JOIN ' . $product_table . ' ' . $product_table_prefix
                . ' ON ' . $product_table_prefix . '.ID = ' . $element_table_prefix . '.ID'
                . ' LEFT JOIN ' . $property_table . ' ' . $property_table_prefix
                . ' ON ' . $property_table_prefix . '.IBLOCK_ELEMENT_ID = ' . $element_table_prefix . '.ID'
                . ' LEFT JOIN ' . $b_iblock_property . ' ' . $b_iblock_property_prefix
                . ' ON ' . $b_iblock_property_prefix . '.ID = ' . $property_table_prefix . '.IBLOCK_PROPERTY_ID'
                . ' WHERE ' . $element_table_prefix . '.IBLOCK_ID = ' . $this->arParams['IBLOCK_OFFERS_ID'];

        if ($whereFields) {
            $strSql.= ' AND ' . $whereFields;
        }

        if ($whereProps) {
            $strSql.= ' AND ' . $whereProps;
        }

        if ($this->arParams['NAV_PAGE_ELEMENT_COUNT'] !== 'all') {
            $SFrom = filter_input(INPUT_GET, 'nav-list');
            $from = (intval(str_replace('page-', '', $SFrom)) - 1) * 30;
            if ($from < 0) {
                $from = 0;
            }

            $to = $from + 30;
            $strSql .= ' LIMIT ' . $from . ',' . $to;
        }
        
        //SELECT BE.ID,BE.IBLOCK_ID,BE.NAME, BCP.PRICE, BCP.CURRENCY , BC.QUANTITY_RESERVED, BC.QUANTITY , BP.VALUE as VALUE_ID, BP.VALUE_ENUM as PROP_ID, BP.IBLOCK_PROPERTY_ID, BBP.NAME as VALUE_NAME, BBP.CODE as VALUE_CODE FROM b_iblock_element BE INNER JOIN b_catalog_price BCP ON BCP.PRODUCT_ID = BE.ID LEFT JOIN b_catalog_product BC ON BC.ID = BE.ID LEFT JOIN b_iblock_element_property BP ON BP.IBLOCK_ELEMENT_ID = BE.ID LEFT JOIN b_iblock_property BBP ON BBP.ID = BP.IBLOCK_PROPERTY_ID WHERE BE.IBLOCK_ID = 20 AND BE.ID IN (1814, 1814, 1833, 1824, 1829, 1820, 1756, 1778, 1766, 1801, 1820, 1753, 1791, 1818, 1822, 1838, 1753, 1791, 1818, 1822, 1838, 1808, 1834, 1792, 1831, 1840, 1745, 1821, 1819, 1753, 1753, 1761)
        $ob = $DB->Query($strSql, false, __LINE__);


        while ($prod = $ob->GetNext()) {
            if (!$res[$prod['ID']]) {

                $res[$prod['ID']] = [
                    'ID' => $prod['ID'],
                    'NAME' => $prod['NAME'],
                    'PRICE' => $prod['PRICE'],
                    'QUANTITY_RESERVED' => $prod['QUANTITY_RESERVED'],
                    'CURRENCY' => $prod['CURRENCY']
                ];
            }

            if ($prod['IBLOCK_PROPERTY_ID'] == $this->arParams['ROUTE_ID']) {
                $res[$prod['ID']]['LINK_ELEMENT_ID'] = $prod['VALUE_ID'];
            } else {
                $res[$prod['ID']]['PROPERTIES'][$prod['VALUE_CODE']] = ['NAME' => $prod['VALUE_NAME'],
                    'VALUE_ENUM' => $this->props[$prod['VALUE_ID']]];
            }
        }
        return($res);
    }

    private function update($id, $fields) {

        $arFields = Array(
            "PRODUCT_ID" => $id,
            "CATALOG_GROUP_ID" => 1,
            "PRICE" => intval($fields['price']),
            "CURRENCY" => "BYR"
        );

        $res = CPrice::GetList(
                        array(), array(
                    "PRODUCT_ID" => $id,
                    "CATALOG_GROUP_ID" => 1
                        )
        );

        if ($arr = $res->Fetch()) {
            $res = CPrice::Update($arr["ID"], $arFields);
        }
        return $res;
    }

    private function getStocks($IDS) {

        $result = [];
        $select = ['ID',
            'PRODUCT_ID',
            'AMOUNT',
            'STORE_ID',
            'STORE_NAME',
            'STORE_ADDR',
            'STORE_DESCR'];
        $rsStore = CCatalogStoreProduct::GetList([], ['PRODUCT_ID' => $IDS], false, false, $select);

        while ($arStore = $rsStore->fetch()) {
            $result[$arStore['PRODUCT_ID']][] = $arStore;
        }
        return $result;
    }

    private function getSklad() {
        $filterMain['IBLOCK_ID'] = $this->arParams['IBLOCK_ID'];
        $arrGet = [
            'select' => ['ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE'],
            'filter' => $filterMain,
        ];
        $ob = Bitrix\Iblock\ElementTable::getList($arrGet);

        while ($row = $ob->fetch()) {
            $row['PROPERTIES'] = $this->getProps($row['ID'], $row['IBLOCK_ID']);
            $id = $row['PREVIEW_PICTURE'];
            $row['PREVIEW_PICTURE'] = [];
            if ($id) {
                $row['PREVIEW_PICTURE']['SRC'] = CFile::GetPath($id);
            }
            $result[$row['ID']] = $row;
        }
        return $result;
    }

    public function getList() {
        global $USER;
        $result = [];
        $this->clear_cache = Bitrix\Main\Application::getInstance()->getContext()->getRequest()->get('clear_cache');

        $this->preloadProps();

        $url = filter_input(INPUT_SERVER, 'REQUEST_URI');

        $cache_time = 3600 * 24 * 0; // кэш на сутки
        $cache_id = 'sklad_list' . md5(http_build_query($this->arParams) . $USER->getId() . $url); // кэш для url
        $cache_path = '/sklad_list/';
        $cache = new \CPHPCache();

        if (!$this->clear_cache) {

            if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path)) {
                $res = $cache->GetVars();
                if (is_array($res) && (count($res) > 0)) {
                    $result = unserialize($res['items']);
                    $this->props = unserialize($res['props']);
                }
            }
        }
        Bitrix\Main\Loader::includeModule('catalog');
        Bitrix\Main\Loader::includeModule('iblock');


        if (empty($result)) {

            if ($this->arParams['IBLOCK_ID']) {
                $result = $this->getSklad();

                $this->props = $this->getProperties($this->arParams['OFFERS_PROPERTIES']);
            }

            if ($cache_time > 0) {
                $cache->StartDataCache($cache_time, $cache_id, $cache_path);
                $cache->EndDataCache(['items' => serialize($result), 'props' => serialize($this->props)]);
            }
        }

        $arOffers = $this->getOffers();

        if (!empty($arOffers)) {
            $stocks = [];
            $offers = [];
            if ($this->RIGHTS['SKLAD']) {

                foreach ($arOffers as $arOffer) {
                    $offers[] = $arOffer['ID'];
                }
                unset($arOffer);
                if ($offers) {
                    $stocks = $this->getStocks($offers);
                }

                foreach ($arOffers as $k => $arOffer) {
                    $quantity = 0;
                    foreach ($stocks[$k] as $amount) {
                        $quantity += $amount['AMOUNT'];
                    }
                    $arOffers[$k]['QUANTITY'] = $quantity;
                }
            }
            foreach ($arOffers as $arOffer) {
                $result[$arOffer['LINK_ELEMENT_ID']]['OFFERS'][] = $arOffer;
            }
            unset($arOffer);

            foreach ($result as $k => $arr) {
                if (!$arr['OFFERS'] || empty($arr['OFFERS'])) {
                    unset($result[$k]);
                }
            }
            unset($arr);
        } else {
            $result = [];
        }

        return $result;
    }

    public function executeComponent() {
        if (!Loader::includeModule('cheshire.sklad')) {
            throw new Exception("Moule not found");
        }
        if (!Loader::includeModule('catalog')) {
            throw new Exception("Moule not found");
        }
        $data = json_decode(file_get_contents('php://input'), true);
        if ($this->arParams['action'] == 'GET') {
            $result = $this->getList();
        } elseif ($this->arParams['action'] == 'PUT') {
            $result = $this->update($data['id'], $data);
        }

        if ($this->arParams['NOT_INCLUDE_TPL']) {
            return $result;
        } else {
            $this->arResult = $result; // навигация в $params['NAV_PARAMS']
            $this->includeComponentTemplate();
        }
    }

}
