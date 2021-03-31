<?php
namespace Modules\Node {
    use Components\Validator;
    use Components\Validation;
    abstract class Model extends \Components\Core\Adapter\Mapper\Model {
        use \Modules\Node;
        public function __construct(array $parameters = []) {
            parent::__construct([
                "document" => new Validation(false, [new Validator\IsString\IsFile, new Validator\IsString\IsUrl]),
                "node" => new Validation(false, [new Validator\IsObject\Of("\DOMElement")]),
                "tag" => new Validation(false, array(new Validator\IsString)),
                "path" => new Validation(false, array(new Validator\IsString\IsPath)),                
                "current" => new Validation(false, array(new Validator\IsString)),
                "parent" => new Validation(false, array(new Validator\IsString))
            ] + $parameters);
        }
        
        public function setup() {
            $this->path = preg_replace('/\[(.*?)\]/', false, $this->node->getNodePath());  
            $this->label = ucFirst(strtolower($this->node->tagName));
            $this->class = ucFirst(strtolower($this->node->tagName));
            $this->tag = $this->node->tagName;
            $this->primary = ["current" => "current"];
            $this->keys = ["parent" => "parent"];
            
            if (isset($this->namespace) && $this->node->parentNode->nodeName !== "#document") {
                $this->namespace = $this->namespace . implode("\\", array_map("ucFirst", explode(DIRECTORY_SEPARATOR, dirname($this->path))));
            }    
            
            if ($this->node->hasAttributes()) {
                foreach ($this->node->attributes as $attribute) {
                    $parameter = new \Components\Validation\Parameter($this->labelize($attribute->nodeName), (!empty(trim($attribute->value)) ? trim($attribute->value) : false), false, true);
                    $this->add((string) $parameter, $parameter->getValidation($parameter->getValidators()));
                    $this->mapping = [$attribute->nodeName => (string) $parameter];
                }            
            }           
            
            $this->add($this->label, new Validation(false, [new Validator\NotEmpty, new Validator\NotArray], Validation::STRICT));            
            $this->remove("node");
        }
    }
}
