<? require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php"); ?>
<?

//print_r($_POST);
//die();
if ($_POST["my_address"] || $_POST["login"]) {
    return;
}

if (!empty($_POST["zamer_from_news"])) {
    $title = "Замер на субботу 22 апреля.";
} elseif (!empty($_POST["zamer_from_zamer"])) {
    $title = "Заявка на замер со страницы Замер";
} elseif (!empty($_POST["title_form"])) {
    $title = "Заявка на звонок со страницы ";
    if (!empty($_POST["title_page"]) && $_POST["title_page"] == "dobory") {
        $title .= "Доборы";
    }
    if (!empty($_POST["title_page"]) && $_POST["title_page"] == "zamki") {
        $title .= "Замки";
    }
    if (!empty($_POST["title_page"]) && $_POST["title_page"] == "safery") {
        $title .= "Безопасность";
    }
    if (!empty($_POST["title_page"]) && $_POST["title_page"] == "gallery") {
        $title .= "Двери под заказ";
    }
    if (!empty($_POST["title_page"]) && $_POST["title_page"] == "omega") {
        $title .= "Омега (MUL-T-LOCK OMEGA PLUS)";
    }
     if (!empty($_POST["title_page"]) && $_POST["title_page"] == "entr") {
        $title .= "Система управления доступом ENTR";
    }
} elseif (!empty($_POST["name_door"])) {
    $title = "Заявка на замер с детальной карточки " . $_POST["name_door"];
} else {
    $title = "Заявка на замер со страницы Доставка и установка";
}


if (!empty($_POST["phone"])) {
    $name = htmlspecialcharsex($_POST['name']);
    $phone = htmlspecialcharsex($_POST['phone']);
    $mess = htmlspecialcharsex($_POST['message']);
    $photo = $_POST["facade_photo_way"];
    if (CModule::IncludeModule("iblock")) {
        $el = new CIBlockElement;
        $PROP = array();
        $PROP[415] = $name;
        $PROP[416] = $phone;
        $PROP[417] = $mess;
        $PROP[433] = CFile::MakeFileArray($_SERVER['DOCUMENT_ROOT'] . $photo);

        $arLoadProductArray = Array(
            "MODIFIED_BY" => $USER->GetID(),
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID" => 27,
            "PROPERTY_VALUES" => $PROP,
            "NAME" => $title,
            "ACTIVE" => "Y"
        );
        if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
            $arEventFields = array(
                "NAME" => $name,
                "PHONE" => $phone,
                "MESSAGE" => $mess,
                "TITLE" => $title,
                "PHOTO" => $photo
            );
            CEvent::Send("ZAMER_FULL", "s1", $arEventFields);
            header("/thank/");
        }
    }
}
?>


