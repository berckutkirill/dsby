<?
$hblock = GetHBlock(5);
?>
<section class="dop">
			<div class="wrap">
				<h2>На стоимость входной двери влияют</h2>
				<ul>
					<?foreach($hblock as $item):?>
					<li>
						<h3><?=$item["UF_NAME"]?></h3>
						<img src="<?=CFile::GetPath($item["UF_FILE"])?>" alt="<?=$item["UF_NAME"]?>">
						<div class="back">
							<div class="inner">
								<h4><?=$item["UF_NAME"]?></h4>
								<p><?=$item["UF_DESCRIPTION"]?></p>
							</div>
						</div>
					</li>
					<?endforeach;?>
				</ul>
			</div>
		</section>