<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Comentario */

$this->title = Yii::t('traduccion', 'Update {modelClass}: ', [
    'modelClass' => 'Comentario',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('traduccion', 'Comentarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('traduccion', 'Update');
?>
<div class="comentario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
