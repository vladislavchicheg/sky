<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<h2 class="serts-zgl"><?=$arResult['NAME']?></h2>

    <div class="slick11">
        <? foreach ($arResult["ITEMS"] as $key => $arItem):
        $item = new arItem($arItem);
        ?>
            <div id="<?= $item->area($this) ?>" class="serts-item">
                <a href="<?=$item->getDetail()?>" class="fancybox" rel="<?=$arResult['ID']?>">
                    <img src="<?=$item->getPreview()?>" alt="<?=$item->name()?>" title="<?=$item->name()?>" />
                </a>
            </div>
        <?endforeach?>

    </div>

</div>
