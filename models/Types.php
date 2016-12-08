<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "types".
 *
 * @property integer $id
 * @property integer $name
 * @property integer $count
 *
 * @property Tournaments[] $tournaments
 */
class Types extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'count'], 'required'],
            [['name', 'count'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Тип турнира',
            'count' => 'Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTournaments()
    {
        return $this->hasMany(Tournaments::className(), ['type_id' => 'id']);
    }
   
}
