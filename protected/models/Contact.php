<?php
class Contact extends CActiveRecord
{
/**
 * This is the model class for table "contact_info".
 *
 * The followings are the available columns in table 'contact_info':
 * @property string $id_report
 * @property integer $uch_type
 * @property integer $uch_status
 * @property integer $nas_punkt_type
 * @property string $nas_punkt
 * @property integer $street_type
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
 * @property string $akkr
 * @property string $lic
 * @property string $ustav
 * @property string $gos
 * @property string $opl
 * @property string $remark
 */

    /**
     * Returns the static model of the specified AR class.
     * @return Contact the static model class
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
            array('id_report, dom', 'required'),
            array('id_report, korpus, cod_phone, phone, cod_fax, fax', 'numerical', 'integerOnly'=>true),
            array('nas_punkt, street, dom, dir_name, dir_par, dir_sur, email, site, publ, akkr, lic, ustav', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, nas_punkt, street, dom, korpus, dir_name, dir_par, dir_sur, cod_phone, phone, cod_fax, fax, email, site, publ, akkr, lic, ustav', 'safe', 'on'=>'search'),
        );
    }


    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_report' => 'Id Report',
            'uch_type' => 'Тип учреждения',
            'uch_status' => 'Статус учреждения',
            'nas_punkt_type' => 'Тип населенного пункта',            
            'nas_punkt' => 'Населенный пункт',
            'street_type' => 'Тип улицы',            
            'street' => 'Улица',
            'dom' => 'Номер дома',
            'korpus' => 'Корпус',
            'dir_name' => 'Имя',
            'dir_par' => 'Отчество',
            'dir_sur' => 'Фамилия',
            'cod_phone' => 'Код города для телефона',
            'phone' => 'Номер телефона',
            'cod_fax' => 'Код города для факса',
            'fax' => 'Номер факса',
            'email' => 'E-mail',
            'site' => 'Адрес сайта',
            'publ' => 'Ссылка на публичный отчет',
            'akkr' => 'Ссылка на свидетельство об аккредитации',
            'lic' => 'Ссылка на лицензию',
            'ustav' => 'Ссылка на устав учреждения',
            'gos' => 'Ссылка на положение об органе государственно-общественного управления',
            'opl' => 'Ссылка на положение о распределении стимулирующей части ФОТ',            
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

        $criteria->compare('email',$this->email,true);

        $criteria->compare('site',$this->site,true);

        $criteria->compare('publ',$this->publ,true);

        $criteria->compare('akkr',$this->akkr,true);

        $criteria->compare('lic',$this->lic,true);

        $criteria->compare('ustav',$this->ustav,true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }
} 
