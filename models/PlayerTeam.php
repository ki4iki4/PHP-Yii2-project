<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "player_in_team".
 *
 * @property integer $id
 * @property integer $team_id
 * @property integer $player_id
 *
 * @property Players $player
 * @property Teams $team
 */
class PlayerTeam extends ActiveRecord
{

    public static function tableName()
    {
        return 'player_in_team';
    }
    
    public function rules()
    {
        return [
            [['team_id', 'player_id'], 'required'],
            [['team_id', 'player_id'], 'integer'],
            [['player_id'], 'exist', 'skipOnError' => true, 'targetClass' => Player::className(), 'targetAttribute' => ['player_id' => 'id']],
            [['team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teams::className(), 'targetAttribute' => ['team_id' => 'id']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'team_id' => 'Team ID',
            'player_id' => 'Player ID',
        ];
    }

    public function getPlayer()
    {
        return $this->hasOne(Player::className(), ['id' => 'player_id']);
    }

    public function getTeam()
    {
        return $this->hasOne(Teams::className(), ['id' => 'team_id']);
    }
}
