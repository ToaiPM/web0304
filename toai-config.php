<?php
    class SystemConfig{
        private $server = 'localhost';
        private $username = 'root';
        private $password = '';
        private $database = 'dienthoai1703';

        public function setServer($server){$this->server = $server;}
        public function getServer(){return $this->server;}

        public function setUsername($username){$this->username = $username;}
        public function getUsername(){return $this->username;}

        public function setPassword($password){$this->password = $password;}
        public function getPassword(){return $this->password;}

        public function setDatabase($database){$this->database = $database;}
        public function getDatabase(){return $this->database;}
    }
?>