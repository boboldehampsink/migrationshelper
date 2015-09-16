Migrations Helper plugin for Craft CMS [![Build Status](https://travis-ci.org/boboldehampsink/migrationshelper.svg?branch=develop)](https://travis-ci.org/boboldehampsink/migrationshelper)
=================

Plugin that helps you write complex migrations.

__Important:__
The plugin's folder should be named "migrationshelper"

Tips
=================

* You don't need to install this plugin. As long as you require the helper file you can use its functions.

Helpers
=================

####addToFieldLayout###
```php
<?php
/**
 * Append a field to a source's fieldlayout programmatically.
 *
 * @param BaseModel  $source      The element's source (e.g. a EntryTypeModel or CategoryGroupModel)
 * @param FieldModel $field       The field's model
 * @param int        $index       The index of the field on the tab (optional - defaults to 0)
 * @param string     $tabName     The fieldlayout's tab (optional)
 *
 * @return BaseModel
 */
 $source = MigrationsHelper::addToFieldLayout(BaseModel $source, FieldModel $field, $index = 0, $tabName = '');

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
###0.3.0###
- Added the ability to insert the field on a specified (tab) index
- ElementType is not an argument anymore
- Tabname is now optional

###0.2.0###
- Added unit tests for development

###0.1.0###
- Initial push to GitHub
