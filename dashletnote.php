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
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function dashletnote_civicrm_install() {
  _dashletnote_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function dashletnote_civicrm_enable() {
  _dashletnote_civix_civicrm_enable();
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
