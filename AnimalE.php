<?php
class AnimalE
{
    private $idP;
    private $nom;
    private $espece;
    private $race;
    private $genre;
    private $age;
    private $dateN;
    private $numeroT;
    private $adresse;

    //Constructeur
    public function __construct($idP,$nom,$espece,$race,$genre,$age,$dateN,$numeroT,$adresse)
    {
        $this->idP=$idP;
        $this->nom=$nom;
        $this->espece=$espece;
        $this->race=$race;
        $this->genre=$genre;
        $this->age=$age;
        $this->dateN=$dateN;
        $this->numeroT=$numeroT;
        $this->adresse=$adresse;
    }

    //affichage 
    public function __toString()
    {
        $ligneT= "(<u><b>".$this->idP."</b></u>, ".$this->nom.", ". $this->espece.", ".$this->race.", ".$this->genre.", ".$this->age.", ". $this->dateN.", ". $this->numeroT.", ". $this->adresse." )<br>";
        return $ligneT;
    }
}
?>