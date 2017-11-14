<?php
// src/ZelmadBundle/Form/PfeeType.php
namespace ZelmadBundle\Form;

use ZelmadBundle\Repository\SocieteRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PfeeType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
	$pattern = '%';
    $builder
      ->add('dateDebut',      DateType::class)
      ->add('dateFin',      DateType::class)
      ->add('sujet',     TextType::class)
      ->add('duree',    TextType::class)
      ->add('schoolYear',   TextType::class)
      ->add('societe', EntityType::class, array(
        'class'         => 'ZelmadBundle:Societe',
		'data_class'   => 'ZelmadBundle\Entity\Societe',
        'choice_label'  => 'nom',
        'multiple'      => false,
        'query_builder' => function(SocieteRepository $repository) use($pattern) {
          return $repository->getLikeQueryBuilder($pattern);
        }
      ))
	  
      /*->add('societeNew', SocieteType::class, array(
        'required'         => FALSE,
        'mapped'  => FALSE,
        'property_path'      => 'societe',
      ))*/
      ->add('save',      SubmitType::class)
    ;
	
    /*$builder->addEventListener( FormEvents::PRE_SUBMIT, function(FormEvent $event) {
        $data = $event->getData();
		$form = $event->getForm();
		
        if (!empty($data['societeNew']['nom'])) {
          $form->remove('societe');
		  
		  $form->add('societeNew', SocieteType::class, array(
			'mapped'  => TRUE,
			'property_path'      => 'societe',
		'data_class'   => 'ZelmadBundle\Entity\Societe',
		  ));
        }
      }
    );*/
  }
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'ZelmadBundle\Entity\Pfee',
    ));
  }
}