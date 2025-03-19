<?php

declare(strict_types=1);

namespace Elbformat\IconBundle\Form\Type;

use Elbformat\IconBundle\FieldType\Icon\Value;
use Elbformat\IconBundle\IconSet\IconSetManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Twig\Environment;

final class IconType extends AbstractType
{
    public function __construct(
        private readonly IconSetManager $iconSetManager,
        private readonly Environment $twig,
    ) {
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var string $iconSet */
        $iconSet = $options['icon_set'];
        $iconList = $this->iconSetManager->getSet($iconSet)->getList();
        $attr = [];
        foreach($iconList as $icon) {
            $iconMarkup = $this->twig->render('@ElbformatIcon/icon.html.twig', ['icon' => $icon, 'iconset' => $iconSet]);
            $attr[$icon] = ['class' => 'elbformat-icon-select', 'data-markup' => $iconMarkup];
        }
        $builder->add('icon', ChoiceType::class, [
            'choices' => $iconList,
            'choice_attr' => $attr,
            'label' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Value::class,
            'icon_set' => null,
        ]);
        $resolver->addAllowedTypes('icon_set', 'string');
    }
}
