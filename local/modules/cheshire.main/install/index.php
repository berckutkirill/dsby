<?php

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Entity\Base;

Loc::loadMessages(__FILE__);

class cheshire_main extends CModule {

    var $exclusionAdminFiles;

    function __construct() {
        $arModuleVersion = [];
        include(__DIR__ . "/version.php");

        $this->exclusionAdminFiles = [
            '..',
            '.',
            'menu.php'
        ];

        $this->MODULE_ID = "cheshire.main";

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = Loc::getMessage("CHESHIRE_MAIN_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("CHESHIRE_MAIN_MODULE_DESC");

        $this->PARTNER_NAME = Loc::getMessage("CHESHIRE_MAIN_PARTNER_NAME");
        $this->PARTNER_URI = Loc::getMessage("CHESHIRE_MAIN_PARTNER_URI");
    }

    function InstallDB() {
        Loader::includeModule($this->MODULE_ID);

        if (!Application::getConnection(\Cheshire\Main\FilterTable::getConnectionName())->isTableExists(
                        Base::getInstance('\Cheshire\Main\FilterTable')->getDBTableName()
                )
        ) {
            Base::getInstance('\Cheshire\Main\FilterTable')->createDbTable();
        }
    }

    function UnInstallDB() {
        if (!Loader::includeModule($this->MODULE_ID)) {
            throw new Exception("Moule not found");
        }
        if (Application::getConnection(\Cheshire\Main\FilterTable::getConnectionName())->isTableExists(
                        Base::getInstance('\Cheshire\Main\FilterTable')->getDBTableName()
                )
        ) {
            Application::getConnection(\Cheshire\Main\FilterTable::getConnectionName())->
                    queryExecute('drop table if exists ' . Base::getInstance('\Cheshire\Main\FilterTable')->getDBTableName());
        }
    }

    public function GetPath($notDocumentRoot = false) {
        if ($notDocumentRoot) {
            return str_ireplace(Application::getDocumentRoot(), '', dirname(__DIR__));
        } else {
            return dirname(__DIR__);
        }
    }

    public function isVersionD7() {
        return CheckVersion(\Bitrix\Main\ModuleManager::getVersion('main'), '14.00.00');
    }

    function InstallFiles($arParams = []) {

        if (\Bitrix\Main\IO\Directory::isDirectoryExists($path = $this->GetPath() . '/admin')) {
            CopyDirFiles($this->GetPath() . "/install/admin/", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin");
            if ($dir = opendir($path)) {
                while (false !== $item = readdir($dir)) {
                    if (in_array($item, $this->exclusionAdminFiles))
                        continue;
                    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/' . $this->MODULE_ID . '_' . $item, '<' . '? require($_SERVER["DOCUMENT_ROOT"]."' . $this->GetPath(true) . '/admin/' . $item . '");?' . '>');
                }
                closedir($dir);
            }
        }

        return true;
    }

    function UnInstallFiles() {

        if (\Bitrix\Main\IO\Directory::isDirectoryExists($path = $this->GetPath() . '/admin')) {
            DeleteDirFiles($this->GetPath() . '/install/admin/', $_SERVER["DOCUMENT_ROOT"] . '/bitrix/admin');
            if ($dir = opendir($path)) {
                while (false !== $item = readdir($dir)) {
                    if (in_array($item, $this->exclusionAdminFiles))
                        continue;
                    \Bitrix\Main\IO\File::deleteFile($_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/' . $this->MODULE_ID . '_' . $item);
                }
                closedir($dir);
            }
        }
        return true;
    }

    function InstallEvents() {
        $OnProlog = false;
        $events = \Bitrix\Main\EventManager::getInstance()->findEventHandlers("main", "OnProlog", ['TO_MODULE_ID' =>'cheshire.main']);
        foreach(!$events as $event) {
            if($event['TO_NAME'] === '\Cheshire\Main\Event::eventHandler (cheshire.main)') {
                $OnProlog = true;
                break;
            }
        }
        if(!$OnProlog) {
            \Bitrix\Main\EventManager::getInstance()->registerEventHandler("main", "OnProlog", $this->MODULE_ID, '\Cheshire\Main\Event', 'eventBeforeHandler');
        }
        
        
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler("main", "OnEpilog", $this->MODULE_ID, '\Cheshire\Main\Event', 'eventHandler');
    }

    function UnInstallEvents() {
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler("main", "OnEpilog", $this->MODULE_ID, '\Cheshire\Main\Event', 'eventHandler');
    }

    function DoInstall() {
        global $APPLICATION;

        if ($this->isVersionD7()) {
            if(!\Bitrix\Main\ModuleManager::isModuleInstalled($this->MODULE_ID)) {
                \Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);
            }
            $this->InstallDB();
            $this->InstallFiles();
        } else {
            $APPLICATION->ThrowException(Loc::getMessage("CHESHIRE_MAIN_INSTALL_ERROR_VERSION"));
        }
        $this->InstallEvents();
        $APPLICATION->IncludeAdminFile(Loc::getMessage("CHESHIRE_MAIN_INSTALL_TITLE"), $this->GetPath() . "/install/step.php");
    }

    function DoUninstall() {
        $this->UnInstallDB();
        $this->UnInstallFiles();
        $this->UnInstallEvents();
        
        //\Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);
    }

}
