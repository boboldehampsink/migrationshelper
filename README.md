Migrations Helper plugin for Craft CMS [![Build Status](https://travis-ci.org/boboldehampsink/migrationshelper.svg?branch=develop)](https://travis-ci.org/boboldehampsink/migrationshelper) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/boboldehampsink/migrationshelper/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/boboldehampsink/migrationshelper/?branch=develop) [![Code Coverage](https://scrutinizer-ci.com/g/boboldehampsink/migrationshelper/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/boboldehampsink/migrationshelper/?branch=develop) [![Latest Stable Version](https://poser.pugx.org/boboldehampsink/migrationshelper/v/stable)](https://packagist.org/packages/boboldehampsink/migrationshelper) [![Total Downloads](https://poser.pugx.org/boboldehampsink/migrationshelper/downloads)](https://packagist.org/packages/boboldehampsink/migrationshelper) [![Latest Unstable Version](https://poser.pugx.org/boboldehampsink/migrationshelper/v/unstable)](https://packagist.org/packages/boboldehampsink/migrationshelper) [![License](https://poser.pugx.org/boboldehampsink/migrationshelper/license)](https://packagist.org/packages/boboldehampsink/migrationshelper)
=================

Plugin that helps you write complex migrations.

__Important:__
The plugin's folder should be named "migrationshelper"

Tips
=================

* You don't need to install this plugin. As long as you require the helper file you can use its functions.

Helpers
=================

####getFieldGroupByName###
```php
<?php
/**
 * Get a field group by name
 *
 * @param  string $name
 * @return FieldGroupModel|null
 */
$group = MigrationsHelper::getFieldGroupByName($name);
```

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
MigrationsHelper::addToFieldLayout(BaseModel $source, FieldModel $field, $index = 0, $tabName = '');

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
phpunit --bootstrap craft/app/tests/bootstrap.php --configuration craft/plugins/migrationshelper/phpunit.xml.dist --coverage-clover coverage.clover craft/plugins/migrationshelper/tests
```

Changelog
=================
###0.5.2###
- Don't return source object as its already by reference
- Set an empty array as default layout for the tabName in case it does not exist yet

###0.5.1###
- Added MIT license to composer.json

###0.5.0###
- Added getFieldGroupByName helper to easily get field groups

###0.4.0###
- Improved unit tests for development

###0.3.1###
- Fixed field context not setting correctly

###0.3.0###
- Added the ability to insert the field on a specified (tab) index
- ElementType is not an argument anymore
- Tabname is now optional

###0.2.0###
- Added unit tests for development

###0.1.0###
- Initial push to GitHub
