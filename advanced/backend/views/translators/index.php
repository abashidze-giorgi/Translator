<?php

use backend\models\Translators;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use backend\models\Languages;

/** @var yii\web\View $this */
/** @var backend\models\TranslatorsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Переводчики';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="translators-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать переводчика', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',
            'available_weekdays:boolean',
            'available_weekends:boolean',
            [
                'attribute' => 'language_from_id',
                'value' => function (Translators $model) {
                    return $model->languageFrom ? $model->languageFrom->name : 'N/A';
                },
                'filter' => Languages::find()->select(['name', 'id'])->indexBy('id')->column(),
            ],
            [
                'attribute' => 'language_to_id',
                'value' => function (Translators $model) {
                    return $model->languageTo ? $model->languageTo->name : 'N/A';
                },
                'filter' => Languages::find()->select(['name', 'id'])->indexBy('id')->column(),
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Translators $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

</div>
