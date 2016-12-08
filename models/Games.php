<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "games".
 *
 * @property integer $id
 * @property integer $tournament_id
 * @property integer $winner_id
 * @property integer $loser_id
 * @property integer $winner_scores
 * @property integer $loser_scores
 * @property integer $difference

 * @property Tournaments $tournament
 * @property Teams $firstTeam
 * @property Teams $secondTeam
 */
class Games extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'games';
    }

    public function rules()
    {
        return [
            [['tournament_id', 'winner_id', 'loser_id', 'winner_scores','loser_scores'], 'required'],
            [['tournament_id', 'winner_id', 'loser_id', 'difference','winner_scores','loser_scores'], 'integer'],
            [['tournament_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tournaments::className(), 'targetAttribute' => ['tournament_id' => 'id']],
            [['winner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teams::className(), 'targetAttribute' => ['winner_id' => 'id']],
            [['loser_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teams::className(), 'targetAttribute' => ['loser_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tournament_id' => 'Турнир',
            'winner_id' => 'Команда победившая',
            'loser_id' => 'Команда проигравшая',
            'name_los' => 'Проигравшая команда',
            'name_win' => 'Выигрывшая команда',
            'difference' => 'Разница очков',
            'winner_scores'=>'Очки победившей',
            'loser_scores'=>'Очки проигравшей',
            'score'=>'Счет'
        ];
    }

    public function getTournament()
    {
        return $this->hasOne(Tournaments::className(), ['id' => 'tournament_id']);
    }

    public function getWinner()
    {
        return $this->hasOne(Teams::className(), ['id' => 'winner_id']);
    }

    public function getLoser()
    {
        return $this->hasOne(Teams::className(), ['id' => 'loser_id']);
    }
    public function getScore(){
        
        return $this->winner_scores . ' : ' . $this->loser_scores;
    }
}
