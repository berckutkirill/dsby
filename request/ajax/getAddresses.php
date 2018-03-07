<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$cities = GetHBlock(17, ["UF_ACTIVE" => "1"], ['ID' => 'ASC'],["ID","UF_ACTIVE","UF_CORPUS","UF_HOME_NUMBER","UF_NAME","UF_PLACE","UF_STREET", "UF_REGION", "UF_COORDS","UF_COUNTRY"]);
foreach($cities as &$city) {
	if($city['UF_COORDS']) {
		$city['UF_COORDS'] = explode(',',$city['UF_COORDS']);
	}
}
echo json_encode($cities);