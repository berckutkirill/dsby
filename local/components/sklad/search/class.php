<?php

class SkladSearchComponent extends CBitrixComponent {
    
    public function executeComponent() {
        Bitrix\Main\Loader::includeModule('search');
        
        $q = filter_input(INPUT_GET, 'q');
        if(!$q) {
            return false;
        }
        $module_id = 'iblock';
        $obSearch = new CSearch;
        $obSearch->Search([
            'QUERY' => $q,
            'MODULE_ID' => $module_id,
            'PARAM1' => $this->arParams['IBLOCK_TYPE'],
            'PARAM2' => $this->arParams['IBLOCK_FOR_SEARCH']
        ]);
        
        
        
        if ($obSearch->errorno != 0):
           $this->arResult = $obSearch->error;
        else:
            while ($arResult = $obSearch->GetNext()) {
                $this->arResult[] = $arResult;
            }
        endif;
        
        $this->includeComponentTemplate();
    }

}

