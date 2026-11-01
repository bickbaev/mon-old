<?php

class EmailDomainValidator extends CValidator
{
    /**
     * @var bool Проверять ли MX запись домена
     */
    public $checkMX = true;
    
    /**
     * @var bool Проверять ли A запись домена
     */
    public $checkA = false;
    
    /**
     * @var string Сообщение об ошибке
     */
    public $message = 'Домен электронной почты не существует или не принимает электронную почту';

    protected function validateAttribute($object, $attribute)
    {
        $value = $object->$attribute;
        if (empty($value)) {
            return;
        }
        
        // Извлекаем домен из email
        $domain = substr(strrchr($value, "@"), 1);
        
        if (empty($domain)) {
            $this->addError($object, $attribute, $this->message);
            return;
        }
        
        // Проверяем MX записи
        if ($this->checkMX && !$this->checkMxRecords($domain)) {
            $this->addError($object, $attribute, $this->message);
            return;
        }
        
        // Проверяем A записи (если нужно)
        if ($this->checkA && !$this->checkARecords($domain)) {
            $this->addError($object, $attribute, $this->message);
            return;
        }
    }
    
    protected function checkMxRecords($domain)
    {
        return checkdnsrr($domain, 'MX');
    }
    
    protected function checkARecords($domain)
    {
        return checkdnsrr($domain, 'A') || checkdnsrr($domain, 'AAAA');
    }
}

