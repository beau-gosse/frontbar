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
 * @version 1.2.0-beta - June 11, 2019
 * @license MIT
 *
 *
 */
/* check basic permissions */
if (!$modx->user->hasSessionContext('mgr') || !$modx->hasPermission('edit_document,new_document')) {
    return '';
}

/* set default properties */
$tpl = $modx->getOption('tpl', $scriptProperties, 'Frontbar');
$pos = $modx->getOption('position', $scriptProperties, 'top'); // or bottom

/* set new resource parent + respect document hierarchy */
$res =& $modx->resource;
$resId       = $res->get('id');
$manager_url = MODX_MANAGER_URL;

if ($res->get('class_key') == 'CollectionContainer' || $res->get('isfolder') == 1) {
    $parent = $resId;
} else {
    $parent = $res->get('parent');
}

/* register client CSS and JS  */
$assets_url  = $modx->getOption('assets_url') . 'components/frontbar/';
$css_url     = $modx->getOption('frontbar.css_url', null, $assets_url . 'css/frontbar.min.css', true);
$bulma_css   = $modx->getOption('frontbar.bulma_css');
$fa_js       = $modx->getOption('frontbar.fa_js');

$modx->regClientCSS($bulma_css);
$modx->regClientCSS($css_url);

$modx->regClientScript($fa_js);

/* get user profile fieLds */
$profile  = $modx->user->getOne('Profile');
$email    = $profile->get('email');
$fullName = $profile->get('fullName');

/* return Frontbar */
return $modx->getChunk($tpl, array(
    'position' => $pos,
    'manager_url' => $manager_url,
    'update_url' => $manager_url . '?a=resource/update&id=' . $resId,
    'create_url' => $manager_url . '?a=resource/create&parent=' . $parent . '&context_key=' . $modx->context->key,
    'showTemplate' => $modx->hasPermission('edit_template') ? 1 : 0,
    'template_url' => $manager_url . '?a=element/template/update&id=' . $res->get('template'),
    'showSettings' => $modx->hasPermission('settings') ? 1 : 0,
    'showProfile' => $modx->hasPermission('change_profile') ? 1 : 0,
    'profile_url' => $manager_url . '?a=security/profile',
    'message_url' => $manager_url . '?a=security/message',
    'logout_url' => $manager_url . '?a=security/logout',
    'settings_url' => $manager_url . '?a=system/settings',
    'username' => $modx->user->get('username'),
    'fullname' => $fullName,
    'gravatar' => 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($email))),
    'dropdown-direction' => $pos == 'bottom' ? 'has-dropdown-up' : ''
));