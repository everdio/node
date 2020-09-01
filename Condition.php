<?php
namespace Modules\Node {
    use \Components\Validator;
    final class Condition extends \Components\Validation {
        public function __construct(\Components\Core\Mapper $node, string $operator = "and", string $expression = "=", string $match = "text()=\"%s\"", $wrap = "\"%s\"", array $conditions = []) {
            if (isset($node->mapping) || isset($node->{$node->tag})) {
                if (isset($node->mapping)) {
                    foreach ($node->restore($node->mapping) as $parameter => $value) {
                        if (isset($node->{$parameter}) && !$node->get($parameter)->hasType(Validator\IsEmpty::TYPE)) {
                            $conditions[] = sprintf("@%s %s " . $wrap, $node->getField($parameter), $expression, $value);
                        }
                    }                    
                }

                if (isset($node->{$node->tag})) {
                    $conditions[] = sprintf($match, trim($node->{$node->tag}));
                }   
            }
            
            parent::__construct(implode(sprintf(" %s ", strtolower($operator)), $conditions), [new Validator\IsString]);
        }
    }
}