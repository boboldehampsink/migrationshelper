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
     * Append a field to a source's fieldlayout programmatically.
     *
     * @param string     $elementType The fieldlayout's Element Type
     * @param BaseModel  $source      The element's source (e.g. a SectionModel or CategoryGroupModel)
     * @param FieldModel $field       The field's model
     * @param string     $tabName     The fieldlayout's tab
     *
     * @return BaseModel
     */
    public static function addToFieldLayout($elementType, BaseModel $source, FieldModel $field, $tabName)
    {
        // Assemble layout array
        $layout = array();

        // Get fieldlayout
        $fieldlayout = $source->getFieldLayout();

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
        $layout[$tabName][] = $field->id;

        // Asemble the layout
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
        $context = craft()->content->fieldContext;

        // Set matrix field context
        craft()->content->fieldContext = $context;

        // Get videos field
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
        craft()->content->fieldContext = $context;
    }
}
