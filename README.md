Migrations Helper plugin for Craft CMS [![Build Status](https://travis-ci.org/boboldehampsink/migrationshelper.svg?branch=develop)](https://travis-ci.org/boboldehampsink/migrationshelper)
=================

Plugin that helps you write complex migrations.

__Important:__
The plugin's folder should be named "migrationshelper"

Helpers
=================

####addToFieldLayout###
```php
<?php
/**
 * Append a field to a source's fieldlayout programmatically.
 *
 * @param string     $elementType The fieldlayout's Element Type
 * @param BaseModel  $source      The element's source (e.g. a EntryTypeModel or CategoryGroupModel)
 * @param FieldModel $field       The field's model
 * @param string     $tabName     The fieldlayout's tab
 *
 * @return BaseModel
 */
 $source = MigrationsHelper::addToFieldLayout($elementType, BaseModel $source, FieldModel $field, $tabName);

 // Save source (e.g. Entry Type)
 craft()->sections->saveEntryType($source);
```

####changeFieldSettings####
```php
<?php
/**
 * Change the settings of a given field.
 *
 * @param string $context    The field's context (e.g. global, matrixBlockType:1, etc.)
 * @param string $handle     The field's handle
 * @param array  $attributes An array of key/value settings
 */
 MigrationsHelper::changeFieldSettings($context, $handle, array $attributes);
```

Development
=================
Run this from your Craft installation to test your changes to this plugin before submitting a Pull Request
```bash
phpunit --bootstrap craft/app/tests/bootstrap.php --configuration craft/app/tests/phpunit.xml craft/plugins/migrationshelper/tests
```

Changelog
=================
###0.1.0###
- Initial push to GitHub
