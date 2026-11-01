<?php

/**
 * This is the model class for table "contact_info".
 *
 * The followings are the available columns in table 'contact_info':
 * @property integer $id_report
 * @property integer $uch_type
 * @property integer $uch_status
 * @property string $nas_punkt_type
 * @property string $nas_punkt
 * @property string $street_type
 * @property string $street
 * @property string $dom
 * @property integer $korpus
 * @property string $dir_name
 * @property string $dir_par
 * @property string $dir_sur
 * @property integer $cod_phone
 * @property integer $phone
 * @property integer $cod_fax
 * @property integer $fax
 * @property string $mail
 * @property string $site
 * @property string $publ
 * @property string $samo
 * @property string $akkr
 * @property string $lic
 * @property string $ustav
 * @property string $gos
 * @property string $opl
 * @property integer $ped5
 * @property integer $ped
 * @property string $remark
 */
class Contact_info extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return ContactInfo the static model class
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
        return 'contact_info';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, uch_type, uch_status, street_type, nas_punkt, dir_name, dir_par, dir_sur, site, mail', 'required'),
            array('id_report, uch_type, uch_status, nas_punkt_type, street_type, korpus, cod_phone, phone, cod_fax, fax, ped5, ped', 'numerical', 'integerOnly'=>true),
            array('nas_punkt, street, dom, dir_name, dir_par, dir_sur, mail, site, publ, akkr, lic, ustav, gos, opl', 'length', 'max'=>255),
            array('remark, samo', 'length', 'max'=>65535),
            array('mail', 'email'),
            array('dir_name, dir_par, dir_sur', 'match', 'pattern'=>'/^[а-яА-Я\-\s]*$/u', 'message'=>'В имени, фамилии и отчестве можно использовать только буквы кириллицы, цифры и тире'),
            array('nas_punkt, street', 'match', 'pattern'=>'/^[а-яА-Я0-9\-\s]*$/u', 'message'=>'В названии города, улицы можно использовать только буквы кириллицы, цифры и тире'),
            array('remark', 'match', 'pattern'=>'/^[а-яА-Я0-9,\.\-\s]*$/u', 'message'=>'В замечаниях можно использовать только буквы кириллицы, цифры и тире'),
            array('site, publ, samo, akkr, lic, ustav, gos, opl', 'url'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, nas_punkt, street, dom, korpus, dir_name, dir_par, dir_sur, cod_phone, phone, cod_fax, fax, mail, site, publ, akkr, lic, ustav', 'safe', 'on'=>'search'),
            //array('nas_punkt_type', 'in', 'range' => array(1, 9)),
            //array('street_type', 'in', 'range' => array(1, 16)),
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
            'uch_type' => 'Тип образовательного учреждения',
            'uch_status' => 'Статус образовательного учреждения (юридическое лицо или структурное подразделение юридического лица)',
            'nas_punkt_type' => 'Тип населенного пункта',
            'nas_punkt' => 'Населенный пункт, в котором находится учреждение',
            'street_type' => 'Тип улицы',
            'street' => 'Улица',
            'dom' => 'Дом',
            'korpus' => 'Корпус',
            'dir_name' => 'Имя директора',
            'dir_par' => 'Отчество директора',
            'dir_sur' => 'Фамилия директора',
            'cod_phone' => 'Код города',
            'phone' => 'Телефон',
            'cod_fax' => 'Код факса',
            'fax' => 'Факс',
            'mail' => 'Email',
            'site' => 'Сайт',
            'publ' => 'Ссылка на публичный отчет',
            'samo' => 'Ссылка на отчет о результатах самообследования',
            'akkr' => 'Ссылка на свидетельство об аккредитации',
            'lic' => 'Ссылка на лицензию',
            'ustav' => 'Ссылка на текст устава',
            'gos' => 'Ссылка на положение об органе государственно-общественного управления',
            'opl' => 'Ссылка на положение о распределении стимулирующей части ФОТ',
            'ped5'=> 'Численность молодых педагогов со стажем работы до 5 лет',
            'ped'=> 'Общая чиcленность педагогических работников',
            'remark' => 'Замечания',
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

        $criteria->compare('id_report',$this->id_report);

        $criteria->compare('nas_punkt',$this->nas_punkt,true);

        $criteria->compare('street',$this->street,true);

        $criteria->compare('dom',$this->dom,true);

        $criteria->compare('korpus',$this->korpus);

        $criteria->compare('dir_name',$this->dir_name,true);

        $criteria->compare('dir_par',$this->dir_par,true);

        $criteria->compare('dir_sur',$this->dir_sur,true);

        $criteria->compare('cod_phone',$this->cod_phone);

        $criteria->compare('phone',$this->phone);

        $criteria->compare('cod_fax',$this->cod_fax);

        $criteria->compare('fax',$this->fax);

        $criteria->compare('mail',$this->email,true);

        $criteria->compare('site',$this->site,true);

        $criteria->compare('publ',$this->publ,true);

        $criteria->compare('akkr',$this->akkr,true);

        $criteria->compare('lic',$this->lic,true);

        $criteria->compare('ustav',$this->ustav,true);

        $criteria->compare('gos',$this->gos,true);

        $criteria->compare('ped5',$this->gos,true);

        $criteria->compare('ped',$this->gos,true);

        $criteria->compare('opl',$this->opl,true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }
}