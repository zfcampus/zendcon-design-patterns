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
                // @TODO create an actual $product, and initialize it
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
	// @TODO implement MyShopProduct prototype
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
    echo $shop->listProducts($productsToList); // simulation of Shopping Cart Listings Page
}
