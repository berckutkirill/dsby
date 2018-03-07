<?php

use Cheshire\Sklad\SkladUserRoles;
use Bitrix\Main\Loader;

class SkladUserComponent extends CBitrixComponent {

    private function update($post) {
        global $USER;
        if (!$USER->IsAuthorized()) {
            return;
        }

        $arFields = [
            'PERSONAL_PROFESSION' => $post['name'],
            'PERSONAL_CITY' => $post['city'],
            'PERSONAL_ZIP' => $post['index'],
            'WORK_STREET' => $post['address'],
            'PERSONAL_STREET' => $post['ur_address'],
            'PERSONAL_NOTES' => $post['fio'],
            'PERSONAL_PHONE' => $post['phone'],
            'EMAIL' => $post['email'],
        ];
        $user = new CUser;
        $user->Update($USER->getId(), $arFields);
        \Bitrix\Main\IO\Directory::deleteDirectory($_SERVER['DOCUMENT_ROOT'] . '/bitrix/cache/sklad_user/');
        return true;
    }

    private function getUser() {

        global $USER;
        if (!$USER->IsAuthorized()) {
            return;
        }
        $cache = new \CPHPCache();
        $cache_time = 3600 * 24; // кэш на сутки
        $cache_id = 'sklad_user' . $USER->getId(); // кэш для user
        $cache_path = '/sklad_user/';

        if (!$this->clear_cache) {
            if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path)) {
                $res = $cache->GetVars();
                if (is_array($res['user']) && (count($res['user']) > 0)) {
                    $response = $res['user'];
                }
            }
        }

        if (empty($response)) {


            $ob = Bitrix\Main\UserTable::getList([
                        'select' => [
                            'ID',
                            'EMAIL',
                            'NAME',
                            'PERSONAL_NOTES',
                            'PERSONAL_PROFESSION',
                            'PERSONAL_CITY',
                            'PERSONAL_STREET',
                            'PERSONAL_ZIP',
                            'WORK_STREET',
                            'PERSONAL_PHONE'
                        ],
                        'filter' => ['ID' => $USER->getId()]
            ]);
            if ($arUser = $ob->fetch()) {
                $arUser['NAME'] = $arUser['NAME'] ? $arUser['NAME'] : 'noname';
                $arUser['ROLE'] = SkladUserRoles::getRole($USER->getId());


                $response = $arUser;
            }


            if ($cache_time > 0) {
                $cache->StartDataCache($cache_time, $cache_id, $cache_path);
                $cache->EndDataCache(['user' => $response]);
            }
        }

        return $response;
    }

    public function executeComponent() {
        if (!Loader::includeModule('cheshire.sklad')) {
            throw new Exception("Moule not found");
        }
        global $USER;
        if (!$USER->isAuthorized()) {
            return;
        }
        $action = $this->arParams['action'];
        $result = [];

        if (!$action || $action == 'GET') {
            $this->arResult = $this->getUser();
            $this->includeComponentTemplate();
        } elseif ($action == 'PUT') {
            $result = $this->update(json_decode(file_get_contents("php://input"), true));
        }
    }

}
