<?php

namespace App\Models;

use App\Db\Db;

class Model extends Db
{
    // Table de la base des données
    protected $table;

    // Instance de Db
    private $db;

## DÉBUT des méthodes pour le READ du CRUD ##
    /**
     * Méthode pour récupérer tous les éléments d'une table en BDD
     *
     * @return array|null
     */
    public function findAll():array
    {
        $query = $this->request('SELECT * FROM '. $this->table);
        return $query->fetchAll();
    }

    /**
     * Méthode pour récupérer les éléments d'une table en filtrant par un critère
     *
     * @param array $criteres tableax de critères passés comme attributs à la requête préparée
     * @return array|null
     */
    public function findBy(array $criteres):array
    {
        $champs = [];
        $valeurs = [];

        // Je boucle pour éclater le tableau en deux tableaux
        foreach ($criteres as $champ => $valeur) {
            // Ma requête sera : SELECT * FROM ma_table WHERE nom_colonne = ? AND nom_autre_colonne = ?
            // bindValue(:_bind, $valeur_bind)
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }
        // Je transforme le tableau $champs en string avec la méthode implode() et je le stoque dans une variable
        $liste_champs = implode(' AND ', $champs);

        // Je prépare et exécute la requête
        return $this->request('SELECT * FROM '. $this->table .' WHERE ' .$liste_champs, $valeurs)->fetchAll();
    }

    public function find(int $id):array
    { // fetch()
        return $this->request("SELECT * FROM $this->table WHERE id = $id")->fetch();
    }
## FIN des méthodes pour le READ du CRUD ##

## DÉBUT de la méthode CREATE du CRUD ##
    public function create(Model $model)
    {
        $fields = [];
        $questionMarks = [];
        $values = [];

        // Je boucle pour éclater le tableau en deux tableaux
        foreach ($model as $field => $value) {
            // Ma requête sera : INSERT INTO ma_table (col-1, col-1, col-n) VALUES (?, ?, ?)
            // bindValue(:_bind, $valeur_bind)

            if($value !== null && $field !== 'table' && $field !== 'db')
            {
                $fields[] = $field;
                $questionMarks[] = '?';
                $values[] = $value;
            }
        }

        // Je transforme le tableau $fields en string avec la méthode implode() et je le stoque dans une variable et pareil pour $questionMarks
        $field_list = implode(',  ', $fields);
        $questionMarks_list = implode(',  ', $questionMarks);
            
        // Je prépare et exécute la requête
        return $this->request('INSERT INTO '. $this->table .' (' .$field_list.') VALUES('.$questionMarks_list.')', $values);
    }
## FIN de la méthode CREATE du CRUD ##

## DEBUT de la méthode UPDATE du CRUD ##
## FIN de la méthode UPDATE du CRUD ##

## DEBUT de la méthode DELETE du CRUD ##
## FIN de la méthode DELETE du CRUD ##

    /**
     * Méthode query servant à passer les paramètres de la requête lors de l'instanciation du Sinbleton
     *
     * @param string $sql La requête SQL à envoyter à la BDD
     * @param array|null $attributs Tableau de paramètres à passer aux requêtes préparées
     * @return object PDO c'est à dire l'instance du Singleton
     */
    public function request(string $sql, ?array $attributs = null):object
    {
        // Je récupère l'instance de Db
        $this->db = Db::getInstance();

        // Je vérifie s'il y a des attributs et si oui
        if($attributs !== null){
            // Je fais une requête préparée
            $query = $this->db->prepare($sql);
            
            $query->execute($attributs);
            return $query;
        }else{
            // Je fais une requete simple
            return $this->db->query($sql);
        }
    }

## DEBUT Méthodes pour l'HYDRATTION des données pouvant venir d'un formulaire ##
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            // Je crée un éventuel setter au nom de la clef
            $setter = 'set'.ucfirst($key);
            // Je vérifie si le setter existe avec la méthode interne PHP method_exists()
            if(method_exists($this, $setter)){
                // J'appelle les setters
                $this->$setter($value);
            }
        }
        return $this;
    }
## FIN Méthodes pour l'HYDRATTION des données pouvant venir d'un formulaire ##
}