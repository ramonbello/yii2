<?php 
use yii\helpers\Html;

?>
<div class="col-md-8">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">
        Categoría: <?= $noticia->categoria->categoria ?>
      </h3>
    </div>
    <div class="panel-body">
      <h3>  <?= $noticia->titulo ?> </h3> <hr>
      <?= $noticia->detalle ?>
    </div>
    <div class="panel-footer" >
      <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Agregar Comentario</a>
      <div class="pull-right" >
       Pubicado por: <?= $noticia->createdBy->name ?>
     </div>
     <br>
   </div>
 </div>
 <hr>
 <h3>Comentarios <?= $noticia->totalComentarios ?> </h3>
 <?php 
 //print_r($noticia->mostarComentarios);
 ?>
 <?php foreach ($noticia->mostarComentarios as $key => $value): ?>

  <div class="col-md-12">
    <div class="row">
      <div class="thumbnail">
        <img data-src="#" alt="">
        <div class="caption">
          <p> <strong> Nombre </strong>  <?= $value->nombre ?></p>
          <p>  <strong> Correo </strong>   <?= $value->correo ?></p>
          <p>  <strong> Comentario </strong>  <?= $value->comentario ?></p>
          <p>  <strong> Fecha </strong>  <?= $value->fecha ?></p>
        </div>
      </div>
    </div></div>

  <?php endforeach; ?>

</div>

<div class=" col-md-4">
 <?= $this->render(
  '/site/sidebar',
  [
  'categorias' => $categorias,
  ]
  ) ?>
</div>


<div class="modal fade" id="modal-id">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Comentario</h4>
      </div>
      <div class="modal-body">
        <?=
        $this->render(
          '@backend/views/comentario/_form',
          [
          'model' => $comentario,
          ]
          );
          ?>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>