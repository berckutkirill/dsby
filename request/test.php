<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

/*
print_r($_POST);
print_r($_FILES);
print_r($_GET);
print_r($_REQUEST);
*/

$files = $_FILES;

if (!empty($files)) {
    if (!empty($files["doc"]["name"])) {
        $name_photo = $files["doc"]["name"];
        $name = date("Y-m-d H:i:s") . "-" . $name_photo;
        $load_p = $files["doc"]["tmp_name"];
        $upload_p = $_SERVER['DOCUMENT_ROOT'] . '/upload/reclamation/' . $name;

        if (copy($load_p, $upload_p)) {
            echo '/upload/reclamation/' . $name;
        } else {
            echo "не удалось";
        }
    }
}