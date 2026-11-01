<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;


    public function authenticate()
    {
        $username=strtolower($this->username);
        $user=User::model()->find('LOWER(user_id)=?',array($username));
        if($user===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if(!$user->validatePassword($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$user->user_id;
            $est = Est::model()->find('id_est=?', array($user->id_est));
            if(!$est->status || !$est->cab_status) $this->errorCode=self::ERROR_USERNAME_INVALID;
            else {
                Yii::app()->session['id'] = $user->user_id;
                Yii::app()->session['est'] = $user->id_est;
                Yii::app()->session['pid'] = Est::model()->getAllEst($user->id_est);
                Yii::app()->session['parent'] = $est->pid_est;
                Yii::app()->session['est_name'] = $est->est_name;
                Yii::app()->session['type_adm'] = $est->type_adm;
                Yii::app()->session['fio'] = $user->surname.' '.$user->name.' '.$user->patronymic;
                Yii::app()->session['stat_only'] = $user->stat_only;
                $this->username=$user->name.' '.$user->surname;
                $this->errorCode=self::ERROR_NONE;
            }
        }
        return $this->errorCode==self::ERROR_NONE;
    }

    public function getId()
    {
        return $this->_id;
    }

}