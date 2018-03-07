<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog.php");
	if($_POST['email']) {
		echo 'Ok!';
	} else {
		if($_POST['phone']) {
			$date = date("d-m-Y");
			$arEventFields = ["PHONE"=>$_POST['phone'], "DATE" => $date, "NAME"=>$_POST['product_name'],"HREF"=>$_POST['product_href']];
			CEvent::Send("SKIDKA", "s1", $arEventFields);
		}
	}

?>