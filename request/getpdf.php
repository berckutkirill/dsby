<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
if(!empty($_POST["name"]) && !empty($_POST["phone"]))
{
	if(!CModule::IncludeModule("iblock")) return;

	$name = htmlspecialcharsex($_POST['name']);
	$email = htmlspecialcharsex($_POST['email']);


			$el = new CIBlockElement;

			$arLoadProductArray = Array(
			  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
			  "IBLOCK_ID"      => 10,
			  "NAME"           => $name,
			  "ACTIVE"         => "N",
			  "PREVIEW_TEXT"   => $email,
			  );
	
			$PRODUCT_ID = $el->Add($arLoadProductArray);

				$arEventFields = array(
										"NAME"=>$name,
										"EMAIL"=>$mess,
									);
				CEvent::Send("GETPDF", "s1", $arEventFields);
	LocalRedirect("/thank/");
 } else {
LocalRedirect("/");
} ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>