<?php
namespace MyCompanyShop {

    class Product {
        public $name;
        public $listPrice;
        public $sellingPrice;
    }

    class ProductCollection {

        private $products = array();

        public function __construct(array $products) {
            $this->products = $products;
        }

        /**
         * @param ProductFilteringStrategy $filterStrategy
         * @return ProductCollection
         */
        public function filter(ProductFilteringStrategy $filterStrategy) {
            $filteredProducts = array();
            //@TODO use the strategy to filter products that don't meet criteria
            return new ProductCollection($filteredProducts);
        }

        public function getProductsArray() {
            return $this->products;
        }
    }

    interface ProductFilteringStrategy {
        /**
         * @param Product $product
         * @return true|false
         */
        public function filter(Product $product);
    }

    //@TODO implement a strategy for filtering products by maximum price
    //@TODO implement a strategy for filtering products by manufacturer

}

namespace {

    use MyCompanyShop\Product;
    use MyCompanyShop\ProductCollection;

    $p1 = new Product;
    $p1->listPrice = 100;
    $p1->sellingPrice = 50;
    $p1->manufacturer = 'WidgetCorp';

    $p2 = new Product;
    $p2->listPrice = 100;
    $p2->manufacturer = 'Widgetron, LLC';

    $collection = new ProductCollection([$p1, $p2]);

    $resultCollection = $collection->filter(new ManufacturerFilter('Widgetron, LLC'));

    assert(count($resultCollection->getProductsArray()) == 1);
    assert($resultCollection->getProductsArray()[0]->manufacturer == 'WidgetCorp');


    $resultCollection = $collection->filter(new MaxPriceFilter(50));

    assert(count($resultCollection->getProductsArray()) == 1);
    assert($resultCollection->getProductsArray()[0]->manufacturer == 'WidgetCorp');

}