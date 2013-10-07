<?php
namespace MyCompanyShop {

    use SplObserver;
    use SplSubject;

    class Product implements SplSubject
    {
        private $data = [];

        public function __get($key)
        {
            return $this->data[$key];
        }

        public function __set($key, $value)
        {
            $this->data[$key] = $value;
        }

        public function attach(SplObserver $observer)
        {
            // TODO: Implement attach() method.
        }

        public function detach(SplObserver $observer)
        {
            // TODO: Implement detach() method.
        }

        public function notify()
        {
            // TODO: Implement notify() method.
        }


    }

    class Logger implements SplObserver
    {
        private $events = [];

        public function getEvents()
        {
            return $this->events;
        }

         function update(SplSubject $subject)
        {
            // TODO: Implement update() method.
        }


    }
}

namespace {
    use MyCompanyShop\Product,
        MyCompanyShop\Logger;

    $p = new Product;
    $l = new Logger;
    $p->name = 'Test Product 1';
    $p->attach($l);

    assert(count($l->getEvents()) == 0);
    $p->foo = 'bar';
    assert(count($l->getEvents()) == 1);

}