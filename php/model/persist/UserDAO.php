<?php
    require_once '../User.php';
    require_once 'DBConnect.php';
/** 
 * Class that will connect the object with the DB
 * @name UserDAO.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
*/
class UserDAO {
   
    private $data;
    
    //Constructor
    public function __construct() {
        
    }
    
   /** 
    * Inserts the object into the DB
    * @name insertUser()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $user Object to insert
    * @return $rowsAffected Number of rows affected
    */
    public static function insertUser($user) {
        $success = 0;
        $conn = DBConnect::getConection();
        try 
        {
            $sql = "insert into user(name,surname,email,password,phone,bornDate,specialism,professionId,image) values (:name,:surname,:email,:password,:phone,:bornDate,:specialism,:professionId,:image)";
            $stmt = $conn->prepare($sql);

            $name = $user->getName();
            $surname = $user->getSurname();
            $email = $user->getEmail();
            $password = $user->getPassword();
            $phone = $user->getPhone();
            $bornDate = $user->getBornDate();
            $specialism = $user->getSpecialism();
            $professionId = $user->getProfessionId();
            $image = $user->getImage();
                        
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
            $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
            $stmt->bindParam(":bornDate", $bornDate, PDO::PARAM_STR);
            $stmt->bindParam(":specialism", $specialism, PDO::PARAM_STR);
            $stmt->bindParam(":professionId", $professionId, PDO::PARAM_STR);
            $stmt->bindParam(":image", $image, PDO::PARAM_STR);
            
            $success = $stmt->execute();
            
        } catch (Exception $e) {
            $success = 0;
        }
        return $success;
    }
    
    /** 
    * Erases the object from the DB
    * @name deleteUser()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $user Object to delete
    * @return $rowsAffected Number of rows affected
    */
    public static function deleteUser($user) {
        return 0;
    }
    
    /** 
    * Modifies the object into the DB
    * @name modifyUser()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $user Object to modify
    * @return $rowsAffected Number of rows affected
    */
    public static function modifyUser($user) {
        return 0;
    }
    
    /** 
    * Finds an object into the DB
    * @name findUser()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $user Object to find
    * @return $foundUser Founded object
    */
    public static function findUser($user) {        
        $conn = DBConnect::getConection();

        $sql = "select * from user where email = :email AND password = :passwd";
        $result = $conn->prepare($sql);
        $result->bindParam("email", $user->getEmail(), PDO::PARAM_STR);
        $result->bindParam("passwd", $user->getPassword(), PDO::PARAM_STR);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User");
        $data = $result->fetchAll();

        return $data; 
    }
    
    /** 
    * Find an object using a clause
    * @name findWhere()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $whereClause Clause to fins
    * @return array Founded objects
    */
    public function findWhere($whereClause) {
        /*
        $conn = DBConnect::getConection();

        $sql = "select * from product where id_lab = :id";
        $result = $conn->prepare($sql);
        $result->bindParam("id", $labId, PDO::PARAM_STR);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Product");
        $data = $result->fetchAll();

        return $data;*/
    }
}
