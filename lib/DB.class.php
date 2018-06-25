<?php
    class DB {
        // TODO: Extract these into a config file
        private $db = 'mysql:dbname=squish;port=8889;host=127.0.0.1',
                $user = 'root',
                $password = 'root';

        protected $connection = null;

        public function __construct() {
            try {
                $this->connection = new PDO($this->db, $this->user, $this->password);
            } catch (PDOException $e) {
                // TODO: Do some error stuff here, maybe a redirect to 500 page?
            }
        }


        public function get_from_short_id($short_id) {
            $stmt = $this->connection->prepare("SELECT * FROM urls WHERE short_id = :short_id");
            $stmt->execute([
                "short_id" => $short_id
            ]);

            return ($stmt->rowCount() > 0) ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
        }


        public function get_from_url($url) {
            // Assume that the URL has already been tamed
            $stmt = $this->connection->prepare("SELECT * FROM urls WHERE long_url = :url");
            $stmt->execute([
                ":url" => $url
            ]);

            return ($stmt->rowCount() > 0) ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
        }


        public function add_url($url, $short_id) {
            $stmt = $this->connection->prepare("INSERT INTO urls (long_url, short_id) VALUES(:long_url, :short_id)");
            $stmt->execute([
                ":long_url" => $url,
                ":short_id" => $short_id
            ]);

            // Just return this so we can check our record has been inserted
            return $stmt->rowCount();
        }
    }
