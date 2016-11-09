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
?><div class="preim container col-md-12">
	<h2><?=$arResult['NAME']?></h2>

	<div class="textik col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
		<p>
		<? $APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_TEMPLATE_PATH . "/includes/preim1.php",
				"EDIT_TEMPLATE" => ""
			),
			false
		);?>
		</p>
	</div>
	<div class="clr"></div>
	<div class="row">
		<div class="col-md-5 nik">
			<div class="cup"><img alt="" title="" src="<?= SITE_TEMPLATE_PATH ?>/images/cup.png"/></div>
			<div class="wrn">
				<? $APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_TEMPLATE_PATH . "/includes/preim2.php",
						"EDIT_TEMPLATE" => ""
					),
					false
				);?>
			</div>
		</div>
		<div class="col-md-6 col-md-offset-1 preim-items">

			<? foreach ($arResult["ITEMS"] as  $arItem):
			$item = new arItem($arItem);
			?>
			<div class="preim-item row" id="<?= $item->area($this) ?>">
				<div class="num col-md-1 col-sm-1 col-xs-1"><?=$item->_('number')?></div>
				<div class="preim-item-text col-md-11 col-sm-11 col-xs-10">
					<h3><?=$item->name()?></h3>

					<p><?=$item->getPreviewText()?></p>
				</div>
			</div>
			<?endforeach?>
			<div class="wrn2">
				<? $APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_TEMPLATE_PATH . "/includes/preim3.php",
						"EDIT_TEMPLATE" => ""
					),
					false
				);?>
			</div>
		</div>
	</div>
</div>