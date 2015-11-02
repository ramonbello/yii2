<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Noticia */

$this->title = Yii::t('traduccion', 'Create Noticia');
$this->params['breadcrumbs'][] = ['label' => Yii::t('traduccion', 'Noticias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noticia-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
