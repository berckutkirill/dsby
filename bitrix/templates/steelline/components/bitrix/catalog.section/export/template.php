<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arSelect = Array("ID");
$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$count = CIBlockElement::GetList(Array(), $arFilter, array(), false, $arSelect);
if($_GET["PAGEN_1"])
{
	$page = $_GET["PAGEN_1"]+1;
	$fp = fopen("price.csv","a");
}
else
{
	$page = 2;
	$fp = fopen("price.csv","w");
}
if(ceil($count/30) >= $page)
{
	function GetPrice($Item)
	{
		if(!is_array($Item["MIN_PRICE"]))
		{
			if(!is_array($Item["PRICES"]["BASE"]))
			{
				if($Item["CATALOG_PRICE_1"] <= 0)
				{
					continue;
				}
				else
				{
					$price = $Item["CATALOG_PRICE_1"];
				}
			}
			else
			{
				$price = $Item["PRICES"]["BASE"]["DISCOUNT_VALUE_VAT"];
			}
		}
		else
		{
			$price = $Item["MIN_PRICE"]["DISCOUNT_VALUE"];
		}
		return $price;
	}


	function GetElement($Item)
	{
		$from = "UTF-8";
		$to = "cp1251";
		$price = GetPrice($Item);
		$name = iconv($from,$to,$Item["NAME"]);
		$url = $Item["DETAIL_PAGE_URL"];
		$pic = $Item["DETAIL_PICTURE"]["SRC"];
		$descript = iconv($from,$to,strip_tags($Item["DETAIL_TEXT"]));
		$category = "";
		$nav = CIBlockSection::GetNavChain($Item["IBLOCK_ID"], $Item["IBLOCK_SECTION_ID"]);
		while ($arNav=$nav->GetNext()):
		   $category .= $arNav["NAME"]." ";
		endwhile;
		$res["id"] = intVal($Item["ID"]);
		$res["category"] = iconv($from,$to,$category);
		$res["name"] = $name;
		$res["price"] = $price;
		$res["descript"] = $descript;
		$res["pic"] = "http://ds-steelline.by".$pic;
		$res["url"] = "http://ds-steelline.by".$url;
		return $res;
	}

	function GetOffer($Item)
	{
		$from = "UTF-8";
		$to = "cp1251";
		$name = iconv($from,$to,$Item["NAME"]);
		$url = $Item["DETAIL_PAGE_URL"];
		$pic = $Item["DETAIL_PICTURE"]["SRC"];
		$descript = iconv($from,$to,strip_tags($Item["DETAIL_TEXT"]));
		$category = "";
		$nav = CIBlockSection::GetNavChain($Item["IBLOCK_ID"], $Item["IBLOCK_SECTION_ID"]);
		while ($arNav=$nav->GetNext()):
		   $category .= $arNav["NAME"]." ";
		endwhile;
		$res["id"] = intVal($Item["ID"]);
		$res["category"] = iconv($from,$to,$category);
		$res["name"] = $name;
		$res["price"] = 0;
		$res["descript"] = $descript;
		$res["pic"] = "http://ds-steelline.by".$pic;
		$res["url"] = "http://ds-steelline.by".$url;
		return $res;
	}
	$from = "UTF-8";
	$to = "cp1251";
	foreach($arResult["ITEMS"] as $k => $Item)
	{
		if(!is_array($Item["OFFERS"]))
		{
			$el = GetElement($Item);
			if($el["price"] < 1000)
			{
				continue;
			}
			fputcsv($fp, $el, ";");
		}
		else
		{
			$el = GetOffer($Item);
			$name = $el["name"];
			foreach($Item["OFFERS"] as $offer)
			{
				if(count($offer["DISPLAY_PROPERTIES"]) < 1)
				{
				print_r($Item);
				die();
				}
				foreach($offer["DISPLAY_PROPERTIES"] as $property)
				{
					$el["price"] = GetPrice($offer);
					if($el["price"] < 1000)
					{
						continue;
					}
					$tocsv = $el;
					$tocsv["name"] = $name." ".iconv($from,$to,$property["VALUE"]);
					fputcsv($fp, $tocsv, ";");
				}
			}
		}
	}
	
	fclose($fp);
	echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=?PAGEN_1=".$page."\">";
}
else
{
	echo "<a href='price.csv'>price.csv</a>";
}