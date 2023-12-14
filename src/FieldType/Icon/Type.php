<?php
declare(strict_types=1);

namespace Elbformat\IbexaIconFieldtype\FieldType\Icon;

use Elbformat\IbexaIconFieldtype\Form\Type\IconType;
use eZ\Publish\SPI\FieldType\Generic\Type as GenericType;
use eZ\Publish\SPI\Persistence\Content\Field;
use eZ\Publish\SPI\Persistence\Content\Type\FieldDefinition;
use EzSystems\EzPlatformContentForms\Data\Content\FieldData;
use EzSystems\EzPlatformContentForms\FieldType\FieldValueFormMapperInterface;
use Symfony\Component\Form\FormInterface;

final class Type extends GenericType implements FieldValueFormMapperInterface
{
    public function getFieldTypeIdentifier(): string
    {
        return 'icon';
    }

    public function mapFieldValueForm(FormInterface $fieldForm, FieldData $data)
    {
        $definition = $data->fieldDefinition;
        $fieldForm->add('value', IconType::class, [
            'required' => $definition->isRequired,
            'label' => $definition->getName(),
        ]);
    }

    public function isSearchable(): bool
    {
        return false;
    }
}