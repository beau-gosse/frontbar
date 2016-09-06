<?php
/**
*
* Resolves System Settings for Frontbar extra.
*
*/
if (!$object->xpdo) return false;
/** @var modX $modx */
$modx =& $object->xpdo;

$assetsURL = $modx->getOption('assets_url') . 'components/frontbar/';

switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:

        $cssURL = $modx->getObject('modSystemSetting', array('key' => 'frontbar.css_url'));
        if ($cssURL) {
            $cssURL->set('value', $assetsURL . 'css/frontbar.min.css');
            $cssURL->save();
        }

        $jqURL = $modx->getObject('modSystemSetting', array('key' => 'frontbar.jq_url'));
        if ($jqURL) {
            $jqURL->set('value', $assetsURL . 'js/jquery-3.0.0.min.js');
            $jqURL->save();
        }

        $jsURL = $modx->getObject('modSystemSetting', array('key' => 'frontbar.js_url'));
        if ($jsURL) {
            $jsURL->set('value', $assetsURL . 'js/frontbar.js');
            $jsURL->save();
        }

        break;
    case xPDOTransport::ACTION_UPGRADE:
        break;
    case xPDOTransport::ACTION_UNINSTALL:
        break;
}
return true;
