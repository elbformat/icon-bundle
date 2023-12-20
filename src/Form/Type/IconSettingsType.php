<?php

declare(strict_types=1);

namespace Elbformat\IconBundle\Form\Type;

use Elbformat\IconBundle\IconSet\IconSetManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

final class IconSettingsType extends AbstractType
{
    public function __construct(
        private readonly IconSetManager $iconSetManager,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('iconset', ChoiceType::class, [
            'choices' => $this->iconSetManager->getSetList()
        ]);
    }
}
