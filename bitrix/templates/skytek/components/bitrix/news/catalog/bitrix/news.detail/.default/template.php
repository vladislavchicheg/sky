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

<?
$item = new arItem($arResult);

?>
<div class="wrapper">
<div class="main__item">
	<h1><?=$item->name()?></h1>
</div>
<div class="main__item">
	<div class="product">
		<div class="product__img-box"><img src="<?=$item->getDetail()?>" alt="example"/></div>
		<div class="product__right">

			<div class="product__price"><?=$item->_('price')?>&nbsp;руб</div>
			<p><?=$item->getPreviewText()?></p>
			<div class="product__advantages">

				<? foreach ($arResult['PROPERTIES']['preim']["~VALUE"] as $k=>$value) { ?>
					<div class="product__advantages_item">
						<div class="product__advantages_icon-box">
							<?if (($k+1)%2 == 0){?>
							<img src="<?=SITE_TEMPLATE_PATH?>/images/advantages_2.png" alt="icon"/>
							<?} else {?>
							<img src="<?=SITE_TEMPLATE_PATH?>/images/advantages_1.png" alt="icon"/>
							<?}?>
						</div>
						<div class="product__advantages_info">
							<h1><?=$arResult['PROPERTIES']['preim']['DESCRIPTION'][$k]?></h1>
							<p><?=$value['TEXT']?></p>
						</div>
					</div>

				<?} ?>



			</div>
		</div>
		<form action="" method="post" class="product__form">
			<div class="product__form_legend">Воспользуйтесь специальным предложением</div>
			<input type="hidden" name="ztovar" value="<?=$item->name()?>"/>
			<input type="text" placeholder="Имя" name="zname" maxlength="183" class="product__form_input"/>
			<input type="tel" placeholder="Тел" name="ztel" maxlength="183" required="required" class="product__form_input"/>
			<button type="submit" class="but1">Заказать</button>
		</form>
	</div>
</div> 
<div class="main__item">
	<?=$item->getDetailText()?>
</div>


</div>