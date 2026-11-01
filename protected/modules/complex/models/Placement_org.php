<?php

/**
 * This is the model class for table "placement_org".
 *
 * The followings are the available columns in table 'placement_org':
 * @property string $id_org
 * @property string $id_spec
 * @property string $p_out
 * @property string $id_est
 * @property string $est
 * @property string $prik
 */
class Placement_org extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'placement_org';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_spec, p_out, id_est, prik', 'required'),
            array('id_org, id_spec, p_out, id_est', 'numerical', 'integerOnly'=>true),
            array('id_spec', 'length', 'max'=>10),
            array('p_out', 'length', 'max'=>4),
            array('id_est', 'length', 'max'=>2),
            array('est', 'length', 'max'=>255),
            array('id_est', 'in','range'=>range(1,7)),            
            array('prik, est', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9№,\.\(\)\-\s\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры, тире, точку, знак номера, скобки и кавычки'),            
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_org, id_spec, p_out, id_est, est, prik', 'safe', 'on'=>'search'),
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
            'id_org' => 'Id Org',
            'id_spec' => 'Id Spec',
            'p_out' => 'Численность трудоустроенных на предприятии выпускников',
            'id_est' => 'Работодатель',
            'est' => 'другой работодатель',
            'prik' => 'Реквизиты подтверждающего документа (например, номер и дата приказа о приеме на работу). Если документов несколько, укажите все через запятую',
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

        $criteria->compare('id_org',$this->id_org,true);
        $criteria->compare('id_spec',$this->id_spec,true);
        $criteria->compare('p_out',$this->p_out,true);
        $criteria->compare('id_est',$this->id_est,true);
        $criteria->compare('est',$this->est,true);
        $criteria->compare('prik',$this->prik,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Placement_org the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}

