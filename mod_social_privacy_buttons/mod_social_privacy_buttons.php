<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once (dirname(__FILE__) . '/helper.php');

$image = modSocialPrivacyButtonsHelper::getImage();
$title = modSocialPrivacyButtonsHelper::getTitle();
require (JModuleHelper::getLayoutPath('mod_social_privacy_buttons'));
?>