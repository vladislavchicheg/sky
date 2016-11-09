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
</div>
<div class="solutions  bg">
	<div class="wrapper">

	<div class="solutions__title"><?=$arResult['NAME']?></div>
		<div class="solutions__item-list">
		<? foreach ($arResult["ITEMS"] as $k=> $arItem):
		$item = new arItem($arItem);


		?>


		<a href="<?=$item->link()?>" style="background-image: url('<?=$item->getPreview()?>')" class="solutions__item">
			<div class="solutions__item_name"><?=$item->name()?>
			</div>
		</a>



		<?endforeach?>
		</div>
	</div>
</div>










