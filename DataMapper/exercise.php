<?php
namespace MyCompanyShop {

    class Product
    {
        private $name;
        private $listPrice;
        private $sellingPrice;
        private $image;
        private $id;

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setImage($image)
        {
            $this->image = $image;
        }

        public function getImage()
        {
            return $this->image;
        }

        public function setListPrice($listPrice)
        {
            $this->listPrice = $listPrice;
        }

        public function getListPrice()
        {
            return $this->listPrice;
        }

        public function setName($name)
        {
            $this->name = $name;
        }

        public function getName()
        {
            return $this->name;
        }

        public function setSellingPrice($sellingPrice)
        {
            $this->sellingPrice = $sellingPrice;
        }

        public function getSellingPrice()
        {
            return $this->sellingPrice;
        }

        public function getDisplayPrice()
        {
            $displayPrice = "$";
            if ($this->listPrice && $this->sellingPrice) {
                $displayPrice .= $this->listPrice - $this->sellingPrice;
            } else if ($this->listPrice) {
                $displayPrice .= $this->listPrice;
            }
            return $displayPrice;
        }

        public function getDiscount()
        {
            if ($this->listPrice && $this->sellingPrice) {
                return round((100 * (1 - ($this->sellingPrice / $this->listPrice))));
            }
            return 0;
        }

    }

    class ProductMapper
    {
        public function save(Product $product)
        {

        }

        public function find($id)
        {

        }
    }
}

namespace {

}