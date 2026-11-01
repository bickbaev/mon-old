<?php

/**
 * This is the model class for table "user".
 */
class User extends CActiveRecord
{
    public $pass1;
    public $pass2;
    public $old_pass;
    /**
     * The followings are the available columns in table 'user':
     * @var string $user_id
     * @var integer $id_est
     * @var string $mail
     * @var string $pass
     * @var string $salt
     * @var string $name
     * @var string $patronymic
     * @var string $surname
     * @var integer $reg_cod_phone
     * @var integer $phone
     * @var integer $reg_cod_mobile
     * @var integer $mobile_phone
     * @var integer $stat_only
     */

    /**
     * Returns the static model of the specified AR class.
     * @return User the static model class
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
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('old_pass, pass1, pass2', 'required', 'on'=>'change'),
            array('pass1, pass2, mail', 'required', 'on'=>'add'),
            array('pass1', 'compare', 'compareAttribute'=>'pass2', 'on'=>'change, add, edit', 'message'=>'Введенные пароли не совпадают'),
            array('user_id', 'unique', 'message'=>'Такой логин уже есть, попробуйте другой'),
            array('user_id, id_est, pass, salt, name, surname', 'required'),
            array('id_est, reg_cod_phone, phone, reg_cod_mobile, mobile_phone, stat_only', 'numerical', 'integerOnly'=>true),
            array('mail', 'email'),
            array('user_id', 'match', 'pattern'=>'/^[a-zA-z0-9_\-]*$/', 'message'=>'Логин может состоять только из цифр, латинских букв, символа подчеркивания и тире'),
            array('name, surname, patronymic', 'match', 'pattern'=>'/^[а-яА-я\-\s]*$/u', 'message'=>'В имени, фамилии и отчестве можно использовать только буквы кириллицы и тире'),
            array('user_id', 'length', 'max'=>50),
            array('mail, name, patronymic, surname', 'length', 'max'=>255),
            array('pass, pass1, pass2', 'length', 'max'=>32),
            array('salt', 'length', 'max'=>23),
            array('stat_only', 'length', 'max'=>1),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('user_id, id_est, mail, pass, salt, name, patronymic, surname, reg_cod_phone, phone, reg_cod_mobile, mobile_phone, stat_only', 'safe', 'on'=>'search'),
        );
    }
    
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'est'=>array(self::BELONGS_TO, 'Est', 'id_est'),           
        );
    }    



    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'pass_old'=> 'Старый пароль',
            'pass1'=> 'Новый пароль1',
            'pass2'=> 'Новый пароль2',
            'user_id' => 'Логин',
            'id_est' => 'Id Est',
            'mail' => 'E-mail',
            'pass' => 'Пароль',
            'salt' => 'Salt',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
            'surname' => 'Фамилия',
            'reg_cod_phone' => 'Reg Cod Phone',
            'phone' => 'Рабочий телефон с кодом города',
            'reg_cod_mobile' => 'Reg Cod Mobile',
            'mobile_phone' => 'Мобильный телефон с кодом',
            'stat_only' => 'Доступ только к разделу статистика (доступ к кабинетам учреждений будет запрещен)',
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

        $criteria->compare('user_id',$this->user_id,true);

        $criteria->compare('id_est',$this->id_est);

        $criteria->compare('mail',$this->mail,true);

        $criteria->compare('pass',$this->pass,true);

        $criteria->compare('salt',$this->salt,true);

        $criteria->compare('name',$this->name,true);

        $criteria->compare('patronymic',$this->patronymic,true);

        $criteria->compare('surname',$this->surname,true);

        $criteria->compare('reg_cod_phone',$this->reg_cod_phone);

        $criteria->compare('phone',$this->phone);

        $criteria->compare('reg_cod_mobile',$this->reg_cod_mobile);

        $criteria->compare('mobile_phone',$this->mobile_phone);
        
        $criteria->compare('stat_only',$this->stat_only,true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }

    public function validatePassword($password)
    {
        return $this->hashPassword($password,$this->salt)===$this->pass;
    }

    public function hashPassword($password,$salt)
    {
        return md5($salt.$password);
    }
    public function generateSalt()
    {
        return uniqid('',true);
    }

} 