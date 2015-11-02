<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Categoria */

$this->title = Yii::t('traduccion', 'Update {modelClass}: ', [
    'modelClass' => 'Categoria',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('traduccion', 'Categorias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('traduccion', 'Update');
?>
<div class="categoria-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
