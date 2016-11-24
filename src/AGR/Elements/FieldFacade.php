<?php
namespace AGR\Elements;
use AGR\Validator\Validator;
use AGR\Interfaces\Element;

class FieldFacade{
    private $elements;

    public function __construct(){
        $this->elements = array();
    }

    public function createField($element){
        switch($element['class']){
            case 'textarea':
                echo "<textarea name=\"{$element['name']}\" rows=\"{$element['rows']}\" cols=\"{$element['cols']}\">{$element['content']}</textarea><br><br>\n";
                break;
            
            case 'input':
                echo "<input type=\"{$element['type']}\" name=\"{$element['name']}\" value=\"{$element['value']}\" /><br>";
                break;
            
            case 'text':
                echo "{$element['content']}<br>\n";
                break;

            case 'fieldset':
                echo "<fieldset><br>
                        <center>\n";
                break;
            
            case 'endFieldset':
                echo "  </center><br>
                     </fieldset><br>\n";
                break;

            case 'ul':
                echo "<ul><br>\n";
                break;
            
             case 'li':
                echo "<li>{$element['value']}</li><br>\n";
                break;

            case 'endul':
                echo "</ul><br>\n";
                break;

            case 'select':
                echo '<select><br>';
                
                foreach($element['options'] as $option){
                    echo "<option value='{$option['value']}'>{$option['content']}</option><br>";
                }

                echo '</select>';
                break;
        }
    }

    public function populate($dados, Validator $validator){
        $this->setErrors($validator->validate($dados, $this->elements));
        $this->populateFields($dados);
        return $this->elements;
    }

    private function populateFields($dados){
        $this->elements[] = array('class' => 'fieldset');
        $this->elements[] = array('class' => 'text', 'content' => 'Nome:');
        $this->elements[] = array('class' => 'input', 'type' => 'text', 'value' =>$dados['nome'], 'name' => 'nome');
        $this->elements[] = array('class' => 'text', 'content' => 'Valor:');
        $this->elements[] = array('class' => 'input', 'type' => 'numeric', 'value' =>$dados['valor'], 'name' => 'valor');
        $this->elements[] = array('class' => 'text', 'content' => 'Descrição:');
        $this->elements[] = array('class' => 'textarea', 'content' =>$dados['descricao'], 'name' => 'descricao', 'rows'=>10, 'cols'=>40);
        $this->elements[] = $dados['categorias'];
        $this->elements[] = array('class' => 'endFieldset');
    }

    private function setErrors($errors){
        $this->elements[] = array('class' => 'ul');

        foreach($errors as $erros){
            $this->elements[] = $erros;
        }

        $this->elements[] = array('class' => 'endul');
    }
}

?>