<div class="panel panel-primary">
	  <div class="panel-heading">
			<h3 class="panel-title">Categorías</h3>
	  </div>
	  <div class="panel-body">
<ul>
    <?php foreach($categorias as $key => $value): ?>
    <li><?= $value->categoria ?></li>
    <?php endforeach; ?>
</ul>
	  </div>
</div>