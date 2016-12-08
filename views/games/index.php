<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Games';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="games-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Games', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tournament.name',
            [
                'attribute'=>'name_win',
                'value' => 'winner.name'

            ],
            [
                'attribute'=>'name_los',
                'value' => 'loser.name',

            ],
            [
                'attribute'=>'score',
                'value' => function($model) {
                    $result = $model->getScore();
                    return $result;
                },
            ],
            //'difference',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
