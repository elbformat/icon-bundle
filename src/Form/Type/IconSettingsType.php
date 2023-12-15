<?php
declare(strict_types=1);

namespace Elbformat\IbexaIconFieldtype\Form\Type;

use Elbformat\IbexaIconFieldtype\IconSet\IconSetManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class IconSettingsType extends AbstractType
{
    public function __construct(
        private readonly IconSetManager $iconSetManager,
    ) { }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('iconset', ChoiceType::class,[
            'choices' => $this->iconSetManager->getSetList()
        ]);
    }
}