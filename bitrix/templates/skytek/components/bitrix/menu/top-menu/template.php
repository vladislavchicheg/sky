<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>

<div class="menu-wrapper default">
    <ul class="menu">

        <? foreach( $arResult as $iIndex => $aItem ): ?>

            <li <?if( $aItem['SELECTED'] ){echo 'class="current"';} ?>><a href="<?=$aItem['LINK']?>"><?=$aItem['TEXT']?></a>

                <? if( !empty( $aItem['CHILDREN'] ) ): ?>
                    <ul class="sub">
                        <? foreach( $aItem['CHILDREN'] as $aChildItem ): ?>
                            <li><a href="<?=$aChildItem['LINK']?>"><?=$aChildItem['TEXT']?></a></li>
                        <? endforeach; ?>
                    </ul>
                <? endif; ?>
            </li>

        <? endforeach; ?>

    </ul>
</div>

<? endif; ?>