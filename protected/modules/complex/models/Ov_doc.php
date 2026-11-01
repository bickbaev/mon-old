<?php

/**
 * This is the model class for table "ov_doc".
 *
 * The followings are the available columns in table 'ov_doc':
 * @property string $id_doc
 * @property string $doc_naim
 */
class Ov_doc extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Ov_doc the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ov_doc';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('doc_naim', 'required'),
            array('doc_naim', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_doc, doc_naim', 'safe', 'on'=>'search'),
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
            'id_doc' => 'Id Doc',
            'doc_naim' => 'Выдаваемый документ',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id_doc',$this->id_doc,true);
        $criteria->compare('doc_naim',$this->doc_naim,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
} 