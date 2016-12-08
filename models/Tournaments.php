<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "tournaments".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_created
 * @property string $tournament_date

 * @property integer $type_id
 * @property string $created_by
 * @property integer $players_count
 * @property string $format
 *
 * @property Games[] $games
 * @property Types $type
 */
class Tournaments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tournaments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type_id', 'created_by', 'format',], 'required'],
            [['tournament_date'], 'safe'],
            [['type_id', 'players_count',], 'integer'],
            [['name', 'created_by'], 'string', 'max' => 30],
            [['format'], 'string', 'max' => 20],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Types::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название турнира',
            'tournament_date' => 'Дата проведения',
            'type_id' => 'Тип турнира',
            'created_by' => 'Организатор',
            'players_count' => 'Кол-во игроков',
            'format' => 'Формат',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasMany(Games::className(), ['tournament_id' => 'id']);
    }

    public function getType()
    {
        return $this->hasOne(Types::className(), ['id' => 'type_id']);
    }

    public function setPlayersCount()
    {
        $id = Tournaments::getId();
        $rows = (new Query())
            ->select('players.id')
            ->from('tournaments')
            ->join('LEFT JOIN', 'games', 'tournaments.id = games.tournament_id')
            ->join('LEFT JOIN', 'teams', 'games.winner_id = teams.id OR games.loser_id = teams.id')
            ->join('LEFT JOIN', 'player_in_team', 'teams.id = player_in_team.team_id')
            ->join('LEFT JOIN', 'players', 'player_in_team.player_id = players.id')
            ->where(['tournament_id' => $id])
            ->groupBy('players.id')
            ->all();

        Yii::$app->db->createCommand()
            ->update('tournaments', ['players_count' => count($rows)], 'id=' . $id)
            ->execute();

        return true;
    }

    public function getId()
    {
        return $this->id;
    }
}
