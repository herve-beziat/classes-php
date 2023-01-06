<?php
session_start();

class Userpdo {
    //Attributs
    private $id;
    public $login;
    public $email;
    public $password;
    public $firstname;
    public $lastname;
    public $pdo;

    //Constructeur
    public function __construct() {
        $this->pdo = new pdo("mysql:host=localhost; dbname=classes","root","");
    }

    //Méthode register pour s'enregistrer dans la bdd
    public function register($login, $password, $email, $firstname, $lastname){
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;

        
        $regis = $this->pdo->prepare ("INSERT INTO utilisateurs (`login`, `password`, `email`, `firstname`, `lastname`) VALUES (?, ?, ?, ?, ?)");
        $regis->execute(array($login, $password, $email, $firstname, $lastname));
        
    }

    //Méthode connect pour connecter l'utilisateur
    public function connect($login,$password) {
        $query = $this->pdo->prepare ("SELECT * FROM utilisateurs WHERE login= '$login'");
        $query->execute();
        $queryfetch=$query->fetchAll();

        if ($password == $queryfetch[0]['password']){
            echo "vous êtes connecté";
        }

    }

    //Méthode pour déconnecter l'utilisateur
    public function disconnect() {
        session_unset();
        session_destroy();
    }

    //Méthode pour effacer un utilisateur de la bdd grâce à son id
    public function delete($id) {
        $del=$this->pdo->prepare("DELETE FROM utilisateurs WHERE utilisateurs.id=$id");
        $del->execute();
        session_unset();
        session_destroy();
        
    }

    //Méthode pour modifier les données d'un profil dans la bdd
    public function update($login,$password,$email,$firstname,$lastname)
    {
        $this->login =      $login;
        $this->email =      $email;
        $this->password =   $password;
        $this->firstname =  $firstname;
        $this->lastname =   $lastname;
        $logged_user = $_SESSION['login'];

        $sql_update = "UPDATE `utilisateurs` SET `login` = '$login' , `password` = '$password' , `email` = '$email' , 
        `firstname` = '$firstname' , `lastname` = '$lastname' WHERE `utilisateurs`.`login` = '$logged_user'";
    }

    public function isConnected()
    {
        # code...
    }

    public function getAllInfos()
    {
        # code...
    }

    public function getLogin()
    {
        # code...
    }

    public function getEmail()
    {
        # code...
    }

    public function getFirstname()
    {
        # code...
    }

    public function getLastname()
    {
        # code...
    }

}

$users = new Userpdo;
// $users->register('y','y','y','y','y');
$users->connect('b','b');
$users->delete('4');

?>