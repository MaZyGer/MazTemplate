<?php
require_once('template.class.php');
require_once('template.config.php');


if(isset($_GET['lang'])) {
    $lang = $_GET['lang'];
} else {
    $lang = 'en';
}

$defaultTemplate = new Template(TEMPLATE_PATH . '/' . TEMPLATE_NAME, $lang);
require_once 'template.localizations.php';

?>