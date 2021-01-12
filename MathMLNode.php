<?php

namespace ASCIIMath2MathML;

class MathMLNode extends \ASCIIMath2MathML\XMLNode
{
    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    public function removeBrackets()
    {
        if ($this->_name == 'mrow') {
            if ($c_node_0 = $this->getFirstChild()) {
                $c_node_0->isLeftBracket() ? $this->removeFirstChild() : 0;
            }

            if ($c_node_0 = $this->getLastChild()) {
                $c_node_0->isRightBracket() ? $this->removeLastChild() : 0;
            }
        }
    }

    public function isLeftBracket()
    {
        switch ($this->_content) {
            case '{':
            case '[':
            case '(':
                return(true);
                break;
        }
        return(false);
    }

    public function isRightBracket()
    {
        switch ($this->_content) {
            case '}':
            case ']':
            case ')':
                return(true);
                break;
        }
        return(false);
    }
}