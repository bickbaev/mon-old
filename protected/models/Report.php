<?php

/**
 * This is the model class for table "report".
 *
 * The followings are the available columns in table 'report':
 * @property string $id_report
 * @property string $id_rep_type
 * @property integer $id_est
 * @property integer $status
 * @property string $prov
 */
class Report extends CActiveRecord
{
    public $id_okr;
    public $id_raion;
    public $id_type;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Report the static model class
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
        return 'report';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_rep_type, id_est', 'required'),
            array('id_est, status', 'numerical', 'integerOnly'=>true),
            array('id_rep_type', 'length', 'max'=>5),
            array('prov', 'length', 'max'=>1),
            array('id_okr', 'InTableValidator', 
                'table' => 'est',
                'valueColumn' => 'id_okr',
                'message' => 'Указанного значения не существует',
            ), 
            array('id_raion', 'InTableValidator', 
                'table' => 'est',
                'valueColumn' => 'id_raion',
                'message' => 'Указанного значения не существует',
            ), 
            array('id_type', 'InTableValidator', 
                'table' => 'est',
                'valueColumn' => 'pid_est',
                'message' => 'Указанного значения не существует',
            ),             
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, id_rep_type, id_est, status, prov', 'safe', 'on'=>'search'),
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
            'est'=>array(self::BELONGS_TO, 'Est', 'id_est'),
            'contact_info'=>array(self::HAS_MANY, 'Contact_info', 'id_report'),
            'rep_name'=>array(self::BELONGS_TO, 'RepName', 'id_rep_type'),
            'ws25'=> array(self::HAS_ONE, 'Ws25_comp', array('id_rep_type' => 'id_rep_type')),
            'abi25_comp_link' => array(self::HAS_ONE, 'Abi25_comp', array('id_rep_type' => 'id_rep_type')),
            'abi25_fv_comp_link' => array(self::HAS_ONE, 'Abi25_fv_comp', array('id_rep_type' => 'id_rep_type')),
            'abi25_zp_comp_link' => array(self::HAS_ONE, 'Abi25_zp_comp', array('id_rep_type' => 'id_rep_type')),
            //'abi25_comp_link' => array(self::BELONGS_TO, 'Abi25_comp', 'id_rep_type'),
            'abi25_parts_link' => array(self::HAS_MANY, 'Abi25_part', 'id_report'),            
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_report' => 'Id Report',
            'id_rep_type' => 'Id Rep Type',
            'id_est' => 'Организация',
            'status' => 'Status',
            'prov' => 'Prov',
            'id_okr' => 'ТУ/ДО',
            'id_raion' => 'Муниципалитет',
            'id_type' => 'Тип организации',
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

        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('id_rep_type',$this->id_rep_type,true);
        $criteria->compare('id_est',$this->id_est);
        $criteria->compare('status',$this->status);
        $criteria->compare('prov',$this->prov,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
} 