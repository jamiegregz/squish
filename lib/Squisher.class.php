<?php
    require(__DIR__ . "/DB.class.php");

    class Squisher {
        private $db = null;

        protected $long_url = "";
        protected $squished_url = "";
        protected $short_id = "";

        public function __construct() {
            // Don't really need to do anything in here
            $this->db = new DB();
            return;
        }


        private function generate_short_id($length = 8) {
            // Quick function to throw together a random string from a set of available characters
            // TODO: Extract this into a 'Utils' class or something
            $aval_chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $id = "";
            for($i = 0; $i < $length; $i++) {
                // Pick a random index from the $aval_chars string and add the value to $id
                $id[$i] = $aval_chars[rand(0, strlen($aval_chars) - 1)];
            }

            // TODO: Check if this string exists in the DB

            return $id;
        }


        public function squish($url) {
            // TODO: Tame the URL

            $this->long_url = $url;

            // Check if the URL already exists in the DB
            if($result = $this->db->get_from_url($url)) {
                // So, the URL already exists, set it on this object
                $this->squished_url = "http://squish.li/{$result["short_id"]}";
            } else {
                // Generate a Random URL
                $short_id = $this->generate_short_id();
                $this->squished_url = "http://squish.li/{$short_id}";

                // Add it to the DB
                $this->db->add_url($url, $short_id);
            }
        }

        public function find_from_id($id) {
            if($result = $this->db->get_from_short_id($id)) {
                $this->short_id = $id;
                $this->long_url = $result["long_url"];
                $this->squished_url = "http://squish.li/{$id}";

                return true;
            }

            return false;
        }

        public function get_squished_url() {
            return $this->squished_url;
        }

        public function get_long_url() {
            return $this->long_url;
        }
    }
