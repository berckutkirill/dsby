<?php

namespace Cheshire\Sklad;

use \Bitrix\Main\Entity;

class StockDataParamsTable extends Entity\DataManager {

    public static function getTableName() {
        return 'stock_data_params';
    }

    public static function getMap() {
        return array(
            //ID
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
                    )),
            new Entity\IntegerField('DOC_ID'),
            
                    new Entity\IntegerField('ELEMENT_ID'),
                    new Entity\IntegerField('QUANTITY'),
                    new Entity\IntegerField('CHANGED'),
                    new Entity\IntegerField('PRICE'),
                    new Entity\TextField('COMMENT')
                );
            }

        }
        