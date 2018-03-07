<?php
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$aMenu[] = array(
   "parent_menu" => "global_menu_settings",
   "sort" => 1800,
   "text" => Loc::getMessage("CHESHIRE_SKLAD_MENU_NAME"),
   "title" => Loc::getMessage("CHESHIRE_SKLAD_MENU_TITLE"),
   "url" => "cheshire.sklad_orders.php?lang=".LANGUAGE_ID,
   "icon" => "util_menu_icon cheshire_icon",
   "page_icon" => "util_page_icon cheshire_icon",
   "items_id" => "menu_cheshire_sklad",
);
return $aMenu;
