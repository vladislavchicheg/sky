<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?><div class="resh container col-md-12">
	<h2><?=$arResult['NAME']?></h2>

	<div class="row">
		<? foreach ($arResult["ITEMS"] as  $arItem):
		$item = new arItem($arItem);
		?>
		<div class="item-resh col-md-4" id="<?= $item->area($this) ?>">
			<div class="plah">
				<h3><?=$item->name()?></h3>

				<div class="prc"><?=$item->_('price')?> ₽</div>
			</div>
			<ul>


				<? foreach ($arItem['PROPERTIES']['preim']["VALUE"] as $k=>$value) {?>

					<li class="<?=$arItem['PROPERTIES']['preim']['DESCRIPTION'][$k]?>"><?=$value?></li>
				<?} ?>
			</ul>
			<div class="container row more">
				<div class="col-md-6 col-sm-6 col-xs-6"><a href="<?=$item->_('link')?>" title="more">Подробнее</a></div>
				<div class="col-md-6 col-sm-6 col-xs-6"><a class="but1" id="zam" href="#myModal2" data-toggle="modal" title="<?=$item->name()?>">Заказать</a></div>
			</div>
		</div>
		<?endforeach; ?>

	</div>
	<div class="clr"></div>
	<div class="textik col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
		<p>
			<? $APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => SITE_TEMPLATE_PATH . "/includes/preform1.php",
					"EDIT_TEMPLATE" => ""
				),
				false
			);?>
		</p>
	</div>
</div>