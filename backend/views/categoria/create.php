<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Categoria */

$this->title = Yii::t('traduccion', 'Create Categoria');
$this->params['breadcrumbs'][] = ['label' => Yii::t('traduccion', 'Categorias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
