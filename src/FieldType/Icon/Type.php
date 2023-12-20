<?php

declare(strict_types=1);

namespace Elbformat\IconBundle\FieldType\Icon;

use Elbformat\IconBundle\Form\Type\IconSettingsType;
use Elbformat\IconBundle\Form\Type\IconType;
use eZ\Publish\SPI\FieldType\Generic\Type as GenericType;
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

    public function mapFieldValueForm(FormInterface $fieldForm, FieldData $data): void
    {
        $definition = $data->fieldDefinition;
        $iconSet = $definition->getFieldSettings()['iconset'];
        $fieldForm->add('value', IconType::class, [
            'required' => $definition->isRequired,
            'label' => $definition->getName(),
            'icon_set' => $iconSet,
        ]);
    }

    /** @return array{'iconset':array{'type':string,'default':string}} */
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
