<?php
use CRM_Dashletnote_ExtensionUtil as E;

class CRM_Dashletnote_Page_DashletNote extends CRM_Core_Page {

  public function run() {
    $helper = new CRM_Dashletnote_Helper();

    $this->setPageTitle($helper->label);
    $this->setDashletContent($helper->note);
    $this->setAdminLink();

    parent::run();
  }

  private function setPageTitle($title) {
    CRM_Utils_System::setTitle($title);
  }

  private function setDashletContent($note) {
    $this->assign('dashletNote', $note);
  }

  private function setAdminLink() {
    if (CRM_Core_Permission::check('administer CiviCRM')) {
      $link = CRM_Utils_System::url('civicrm/dashlet-note/admin', 'reset=1');
      $linkText = E::ts('Edit');
    }
    else {
      $link = '';
      $linkText = '';
    }

    $this->assign('adminLink', $link);
    $this->assign('adminLinkText', $linkText);
  }

}
