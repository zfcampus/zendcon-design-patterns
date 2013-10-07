<?php
/**
 * Iterator design pattern (Fibonacci numbers)
 * 
 * @see    http://www.php.net/manual/en/class.iterator.php
 * @see    http://en.wikipedia.org/wiki/Fibonacci_number
 */

class Fibonacci implements Iterator {
    protected $value = 0;
    protected $sum = 0;
    protected $key = 0;
    public function rewind() {
        $this->value = 0;
        $this->key   = 0;
    }
    public function current() {
        return $this->value;
    }
    public function key() {
        return $this->key;
    }
    public function next() {
        if ($this->value === 0) {
            $this->value = 1;
        } else {
            $old = $this->value;
            $this->value += $this->sum;
            $this->sum = $old;
        }
        $this->key++;
    }
    
    public function valid() {
        return true;
    }
}


// check the first 10 Fibonacci's numbers
$num = new Fibonacci();
$correct = array(0, 1, 1, 2, 3, 5, 8, 13, 21, 34);
for ($i = 0; $i < 10; $i++) {
    printf ("%s<br>", $num->current() === $correct[$i] ? 'OK ' : 'ERROR');
    $num->next();
}
