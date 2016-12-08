<?php
namespace app\models;

use yii\base\Model;

class Signup extends Model{
    public $name;
    public $last_name;
    public $password;
    public $email;

    public function rules(){
        return [
            [['name', 'last_name',  'password', 'email'], 'required'],
            [['name', 'last_name'], 'string','min' =>5,'max' => 30],
            ['email', 'email'],
            ['email','unique','targetClass'=>'app\models\Player']
        ];
}
    public function signup(){
        $player = new Player();
        $player->name = $this->name;
        $player->last_name = $this->last_name;
        $player->email = $this->email;
        $player->setPassword($this->password);
        return $player->save();

    }
}