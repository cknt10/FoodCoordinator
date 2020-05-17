<?php 
require_once('../sql/coni.php');
require_once('../../classes/reguser.php');
session_start();
$pdo = new Connection();


class Register{

    public function register()
    {
        $showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll
 
        if(isset($_GET['register'])) {
            $user = new RegUser();
            $error = false;


            $user->setFirstname(trim($_POST['vorname']));
            $user->setName(trim($_POST['nachname']));
            $user->setEmail(trim($_POST['email']));
            $user->setPassword($_POST['passwort']);

            $passwort2 = $_POST['passwort2'];
            
            if(empty($user->getFistname()) || empty($user->getName()) || empty($user->getEmail())) {
                $error = true;
            }
          
            if(!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
                $error = true;
            } 	
            if(strlen($user->getPassword()) == 0) {

                $error = true;
            }
            if($user->getPassword() != $passwort2) {
                $error = true;
            }
            
            //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
            if(!$error) { 
                $statement = $pdo->prepare("SELECT * FROM user WHERE Mail =" .$user->getEmail());
                $result = $statement->execute(array('email' => $email));
                $dbuser = $statement->fetch();
                
                if($dbuser !== false) {
                    $error = true;
                }	
            }
            
            //Keine Fehler, wir können den Nutzer registrieren
            if(!$error) {	
                $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
                
                $statement = $pdo->prepare("INSERT INTO users (email, passwort, vorname, nachname) VALUES (" .$user->getEmail(). ", " .$user->getPassword().", ".$user->getFirstname().", " .$user->getName().")");
                $result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash, 'vorname' => $vorname, 'nachname' => $nachname));
                
                if($result) {		
                    echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
                    $showFormular = false;
                } else {
                    echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
                }
            } 
    }

}

    
}

$REGISTER = new Register;
header('Content-Type: application/json');
echo $LOGIN->register();


?>