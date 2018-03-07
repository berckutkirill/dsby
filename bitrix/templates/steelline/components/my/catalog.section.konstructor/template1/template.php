<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$Filter = $arResult["FILTER"];

foreach($Filter["MODELD"] as $k => $val){ 
	$base = $val["ITEM_ID"];
	$mod = $val;
	break;
}
foreach($Filter["COLOR_OUTSIDE"] as $COLOR_OUTSIDE){
	if($base == $val["ITEM_ID"]) {
		$color_outside = $COLOR_OUTSIDE;
		break;
	} 
}

foreach($Filter["COLOR_INSIDE"] as $COLOR_INSIDE){
	if($base == $val["ITEM_ID"]) {
		$color_inside = $COLOR_INSIDE;
		break;
	} 
}
?>
<?foreach($Filter["KOL"] as $k => $val) {
	if($base == $val["ITEM_ID"]) {
		$kol = $val;
		break;
	} 
}
?>

<script>
var kols = <?=json_encode($Filter["KOL"])?>;
var models = <?=json_encode($Filter["MODELD"])?>;
</script>

<?
foreach($Filter["BASEN"] as $k => $val) {
	if($base == $val["ITEM_ID"]) {
		$baseFurn = $val;
		break;
	}
}
?>
<div class="constructor">
			<div class="wrap clearfix">
				<div class="sidebar ajax" id="zeroAjax">
					<a href="/personal/" class="back">Вернуться в личный кабинет</a>
					<div class="foto clearfix">
						<p class="left_foto">
							<img src="<?=$Filter["PICTURES"][$base]["OUTSIDE"]?>" alt="">
							<span>Снаружи</span>
						</p>
						<p class="right_foto">
							<img src="<?=$Filter["PICTURES"][$base]["INSIDE"]?>" alt="">
							<span>Внутри</span>
						</p>
					</div>
					<p class="base_price"><span>Базовая стоимость двери</span> <span id="base_price_door"><?=$mod["BASE_PRICE"]?></span></p>
					<p class="end_price">
						<span>Итоговая стоимость двери</span> <span id="itog_price_door"><?=$mod["BASE_PRICE"]?></span>
						<i data-open="#detailed"></i>
					</p>
					<div class="popup" id="detailed">
						<h3>Итоговая стоимость двери</h3>
						<table>
							<tr class="head">
								<td>Базовая стоимость двери </td>
								<td class="base_price_value"><?=$mod["BASE_PRICE"]?></td>
							</tr>

							<tr class="foot">
								<td>Итоговая стоимость</td>
								<td><?=$mod["BASE_PRICE"]?></td>
							</tr>
						</table>
						<button class="return">Вернуться назад</button>
					</div>
				</div>
				<div class="content">
					<h1 class="title">Конструктор входной двери</h1>
					<p class="info">Для того, чтобы выбрать оптимально подходящую Вам комплектацию двери, отметьте необходимые характеристики. <i>Все поля обязательны для заполнения.</i></p>
					<div class="block">
						<div class="line homeCheck clearfix">
							<p class="descript ">Куда Вам нужна дверь?</p>
							<?foreach($Filter["HOME"] as $k => $val) {
								if($base == $val["ITEM_ID"] && !$home) {
									$check = "check";
									$home = $val["VALUE_ID"];
								} else {
									$check = "";
								}
							?>
								<b class="radio_but reloader <?=$check?>" data-f="HOME" data-value="<?=$val["VALUE_ID"]?>" data-radio="<?=$radio?>" data-input="HOME"><?=$val["VALUE"]?></b>
							<? } $radio++; ?>
						</div>
						<div class="line clearfix">
							<p class="descript">Коллекция</p>
							<div class="select_list"  data-f="KOL" >
								<b class="curr changer" data-input="KOL" id="collection" data-value="<?=$kol["VALUE_ID"]?>"><?=$kol["VALUE"]?></b>
								<ul>
									<?foreach($Filter["KOL"] as $k => $val) { 
									if($base == $val["ITEM_ID"]) {$class="selected";} else {$class="";}
									?>
									<li data-text="<?=$val["VALUE"]?>" data-value="<?=$val["VALUE_ID"]?>" class="<?=$class?>"><?=$val["VALUE"]?></li>
									<? } ?>
								</ul>
							</div>
						</div>
						<div class="line clearfix" id="model">
							<p class="descript">Модель двери</p>
							<div class="select_list" data-f="MODELD">
									<b class="curr ajax excel" data-excel="MODELD" data-input="MODELD" id="currMODELD" data-excel-val="<?=$mod["VALUE"]?>" data-value="<?=$mod["VALUE_ID"]?>"><?=$mod["VALUE"]?></b>
								<ul id="modelList">
									<?foreach($Filter["MODELD"] as $k => $val){ 
									if($kol["VALUE_ID"] != $val["KOL"]) continue;
									if(!in_array($home, $val["HOME"])) continue;
									if($base == $val["ITEM_ID"]) {$class="selected";} else {$class="";}
									?>
										<li data-text="<?=$val["VALUE"]?>" data-excel="MODELD" data-excel-val="<?=$val["VALUE"]?>" class="<?=$class?>" data-price="<?=$val["BASE_PRICE"]?>" data-value="<?=$val["VALUE_ID"]?>"><?=$val["VALUE"]?><span><?=toPrice($val["BASE_PRICE"])?> Br</span></li>
									<? } ?>
								</ul>
							</div>
						</div>

						<div class="line ajax clearfix closest_name_wrap closest_pricer" id="secondAjax"  data-filter="TOL">
							<p class="descript closest_name">Толщина щита</p>
							<?
								foreach($Filter["TOL"] as $k => $val) {	
								if($base == $val["ITEM_ID"] && !$tol && !$val["PRICE"]) {
									$check = "check";
									$excel = "excel";
									$tol = true;
								} else {
									$check = "";
									$excel = "";
								}
							?>
							<b class="radio_but <?=$check." ".$excel?> mini" data-input="TOL" data-radio="<?=$radio?>" data-excel="TOL" data-excel-val="<?=$val["VALUE"]?>" data-price="<?=$val["PRICE"]?>" data-value="<?=$val["VALUE_ID"]?>"><?=$val["VALUE"]?></b>
							<? } $radio++ ?>
							<i class="price_up"></i>
						</div>
					</div>
				<div class="ajax" id="thirdAjax">
					<div class="block padd closest_name_wrap closest_switcher closest_pricer">
						<i class="price_up"></i>
						<h2 class="closest_name">Отделка двери снаружи</h2>
						<div class="clearfix">
							<div class="texture_wrap">
								<p class="img"><img class="switch_getter_img" data-id="outsideImg" src="" alt=""></p>
							</div>
							<ul class="texture_list" data-filter="OUTSIDE">
								<?foreach($Filter["BLOKKH"] as $k => $val) {
									if($base == $val["ITEM_ID"] && !$outs && !$val["PRICE"]) {
										$outs = $val["VALUE_ID"];
										break;
									} 
								} ?>
								<?foreach($Filter["OUTSIDE"] as $k => $val) {
									if($outs == $k && !$setted) {
										$setted = true;
										$check = "check";
										$val["PRICE"] = 0;
										$excel = "excel";
									} else {
										$check = "";
										$excel = "";
									}
									
								?>
									<li data-choise="<?=$k?>">
										<b class="radio_but switcher_set <?=$check." ".$excel?>" data-excel="OUTSIDE" data-price="<?=$val["PRICE"]?>" data-excel-val="<?=$val["VALUE"]?>" data-id="col_<?=$k?>" data-radio="<?=$radio?>" data-input="OUTSIDE"><?=$val["VALUE"]?></b>
										<i class="info_pop" data-open="#colors_door<?=$k?>">i</i>
									</li>
								<? } $setted = false; $radio++; ?>
							</ul>
						</div>
						
						<?
						foreach($Filter["OUTSIDE"] as $k => $vals) {
							if($outs == $k && !$setted) {
								$setted = true;
								$hidden = false;
							} else {
								$hidden = "hidden";
							}
						?>
						<div class="<?=$hidden?> colors_door one switcher_get" data-id="col_<?=$k?>">
							<h3>Цвет двери снаружи</h3>
							<div class="overf">
								<ul>
									<?
									foreach($vals["COLORS"] as $k => $val) {
										if((trim($val["description"]) == trim($color_outside["VALUE"])) && !$hidden) {
											$colourse = true;
											$check = "check";
											$excel = "excel";
										} else {
											$check = "";
											$excel = "";
										}
									?>
										<li><p class="img <?=$excel." ".$check?>" data-input="OUTSIDE_COLOR" data-excel="OUTSIDE_COLOR" data-excel-val="<?=$val["description"]?>" data-radio="<?=$radio?>" data-value="<?=$val["description"]?>"><img src="<?=$val["file"]?>" class="switch_setter_img" data-id="outsideImg" alt=""></p><i class="tooltip"><?=$val["description"]?></i></li>
									<? } 
									
									$radio++;
									?>
								</ul>
							</div>
							<div class="control prev"></div>
							<div class="control next"></div>
						</div>
						<? } $setted = false; $colourse = false; ?>
							
						
					</div>
					<div class="block padd closest_name_wrap closest_pricer closest_switcher">
						<i class="price_up"></i>
						<h2 class="closest_name">Отделка двери внутри</h2>
						<div class="clearfix">
							<div class="texture_wrap">
								<p class="img"><img src="" class="switch_getter_img" data-id="insideImg" alt=""></p>
							</div>
							<ul class="texture_list " data-filter="INSIDE">
								<?foreach($Filter["BLOHKKH"] as $k => $val) { 
									if($base == $val["ITEM_ID"] && !$ins && !$val["PRICE"]) {
										$ins = $val["VALUE_ID"];
										break;
									} 
								}?>
								<?foreach($Filter["INSIDE"] as $k => $val) {
									if($ins == $k && !$setted) {
										$setted = true;
										$check = "check";
										$excel = "excel";
										$val["PRICE"] = 0;
									} else {
										$check = "";
										$excel = "";
									}
								?>
								<li data-choise="<?=$k?>">
									<b class="switcher_set radio_but <?=$check." ".$excel?>" data-price="<?=$val["PRICE"]?>" data-excel="INSIDE" data-input="INSIDE" data-excel-val="<?=$val["VALUE"]?>" data-id="col_<?=$k?>" data-value="<?=$val["VALUE_ID"]?>" data-radio="<?=$radio?>"><?=$val["VALUE"]?></b>
									<i class="info_pop" data-open="#colors_door<?=$k?>">i</i>
								</li>
								<? }
								$setted = false;
								$radio++;
								?>
							</ul>
						</div>
						
							<?foreach($Filter["INSIDE"] as $k => $vals) {
									if($ins == $k && !$setted) {
										$setted = true;
										$hidden = false;
									} else {
										$hidden = "hidden";
									}
									?>
							<div class="colors_door two <?=$hidden?> switcher_get" data-id="col_<?=$k?>">
								<h3>Цвет двери внутри</h3>
								<div class="overf">
								<ul>
									<?foreach($vals["COLORS"] as $k => $val) {
										if((trim($val["description"]) == trim($color_inside["VALUE"])) && !$hidden) {
											$colourse = true;
											$check = "check";
											$excel = "excel";
										} else {
											$check = "";
											$excel = "";
										}
										?>
										<li>
											<p class="img <?=$excel." ".$check?>" data-input="INSIDE_COLOR" data-excel="INSIDE_COLOR" data-excel-val="<?=$val["description"]?>" data-radio="<?=$radio?>" data-value="<?=$val["description"]?>"><img src="<?=$val["file"]?>" class="switch_setter_img" data-id="insideImg" alt=""></p>
											<i class="tooltip"><?=$val["description"]?></i>
										</li>
									<? } $setted = false; $radio++; ?>
								</ul>
								</div>
								<div class="control prev"></div>
								<div class="control next"></div>
							</div>
							<? } $setted = $colourse = false;  ?>
					</div>
					<div class="block padd closest_name_wrap closest_pricer">
						<i class="price_up"></i>
						<h2 class="closest_name">Цвет дверного блока</h2>
						<div class="clearfix">
							<div class="texture_left">
								<img src="" class="switch_getter_img" data-id="blockImg" alt="">
							</div>
							<div class="texture_right">
								<p class="img">
									<img src="" class="switch_getter_img" data-id="outsideImg" alt="">
									<span>Цвет двери снаружи</span>
								</p>
								<p class="img">
									<img src="" class="switch_getter_img" data-id="insideImg" alt="">
									<span>Цвет двери внутри</span>
								</p>
							</div>
						</div>
						<div class="colors_door three">
							<h3>Выберите цвет дверного блока</h3>
							<div class="overf ">
								<ul>
									<?foreach($Filter["BLOCK_COLOR"] as $k => $val) { 
										if(!$colourse && !$val["PRICE"]) {
											$colourse = true;
											$check = "check";
											$excel = "excel";
										} else {
											$check = "";
											$excel = "";
										}
									?>
										<li><p data-input="BLOCK_COLOR" class="img <?=$check." ".$excel?>" data-price="<?=$val["PRICE"]?>" data-excel="BLOCK_COLOR" data-excel-val="<?=$val["VALUE"]?>" data-radio="<?=$radio?>" data-value="<?=$val["VALUE"]?>"><img class="switch_setter_img" data-id="blockImg" src="<?=$val["FILE"]?>" alt=""></p><i class="tooltip"><?=$val["VALUE"]?></i></li>
									<? } $colourse = false; $radio++ ?>
								</ul>
							</div>
							<div class="control prev"></div>
							<div class="control next"></div>
						</div>
					</div>
					<div class="block closest_pricer">
						<i class="price_up"></i>
						<h2>Технические параметры входной двери</h2>
						<div class="line closest_name_wrap clearfix">
							<p class="descript closest_name">Ширина</p>
							<?foreach($Filter["SHIR"] as $k => $val) {
								if($val["ITEM_ID"] == $base && !$checked && !$val["PRICE"]){
									$check = "check";
									$excel = "excel";
									$checked = true;
								} else {
									$check = "";
									$excel = "";
								}
							?>
								<b class="radio_but <?=$check." ".$excel?> mini" data-input="SHIR" data-price="<?=$val["PRICE"]?>" data-excel="SHIR" data-excel-val="<?=$val["VALUE"]?>" data-radio="<?=$radio?>"  data-value="<?=$val["VALUE_ID"]?>"><?=$val["VALUE"]?></b>
							<? } $radio++; $checked = false; ?>
							<input type="text" name="" class="excel_setter_input" placeholder="Другая ширина">
							<span class="mm">мм</span>
							<i class="info_pop" data-open="#w">i</i>
						</div>
						<div class="line closest_name_wrap clearfix">
							<p class="descript closest_name">Высота</p>
							<?foreach($Filter["VIS"] as $k => $val) { 
							
								if($val["ITEM_ID"] == $base && !$checked && !$val["PRICE"]){
									$check = "check";
									$excel = "excel";
									$checked = true;
								} else {
									$check = "";
									$excel = "";
								}
							?>
								<b data-input="VIS" class="radio_but <?=$check." ".$excel?> mini" data-price="<?=$val["PRICE"]?>" data-excel="VIS" data-excel-val="<?=$val["VALUE"]?>" data-radio="<?=$radio?>"  data-value="<?=$val["VALUE_ID"]?>"><?=$val["VALUE"]?></b>
							<? } $checked = false; $radio++; ?>
							<input type="text" name="" class="excel_setter_input" placeholder="Другая высота">
							<span class="mm">мм</span>
							<i class="info_pop" data-open="#w">i</i>
						</div>
						<div class="line closest_name_wrap clearfix">
							<p class="descript"><span class="closest_name">Количество контуров</span> <i class="info_pop" data-open="#contura">i</i></p>
							<?
							if(count($Filter["KONTUR"]) == 1) {
								$priceK = false;
							} else {
								$priceK = true;
							}
							foreach($Filter["KONTUR"] as $k => $val) {
								if($val["ITEM_ID"] == $base && !$checked) {
									$check = "check";
									$excel = "excel";
									$checked = true;
								} else {
									$check = "";
									$excel = "";
								}
								
								if(!$priceK) $val["PRICE"] = 0;
							?>
								<b data-input="KONTUR" class="radio_but <?=$check." ".$excel?> mini" data-excel="KONTUR" data-excel-val="<?=$val["VALUE"]?>" data-radio="<?=$radio?>" data-price="<?=$val["PRICE"]?>" data-value="<?=$val["VALUE_ID"]?>"><?=$val["VALUE"]?></b>
							<? } $checked = false; $radio++;?>
						</div>
					</div>
					<div class="block padd closest_pricer">
						<i class="price_up"></i>
						<h2>Наборы фурнитуры</h2>
						<div class="clearfix">
							<div class="furn_choose">

							<?foreach($Filter["FURNS"] as $k => $furn) {
								if($furn["ID"] == $baseFurn["VALUE"]) {
									$check = "check";
									$excel = "excel";
								} else {
									$check = "";
									$excel = "";
								}
								
							 ?>

								<div class="furn_type closest_name_wrap <?=$furn["ID"]?>" data-f="toggleShow" data-toggle="#furn_type<?=$k?>">
									<div class="line clearfix">
										<b class="slide_down"></b>
										<b data-input="FURN" class="radio_but closest_name <?=$check." ".$excel?>" data-excel="NABOR" data-excel-val="<?=$furn["NAME"]?>" data-price="<?=$furn["PRICE"]?>" data-radio="<?=$radio?>"><?=$furn["NAME"]?></b>
										<i class="info_pop" data-open="#furn_pop<?=$k?>">i</i>
										<div class="popup clearfix" id="furn_pop<?=$k?>">
											<div class="galery">
												<p class="big"><img src="<?=$furn["FILE"]?>" alt=""></p>
												<ul class="control clearfix">
													<?foreach($furn["GALERY"] as $key => $galery) {
														if(!$galery["FILE"]) continue; ?>
														<li data-galery="<?=$key?>">
															<p class="img"><img src="<?=$galery["FILE"]?>" alt=""></p>
														</li>
													<? } ?>
												</ul>
											</div>
											<div class="text">
												<h3><?=$furn["NAME"]?></h3>
												<ul>
													<?foreach($furn["NABOR"] as $key => $item) { ?>
													<p data-galery="<?=$key?>"><?=$item["NAME"]?></p>
													<? } ?>
												</ul>
											</div>
										</div>
									</div>
									<div class="table">
										<?foreach($furn["NABOR"] as $key => $val) { ?>
											<p><?=$val["NAME"]?></p>
										<? } ?>
									</div>
								</div>
								<? } $radio++; ?>
							</div>
							<?foreach($Filter["FURNS"] as $k => $furn) {
							if($furn["ID"] == $baseFurn["VALUE"]){
									$class = "";
								} else {
									$class = "hidden";
								}
							?>
							<div class="furn_detail closest_name_wrap closest_pricer <?=$class?>" id="furn_type<?=$k?>">
								<div class="screen closest_switcher">
									<h2><?=$furn["NAME"]?></h2>
									<p class="closest_name">Ручка</p>
									<?
									foreach($Filter["RUCHKA"] as $key => $val) {
										if($base == $val["ITEM_ID"]) {
											$hand = $val["VALUE_ID"];
											break;
										}
									} ?>
									<?foreach($furn["HANDS"] as $key => $val) {
										if($hand == $key) {
											$check = "check";
											if(!$class)
												$excel = "excel";
										} else {
											$check = "";
											$excel = "";
										}
									?>
										<p class="radio switcher_set" data-id="hand_col<?=$key?>">
											<span data-input="HAND" class="radio_box <?=$check." ".$excel?>" data-price="<?=$val["PRICE"]?>" data-excel="HAND" data-excel-val="<?=$val["NAME"]?>"  data-radio="<?=$radio?>" data-f="toggleShow" data-toggle="hand_colors<?=$key?>"><?=$val["NAME"]?></span>
											<i class="info_pop" data-open="#furn_detail<?=$key?>">i</i>
										</p>
									<? } $radio++; ?>
									<?foreach($furn["HANDS"] as $k => $val) {
										if($hand == $k) {
											$hidden = "";
										} else {
											$hidden = "hidden";
										}
									?>
										<ul class="furn_color <?=$hidden?> clearfix switcher_get" data-id="hand_col<?=$k?>">
											<?foreach($val["COLORS"] as $key => $val) {
												if(!$colorCheck)
												{
													$colorCheck = true;
													if(!$hidden && !$class){
														$excel = "excel";
														$check = "check";
													} else {
														$excel = "";
														$check = "";
													}
												} else {
													$excel = "";
													$check = "";
												}
											?>
													<li data-toggle="hand_colors<?=$val["HAND_ID"]?>">
														<p data-input="HAND_COLOR" class="img <?=$check." ".$excel?>" data-excel="HAND_COLOR" data-price="<?=$val["PRICE"]?>" data-excel-val="<?=$val["VALUE"]?>" style="background-color:<?=$val["HEX_COLOR"]?>;" data-value="<?=$val["VALUE_ID"]?>" data-radio="<?=$radio?>"></p>
														<i class="tooltip"><?=$val["VALUE"]?></i>
													</li>
											<? } $radio++; $colorCheck = false;?>
										</ul>
									<? } ?>
									<?if($furn["CILYNDER"]["NAME"]) { ?>
									<p>Цилиндр</p>
									<span>
										<span data-input="CILYNDER"><?=$furn["CILYNDER"]["NAME"]?></span>
										<i class="info_pop excel" data-excel="CYLINDR"  data-excel-val="<?=$furn["CILYNDER"]["NAME"]?>" data-open="#furn_cilynder<?=$furn["CILYNDER"]["VALUE_ID"]?>">i</i></span>
									<ul class="furn_color clearfix">
										<?foreach($furn["CILYNDER"]["COLORS"] as $val) {
											if(!$colorCheck)
												{
													$colorCheck = true;
													$excel = "excel";
													$check = "check";
												} else {
													$excel = "";
													$check = "";
												}
										?>
											<!--li data-toggle="cilynder_color<?=$val["CILYNDER_ID"]?>"><p class="img <?=$check." ".$excel?>" data-excel="CYLINDR_COLOR"  data-excel-val="<?=$val["VALUE"]?>"style="background-color:<?=$val["HEX_COLOR"]?>;" data-radio="<?=$radio?>"  data-value="<?=$val["VALUE_ID"]?>"></p><i class="tooltip"><?=$val["VALUE"]?></i></li-->
										<? } $radio++; ?>
									</ul>
									<? }
									
									if(!$class){
										$excel = "excel";
									} else {
										$excel = "";
									}
									
									foreach($furn["PROPERTIES"] as $code => $prop) {
										if(is_array($prop["VALUE"]))
										{
											$name = $prop["NAME"];
											
											?><p><?=$name?></p><?
											
											foreach($prop["VALUE"] as $k => $val) {
												if(!$k) $check = "check"; else $check = "";
												?>
												<span data-input="<?=$code?>" data-excel="<?=$code?>" class="<?=$check." ".$excel?>" data-excel-val="<?=$val?>" >
													<?=$val?>
													<i class="info_pop" data-open="#dop<?=$prop["VALUE_ID"]?>">i</i>
												</span>
											<? }
										} elseif($prop["VALUE"]) {
											?><p><?=$prop["NAME"]?></p>
											<span data-excel="<?=$code?>" data-input="<?=$code?>" class="check <?=$excel?>" data-excel-val="<?=$prop["VALUE"]?>" >
												<?=$prop["VALUE"]?>
												<i class="info_pop" data-open="#dop<?=$prop["VALUE_ID"]?>">i</i>
											</span>
										<?
										}
									}
									?>
								</div>
								<i class="price_up"></i>
								
							</div>
							<? } ?>
						</div>
					</div>
					<div class="block last">
						<h2>Дополнительные параметры входной двери</h2>
						<?
						
						foreach($Filter["DOP"] as $k => $dop) { ?>
							<?
							
							if($Filter[$k]) {
							$val = array();
							
							foreach($Filter[$k] as $val) { 
								if($base == $val["ITEM_ID"]) {
								
									if(!$val["PRICE"]){
										$val["VARS"] = $dop;
										break;
									} else {
										if($val["VALUE"] == "Нет") {
											$val["VARS"] = $dop;
											break;
										} else {
											continue;
										}
									}
									
								}
							} 
							if(!$val["VARS"]) continue;
							?>
							
							<div class="line closest_pricer closest_name_wrap clearfix">
								<p class="descript"><span class="closest_name"><?=$val["NAME"]?></span> <i class="info_pop" data-open="#dop_params<?=$k?>">i</i></p>
								<? foreach($val["VARS"] as $key => $var) {
									if($key == $val["VALUE_ID"]) {
										$check = "check";
										$excel = "excel";
									} else {
										$check = "";
										$excel = "";
									}
									
									if($k == "GERK" || $k == "NAKL"){
										if($var["VALUE"] == "Да")
											$excel_val = $val["NAME"];
										else
											$excel_val = "";
									} else {
										$excel_val = $var["VALUE"];
									}
								?>
									<b class="radio_but <?=$check." ".$excel?> mini" data-input="<?=$k?>" data-excel="<?=$k?>" data-price="<?=$var["PRICE"]?>" data-excel-val="<?=$excel_val?>" data-radio="<?=$radio?>"><?=$var["VALUE"]?></b>
								<? } ?>
								<i class="price_up"><?=$val["PRICE"]?></i>
							</div>
						<? $radio++; 
							} 
						} ?>
					
					</div>
				</div>
			</div>
				
			<div class="fade2"><i class="close"></i></div>
		</div>
<?if(!$arParams["THIS_AJAX"]) { ?>		
		<div class="wrap">
				<div class="exel_table">
					<h2>Форма заказа двери</h2>
							<?function utf8($str, $from = "UTF-8", $to = "cp1251" ){
								return (iconv($from, $to, $str));
							}
							$arr = array(
							"NUMBER" => array("VALUE" => "", "TABLE" => "C9"),
							"MODEL" => array("VALUE" => "", "TABLE" => "H9"),
							"DOVODCHIK" => array("VALUE" => "", "TOOLTIP" => "<strong>&quot;Да&quot;</strong><br> при наличии доводчика", "TABLE" => "N9"),
							"ZAKAZCHIK" => array("VALUE" => "ДВЕРНОЙ СЕЗОН", "TABLE" => "P9"),
							"SIDE" => array("VALUE" => "", "TOOLTIP" => "<strong>ЛЕВАЯ\ПРАВАЯ</strong><br> сторона открытия", "TABLE" => "F10"),
							"SIZE" => array("VALUE" => "", "TOOLTIP" => "Размер двери:<br><strong>ШИРИНА х ВЫСОТА</strong><br><br>При наличии доп. элементов после габаритного<br> размера указать в скобках размер ПО КОРОБКЕ двери для выбора<br> правильной заготовки (размер без доп. элементов).", "TABLE" => "H10"),
							"PROSVET" => array("VALUE" => "", "TOOLTIP" => "<strong>СВЕТОВОЙ ПРОЕМ ОСНОВНОЙ СТВОРКИ<br> 800 либо 900</strong><br><br>заполняем для дверей ДВУПОЛЬНЫХ и дверей с глухой боковой ДОБОРКОЙ", "TABLE" => "N9"),
							"IDONTNOW" => array("VALUE" => "", "TOOLTIP" => false, "TABLE" => "O10"),
							"TYPE" => array("VALUE" => "", "TOOLTIP" => "при наличии ОКНА указываем тип <br><strong>&quot;Г&quot;</strong> либо <strong>&quot;Е&quot;</strong>", "TABLE" => "G11"),
							"RESHETKA" =>  array("VALUE" => "", "TOOLTIP" => "<strong>&quot;Да&quot;</strong><br> при наличии решетки", "TABLE" => "I11"),
							"KREPLENIYA" =>  array("VALUE" => "", "TOOLTIP" => "При наличии КРЕПЛЕНИЙ указать размер от коробки до отверстия. <br><strong>Стандартно 50 мм.</strong>", "TABLE" => "N11"),
							"SERNUM" =>  array("VALUE" => "ЗАКАЗНАЯ", "TOOLTIP" => "Наимнование<br><strong>СЕРИЙНОЙ</strong><br>модели", "TABLE" => "P11"),
							"COLOR" =>  array("VALUE" => "", "TOOLTIP" => "цвет<br><strong>ХР / ЛАТ</strong>", "TABLE" => "E12"),
							"TOP_LOCK" =>  array("VALUE" => "", "TOOLTIP" => "Наименовани ВЕРХНЕГО ЗАМКА по прайсу.<br><br>Наличие ночной задвижки, там где она предусмотрена прайсом,<br> вписываем как <strong>&quot;+ Н/З&quot;</strong>.<br><br>Комплект фурнитуры для комбинации замков определен ПРАЙСОМ.<br>См. приложение &quot;ЗАМКИ и ФУРНИТУРА&quot;.", "TABLE" => "H12"),
							"ARMOR" =>  array("VALUE" => "", "TOOLTIP" => "<strong>&quot;КРИТ&quot;</strong><br>при наличии в комбинации врезной брони.<br><br>Комплект фурнитуры для замка определен ПРАЙСОМ.<br>См. приложение &quot;ЗАМКИ и ФУРНИТУРА&quot;.", "TABLE" => "M12"),
							"SIZE_CYLLINDRE" =>  array("VALUE" => "", "TOOLTIP" => "Размер (симметрия) цилиндра определены конструктивно.<br>См. приложение &quot;ЗАМКИ&quot;.<br><br>Укажите производителя:  <strong>А/К/S</strong><br>При отсутствии <strong>ПР</strong> писать <strong>КЛ/КЛ</strong><br>НАПРИМЕР: <strong>К КЛ/КЛ</strong>", "TABLE" => "P12"),
							"SIZE_CYLLINDRE_SECOND" =>  array("VALUE" => "", "TOOLTIP" => "<strong>ПР</strong> или <strong>КЛ/КЛ</strong>", "TABLE" => "Q12"),
							"BOTTOM_LOCK" =>  array("VALUE" => "", "TOOLTIP" => "Наименовани ВЕРХНЕГО ЗАМКА по прайсу.<br><br>Наличие ночной задвижки, там где она предусмотрена прайсом, вписываем как &quot;+ Н/З&quot;.<br><br>Комплект фурнитуры для комбинации замков определен ПРАЙСОМ.<br>См. приложение &quot;ЗАМКИ и ФУРНИТУРА&quot;.", "TABLE" => "H13"),
							"ARMOR_BOTT" =>  array("VALUE" => "", "TOOLTIP" => "<strong>&quot;КРИТ&quot;</strong><br>при наличии в комбинации врезной брони.<br><br>Комплект фурнитуры для замка определен ПРАЙСОМ.<br>См. приложение &quot;ЗАМКИ и ФУРНИТУРА&quot;.", "TABLE" => "M12"),
							"SIZE_CYLLINDRE_BOTT" =>  array("VALUE" => "", "TOOLTIP" => "Размер (симметрия) цилиндра определены конструктивно.<br>См. приложение &quot;ЗАМКИ&quot;.<br><br>Укажите производителя:  <strong>А/К/S</strong><br>При отсутствии <strong>ПР</strong> писать <strong>КЛ/КЛ</strong><br>НАПРИМЕР: <strong>К КЛ/КЛ</strong>", "TABLE" => "P13"),
							"SIZE_CYLLINDRE_SECOND_BOTT" =>  array("VALUE" => "", "TOOLTIP" => "<strong>ПР</strong> или <strong>КЛ/КЛ</strong>", "TABLE" => "Q13"),
							"HANDS" =>  array("VALUE" => "", "TOOLTIP" => "Наименование РУЧЕК по прайсу.", "TABLE" => "F14"),
							"GLASS" =>  array("VALUE" => "", "TOOLTIP" => "<strong>&quot;Да&quot;</strong><br> при наличии глазка", "TABLE" => "M14"),
							"GLASS_HEIGHT" =>  array("VALUE" => "", "TOOLTIP" => "Расстояние от уровня пола до ГЛАЗКА в мм.<br><br>Стандартно Н=1500 мм.", "TABLE" => "N14"),
							"LEFT_NAL" =>  array("VALUE" => "", "TOOLTIP" => "Укажите <strong>Тип и Размер</strong> наличника.<br><strong>У-...</strong> либо <strong>ПЛ-...</strong><br><br>Стандартно наличник <strong>У-70</strong>.<br>Опционально (за доплату) Вы можете заказать наличник от У-45 (вылет 20 мм для ДГ и 30 мм для ДТ)<br> до У-100 (вылет 75 мм для ДГ и 85 мм для ДТ).<br><br>Наличник под углом 90 град. не устанавливается!<br>Взамен устанавливается наличник <strong>ПЛ</strong> (плоский) с малым вылетом.<br>Стандартно <strong>ПЛ-40</strong> (вылет 15 мм для ДГ и 25 мм для ДТ).<br>Иные размры не устанавливаются.", "TABLE" => "G15"),
							"TOP_NAL" =>  array("VALUE" => "", "TOOLTIP" => "Укажите <strong>Тип и Размер</strong> наличника.<br><strong>У-...</strong> либо <strong>ПЛ-...</strong><br><br>Стандартно наличник <strong>У-70</strong>.<br>Опционально (за доплату) Вы можете заказать наличник от У-45 (вылет 20 мм для ДГ и 30 мм для ДТ)<br> до У-100 (вылет 75 мм для ДГ и 85 мм для ДТ).<br><br>Наличник под углом 90 град. не устанавливается!<br>Взамен устанавливается наличник <strong>ПЛ</strong> (плоский) с малым вылетом.<br>Стандартно <strong>ПЛ-40</strong> (вылет 15 мм для ДГ и 25 мм для ДТ).<br>Иные размры не устанавливаются.", "TABLE" => "I15"),
							"RIGHT_NAL" =>  array("VALUE" => "", "TOOLTIP" => "Укажите <strong>Тип и Размер</strong> наличника.<br><strong>У-...</strong> либо <strong>ПЛ-...</strong><br><br>Стандартно наличник <strong>У-70</strong>.<br>Опционально (за доплату) Вы можете заказать наличник от У-45 (вылет 20 мм для ДГ и 30 мм для ДТ)<br> до У-100 (вылет 75 мм для ДГ и 85 мм для ДТ).<br><br>Наличник под углом 90 град. не устанавливается!<br>Взамен устанавливается наличник <strong>ПЛ</strong> (плоский) с малым вылетом.<br>Стандартно <strong>ПЛ-40</strong> (вылет 15 мм для ДГ и 25 мм для ДТ).<br>Иные размры не устанавливаются.", "TABLE" => "K15"),
							"NAL_MDF" =>  array("VALUE" => "", "TOOLTIP" => "<strong>&quot;Да&quot;</strong><br> при наличии наличника МДФ", "TABLE" => "N15"),
							"LOGO" =>  array("VALUE" => "", "TOOLTIP" => "<strong>&quot;ПОРТАЛ&quot;</strong><br>при наличии портала", "TABLE" => "O15"),
							"OUTSIDE" =>  array("VALUE" => "", "TOOLTIP" => "Укажите <strong>ТИП</strong> отделки снаружи:<br><br><strong>- МЕТАЛЛ</strong> для моделей с металлом снаружи<br> (покрытие не указываем);<br><strong>- МДФ</strong> для моделей с МДФ снаружи.<br> Толщина, влагостойкий (если ДА), рисунок, <br>тип и цвет пленки, либо шпон, тонировка, патинирование.<br><br>ПАНЕЛЬ <strong>&quot;КВАДРАТ&quot;</strong> при наличии.", "TABLE" => "F16"),
							"INSIDE" =>  array("VALUE" => "", "TOOLTIP" => "Укажите <strong>ТИП</strong> отделки снаружи:<br><br><strong>- МЕТАЛЛ</strong> для моделей с металлом снаружи<br> (покрытие не указываем);<br><strong>- МДФ</strong> для моделей с МДФ снаружи.<br> Толщина, влагостойкий (если ДА), рисунок, <br>тип и цвет пленки, либо шпон, тонировка, патинирование.<br><br>ПАНЕЛЬ <strong>&quot;КВАДРАТ&quot;</strong> при наличии.", "TABLE" => "F18"),
							"DOOR_BLOCK" =>  array("VALUE" => "", "TOOLTIP" => "Укажите тип и цвет<br><strong>ПОЛИМЕРНОГО ПОКРЫТИЯ</strong> ДВЕРИ", "TABLE" => "H20"),
							"PANEL" =>  array("VALUE" => "", "TOOLTIP" => "Укажите тип и цвет<br><strong>ПОЛИМЕРНОГО ПОКРЫТИЯ</strong> ПАНЕЛИ", "TABLE" => "H21"),
							"RESHETKA_POKRYTIE" =>  array("VALUE" => "", "TOOLTIP" => "Укажите тип и цвет<br><strong>ПОЛИМЕРНОГО ПОКРЫТИЯ</strong> РЕШЕТКИ ОКОННОЙ", "TABLE" => "H22"),
							"PRIMECH" =>  array("VALUE" => "", "TOOLTIP" => "Наличие упаковки и<br>прочая информация", "TABLE" => "F23")
							);
							?>
							<style id="styleCss">
							input, textarea {
								box-sizing: border-box;
								outline: none;
								padding-left: 10px;
								background: none;
								border: none;
								position: relative;
								line-height: normal !important;
							}
							.resultForm table {
								font-family: Arial;
								width: 1180px;
								table-layout: fixed;
								color:blue;
								 border-collapse: collapse;
								font-size:13px;
							}
							.resultForm input[type="submit"] {
								margin: 10px;
								margin-right: 0;
								width: 200px;
								height: 40px;
								float: right;
							}

							.resultForm {
								width: 1180px;
							}
							.resultForm td {
								border: 1px solid;
								height: 30px;
								position: relative;
								border-color: #000;
								white-space: pre;
								padding-left: 5px;
								vertical-align: middle;
								font-style: italic;
							}

							.resultForm td:first-child {
							  font-style: normal;
							}

							
							.resultForm .editable input.COLOR {
								transform: rotate(-90deg);
								-webkit-transform: rotate(-90deg);
								-moz-transform: rotate(-90deg);
								width: 110px;
								bottom: 45px;
								position: absolute;
								left: -20px;
							}

							.resultForm .tooltip {
								display: none;
								position: absolute;
								background-color: #fff;
								border: 1px solid;
								padding: 10px;
								bottom: 100%;
								left: 100%;
								z-index: 9;
								text-align: center;
								color: #000;
								font-style: normal;
								white-space: pre;
							}
							.resultForm td:hover .tooltip
							{
								display: block;
							}
							.resultForm .editable input {
								border: 0;
								width: 100%;
								font-weight: bold;
								text-transform: uppercase;
								font-size: 16px;
								background-color: #DDF0FD;
								outline: none;
								color: #000;
								height: 45px;
							}
							.resultForm input.SERNUM {
								color: rgb(190, 0, 0);
							}

							.resultForm td#COLOR {
								padding: 0;
								overflow: hidden;
								position: relative;
							}

							.resultForm input.PRIMECH {
								color: red;
							}

							.resultForm .editable {
								background-color: #DDF0FD;
							}

							</style>
							<form class="resultForm" id="formTableRes" action="send.php" method="post">
							<table cellspacing="0" cols="17" border="1">
								<tr>
									<td>№</td>
									<?$el = "NUMBER";?>
									<td id="<?=$el?>" class="editable"  colspan=3><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<td colspan=2>модель:</td>
									<?$el = "MODEL";?>
									<td id="<?=$el?>" class="editable"  colspan=5><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<td>доводчик:</td>
									<?$el = "DOVODCHIK";?>
									<td id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<td>заказчик</td>
									<?$el = "ZAKAZCHIK";?>
									<td id="<?=$el?>" class="editable"  colspan=3><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
								</tr>
								<tr>
									<td colspan=4>РАЗМЕР</td>
									<?$el = "SIDE";?>
									<td id="<?=$el?>" class="editable"  colspan=2><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<?$el = "SIZE";?>
									<td id="<?=$el?>" class="editable"  colspan=5><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<td>просвет:</td>
									<?$el = "PROSVET";?>
									<td id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<?$el = "IDONTNOW";?>
									<td colspan=4 id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									</tr>
								<tr>
									<td colspan=4>ОКНО</td>
									<td>тип:</td>
									<?$el = "TYPE";?>
									<td id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<td>решетка:</td>
									<?$el = "RESHETKA";?>
									<td id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<td colspan=4>МОНТАЖНЫЕ КРЕПЛЕНИЯ:</td>
									<?$el = "KREPLENIYA";?>
									<td id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<td>заказчик</td>
									<?$el = "SERNUM";?>
									<td id="<?=$el?>" class="editable"  colspan=3><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
								</tr>
								<tr>
									<td colspan=2 rowspan=2 >ЗАМКИ</td>
									<td rowspan=3 >цвет</td>
									<?$el = "COLOR";?>
									<td id="<?=$el?>" class="editable"  rowspan=3 ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<td colspan=2 >верхний:</td>
									<?$el = "TOP_LOCK";?>
									<td id="<?=$el?>" class="editable"  colspan=4 ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<td>броня</td>
									<?$el = "ARMOR";?>
									<td id="<?=$el?>" class="editable"  colspan=2 ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<td>цил.:</td>
									<?$el = "SIZE_CYLLINDRE";?>
									<td id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<?$el = "SIZE_CYLLINDRE_SECOND";?>
									<td id="<?=$el?>" class="editable"  colspan=2 ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
								</tr>
								<tr>
									<td colspan=2 >НИЖНИЙ:</td>
									<?$el = "BOTTOM_LOCK";?>
									<td id="<?=$el?>" class="editable"  colspan=4 ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<td>броня:</td>
									<?$el = "ARMOR_BOTT";?>
									<td id="<?=$el?>" class="editable"  colspan=2 ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<td>цил.:</td>
									<?$el = "SIZE_CYLLINDRE_BOTT";?>
									<td id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<?$el = "SIZE_CYLLINDRE_SECOND_BOTT";?>
									<td id="<?=$el?>" class="editable"  colspan=2 ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
								</tr>
								<tr>
									<td colspan=2 >РУЧКИ</td>
									<?$el = "HANDS";?>
									<td id="<?=$el?>" class="editable"  colspan=6 ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<td>глазок:</td>
									<?$el = "GLASS";?>
									<td id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<?$el = "GLASS_HEIGHT";?>
									<td id="<?=$el?>" class="editable"  colspan=5 ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
								</tr>
								<tr>
									<td colspan=4 >НАЛИЧНИК</td>
									<td>ЛЕВ -</td>
									<?$el = "LEFT_NAL";?>
									<td id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<td>ВЕРХ -</td>
									<?$el = "TOP_NAL";?>
									<td id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<td>ПРАВ -</td>
									<?$el = "RIGHT_NAL";?>
									<td id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<td colspan=2>НАЛИЧНИК МДФ</td>
									<?$el = "NAL_MDF";?>
									<td id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									<?$el = "LOGO";?>
									<td colspan=4 id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
								</tr>
								<tr>
									<td colspan=4 rowspan=2 >СНАРУЖИ</td>
									<?$el = "OUTSIDE";?>
									<td colspan=13 id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									</tr>
								<tr>
									<td colspan=13></td>
									</tr>
								<tr>
									<td colspan=4 rowspan=2>ВНУТРИ</td>
									<?$el = "INSIDE";?>
									<td colspan=13 id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
								</tr>
								<tr>
									<td colspan=13 ></td>
								</tr>
								<tr>
									<td colspan=4 rowspan=3 >ОКРАСКА</td>
									<td colspan=2 >ДВЕРНОЙ БЛОК:</td>
									<?$el = "DOOR_BLOCK";?>
									<td colspan=11 id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
								</tr>
								<tr>
									<td colspan=2 >ПАНЕЛЬ:</td>
									<?$el = "PANEL";?>
									<td colspan=11 id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									</tr>
								<tr>
									<td colspan=2>РЕШЕТКА:</td>
									<?$el = "RESHETKA_POKRYTIE";?>
									<td colspan=11 id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									</tr>
								<tr>
									<td colspan=4>ПРИМЕЧ.</td>
									<?$el = "PRIMECH";?>
									<td colspan=13 id="<?=$el?>" class="editable" ><input name="<?=$el?>" class="<?=$el?>" value="<?=$arr[$el]["VALUE"]?>"><?if($arr[$el]["TOOLTIP"]) { ?><span class="tooltip"><?=$arr[$el]["TOOLTIP"]?></span> <? } ?></td>
									</tr>
								<tr>
									<td colspan=4 >ОФОРМИЛ</td>
									<td colspan=2 >                            </td>
									<td colspan=11 >20        г.  Подпись:</td>
									</tr>
								<tr>
									<td colspan=4 >ГОТОВНОСТЬ</td>
									<td colspan=5 >"                            "   20        г.     Подпись:</td>
									<td colspan=8 ></td>
									</tr>
							</table>
							</form>
				</div>
				<div class="end_constr">
					<button class="addZayavka" onclick="addZayavka(); return false;" type="submit">Добавить в заявку</button>
					<a href="" onclick="DownloadExcel(); return false;" class="exel exelDownload">Сохранить в exel</a>
					<a href="" class=" print">Распечатать</a>
				</div>
			</div>
		
		<div class="popup clearfix" id="contura">
			<div class="circ">Два контура</div>
			<div class="circ">Три контура</div>
			<div class="text">
				<h3>Количество контуров</h3>
				<p>Основное назначение контура уплотнения - обеспечение максимального плотного прилегания дверного полотна к коробу для дополнительной теплоизоляции и звукоизоляции, а также защиты от проникновения запахов. Двери с двумя контурами уплотнения подходят для установки в квартиру, не имеющего прямого выхода на улицу, с тремя - на границе улица-дом.</p>
				<button class="return">Вернуться назад</button>
			</div>	
		</div>
		
		<?foreach($arResult["POPUPS"]["FURNS"] as $k=>$Item) { ?>
		
		<div class="popup clearfix" id="furn_detail<?=$k?>">
			<p class="img"><img src="<?=$Item["SRC"]?>" alt=""></p>
			<div class="text">
				<h3><?=$Item["NAME"]?></h3>
				<?=$Item["TEXT"]?>
				<table>
					<?foreach($Item["PROPS"] as $prop) { ?>
					<tr>
						<td><?=$prop["NAME"]?></td>
						<td><?=$prop["TEXT"]?></td>
					</tr>
					<? } ?>
				</table>
			</div>
			<button class="return">Вернуться назад</button>
		</div>
		<? } ?>
		<div class="popup clearfix" id="furn_detailLbZrDbME">
			<p class="img"><img src="/upload/iblock/c52/c52ab4c5cac84d4372aedf90f9f20c61.jpg" alt=""></p>
			<div class="text">
				<h3>Ручка Hope</h3>
				<p>Ручка Hoppe сделана из латуни, устанавливается с ключевыми розетками.</p>
			</div>
			<button class="return">Вернуться назад</button>
		</div>
		
		<div class="popup clearfix" id="furn_detailw5LpeVWy">
			<p class="img"><img src="/upload/iblock/4c0/4c0a69f4d6b1a9184220151d2c0d79f1.jpg" alt=""></p>
			<div class="text">
				<h3>Ручка Crit</h3>
				<p>Crit – это раздельные ручки на фланце. Покрытие на них наносятся не единовременно, а поэтапно, что позволяет придать ручке особый цвет и защитные свойства.</p>
			</div>

			<button class="return">Вернуться назад</button>
		</div>
		
		<div class="popup clearfix" id="furn_cilynderReQMlvQj">
			<p class="img"><img src="/upload/iblock/ba6/ba69ce225e00ee589ee67b0a28f30452.jpg" alt=""></p>
			<div class="text">
				<h3>Цилиндр Kale c ручкой</h3>
				<p>Kale 164 B – это евроцилиндр, оснащённый поворотной ручкой. 10 комбинативных пинов из латуни обеспечивают 5 миллионов комбинаций, тем самым предотвращая открытие методом подбора кода. Цилиндр имеет специальные защитные стержни, которые противостоят высверливанию.</p>
			</div>
		</div>
		
		<div class="popup clearfix" id="furn_cilynder9penXp5y">
			<p class="img"><img src="/upload/iblock/e73/e73c1cf17fdcc712c54dc395e097b7d4.jpg" alt=""></p>
			<div class="text">
				<h3>Цилиндр Kale без поворотной ручки</h3>
				<p>Цилиндр имеет специальные защитные стержни, которые противостоят высверливанию.</p>
			</div>
			<button class="return">Вернуться назад</button>
		</div>
		
		<div class="popup clearfix" id="dop138">
			<p class="img"><img src="/upload/iblock/e98/e9838e97c736fd317e79e4c0231de971.jpg" alt=""></p>
			<div class="text">
				<h3>Верхний замок Kale 257L (сувальдный)</h3>
				<p>Kale 257L – это сувальдный замок 3-его класса безопасности. Сувальды имеют специальные ловушки, которые препятствуют вскрытию при помощи отмычек.</p>
			</div>
			<button class="return">Вернуться назад</button>
		</div>
		<div class="popup clearfix" id="dop139">
			<p class="img"><img src="/upload/iblock/f97/f97fbbd8490e0b8360718314aaa6144a.png" alt=""></p>
			<div class="text">
				<h3>Верхний замок Kale 257R (цилиндровый)</h3>
				<p>Kale 257 R – это цилиндровый замок, имеющий четвёртый класс безопасности. Надёжно защищён от высверливания и фрезерования, а также вбивания внутрь ригелей. Конструктивные особенности замка гарантируют надёжную и безотказную работу на долгие года.</p>
			</div>
			<button class="return">Вернуться назад</button>
		</div>
		
		<div class="popup clearfix" id="dop140">
			<p class="img"><img src="/upload/iblock/186/1867160684c331bd9f7049842f3a8da1.jpg" alt=""></p>
			<div class="text">
				<h3>Нижний замок Kale 252R</h3>
				<p>Kale 252R – это цилиндровый замок, который имеет 4-ый (высший) класс безопасности. Защищён от фрезерования и сверления, имеет три ригеля и защёлку. Трехшаговый механизм облегчён подшипником, что смягчает поворот ключа и продлевает срок службы замка.</p>
			</div>
			<button class="return">Вернуться назад</button>
		</div>
		<div class="popup clearfix" id="dop152">
			<p class="img"><img src="/upload/iblock/b88/b8880a22e2281f8e917e50acaece522f.jpg" alt=""></p>
			<div class="text">
				<h3>Ночная задвижка Apecs</h3>
				<p>Врезная ночная задвижка с поворотной ручкой – это надежный элемент блокировки двери изнутри. При желании покупателя ночную задвижку можно не устанавливать.</p>
			</div>
			<button class="return">Вернуться назад</button>
		</div>
		<div class="popup clearfix" id="dop153">
			<p class="img"><img src="/upload/iblock/2e6/2e61ad5c2d6801c79bd7ecb795b4fdb5.jpg" alt=""></p>
			<div class="text">
				<h3>Девиатор Securemme</h3>
				<p>Девиаторы Securemme защищают от силового взлома, а также позволяют укрепить сторону двери в нижней или в верхней части. В комплект входят два девиатора. Движение механизма происходит от замка, через тяги.</p>
			</div>
			<button class="return">Вернуться назад</button>
		</div>
		
		<div class="popup clearfix" id="dop156">
			<p class="img"><img src="/upload/iblock/f0e/f0e4682fbf7f385b4b811546b156a423.jpeg" alt=""></p>
			<div class="text">
				<h3>Замок Mottura</h3>
				<p>Mottura – это уникальный замок с системой перекодировки, имеющий 4-ый класс безопасности. Нуклео укомплектован шестью сувальдами, стойка хвостовика имеет твёрдосплавный выстроенный шарик, который защищает от высверливания, вскрытия отмычками и другими способами.</p>
			</div>
			<button class="return">Вернуться назад</button>
		</div>
		
		<div class="popup clearfix" id="dop157">
			<p class="img"><img src="/upload/iblock/c9f/c9f0a5501719af89522603c9b66906c3.PNG" alt=""></p>
			<div class="text">
				<h3>Замок Mul-t-lock Omega</h3>
				<p>Mul-t-lock Omega – это двухсистемный итальянский замок, который подходит для бронированных и стальных дверей. Центральная часть представлена роторным механизмом, число секретных комбинаций которого превышает 10 миллионов. </p>
			</div>
			<button class="return">Вернуться назад</button>
		</div>

		
		<div class="popup clearfix" id="dop_paramsGERK">
			<p class="img"><img src="/upload/iblock/6e3/6e3e646f056f48d4a4a50d14afcbe615.jpg" alt=""></p>
			<div class="text">
				<h3>Геркон</h3>
				<p>Геркон – это магнитоуправляемый контакт, содержащий в себе пару гибких ферромагнитных контактов из металла. Он является надёжным извещателем, использующимся в охранных сигнализациях, абсолютно безопасен для людей и животных, так как не имеет излучения.</p>
			</div>
			<button class="return">Вернуться назад</button>
		</div>
		<div class="popup clearfix" id="dop_paramsDOVOD">
			<p class="img"><img src="/upload/medialibrary/d82/d82f82ccf0a194a6b38d1c50c43e43d8.png" alt=""></p>
			<div class="text">
				<h3>Доводчик</h3>
				<p>Это механическое устройство, которое отвечает за автоматическое закрывание дверей, тем самым уменьшая степень износа петель и другой фурнитуры.</p>
			</div>
			<button class="return">Вернуться назад</button>
		</div>
		<div class="popup clearfix" id="dop_paramsNAKL">
			<p class="img"><img src="/upload/iblock/334/3343c560ff1e5f40faf7b93012d43c63.png" alt=""></p>
			<div class="text">
				<h3>Накладка на порог</h3>
				<p>Порог из нержавеющей стали очень долговечен, не подвержен механическим повреждениям, а также является прекрасным термомостом от промерзания двери и дополнительным декоративным элементом.</p>
			</div>
			<button class="return">Вернуться назад</button>
		</div>
		<div class="popup clearfix" id="dop_paramsSTOR">
			<!--p class="img"><img src="/upload/iblock/e73/e73c1cf17fdcc712c54dc395e097b7d4.jpg" alt=""></p-->
			<div class="text">
				<h3>Сторона открывания</h3>
				<p>На этапе замера вы можете выбрать сторону открывания двери, которая определяется по расположению петель.</p>
			</div>
			<button class="return">Вернуться назад</button>
		</div>
		<div class="popup clearfix" id="dop_paramsGLAZZ">
			<!--p class="img"><img src="/upload/iblock/e73/e73c1cf17fdcc712c54dc395e097b7d4.jpg" alt=""></p-->
			<div class="text">
				<h3>Глазок</h3>
				<p>Дверной глазок Apecs обеспечивает чёткое изображение всех предметов, сделан из латуни, оптика - из качественного пластика. Есть шторка.</p>
			</div>
			<button class="return">Вернуться назад</button>
		</div>
		

	
	<div class="popup" id="colors_door3">
		<h3>Экошпон</h3>
		<p>В последнее время главным трендом дизайна интерьеров является экологичность и эстетичность, поэтому для покрытия дверей нередко выбирают экошпон.</p>
		<p class="blue">Экошпон - это высококачественное искусственное покрытие, которое воспроизводит фактуру и рисунок настоящей древесины, являясь прекрасным выбором для квартирных дверей. Оно состоит из древесных волокон и инновационного полимера – полипропилена, абсолютно безопасного для здоровья.</p>
		<p>Внешне и на ощупь экошпон практически не отличим от натурального дерева, не выделяет вредных веществ даже под прямыми солнечными лучами. Помимо этого, покрытие очень долговечно, а также устойчиво к легким царапинам, сколам и другим видам механических повреждений.</p>
		<p>Экошпон обладает влагостойкостью, устойчив к образованию плесени и грибка, прекрасно переносит чистку с помощью бытовых моющих средств, не впитывает загрязнений, не выгорает на солнце, не трескается и не отслаивается.</p>
		<button class="return">Вернуться назад</button>
	</div>
	<div class="popup" id="colors_door1">
		<h3>Винорит</h3>
		<p>Стойкое антивандальное покрытие Vinorit используется для наружной отделки дверей, потому как является прекрасным примером сочетания прочности, эстетичности, экологичности и долговечности. Покрытие имитирует структуру натурального дерева, может служить защитой MDF-панелей, на которые нанесена глубокая фрезеровка.</p>
		<p class="blue">Компания Kibbutz Нaogen была создана в 1952 году в Израиле и является одним из лидеров в производстве ПВХ пленок, которые используются для ламинирования различных элементов.</p>
		<p>Двери с покрытием Vinorit подходят для установки на границе улица-дом, потому как обеспечивают надежную защиту от ультрафиолета, не подвержены выцветанию и воздействию атмосферных явлений. Помимо всего прочего, имеется защита от легких механических повреждений, а все качественные показатели сохраняются десятки лет.</p>
		<p>Покрытие отличается особой стойкостью, а потому двери могут быть установлены в морском климате или тропиках. Оно не выделяет вредных веществ, а благодаря особому внешнему слою покрытия позволяет применять патинирование (искусственное состаривание) дверных панелей.</p>
		<p>Покрытие Vinorit прошло сертификацию по различным стандартам качества, в том числе ISO 9001:2000, Din - немецкого института по стандартизации, а также SKZ - сертификат Независимого европейского южно-германского научно-исследовательского центра пластических масс SKZ и пр.</p>
		<button class="return">Вернуться назад</button>
	</div>
	<div class="popup" id="colors_door2">
		<h3>ПВХ</h3>
		<p>ПВХ - это поливинилхлоридное покрытие, обладающее отличной устойчивостью к скачкам температур и изменениям влажности воздуха. Оно экологичное, легко чистится и долгое время сохраняет свой первоначальный вид. </p>
		<p class="blue">Важным достоинством данного вида покрытия является устойчивость к разного рода повреждениям. Двери, покрытые ПВХ, не рассыхаются, а потому надёжно защищают ваш дом долгие годы.</p>
		<p>Многообразие цветов и фактур в сочетании с демократичной ценой и первоклассным качеством делают данное покрытие одним из самых популярных среди покупателей.</p>
		<button class="return">Вернуться назад</button>
	</div>
	<div class="popup" id="colors_door4">
		<h3>Краска</h3>
		<p>Использование итальянских лаков и красок гарантирует стойкость к атмосферным явлениям, а также долговечность в сочетании с первозданным внешним видом.</p>
		<p class="blue">Вы можете не волноваться о безопасности своих родных и близких, потому как используемые материалы не выделяют вредных веществ, прошли различные тестирования и получили европейские гигиенические сертификаты. Краска обладает высокой механической прочностью и износостойкостью.</p>
		<p>Благодаря своим свойствам, двери, покрытые итальянской краской, могут быть установлены на границе улица-дом даже в суровых климатических условиях.</p>
		<button class="return">Вернуться назад</button>
	</div>
	<div class="popup" id="colors_door5">
		<h3>Металл</h3>
		<p>Металлические конструкции окрашиваются с помощью порошково-полимерного покрытия на основе полиэфиров. Данный метод позволяет создать долговечное покрытие, защищающее ваш дом даже при самых суровых погодных условиях.</p>
		<p class="blue">Полимерное покрытие обладает высокой устойчивостью к истиранию, воздействию УФ-лучей и перепадов температур. В то же время, оно не выделяет вредных веществ, а потому абсолютно безопасно для людей и домашних животных.</p>
		<p>Если сравнивать данное покрытие с другими промышленными красками, то оно идет на шаг впереди по показателям устойчивости и прочности. Благодаря 100%-ой окраске металлических поверхностей дверей внутри и снаружи, обеспечивается максимальная защита стали от неблагоприятных погодных условий.</p>
		<button class="return">Вернуться назад</button>
	</div>
	<div class="popup" id="colors_door6">
		<h3>Портвуд</h3>
		<p>"Портвуд" - это высококачественная многослойная панель, состоящая из верхнего слоя шпона дуба и африканского дерева сейба. Данный материал обладает несомненными преимуществами перед деревом - имеет большую устойчивость к влажности и перепадам температур. Подходит для установки на границе улица-дом, способен выдерживать агрессивные атмосферные явления. </p>
		<p class="blue">Особенность и уникальность "Портвуда" в полной мере раскрывается при фрезеровке, когда становится виден внутренний слой дерева, создающий впечатление настоящего массива дуба.</p>
		<p>Панель имеет более низкую стоимость, нежели панель из массива дуба, а потому является прекрасной альтернативой для ценителей прекрасного.</p>
		<button class="return">Вернуться назад</button>
	</div>
	<? } ?>
</div>