<?php

/**
 * This is the model class for table "siroty_cont".
 *
 * The followings are the available columns in table 'siroty_cont':
 * @property string $id_report
 * @property string $vsego
 * @property string $vsego_gos
 * @property string $priem
 * @property integer $izm
 * @property string $kurs1
 * @property string $kurs2
 * @property string $kurs3
 * @property string $kurs4
 * @property string $kurs5
 * @property string $exit_plan
 * @property string $exit_plan_gos
 * @property string $exit_plan_money
 * @property string $obsh
 * @property string $isp
 * @property string $tel
 */
class Siroty_cont extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Siroty_cont the static model class
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
        return 'siroty_cont';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('isp, tel', 'required'),
            array('id_report, vsego, priem, izm, kurs1, kurs2, kurs3, kurs4, kurs5, exit_plan, obsh, vsego_gos, exit_plan_gos, exit_plan_money, exit_trud, exit_ptrud, exit_obuch, exit_arm, exit_bez', 'numerical', 'integerOnly'=>true),
            array('vsego, priem, kurs1, kurs2, kurs3, kurs4, exit_plan, obsh, exit_trud, exit_ptrud, exit_obuch, exit_arm, exit_bez', 'length', 'max'=>5),
            array('isp, tel', 'length', 'max'=>255),            
            array('isp', 'match', 'pattern'=>'/^[а-яА-Я\-\s]*$/u', 'message'=>'В имени, фамилии и отчестве можно использовать только буквы кириллицы, цифры и тире'),
            array('tel', 'match', 'pattern'=>'/^[0-9\(\)\-\s]*$/u', 'message'=>'В контактном телефоне можно использовать только цифры, тире и скобки'),
            array('isp, tel','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, vsego, priem, izm, kurs1, kurs2, kurs3, kurs4, kurs5, exit_plan, obsh, isp, tel', 'safe', 'on'=>'search'),
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
            'vsego' => 'Всего сирот, чел.',
            'vsego_gos'=>'Из общего числа сирот находятся на полном государственном обеспечении, чел.',
            'priem' => 'Из общего числа сирот приняты на обучение в отчётном месяце, чел.',
            'izm' => 'Другие изменения контингента детей-сирот (отчисление, приобретение или утрата статуса), чел.',
            'kurs1' => 'I курс, чел.',
            'kurs2' => 'II курс, чел.',
            'kurs3' => 'III курс, чел.',
            'kurs4' => 'IV курс, чел.',
            'kurs5' => 'V курс, чел.',
            'exit_plan' => 'Планируемый выпуск сирот, чел.',
            'exit_plan_gos' => 'Из общего числа сирот планируемых к выпуску, находятся на полном государственном обеспечении, чел.',
            'exit_plan_money' => 'Из общего числа сирот планируемых к выпуску, будут получать денежные средства в связи с выпуском, чел.',
            'exit_trud' => 'Количество трудоустроенных, чел.', 
            'exit_ptrud' => 'Количество запланированных к трудоустройству, чел.', 
            'exit_obuch' => 'Количество продолжающих обучение, чел.', 
            'exit_arm' => 'Количество призванных в армию, чел.', 
            'exit_bez' => 'Количество нетрудоустроенных, чел.',            
            'obsh' => 'Проживают в общежитии, чел.',
            'isp' => 'ФИО исполнителя отчета',
            'tel' => 'Контактый телефон исполнителя (с кодом города)',
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
        $criteria->compare('vsego',$this->vsego,true);
        $criteria->compare('vsego_gos',$this->vsego_gos,true);
        $criteria->compare('priem',$this->priem,true);
        $criteria->compare('izm',$this->izm);
        $criteria->compare('kurs1',$this->kurs1,true);
        $criteria->compare('kurs2',$this->kurs2,true);
        $criteria->compare('kurs3',$this->kurs3,true);
        $criteria->compare('kurs4',$this->kurs4,true);
        $criteria->compare('kurs5',$this->kurs5,true);
        $criteria->compare('exit_plan',$this->exit_plan,true);
        $criteria->compare('exit_plan_gos',$this->exit_plan_gos,true);
        $criteria->compare('exit_plan_money',$this->exit_plan_money,true);
        $criteria->compare('obsh',$this->obsh,true);
        $criteria->compare('isp',$this->isp,true);
        $criteria->compare('tel',$this->tel,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}