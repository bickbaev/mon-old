<?php

/**
 * This is the model class for table "vpo_data".
 *
 * The followings are the available columns in table 'vpo_data':
 * @property string $id_vpo
 * @property string $id_report
 * @property string $id_faculty
 * @property string $code_vpo
 * @property string $profil
 * @property integer $id_forma
 * @property integer $srok
 * @property string $isp
 * @property integer $budget
 * @property integer $war
 * @property string $zdorov
 * @property string $link
 * @property string $stoim
 * @property string $bud
 * @property string $vbud
 * @property string $pr1
 * @property string $pr2
 * @property string $pr3
 * @property string $pr4
 * @property string $pr5
 * @property string $pr6
 * @property string $pr7
 * @property string $pr8
 * @property string $pr9
 * @property string $pr10
 * @property string $pr11
 * @property string $pr12
 * @property string $pr13
 * @property string $pr14
 */
class Vpo_data extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'vpo_data';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, id_faculty, code_vpo, profil, id_forma, srok, bud, vbud', 'required'),
            array('id_report, id_faculty, id_forma, srok, budget, war, bud, vbud', 'numerical', 'integerOnly'=>true),
            array('stoim', 'numerical'),
            array('id_report, id_faculty', 'length', 'max'=>10),
            array('bud, vbud', 'length', 'max'=>4),
            array('code_vpo', 'length', 'max'=>9),
            array('code_vpo', 'po_prov'),
            array('pr1', 'ege'),
            array('profil, zdorov, link', 'length', 'max'=>255),
            array('link', 'url'),
            array('pr1, pr2, pr3, pr4, pr5, pr6, pr7, pr8, pr9, pr10, pr11, pr12, pr13, pr14', 'in','range'=>range(0,1)),
            array('isp, zdorov', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9№,\.\(\)\-\s\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры, тире, точку, знак номера, скобки и кавычки'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_vpo, id_report, id_faculty, code_vpo, profil, id_forma, srok, isp, budget, war, zdorov, link', 'safe', 'on'=>'search'),
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
            'id_vpo' => 'Id Vpo',
            'id_report' => 'Id Report',
            'id_faculty' => 'Id Faculty',
            'code_vpo' => 'Код специальности',
            'profil' => 'Профиль подготовки',
            'id_forma' => 'Форма обучения',
            'srok' => 'Срок обучения в месяцах',
            'isp' => 'Перечень вступительных испытаний',
            'budget' => 'Наличие бюджетных мест',
            'war' => 'Наличие военной кафедры',
            'zdorov' => 'ограничения по здоровью',
            'link' => 'Ссылка на страницу с более подробной информацией об образовательной программе',
            'bud' => 'Число бюджетных мест',
            'vbud' => 'Число внебюджетных мест',
            'stoim' => 'Стоимость обучения на внебюджетных местах в год, руб.',
            'pr1' => 'Русский язык',
            'pr2' => 'Математика (базовая)',
            'pr3' => 'Математика (профильная)',
            'pr4' => 'Физика',
            'pr5' => 'Химия',
            'pr6' => 'История',
            'pr7' => 'Обществознание',
            'pr8' => 'Информатика и информационно-коммуникационные технологии (ИКТ)',
            'pr9' => 'Биология',
            'pr10' => 'География',
            'pr11' => 'Иностранный язык',
            'pr12' => 'Литература',  
            'pr13' => 'Собеседование',
            'pr14' => 'Творческий конкурс',
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

        $criteria->compare('id_vpo',$this->id_vpo,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('id_faculty',$this->id_faculty,true);
        $criteria->compare('code_vpo',$this->code_vpo,true);
        $criteria->compare('profil',$this->profil,true);
        $criteria->compare('id_forma',$this->id_forma);
        $criteria->compare('srok',$this->srok);
        $criteria->compare('isp',$this->isp,true);
        $criteria->compare('budget',$this->budget);
        $criteria->compare('war',$this->war);
        $criteria->compare('zdorov',$this->zdorov,true);
        $criteria->compare('link',$this->link,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Vpo_data the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function po_prov($attribute) {
        $prof = Vpo_code::model()->findByPk($this->code_vpo);
        if(!$prof) $this->addError('code_vpo','Неверный код специальности');
    }    
    
    public function ege($attribute) {
        $res = 0;
        for($i = 1; $i < 15; $i++) {
            $pok = 'pr'.$i;
            $res = $res + $this->$pok;
        }
        if(!$res) $this->addError('pr1','Необходимо выбрать хотя бы один предмет ЕГЭ или собеседование');
    }     
}
