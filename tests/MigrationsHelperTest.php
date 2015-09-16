<?php

namespace Craft;

/**
 * Migrations Helper Test.
 *
 * Asserts for the MigrationsHelper class
 *
 * @author    Bob Olde Hampsink <b.oldehampsink@itmundi.nl>
 * @copyright Copyright (c) 2015, Itmundi
 * @license   MIT
 *
 * @link      http://github.com/boboldehampsink
 */
class MigrationsHelperTest extends BaseTest
{
    /**
     * {@inheritdoc}
     */
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        require_once __DIR__.'/../helpers/MigrationsHelper.php';
    }

    /**
     * Test addToFieldLayout type hinting.
     *
     * @covers MigrationsHelper::addToFieldLayout
     */
    public function testAddToFieldLayoutTypeHinting()
    {
        // Expect exception
        $this->setExpectedException(get_class(new \PHPUnit_Framework_Error('', 0, '', 1)));

        // Test type hinting correctness
        MigrationsHelper::addToFieldLayout(new \stdClass(), new \stdClass());
    }

    /**
     * Test addToFieldLayout result for entry types.
     *
     * @covers MigrationsHelper::addToFieldLayout
     */
    public function testAddToEntryTypeFieldLayout()
    {
        // Mock fields service
        $this->setMockFieldsService();

        // Mock a fieldlayout
        $layout = craft()->fields->assembleLayout(array(
            'tab' => array(1, 2)
        ), array());

        // Set up source model
        $source = new EntryTypeModel();
        $source->setFieldLayout($layout);

        // Set up empty field
        $field = new FieldModel();
        $field->id = 1;

        // Get field layout fields
        $fields = $source->getFieldLayout()->getFields();

        // Should contain two occurences
        $this->assertCount(2, $fields);

        // Run function
        $source = MigrationsHelper::addToFieldLayout($source, $field, 0, 'tab');

        // Assert result
        $this->assertInstanceOf('Craft\EntryTypeModel', $source);

        // Get field layout fields
        $fields = $source->getFieldLayout()->getFields();

        // Should contain three occurences
        $this->assertCount(3, $fields);
    }

    /**
     * Test addToFieldLayout result for category groups.
     *
     * @covers MigrationsHelper::addToFieldLayout
     */
    public function testAddToCategoryGroupFieldLayout()
    {
        // Mock fields service
        $this->setMockFieldsService();

        // Mock a fieldlayout
        $layout = craft()->fields->assembleLayout(array(
            'tab' => array(1, 2)
        ), array());

        // Set up source model
        $source = new CategoryGroupModel();
        $source->setFieldLayout($layout);

        // Set up empty field
        $field = new FieldModel();
        $field->id = 1;

        // Get field layout fields
        $fields = $source->getFieldLayout()->getFields();

        // Should contain two occurences
        $this->assertCount(2, $fields);

        // Run function
        $source = MigrationsHelper::addToFieldLayout($source, $field, 0, 'tab');

        // Assert result
        $this->assertInstanceOf('Craft\CategoryGroupModel', $source);

        // Get field layout fields
        $fields = $source->getFieldLayout()->getFields();

        // Should contain three occurences
        $this->assertCount(3, $fields);
    }

    /**
     * Test changeFieldSettings type hinting.
     *
     * @covers MigrationsHelper::changeFieldSettings
     */
    public function testChangeFieldSettingsTypeHinting()
    {
        // Expect exception
        $this->setExpectedException(get_class(new \PHPUnit_Framework_Error('', 0, '', 1)));

        // Test type hinting correctness
        MigrationsHelper::changeFieldSettings('global', 'handle', 'string');
    }

    /**
     * Test field settings change.
     *
     * @covers MigrationsHelper::changeFieldSettings
     */
    public function testChangeFieldSettings()
    {
        // Mock fields service
        $this->setMockFieldsService();

        // Change field settings
        MigrationsHelper::changeFieldSettings('global', 'adres', array(
            'placeholder' => 'test',
        ));

        // Get field
        $field = craft()->fields->getFieldByHandle('adres');

        // Get fieldtype
        $fieldtype = $field->getFieldType();

        // Get fieldtype settings
        $settings = $fieldtype->getSettings();

        // Test settings
        $this->assertSame(array('placeholder' => 'test'), $settings->getAttribute('adres'));
    }

    /**
     * Mock Fields Service.
     *
     * @return FieldsService|\PHPUnit_Framework_MockObject_MockObject
     */
    private function setMockFieldsService()
    {
        $mock = $this->getMockBuilder('Craft\FieldsService')
            ->setMethods(array('getFieldById', 'getFieldByHandle', 'saveField'))
            ->getMock();

        $field = $this->getMockFieldModel();

        $mock->expects($this->any())->method('getFieldById')->willReturn($field);
        $mock->expects($this->any())->method('getFieldByHandle')->willReturn($field);
        $mock->expects($this->any())->method('saveField')->willReturn(true);

        $this->setComponent(craft(), 'fields', $mock);
    }

    /**
     * Mock Field Model.
     *
     * @return FieldModel
     */
    private function getMockFieldModel()
    {
        $mock = $this->getMockBuilder('Craft\FieldModel')
            ->disableOriginalConstructor()
            ->getMock();

        $fieldtype = $this->getMockFieldType();

        $mock->expects($this->any())->method('getFieldType')->willReturn($fieldtype);

        return $mock;
    }

    /**
     * Mock Field Type.
     *
     * @return BaseFieldType
     */
    private function getMockFieldType()
    {
        $mock = $this->getMockBuilder('Craft\BaseFieldType')
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockSettings();

        $mock->expects($this->any())->method('getSettings')->willReturn($settings);

        return $mock;
    }

    /**
     * Mock Settings.
     *
     * @return BaseFieldType
     */
    private function getMockSettings()
    {
        $mock = $this->getMockBuilder('Craft\BaseModel')
            ->disableOriginalConstructor()
            ->getMock();

        $mock->expects($this->any())->method('getAttribute')->willReturn(array('placeholder' => 'test'));

        return $mock;
    }
}
