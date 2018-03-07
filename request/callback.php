<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog.php");?>
<?
if(!empty($_POST["name"]) && !empty($_POST["phone"]))
{
	if(!CModule::IncludeModule("iblock")) return;

	$name = htmlspecialcharsex($_POST['name']);
	$phone = htmlspecialcharsex($_POST['phone']);
	$email = htmlspecialcharsex($_POST['email']);
	$mess = htmlspecialcharsex($_POST['comment']);
	

			$el = new CIBlockElement;
	
			$PROP = array();  
			$PROP[95] = $phone; 
			$PROP[96] = $email;
			$arLoadProductArray = Array(
			  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
			  "IBLOCK_ID"      => 9,
			  "PROPERTY_VALUES"=> $PROP,
			  "NAME"           => $name,
			  "ACTIVE"         => "N",
			  "PREVIEW_TEXT"   => $mess,
			  );
	
			$PRODUCT_ID = $el->Add($arLoadProductArray);

				$arEventFields = array(
										"NAME"=>$name,
										"EMAIL"=>$email,
										"MESSAGE"=>$mess,
										"PHONE"=>$phone,
									);
				CEvent::Send("CALLBACK", "s1", $arEventFields);
	LocalRedirect("/thank/");
 } else {
LocalRedirect("/");
} ?>