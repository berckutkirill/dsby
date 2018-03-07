<?

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$files = $_FILES;
$post = $_POST;

if (!empty($files)) {
    if (!empty($files["door_photo"]["name"])) {
        $name_photo = $files["door_photo"]["name"];
        $name = date("Y-m-d H:i:s") . "-" . $name_photo;
        $load_p = $files["door_photo"]["tmp_name"];
        $upload_p = $_SERVER['DOCUMENT_ROOT'] . '/upload/otzyvy/' . $name;

        if (copy($load_p, $upload_p)) {
            echo '/upload/otzyvy/' . $name;
        } else {
            echo "не удалось";
        }
    }
    if (!empty($files["facade_photo"]["name"])) {
        $name_photo = $files["facade_photo"]["name"];
        $name = date("Y-m-d H:i:s") . "-" . $name_photo;
        $load_p = $files["facade_photo"]["tmp_name"];
        $upload_p = $_SERVER['DOCUMENT_ROOT'] . '/upload/facade/' . $name;

        if (copy($load_p, $upload_p)) {
            echo '/upload/facade/' . $name;
        } else {
            echo "не удалось";
        }
    }
}

if ($post["my_address"] || $post["login"]) {
    return;
}

$manager = ["bad" => 1569, "normal" => 1570, "good" => 1571, "excellent" => 1572];
$delivery = ["bad" => 1573, "normal" => 1574, "good" => 1575, "excellent" => 1576];
$door = ["bad" => 1577, "normal" => 1578, "good" => 1579, "excellent" => 1580];
$rus_manager = ["bad" => "плохо", "normal" => "нормально", "good" => "здорово", "excellent" => "лучше всех"];
$rus_delivery = ["bad" => "медленно", "normal" => "нормально", "good" => "быстро", "excellent" => "очень быстро"];
$rus_door = ["bad" => "плохо", "normal" => "нормально", "good" => "достойно", "excellent" => "отлично"];

if (CModule::IncludeModule("iblock")) {
    if (!empty($post)) {
        $el = new CIBlockElement;

        $id_review = unserialize(file_get_contents('id_review.txt'));

        if (empty($id_review)) {
            $id = 1;
        } else {
            $id = intVal($id_review);
            $id++;
        }

        $PROP = array();
        $PROP[405] = htmlspecialcharsEx($post["happy_client_name"]);
        $PROP[406] = htmlspecialcharsEx($post["happy_client_tel"]);
        $PROP[407] = htmlspecialcharsEx($post["client_address"]);
        $PROP[408] = CFile::MakeFileArray($_SERVER['DOCUMENT_ROOT'] . $post["door_photo_way"]);
        $PROP[409] = $manager[$post["manager_rating"]];
        $PROP[410] = $delivery[$post["delivery_rating"]];
        $PROP[411] = $door[$post["door_quality_rating"]];
        $PROP[412] = htmlspecialcharsEx($post["happy_client_description"]);
        $PROP[413] = $id;

        $arLoadProductArray = Array(
            "MODIFIED_BY" => $USER->GetID(),
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID" => 26,
            "PROPERTY_VALUES" => $PROP,
            "ACTIVE" => "N",
            "NAME" => "Отзыв о сервисе и двери №" . $id
        );
        if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
            $arEventFields = array(
                "NUMBER" => $id,
                "NAME" => htmlspecialcharsex($post["happy_client_name"]),
                "PHONE" => htmlspecialcharsex($post["happy_client_tel"]),
                "ADRESS" => htmlspecialcharsex($post["client_address"]),
                "DOOR_PHOTO" => $post["door_photo_way"],
                "MANAGER" => $rus_manager[$post["manager_rating"]],
                "DELEVIRY" => $rus_delivery[$post["delivery_rating"]],
                "DOOR" => $rus_door[$post["door_quality_rating"]],
                "DESCRIPTION" => htmlspecialcharsex($post["happy_client_description"])
            );
            CEvent::Send("HAPPY_CLIENT", SITE_ID, $arEventFields);
        } else {
            echo "Error: " . $el->LAST_ERROR;
        }
        $fp = fopen("id_review.txt", "w");
        fwrite($fp, serialize($id));
        fclose($fp);
    }
}




    