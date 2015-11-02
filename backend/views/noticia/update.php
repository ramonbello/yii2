<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Noticia */

$this->title = Yii::t('traduccion', 'Update {modelClass}: ', [
    'modelClass' => 'Noticia',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('traduccion', 'Noticias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'created_by' => $model->created_by]];
$this->params['breadcrumbs'][] = Yii::t('traduccion', 'Update');
?>
<div class="noticia-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
