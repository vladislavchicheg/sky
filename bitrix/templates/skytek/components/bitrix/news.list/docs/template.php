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
<div class="wrapper">
    <div class="container col-md-12 docu">
        <h2><?= $arResult['NAME'] ?></h2>

        <div class="row">

            <? foreach ($arResult["ITEMS"] as $arItem):
            $item = new arItem($arItem);
                $fail = $item->_('failo');

            ?>

            <div class="doc-item col-md-6 col-sm-12 col-xs-12" id="<?= $item->area($this) ?>">
                <div class="doc-img">
                    <img alt="" title="" src="<?= SITE_TEMPLATE_PATH ?>/images/doc.png"/>
                </div>
                <div class="doc-txt">
                    <a href="<?
                        if ($item->_('failo')){echo $fail["SRC"];}
                        else {echo $item->_('link');}
                    ?>">
                        <?=$item->name()?>
                    </a>
                </div>
            </div>
<?endforeach?>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 row warn11">
            <div class="col-md-1 col-sm-2 col-xs-2">
                <div class="vznak">!</div>
            </div>
            <div class="col-md-11 col-sm-10 col-xs-10 warn-11-txt">
               <? $APPLICATION->IncludeComponent(
                   "bitrix:main.include",
                   "",
                   Array(
                       "AREA_FILE_SHOW" => "file",
                       "PATH" => SITE_TEMPLATE_PATH . "/includes/docs.php",
                       "EDIT_TEMPLATE" => ""
                   ),
                   false
               );?>
            </div>
        </div>
    </div>
</div>