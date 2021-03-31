<?php
namespace Modules\Node {
    use \Components\Validator;
    final class Filter extends \Components\Validation {
        public function __construct(string $xpath, array $conditions = [], string $operator = "and", array $query = []) {
            foreach ($conditions as $condition) {
                if (($condition instanceof \Components\Validation && $condition->isValid())) {
                    $query[] = $condition->execute();
                }
            }

            parent::__construct((sizeof($query) ? sprintf("%s[%s]", $xpath, implode(sprintf(" %s ", $operator), $query)) : $xpath), [new Validator\NotEmpty]);
        }
    }
}