<?php
namespace Modules\Node {
    use \Component\Validator;
    final class Save extends \Component\Validation {
        public function __construct(\Component\Core $mapper) {
            $create = new Create($mapper);
            $node = $create->execute();
            if (!isset($mapper->current) && isset($mapper->parent)) {      
                $mapper->fetch($mapper->parent)->item(0)->appendChild($node);
            } elseif (!isset($mapper->current) && !isset($mapper->parent) && isset($mapper->path)) {
                $mapper->fetch(implode(DIRECTORY_SEPARATOR, array_slice(explode(DIRECTORY_SEPARATOR, $mapper->path), 0, -1)))->item(0)->appendChild($node);
            }    
            
            parent::__construct($node, [new Validator\IsObject\Of("\DOMElement")]);
        }
    }
}