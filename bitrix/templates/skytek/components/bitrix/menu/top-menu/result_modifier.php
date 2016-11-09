<?$aItems = array();
$aParentItem = false;

foreach( $arResult as $aItem ) {
if( $aItem["DEPTH_LEVEL"] == 1 ) {
if( $aParentItem && ( $aParentItem["PERMISSION"] !== "D" ) ) {
$aItems[] = $aParentItem;
$aParentItem = $aItem;
}
else $aParentItem = $aItem;
}

if( ( $aItem["DEPTH_LEVEL"] == 2 ) && ( $aParentItem["PERMISSION"] !== "D" ) ) {
$aParentItem['CHILDREN'][] = $aItem;
}
}
$aItems[] = $aParentItem;

$arResult = $aItems;?>