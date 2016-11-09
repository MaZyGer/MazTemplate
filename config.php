<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('template.class.php');
define('TEMPLATE_PATH', 'templates');

//change here name of template / design
define('TEMPLATE_NAME', 'default');


if(isset($_GET['lang'])) {
    $lang = $_GET['lang'];
} else {
    $lang = 'en';
}

$defaultTemplate = new Template(TEMPLATE_PATH . '/' . TEMPLATE_NAME, $lang);
$defaultTemplate->writeLanguageVar('TEST', 'DE', 'Hallo Welt');
$defaultTemplate->writeMultipleLanguageVar('TEST', array('EN' => 'Hello World', 'TR' => 'Selam Dünya'));

$username = "LoggedUsername";
$defaultTemplate->writeVar('username', $username);

$defaultTemplate->includeContent();
?>