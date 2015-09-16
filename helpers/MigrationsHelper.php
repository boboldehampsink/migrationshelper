<?php

namespace Craft;

/**
 * Migrations Helper.
 *
 * @author    Bob Olde Hampsink <b.oldehampsink@itmundi.nl>
 * @copyright Copyright (c) 2015, Bob Olde Hampsink
 * @license   MIT
 *
 * @link      http://github.com/boboldehampsink
 */
class MigrationsHelper
{
    /**
     * Get a field group by name
     *
     * @param  string $name
     * @return FieldGroupModel|null
     */
    public static function getFieldGroupByName($name)
    {
        // Get all field groups
        $groups = craft()->fields->getAllGroups();

        // Loop through field groups
        foreach ($groups as $group) {

            // Return matching group
            if ($group->name == $name) {
                return $group;
            }
        }
    }
    
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
    public static function addToFieldLayout(BaseModel $source, FieldModel $field, $index = 0, $tabName = '')
    {
        // Assemble layout array
        $layout = array();

        // Get fieldlayout
        $fieldlayout = $source->getFieldLayout();

        // Get element type
        $elementType = $source->elementType;

        // Get field layout tabs
        $fieldlayouttabs = $fieldlayout->getTabs();

        // Loop through tabs
        foreach ($fieldlayouttabs as $tab) {

            // Gather tab fields for assembly
            $layout[$tab->name] = array();

            // Get tab fields
            $tabfields = $tab->getFields();

            // Loop through tab fields
            foreach ($tabfields as $tabfield) {

                // Gather field id's
                $layout[$tab->name][] = $tabfield->getField()->id;
            }
        }

        // Add the new fields to the tab
        array_splice($layout[$tabName], $index, 0, $field->id);

        // Asemble the layout
        // @TODO - Set required fields
        $assembledLayout = craft()->fields->assembleLayout($layout, array());
        $assembledLayout->type = $elementType;

        // Set the assembled layout on the company
        $source->setFieldLayout($assembledLayout);

        // Return source
        return $source;
    }

    /**
     * Change the settings of a given field.
     *
     * @param string $context    The field's context (e.g. global, matrixBlockType:1, etc.)
     * @param string $handle     The field's handle
     * @param array  $attributes An array of key/value settings
     */
    public static function changeFieldSettings($context, $handle, array $attributes)
    {
        // Get original field context
        $original = craft()->content->fieldContext;

        // Set matrix field context
        craft()->content->fieldContext = $context;

        // Get field
        $field = craft()->fields->getFieldByHandle($handle);

        // Get fieldtype
        $fieldtype = $field->getFieldType();

        // Get fieldtype settings
        $settings = $fieldtype->getSettings();

        // Modify settings
        $settings->setAttributes($attributes);

        // Apply new settings on field
        $field->settings = $settings;

        // Save field
        craft()->fields->saveField($field);

        // Revert to original field context
        craft()->content->fieldContext = $original;
    }
}
