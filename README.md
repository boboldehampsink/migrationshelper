Migrations Helper plugin for Craft CMS
=================

Plugin that helps you write complex migrations.

__Important:__
The plugin's folder should be named "migrationshelper"

Helpers
=================
```
/**
 * Append a field to a source's fieldlayout programmatically.
 *
 * @param string     $elementType The fieldlayout's Element Type
 * @param BaseModel  $source      The element's source (e.g. a SectionModel or CategoryGroupModel)
 * @param FieldModel $field       The field's model
 * @param string     $tabName     The fieldlayout's tab
 *
 * @return BaseModel
 */
 MigrationsHelper::addToFieldLayout($elementType, BaseModel $source, FieldModel $field, $tabName)
```

```
/**
 * Change the settings of a given field.
 *
 * @param string $context    The field's context (e.g. global, matrixBlockType:1, etc.)
 * @param string $handle     The field's handle
 * @param array  $attributes An array of key/value settings
 */
 MigrationsHelper::changeFieldSettings($context, $handle, array $attributes)
```

Changelog
=================
###0.1.0###
- Initial push to GitHub