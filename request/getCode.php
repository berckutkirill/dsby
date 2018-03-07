<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	$phone = filter_input(INPUT_POST, "phone");
	/*
		$allResult = GetHBlock(14);
		foreach($allResult as $val) {
				if($val["UF_SALE"] == "7") continue;
				if(!$UF_SALES[$val["UF_SALE"]]) $UF_SALES[$val["UF_SALE"]] = 0;
				$UF_SALES[$val["UF_SALE"]]++;
		}
		$sale = array_search(min($UF_SALES), $UF_SALES); 
	*/
	if(!$phone) die("No Phone");
	function makeCode() {
		$code = substr(md5(uniqid()), 0, 6);
		$Result = GetHBlock(14, ['UF_CODE' => $code]);
		if(empty($Result)) {
			return $code;
		} else {
			return makeCode();
		}
	}

	$Result = GetHBlock(14, ['UF_PHONE' => $phone]);
	if(empty($Result)) {
		$sale = 5;
		$code = makeCode();
		addHBlock(14, array("UF_PHONE" => $phone, 'UF_CODE' => $code, "UF_DATE" => date("d.m.Y H:i:s"), "UF_SALE" => $sale));
	} else {
		$code = $Result[0]["UF_CODE"];
	}
	echo $code;
