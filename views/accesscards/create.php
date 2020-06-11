<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Accesscards */

$this->title = 'Crear Tarjeta de acceso';
$this->params['breadcrumbs'][] = ['label' => 'Tarjetas de acceso', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accesscards-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
