<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:07 PM
 */

namespace Viettut\DomainManager;


use Viettut\Model\User\UserEntityInterface;

interface CourseManagerInterface extends ManagerInterface
{
    /**
     * @param UserEntityInterface $user
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getCourseByUser(UserEntityInterface $user, $limit = null, $offset = null);
}