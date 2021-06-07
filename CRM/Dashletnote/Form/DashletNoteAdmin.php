<?php

use CRM_Dashletnote_ExtensionUtil as E;

class CRM_Dashletnote_Form_DashletNoteAdmin extends CRM_Core_Form {
  private $helper;

  public function __construct($state = NULL, $action = CRM_Core_Action::NONE, $method = 'post', $name = NULL) {
    $this->helper = new CRM_Dashletnote_Helper();

    parent::__construct($state, $action, $method, $name);
  }

  public function buildQuickForm() {
    $this->setTitle(E::ts('Dashlet Note'));

    $this->addFormFields();
    $this->addFormButtons();
    $this->setFormDefaults();

    // export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());
    parent::buildQuickForm();
  }

  public function postProcess() {
    try {
      $this->saveSubmittedValues();
      CRM_Core_Session::setStatus(E::ts('Saved.'), '', 'success');
    }
    catch (Exception $e) {
      CRM_Core_Session::setStatus($e->getMessage(), E::ts('Error'), 'error');
    }

    parent::postProcess();
  }

  private function saveSubmittedValues() {
    // get submitted values
    $values = $this->exportValues();

    // save the note
    $this->helper->label = $values['dashlet_label'];
    $this->helper->note = $values['dashlet_note'];
    $this->helper->save();
  }

  private function addFormFields() {
    $this->add('text', 'dashlet_label', E::ts('Title'), [], TRUE);
    $this->add('wysiwyg', 'dashlet_note', E::ts('Note'), [], TRUE);
  }

  private function addFormButtons() {
    $this->addButtons([
      [
        'type' => 'submit',
        'name' => 'Save',
        'isDefault' => TRUE,
      ],
    ]);
  }

  private function setFormDefaults() {
    $defaults = [];

    $defaults['dashlet_label'] = $this->helper->label;
    $defaults['dashlet_note'] = $this->helper->note;

    $this->setDefaults($defaults);
  }

  public function getRenderableElementNames() {
    $elementNames = [];
    foreach ($this->_elements as $element) {
      /** @var HTML_QuickForm_Element $element */
      $label = $element->getLabel();
      if (!empty($label)) {
        $elementNames[] = $element->getName();
      }
    }
    return $elementNames;
  }
}
