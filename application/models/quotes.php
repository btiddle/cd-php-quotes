<?php 
    class Quotes extends CI_Model
    {
        public function add_quote($data)
        {
            // $this->db->escape_str(data['answerText'])
            // http://stackoverflow.com/questions/9473824/codeigniter-active-records-insert-query-with-single-quotes 

            $query = "INSERT INTO quotes (author, quote, posted_by, created_at, updated_at) 
                      VALUES (". $this->db->escape($data['author']) . ", " 
                               . $this->db->escape($data['quote']) . ", " 
                               . $this->db->escape($data['posted_by']) . ", NOW(), NOW() )";
            return $this->db->query($query);
        }

        public function insert_favorites($data)
        {
            $query = "INSERT INTO favorites (user_id, quote_id, created_at, updated_at)
                      VALUES ({$data['user_id']}, {$data['quote_id']}, NOW(), NOW() )";
            return $this->db->query($query);
        }

        public function delete_favorites($data)
        {
            $query = "DELETE FROM favorites 
                      WHERE user_id = {$data['user_id']} AND quote_id = {$data['quote_id']}";
            return $this->db->query($query);
        }


        public function get_favorities($data)
        {
            $query = "SELECT quotes.author, quotes.quote, quotes.posted_by, quotes.quote_id
                      FROM quotes
                      LEFT JOIN favorites ON quotes.quote_id = favorites.quote_id
                      WHERE favorites.user_id = {$data['user_id']}";
            return $this->db->query($query)->result_array();
        }

        public function get_quotables($data)
        {
            $query = "SELECT quotes.author, quotes.quote, quotes.posted_by, quotes.quote_id
                      FROM quotes
                      WHERE quotes.quote_id NOT IN 
                      (
                        SELECT quotes.quote_id
                        FROM quotes
                        LEFT JOIN favorites ON quotes.quote_id = favorites.quote_id
                        WHERE favorites.user_id = {$data['user_id']}
                      )";

            return $this->db->query($query)->result_array();
        }

    }
 ?>