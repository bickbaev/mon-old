<?php 
class InTableValidator extends CValidator
{
    public $table;
    public $valueColumn;
    public $message = 'Значение "{value}" не найдено в таблице {table}.{column}';
    
    protected function validateAttribute($object, $attribute)
    {
        $values = Yii::app()->db->createCommand()
            ->select($this->valueColumn)
            ->from($this->table)
            ->queryColumn();
            
        if (!in_array($object->$attribute, $values) && ($object->$attribute != '')) {
            $message = strtr($this->message, array(
                '{value}' => $object->$attribute,
                '{table}' => $this->table,
                '{column}' => $this->valueColumn,
            ));
            $this->addError($object, $attribute, $message);
        }
    }
}
?>