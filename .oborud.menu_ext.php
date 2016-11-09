<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
    "IS_SEF" => "N",
    "ID" => $_REQUEST["ID"],
    "IBLOCK_TYPE" => "tehnic",
    "IBLOCK_ID" => "10",
    "SECTION_URL" => "",
    "DEPTH_LEVEL" => "2",
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600"
),
    false
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>
