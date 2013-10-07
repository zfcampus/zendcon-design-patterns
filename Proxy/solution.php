<?php
/**
 * Proxy design pattern (lazy loading)
 * 
 * @see    http://en.wikipedia.org/wiki/Proxy_pattern
 */

interface ImageInterface
{
    public function display();
}

class Image implements ImageInterface
{
    protected $filename;
    public function  __construct($filename) {
        $this->filename = $filename;
        $this->loadFromDisk();
    }
    protected function loadFromDisk() {
        echo "Loading {$this->filename}\n";
    }
    public function display() {
        echo "Display {$this->filename}\n";
    }
}

class ProxyImage implements ImageInterface
{
    protected $image;
    public function  __construct($filename) {
        $this->filename = $filename;
    }
    public function display() {
        if (null === $this->image) {
            $this->image = new Image($this->filename);
        }
        return $this->image->display();
    }
}

// Usage example

$filename = 'test.png';

$image1 = new Image($filename); // loading necessary
echo $image1->display(); // loading unnecessary

$image2 = new ProxyImage($filename); // loading unnecessary
echo $image2->display(); // loading necessary
echo $image2->display(); // loading unnecessary
