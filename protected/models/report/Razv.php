<?php

/**
 * This is the model class for table "razv".
 *
 * The followings are the available columns in table 'razv':
 * @property integer $id_report
 * @property integer $program
 * @property integer $s_year
 * @property integer $f_year
 * @property integer $sogl
 * @property string $sogl_date
 * @property string $naim_sogl
 * @property integer $expert
 * @property string $expert_fio
 * @property string $expert_dol
 * @property string $expert_date
 * @property string $expert_mesto
 * @property string $remark
 */
class Razv extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Razv the static model class
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
        return 'razv';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report', 'required'),
            array('id_report, program, sogl, expert, s_year, f_year' , 'numerical', 'integerOnly'=>true),
            array('program, sogl, expert', 'in', 'range'=>array(0, 1)),
            array('s_year', 'numerical', 'min' => 2000),
            array('s_year', 'numerical', 'max' => 2012),
            array('f_year', 'numerical', 'min' => 2012),
            array('f_year', 'numerical', 'max' => 2025),
            array('naim_sogl, expert_fio, expert_dol, expert_mesto', 'length', 'max'=>255),
            array('naim_sogl, expert_fio, expert_dol, expert_mesto', 'match', 'pattern'=>'/^[а-яА-я0-9,\.\-\s]*$/u', 'message'=>'В данном показателе можно использовать только буквы кириллицы, цифры и тире'),
            array('sogl_date, expert_date', 'type', 'type'=>'date', 'dateFormat'=>'dd.MM.yyyy', 'message'=>'Неправильный формат даты'),
            array('sogl_date, expert_date, remark', 'safe'),
            array('remark', 'length', 'max'=>65535),
            array('remark', 'match', 'pattern'=>'/^[а-яА-я0-9\-\s]*$/u', 'message'=>'В замечаниях можно использовать только буквы кириллицы, цифры и тире'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('program, s_year, f_year, sogl, sogl_date, naim_sogl, expert, expert_fio, expert_dol, expert_date, remark', 'safe', 'on'=>'search'),
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
            'program' => 'Учреждение имеет действующую программу развития',
            's_year' => 'Год начала действия программы развития образовательного учреждения',
            'f_year' => 'Год окончания действия программы развития образовательного учреждения',
            'sogl' => 'Программа развития образовательного учреждения утверждена (согласована) органом государственно-общественного управления учреждением (общественного участия в управлении учреждением)',
            'sogl_date' => 'Дата утверждения (согласования) программы развития образовательного учреждения',
            'naim_sogl' => 'Наименование органа государственно-общественного управления образовательным учреждением (общественного участия в управлении учреждением), утвердивший (согласовавший) программу развития',
            'expert' => 'Наличие заключения по результатам экспертизы программы развития образовательного учреждения',
            'expert_fio' => 'ФИО (полностью) эксперта(ов), проводившего(их) экспертизу программы развития образовательного учреждения',
            'expert_dol' => 'Должность эксперта(ов), проводившего(их) экспертизу программы развития образовательного учреждения',
            'expert_date' => 'Дата проведения экспертизы',
            'expert_mesto' => 'Место работы эксперта(ов), проводившего(их) экспертизу программы развития образовательного учреждения (указывается только название организации, адрес указывать не надо)',
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
        $criteria->compare('program',$this->program,true);
        $criteria->compare('s_year',$this->s_year,true);
        $criteria->compare('f_year',$this->f_year,true);
        $criteria->compare('sogl',$this->sogl,true);
        $criteria->compare('sogl_date',$this->sogl_date,true);
        $criteria->compare('naim_sogl',$this->naim_sogl,true);
        $criteria->compare('expert',$this->expert,true);
        $criteria->compare('expert_fio',$this->expert_fio,true);
        $criteria->compare('expert_dol',$this->expert_dol,true);
        $criteria->compare('expert_date',$this->expert_date,true);
        $criteria->compare('remark',$this->remark,true);
        $criteria->compare('expert_mesto',$this->expert_date,true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }

    protected function beforeSave()
    {
    if($this->expert_date != '') $this->expert_date=date('Y-m-d', strtotime($this->expert_date));
    if($this->sogl_date != '') $this->sogl_date=date('Y-m-d', strtotime($this->sogl_date));
    return TRUE;
    }

    protected function afterFind()
    {
    if($this->expert_date == '0000-00-00' || $this->expert_date == '') $this->expert_date='';
    else $this->expert_date=date('d.m.Y', strtotime($this->expert_date));
    if($this->sogl_date == '0000-00-00' || $this->sogl_date == '') $this->sogl_date ='';
    else $this->sogl_date=date('d.m.Y', strtotime($this->sogl_date));
    if($this->s_year == '0') $this->s_year ='';
    if($this->f_year == '0') $this->f_year ='';
    }
} 