<?php

class Entry{
    private $mail;
    private $pass;

    public function __construct($mail, $pass) {
        $this->setMail($mail, $pass);
        $this->setPass($pass);
    }

    private function setMail($mail){
        $this->mail = $mail;
    }

    private function setPass($pass){
        $this->pass = $pass;
    }

    public function getMail(){
        return $this->mail;
    }

    public function getPass(){
        return $this->pass;
    }
}

?>