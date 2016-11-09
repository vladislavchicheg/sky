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

<div id="bg1" class="bg">
    <div class="wrapper">
        <div class="container col-md-12">
            <h2><?=$arResult['NAME']?></h2>
        </div>
        <div class="row">
            <? foreach ($arResult["ITEMS"] as $arItem):
            $item = new arItem($arItem);
            ?>
            <div class="col-md-3" id="<?= $item->area($this) ?>">
                <div class="circle-container">
                    <div data-dimension="200" data-text="<?=$item->_('number')?>" data-width="10" data-fontsize="<?=$item->_('font')?>"
                         data-percent="<?=$item->_('prc')?>" data-fgcolor="#6189ef" data-bgcolor="#eee" data-fill="#0f1e35"
                         class="circlestat"></div>
                </div>
                <h3><?=$item->name()?></h3>
            </div>
            <?endforeach?>
        </div>
    </div>
</div>












