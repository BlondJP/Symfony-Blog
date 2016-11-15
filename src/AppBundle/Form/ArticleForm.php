<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, ['class' => 'AppBundle:Category', 'choice_label' => 'name', 'label' => 'Catégorie'])
            ->add('title', TextType::class, array(
                'required' => true,
            ))
            ->add('content', TextareaType::class)
            ->add('brochure', FileType::class, array('label' => 'Brochure (PDF file)'))
            ->add('save', SubmitType::class, array('label' => 'Ajouter'));

        if (!$options['data']->getId() == null) {
            $builder->add('save', SubmitType::class, array('label' => 'Modifier'));
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Article',
        ));
    }

    public function getName()
    {
        return 'app_bundle_article_form';
    }
}
