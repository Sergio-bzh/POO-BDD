<?php

namespace App\Models;

use App\Db\Db;

class Model extends Db
{
    // Table de la base des données
    protected $table;

    // Instance de Db
    private $db;

     
    public function findAll():array|null
    {
        $query = $this->request('SELECT * FROM '. $this->table);
        return $query->fetchAll();
    }

    // TODO: Demander à un prof la raison de cette erreur
    // J'ai nomma la méthode request car le mot query me génère une erreur par rapport à query() de la classe parent ()

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
}