<?php

/* @var $this yii\web\View */

use yii\widgets\LinkPager;
use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

 <div class="row">
  <div class=" col-md-8 ">
   <?php foreach ($noticias as $key => $value): ?>
    <div class=" col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
        <h3 class="panel-title">
          </h3>
          <strong>
            <?= Html::a($value->titulo, ['noticia/' . $value->seo_slug]) ?></strong>
          </div>
          <div class="panel-body">
            <?= $value->detalle ?>
          </div>
          <div class="panel-footer">

            Comentarios <span class="label label-primary"><?= $value->totalComentarios ?></span>

            <?= Html::a('Leer mas', ['noticia/' . $value->seo_slug],['class'=>'pull-right'])?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <section align="center">
      <div><?php echo LinkPager::widget(['pagination'=>$pagination]); ?></div>
    </section>
  </div>

  <div class=" col-md-4">
   <?= $this->render(
    '/site/sidebar',
    [
    'categorias' => $categorias,
    ]
    ) ?>
  </div>
</div>

</div>

