<?php
namespace Modules\Node {
    use \Component\Validator;
    final class Count extends \Component\Validation {
        public function __construct(string $field, string $expression = "=", int $count = 1) {
            parent::__construct(sprintf("count(%s) %s %s", $field, $expression, $count), [new Validator\IsString]);
        }
    }
}