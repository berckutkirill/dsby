<?php

class SkladDocumentComponent extends CBitrixComponent {

    private $RIGHTS;


    private function getPrices(array $ids) {
        $dbProductPrice = CPrice::GetListEx(
                        array(), array("PRODUCT_ID" => $ids), false, false, array("ID", "PRODUCT_ID", "PRICE", "CURRENCY")
        );
        while ($row = $dbProductPrice->Fetch()) {
            $response[$row['PRODUCT_ID']] = $row;
        }
        return $response;
    }

    private function addProds(array $products, $id) {

        if (!empty($products) && $id) {
            foreach ($products as $key => $val) {

                $arAdditional = [
                    "AMOUNT" => $val["quantity"],
                    "ELEMENT_ID" => $val["id"],
                    "PURCHASING_PRICE" => $val["price"],
                    "SUMM" => $val["price"] * $val["quantity"],
                    "STORE_TO" => 1,
                    "STORE_FROM" => 1,
                    "ENTRY_ID" => $key,
                    "DOC_ID" => $id,
                ];

                $docElementId = CCatalogStoreDocsElement::add($arAdditional);
                if(!$docElementId) {
                    return;
                }
                if ($docElementId && isset($val["BARCODE"])) {
                    $arBarcode = array();
                    if (!empty($val["BARCODE"])) {
                        $arBarcode = explode(', ', $val["BARCODE"]);
                    }

                    if (!empty($arBarcode)) {
                        foreach ($arBarcode as $barCode) {
                            CCatalogStoreDocsBarcode::add(array("BARCODE" => $barCode, "DOC_ELEMENT_ID" => $docElementId)); // добавляем штрихкод
                        }
                    }
                }

                $fields = [
                    "DOC_ID" => $id,
                    "QUANTITY" => $val["quantity"],
                    "ELEMENT_ID" => $val["id"],
                    "PRICE" => $val["price"],
                    "COMMENT" => $val['comment'],
                    "CHANGED" => intval($val['changed']),
                ];

                $ob = Cheshire\Sklad\StockDataParamsTable::getList([
                            'select' => ['ID', 'DOC_ID'],
                            'filter' => ['DOC_ID' => $id, 'ELEMENT_ID' => $val["id"]]
                ]);

                if ($res = $ob->fetch()) {
                    $ob = Cheshire\Sklad\StockDataParamsTable::update($res['ID'], $fields);
                } else {
                    $ob = Cheshire\Sklad\StockDataParamsTable::add($fields);
                }
                if(!$ob->isSuccess()) {
                    print_r($ob->getErrorMessages());
                    return false;
                }
            }
        }
    }

    private function getDocDatas($filter) {
        
        $doc_datas = [];
        $ob = \Cheshire\Sklad\StockDataTable::getList([
                    'select' => ['ID', 'DOC_ID', 'STATUS', 'DATE_CREATE',
                        'QUANTITY' => 'DATA.QUANTITY',
                        'CHANGED' => 'DATA.CHANGED',
                        'PRICE' => 'DATA.PRICE',
                        'ELEMENT_ID' => 'DATA.ELEMENT_ID',
                        'COMMENT' => 'DATA.COMMENT'
                    ],
                    'filter' => $filter,
                    'order' => ['DOC_ID' => 'DESC']
        ]);
        if ($this->arParams['filter']['ID']) {
            unset($this->arParams['filter']['ID']);
        }
        while ($res = $ob->fetch()) {
            
            if (!in_array($res['DOC_ID'], $this->arParams['filter']['ID'])) {
                $this->arParams['filter']['ID'][] = $res['DOC_ID'];
            }
            if (!$doc_datas[$res['DOC_ID']]['STATUS']) {
                $doc_datas[$res['DOC_ID']]['STATUS'] = $res['STATUS'];
            }
            $doc_datas[$res['DOC_ID']]['DATA'][] = [
                'id' => $res['ELEMENT_ID'],
                'quantity' => $res['QUANTITY'],
                'changed' => intval($res['CHANGED']),
                'comment' => $res['COMMENT'],
                'price' => $res['PRICE'],
            ];
        }

        return $doc_datas;
    }

    /*
     * CAT_CURRENCY_STORE // id контрагента // 1
     * CAT_CURRENCY_STORE // валюта // BYR
     * doc_type // A - приход D - списание
     * doc_date // date
     * comment // коммент
     * products : [{
     *      quantity : 30,
      id : 1542,
      price : 10,
     *  }]
     */

    private function makeArFields(array $post) {

        global $USER;
        if ($post['status']) {
            $arGeneral['status'] = $post['status'];
            return $arGeneral;
        }
        $contractorId = (isset($post['CONTRACTOR_ID']) ? (int) $post['CONTRACTOR_ID'] : 1);
        $currency = (!empty($post["CAT_CURRENCY_STORE"]) ? (string) $post["CAT_CURRENCY_STORE"] : 'BYR');
        $userId = (int) $USER->getId();
        if ($this->arParams['DOC_TYPE']) {
            $post['doc_type'] = $this->arParams['DOC_TYPE'];
        }

        $arGeneral = array(
            "DOC_TYPE" => $post['doc_type'] ? $post['doc_type'] : 'A',
            "SITE_ID" => "s1",
            "DATE_DOCUMENT" => date('m.d.Y'),
            "MODIFIED_BY" => $userId,
            "COMMENTARY" => $post["comment"]
        );
        if ($arGeneral['DOC_TYPE'] == 'A') {
            $arGeneral["CONTRACTOR_ID"] = $contractorId;
            $arGeneral["CURRENCY"] = $currency;
        }
        if (intval($post['manager'])) {
            $arGeneral["CREATED_BY"] = $post['manager'];
        } else {
            $arGeneral["CREATED_BY"] = $USER->getId();
        }
        /*
         * products : [{
         *      quantity : 30,
         *      id : 1542, 
         *      price : 10,
         * }]
         */
        $total = 0;
        if ($post['data']) {
            foreach ($post['data'] as $prod) {
                $ids[] = $prod['id'];
            }
            if ($ids && count($ids)) {
                $prices = $this->getPrices($ids);
            }

            foreach ($post['data'] as $product) {
                $price = $product['price'] ? $product['price'] : $prices[$product['id']]['PRICE'];
                $total += $product['quantity'] * $price;
                $arGeneral['products'][] = [
                    'id' => $product['id'],
                    'quantity' => $product['quantity'],
                    'changed' => $product['changed'] ? $USER->getId() : '',
                    'comment' => $product['comment'],
                    'price' => $price,
                ];
            }
        }

        $arGeneral["TOTAL"] = $total;

        return $arGeneral;
    }

    private function reserve($idD) {
        Bitrix\Main\Loader::includeModule('catalog');
        $dbElement = CCatalogStoreDocsElement::getList(array(), array("DOC_ID" => $idD), false, false, array("ID", "ELEMENT_ID", 'AMOUNT', 'PURCHASING_PRICE', 'STORE_TO'));
        while ($arElement = $dbElement->Fetch()) {
            $PRODUCT_ID = $arElement["ELEMENT_ID"];
            $product['quantity'] = $arElement['AMOUNT'];

            if ($ar_res = CCatalogProduct::GetByID($PRODUCT_ID)) {
                $product['quantity'] += intval($ar_res['QUANTITY_RESERVED']);
            }

            $arFields = array('QUANTITY_RESERVED' => $product['quantity']);
            CCatalogProduct::Update($PRODUCT_ID, $arFields);
        }
    }

    private function unReserve($idD) {

        $dbElement = CCatalogStoreDocsElement::getList(array(), array("DOC_ID" => $idD), false, false, array("ID", "ELEMENT_ID", 'AMOUNT', 'PURCHASING_PRICE', 'STORE_TO'));
        while ($arElement = $dbElement->Fetch()) {
            $product['id'] = $arElement["ELEMENT_ID"];
            $product['quantity'] = $arElement['AMOUNT'];
            $product['price'] = $arElement['PURCHASING_PRICE'];
            $products[] = $product;
        }
        global $USER;
        $arGeneral = array(
            "DOC_TYPE" => 'U',
            "SITE_ID" => "s1",
            "DATE_DOCUMENT" => date('m.d.Y'),
            "MODIFIED_BY" => $USER->getId(),
            "CREATED_BY" => $USER->getId(),
        );

        $id = CCatalogDocs::add($arGeneral);

        if (is_array($products) && !empty($products) && $id) {
            $this->addProds($products, $id);
        }

        CCatalogDocs::conductDocument($id, $USER->getId());
    }

    private function addDocument(array $arFields) {

        if ($products = $arFields['products']) {
            unset($arFields['products']);
        } else {
            $products = [];
        }
        global $USER;

        $id = CCatalogDocs::add($arFields);
        if ($id) {

            if ($this->arParams['DOC_TYPE'] == 'D') {
                $DOC_TYPE = 'D';
                $status = 'new';
            } else {
                $DOC_TYPE = 'A';
                $status = 'approved';
            }
            $ob = Cheshire\Sklad\StockDataTable::add([
                        'DOC_ID' => $id,
                        'STATUS' => $status,
                        'DOC_TYPE' => $DOC_TYPE,
                        'DATE_CREATE' => new \Bitrix\Main\Type\DateTime(),
            ]);
            if (!$ob->isSuccess()) {
                print_r($ob->getErrorMessages());
            }
        }
        if (is_array($products) && !empty($products) && $id) {
            $this->addProds($products, $id);
        }

        return $id;
    }

    private function getUsersArr($ids) {
        global $USER;
        $cache = new \CPHPCache();
        $cache_time = 3600 * 24; // кэш на сутки
        $cache_id = 'sklad_order_users' . http_build_query($ids) . $USER->getId(); // кэш для url
        $cache_path = '/sklad_order_users/';

        if (!$this->clear_cache) {
            if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path)) {
                $res = $cache->GetVars();
                if (is_array($res['users']) && (count($res['users']) > 0)) {
                    $response = $res['users'];
                }
            }
        }

        if (empty($response)) {

            $ob = Bitrix\Main\UserTable::getList([
                        'select' => ['NAME', 'ID', 'PERSONAL_PROFESSION'],
                        'filter' => ['ID' => $ids]
            ]);
            while ($arUser = $ob->fetch()) {
                $arUser['NAME'] = $arUser['NAME'] ? $arUser['NAME'] : 'noname';
                $response[$arUser['ID']] = $arUser;
            }


            if ($cache_time > 0) {
                $cache->StartDataCache($cache_time, $cache_id, $cache_path);
                $cache->EndDataCache(['users' => $response]);
            }
        }

        return $response;
    }

    private function getDocument($id) {
        $this->arParams['filter']['ID'] = $id;
        return $this->getDocuments();
    }

    private function getDocuments() {
        $arSelectFields = array(
            "ID",
            "DOC_TYPE",
            "STATUS",
            "DATE_DOCUMENT",
            "CREATED_BY",
            "DATE_CREATE",
            "MODIFIED_BY",
            "DATE_MODIFY",
            "CONTRACTOR_ID",
            "SITE_ID",
            "CURRENCY",
            "TOTAL",
            "COMMENTARY",
        );

        if ($this->arParams['filter']['STATUS']) {
            $filter = ['STATUS' => $this->arParams['filter']['STATUS']];
        }
        if ($this->arParams['filter']['DOC_TYPE']) {
            $filter['DOC_TYPE'] = $this->arParams['filter']['DOC_TYPE'];
        }
        if ($this->arParams['filter']['>=DATE_CREATE']) {
            $filter['>=DATE_CREATE'] = $this->arParams['filter']['>=DATE_CREATE'];
        }
        if ($this->arParams['filter']['>=DATE_CREATE']) {
            $filter['<DATE_CREATE'] = $this->arParams['filter']['<DATE_CREATE'];
        }
        if ($this->arParams['filter']['ID']) {
            $filter['DOC_ID'] = '%'.$this->arParams['filter']['ID'].'%';
        }

        $doc_datas = $this->getDocDatas($filter);
        if (!$doc_datas) {
            return[];
        }

        unset($this->arParams['filter']['STATUS']);
        if (!$this->arParams['filter']['ID'] || empty($this->arParams['filter']['ID'])) {
            return [];
        }


        $dbResultList = CCatalogDocs::getList(
                        array('ID' => 'DESC'), $this->arParams['filter'], false, ['nPageSize' => '12'], $arSelectFields
        );
        $dbResultList->NavStart(12);
        if (filter_input(INPUT_GET, 'PAGEN_1', FILTER_VALIDATE_INT) && $dbResultList->NavPageNomer < filter_input(INPUT_GET, 'PAGEN_1', FILTER_VALIDATE_INT)) {
            return [];
        };
        while ($arRes = $dbResultList->NavNext()) {

            $dbElement = CCatalogStoreDocsElement::getList(array(), array("DOC_ID" => $arRes['ID']), false, false, array("ID", "ELEMENT_ID", 'AMOUNT', 'PURCHASING_PRICE', 'STORE_TO'));
            while ($arElement = $dbElement->Fetch()) {
                $IDS[] = $arElement["ELEMENT_ID"];
                $arRes['PRODUCTS'][] = $arElement;
            }
            $date = new DateTime($arRes['DATE_DOCUMENT']);
            $arRes['DATE_DOCUMENT'] = $date->format('d.m.y');
            $arRes['STATUS'] = $doc_datas[$arRes['ID']]['STATUS'];
            $users[] = $arRes['CREATED_BY'];
            $arRes['DATA'] = $doc_datas[$arRes['ID']]['DATA'];
            $result['ITEMS'][] = $arRes;
        }

        $arUsers = $this->getUsersArr($users);
        if ($dbResultList->NavPageCount == $dbResultList->NavPageNomer) {
            $result['EndPage'] = true;
        }


        foreach ($result['ITEMS'] as $k => $item) {
            $item['USER'] = $arUsers[$item['CREATED_BY']];
            $result['ITEMS'][$k] = $item;
        }
        unset($item);

        if ($IDS) {

            global $APPLICATION;
            $prods = $APPLICATION->includeComponent('sklad:list', '', [
                'IBLOCK_ID' => STORE_IBLOCK_ID,
                'OFFERS_FILTER' => ['ID' => $IDS],
                'IBLOCK_OFFERS_ID' => STORE_OFFERS_IBLOCK_ID,
                'PRICE_CODE' => [0 => "BASE"],
                'NAV_PAGE_ELEMENT_COUNT' => 'all',
                'action' => 'GET',
                'OFFERS_FIELDS' => ['ID', 'IBLOCK_ID', 'NAME'],
                'ROUTE_ID' => 307,
                'OFFERS_PROPERTIES' => ['308', '309', '310'],
                'NOT_INCLUDE_TPL' => true
            ]);
            $result['PRODUCT_LIST'] = $prods;
        }

        return $result;
    }

    private function updateDocument($id, array $arFields) {
        if (!$id) {
            return false;
        }

        if ($products = $arFields['products']) {
            unset($arFields['products']);
        }

        if ($arFields['status'] == "history" || $arFields['status'] == "canceled") {
            if ($arFields['status'] == "history") {
                $this->conductDocument($id);
            }
            if ($this->arParams['DOC_TYPE'] == 'D') {
                $this->unReserve($id);
            }
        }

        $ob = Cheshire\Sklad\StockDataTable::getList([
                    'select' => ['ID', 'STATUS'],
                    'filter' => ['DOC_ID' => $id]
        ]);
        if ($res = $ob->fetch()) {
            if ($arFields['status']) {
                if ($this->arParams['DOC_TYPE'] == 'D' && $arFields['status'] == "approved" && strtolower($arFields['status']) != strtolower($res['STATUS'])) {
                    $this->reserve($id);
                }
                $arr['STATUS'] = $arFields['status'];
            }

            if ($arr) {
                $ob = Cheshire\Sklad\StockDataTable::update($res['ID'], $arr);
                if(!$ob->isSuccess()) {
                    print_r($ob->getErrorMessages());
                    return false;
                }
            }
        }

        if(!CCatalogDocs::update($id, $arFields)) {
            echo (__LINE__);
            return false;
        }

        if (is_array($products) && $id) {
            if ($this->arParams['DOC_TYPE'] == 'D') {
                $this->updReserve($id, $products);
            }
            $dbElement = CCatalogStoreDocsElement::getList(array(), array("DOC_ID" => $id), false, false, array("ID"));
            while ($arElement = $dbElement->Fetch()) {
                CCatalogStoreDocsElement::delete($arElement["ID"]);
                $dbDocsBarcode = CCatalogStoreDocsBarcode::getList(array(), array("DOC_ELEMENT_ID" => $arElement["ID"]), false, false, array("ID")); // удаляем старые штрихкоды
                while ($arDocsBarcode = $dbDocsBarcode->Fetch()) {
                    CCatalogStoreDocsBarcode::delete($arDocsBarcode["ID"]);
                }
            }
            $this->addProds($products, $id);
        }

        return true;
    }

    private function updReserve($id, $products) {
        $ob = Cheshire\Sklad\StockDataTable::getList([
                    'select' => ['STATUS'],
                    'filter' => ['DOC_ID' => $id]
        ]);
        if ($res = $ob->fetch()) {

            if (strtolower($res['STATUS']) == 'new') {
                return [];
            }
        }
        $dbElement = CCatalogStoreDocsElement::getList(array(), array("DOC_ID" => $id), false, false, array("ID", "AMOUNT", "ELEMENT_ID"));
        while ($arElement = $dbElement->Fetch()) {
            foreach ($products as $product) {
                if ($product['id'] == $arElement['ELEMENT_ID']) {
                    $raznica = $product['quantity'] - $arElement['AMOUNT'];
                    if ($raznica) {
                        if ($ar_res = CCatalogProduct::GetByID($product['id'])) {
                            $QUANTITY_RESERVED = intval($ar_res['QUANTITY_RESERVED']) + $raznica;
                        }
                        $arFields = array('QUANTITY_RESERVED' => $QUANTITY_RESERVED);
                        CCatalogProduct::Update($product['id'], $arFields);
                    }
                }
            }
        }
    }

    public function deleteDocument($ID) {
        global $DB;

        $DB->StartTransaction();
        $result = CCatalogDocs::delete($ID);
        if ($result) {
            $DB->Commit();
            $ob = Cheshire\Sklad\StockDataTable::getList([
                        'select' => ['ID'],
                        'filter' => ['DOC_ID' => $ID]
            ]);
            if ($res = $ob->fetch()) {
                Cheshire\Sklad\StockDataTable::delete($res['ID']);
            }
        } else {
            $DB->Rollback();
        }
        return $result;
    }

    public function cancellationDocument($ID, $userId = 0) {
        global $DB;
        global $USER;
        if (!$userId) {
            $userId = $USER->getId();
        }
        $DB->StartTransaction();
        $result = CCatalogDocs::cancellationDocument($ID, $userId);
        if ($result) {
            $DB->Commit();
            $ob = Cheshire\Sklad\StockDataTable::getList([
                        'select' => ['ID'],
                        'filter' => ['DOC_ID' => $ID]
            ]);
            if ($res = $ob->fetch()) {
                Cheshire\Sklad\StockDataTable::update($res['ID'], [
                    'STATUS' => 'canceled'
                ]);
            }
        } else {
            $DB->Rollback();
        }
        return $result;
    }

    public function conductDocument($ID, $userId = 0) {
        global $DB;
        global $USER;
        if (!$userId) {
            $userId = $USER->getId();
        }
        $DB->StartTransaction();
        $result = CCatalogDocs::conductDocument($ID, $userId);
        if ($result) {
            $DB->Commit();
            $ob = Cheshire\Sklad\StockDataTable::getList([
                        'select' => ['ID'],
                        'filter' => ['DOC_ID' => $ID]
            ]);
            if ($res = $ob->fetch()) {
                Cheshire\Sklad\StockDataTable::update($res['ID'], [
                    'STATUS' => 'history'
                ]);
            }
        } else {
            $DB->Rollback();
        }


        return $result;
    }

    public function prepareParams($requestData) {
        if (!$this->arParams['filter']) {
            $this->arParams['filter'] = [];
        }


        if ($requestData['filter']) {
            $filterArr = $requestData['filter'];
            if ($filterArr['id']) {
                $this->arParams['filter']['ID'] = $filterArr['id'];
            } else if ($filterArr['date'][0] && $filterArr['date'][1]) {
                if ($filterArr['date'][0] == $filterArr['date'][1]) {
                    $data = new Bitrix\Main\Type\Date($filterArr['date'][0], 'd.m.y');
                    $data2 = new Bitrix\Main\Type\Date($filterArr['date'][0], 'd.m.y');
                    $data2->add('1D');
                } else {
                    $dataF = new Bitrix\Main\Type\Date($filterArr['date'][0], 'd.m.y');
                    $dataS = new Bitrix\Main\Type\Date($filterArr['date'][1], 'd.m.y');
                    $dataS->add('1D');
                    if ($dataF->getTimestamp() > $dataS->getTimestamp()) {
                        $data = $dataS;
                        $data2 = $dataF;
                    } else {
                        $data = $dataF;
                        $data2 = $dataS;
                    }
                }

                $prop = 'DATE_CREATE';

                $this->arParams['filter'] = ['>=' . $prop => $data, '<' . $prop => $data2];
            }
            if ($filterArr['status'] && is_array($filterArr['status'])) {
                foreach ($filterArr['status'] as $k => $status) {
                    $this->arParams['filter']['STATUS'][] = $status;
                }
            }

            
        }
        global $USER;
        $this->RIGHTS = Cheshire\Sklad\SkladUserRoles::getRights('sklad:documents', $USER);
        if (!$this->RIGHTS['WATCH_ALL']) {
            $this->arParams['filter']['CREATED_BY'] = $USER->getId();
        }
        if ($filterArr['managers']) {
            $this->arParams['filter']['CREATED_BY'] = $filterArr['managers'];
        }
        if (!$this->arParams['filter']['DOC_TYPE']) {
            $this->arParams['filter']['DOC_TYPE'] = $this->arParams['DOC_TYPE'] ? $this->arParams['DOC_TYPE'] : 'A';
        }
        
    }

    private function getCounts() {

        $filter = [ 'STATUS' => 'approved',
            'DOC_TYPE' => ['A', 'D']
        ];
        $ob = \Cheshire\Sklad\StockDataTable::getList([
                    'select' => ['ID', 'DOC_ID', 'DOC_TYPE'],
                    'filter' => $filter
        ]);
        
        while ($res = $ob->fetch()) {
            if (!in_array($res['DOC_ID'], $this->arParams['filter']['ID'])) {
                $this->arParams['filter']['ID'][] = $res['DOC_ID'];
            }
        }
        
        
        
        $result['A'] = $result['D'] = 0;
        
        if(!$this->arParams['filter']['ID']) {
            return ['orders' => $result['D'], 'ships' => $result['A']];
        }
        
        $dbResultList = CCatalogDocs::getList(
                        array('ID' => 'DESC'), $this->arParams['filter'], false, false, ['DOC_TYPE']
        );
        while ($arRes = $dbResultList->fetch()) {
            $result[$arRes['DOC_TYPE']]++;
        }

        return ['orders' => $result['D'], 'ships' => $result['A']];
    }

    private function checkRights() {
        global $USER;
        $this->arParams['DOC_TYPE'] = $this->arParams['DOC_TYPE'] ? $this->arParams['DOC_TYPE'] : 'A';
        $this->RIGHTS = Cheshire\Sklad\SkladUserRoles::getRights('sklad:documents', $USER);

        if (!$this->RIGHTS['WATCH_ALL'][$this->arParams['DOC_TYPE']]) {
            $this->arParams['filter']['CREATED_BY'] = $USER->getId();
        }

        switch ($this->arParams['action']) {
            case 'POST' :
                if (!$this->RIGHTS['ADD'][$this->arParams['DOC_TYPE']]) {
                    return false;
                }
                break;
            case 'GET' :
                if (!$this->RIGHTS['READ'][$this->arParams['DOC_TYPE']]) {
                    return false;
                }
                break;
            case 'PUT' :
                if (!$this->RIGHTS['UPDATE'][$this->arParams['DOC_TYPE']]) {
                    return false;
                }
                break;
            case 'DELETE' :
                if (!$this->RIGHTS['DELETE'][$this->arParams['DOC_TYPE']]) {
                    return false;
                }
                break;
        }
        return true;
    }

    public function executeComponent() {
        \Bitrix\Main\Loader::includeModule('catalog');
        \Bitrix\Main\Loader::includeModule('cheshire.sklad');
        if (!$this->checkRights()) {
            print_r( $this->RIGHTS);
            return;
        }
        if ($this->arParams['getCount']) {
            echo json_encode($this->getCounts());
            return;
        }


        switch ($this->arParams['action']) {
            case 'POST' :
                $requestData = json_decode(file_get_contents('php://input'), true);
                $this->prepareParams($requestData);

                $this->arResult = $this->addDocument($this->makeArFields($requestData));
                break;
            case 'GET' :
                $requestData = \Bitrix\Main\Application::getInstance()->getContext()->getRequest()->getQueryList()->toArray();
                $this->prepareParams($requestData);
                $this->arResult = $this->getDocuments();
                break;
            case 'PUT' :
                $requestData = json_decode(file_get_contents('php://input'), true);
                $this->prepareParams($requestData);

                $this->updateDocument($requestData['id'], $this->makeArFields($requestData));
                $this->arResult = $this->arResult = $this->getDocument($requestData['id']);
                break;
            case 'DELETE' :
                $requestData = json_decode(file_get_contents('php://input'), true);
                $this->prepareParams($requestData);
                $this->arResult = $this->deleteDocument($requestData['id']);
                break;
        }

        $this->includeComponentTemplate();
    }

}
