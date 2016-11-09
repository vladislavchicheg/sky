<?php
$rsSections = CIBlockSection::GetList(array('SORT' => "ASC"), array('IBLOCK_ID' => $arParams['IBLOCK_ID']), false, array('NAME','DESCRIPTION','ID','PICTURE','UF_NAME'));
$sections = array();
while ($a = $rsSections->GetNext()) {
    $sections[$a['ID']] = $a;
}
$arResult['SECTIONS'] = array();
$sort = array();
foreach ($arResult['ITEMS'] as $arItem) {
    if (!$arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]) {
        $section = $sections[$arItem['IBLOCK_SECTION_ID']];
        $arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']] = $section;
        $sort[$section['ID']] = $section['SORT'];
        $arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['ITEMS'] = array();
    }
    $arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;
}

array_multisort($sort, SORT_ASC, $arResult['SECTIONS']);