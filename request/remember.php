<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
if(!empty($_POST["repair_email"]))
{
	if(!CModule::IncludeModule("iblock")) return;
$email = $_POST['repair_email'];
$arFilter = array("EMAIL" => $email);
$rsUsers = CUser::GetList($by = 'ID', $order = 'ASC', $arFilter);
$arUser = $rsUsers->Fetch();


	if(!empty($arUser)) {
			$el = new CIBlockElement;
			$arLoadProductArray = Array(
			  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
			  "IBLOCK_ID"      => 15,
			  "NAME"           => $email,
			  "ACTIVE"         => "N"
			  );

			$PRODUCT_ID = $el->Add($arLoadProductArray);

				$arEventFields = array(
										"EMAIL"=>$email
									);
				CEvent::Send("REMEMBER", "s1", $arEventFields);
		echo "True";
	} else {
		echo "not_found";
	}
 } else {
	echo "False";
} ?>