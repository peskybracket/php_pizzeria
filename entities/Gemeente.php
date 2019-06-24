 <?php

class Gemeente{
    private $id;
    private $naam;
    private $postcode;
    private $leveringMogelijk;

    public function __construct($id,$postcode,$naam,$leveringMogelijk){
        $this->id=$id;
        $this->setPostcode($postcode);
        $this->setNaam($naam);
        $this->setLeveringMogelijk($leveringMogelijk);
    }

    // GETTERS
    public function getId(){
        return $this->id;
    }
    public function getPostcode(){
        return $this->postcode;
    }
    public function getNaam(){
        return $this->naam;
    }
    public function isLeveringMogelijk(){
        return $this->leveringMogelijk;
    }
    //SETTERS
    public function setPostCode($postcode){
        $this->postcode=$postcode;
    }
    public function setNaam($naam){
        $this->naam=$naam;
    }public function setLeveringMogelijk($leveringMogelijk){
        $this->leveringMogelijk=$leveringMogelijk;
    }
}
