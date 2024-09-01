<?php

namespace App\Models;

use DateTimeImmutable;

class AnnonceModel extends Model
{
    protected int $id;
    protected string $titre;
    protected string $description;
    protected DateTimeImmutable $created_at;
    protected bool $actif;

    /**
     * Constructeur d'objets annonce
     * Les objets instanciés sont stoqués dans la table annonces
     */
    public function __construct()
    {
        $this->table = 'annonces';
    }

    /**
     * Accesseur retournant un entier correspondant l'id de l'objet
     *
     * @return integer
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * Accesseur retourant une chaîne avec le titre de l'objet
     *
     * @return string
     */
    public function getTitre():string
    {
        return $this->titre;
    }

    /**
     * Mutateur qui modifie le titre de l'objet
     *
     * @param string $titre Titre de l'objet
     * @return self
     */
    public function setTitre(string $titre):self
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * Accesseur qui retourne une chaîne avec la description de l'objet
     *
     * @return string
     */
    public function getDescription():string
    {
        return $this->description;
    }

    /**
     * Mutateur qui modifie la description de l'objet
     *
     * @param string $description
     * @return self
     */
    public function setDescription(string $description):self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Accesseur qui retourne la date de création de l'objet
     *
     * @return DateTimeImmutable
     */
    public function getCreatedAt():DateTimeImmutable
    {
        return $this->created_at;
    }

    /**
     * Accesseur qui retourne le boulean actif de l'objet
     *
     * @return boolean
     */
    public function getActif():bool
    {
        return $this->actif;
    }


    /**
     * Mutateur permettant de modifier l'état actif de l'objet
     *
     * @param boolean $actif
     * @return self
     */
    public function setActif(bool $actif):self
    {
        $this->actif = $actif;
        return $this;
    }
}