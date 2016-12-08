<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "players".
 *
 * @property integer $id
 * @property string $name
 * @property string $last_name
 * @property string $password
 * @property string $email
 * @property integer $sex
 * @property string $birth_date
 * @property string $img

 * @property string $date_created
 * @property integer $scores
 * @property integer $role_id
 * @property integer $club_id
 * @property integer $license

 *
 * @property PlayerTeam[] $playerInTeams
 * @property Role $role
 * @property Club $club
 * @property Posts[] $posts
 */
class Player extends ActiveRecord implements IdentityInterface
{

//
//    public static function isUserAdmin($username)
//    {
//        if (static::findOne(['username' => $username, 'role_id' => 1]))
//        {
//            return true;
//        } else {
//            return false;
//        }
//    }
    public function setPassword($password){
        $this->password = md5($password);
    }
    public function validatePassword($password){
        return $this->password === md5($password);
    }
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {

    }
    public function getId()
    {
        return $this->id;
    }
    public function getAuthKey()
    {

    }
    public function validateAuthKey($authKey)
    {

    }

    public static function tableName()
    {
        return 'players';
    }

    public function rules()
    {
        return [
            [['name', 'last_name', 'password', 'email'], 'required'],
            [['date_created'], 'safe'],
            [['scores', 'role_id', 'club_id','license'], 'integer'],
            [['name', 'last_name'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 30],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
            [['club_id'], 'exist', 'skipOnError' => true, 'targetClass' => Club::className(), 'targetAttribute' => ['club_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            //'id' => 'ID',
            'name' => 'Фамилия Имя',
            //'last_name' => 'Фамилия',
            'sex' => 'Пол',
            'birth_date' => 'Возраст',

//            'password' => 'Пароль',
//            'email' => 'Почта',
//            'date_created' => 'Создан',
            'scores' => 'Рейтинг',
            'role_id' => 'Роль',
            'club_id' => 'Клуб',
            'games_count'=>'Сыгранно игр',
            'tournaments_count'=>'Сыгранно турниров',
            'wins'=>'Побед',
            'club_name'=>'Клуб',
            'loses'=>'Поражений',
            'license'=>'Номер лицензии'


        ];
    }
    

//    public function getPlayerInTeams()
//    {
//        return $this->hasMany(PlayerTeam::className(), ['id' => 'player']);
//    }

    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }

    public function getClub()
    {
        return $this->hasOne(Club::className(), ['id' => 'club_id']);
    }

    public function getPosts()
    {
        return $this->hasMany(Posts::className(), ['autor_id' => 'id']);
    }
    public function getGamesCount(){
        $id = Player::getId();
        $rows = (new Query())
            ->from('games')
            ->join('LEFT JOIN', 'teams', 'games.winner_id = teams.id OR games.loser_id = teams.id')
            ->join('LEFT JOIN', 'player_in_team', 'player_in_team.team_id = teams.id')
            ->join('LEFT JOIN', 'players', 'players.id = player_in_team.player_id')
            ->where(['player_id' => $id])
            ->count();
        return $rows;
    }
    public function getTournamentCount(){
        $id = Player::getId();
        $rows = (new Query())
            ->select('tournaments.id')
            ->from('tournaments')
            ->join('LEFT JOIN', 'games', 'games.tournament_id = tournaments.id')
            ->join('LEFT JOIN', 'teams', 'games.winner_id = teams.id OR games.loser_id = teams.id')
            ->join('LEFT JOIN', 'player_in_team', 'teams.id = player_in_team.team_id')
            ->join('LEFT JOIN', 'players', 'player_in_team.player_id = players.id')
            ->where(['players.id' => $id])
            ->groupBy('tournaments.id')
            ->all();
        return count($rows);
    }
    public function getWinsCount(){
        $id = Player::getId();
        $rows = (new Query())
            ->from('tournaments')
            ->join('LEFT JOIN', 'games', 'tournaments.id = games.tournament_id')
            ->join('LEFT JOIN', 'teams', 'games.winner_id = teams.id')
            ->join('LEFT JOIN', 'player_in_team', 'teams.id = player_in_team.team_id')
            ->join('LEFT JOIN', 'players', 'player_in_team.player_id = players.id')
            ->where(['players.id' => $id])
            ->count();

        return $rows;
    }
    public function getLosesCount(){
        $id = Player::getId();
        $rows = (new Query())
            ->from('tournaments')
            ->join('LEFT JOIN', 'games', 'tournaments.id = games.tournament_id')
            ->join('LEFT JOIN', 'teams', 'games.loser_id = teams.id')
            ->join('LEFT JOIN', 'player_in_team', 'teams.id = player_in_team.team_id')
            ->join('LEFT JOIN', 'players', 'player_in_team.player_id = players.id')
            ->where(['players.id' => $id])
            ->count();

        return $rows;
    }
    public function setRating()
    {

    }
    public function getRating()
    {
        $id = Player::getId();
        $rating = (new Query())
            ->from('players')
            ->indexBy(function ($row) {
                return $row['id'];
            })
            ->all();
        return $rating[$id]['scores'];
    }
    public function getRatingPlace(){
        $id = Player::getId();
        $rows = (new Query())
            ->from('players')
            ->orderBy('scores DESC')
            ->all();
        for($i=0;$i<count($rows);$i++){
            if($rows[$i]['id']==$id){
                return ++$i;
            }
        }
    }
}
