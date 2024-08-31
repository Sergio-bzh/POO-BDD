<?php

namespace App\Database;

// J'importe PDO et PDOException
use PDO;
use PDOException;

class Db extends PDO
{
    // Instance unique de la classe Db
    private static $instance;

    // Information de connexion à la BDD
    private const DBHOST = 'localhost';
    private const DBNAME = 'demo_poo';
    private const DBPORT = '3307';
    private const DBUSER = 'Admin';
    private const DBPASSWORD = 'root';

    private function __construct()
    {
        // DSN de connexion à la BDD
        // $_dsn = 'mysql:dbname=' . ';host=' . self::DBHOST . ';port=' . self::DBPORT; // pour tester l'accès à toute la BDD
        $_dsn = 'mysql:dbname=' . self::DBNAME . ';host=' . self::DBHOST . ';port=' . self::DBPORT;

        /* J'appelle le constructeur de la classe parent de Db à savoir PDO pour instancier un objet PDO
        tout en récupérant les eventuelles exceptions, et je lui passe dans le try les attributs que souhaite
        utiliser pour interagit avec la base des données */

        try{
            parent::__construct($_dsn, self::DBUSER, self::DBPASSWORD);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $error){
            die($error->getMessage());
        }
    }

    /**
     * Méthode getInstance() permet d'instancier un singleton pour intéragir avec la BDD
     *
     * @return PDO
     */
    public static function getInstance():PDO // On aurait pu retourner Db ou self
    {
        // if(!self::$instance){ // Ma proposition à tester
        if(self::$instance == null){ // proposition du prof
            // self::$instance = new Db(); // une autre possibilité
            self::$instance = new self();
        }
        return self::$instance;
    }
}