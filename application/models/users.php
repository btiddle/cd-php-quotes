<?php 
    class Users extends CI_Model
    {
        public function add_user($data)
        {
            date_default_timezone_set("America/Los_Angeles");
            $query = "INSERT INTO users (name, alias, email, birthdate, password, created_at, updated_at)
                      VALUES ('{$data['name']}', '{$data['alias']}','{$data['email']}','{$data['birthdate']}','{$data['password']}', NOW(), NOW())";
            $this->db->query($query);
        }
        
        public function login_user($data)
        {
            $query = "SELECT * FROM users
                        WHERE email = '{$data['email']}' AND password = '{$data['password']}'";
            return $this->db->query($query)->row_array();
        }
        
        public function get_user($data)
        {
            $query = "SELECT alias, user_id FROM users
                        WHERE email = '{$data['email']}'";
            return $this->db->query($query)->row_array();
        }


    }
 ?>