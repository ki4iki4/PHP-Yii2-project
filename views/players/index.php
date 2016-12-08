<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PlayerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Рейтинг Украина 2017';
$this->params['breadcrumbs'][] = $this->title;
$model = new \app\models\Player();
?>
<div class="player-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать игрока', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model) {
            return ['onClick' => 'location.href=\'/players/'.$model['id'].'\''];
        },

        'columns' => [

           ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'name',
                'value' => function($model) {
                    return $model->last_name.'  '. $model->name ;
                },

            ],
            'sex',
            [
                'attribute'=>'birth_date',
                'value' => function($model) {
                    $result = time() - strtotime($model->birth_date);
                    $result = floor($result/(365*24*60*60));
                    return $result;
                },
            ],
            [
                'attribute'=>'tournaments_count',
                'value' => function($model) {
                    $result = $model->getTournamentCount();
                    return $result;
                },
            ],
            [
                'attribute'=>'games_count',
                'value' => function($model) {
                    $result = $model->getGamesCount();
                    return $result;
                },
            ],

            [
                'attribute'=>'wins',
                'value' => function($model) {
                    $result = $model->getWinsCount();
                    return $result;
                },
            ],
            [
                'attribute'=>'loses',
                'value' => function($model) {
                    $result = $model->getLosesCount();
                    return $result;
                },
            ],

            'scores',
            [
                'attribute'=>'club_name',
                'value' => 'club.name'
            ],
            'license',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions' =>['class' => 'table table-condensed table-bordered',
        'style'=>'text-align:center'],
        'captionOptions' =>['style'=>'text-align:center']


    ]); ?>

</div>
