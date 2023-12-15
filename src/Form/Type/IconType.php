<?php
declare(strict_types=1);

namespace Elbformat\IconBundle\Form\Type;

use Elbformat\IconBundle\FieldType\Icon\Value;
use Elbformat\IconBundle\IconSet\IconSetManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class IconType extends AbstractType
{
    public function __construct(
        private readonly IconSetManager $iconSetManager,
    ) { }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $iconSet = $options['icon_set'];
        $builder->add('icon', ChoiceType::class,[
            'choices' => $this->iconSetManager->getSet($iconSet)->getList()
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Value::class,
            'icon_set' => null,
        ]);
        $resolver->addAllowedTypes('icon_set','string');
    }
}