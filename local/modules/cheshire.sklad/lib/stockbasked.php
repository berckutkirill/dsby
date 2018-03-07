<?php
namespace Cheshire\Sklad;

use \Bitrix\Main\Entity;

class StockBaskedTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'stock_basket';
    }

    public static function getMap()
    {
        return array(
            //ID
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            // Кто заказал
            
            new Entity\IntegerField('USER_ID', array(
                'required' => true,
            )),
            
            new Entity\IntegerField('FROM_ID', array(
                'required' => true,
            )),
            
            // Сериализованые данные корзины
            new Entity\TextField('DATA', array(
                'required' => true,
                'data_type' => 'text',
                'serialized' => true
            )),
            
            new Entity\IntegerField('TOTAL', array(
                'required' => true
            )),
            
            // Время добавления
            new Entity\DatetimeField('DATE_ADDING', [
                'default_value' => time()
            ]),
            
            // Время изменения
            new Entity\DatetimeField('DATE_UPDATE', [
                'default_value' => time()
            ]),
            // Статус
            new Entity\StringField("STATUS")
        );
    }
}