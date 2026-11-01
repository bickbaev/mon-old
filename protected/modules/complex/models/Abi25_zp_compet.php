<?php

/**
 * This is the model class for table "abi25_zp_compet".
 *
 * The followings are the available columns in table 'abi25_zp_compet':
 * @property string $id
 * @property string $naim
 * @property integer $jun
 * @property integer $osn1
 * @property integer $osn2
 */
class Abi25_zp_compet extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'abi25_zp_compet';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('naim', 'required'),
            array('jun, osn1, osn2, id_comp', 'numerical', 'integerOnly'=>true),
            array('naim', 'length', 'max'=>255),
            array('nov, red', 'in','range'=>array(0,1)),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, naim, jun, osn1, osn2', 'safe', 'on'=>'search'),
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
            'id' => 'ID',
            'naim' => 'Naim',
            'jun' => 'Jun',
            'osn1' => 'Osn1',
            'osn2' => 'Osn2',
            'nov' => 'Создание новых заявок',
            'red' => 'Редактирование заявок',             
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
    public function search($id_comp)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        if (!empty($id_comp)) {
            $criteria->addCondition('id_comp = :id_comp');
            $criteria->params[':id_comp'] = $id_comp;
        } 

        $criteria->compare('id',$this->id,true);
        $criteria->compare('naim',$this->naim,true);
        $criteria->compare('jun',$this->jun);
        $criteria->compare('osn1',$this->osn1);
        $criteria->compare('osn2',$this->osn2);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Abi25_zp_compet the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}