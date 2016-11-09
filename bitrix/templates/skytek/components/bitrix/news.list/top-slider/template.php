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


<div class="slider">
    <div id="carousel-example-generic" data-ride="carousel" class="carousel slide">


        <div class="carousel-inner">
            <? foreach ($arResult["ITEMS"] as $key => $arItem):
                $item = new arItem($arItem);
                ?>
                <div id="<?= $item->area($this) ?>" class="item <? if ($key == 0) {
                    echo 'active';
                } ?>">
                    <? if ($item->_('link')) { ?>
                        <a href="<?= $item->_('link') ?>" title="">
                        <? } ?>
                            <img src="<?= $item->getPreview() ?>" alt="<?= $item->name() ?>" title="<?= $item->name() ?>"/>
                    <? if ($item->_('link')) { ?>
                        </a>
                    <? } ?>
                </div>

            <? endforeach ?>
        </div>


        <ol class="carousel-indicators">
            <? foreach ($arResult["ITEMS"] as $key => $arItem):
                $item = new arItem($arItem);
                ?>
                <li data-target="#carousel-example-generic" data-slide-to="<?= $key ?>" class="<? if ($key == 0) {
                    echo 'active';
                } ?>"></li>

            <? endforeach ?>
        </ol>
    </div>
</div>
<div class="clr"></div>
