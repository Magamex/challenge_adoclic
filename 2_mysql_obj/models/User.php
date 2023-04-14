<?php

class UserModel {
    private $conn;
    private $table_name = "user_stats";

    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getFirstName() {
        return $this->first_name;
    }
    
    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }
    
    public function getLastName() {
        return $this->last_name;
    }
    
    public function setLastName($last_name) {
        $this->last_name = $last_name;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getStatus() {
        return $this->status;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }
}
