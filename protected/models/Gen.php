<?php

/**
 * This is the model class for table "gen".
 *
 * The followings are the available columns in table 'gen':
 * @property string $id_gen
 * @property string $rep_name
 * @property string $type
 * @property string $chislo
 * @property string $mes
 * @property string $god
 * @property string $prodol
 * @property string $zakr
 * @property string $compl
 * @property string $type_adm
 * @property string $id_type
 * @property string $rep_mv
 * @property string $date_type
 * @property string $rep_type
 * @property string $status
 */
class Gen extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Gen the static model class
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
        return 'gen';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('rep_name, type, rep_mv, date_type, rep_type', 'required'),
            array('rep_name, id_type, rep_mv', 'length', 'max'=>255),
            array('type, chislo, mes, date_type, status', 'length', 'max'=>2),
            array('god', 'length', 'max'=>4),
            array('prodol, zakr, rep_type', 'length', 'max'=>5),
            array('compl', 'length', 'max'=>1),
            array('type_adm', 'length', 'max'=>3),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_gen, rep_name, type, chislo, mes, god, prodol, zakr, compl, type_adm, id_type, rep_mv, date_type, rep_type, status', 'safe', 'on'=>'search'),
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
            'id_gen' => 'Id Gen',
            'rep_name' => 'Rep Name',
            'type' => 'Type',
            'chislo' => 'Chislo',
            'mes' => 'Mes',
            'god' => 'God',
            'prodol' => 'Prodol',
            'zakr' => 'Zakr',
            'compl' => 'Compl',
            'type_adm' => 'Type Adm',
            'id_type' => 'Id Type',
            'rep_mv' => 'Rep Mv',
            'date_type' => 'Date Type',
            'rep_type' => 'Rep Type',
            'status' => 'Status',
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

        $criteria->compare('id_gen',$this->id_gen,true);
        $criteria->compare('rep_name',$this->rep_name,true);
        $criteria->compare('type',$this->type,true);
        $criteria->compare('chislo',$this->chislo,true);
        $criteria->compare('mes',$this->mes,true);
        $criteria->compare('god',$this->god,true);
        $criteria->compare('prodol',$this->prodol,true);
        $criteria->compare('zakr',$this->zakr,true);
        $criteria->compare('compl',$this->compl,true);
        $criteria->compare('type_adm',$this->type_adm,true);
        $criteria->compare('id_type',$this->id_type,true);
        $criteria->compare('rep_mv',$this->rep_mv,true);
        $criteria->compare('date_type',$this->date_type,true);
        $criteria->compare('rep_type',$this->rep_type,true);
        $criteria->compare('status',$this->status,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
} 