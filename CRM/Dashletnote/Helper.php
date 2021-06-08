<?php

class CRM_Dashletnote_Helper {
  private $params = [];
  public $label;
  public $note;

  public function __construct() {
    $this->load();
  }

  public function load() {
    // the API does not allow to link a note to entity civicrm_dashboard
    // se we use SQL
    $sql = "
      select
        *
      from
        civicrm_note
      where
        entity_table = 'civicrm_dashboard'
      order by
        id
    ";
    $dao = CRM_Core_DAO::executeQuery($sql);
    if ($dao->fetch()) {
      $this->label = $dao->subject;
      $this->note = $dao->note;
    }
    else {
      $this->label = '';
      $this->note = '';
    }
  }

  public function save() {
    $noteId = $this->getNoteId();
    if ($noteId) {
      $this->update();
    }
    else {
      $this->insert();
    }

    $this->updateDashboardLabel();
  }

  private function insert() {
    // the API does not allow to link a note to entity civicrm_dashboard
    // se we use SQL
    $sql = "
      insert into
        civicrm_note (entity_table, entity_id, note, subject)
      values
        (%1, %2, %3, %4)
    ";
    $sqlParams = [
      1 => ['civicrm_dashboard', 'String'],
      2 => [$this->getEntityId(), 'Integer'],
      3 => [$this->note, 'String'],
      4 => [$this->label, 'String'],
    ];
    CRM_Core_DAO::executeQuery($sql, $sqlParams);
  }

  private function update() {
    // the API does not allow to link a note to entity civicrm_dashboard
    // se we use SQL
    $sql = "
      update
        civicrm_note
      set
        entity_table = %1,
        entity_id = %2,
        note = %3,
        subject = %4
       where
         id = %5
    ";
    $sqlParams = [
      1 => ['civicrm_dashboard', 'String'],
      2 => [$this->getEntityId(), 'Integer'],
      3 => [$this->note, 'String'],
      4 => [$this->label, 'String'],
      5 => [$this->getNoteId(), 'Integer'],
    ];
    CRM_Core_DAO::executeQuery($sql, $sqlParams);
  }

  private function updateDashboardLabel() {
    $sql = 'update civicrm_dashboard set label = %1 where id = %2';
    $sqlParams = [
      1 => [$this->label, 'String'],
      2 => [$this->getEntityId(), 'Integer'],
    ];
    CRM_Core_DAO::executeQuery($sql, $sqlParams);
  }

  private function getNoteId() {
    // Technically, multiple notes with entity civicrm_dashboard are possible.
    // We only want 1, so we return the first id (or NULL if there is no note yet)
    $sql = "select min(id) from civicrm_note where entity_table = 'civicrm_dashboard'";
    $id = CRM_Core_DAO::singleValueQuery($sql);
    return $id;
  }

  private function getEntityId() {
    // return the id of the dashlet entry (create it if needed)
    $params = [
      'name' => 'dashletnote',
      'sequential' => 1,
    ];

    try {
      $result = civicrm_api3('Dashboard', 'getsingle', $params);
      return $result['id'];
    }
    catch (Exception $e) {
      $params['url'] = 'civicrm/dashlet-note?reset=1';
      $params['label'] = 'Dashlet Note';
      $params['permission'] = 'access CiviCRM';
      $params['fullscreen_url'] = 'civicrm/dashlet-note?reset=1&context=dashletFullscreen';
      $params['is_active'] = '1';
      $params['is_reserved'] = '1'; // prevents user from deleting it
      $params['cache_minutes'] = '7200';

      $result = civicrm_api3('Dashboard', 'create', $params);
      return $result['values'][0]['id'];
    }
  }

}
