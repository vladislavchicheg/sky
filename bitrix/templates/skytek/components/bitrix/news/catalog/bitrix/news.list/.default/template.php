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
		<? foreach ($arResult['SECTIONS'] as $k=>$arSection): ?>
			<div class="equipment__item col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="equipment__item_title" >
					<? $img = CFile::GetFileArray($arSection['PICTURE']);
					$res = CIBlockSection::GetByID($arSection['ID']);
					if($ar_res = $res->GetNext())
						$SectUrl = $ar_res['SECTION_PAGE_URL'];
					?>
					<a href="<?=$SectUrl?> " title="<?= $arSection['NAME'] ?>">
						<div class="eq-img" style="background-image: url('<?= $img['SRC'] ?>')">

					</div>



					<?= $arSection['NAME'] ?>
					</a>
				</div>
				<ul class="equipment__item_list">
					<? foreach ($arSection['ITEMS'] as $arItem){
						$item = new arItem($arItem);?>
						<li><a href="<?=$item->link()?>"><?=$item->name()?></a></li>
					<?}?>
				</ul>
			</div>
			<?if ($k==2){?>
				<div class="clearfix"></div>
			<?}?>
		<? endforeach ;?>
	</div>
</div>
