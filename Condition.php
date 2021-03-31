<?php
namespace Modules\Node {
    use \Components\Validator;
    final class Condition extends \Components\Validation {
        public function __construct(\Components\Core $node, string $operator = "and", string $expression = "=", string $match = "text()=\"%s\"", $wrap = "@%s %s \"%s\"", array $conditions = []) {
            if (isset($node->mapping) || isset($node->{$node->label})) {
                if (isset($node->mapping)) {
                    foreach ($node->restore($node->mapping) as $parameter => $value) {
                        if (isset($node->{$parameter}) && !$node->get($parameter)->hasTypes([Validator\IsEmpty::TYPE])) {
                            $conditions[] = sprintf($wrap, $node->getField($parameter), $expression, $value);
                        }
                    }                    
                }

                if (isset($node->{$node->label})) {
                    $conditions[] = sprintf($match, trim($node->{$node->label}));
                }   
            }

            parent::__construct(implode(sprintf(" %s ", strtolower($operator)), $conditions), [new Validator\IsString]);
        }
    }
}