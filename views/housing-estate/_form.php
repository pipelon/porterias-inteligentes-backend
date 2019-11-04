<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HousingEstate */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    #map {
        width: 100%;
        height: 80%;
    }
    #coords{width: 500px;}
</style>
<div class="housing-estate-form box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/housing-estate/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?> 
    </div>
    <?php
    $form = ActiveForm::begin(
                    [
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{hint}\n{error}\n",
                            'options' => ['class' => 'form-group col-md-6'],
                            'horizontalCssClasses' => [
                                'label' => '',
                                'offset' => '',
                                'wrapper' => '',
                                'error' => '',
                                'hint' => '',
                            ],
                        ],
                    ]
    );
    ?>
    <div class="box-body table-responsive">

        <div class="form-row">
            <div class="row-field">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="row-field">
                <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

                <?php
                $dataList = yii\helpers\ArrayHelper::map(
                                \app\models\Cities::find()
                                        ->where(['active' => 1])
                                        ->all()
                                , 'id', 'name');
                ?>
                <?= $form->field($model, 'city_id')->dropDownList($dataList, ['prompt' => '- Seleccione una ciudad -']) ?>
            </div>
            <div class="row-field">
                <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'police_phone_number')->textInput(['maxlength' => true]) ?>              

            </div>
            <div class="row-field">
                <?= $form->field($model, 'neighborhood')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'active')->dropDownList(Yii::$app->utils->getFilterConditional()); ?>                

            </div>
            <div class="row-field">
                <?= $form->field($model, 'location')->hiddenInput(['maxlength' => true, 'id' => 'location']) ?>
                <div class="container-map">
                    <div id="map"></div>
                </div>
            </div>
        </div>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$lat = 6.230833;
$lng = -75.590553;
if (isset($model->location)) {
    $temp = explode(",", $model->location);
    $lat = $temp[0];
    $lng = $temp[1];
}
?>
<script type="text/javascript">

    var marker;          //variable del marcador
    var coords = {
        lng: <?= $lng; ?>,
        lat: <?= $lat; ?>
    };       //coordenadas obtenidas con la geolocalización

    //Funcion principal
    initMap = function () {
        //usamos la API para geolocalizar el usuario
        navigator.geolocation.getCurrentPosition(
                function (position) {
                    coords = {
                        lng: <?= $lng; ?>,
                        lat: <?= $lat; ?>
                    };
                    setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa
                }, function (error) {
            console.log(error);
        });
    }

    function setMapa(coords) {
        //Se crea una nueva instancia del objeto mapa
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: new google.maps.LatLng(coords.lat, coords.lng),

        });

        //Creamos el marcador en el mapa con sus propiedades
        //para nuestro obetivo tenemos que poner el atributo draggable en true
        //position pondremos las mismas coordenas que obtuvimos en la geolocalización
        marker = new google.maps.Marker({
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            position: new google.maps.LatLng(coords.lat, coords.lng),

        });
        //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica 
        //cuando el usuario a soltado el marcador
        marker.addListener('click', toggleBounce);

        marker.addListener('dragend', function (event)
        {
            //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
            document.getElementById("location").value = this.getPosition().lat() + "," + this.getPosition().lng();
        });
    }

    //callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBT8zGRY3VHICCuxEetWXc_F-50-o8Vo2Y&callback=initMap"
type="text/javascript"></script>