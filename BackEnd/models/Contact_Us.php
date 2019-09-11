<?php
    class Contact_Us  {
        //DB Stuff
        private $conn;
        private $table = 'contact_us';

        //Post Properties
        public $id;
        public $name;
        public $email;
        public $message;

        public function __construct($db){
            $this->conn = $db;
        }

        public function create(){
            //Create query
            $query = "INSERT INTO $this->table SET id = NULL, name = :name, email = :email, message = :message";
           
            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean Data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->message = htmlspecialchars(strip_tags($this->message));

            //Bind Data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':message', $this->message);

            //Execute Query
            if ($stmt->execute()){
                return true;
            }

            return false;
        }
    }
?>