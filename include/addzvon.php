<?
define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_CHECK", true);
define('PUBLIC_AJAX_MODE', true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$_SESSION["SESS_SHOW_INCLUDE_TIME_EXEC"]="N";
$APPLICATION->ShowIncludeStat = false;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");



if ( !$_REQUEST['zname'] ) {
    die();
}

require 'phpMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$email1 = COption::GetOptionString("main", "email_from");
$email2=    COption::GetOptionString("main", "email_from2");

$rsSites = CSite::GetByID(SITE_ID);
$arSite = $rsSites->Fetch();

CModule::IncludeModule("iblock");

$el = new CIBlockElement;
$PROP = array(
    "zname" => $_REQUEST['zname'],
    "ztel" => $_REQUEST['ztel'],

);
$arFields = array(
    "IBLOCK_ID" => 16,
    "NAME" => $_REQUEST['zname'],
    "PROPERTY_VALUES" => $PROP
);

$productID = $el->Add($arFields);

$mail->setFrom('no-reply@' . $_SERVER['HTTP_HOST'], $arSite['NAME']);
$mail->addAddress("$email1");
$mail->addAddress("$email2");
$mail->addReplyTo("$email2", "Reply");
$mail->addAttachment($_FILES['summary']['tmp_name'], $_FILES['summary']['name']);
$mail->CharSet = 'utf-8';
$mail->isHTML(true);
$mail->Subject = "Заказ звонка";
$mail->Body = "
<b>Имя:&nbsp;</b> " . $_REQUEST['zname'] . "<br>
<b>Телефон:&nbsp;</b> " . $_REQUEST['ztel'] . "<br>



";
$mail->send();
echo 'ok';
?>