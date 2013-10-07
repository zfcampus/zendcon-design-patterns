<?php

namespace MyShop {
    
    class Database {
        public function query() {
            return array('1', '2', '3');
        }
    }
    
    class DatabaseConstructorConsumer {
        protected $database;
        public function __construct(Database $database) {
            $this->database = $database;
        }
        public function doSomething() {
            return implode(', ', $this->database->query());
        }
    }
    
    class DatabaseSetterConsumer {
        protected $database;
        public function setDatabase(Database $database) {
            $this->database = $database;
        }
        public function doSomething() {
            return implode(', ', $this->database->query());
        }
    }

}

namespace {
    
    use MyShop\Database;
    use MyShop\DatabaseConstructorConsumer;
    use MyShop\DatabaseSetterConsumer;

    // constructor injection
    $consumer = new DatabaseConstructorConsumer(new MyShop\Database);
    assert($consumer->doSomething() == '1, 2, 3');
    
    // setter injection
    $consumer = new DatabaseSetterConsumer;
    $consumer->setDatabase(new MyShop\Database);
    assert($consumer->doSomething() == '1, 2, 3');
    
}