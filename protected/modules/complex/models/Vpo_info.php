<?php

/**
 * This is the model class for table "vpo_info".
 *
 * The followings are the available columns in table 'vpo_info':
 * @property string $id_report
 * @property string $id_mun
 * @property string $address
 * @property string $dir_name
 * @property string $dir_par
 * @property string $dir_sur
 * @property integer $cod_phone
 * @property integer $phone
 * @property string $mail
 * @property string $site
 * @property string $pr_address
 * @property integer $pr_cod_phone
 * @property integer $pr_phone
 * @property string $pr_mail
 * @property string $pr_s_day
 * @property string $pr_f_day
 * @property string $pr_s_hour
 * @property string $pr_f_hour
 * @property string $pr_s_obed
 * @property string $pr_f_obed
 * @property string $pr_priem
 * @property string $podg
 */
class Vpo_info extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'vpo_info';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, id_mun, address, cod_phone, phone, site', 'required'),
            array('cod_phone, phone, pr_cod_phone, pr_phone, id_mun, pr_s_day, pr_f_day, pr_s_hour, pr_f_hour, pr_s_obed, pr_f_obed', 'numerical', 'integerOnly'=>true),
            array('dir_name, dir_par, dir_sur', 'match', 'pattern'=>'/^[а-яА-Я\-\s]*$/u', 'message'=>'В имени, фамилии и отчестве можно использовать только буквы кириллицы, цифры и тире'),
            array('site, pr_priem', 'url'),
            array('mail, pr_mail', 'email'),            
            array('id_report', 'length', 'max'=>10),
            array('pr_s_day, pr_f_day', 'numerical', 'min' => 1, 'max' => 7),
            array('pr_s_hour, pr_f_hour, pr_s_obed, pr_f_obed', 'numerical', 'min' => 0, 'max' => 23),
            array('id_mun', 'length', 'max'=>2),
            array('address, dir_name, dir_par, dir_sur, mail, site, pr_address, pr_mail, pr_priem', 'length', 'max'=>255),
            array('address, mail, site, pr_address, pr_mail, pr_priem, podg','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),
            array('podg, pr_address, address', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9№,\.\(\)\-\s\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры, тире, точку, знак номера, скобки и кавычки'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, id_mun, address, dir_name, dir_par, dir_sur, cod_phone, phone, mail, site, pr_address, pr_cod_phone, pr_phone, pr_mail, pr_s_day, pr_f_day, pr_s_hour, pr_f_hour, pr_s_obed, pr_f_obed, pr_priem, podg', 'safe', 'on'=>'search'),
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
            'id_mun' => 'Муниципалитет',
            'address' => 'Почтовый адрес',
            'dir_name' => 'Имя ректора',
            'dir_par' => 'Отчество ректора',
            'dir_sur' => 'Фамилия ректора',
            'cod_phone' => 'Код телефона',
            'phone' => 'Официальный телефон',
            'mail' => 'E-mail',
            'site' => 'Адрес сайта',
            'pr_address' => 'Почтовый адрес приемной комиссии',
            'pr_cod_phone' => 'Pr Cod Phone',
            'pr_phone' => 'Телефон приемной комиссии',
            'pr_mail' => 'E-mail приемной комиссии',
            'pr_s_day' => 'Начальный день недели работы приемной комиссии',
            'pr_f_day' => 'Конечный день недели работы приемной комиссии',
            'pr_s_hour' => 'Час начала работы приемной комиссии',
            'pr_f_hour' => 'Час окончания работы приемной комиссии',
            'pr_s_obed' => 'Час начала обеда в приемной комиссии',
            'pr_f_obed' => 'Час окончания обеда в приемной комиссии',                    
            'pr_priem' => 'Ссылка на правила приема',
            'podg' => 'Информация о подготовительных курсах',
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
        $criteria->compare('id_mun',$this->id_mun,true);
        $criteria->compare('address',$this->address,true);
        $criteria->compare('dir_name',$this->dir_name,true);
        $criteria->compare('dir_par',$this->dir_par,true);
        $criteria->compare('dir_sur',$this->dir_sur,true);
        $criteria->compare('cod_phone',$this->cod_phone);
        $criteria->compare('phone',$this->phone);
        $criteria->compare('mail',$this->mail,true);
        $criteria->compare('site',$this->site,true);
        $criteria->compare('pr_address',$this->pr_address,true);
        $criteria->compare('pr_cod_phone',$this->pr_cod_phone);
        $criteria->compare('pr_phone',$this->pr_phone);
        $criteria->compare('pr_mail',$this->pr_mail,true);
        $criteria->compare('pr_s_day',$this->pr_s_day,true);
        $criteria->compare('pr_f_day',$this->pr_f_day,true);
        $criteria->compare('pr_s_hour',$this->pr_s_hour,true);
        $criteria->compare('pr_f_hour',$this->pr_f_hour,true);
        $criteria->compare('pr_s_obed',$this->pr_s_obed,true);
        $criteria->compare('pr_f_obed',$this->pr_f_obed,true);
        $criteria->compare('pr_priem',$this->pr_priem,true);
        $criteria->compare('podg',$this->podg,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Vpo_info the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
