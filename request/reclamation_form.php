<?

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
$files = $_FILES;
$post = $_POST;
if (!empty($files)) {
    if (!empty($files["door_photo"]["name"]) || !empty($files["defect_photo"]["name"])) {
        $name_photo = $files["door_photo"]["name"] ? $files["door_photo"]["name"] : $files["defect_photo"]["name"];
        $name = date("Y-m-d H:i:s") . "-" . $name_photo;
        $load_p = $files["door_photo"]["tmp_name"] ? $files["door_photo"]["tmp_name"] : $files["defect_photo"]["tmp_name"];
        $upload_p = $_SERVER['DOCUMENT_ROOT'] . '/upload/reclamation/' . $name;

        if (copy($load_p, $upload_p)) {
            echo '/upload/reclamation/' . $name;
        } else {
            echo "не удалось";
        }
    }
}

if ($post["my_address"] || $post["login"]) {
    return;
}
if (CModule::IncludeModule("iblock")) {
    if (!empty($post)) {
        $el = new CIBlockElement;

        $id_rec = unserialize(file_get_contents('id_reclamation.txt'));

        if (empty($id_rec)) {
            $id = 1;
        } else {
            $id = intVal($id_rec);
            $id++;
        }
        $PROP = array();
        $PROP[396] = $post["client_tel"];
        $PROP[397] = $post["client_name"];
        $PROP[398] = $post["agreement_n"];
        $PROP[399] = $post["client_address"];
        $PROP[400] = $post["defect_name"];
        $PROP[401] = CFile::MakeFileArray($_SERVER['DOCUMENT_ROOT'] . $post["door_photo_way"]);
        $PROP[402] = CFile::MakeFileArray($_SERVER['DOCUMENT_ROOT'] . $post["defect_photo_way"]);
        $PROP[403] = $id;

        $arLoadProductArray = Array(
            "MODIFIED_BY" => $USER->GetID(),
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID" => 25,
            "PROPERTY_VALUES" => $PROP,
            "NAME" => "Заявка на гарантийное обслуживание",
            "ACTIVE" => "Y",
            "NAME" => "Заявка на гарантийное обслуживание №" . $id
        );
        if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
            echo "New ID: " . $PRODUCT_ID;
            $arEventFields = array(
                "NUMBER" => $id,
                "NAME" => $post["client_name"],
                "PHONE" => $post["client_tel"],
                "NUMBER_CONTRACT" => $post["agreement_n"],
                "ADDRESS" => $post["client_address"],
                "PHOTO_DOORS" => $post["door_photo_way"],
                "PHOTO_DEFECT" => $post["defect_photo_way"],
                "DESCRIPTION_DEFECT" => $post["defect_name"]
            );
            CEvent::Send("RECLAMATION", SITE_ID, $arEventFields);
        } else {
            echo "Error: " . $el->LAST_ERROR;
        }
        $fp = fopen("id_reclamation.txt", "w");
        fwrite($fp, serialize($id));
        fclose($fp);
    }
}
