<?php

/**
 * @file
 * Class installations to handle configuration forms on Admin UI.
 */

require_once('../../class2.php');

if(!e107::isInstalled('simplenews') || !getperms("P"))
{
  e107::redirect(e_BASE . 'index.php');
}

// [PLUGINS]/simplenews/languages/[LANGUAGE]/[LANGUAGE]_admin.php
e107::lan('simplenews', true, true);


/**
 * Class simplenews_admin.
 */
class simplenews_admin extends e_admin_dispatcher
{

  /**
   * Required (set by child class).
   *
   * Controller map array in format.
   * @code
   *  'MODE' => array(
   *      'controller' =>'CONTROLLER_CLASS_NAME',
   *      'path' => 'CONTROLLER SCRIPT PATH',
   *      'ui' => 'UI_CLASS', // extend of 'comments_admin_form_ui'
   *      'uipath' => 'path/to/ui/',
   *  );
   * @endcode
   *
   * @var array
   */
  protected $modes = array(
    'ajax'     => array(
      'controller' => 'simplenews_admin_ajax_ui',
    ),
    'main'     => array(
      'controller' => 'simplenews_admin_ui',
      'path'       => null,
    ),
  );

  /**
   * Optional (set by child class).
   *
   * Required for admin menu render. Format:
   * @code
   *  'mode/action' => array(
   *      'caption' => 'Link title',
   *      'perm' => '0',
   *      'url' => '{e_PLUGIN}plugname/admin_config.php',
   *      ...
   *  );
   * @endcode
   *
   * Note that 'perm' and 'userclass' restrictions are inherited from the $modes, $access and $perm, so you don't
   * have to set that vars if you don't need any additional 'visual' control.
   *
   * All valid key-value pair (see e107::getNav()->admin function) are accepted.
   *
   * @var array
   */
  protected $adminMenu = array(
    'main/prefs'    => array(
      'caption' => LAN_SIMPLENEWS_ADMIN_MENU_01,
      'perm'    => 'P',
    ),
  );

  /**
   * Optional (set by child class).
   *
   * @var string
   */
  protected $menuTitle = LAN_PLUGIN_SIMPLENEWS_NAME;

}


/**
 * Class simplenews_admin_ajax_ui.
 */
class simplenews_admin_ajax_ui extends e_admin_ui
{

  /**
   * Initial function.
   */
  public function init()
  {
    // Construct action string.
    $action = varset($_GET['mode']) . '/' . varset($_GET['action']);

    switch($action)
    {

    }
  }

}

/**
 * Class simplenews_admin_ui.
 */
class simplenews_admin_ui extends e_admin_ui
{

  /**
   * Could be LAN constant (multi-language support).
   *
   * @var string plugin name
   */
  protected $pluginTitle = LAN_PLUGIN_SIMPLENEWS_NAME;

  /**
   * Plugin name.
   *
   * @var string
   */
  protected $pluginName = "simplenews";

  /**
   * Example: array('0' => 'Tab label', '1' => 'Another label');
   * Referenced from $prefs property per field - 'tab => xxx' where xxx is the tab key (identifier).
   *
   * @var array edit/create form tabs
   */
  protected $preftabs = array(
    LAN_SIMPLENEWS_ADMIN_MENU_01, // Settings.
  );

  /**
   * Plugin Preference description array.
   *
   * @var array
   */
  protected $prefs = array(

  );

  /**
   * User defined init.
   */
  public function init()
  {

  }

}


new simplenews_admin();

require_once(e_ADMIN . "auth.php");
e107::getAdminUI()->runPage();
require_once(e_ADMIN . "footer.php");
exit;
