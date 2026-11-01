<?php

/**
 * This is the model class for table "mkf22".
 *
 * The followings are the available columns in table 'mkf22':
 * @property string $id_report
 * @property string $pok1
 * @property string $pok2
 * @property string $pok3
 * @property string $pok4
 * @property string $pok5
 * @property string $pok6
 * @property string $pok7
 * @property string $pok8
 * @property string $pok9
 * @property string $pok10
 * @property string $pok11
 * @property string $pok12
 * @property string $pok13
 * @property string $pok14
 * @property string $pok15
 * @property string $pok16
 * @property string $pok17
 * @property string $pok18
 * @property string $pok19
 * @property string $p_date
 */
class Mkf22 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mkf22';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19' , 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, p_date', 'safe', 'on'=>'search'),
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
            'id_report' => 'Id Report',
            'pok1' => 'Неприятие обучающегося в классе (ребенок-изгой)',
            'pok2' => 'Личное оскорбление со стороны ровесников (одноклассников/учащихся других классов)',
            'pok3' => 'Личное оскорбление со стороны обучающихся старшего возраста ("дедовщина")',
            'pok4' => 'Оскорбление личности друзей/ одноклассников; защита друга/одноклассника (цы)/девочки',
            'pok5' => 'Оскорбление личности родителей (близких) ученика со стороны другого ученика (группы лиц)',
            'pok6' => 'Борьба за лидерство в классе (группировки)',
            'pok7' => 'Оскорбление личности по национальному признаку',
            'pok8' => 'Неумение договариваться при столкновении интересов, несовпадении мнений по какой-либо теме (проблеме, вопросу)',
            'pok9' => 'Иные причины',
            'pok10' => 'В конфликт вовлечены обучающиеся разных национальностей, но причина не связана с проявлением национализма',
            'pok11' => 'Замечания учителя в связи с отношением обучающегося к учебе, пропусками занятий',
            'pok12' => 'Замечания учителя в связи с поведением обучающегося в школе и/или вне школы',
            'pok13' => 'Проявление агрессии обучающегося к педагогу(ам)',
            'pok14' => 'Иные причины',
            'pok15' => 'Недовольство родителя методами обучения/воспитания педагога',
            'pok16' => 'Личная неприязнь (между родителями, между родителем и учителем)',
            'pok17' => 'Недовольство родителя в связи с "занижением оценок" ребенку',
            'pok18' => 'Конфликты между родителями обучающихся',
            'pok19' => 'Иные причины',
            'p_date' => 'P Date',
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

        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('pok1',$this->pok1,true);
        $criteria->compare('pok2',$this->pok2,true);
        $criteria->compare('pok3',$this->pok3,true);
        $criteria->compare('pok4',$this->pok4,true);
        $criteria->compare('pok5',$this->pok5,true);
        $criteria->compare('pok6',$this->pok6,true);
        $criteria->compare('pok7',$this->pok7,true);
        $criteria->compare('pok8',$this->pok8,true);
        $criteria->compare('pok9',$this->pok9,true);
        $criteria->compare('pok10',$this->pok10,true);
        $criteria->compare('pok11',$this->pok11,true);
        $criteria->compare('pok12',$this->pok12,true);
        $criteria->compare('pok13',$this->pok13,true);
        $criteria->compare('pok14',$this->pok14,true);
        $criteria->compare('pok15',$this->pok15,true);
        $criteria->compare('pok16',$this->pok16,true);
        $criteria->compare('pok17',$this->pok17,true);
        $criteria->compare('pok18',$this->pok18,true);
        $criteria->compare('pok19',$this->pok19,true);
        $criteria->compare('p_date',$this->p_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Mkf22 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    protected function beforeSave()
    {
        $this->p_date=date('Y-m-d H:i:s', time());
        return TRUE;
    }     
}
