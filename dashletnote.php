<?php

require_once 'dashletnote.civix.php';
// phpcs:disable
use CRM_Dashletnote_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function dashletnote_civicrm_config(&$config) {
  _dashletnote_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function dashletnote_civicrm_xmlMenu(&$files) {
  _dashletnote_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function dashletnote_civicrm_install() {
  _dashletnote_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function dashletnote_civicrm_postInstall() {
  _dashletnote_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function dashletnote_civicrm_uninstall() {
  _dashletnote_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function dashletnote_civicrm_enable() {
  _dashletnote_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function dashletnote_civicrm_disable() {
  _dashletnote_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function dashletnote_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _dashletnote_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function dashletnote_civicrm_managed(&$entities) {
  _dashletnote_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function dashletnote_civicrm_caseTypes(&$caseTypes) {
  _dashletnote_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function dashletnote_civicrm_angularModules(&$angularModules) {
  _dashletnote_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function dashletnote_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _dashletnote_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function dashletnote_civicrm_entityTypes(&$entityTypes) {
  _dashletnote_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_themes().
 */
function dashletnote_civicrm_themes(&$themes) {
  _dashletnote_civix_civicrm_themes($themes);
}

function dashletnote_civicrm_navigationMenu(&$menu) {
  _dashletnote_civix_insert_navigation_menu($menu, 'Administer', [
    'label' => E::ts('Dashlet Note'),
    'name' => 'dashlet_note',
    'url' => CRM_Utils_System::url('civicrm/dashlet-note/admin', 'reset=1', TRUE),
    'permission' => 'administer CiviCRM',
    'operator' => NULL,
    'separator' => 0,
  ]);
}
