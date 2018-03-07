<?php
namespace Cheshire\Sklad;

use \Bitrix\Main\Entity;

class TmpTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'stock_tmp';
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
            
            new Entity\ReferenceField('DOCUMENT_ID', 'Cheshire\Sklad\Tmp', array('=this.DOCUMENT_ID' => 'ref.ID')),
            new Entity\TextField("CHANGED", [
                'data_type' => 'text',
                'serialized' => true
            ]),
            new Entity\StringField("STATUS")
        );
    }
}