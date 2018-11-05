<?php

/*
 * You can use this to make different variables/placeholders for different localizations.
 */

Template::instance()->writeLocalizationVar('SIGN_IN', 'DE', 'Einloggen');
Template::instance()->writeMultipleLocalizationVar('SIGN_IN', array(
    'EN' => 'Sign in', 
    'TR' => 'Kayit ol'
));
Template::instance()->writeMultipleLocalizationVar('PLACERHOLDER_PASSWORD', array('EN' => 'Password', 'DE' => 'Passwort', 'TR' => 'Sifre'));
