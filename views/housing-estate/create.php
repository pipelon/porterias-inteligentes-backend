<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HousingEstate */

$this->title = 'Crear Unidad residencial';
$this->params['breadcrumbs'][] = ['label' => 'Unidades residenciales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="housing-estate-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
