<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog.php");?>
<?
if($_POST["my_address"] || $_POST["login"]) {
	return;
}



if(!empty($_POST["name"]) && !empty($_POST["phone"]))
{

	$name = htmlspecialcharsex($_POST['name']);
	$phone = htmlspecialcharsex($_POST['phone']);
	$salon = htmlspecialcharsex($_POST['salon']);
	$email = htmlspecialcharsex($_POST['email']);
				$arEventFields = array(
										"NAME"=>$name,
										"PHONE"=>$phone,
										"SALON"=>strip_tags($salon),
										"EMAIL"=>$email,
									);
				CEvent::Send("SALON", "s1", $arEventFields);
	LocalRedirect("/thank/");
 } else {
LocalRedirect("/");
} ?>