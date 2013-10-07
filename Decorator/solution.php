<?php
/**
 * Decorator design pattern (example of implementation)
 * 
 * @see    http://en.wikipedia.org/wiki/Decorator_pattern
 * @see    http://www.giorgiosironi.com/2010/01/practical-php-patterns-decorator.html
 */

interface HtmlElement
{
    public function __toString();
    public function getName();
}

class InputText implements HtmlElement
{
    protected $name;
    public function __construct($name) {
        $this->name = $name;
    }
    public function getName() {
        return $this->name;
    }
    public function __toString() {
        return "<input type=\"text\" id=\"{$this->name}\" name=\"{$this->name}\" />\n";
    }
}

abstract class HtmlDecorator implements HtmlElement
{
    protected $element;
    public function __construct(HtmlElement $input) {
        $this->element = $input;
    }
    public function getName() {
        return $this->element->getName();
    }
    public function __toString() {
        return $this->element->__toString();
    }
}

class LabelDecorator extends HtmlDecorator
{
    protected $label;
    public function setLabel($label) {
        $this->label = $label;
    }
    public function __toString() {
        $name = $this->getName();
        return "<label for=\"{$name}\">{$this->label}</label>\n"
             . $this->element->__toString();
    }
}

class ErrorDecorator extends HtmlDecorator
{
    protected $error;
    public function setError($message) {
        $this->error = $message;
    }
    public function __toString() {
        return $this->element->__toString() . "<span>{$this->error}</span>\n";
    }
}

$input = new InputText('nickname');
printf("InputText without decorator:<br>%s<br>", $input);

$labelled = new LabelDecorator($input);
$labelled->setLabel('Nickname:');
printf("InputText with LabelDecorator:<br>%s<br>", $labelled);

$error = new ErrorDecorator($input);
$error->setError('You must enter a unique nickname');
printf("InputText with ErrorDecorator:<br>%s<br>\n", $error);

// Label + Error
$error = new ErrorDecorator($labelled);
$error->setError('You must enter a unique nickname');
printf("InputText with LabelDecorator and ErrorDecorator:<br>%s<br>", $error);
