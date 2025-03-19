<?php

declare(strict_types=1);

namespace Elbformat\IconBundle\FieldType\Icon;

use Elbformat\IconBundle\Form\Type\IconSettingsType;
use Elbformat\IconBundle\Form\Type\IconType;
use Ibexa\AdminUi\FieldType\FieldDefinitionFormMapperInterface;
use Ibexa\AdminUi\Form\Data\FieldDefinitionData;
use Ibexa\Contracts\ContentForms\Data\Content\FieldData;
use Ibexa\Contracts\ContentForms\FieldType\FieldValueFormMapperInterface;
use Ibexa\Contracts\Core\FieldType\Generic\Type as GenericType;
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
