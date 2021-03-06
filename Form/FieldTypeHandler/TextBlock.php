<?php

namespace Netgen\Bundle\EzFormsBundle\Form\FieldTypeHandler;

use Netgen\Bundle\EzFormsBundle\Form\FieldTypeHandler;
use Symfony\Component\Form\FormBuilderInterface;
use eZ\Publish\API\Repository\Values\Content\Content;
use eZ\Publish\API\Repository\Values\ContentType\FieldDefinition;
use eZ\Publish\Core\FieldType\TextBlock\Value as TextBlockValue;
use eZ\Publish\SPI\FieldType\Value;

/**
 * Class TextBlock.
 */
class TextBlock extends FieldTypeHandler
{
    /**
     * {@inheritdoc}
     */
    public function convertFieldValueToForm(Value $value, FieldDefinition $fieldDefinition = null)
    {
        return $value->text;
    }

    /**
     * {@inheritdoc}
     */
    public function convertFieldValueFromForm($data)
    {
        if (empty($data)) {
            $data = '';
        }

        return new TextBlockValue($data);
    }

    /**
     * {@inheritdoc}
     */
    protected function buildFieldForm(
        FormBuilderInterface $formBuilder,
        FieldDefinition $fieldDefinition,
        $languageCode,
        Content $content = null
    ) {
        $options = $this->getDefaultFieldOptions($fieldDefinition, $languageCode, $content);

        $options['attr']['rows'] = $fieldDefinition->fieldSettings['textRows'];

        $formBuilder->add($fieldDefinition->identifier, 'textarea', $options);
    }
}
