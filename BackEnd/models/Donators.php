<?php
    class Donators {
        //DB Stuff
        private $conn;
        private $table = 'donators';

        //Post Properties
        public $id;
        public $name;
        public $age;
        public $address;
        public $city;
        public $state;
        public $pincode;
        public $phone;
        public $email;
        public $pwd;

        //Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        public function profile(){
            $query = "SELECT id, name, email FROM $this->table";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function fetch(){
            $query = "SELECT id, name, age, address, city, state, pincode, phone, email FROM $this->table";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function check(){
            $query = "SELECT id, email, pwd FROM $this->table WHERE id = :id";
            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(':id', $this->id);

            $stmt->execute();
            return $stmt;
        }

        public function login(){
            $query = "SELECT id, email, pwd FROM $this->table";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function fetchId(){
            $query = "SELECT id FROM $this->table";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function create(){
            //Create query
            $query = "INSERT INTO $this->table SET id = NULL, name = :name, age = :age, address = :address, city = :city, state = :state, pincode = :pincode, phone = :phone, email = :email, pwd = :pwd";
           
            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean Data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->age = htmlspecialchars(strip_tags($this->age));
            $this->address = htmlspecialchars(strip_tags($this->address));
            $this->city = htmlspecialchars(strip_tags($this->city));
            $this->state = htmlspecialchars(strip_tags($this->state));
            $this->pincode = htmlspecialchars(strip_tags($this->pincode));
            $this->phone = htmlspecialchars(strip_tags($this->phone));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->pwd = htmlspecialchars(strip_tags($this->pwd));

            //Bind Data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':age', $this->age);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':city', $this->city);
            $stmt->bindParam(':state', $this->state);
            $stmt->bindParam(':pincode', $this->pincode);
            $stmt->bindParam(':phone', $this->phone);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':pwd', $this->pwd);

            //Execute Query
            if ($stmt->execute()){
                return true;
            }

            return false;
        }
        
        public function update(){
            //Create query
            $query = "UPDATE $this->table SET age = :age, address = :address, city = :city, state = :state, pincode = :pincode, phone = :phone WHERE id = :id";

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean Data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->age = htmlspecialchars(strip_tags($this->age));
            $this->address = htmlspecialchars(strip_tags($this->address));
            $this->city = htmlspecialchars(strip_tags($this->city));
            $this->state = htmlspecialchars(strip_tags($this->state));
            $this->pincode = htmlspecialchars(strip_tags($this->pincode));
            $this->phone = htmlspecialchars(strip_tags($this->phone));

            //Bind Data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':age', $this->age);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':city', $this->city);
            $stmt->bindParam(':state', $this->state);
            $stmt->bindParam(':pincode', $this->pincode);
            $stmt->bindParam(':phone', $this->phone);

            //Execute Query
            if ($stmt->execute()){
                return true;
            }

            //Print error if something goes wrong
            //printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }
?>