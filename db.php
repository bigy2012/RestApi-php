<?php
require_once('conn.php');

class Database extends Config {
    
    public function fetch($id = 0){
        $sql = "SELECT * FROM `users`";
        if($id != 0){
            $sql .= " WHERE user_id = :id";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public function insert($name, $email, $address, $phone){
        $sql = "INSERT INTO `users`(`name`, `email`, `address`, `phone`) VALUES (:name , :email , :address , :phone )";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'address' => $address, 'phone' => $phone]);
        return true;
    }

    public function delete($id){
        $sql = "DELETE FROM `users` WHERE user_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }


}



?>