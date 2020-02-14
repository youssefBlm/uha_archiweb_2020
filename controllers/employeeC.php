<?php
class EmployeeController
{
  public function construct()
  {
  }

  public function index()
  {
    $this->list();
  }
  public function list()
  {
    require_once MODELS . DS . 'employeeM.php';
    $m = new EmployeeModel();
    $employees = $m->listAll();
    // Affichage au sein de la vue des données récupérées via le model
    require_once CLASSES . DS . 'view.php';
    $v = new View();
    $v->setVar('employeelist', $employees);
    $v->render('employee', 'list');
  }
  public function view($id = null)
  {
    require_once MODELS . DS . 'employeeM.php';
    $m = new EmployeeModel();
    require_once CLASSES . DS . 'view.php';
    $v = new View();
    if ($employee = $m->listOne($id)) $v->setVar('e', $employee);
    // Affichage au sein de la vue des données récupérées via le model
    $v->render('employee', 'view');
  }
  public function edit($id = null)
  {
    if (isset($_POST['id'])) {
      $contactID = strtolower(trim($_POST['id']));
      $Firstname = strtolower(trim($_POST['prenom']));
      $Lastname = strtolower(trim($_POST['nom']));

      require_once MODELS . DS . 'employeeM.php';
      $m = new EmployeeModel();
      $result = $m->updateOne($Firstname, $Lastname, $contactID);

      $this->list();
    }else{
    require_once MODELS . DS . 'employeeM.php';
    $m = new EmployeeModel();
    require_once CLASSES . DS . 'view.php';
    $v = new View();
    if ($employee = $m->listOne($id))
      $v->setVar('e', $employee);
    $v->render('employee', 'edit');
  }
  }
  public function delete($id = null)
  {
    require_once MODELS . DS . 'employeeM.php';
    $m = new EmployeeModel();
    $result = $m->delete($id);
    $this->list();
  }

  public function add()
  {
    if (isset($_POST['id'])) {
      $EmployeeID = strtolower(trim($_POST['id']));
      $ContactID = strtolower(trim($_POST['contactid']));
      

      require_once MODELS . DS . 'employeeM.php';
      $m = new EmployeeModel();
      $result = $m->addOne($EmployeeID, $ContactID);

    
      $this->list();
    }else{
    require_once CLASSES . DS . 'view.php';
    $v = new View();
    $v->render('employee', 'add');
    }
  }
}
