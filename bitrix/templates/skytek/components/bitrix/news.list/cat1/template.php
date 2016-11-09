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

<div class="equipment bg">
	<div class="equipment__list-item wrapper row">
		<? foreach ($arResult['SECTIONS'] as $arSection): ?>
		<div class="equipment__item col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="equipment__item_title" >
				<? $img = CFile::GetFileArray($arSection['PICTURE']) ?>
					<div class="eq-img" style="background-image: url('<?= $img['SRC'] ?>')"></div>



				<?= $arSection['NAME'] ?></div>
			<ul class="equipment__item_list">
			<? foreach ($arSection['ITEMS'] as $arItem){
				$item = new arItem($arItem);?>
				<li><a href="<?=$item->link()?>"><?=$item->name()?></a></li>
			<?}?>
			</ul>
		</div>
		<? endforeach ;?>
	</div>
</div>






