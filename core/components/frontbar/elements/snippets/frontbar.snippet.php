<?php
/**
 * This snippet displays an admin toolbar in the front end for logged in users.
 *
 * @package Frontbar
 * @subpackage snippet
 *
 * https://github.com/beau-gosse/frontbar
 *
 * @author Treigh P. M. <treigh(at)kleverr.com>
 * @version 1.1.0-beta - September 11, 2016
 * @license MIT
 *
 *
 */
/* check basic permissions */
if ($modx->user instanceof modUser) {
    if (!$modx->user->hasSessionContext('mgr') || !$modx->hasPermission('edit_document,new_document')) {
        return '';
    }
}
/* set default properties */
$tpl = $modx->getOption('tpl', $scriptProperties, 'Frontbar');
$pos = ($modx->getOption('position', $scriptProperties) == 'bottom' ? ' fixed-bottom' : '');

/* set new resource parent + respect document hierarchy */
$res =& $modx->resource;
$resid    = $res->get('id');
$template = $res->get('template');
$context  = $modx->context->key;
$mgrURL   = MODX_MANAGER_URL;

if ($res->get('class_key') == 'CollectionContainer' || $res->get('isfolder') == 1) {
    $parent = $resid;
} else {
    $parent = $res->get('parent');
}

/* register client CSS and JS  */
$assetsURL   = $modx->getOption('assets_url') . 'components/frontbar/';
// Get user-defined path settings or use defaults if empty (4th argument => $skipEmpty)
$cssURL      = $modx->getOption('frontbar.css_url', null, $assetsURL . 'css/frontbar.min.css', true);
$suiCSS      = $modx->getOption('frontbar.sui_css');
$suiTransCSS = $modx->getOption('frontbar.sui_css_trans');
$faURL       = $modx->getOption('frontbar.fa_url');
$jqURL       = $modx->getOption('frontbar.jq_url', null, $assetsURL . 'js/jquery-2.1.4.min.js', true);
$jqLoad      = '<script>if( !window.jQuery ) document.write(\'<script src="' . $jqURL . '"><\/script>\');</script>';
$suiJS       = $modx->getOption('frontbar.sui_js');
$suiTransJS  = $modx->getOption('frontbar.sui_js_trans');
$jsURL       = $modx->getOption('frontbar.js_url', null, $assetsURL . 'js/frontbar.min.js', true);

$modx->regClientCSS($cssURL);
$modx->regClientCSS($suiCSS);
$modx->regClientCSS($suiTransCSS);
$modx->regClientCSS($faURL);
// load JQuery if not available
$modx->regClientHTMLBlock($jqLoad);
$modx->regClientScript($suiJS);
$modx->regClientScript($suiTransJS);
$modx->regClientScript($jsURL);

/* get user profile fieLds */
$profile  = $modx->user->getOne('Profile');
$email    = $profile->get('email');
$fullName = $profile->get('fullName');

/* return Frontbar */
return $modx->getChunk($tpl, array(
    'position' => $pos,
    'mgrURL' => $mgrURL,
    'updateURL' => $mgrURL . '?a=resource/update&id=' . $resid,
    'createURL' => $mgrURL . '?a=resource/create&parent=' . $parent . '&context_key=' . $context,
    'showTemplate' => $modx->hasPermission('edit_template') ? 1 : 0,
    'templateURL' => $mgrURL . '?a=element/template/update&id=' . $template,
    'showSettings' => $modx->hasPermission('settings') ? 1 : 0,
    'showProfile' => $modx->hasPermission('change_profile') ? 1 : 0,
    'profileURL' => $mgrURL . '?a=security/profile',
    'msgURL' => $mgrURL . '?a=security/message',
    'logoutURL' => $mgrURL . '?a=security/logout',
    'settingsURL' => $mgrURL . '?a=system/settings',
    'username' => $modx->user->get('username'),
    'fullname' => $fullName,
    'gravatar' => '//www.gravatar.com/avatar/' . md5(strtolower(trim($email)))
));
