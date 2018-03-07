<?php

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Entity\Base;

Loc::loadMessages(__FILE__);

class cheshire_sklad extends CModule {

    public $exclusionAdminFiles;

    function __construct() {
        $arModuleVersion = [];
        include(__DIR__ . "/version.php");

        $this->exclusionAdminFiles = [
            '..',
            '.',
            'menu.php'
        ];

        $this->MODULE_ID = "cheshire.sklad";

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = Loc::getMessage("CHESHIRE_SKLAD_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("CHESHIRE_SKLAD_MODULE_DESC");

        $this->PARTNER_NAME = Loc::getMessage("CHESHIRE_SKLAD_PARTNER_NAME");
        $this->PARTNER_URI = Loc::getMessage("CHESHIRE_SKLAD_PARTNER_URI");
    }

    function InstallDB() {
        if (!Loader::includeModule($this->MODULE_ID)) {
            throw new Exception("Moule not found");
        }

        if (!Application::getConnection(\Cheshire\Sklad\StockDataTable::getConnectionName())->isTableExists(
                        Base::getInstance('\Cheshire\Sklad\StockDataTable')->getDBTableName()
                )
        ) {
            Base::getInstance('\Cheshire\Sklad\StockDataTable')->createDbTable();
        }

        if (!Application::getConnection(\Cheshire\Sklad\StockDataParamsTable::getConnectionName())->isTableExists(
                        Base::getInstance('\Cheshire\Sklad\StockDataParamsTable')->getDBTableName()
                )
        ) {
            Base::getInstance('\Cheshire\Sklad\StockDataParamsTable')->createDbTable();

            global $DB;

            $strSql = 'ALTER TABLE  `stock_data_params` MODIFY  `COMMENT` VARCHAR( 255 ) NULL';
            $DB->Query($strSql, false, __LINE__);
        }
    }

    function UnInstallDB() {
        if (!Loader::includeModule($this->MODULE_ID)) {
            throw new Exception("Moule not found");
        }

        if (Application::getConnection(\Cheshire\Sklad\StockDataTable::getConnectionName())->isTableExists(
                        Base::getInstance('\Cheshire\Sklad\StockDataTable')->getDBTableName()
                )
        ) {
            Application::getConnection(\Cheshire\Sklad\StockDataTable::getConnectionName())->
                    queryExecute('drop table if exists ' . Base::getInstance('\Cheshire\Sklad\StockDataTable')->getDBTableName());
        }

        if (Application::getConnection(\Cheshire\Sklad\StockDataParamsTable::getConnectionName())->isTableExists(
                        Base::getInstance('\Cheshire\Sklad\StockDataParamsTable')->getDBTableName()
                )
        ) {
            Application::getConnection(\Cheshire\Sklad\StockDataParamsTable::getConnectionName())->
                    queryExecute('drop table if exists ' . Base::getInstance('\Cheshire\Sklad\StockDataParamsTable')->getDBTableName());
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

        copyDirFiles(
                $this->GetPath() . '/install/themes', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/themes', true, true
        );

        if (\Bitrix\Main\IO\Directory::isDirectoryExists($path = $this->GetPath() . '/admin')) {
            // $path = {document_root}/local/modules/cheshire.sklad/admin
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

        DeleteDirFiles($this->GetPath() . '/install/themes/', $_SERVER["DOCUMENT_ROOT"] . '/bitrix/themes');

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

    function DoInstall() {
        global $APPLICATION;
        if ($this->isVersionD7()) {
            \Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);
            $this->InstallDB();
            $this->InstallFiles();
        } else {
            $APPLICATION->ThrowException(Loc::getMessage("CHESHIRE_SKLAD_INSTALL_ERROR_VERSION"));
        }

        $APPLICATION->IncludeAdminFile(Loc::getMessage("CHESHIRE_SKLAD_INSTALL_TITLE"), $this->GetPath() . "/install/step.php");
    }

    function DoUninstall() {

        $this->UnInstallDB();

        $this->UnInstallFiles();

        \Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);
    }

}
