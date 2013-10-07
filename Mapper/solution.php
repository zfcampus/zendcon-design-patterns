<?php
namespace MyCompanyShop {

    class Product
    {
        public $name;
        public $price;
        public $manufacturer;
    }

    class Manufacturer
    {
        public $name;
        public $url;
    }

    class ProductMapper
    {
        public function toProduct($data)
        {
            $p = new Product;
            $p->name = $data["name"];
            $p->price = $data["price"];
            $p->manufacturer = new Manufacturer;
            $p->manufacturer->name = $data["manufacturer_name"];
            $p->manufacturer->url = $data["manufacturer_url"];
            return $p;
        }

        public function toArray(Product $product)
        {
            $data = [];
            $data["price"] = $product->price;
            $data["name"] = $product->name;
            $data["manufacturer_name"] = $product->manufacturer->name;
            $data["manufacturer_url"] = $product->manufacturer->url;

            return $data;
        }
    }
}

namespace {

    use MyCompanyShop\Product;
    use MyCompanyShop\Manufacturer;
    use MyCompanyShop\ProductMapper;

    $data = [
        "name"  => "test product",
        "price" => 50,
        "manufacturer_name" => "Widgets, Inc",
        "manufacturer_url"  => "http://widgets.io"
    ];

    $mapper = new ProductMapper;

    $product = $mapper->toProduct($data);
    assert($product->name == "test product");
    assert($product instanceof Product);
    assert($product->price == 50);
    assert($product->manufacturer instanceof Manufacturer);
    assert($product->manufacturer->name == "Widgets, Inc");
    assert($product->manufacturer->url == "http://widgets.io");

    $mappedData = $mapper->toArray($product);
    assert($data == $mappedData);
}