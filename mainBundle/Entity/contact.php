<?php

namespace mainBundle\Entity;


class contact {

    protected $firstAndLastName;
    protected $email;
    protected $message;
    
    public function getFirstAndLastName() {
        return $this->firstAndLastName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setFirstAndLastName($firstAndLastName) {
        $this->firstAndLastName = $firstAndLastName;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setMessage($message) {
        $this->message = $message;
    }


}
