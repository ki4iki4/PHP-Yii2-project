<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teams".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_played
 * @property integer $place
 * @property integer $scores
 * @property integer $group_id
 *
 * @property Games[] $games
 * @property Games[] $games0
 * @property PlayerInTeam[] $playerInTeams
 * @property Groups $group
 */
class Teams extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teams';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'place', 'scores', 'group_id'], 'required'],
            [['date_played'], 'safe'],
            [['place', 'scores', 'group_id'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name1' => 'Проигравшая команда',
            'name2' => 'Выигрывшая команда',
            'date_played' => 'Date Played',
            'place' => 'Place',
            'scores' => 'Scores',
            'group_id' => 'Group ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasMany(Games::className(), ['first_team_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames0()
    {
        return $this->hasMany(Games::className(), ['second_team_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayerInTeams()
    {
        return $this->hasMany(PlayerTeam::className(), ['team_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['id' => 'group_id']);
    }
}
