<?php

/**
 * This is the model class for table "placement_spec".
 *
 * The followings are the available columns in table 'placement_spec':
 * @property string $id_spec
 * @property string $id_report
 * @property string $id_po
 * @property string $p_in
 * @property string $p_out
 */
class Placement_spec extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'placement_spec';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, id_po, p_in, p_out', 'required'),
            array('id_po', 'po_prov'),
            array('id_report, p_out', 'numerical', 'integerOnly'=>true),
            array('p_in', 'numerical', 'integerOnly'=>true, 'min' => '1'),
            array('id_report', 'length', 'max'=>10),
            array('id_po', 'length', 'max'=>9),
            array('p_in, p_out', 'length', 'max'=>4),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_spec, id_report, id_po, p_in', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_spec' => 'Id Spec',
            'id_report' => 'Id Report',
            'id_po' => 'Код профессии/специальности (новый)',
            'p_in' => 'Численность учащихся первоначально принятых по данной профессии/специальности',
            'p_out' => 'Всего выпущенно по данной профессии/специальности отчетный период',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id_spec',$this->id_spec,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('id_po',$this->id_po,true);
        $criteria->compare('p_in',$this->p_in,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Placement_spec the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function po_prov($attribute) {
        $prof = Po_new::model()->findByPk($this->id_po);
        if(!$prof) {$this->addError('id_po','Неверный код профессии/специальности.');}
    }     
}
