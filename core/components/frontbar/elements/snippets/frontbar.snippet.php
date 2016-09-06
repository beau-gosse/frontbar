<?php
/**
 * This snippet displays an admin toolbar in the frontend for loggedin users.
 *
 * @package Frontbar
 * @subpackage snippet
 *
 * @author Treigh P. M. <treigh(at)kleverr.com>
 * @version 1.0.0-beta - September 5, 2016
 * @license MIT
 *
 *
 */
/* check permissions */
if (!$modx->user->hasSessionContext('mgr') || !$modx->hasPermission('edit_document,new_document')) {
    //$modx->log(modX::LOG_LEVEL_ERROR, 'Couldn\'t load Frontbar due to insufficient permissions.', '', 'Frontbar');
    return '';
}

/* set default properties */
$tpl = $modx->getOption('tpl', $scriptProperties, 'Frontbar');

/* set new resource parent + respect document hierarchy */
$res =& $modx->resource;
$id      = $res->get('id');
$context = $modx->context->key;
$mgrURL  = MODX_MANAGER_URL;

if ($res->get('class_key') == 'CollectionContainer' || $res->get('isfolder') == 1) {
    $parent = $id;
} else {
    $parent = $res->get('parent');
}

/* register client CSS and JS  */
$assetsURL = $modx->getOption('assets_url') . 'components/frontbar/';
// Get user-defined path settings or use defaults if empty (4th argument => $skipEmpty)
$cssURL    = $modx->getOption('frontbar.css_url', null, $assetsURL . 'css/frontbar.min.css', true);
$faURL     = $modx->getOption('frontbar.fa_url', null, '//maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css', true);
$jqURL     = $modx->getOption('frontbar.jq_url', null, $assetsURL . 'js/jquery-2.1.4.min.js', true);
$jsURL     = $modx->getOption('frontbar.js_url', null, $assetsURL . 'js/frontbar.min.js', true);
$jqLoad    = '<script>if( !window.jQuery ) document.write(\'<script src="' . $jqURL . '"><\/script>\');</script>';

$modx->regClientCSS($cssURL);
$modx->regClientCSS($faURL);
// load JQuery only if not available
$modx->regClientHTMLBlock($jqLoad);
$modx->regClientScript($jsURL);

/* get user profile fieds */
$profile  = $modx->user->getOne('Profile');
$email    = $profile->get('email');
$fullName = $profile->get('fullName');

/* return Frontbar */
return $modx->getChunk($tpl, array(
    'mgrURL' => $mgrURL,
    'updateURL' => $mgrURL . '?a=resource/update&id=' . $id,
    'createURL' => $mgrURL . '?a=resource/create&parent=' . $parent . '&context_key=' . $context,
    'showSettings' => $modx->hasPermission('settings') ? 1 : 0,
    'showProfile' => $modx->hasPermission('change_profile') ? 1 : 0,
    'profileURL' => $mgrURL . '?a=security/profile',
    'msgURL' => $mgrURL . '?a=security/message',
    'settingsURL' => $mgrURL . '?a=system/settings',
    'username' => $modx->user->get('username'),
    'fullname' => $fullName,
    'gravatar' => '//www.gravatar.com/avatar/' . md5(strtolower(trim($email)))
));
