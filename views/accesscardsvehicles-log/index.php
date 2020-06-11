<?php

use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccesscardsvehiclesLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'LOGS Tarjetas de acceso vehicular';
$this->params['breadcrumbs'][] = $this->title;

$template = '';
if (\Yii::$app->user->can('/accesscardsvehicles-log/view')) {
    $template .= '{view} ';
}
if (\Yii::$app->user->can('/accesscardsvehicles-log/update')) {
    $template .= '{update} ';
}
if (\Yii::$app->user->can('/accesscardsvehicles-log/delete')) {
    $template .= '{delete} ';
}
if (\Yii::$app->user->can('/accesscardsvehicles-log/*') || \Yii::$app->user->can('/*')) {
    $template = '{view}  {update}  {delete}';
}
?>
<div class="accesscardsvehicles-log-index box box-primary">
    <div class="box-header with-border">
    <?php  if (\Yii::$app->user->can('/accesscardsvehicles-log/create') || \Yii::$app->user->can('/*')) :  ?> 
        
    <?php  endif;  ?> 
    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?php
        //COLUMNAS PRELIMINARES DEL REPORTE TAR CON FILTROS
        $gridColumns = [
            'accesscard_vehicle_code',
            [
                'attribute' => 'state',
                'format' => 'raw',
                'value' => function ($data) {
                    return Yii::$app->utils->getStateCard($data->state);
                },
                'filter' => Yii::$app->utils->getFilterStateCard()
            ],
            'state_description:ntext',
            [
                'attribute' => 'created',
                'format' => 'date',
                'filter' => false
            ]                        
        ];
        //COLUMNAS PARA EL EXPORTABLE DEL TAR EN EXCEL
        $exportColumns = [
            [
                'attribute' => 'state',
                'format' => 'raw',
                'value' => function ($data) {
                    return Yii::$app->utils->getStateCard($data->state);
                },
                'filter' => Yii::$app->utils->getFilterStateCard()
            ],
            'state_description:ntext',
            [
                'attribute' => 'created',
                'format' => 'date',
                'filter' => false
            ],
            'accesscard_vehicle_code'  
        ];
        //TIPOS DE EXPORTACION
        $exportConfig = [
            ExportMenu::FORMAT_TEXT => false,
            ExportMenu::FORMAT_CSV => false,
            ExportMenu::FORMAT_HTML => false,
            ExportMenu::FORMAT_PDF => false
        ];
        //MENU DE EXPORTACION
        $fullExportMenu = ExportMenu::widget(
                        [
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => $exportColumns,
                            'showConfirmAlert' => false,
                            'fontAwesome' => true,
                            'target' => '_blank',
                            'filename' => "LogsTarjetasVehiculares_" . date('Y-m-d-H-i-s'),
                            'exportConfig' => $exportConfig,
                            'dropdownOptions' => [
                                'label' => 'Exportar',
                                'class' => 'btn btn-secondary'
                            ]
                        ]
        );
        ?>
        <?=
        GridView::widget([
            'id' => 'insured-values-roofs-table',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{toolbar}{items}\n{summary}\n{pager}",
            'columns' => $gridColumns,
            'toolbar' => [
                $fullExportMenu,                
            ],
            'bordered' => true,
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'persistResize' => false
        ]);
        ?>
    </div>
</div>
