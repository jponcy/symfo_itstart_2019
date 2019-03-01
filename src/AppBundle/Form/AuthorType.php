<?php
namespace AppBundle\Form;

use AppBundle\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AuthorType extends AbstractType
{

    /**
     *
     * {@inheritdoc}
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('createdAt', 'hidden', ['default_value' => new \DateTime()]) => sera present/modifiable dans le HTML
            ->add('firstname')
            ->add('lastname')
            ->add('surname')
            ->add('birthdate', DateType::class, ['widget' => 'single_text'])
            ->add('birthplace');
    }

    /**
     *
     * {@inheritdoc}
     *
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Author::class
        ));
    }

    /**
     *
     * {@inheritdoc}
     *
     */
    public function getBlockPrefix()
    {
        return 'app_author';
    }
}
