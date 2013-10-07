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
            foreach ($this->products as $product) {
                if ($filterStrategy->filter($product)) {
                    $filteredProducts[] = $product;
                }
            }
            return new ProductCollection($filteredProducts);
        }

        public function getProductsArray() {
            return $this->products;
        }
    }

    interface ProductFilteringStrategy {
        /**
         * @param Product $product
         * @return boolean
         */
        public function filter(Product $product);
    }

    class ManufacturerFilter implements ProductFilteringStrategy {

        private $manufacturerName;

        public function __construct($manufacturerName) {
            $this->manufacturerName = $manufacturerName;
        }

        public function filter(Product $product) {
            if ($product->manufacturer == $this->manufacturerName) {
                return true;
            }
            return false;
        }
    }

    class MaxPriceFilter implements ProductFilteringStrategy {
        private $maxPrice;

        public function __construct($maxPrice) {
            $this->maxPrice = $maxPrice;
        }

        public function filter(Product $product) {
            if ($product->listPrice && $product->sellingPrice) {
                return ($product->listPrice - $product->sellingPrice) <= $this->maxPrice;
            } else if ($product->listPrice) {
                return ($product->listPrice <= $this->maxPrice);
            }
            return false;
        }
    }
}

namespace {

    use MyCompanyShop\Product;
    use MyCompanyShop\ProductCollection;
    use MyCompanyShop\MaxPriceFilter;
    use MyCompanyShop\ManufacturerFilter;

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
    assert($resultCollection->getProductsArray()[0]->manufacturer == 'Widgetron, LLC');


    $resultCollection = $collection->filter(new MaxPriceFilter(50));

    assert(count($resultCollection->getProductsArray()) == 1);
    assert($resultCollection->getProductsArray()[0]->manufacturer == 'WidgetCorp');

}