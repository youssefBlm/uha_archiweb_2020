<?php
class EmployeeModel
{
  public function construct()
  {
  }
  public function listAll()
  {
    $sql = 'select E.EmployeeID, C.ContactID, E.NationalIDNumber,E.Title as ETitle, C.Title as CTitle, C.FirstName, C.MiddleName, C.LastName, C.EmailAddress, E.HireDate
      from employee as E
      inner join contact as C on E.ContactID=C.ContactID';
    try {
      $dbh = new PDO('mysql:host=localhost;dbname=adventureworks;charset=utf8', 'root', '');
      $stmt = $dbh->prepare($sql);
      //$stmt->bindParam(":var",$var);
      $res = ($stmt->execute()) ? $stmt->fetchAll(PDO::FETCH_OBJ) : null;
      $dbh = null;
      return $res;
    } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage() . "<br/>";
      die();
    }
  }
  public function listOne($id)
  {
    $sql = 'select E.*, C.*,E.Title as ETitle, C.Title as CTitle, EM.Title as EMTitle, CM.Title as CMTitle, CM.FirstName as CMFirstName, CM.MiddleName as CMMiddleName, CM.LastName as CMLastName
      from employee as E
      inner join contact as C on E.ContactID=C.ContactID
      left join employee as EM on E.ManagerID=EM.EmployeeID
      left join contact as CM on EM.ContactID=CM.ContactID
      where E.EmployeeID=:id';
    try {
      $dbh = new PDO('mysql:host=localhost;dbname=adventureworks;charset=utf8', 'root', '');
      $stmt = $dbh->prepare($sql);
      $stmt->bindParam(":id", $id);
      $res = ($stmt->execute()) ? $stmt->fetchAll(PDO::FETCH_OBJ) : null;
      $dbh = null;
      return current($res);
    } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage() . "<br/>";
      die();
    }
  }

  public function updateOne($name, $last, $contactID)
  {

    $sql = "UPDATE contact SET FirstName=?, LastName=? WHERE ContactID=?";
    try {
      $dbh = new PDO('mysql:host=localhost;dbname=adventureworks;charset=utf8', 'root', '');
      $dbh->prepare($sql)->execute([$name, $last, $contactID]);
      $dbh = null;
      return 'ok';
    } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage() . "<br/>";
      die();
    }
  }

  public function delete($id)
  {

    $sql = "DELETE FROM employee WHERE 	EmployeeID =?";
    try {
      $dbh = new PDO('mysql:host=localhost;dbname=adventureworks;charset=utf8', 'root', '');
      $dbh->prepare($sql)->execute([$id]);
      $dbh = null;
      return 'ok';
    } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage() . "<br/>";
      die();
    }
  }


  public function addOne($id,$contactID)
  {
    $sql = "INSERT INTO employee (EmployeeID, NationalIDNumber, ContactID, LoginID, ManagerID, Title, BirthDate, MaritalStatus, Gender, HireDate, SalariedFlag, VacationHours, SickLeaveHours, CurrentFlag, rowguid)
    VALUES (?,54545,?,'fghfghfghf',121212,'gghfhg','2020-02-20 00:00:00','f','g','2020-02-20 00:00:00',0,'12','12',0,'000111')";

    try {
      $dbh = new PDO('mysql:host=localhost;dbname=adventureworks;charset=utf8', 'root', '');
      $dbh->prepare($sql)->execute([$id,$contactID]);
      $dbh = null;
      return 'ok';
    } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage() . "<br/>";
      die();
    }
  }
}
