<?php
    class User {
        private $name;
        private $email;
        private $conn;
        public function __construct($cont)
        {
            $this->conn = $cont;
        }

        public function getAllUsers() {
        $sql = "SELECT * FROM User";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }
    }
?>