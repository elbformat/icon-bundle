<?php
declare(strict_types=1);

namespace Elbformat\IbexaIconFieldtype\FieldType\Icon;

use Elbformat\IbexaIconFieldtype\Form\Type\IconSettingsType;
use Elbformat\IbexaIconFieldtype\Form\Type\IconType;
use eZ\Publish\SPI\FieldType\Generic\Type as GenericType;
use eZ\Publish\SPI\Persistence\Content\Field;
use eZ\Publish\SPI\Persistence\Content\Type\FieldDefinition;
use EzSystems\EzPlatformAdminUi\FieldType\FieldDefinitionFormMapperInterface;
use EzSystems\EzPlatformAdminUi\Form\Data\FieldDefinitionData;
use EzSystems\EzPlatformContentForms\Data\Content\FieldData;
use EzSystems\EzPlatformContentForms\FieldType\FieldValueFormMapperInterface;
use Symfony\Component\Form\FormInterface;

final class Type extends GenericType implements FieldValueFormMapperInterface, FieldDefinitionFormMapperInterface
{
    public function getFieldTypeIdentifier(): string
    {
        return 'icon';
    }

    public function mapFieldValueForm(FormInterface $fieldForm, FieldData $data)
    {
        $definition = $data->fieldDefinition;
        $iconSet = $definition->getFieldSettings()['iconset'];
        $fieldForm->add('value', IconType::class, [
            'required' => $definition->isRequired,
            'label' => $definition->getName(),
            'icon_set' => $iconSet,
        ]);
    }

    public function getSettingsSchema(): array
    {
        return [
            'iconset' => [
                'type' => 'string',
                'default' => '',
            ],
        ];
    }

    public function mapFieldDefinitionForm(FormInterface $fieldDefinitionForm, FieldDefinitionData $data): void
    {
        $fieldDefinitionForm->add('fieldSettings', IconSettingsType::class, [
            'label' => false,
        ]);
    }
}