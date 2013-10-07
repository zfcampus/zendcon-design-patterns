<?php
namespace MyCompanyShop {

    class Product {
        public $name;
        public $listPrice;
        public $sellingPrice;
    }

    class ProductCollection {
        private $products = array();

        public function addProduct($product) {
            $this->products[] = $product;
        }

        public function sort(ProductSortingStrategy $strategy) {
            $this->products = $strategy->sort($this->products);
        }

        public function getStorage() {
            return $this->products;
        }
    }

    interface ProductSortingStrategy {
        public function sort(array $products);
    }

    // implement a strategy to sort by name ascending alphabetically
    // implement a strategy to sort by discount percent descending

}

namespace {

    use MyCompanyShop\Product;
    use MyCompanyShop\ProductCollection;

    $p1 = new Product;
    $p1->listPrice = 100;
    $p1->sellingPrice = 50;
    $p1->name = "Some other Product";

    $p2 = new Product;
    $p2->listPrice = 100;
    $p2->sellingPrice = 75;
    $p2->name = "My Favorite Product";

    $collection = new ProductCollection;
    $collection->addProduct($p1);
    $collection->addProduct($p2);

    // sort the collection by name

    assert($collection->getStorage()[0]->name == $p2->name);

    // sort the collection by discount percent

    assert($collection->getStorage()[0]->sellingPrice == $p1->sellingPrice);


}