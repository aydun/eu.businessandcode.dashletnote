<?php
use CRM_Dashletnote_ExtensionUtil as E;

class CRM_Dashletnote_Page_DashletNote extends CRM_Core_Page {

  public function run() {
    $helper = new CRM_Dashletnote_Helper();

    CRM_Utils_System::setTitle($helper->label);
    $this->assign('dashletNote', $helper->note);

    parent::run();
  }

}
