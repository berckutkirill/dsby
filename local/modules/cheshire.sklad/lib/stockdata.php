<?php

namespace Cheshire\Sklad;

use \Bitrix\Main\Entity;

class StockDataTable extends Entity\DataManager {

    public static function getTableName() {
        return 'stock_data';
    }

    public static function getMap() {
        return array(
            //ID
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
                    )),
            
            new Entity\StringField('DOC_TYPE', ['required' => true]),
            
            new Entity\StringField('DOC_ID', ['validation' => function() {
                    return [new Entity\Validator\Unique()];
                }]),
                    new Entity\ReferenceField('DATA', '\Cheshire\Sklad\StockDataParams', array('=this.DOC_ID' => 'ref.DOC_ID')),
                    new Entity\DatetimeField("DATE_CREATE"),
                    new Entity\StringField("STATUS")
                );
            }

        }
        