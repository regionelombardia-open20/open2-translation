# Amos Translation

Translation management.

### Button clean translatemanager cache
Insert in config/component-amos
```php
  'view' => [
            'class' => 'open20\amos\core\components\AmosView',
            'theme' => [
                    'pathMap' => [
                        '@vendor/lajax/yii2-translate-manager/views/language/' => '@vendor/open20/amos-translation/src/views/translatemanager/'
                    ],
                ],
        ],
```

### Configurable properties

***defaultTranslationLanguage** - string  
Default language to translate if the record translate is not present
```php
'translation' => [
    'class' => 'open20\amos\translation\AmosTranslation',
    'defaultTranslationLanguage' => 'en-GB',
],
```
***secureCookie** - boolean  
Added configuration to enable  to send cookie without security

***enableCookieFor2LevelDomain** - boolean  
Added configuration to set cookie for  the second level domain

***byPassPermissionInlineTranslation** - boolean
If the value is true it disable all the permission on the record translation

***enableLabelTranslationField** - boolean, default = false 
If set to true it enables the display of the translatable fields in the forms
  
***templateTranslationField** - string, default = '{translation}' 
Template of translation field in the form, near the label

***templateTranslationAltField** - string, default = '{altTranslation}'
Template of translation alt field in the form, near the $templateTranslationField

***translationLabelField** - string, default = 'strtoupper(substr(\Yii::$app->language, 0, 2));'
This string will be parsed by the "eval()" function instead of $tempalteTransaltionField, by default {translation}
    
***translationLabelAltField** - string, default = '\Yii::t("amostranslation", "Testo traducibile, la visualizzazione attuale è in");'
This string will be parsed by the "eval()" function instead of $templateTranslationAltField, by default {altTranslation}

***labelTranslationField** - string, default = ' (<span class="label_translation am am-translate" title="{altTranslation} {translation}"> - {translation}</span>)'
This string is the html code that will be used in the labels to represent a translatable field

