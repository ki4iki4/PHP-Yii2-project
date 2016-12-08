<?php
namespace app\models;

use yii\base\Model;

class Login extends Model
{
    public $email;
    public $password;
    public function rules(){
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['password','validatePassword'] // кастомная функция для проверки пароля
        ];
    }
    public function validatePassword($attribute,$params){
        if(!$this->hasErrors()){ //если нет ошибок
            $player = $this->getUser(); // получаем пользователя для дальнейшего сравнения паролей
            if(!$player || $player->validatePassword($this->password)){  // если такого нет в базе или пароли не совпали
                $this->addError($attribute,'Bad password or email'); // выводим кастоиную ошибку
            }
        }
    }
    public function getUser(){  // получение пользователя по почте
        return Player::findOne(['email'=>$this->email]);
}
}