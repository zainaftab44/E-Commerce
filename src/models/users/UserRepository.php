<?php

use Singletons\Database;

class UserRepository implements Repository {

    private Database $db;
    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function find($id) {
        $data = $this->db->fetch('SELECT id,email,name FROM users WHERE id = :id', ['id' => $id]);
        if ($data) {
            return  new User($data['id'], $data['email'], $data['name']);
        }

        return null;
    }

    public function findAll() {
        $users = [];
        while ($data = $this->db->fetch('SELECT id,email,name FROM users')) {
            $users[] =  new User($data['id'], $data['email'], $data['name']);
        }

        return $users;
    }

    public function save(User $user) {
        if ($user->getId()) {
            // Update existing user
            // $stmt = $this->pdo->prepare('UPDATE users SET name = :name, email = :email WHERE id = :id');
            $this->db->execute('UPDATE users SET name = :name, email = :email WHERE id = :id', [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail()
            ]);
        } else {
            // Create new user
            $data = $this->db->execute('INSERT INTO users (name, email) VALUES (:name, :email)', [
                'name' => $user->getName(),
                'email' => $user->getEmail()
            ]);
            $user->setId($data->lastInsertId());
        }
    }

    public function delete($id) {
        $this->db->execute('DELETE FROM users WHERE id = :id', ['id' => $id]);
    }

    public function checkLogin(string $email, string $password) {
        $data = $this->db->fetch('SELECT id,email,name FROM users WHERE email = :email and password=:password', ['email' => $email, 'password' => $password]);
        if ($data) {
            return new User($data['id'], $data['email'], $data['name']);
        }
        return null;
    }
}
