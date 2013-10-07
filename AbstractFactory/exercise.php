<?php

namespace ShopingCartFramework {
    class Shop {
        protected $shopFactory;
        public function __construct(ShopFactoryInterface $shopFactory) {
            $this->shopFactory = $shopFactory;
        }
        public function listProductsWithShippingCost(array $codes, $shippingMethodName, $miles) {
            $output = array();
            foreach ($codes as $code) {
                $product = $this->shopFactory->createProduct($code);
                $shippingMethod = $this->shopFactory->createShippingMethod($shippingMethodName);
                $output[] = $product->getShopProductCode() . ' - '
                    . $product->getShopDescription() . ' / via: '
                    . $shippingMethod->getName() . ', cost: $'
                    . $shippingMethod->getCostEstimate($miles, $product);
            }
            return implode(PHP_EOL, $output);
        }
    }
    interface ShopFactoryInterface {
        public function createProduct($productCode);
        public function createShippingMethod($name);
    }
    interface ProductInterface {
        public function getShopProductCode();
        public function getShopDescription();
    }
    interface ShippingMethodInterface {
        public function getName();
        public function getCostEstimate($miles, ProductInterface $product);
    }
}

namespace MyCompanyShop {
    
    use ShopingCartFramework\ShopFactoryInterface;
    use ShopingCartFramework\ProductInterface;
    use ShopingCartFramework\ShippingMethodInterface;
    
    class MyShopProductFactory implements ShopFactoryInterface {
        protected $productData;
        public function __construct($productData, $shippingMethodData) {
            $this->productData = $productData;
            $this->shippingMethodData = $shippingMethodData;
        }
        public function createProduct($productCode) {
            return new MyShopProduct(
                $productCode, $this->productData[$productCode]
            );
        }
        public function createShippingMethod($name) {
            return new MyShippingMethod($name, $this->shippingMethodData[$name]);
        }
    }
    
    class MyShopProduct implements ProductInterface {
        protected $code, $descriptionAndWeight;
        public function __construct($code, $descriptionAndWeight) {
            $this->code = $code;
            $this->descriptionAndWeight = $descriptionAndWeight;
        }
        public function getShopProductCode() {
            return $this->code;
        }
        public function getShopDescription() {
            return $this->descriptionAndWeight[0];
        }
        public function getWeight() {
            return $this->descriptionAndWeight[1];
        }
    }
    
    class MyShippingMethod implements ShippingMethodInterface {
        protected $name, $multipliers;
        public function __construct($name, $multipliers) {
            $this->name = $name;
            $this->multipliers = $multipliers;
        }
        public function getName() {
            return $this->name;
        }
        public function getCostEstimate($miles, ProductInterface $product) {
            return ($this->multipliers[0] * $miles) + ($this->multipliers[1] * $product->getWeight());
        }
    }

}

namespace {
    use ShopingCartFramework\Shop;
    use MyCompanyShop\MyShopProductFactory;
    
    $productData = [
        // id => [name, weight]
        'BumperSticker1' => ['Bumper Sticker Item #1', 1],
        'BumperSticker3' => ['Bumper Sticker Item #3', 1],
        'BumperSticker5' => ['Bumper Sticker Item #5', 1],
        'CoffeeTableBook6' => ['Coffee Table Book Item #6 (500 pages)', 5],
        'CoffeeTableBook7' => ['Coffee Table Book Item #7 (300 pages)', 3],
        'CoffeeTableBook9' => ['Coffee Table Book Item #9 (900 pages)', 9],
    ];
    
    $shippingMethodData = [
        // code => [miles, weight]
        'UPS' => [1.4, 1.1],
        'FEXED' => [2.2, 1.3],
    ];
    
    $shop = new Shop(new MyShopProductFactory($productData, $shippingMethodData));
    header('content-type: plain/text');
    echo $shop->listProductsWithShippingCost(['BumperSticker1', 'CoffeeTableBook6'], 'UPS', 10); // simulation of Shopping Cart Listings Page
}