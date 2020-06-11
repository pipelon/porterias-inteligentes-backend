<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccesscardsVehicles */

$this->title = 'Nueva tarjeta de acceso vehicular';
$this->params['breadcrumbs'][] = ['label' => 'Tarjetas de acceso vehicular', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accesscards-vehicles-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
