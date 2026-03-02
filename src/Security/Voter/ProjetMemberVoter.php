<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Vote;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ProjetMemberVoter extends Voter
{
    public function __construct(private AccessDecisionManagerInterface $accessDecisionManager)
    {
    }
    protected function supports(string $attribute, mixed $subject): bool
    {
        if($attribute === 'projet.is_member') {
            return true;
        }
        return false;
    }

    protected function voteOnAttribute(
        string $attribute,
        mixed $subject,
        TokenInterface $token,
        ?Vote $vote = null
    ): bool {
       if($attribute === 'projet.is_member') {
           if ($this->accessDecisionManager->decide($token, ['ROLE_ADMIN'])) {
               return true;
           }
           $employe = $token->getUser();
           if($employe->getProjets()->contains($subject)) {
               return true;
           }
       }
       return false;
    }
}