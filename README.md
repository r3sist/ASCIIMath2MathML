# ASCIIMath2MathML

**ASCIIMath to MathML Converter for PHP**

**This repository is a fork of [Zefling/ASCIIMathPHP](https://github.com/Zefling/ASCIIMathPHP)**  
For original credits see: https://github.com/Zefling/ASCIIMathPHP/blob/master/ASCIIMathPHP-2.1.class.php 


## Usage

```php
private function makeMathMLRaw($string): string
{
    $asciiMathPhp = new \ASCIIMath2MathML\ASCIIMathPHP();
    $asciiMathPhp->setExpr($string);
    $asciiMathPhp->genMathML();
    return $asciiMathPhp->getMathML();
}
```

## Installation

Via composer:

```json
{
"require": {
    "resist/asciimath2mathml": "dev-master"
    }
}
```