<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property integer $id
 * @property string $name
 * @property integer $tournament_id
 *
 * @property Teams[] $teams
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'tournament_id'], 'required'],
            [['tournament_id'], 'integer'],
            [['name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'tournament_id' => 'Tournament ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeams()
    {
        return $this->hasMany(Teams::className(), ['group_id' => 'id']);
    }
}
