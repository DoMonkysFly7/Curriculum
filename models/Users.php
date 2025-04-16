<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Users extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'Users';
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public function getUsername()
    {
        return $this->Username;
    }

    public function getPassword()
    {
        return $this->Password;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null; // pt. access token, nu e cazul momentan
    }

    public static function findByUsername($username)
    {
        return self::findOne(['Username' => $username]);
    }

    public function getId()
    {
        return $this->ID_User;
    }

    public function getAuthKey()
    {
        return $this->auth_key ?? null;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isAttributeChanged('Password')) {
                $this->password = md5($this->password);
            }
            return true;
        }
        return false;
    }
}
