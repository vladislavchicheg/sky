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
<div class="container col-md-12">
    <h2><?= $arResult['NAME'] ?></h2>

    <div class="row liza">

        <? foreach ($arResult["ITEMS"] as $arItem):
        $item = new arItem($arItem);


        ?>
        <div class="col-md-4 col-sm-6 col-xs-6 lizo-item" id="<?= $item->area($this) ?>">
            <div class="lizo-img"><img alt="" title="" src="<?=$item->getPreview()?>"/></div>
            <div class="lizo-txt">
                <h4><?=$item->name()?></h4>
                <ul>
                    <li><?=$item->_('dolg')?></li>
                    <li><a href="<?=$item->_('email')?>"><?=$item->_('email')?></a></li>
                    <li><?=$item->_('tel')?></li>
                </ul>
            </div>
        </div>
        <?endforeach?>



    </div>
</div>
