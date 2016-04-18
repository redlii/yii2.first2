<?php
use yii\helpers\Html;
?>
<section>
  <h2>Rbac example.</h2>
  <p>http://localhost/path/to/index.php?r=admin</p>
  <?= Html::a('admin', ['/admin'], ['class'=>'btn btn-primary']) ?>
  <p>http://localhost/path/to/index.php?r=admin/route</p>
  <?= Html::a('route', ['/admin/route'], ['class'=>'btn btn-primary']) ?>
  <p>http://localhost/path/to/index.php?r=admin/permission</p>
  <?= Html::a('permission', ['/admin/permission'], ['class'=>'btn btn-primary']) ?>
  <p>http://localhost/path/to/index.php?r=admin/menu</p>
  <?= Html::a('Menu', ['/admin/menu'], ['class'=>'btn btn-primary']) ?>
  <p>http://localhost/path/to/index.php?r=admin/role</p>
  <?= Html::a('role', ['/admin/role'], ['class'=>'btn btn-primary']) ?>
  <p>http://localhost/path/to/index.php?r=admin/assignment</p>
  <?= Html::a('assignment', ['/admin/assignment'], ['class'=>'btn btn-primary']) ?>
</section>