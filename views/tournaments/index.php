<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TournamentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tournaments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tournaments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tournaments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'tournament_date',
            'type.name',
            'created_by',
            [
                'attribute'=>'players_count',
                'value' => function($model) {
                    $count = $model->players_count;
                    if(isset($count))
                    {
                        return $count;
                    }
                    else
                    {
                       return 'Турнир еще не состоялся';
                    }
                },

            ],             'format',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
