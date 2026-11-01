<?php
class Step2Form extends CFormModel
{
    public $id_pr;
 
    public function rules()
    {
        return array(
            array('id_pr', 'required'),
            array('id_pr', 'in', 'range'=>range(1, 23), 'on'=>'pr_atz'),
            array('id_pr', 'in', 'range'=>range(1, 24), 'on'=>'pr_pb'),
        );
    }
    
    public function attributeLabels()
    {
        return array(
            'id_pr' => 'Выберите наименования мероприятия предписания',
        );
    }            
}
