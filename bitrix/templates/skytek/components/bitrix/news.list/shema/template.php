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
?>
<div class="bg">
	<div class="wrapper">
		<div class="container col-md-12">
			<h2>Схема работы</h2>

			<div class="row shem">
				<? foreach ($arResult["ITEMS"] as $k=> $arItem):
				$item = new arItem($arItem);


				?>
				<div class="col15-md-3 col15-md-offset-0 col15-sm-15 shem-item" id="<?= $item->area($this) ?>">
					<img alt="" title="" src="<?=$item->getPreview()?>"/>
					<span><?=$item->name()?></span>
				</div>
<?endforeach?>
			</div>
		</div>
	</div>
</div>
