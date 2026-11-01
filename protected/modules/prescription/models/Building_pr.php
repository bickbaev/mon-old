<?php

/**
 * This is the model class for table "building_pr".
 *
 * The followings are the available columns in table 'building_pr':
 * @property string $id_build
 * @property string $id_est
 * @property string $naim
 * @property integer $nas_punkt_type
 * @property string $nas_punkt
 * @property integer $street_type
 * @property string $street
 * @property string $dom
 * @property string $type_o
 * @property string $ur1
 * @property string $ur2
 * @property string $ur3
 * @property string $ur4
 * @property string $ur5
 * @property string $ur6
 * @property string $ur7
 * @property string $ur8
 */
class Building_pr extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'building_pr';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('naim, dom, street_type, type_o', 'required'),
            array('nas_punkt_type, street_type, id_est, type_o', 'numerical', 'integerOnly'=>true),
            array('type_o', 'in','range'=>array(1, 2, 3)),
            array('ur1, ur2, ur3, ur4, ur5, ur6, ur7, ur8', 'in','range'=>array(0, 1)),
            array('naim, nas_punkt, street, dom', 'length', 'max'=>255),
            array('nas_punkt, street', 'match', 'pattern'=>'/^[а-яА-Я0-9\-\s]*$/u', 'message'=>'В названии города, улицы можно использовать только буквы кириллицы, цифры и тире'),
            array('naim, dom', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9№,\?\.\(\)\-\:\s\"\/]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры, тире, точку, знак номера, скобки, дробь и кавычки'),
            array('nas_punkt_type', 'nas_type_val'),
            array('nas_punkt', 'nas_val'),
            array('ur1', 'ur'),
            array('street', 'street'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_build, id_est, naim, nas_punkt_type, nas_punkt, street_type, street, dom, korpus', 'safe', 'on'=>'search'),
        );
    }
    
    public function nas_type_val ($attribute,$params)
    { 
        $id_mun = Yii::app()->db->createCommand('select id_raion from est where id_est = '.$this->id_est)->queryScalar();
        if(!$this->nas_punkt_type && ($this->nas_punkt != '') && ($id_mun > 24)) $this->addError('nas_punkt_type','Необходимо выбрать тип населенного пункта');
    }

    public function nas_val ($attribute,$params)
    {            
        if(!$this->nas_punkt && ($this->nas_punkt_type != '' && $this->nas_punkt_type != 0)) $this->addError('nas_punkt','Необходимо заполнить название населенного пункта');
    }

    public function ur ($attribute,$params)
    {            
        if(!($this->ur1 + $this->ur2 + $this->ur3 + $this->ur4 + $this->ur5 + $this->ur6 + $this->ur7 + $this->ur8)) $this->addError('ur1','Необходимо выбрать хотя бы одну образовательную программу.');
    }

    public function street ($attribute,$params)
    {            
        if($this->street_type < 23 && ($this->street == '')) $this->addError('street','Необходимо заполнить название улицы');
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
            'id_est' => 'Id Est',
            'naim' => 'Наименование объекта',
            'nas_punkt_type' => 'Тип населенного пункта',
            'nas_punkt' => 'Населенный пункт, в котором находится учреждение',
            'street_type' => 'Тип улицы',
            'street' => 'Улица',
            'dom' => 'Дом',
            'type_o' => 'На объекте располагается',
            'ur1' => 'дошкольное образование',
            'ur2' => 'начальное общее образование',
            'ur3' => 'основное общее образование',
            'ur4' => 'среднее общее образование',
            'ur5' => 'дополнительное образование детей',
            'ur6' => 'среднее профессиональное образование',
            'ur7' => 'профессиональное обучение',
            'ur8' => 'дополнительное профессиональное образование',
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

        $criteria->compare('id_build',$this->id_build,true);
        $criteria->compare('id_est',$this->id_est,true);
        $criteria->compare('naim',$this->naim,true);
        $criteria->compare('nas_punkt_type',$this->nas_punkt_type);
        $criteria->compare('nas_punkt',$this->nas_punkt,true);
        $criteria->compare('street_type',$this->street_type);
        $criteria->compare('street',$this->street,true);
        $criteria->compare('dom',$this->dom,true);
        $criteria->compare('type_o',$this->type_o,true);
        $criteria->compare('ur1',$this->ur1,true);
        $criteria->compare('ur2',$this->ur2,true);
        $criteria->compare('ur3',$this->ur3,true);
        $criteria->compare('ur4',$this->ur4,true);
        $criteria->compare('ur5',$this->ur5,true);
        $criteria->compare('ur6',$this->ur6,true);
        $criteria->compare('ur7',$this->ur7,true);
        $criteria->compare('ur8',$this->ur8,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Building_pr the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public static function type_o()
    {
        return array(1 => 'Юридическое лицо', 2 => 'Структурное подразделение', 3 => 'Филиал');
    }
    
    public function type_o_print()
    {
        $type_o = $this->type_o();
        return $type_o[$this->type_o];
    }    
    
    public function ur_print()
    {
        $res = '';
        for($i = 1; $i < 9; $i++) {
            $ur = 'ur'.$i;
            if($this->$ur) {
                if($res == '') $res = $this->getAttributeLabel($ur);
                else $res = $res.', '.$this->getAttributeLabel($ur);
            }
        }
        return $res;
    }
    
    public function pr_count() {
        $pr = Yii::app()->db->createCommand('select count(id_pr) from pr_pred where id_build = '.$this->id_build)->queryScalar();
        return $pr;
    }
}