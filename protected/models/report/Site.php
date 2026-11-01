<?php

/**
 * This is the model class for table "site".
 *
 * The followings are the available columns in table 'site':
 * @property string $id_report
 * @property string $site2
 * @property string $pok1
 * @property string $pok2
 * @property string $pok3
 * @property string $pok4
 * @property string $pok5
 * @property string $pok7
 * @property string $pok8
 * @property string $pok9
 * @property string $pok10
 * @property string $pok12
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
 * @property string $p_date
 * @property string $remark
 */
class Site extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Site the static model class
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
        return 'site';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('site2', 'length', 'max'=>255),
            array('site2', 'url'),
            array('pok1, pok2, pok3, pok4, pok5, pok7, pok8, pok9, pok10, pok12, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35', 'length', 'max'=>1),
            array('pok1, pok2, pok3, pok4, pok5, pok7, pok8, pok9, pok10, pok12, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35', 'numerical', 'integerOnly'=>true),
            array('remark, p_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, site2, pok1, pok2, pok3, pok4, pok5, pok7, pok8, pok9, pok10, pok12, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, p_date, remark', 'safe', 'on'=>'search'),
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
            'site2' => 'Сайт',
            'pok1' => 'о дате создания ',
            'pok2' => 'учредитель',
            'pok3' => 'директор',
            'pok4' => 'структурные подразделения',
            'pok5' => 'образовательные программы',
            'pok7' => 'состав педагогов',
            'pok8' => 'материально-техническое обеспечение',
            'pok9' => 'об электронных образовательных ресурсах',
            'pok10' => 'о научно-исследовательской деятельности',
            'pok12' => 'о стипендии',
            'pok14' => 'платные услуги',
            'pok15' => 'самообследование',
            'pok16' => 'лицензия',
            'pok17' => 'аккредитация',
            'pok18' => 'план финансово-хозяйственной деятельности',           
            'pok19' => 'учредительные документы государственного (муниципального) учреждения, в том числе внесенные в них изменения',
            'pok20' => 'свидетельство о государственной регистрации государственного (муниципального) учреждения',
            'pok21' => 'решение о создании',
            'pok22' => 'решение о назначении руководителя',
            'pok23' => 'положения о филиалах',
            'pok25' => 'годовая бухгалтерская отчетность',
            'pok26' => 'контрольные мероприятиях',
            'pok27' => 'государственное задание',
            'pok28' => 'отчет о результатах своей деятельности',
            'pok29' => 'официальный сайт Министерства образования и науки Российской Федерации - http://www.mon.gov.ru',
            'pok30' => 'федеральный портал "Российское образование" - http://www.edu.ru',
            'pok31' => 'информационная система "Единое окно доступа к образовательным ресурсам" - http://window.edu.ru',
            'pok32' => 'единая коллекция цифровых образовательных ресурсов - http://school-collection.edu.ru',
            'pok33' => 'федеральный центр информационно-образовательных ресурсов - http://fcior.edu.ru',
            'pok34' => 'Сайт не работает',
            'pok35' => 'Филиал',            
            'p_date' => 'Дата последнего редактирования отчета',
            'remark' => 'Замечания по отчету',
        );
    }    
    
    /*public function attributeLabels()
    {
        return array(
            'id_report' => 'Id Report',
            'site2' => 'Сайт',
            'pok1' => 'о дате создания образовательного учреждения (государственной регистрации образовательного учреждения)',
            'pok2' => 'наименование или фамилия, имя, отчество учредителя образовательного учреждения, его место нахождения, график работы, справочный телефон, адрес сайта в сети Интернет, адрес электронной почты',
            'pok3' => 'фамилия, имя, отчество руководителя образовательного учреждения, его место нахождения, график работы, справочный телефон, адрес электронной почты',
            'pok4' => 'наименование структурных подразделений, включая филиалы и представительства, фамилии, имена, отчества, должности их руководителей, места нахождения, графики работы, справочные телефоны, адреса сайтов в сети Интернет, адреса электронной почты, копии положений о структурных подразделениях',
            'pok5' => 'о реализуемых основных и дополнительных образовательных программах с указанием численности лиц, обучающихся за счет средств соответствующего бюджета бюджетной системы Российской Федерации, по договорам с физическими и (или) юридическими лицами с оплатой ими стоимости обучения',
            'pok7' => 'о персональном составе педагогических (научно-педагогических) работников (фамилия, имя, отчество, занимаемая должность, уровень образования, квалификация, наличие ученой степени, ученого звания)',
            'pok8' => 'о материально-техническом обеспечении и оснащенности образовательного процесса (в том числе о наличии библиотеки, общежитий, спортивных сооружений, об условиях питания, медицинского обслуживания, о доступе к информационным системам и информационно-телекоммуникационным сетям) с указанием перечня зданий, строений, сооружений, помещений и территорий, используемых для осуществления образовательного процесса, их адресов и назначения',
            'pok9' => 'об электронных образовательных ресурсах, доступ к которым обеспечивается обучающимся (включая перечень таких электронных образовательных ресурсов), электронном каталоге изданий, содержащихся в фонде библиотеки образовательного учреждения',
            'pok10' => 'о направлениях научно-исследовательской деятельности, в том числе перечень научно-исследовательских, опытно-конструкторских и технологических работ (включая фамилии, имена, отчества, занимаемые должности, уровень образования, квалификацию, наличие ученой степени, ученого звания, списки научных трудов, достигнутые результаты (открытия, патенты) ведущих ученых по этим направлениям), и базе для ее осуществления, в том числе оснащенность лабораторным оборудованием',
            'pok12' => 'о наличии стипендий и иных видов материальной поддержки, об условиях предоставления их обучающимся (с размещением копий положений и других документов, регламентирующих стипендиальное обеспечение и иные виды поддержки обучающихся (при наличии) в образовательном учреждении)',
            'pok14' => 'порядок оказания платных образовательных услуг с указанием сведений, предусмотренных Правилами оказания платных образовательных услуг, утвержденными постановлением Правительства Российской Федерации от 5 июля 2001 г. N 505, в том числе образец договора об оказании платных образовательных услуг, и стоимость платных образовательных услуг',
            'pok15' => 'отчет о результатах самообследования деятельности образовательного учреждения',
            'pok16' => 'документа, подтверждающего наличие лицензии на осуществление образовательной деятельности (с приложениями)',
            'pok17' => 'свидетельства о государственной аккредитации образовательного учреждения (с приложениями)',
            'pok18' => 'утвержденного в установленном порядке плана финансово-хозяйственной деятельности или бюджетной сметы образовательного учреждения',           
            'pok19' => 'учредительные документы государственного (муниципального) учреждения, в том числе внесенные в них изменения',
            'pok20' => 'свидетельство о государственной регистрации государственного (муниципального) учреждения',
            'pok21' => 'решение учредителя о создании государственного (муниципального) учреждения',
            'pok22' => 'решение учредителя о назначении руководителя государственного (муниципального) учреждения',
            'pok23' => 'положения о филиалах, представительствах государственного (муниципального) учреждения',
            'pok25' => 'годовая бухгалтерская отчетность государственного (муниципального) учреждения',
            'pok26' => 'сведения о проведенных в отношении государственного (муниципального) учреждения контрольных мероприятиях и их результатах',
            'pok27' => 'государственное (муниципальное) задание на оказание услуг (выполнение работ)',
            'pok28' => 'отчет о результатах своей деятельности и об использовании закрепленного за ними государственного (муниципального) имущества, составляемый и утверждаемый в порядке, определенном соответствующим органом, осуществляющим функции и полномочия учредителя, и в соответствии с общими требованиями, установленными федеральным органом исполнительной власти, осуществляющим функции по выработке государственной политики и нормативно-правовому регулированию в сфере бюджетной, налоговой, страховой, валютной, банковской деятельности.',
            'pok29' => 'официальный сайт Министерства образования и науки Российской Федерации - http://www.mon.gov.ru',
            'pok30' => 'федеральный портал "Российское образование" - http://www.edu.ru',
            'pok31' => 'информационная система "Единое окно доступа к образовательным ресурсам" - http://window.edu.ru',
            'pok32' => 'единая коллекция цифровых образовательных ресурсов - http://school-collection.edu.ru',
            'pok33' => 'федеральный центр информационно-образовательных ресурсов - http://fcior.edu.ru',
            'pok34' => 'Сайт не работает',
            'pok35' => 'Филиал',            
            'p_date' => 'Дата последнего редактирования отчета',
            'remark' => 'Замечания по отчету',
        );
    }*/

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
        $criteria->compare('site2',$this->site,true);
        $criteria->compare('pok1',$this->pok1,true);
        $criteria->compare('pok2',$this->pok2,true);
        $criteria->compare('pok3',$this->pok3,true);
        $criteria->compare('pok4',$this->pok4,true);
        $criteria->compare('pok5',$this->pok5,true);
        $criteria->compare('pok7',$this->pok7,true);
        $criteria->compare('pok8',$this->pok8,true);
        $criteria->compare('pok9',$this->pok9,true);
        $criteria->compare('pok10',$this->pok10,true);
        $criteria->compare('pok12',$this->pok12,true);
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
        $criteria->compare('pok35',$this->p_date,true);         
        $criteria->compare('remark',$this->remark,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    protected function beforeSave()
    {
    $this->p_date=date('Y-m-d', time());
    return TRUE;
    }    
    
    protected function afterFind()
    {
    if($this->p_date == '0000-00-00' || $this->p_date == '') $this->p_date='';
    else $this->p_date=date('d.m.Y', strtotime($this->p_date));
    }    
} 
