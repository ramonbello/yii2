<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Noticia */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('traduccion', 'Noticias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noticia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('traduccion', 'Update'), ['update', 'id' => $model->id, 'created_by' => $model->created_by], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('traduccion', 'Delete'), ['delete', 'id' => $model->id, 'created_by' => $model->created_by], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('traduccion', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'titulo',
            'seo_slug',
            'detalle',
            'categoria_id',
            'created_by',
            'created_at',
            'updated_by',
            'updated_at',
        ],
    ]) ?>

</div>
