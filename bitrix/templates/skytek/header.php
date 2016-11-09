<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
<!DOCTYPE html>
<html>
<head>
<title><? $APPLICATION->ShowTitle(); ?></title>
    <? $APPLICATION->ShowHead(); ?>
    
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic,900,900italic,100italic,100&amp;subset=latin,cyrillic-ext,latin-ext,cyrillic"
        rel="stylesheet" type="text/css">

    <? $APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . '/css/reset.css'); ?>
    <? $APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . '/css/bootstrap.css'); ?>
    <? $APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . '/css/main.css'); ?>
    <? $APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . '/css/style.css'); ?>
    <? $APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . '/css/slicknav.css'); ?>
    <? $APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . '/slick/slick.css'); ?>
    <? $APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . '/slick/slick-theme.css'); ?>
    <? $APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . '/fancybox/jquery.fancybox.css'); ?>
    <? $APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . '/css/animate.css'); ?>
    <? $APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . '/css/jquery.circliful.css'); ?>
    <? $APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . '/css/bootstrap_col_15.css'); ?>
    <? ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery-2.0.3.min.js'); ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/bootstrap.min.js'); ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/slick/slick.min.js'); ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/fancybox/jquery.fancybox.js'); ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.maskedinput.min.js'); ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/sstu_script.js'); ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/times.js'); ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.circliful.min.js'); ?>


</head>
<body>
<div id="panel">
    <? $APPLICATION->ShowPanel(); ?>
</div>
<a href="#" class="left_swap"></a>
<header>
    <div class="wrapper">
        <div class="header raw col-md-12">
            <div class="logo col-md-2 col-sm-2 col-xs-3"><a href="/" title="На главную"><img alt="тахографы уфа" title="купить тахограф" src="<?=SITE_TEMPLATE_PATH?>/images/logo.png"/></a></div>
            <div class="slogan col-md-3 col-sm-4 col-xs-3">
                <p class="t25">

                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH . "/includes/top-descript.php",
                            "EDIT_TEMPLATE" => ""
                        ),
                        false
                    ); ?>

                </p>
            </div>
            <div class="timen t25 col-md-3 col-sm-4 col-xs-3">
                <div class="curtime"></div><span class="time">9:00</span>
                <div class="longa"><span class="longa-fill"></span></div><span class="time">18:00</span>
                <div class="clr"></div>
                <div class="probki"><a href="#!" title="">График работы</a></div>
            </div>
            <div class="ssilki col-md-2 col-sm-3 col-xs-3 t25">
                <div class="formochki">
                    <div class="forma1"><a href="#myModal3" data-toggle="modal">Задать вопрос</a></div>
                    <div class="forma2"><a href="#myModal" data-toggle="modal" title="заказать звонок">Заказать звонок</a></div>
                </div>
            </div>
            <div class="phones t25 col-md-2 col-sm-3 col-xs-4">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_TEMPLATE_PATH . "/includes/top-phones.php",
                        "EDIT_TEMPLATE" => ""
                    ),
                    false
                );?>

            </div>
        </div>
        <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top-menu", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "2",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "top",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => "top-menu",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>

        <div class="touch-menu">
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "mobile-menu",
                array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(
                    ),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "top",
                    "USE_EXT" => "N",
                    "COMPONENT_TEMPLATE" => "mobile-menu"
                ),
                false
            );?>
        </div>
        <div class="clr"></div>
    </div>
</header>
<main>
    <?$curPage = $APPLICATION->GetCurPage(true);?>
    <?if ($curPage != SITE_DIR."index.php"):?>
        <div class="wrapper">
    <?endif?>
						