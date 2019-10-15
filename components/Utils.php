<?php

namespace app\components;

use yii\base\Component;

/**
 * Description of Utils
 *
 * @author fecheverri
 */
class Utils extends Component {

    /**
     * Funcion para pintar el badge de registro activo
     * 
     * @author Felipe Echeverri <felipe.echeverri@ingeneo.com.co>
     * @copyright 2019 INGENEO S.A.S.
     * @link http://www.ingeneo.com.co 
     * @param int $condition
     * @return string
     */
    public function getConditional($condition) {
        return $condition == 1 || strtolower($condition) == 'si' ?
                "<span class='badge bg-green'>SI</span>" :
                "<span class='badge bg-red'>NO</span>";
    }

    /**
     * Funcion que retorna el filtro de activo
     * 
     * @author Felipe Echeverri <felipe.echeverri@ingeneo.com.co>
     * @copyright 2019 INGENEO S.A.S.
     * @link http://www.ingeneo.com.co 
     * @return array
     */
    public function getFilterConditional() {
        return [
            '1' => 'SI',
            '0' => 'NO',
        ];
    }

}
