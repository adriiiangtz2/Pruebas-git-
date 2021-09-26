<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CarritoDetalle */

$this->title = 'Create Carrito Detalle';
$this->params['breadcrumbs'][] = ['label' => 'Carrito Detalles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carrito-detalle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
