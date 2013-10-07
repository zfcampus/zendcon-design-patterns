<?php

namespace ShopingCartFramework {
    class Shop {
        protected $productFactory;
        public function __construct(ProductFactoryInterface $productFactory) {
            $this->productFactory = $productFactory;
        }
        public function listProducts(array $codes) {
            $output = [];
            foreach ($codes as $code) {
                $product = $this->productFactory->createProduct($code);
                $output[] = $product->getShopProductCode() . ' - ' . $product->getShopDescription();
            }
            return implode(PHP_EOL, $output);
        }
    }
    interface ProductFactoryInterface {
        public function createProduct($productCode);
    }
    interface ProductInterface {
        public function getShopProductCode();
        public function getShopDescription();
    }
}

namespace MyCompanyShop {
    use ShopingCartFramework\ProductFactoryInterface;
    use ShopingCartFramework\ProductInterface;

    // @TODO implement MyShopProductFactory with internal database of:
    //        $database = [
    //            'BumperSticker1' => 'Cool bumper sticker',
    //            'CoffeeTableBook5' => 'Coffee Table book',
    //        ];



    // @TODO implement MyShopProduct

}

namespace {
    use ShopingCartFramework\Shop;
    use MyCompanyShop\MyShopProductFactory;
    $shop = new Shop(new MyShopProductFactory);

    $productsToList = ['BumperSticker1', 'CoffeeTableBook5'];

    $targetOutput = <<<EOS
BumperSticker1 - Cool bumper sticker
CoffeeTableBook5 - Coffee Table book
EOS;

    assert($targetOutput == $shop->listProducts($productsToList));
}