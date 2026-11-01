<?php

/**
 * This is the model class for table "atz25_adr".
 *
 * The followings are the available columns in table 'atz25_adr':
 * @property string $id
 * @property string $id_obj
 * @property integer $id_mun
 * @property integer $nas_punkt_type
 * @property string $nas_punkt
 * @property integer $street_type
 * @property string $street
 * @property string $dom

 * @property string $kad_num
 */
class Atz25_adr extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'atz25_adr';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_mun, dom, obj_index, obj_name, street_type', 'required'),
            array('id_mun, nas_punkt_type, street_type', 'numerical', 'integerOnly'=>true),
            array('id_obj', 'length', 'max'=>10),
            array('nas_punkt, street, dom', 'length', 'max'=>255),
            array('dom, obj_name', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9\-\/\s]*$/u', 'message'=>'В строке "{attribute}" можно использовать только цифры, буквы кириллицы, дефис и дробь'),
            array('obj_index', 'match', 'pattern' => '/^[0-9]{6}$/', 'message' => 'Почтовый индекс должен состоять из 6 цифр.'),            
            array('nas_punkt_type', 'nas_type_val'),
            array('street_type', 'street_type_val'),
            array('nas_punkt', 'nas_val'),
            array('street', 'street_val'),
            array('nas_punkt_type', 'InTableValidator', 
                'table' => 'contact_gor',
                'valueColumn' => 'id_contact_gor',
                'message' => 'Указанного типа населенного пункта не существует',
            ), 
            array('street_type', 'InTableValidator', 
                'table' => 'contact_ul',
                'valueColumn' => 'id_contact_ul',
                'message' => 'Указанного типа улицы не существует',
            ),
            array('id_mun', 'InTableValidator', 
                'table' => 'mun',
                'valueColumn' => 'id_mun',
                'message' => 'Указанного муниципалитета не существует',
            ),             
            
            array('kad_num', 'required'),
            array('kad_num', 'match', 'pattern'=>'/^\d{2}:\d{2}:\d{6,7}:\d{1,4}$/', 'message'=>'Некорректный кадастровый номер'),
            //array('kad_num', 'unique', 'message'=>'Такой кадастровый номер уже существует'),            
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, id_obj, id_mun, nas_punkt_type, nas_punkt, street_type, street, dom, kad_num', 'safe', 'on'=>'search'),
        );
    }
    
    public function nas_type_val ($attribute,$params)
    {            
        if(!$this->nas_punkt_type && ($this->id_mun > 10)) $this->addError('nas_punkt_type','Необходимо выбрать тип населенного пункта');
    }
    
    public function street_type_val ($attribute,$params)
    {            
        if(!$this->street_type && ($this->street != '')) $this->addError('street_type','Необходимо выбрать тип улицы.');
    }

    public function nas_val ($attribute,$params)
    {            
        if(!$this->nas_punkt && ($this->nas_punkt_type != '' && $this->nas_punkt_type != 0)) $this->addError('nas_punkt','Необходимо заполнить название населенного пункта');
    }
    
    public function street_val ($attribute,$params)
    {            
        if(!$this->street && ($this->street_type != '') && ($this->street_type != 22)) $this->addError('street','Необходимо заполнить название улицы.');
    }    

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'obj' => [self::BELONGS_TO, 'Atz25_obj', array('id_obj'=>'id')],
            'mun_link' => [self::BELONGS_TO, 'Mun', array('id_mun'=>'id_mun')],
            'nas_punkt_type_link' => [self::BELONGS_TO, 'Contact_gor', array('nas_punkt_type'=>'id_contact_gor')],
            'street_type_link' => [self::BELONGS_TO, 'Contact_ul', array('street_type'=>'id_contact_ul')],
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'id_obj' => 'Id Obj',
            'id_mun' => 'Муниципалитет',
            'nas_punkt_type' => 'Тип населенного пункта',            
            'nas_punkt' => 'Название населенного пункта',
            'street_type' => 'Тип улицы',            
            'street' => 'Название улицы',
            'dom' => 'Номер дома',
            'kad_num' => 'Кадастровый номер',
            'obj_index' => 'Индекс',
            'obj_name' => 'Название объекта недвижимости в составе объекта (основное здание, второе здание, третье здание, филиал, структурное подразделение, мастерские, столовая, гараж и т.д.) ',
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

        $criteria->compare('id',$this->id,true);
        $criteria->compare('id_obj',$this->id_obj,true);
        $criteria->compare('id_mun',$this->id_mun);
        $criteria->compare('nas_punkt_type',$this->nas_punkt_type);
        $criteria->compare('nas_punkt',$this->nas_punkt,true);
        $criteria->compare('street_type',$this->street_type);
        $criteria->compare('street',$this->street,true);
        $criteria->compare('dom',$this->dom,true);
        $criteria->compare('kad_num',$this->kad_num,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Atz25_adr the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
