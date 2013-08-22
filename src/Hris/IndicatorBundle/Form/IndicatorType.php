<?php

namespace Hris\IndicatorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IndicatorType extends AbstractType
{
    /**
     * Generates years from ten years back to the current year
     *
     * @return array
     */
    private function generateYears(){
        $today = getdate();
        for($year = $today['year']-10; $year <= $today['year'] + 1; $year++){
            $years[$year] = $year;
        }
        return $years;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('organisationunitGroup')
            ->add('fieldOptionGroup')
            ->add('year', 'choice', array(
                'empty_value' => '--SELECT--',
                'choices'   => $this->generateYears(),
            ))
            ->add('value');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Hris\IndicatorBundle\Entity\Indicator'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hris_indicatorbundle_indicatortype';
    }
}
