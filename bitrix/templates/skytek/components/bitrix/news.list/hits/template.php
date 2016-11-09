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

    <div class="main__item wrapper">
        <h2>

            Хиты продаж
        </h2>

        <div class="main__item_group">
            <? foreach ($arResult["ITEMS"] as $k=>$arItem):
                $item = new arItem($arItem);

                ?>
                <?IF ($k<4){?>
                <div class="hits">

                    <div class="hits__name"><?= $item->name() ?></div>
                    <div style="background: url('<?= $item->getDetail() ?>') no-repeat center" class="hits__item"></div>
                    <div class="hits__links">
                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>" title="Подробнее" class="hits__links_link">Подробнее</a>
                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>" title="Заказать" class="hits__links_button but1">заказать</a>
                    </div>

                </div>
            <?}?>
            <? endforeach; ?>
        </div>
    </div>


