<?php

namespace ShopingCartFramework {
    class Shop {
        protected $productPrototype;
        public function __construct(ProductInterface $productPrototype) {
            $this->productPrototype = $productPrototype;
        }
        public function listProducts(array $codes) {
            $output = [];
            foreach ($codes as $code) {
                $product = clone $this->productPrototype;
                $product->initialize($code);
                $output[] = $product->getShopProductCode() . ' - ' . $product->getShopDescription();
            }
            return implode(PHP_EOL, $output);
        }
    }
    interface ProductInterface {
        public function initialize($code);
        public function getShopProductCode();
        public function getShopDescription();
    }
}

namespace MyCompanyShop {
    use ShopingCartFramework\ProductInterface;
    class MyShopProduct implements ProductInterface {
        protected $productService = array();
        protected $code, $description;
        public function __construct(\Closure $productService) {
            $this->productService = $productService;
        }
        public function initialize($code) {
            $this->code = $code;
            $this->description = call_user_func($this->productService, $code);
        }
        public function getShopProductCode() {
            return $this->code;
        }
        public function getShopDescription() {
            return $this->description;
        }
    }

}

namespace {
    use ShopingCartFramework\Shop;
    use MyCompanyShop\MyShopProduct;

    $mockWebService = function($code) {
        static $data = [
            'BumperSticker1' => 'Cool bumper sticker',
            'CoffeeTableBook5' => 'Coffee Table book',
        ];
        return $data[$code];
    };

    $shop = new Shop(new MyShopProduct($mockWebService));

    $productsToList = ['BumperSticker1', 'CoffeeTableBook5'];
    header('content-type: plain/text');
    echo $shop->listProducts($productsToList); // simulation of Shopping Cart Listings Page
}