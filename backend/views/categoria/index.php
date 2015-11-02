<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('traduccion', 'Categorias');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-index">

<div class="panel panel-primary">
      <div class="panel-heading">
            <h3 class="panel-title">
              <?= Html::a(Yii::t('traduccion', 'Crear Categoria'), ['create'], ['class' => 'btn btn-info']) ?>     
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

            'id',
            'categoria',
            'seo_slug',
            'imagen',
            'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
            // 
            //    
             [
            'attribute' => 'created_by',
            'value'     => 'createdBy.name',
        ],

 [
            'attribute' => 'updated_by',
            'value'     => 'updatedBy.name',
        ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
      </div>
</div>

</div>