<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\6\26 0026
 * Time: 15:30
 */

namespace AppBundle\Security;


use AppBundle\Entity\Goods;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class GoodsVoter extends Voter
{

    const SHOW='show';
    const EDIT='edit';
    const DELETE='delete';

    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute
     * @param mixed $subject The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {
        // TODO: Implement supports() method.
        return $subject instanceof Goods && in_array($attribute,[self::SHOW,self::EDIT,self::DELETE],true);
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     * It is safe to assume that $attribute and $subject already passed the "supports()" method check.
     *
     * @param string $attribute
     * @param mixed $goods
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $goods, TokenInterface $token)
    {
        $user = $token->getUser();
        if (!$user instanceof User){
            return false;
        }

        return $user == $goods->getUser();
    }
}