<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cards */

$this->title = 'Crear tarjeta de acceso';
$this->params['breadcrumbs'][] = ['label' => 'Tarjetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cards-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
