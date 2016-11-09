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
<div class="container">

<div class="main__item">
	<h1><?=$arResult['SECTION']['PATH'][0]['NAME']?></h1>
</div>


<div class="main__item_group">
	<? foreach ($arResult["ITEMS"] as $k=>$arItem):
	$item = new arItem($arItem);

	?>
	<div class="hits">

		<div class="hits__name"><?=$item->name()?></div>
		<div style="background: url('<?=$item->getPreview()?>') no-repeat center" class="hits__item"></div>
		<div class="hits__links">
			<div class="hits__name"><?=$item->_('price')?> руб</div>
			<a href="<?=$arItem['DETAIL_PAGE_URL']?>" title="Подробнее" class="hits__links_button but1">Подробнее</a>
		</div>

	</div>
	<?endforeach?>


</div>






<div class="main__item">
	<?=$arResult['SECTION']['PATH'][0]['DESCRIPTION']?>
</div>



</div>