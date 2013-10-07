<?php

namespace MyShop {
    
    class Database {
        public function query() {
            return array('1', '2', '3');
        }
    }
    
    class DatabaseConsumer {
        protected $database;
        public function __construct(Database $database) {
            $this->database = $database;
        }
        public function doSomething() {
            return implode(', ', $this->database->query());
        }
    }
    
}

namespace {
    
    use MyShop\Database;
    use MyShop\DatabaseConsumer;
    
    $consumer = new DatabaseConsumer(new MyShop\Database);
    echo $consumer->doSomething();
    
}