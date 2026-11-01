<?php

/**
 * This is the model class for table "post188".
 *
 * The followings are the available columns in table 'post188':
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
 * @property string $pok20
 * @property string $pok21
 * @property string $pok22
 * @property string $pok23
 * @property string $pok24
 * @property string $pok25
 * @property string $pok26
 * @property string $pok27
 * @property string $pok28
 * @property string $pok29
 * @property string $pok30
 * @property string $pok31
 * @property string $pok32
 * @property string $pok33
 * @property string $pok34
 * @property string $pok35
 * @property string $pok36
 * @property string $pok37
 * @property string $pok38
 * @property string $pok39
 * @property string $pok40
 * @property string $pok41
 * @property string $pok42
 * @property string $pok43
 * @property string $pok44
 * @property string $pok45
 * @property string $pok46
 * @property string $pok47
 */
class Post188 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'post188';
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
            array('id_report', 'length', 'max'=>8),
            array('pok27, pok31, pok35, pok39, pok43, pok47', 'length', 'max'=>5),
            array('pok27, pok31, pok35, pok39, pok43, pok47', 'numerical'),
            array('pok9, pok10, pok11, pok13, pok14, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok28, pok29, pok30, pok32, pok33, pok34, pok36, pok37, pok38, pok40, pok41, pok42, pok44, pok45, pok46, pok51, pok52, pok54', 'length', 'max'=>4),            
            array('pok9, pok10, pok11, pok13, pok14, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok28, pok29, pok30, pok32, pok33, pok34, pok36, pok37, pok38, pok40, pok41, pok42, pok44, pok45, pok46, pok48, pok50, pok51, pok52, pok54, pok56, pok58, pok60, pok62, pok63', 'numerical', 'integerOnly'=>true),
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok12, pok15, pok49, pok53, pok55, pok57, pok59, pok61, pok64', 'match', 'pattern'=>'/^[a-zA-Zа-яА-ЯёЁ0-9№,\.\(\)\-\«\»\:\;\s\"\_\?\!\=\%\&\/]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, латиницы, цифры, тире, точку, двоеточие, знак номера, скобки и кавычки, дробь'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok41, pok42, pok43, pok44, pok45, pok46, pok47', 'safe', 'on'=>'search'),
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
            'pok1' => 'Организация участия в межведомственной операции «Подросток» во взаимодействии с заинтересованными органами',
            'pok2' => 'Проведение в профессиональных образовательных организациях лекций и бесед профилактического характера об уголовной и административной ответственности несовершеннолетних за участие в противоправных действиях с приглашением представителей правоохранительных органов',
            'pok3' => 'Организация мероприятий по военно-патриотическому воспитанию несовершеннолетних и студентов и их отдыха в период летних каникул в военно-патриотических лагерях, лагерях труда и отдыха',
            'pok4' => 'Проведение в период зимних каникул комплексной профилактической операции «Каникулы» во взаимодействии с заинтересованными органами',
            'pok5' => 'Организация доступа досуговых центров, спортивных секций и залов, театров, кинотеатров, бассейнов, кружков, учебных курсов, Интернет-залов для внешкольной занятости несовершеннолетних',
            'pok6' => 'Организация временного трудоустройства и трудового воспитания несовершеннолетних граждан в возрасте от 14 до 18 лет в свободное от учебы время',
            'pok7' => 'Организация и проведение мероприятий, направленных на патриотическое воспитание молодежи, в каникулы и свободное от учебы время',
            'pok8' => 'Проведение научно-практических конференций по проблемам девиантного поведения подростков, профилактике наркомании и алкоголизма в молодежной среде с приглашением представителей заинтересованных органов',
            'pok9' => 'Количество заключенных договоров и (или) соглашений с заинтересованными органами (кол-во действующих на момент заполнения мониторинга соглашений по организации работы, направленной на предупреждение правонарушений несовершеннолетних)',
            'pok10' => 'Количество участников межведомственной операции «Подросток», проведенной при взаимодействии с заинтересованными органами (2,3 квартал, ТУ-МВД)',
            'pok11' => 'Количество лекций и бесед профилактического характера об уголовной и административной ответственности несовершеннолетних за участие в противоправных действиях с приглашением представителей правоохранительных органов',
            'pok12' => 'Тематика лекций и бесед профилактического характера об уголовной и административной ответственности несовершеннолетних за участие в противоправных действиях с приглашением представителей правоохранительных органов',
            'pok13' => 'Количество обучаемых – участников лекций и бесед профилактического характера об уголовной и административной ответственности несовершеннолетних за участие в противоправных действиях с приглашением представителей правоохранительных органов',
            'pok14' => 'Количество проведенных военно-патриотических мероприятий',
            'pok15' => 'Тематика проведенных военно-патриотических мероприятий',
            'pok16' => 'Количество обучаемых – участников проведенных военно-патриотических мероприятий',
            'pok17' => 'Количество обучаемых, занятых в период летних каникул в военно-патриотических лагерях, лагерях труда и отдыха',
            'pok18' => 'Количество обучаемых – участников в период зимних каникул комплексной профилактической операции «Каникулы» во взаимодействии с заинтересованными органами (1 квартал, ТУ-МВД)',
            'pok19' => 'Количество обучаемых, регулярно посещающих бассейны, спортивные секции и залы',
            'pok20' => 'Количество обучаемых, регулярно посещающих театры, кинотеатры',
            'pok21' => 'Количество обучаемых, регулярно посещающих кружки, учебные курсы, интернет-залы',
            'pok22' => 'Количество несовершеннолетних обучаемых в возрасте от 14 до 18 лет, временно трудоустроенных в свободное от учебы время',
            'pok23' => 'Количество проведенных научно-практических конференций по проблемам девиантного поведения подростков, профилактике наркомании и алкоголизма в молодежной среде с приглашением представителей заинтересованных органов',
            'pok24' => '',
            'pok25' => '',
            'pok26' => '',
            'pok27' => '',
            'pok28' => '',
            'pok29' => '',
            'pok30' => '',
            'pok31' => '',
            'pok32' => '',
            'pok33' => '',
            'pok34' => '',
            'pok35' => '',
            'pok36' => '',
            'pok37' => '',
            'pok38' => '',
            'pok39' => '',
            'pok40' => '',
            'pok41' => '',
            'pok42' => '',
            'pok43' => '',
            'pok44' => '',
            'pok45' => '',
            'pok46' => '',
            'pok47' => '',
            'pok48' => 'Количество мероприятий, способствующих предупреждению правонарушений несовершеннолетних на улицах и в других общественных местах, во взаимодействии с заинтересованными органами',
            'pok49' => 'Тематика мероприятий, способствующих предупреждению правонарушений несовершеннолетних на улицах и в других общественных местах, во взаимодействии с заинтересованными органами',
            'pok50' => 'Количество обучаемых — участников мероприятий, способствующих предупреждению правонарушений несовершеннолетних на улицах и в других общественных местах, во взаимодействии с заинтересованными органами',            
            'pok51' => 'Количество волонтеров из числа обучающихся (около 18-20% от контингента обучающихся по нац.проекту «Образование»).',            
            'pok52' => 'Количество волонтеров, принявших за отчетный период участие в федеральных проектах.',            
            'pok53' => 'Укажите наименование федеральных проектов.',            
            'pok54' => 'Количество волонтеров, принявших за отчетный период участие в региональных проектах.',            
            'pok55' => 'Укажите наименование региональных проектов.',            
            'pok56' => 'Количество мероприятий, способствующих обеспечению общественного порядка и безопасности граждан при проведении общественно-политических, культурно-зрелищных и спортивно-массовых мероприятий',
            'pok57' => 'Тематика мероприятий, способствующих обеспечению общественного порядка и безопасности граждан при проведении общественно-политических, культурно-зрелищных и спортивно-массовых мероприятий',
            'pok58' => 'Количество мероприятий в рамках межведомственной операции «Подросток» при взаимодействии с заинтересованными органами',
            'pok59' => 'Тематика мероприятий в рамках межведомственной операции «Подросток» при взаимодействии с заинтересованными органами',
            'pok60' => 'Количество бесед на нравственные темы с привлечением представителей религиозных конфессий',
            'pok61' => 'Тематика бесед на нравственные темы с привлечением представителей религиозных конфессий',
            'pok62' => 'Количество обучаемых-участников бесед на нравственные темы с привлечением представителей религиозных конфессий',
            'pok63' => 'Количество проведенных в период зимних каникул мероприятий в рамках комплексной профилактической операции «Каникулы» во взаимодействии с заинтересованными органами',
            'pok64' => 'Тематика поведенных в период зимних каникул мероприятий в рамках комплексной профилактической операции «Каникулы» во взаимодействии с заинтересованными органами',
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
        $criteria->compare('pok20',$this->pok20,true);
        $criteria->compare('pok21',$this->pok21,true);
        $criteria->compare('pok22',$this->pok22,true);
        $criteria->compare('pok23',$this->pok23,true);
        $criteria->compare('pok24',$this->pok24,true);
        $criteria->compare('pok25',$this->pok25,true);
        $criteria->compare('pok26',$this->pok26,true);
        $criteria->compare('pok27',$this->pok27,true);
        $criteria->compare('pok28',$this->pok28,true);
        $criteria->compare('pok29',$this->pok29,true);
        $criteria->compare('pok30',$this->pok30,true);
        $criteria->compare('pok31',$this->pok31,true);
        $criteria->compare('pok32',$this->pok32,true);
        $criteria->compare('pok33',$this->pok33,true);
        $criteria->compare('pok34',$this->pok34,true);
        $criteria->compare('pok35',$this->pok35,true);
        $criteria->compare('pok36',$this->pok36,true);
        $criteria->compare('pok37',$this->pok37,true);
        $criteria->compare('pok38',$this->pok38,true);
        $criteria->compare('pok39',$this->pok39,true);
        $criteria->compare('pok40',$this->pok40,true);
        $criteria->compare('pok41',$this->pok41,true);
        $criteria->compare('pok42',$this->pok42,true);
        $criteria->compare('pok43',$this->pok43,true);
        $criteria->compare('pok44',$this->pok44,true);
        $criteria->compare('pok45',$this->pok45,true);
        $criteria->compare('pok46',$this->pok46,true);
        $criteria->compare('pok47',$this->pok47,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Post188 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}

