<?php
session_start();

class User {
    //Attributs
    private $id;
    public $login;
    public $email;
    public $password;
    public $firstname;
    public $lastname;
    public $bdd;

    //Constructeur
    public function __construct(){
        $this->bdd = mysqli_connect('localhost', 'root', '', 'classes');
        if ($this->bdd) {
            echo "connexion établie <br />";
          }
          else { 
            die(mysqli_connect_error());
          }
    }

    //Méthode register pour s'enregistrer dans la bdd
    public function register($login, $password, $email, $firstname, $lastname){
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;

        
        mysqli_query($this->bdd, "INSERT INTO utilisateurs (`login`, `password`, `email`, `firstname`, `lastname`) VALUES ('$login', '$password', '$email', '$firstname', '$lastname')");
        
    }

    //Méthode connect pour connecter l'utilisateur
    public function connect($login,$password) {
        $request = "SELECT * FROM utilisateurs WHERE login= '$login'";
        $query = mysqli_query($this->bdd, $request);
        $utilisateur=mysqli_fetch_array($query, MYSQLI_ASSOC);

        if ($password == $utilisateur['password']){
            echo "vous êtes connecté";
        }

    }

    //Méthode pour déconnecter l'utilisateur
    public function disconnect() {
        session_unset();
        session_destroy();
    }

    //Méthode pour effacer un utilisateur dans la bdd grâce à son id
    public function delete($id) {
        mysqli_query($this->bdd,"DELETE FROM utilisateurs WHERE utilisateurs.id=$id");
        session_unset();
        session_destroy();
        
    }

    //Méthode pour modifier les données d'un profil
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




$users = new User;
// $users->register('p','p','p','p','p');
$users->connect('c','c');
$users->delete('7');



?>