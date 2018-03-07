<?php
namespace Cheshire\Main;

use \Bitrix\Main\Entity;

class FilterTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'filter_d7';
    }

    public static function getMap()
    {
        return array(
            //ID
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            //Url К которому применять
            new Entity\StringField('URL', array(
                'required' => true,
            )),
            // Title
            new Entity\StringField('SEO_TITLE'),
            
            // Keywords
            new Entity\StringField('SEO_KEYWORDS'),
            
            // Description
            new Entity\StringField('SEO_DESCRIPTION'),
            
            // H1
            new Entity\StringField("H1")
        );
    }
}