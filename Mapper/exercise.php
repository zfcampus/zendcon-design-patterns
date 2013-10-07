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
        //@TODO
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
    assert($data === $mappedData);
}