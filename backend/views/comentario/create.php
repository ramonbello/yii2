<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Comentario */

$this->title = Yii::t('traduccion', 'Create Comentario');
$this->params['breadcrumbs'][] = ['label' => Yii::t('traduccion', 'Comentarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
