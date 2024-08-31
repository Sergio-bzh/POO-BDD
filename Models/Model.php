<?php

namespace App\Models;

use App\Db\Db;
use App\Database\Db;

class Model extends Db
{
    // Table de la base des données
    protected $table;

    // Instan ce de Db
    private $db;

     
    public function findAll()
    {
        $query = $this->requette('SELECT * FROM '. $this->table);
        return $query-fetchAll();
    }

    // TODO: Demander à un prof la raison de cette erreur
    // Je nomme la requête autrement car le mot query me génère une erreur par rapport à la classe parent ()
    /**
     * Undocumented function
     *
     * @param string $sql
     * @param array|null $attributs
     * @return void
     */
    public function requette(string $sql, ?array $attributs = null)
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