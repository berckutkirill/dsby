<?
$page = $APPLICATION->GetCurPage();
function IsActivePage($url, $page)
{
	return $url==$page;
}

$arPages = array(
	array("url" => "/personal/", "name" => "Профиль"),
	array("name" => "Оформление заявки",
		  "sub" => array(
			    array("url" => "/order/sklad/", "name" => "Складские двери"),
			    array("url" => "/konstructor/", "name" => "Конструктор"),
				array("url" => "/order/blank/", "name" => "Бланк заявки"),
			)
		),
	array("url" => "/active/", "name" => "Текущие заявки"),
	array("url" => "/history/", "name" => "История заявок"),
	array("url" => "/promo/", "name" => "Рекламные материалы"),
	array("url" => "/?logout=yes", "name" => "Выход"),
);



foreach($arPages as $k => $arPage)
{
	if($arPage["sub"])
	{
		foreach($arPage["sub"] as $i => $sub)
		{
			if(IsActivePage($sub["url"], $page))
			{
				$arPages[$k]["sub"][$i]["class"] = "active";
			}
			
		}
		
	} else {
		
		if(IsActivePage($arPage["url"], $page))
		{
			$arPages[$k]["class"] = "active";
		}
	}
}

?>
<div class="sidebar">
					<div class="nav">
						<h3>Личный кабинет</h3>
						<ul class="first">
<?foreach($arPages as $k => $arPage) {
	if(is_array($arPage["sub"])) { ?>
	<li>
		<a href="#" class="not"><?=$arPage["name"];?></a>
		<ul class="second open">
		<? foreach($arPage["sub"] as $sub) { ?>
			<li><a href="<?=$sub["url"]?>" class="<?=$sub["class"]?>"><?=$sub["name"]?></a></li>
		<? } ?>
		</ul>
	</li>
<?	} else { ?>
	<li><a href="<?=$arPage["url"]?>" class="<?=$arPage["class"]?>"><?=$arPage["name"]?></a></li>
<?	}
}	?>
		</ul>
	</div>
</div>