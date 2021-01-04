<?php
namespace Modules\Node {
    use \Components\Validator;
    final class Position extends \Components\Validation {
        public function __construct(string $path, int $position, int $limit) {
            parent::__construct(sprintf("%s[position() >= %s and position() <= %s]", $path, $position, $position + $limit), [new Validator\IsString]);
        }
    }
}