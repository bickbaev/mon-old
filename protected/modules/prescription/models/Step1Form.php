<?php
class Step1Form extends CFormModel
{
    public $id_type;
 
    public function rules()
    {
        return array(
            array('id_type', 'required'),
            array('id_type', 'in','range'=>range(1, 8)),
        );
    }
    
    public function attributeLabels()
    {
        return array(
            'id_type' => 'Выберите тип предписания',
        );
    }            
}
