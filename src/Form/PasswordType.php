<?php

declare(strict_types=1);

/*
 * This file is part of the user bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\UserBundle\Form;

use ConnectHolland\UserBundle\Security\PasswordConstraints;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType as BasePasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PasswordType extends AbstractType
{
    /**
     * @var PasswordConstraints
     */
    private $passwordConstraints;

    public function __construct(PasswordConstraints $passwordConstraints)
    {
        $this->passwordConstraints = $passwordConstraints;
    }

    public function getParent(): string
    {
        return BasePasswordType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'constraints' => $this->passwordConstraints->getConstraints(),
        ]);
    }

    public function getBlockPrefix()
    {
        return null;
    }
}
