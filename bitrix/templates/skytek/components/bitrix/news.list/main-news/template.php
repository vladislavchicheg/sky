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
<h2><?=$arResult['NAME']?></h2>
<ul class="news-list">
	<? foreach ($arResult["ITEMS"] as $k=> $arItem):
	$item = new arItem($arItem);


	?>
		<?if ($k < 4)?>
	<li class="news-item" id="<?= $item->area($this) ?>">
		<h5><a href="<?=$item->link()?>" title=""><?=$item->name()?></a></h5>

		<p>
			<?=$item->getPreviewText()?> <a href="<?=$item->link()?>"
																							  title="">Далее...</a>
		</p><span><?=$item->date()?></span>
	</li>
<?endforeach?>
</ul>