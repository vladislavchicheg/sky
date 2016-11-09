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
<h2 class="serts-zgl"><?= $arResult['NAME'] ?></h2>
<ul class="nav-tabs">
<? foreach ($arResult["ITEMS"] as $k=>$arItem):
$item = new arItem($arItem);


?>


        <li class="<?if($k==0){echo'active';}?>"><a data-toggle="tab" href="#<?=$item->id()?>"><?=$item->name()?></a></li>




<?endforeach?>
    </ul>
</div>

<div class="tab-content">
<? foreach ($arResult["ITEMS"] as $k=>$arItem):
$item = new arItem($arItem);

?>
    <div id="<?=$item->id()?>" class="tab-pane fade<?if($k==0){echo' in active';}?>">
        <div id="<?= $item->area($this) ?>" >
<div class="wrapper">
            <div class="row">
                <div class="col-lg-3">
                    <h3 class="kont-zgl">Офис:</h3>
                    <div class="kont-in-item">
                    <?
                        if($item->_('ofisadres')){
                    ?>
                        <div class="kont-in-item">
                            <div class="zagl">
                                <img src="<?=SITE_TEMPLATE_PATH?>/images/metka.png" alt=""/> <span>Адрес:</span>
                            </div>
                            <?=$arItem['PROPERTIES']['ofisadres']["~VALUE"]["TEXT"]?><br>
                            <?
                            if($item->_('email')){
                            ?>
                                <b>e-mail: </b><a href="mailto:<?=$item->_('email')?>"> <?=$item->_('email')?></a>
                            <?}?>
                        </div>
                    <?}?>
                    </div>

                    <div class="kont-in-item">
                        <?
                        if($item->_('ofistel')){
                            ?>
                            <div class="kont-in-item">
                                <div class="zagl">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/images/tel66.png" alt=""/> <span>Телефон:</span>
                                </div>
                                <?=$item->_('ofistel')?><br>

                            </div>
                        <?}?>
                    </div>
                    <div class="kont-in-item">
                        <?
                        if($item->_('ofistime')){
                            ?>
                            <div class="kont-in-item">
                                <div class="zagl">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/images/time66.png" alt=""/> <span>Режим работы:</span>
                                </div>
                                <?=$arItem['PROPERTIES']['ofistime']["~VALUE"]["TEXT"]?>


                            </div>

                        <?}?>
                    </div>
                    <div class="kont-in-item">
                        <a href="<?=CFile::GetPath($arItem["PROPERTIES"]["filo"]["VALUE"]);?>" target="_blank" class="but1">Скачать карту партнера</a>
                    </div>
                </div>
                <?
                if($item->_('madres')){
                ?>
                <div class="col-lg-3 col-lg-offset-2">

                    <h3 class="kont-zgl">Мастерская:</h3>
                    <div class="kont-in-item">

                            <div class="kont-in-item">
                                <div class="zagl">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/images/metka.png" alt=""/> <span>Адрес:</span>
                                </div>
                                <?=$arItem['PROPERTIES']['madres']["~VALUE"]["TEXT"]?><br>

                            </div>

                    </div>
                    <div class="kont-in-item">
                        <?
                        if($item->_('mtel')){
                            ?>
                            <div class="kont-in-item">
                                <div class="zagl">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/images/tel66.png" alt=""/> <span>Телефон:</span>
                                </div>
                                <?=$item->_('mtel')?><br>

                            </div>
                        <?}?>
                    </div>
                    <div class="kont-in-item">
                        <?
                        if($item->_('mtime')){
                            ?>
                            <div class="kont-in-item">
                                <div class="zagl">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/images/time66.png" alt=""/> <span>Режим работы:</span>
                                </div>
                                <?=$arItem['PROPERTIES']['mtime']["~VALUE"]["TEXT"]?>


                            </div>

                        <?}?>
                    </div>

                </div>
                <?}?>
                <div class="col-lg-3 col-lg-offset-1">
                    <div class="kont-stat">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH . "/includes/kont-stat.php",
                                "EDIT_TEMPLATE" => ""
                            ),
                            false
                        );?>
                    </div>

                </div>

            </div>
        </div>
        <div class="clr"></div>
        </div>
        <div class="mapa">


            <div>
                <div class="opismap">

                    <h2>Контакты:</h2>
                   <p> <?=$arItem['PROPERTIES']['adresblue']["~VALUE"]["TEXT"]?>
                    </p><a href="#myModal" data-toggle="modal" title="заказать звонок" class="but1">Заказать звонок</a>
                </div>
                <?=$arItem['PROPERTIES']['map']["~VALUE"]["TEXT"]?>

            </div>
        </div>
    </div>
<?endforeach?>

</div>
<div id="dosta" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

            </div>
            <div class="modal-body">

                <h2>Условия доставки</h2>



                        <div class="col-md-12">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_TEMPLATE_PATH . "/includes/kont-dost.php",
                                    "EDIT_TEMPLATE" => ""
                                ),
                                false
                            );?>

                        </div>


            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>