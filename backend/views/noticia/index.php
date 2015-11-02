<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\alert\AlertBlock;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel common\models\NoticiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Noticias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noticia-index">

   <div class="panel panel-primary">
         <div class="panel-heading">
               <h3 class="panel-title">
  <?= Html::a('Crear Noticia', ['create'], ['class' => 'btn btn-info']) ?>
               </h3>
         </div>
         <div class="panel-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
      
    </p>

    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'titulo',
        [
            'attribute' => 'categoria_id',
            'value'     => 'categoria.categoria',
            'format'    => 'raw',
            'filter'    => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'categoria_id',
                            'data' => \yii\helpers\ArrayHelper::map(\common\models\Categoria::find()->all(), 'id', 'categoria'),
                            'options' => ['placeholder' => 'Seleccione...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]),
        ],
        [
            'attribute' => 'created_by',
            'value'     => 'createdBy.name',
        ],
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>


         </div>
   </div>
</div>
