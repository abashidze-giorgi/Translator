<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Translators $model */

$this->title = 'Create Translators';
$this->params['breadcrumbs'][] = ['label' => 'Translators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="translators-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
