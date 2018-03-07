<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<?

if ($_POST["my_address"] || $_POST["login"]) {
    return;
}


if (!empty($_POST["phone"])) {
    if (!CModule::IncludeModule("iblock"))
        return;
    $element_id = intVal($_POST["element"]);

    if ($element_id) {

        $res = CIBlockElement::GetByID($element_id);
        if ($ar_res = $res->GetNext())
            $el_name = $ar_res['NAME'];
    }


    $what = htmlspecialcharsex($_POST['what']);
    $name = htmlspecialcharsex($_POST['name']);
    $phone = htmlspecialcharsex($_POST['phone']);
    $email = htmlspecialcharsex($_POST['email']);
    $adress = htmlspecialcharsex($_POST['adress']);
    $mess = htmlspecialcharsex($_POST['comment']);
    $mess = $mess ? $mess : $adress;
    $date = htmlspecialcharsex($_POST['date']);


    $el = new CIBlockElement;

    $PROP = array();
    $PROP[139] = $date;
    $PROP[140] = $phone;
    $PROP[141] = $email;
    $arLoadProductArray = Array(
        "IBLOCK_SECTION_ID" => false,
        "IBLOCK_ID" => 12,
        "PROPERTY_VALUES" => $PROP,
        "NAME" => $name,
        "ACTIVE" => "N",
        "PREVIEW_TEXT" => $mess,
    );

    $PRODUCT_ID = $el->Add($arLoadProductArray);

    $arEventFields = array(
        "NAME" => $name,
        "EMAIL" => $email,
        "DATE" => $date,
        "MESSAGE" => $mess,
        "PHONE" => $phone,
        "ELEMENT_NAME" => $el_name,
        "SALE_EMAIL" => $SALE_EMAIL,
        "SALON_NAME" => $SETTINGS["SALON_NAME"],
    );


    if ($what != "Sever") {
        CEvent::Send("ZAMER", "s1", $arEventFields);
    } else {
        CEvent::Send("ZAMER_SEVER", "s1", $arEventFields);
    }

    LocalRedirect("/thank/");
} else {
    LocalRedirect("/");
}
?>