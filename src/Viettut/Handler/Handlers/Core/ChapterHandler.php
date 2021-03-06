<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:48 PM
 */

namespace Viettut\Handler\Handlers\Core;


use Viettut\DomainManager\ChapterManagerInterface;
use Viettut\Handler\RoleHandlerAbstract;
use Viettut\Model\Core\ChapterInterface;
use Viettut\Model\ModelInterface;
use Viettut\Model\User\Role\LecturerInterface;
use Viettut\Model\User\UserEntityInterface;

class ChapterHandler extends RoleHandlerAbstract
{

    /**
     * @param UserEntityInterface $role
     * @return bool
     */
    public function supportsRole(UserEntityInterface $role)
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function all($limit = null, $offset = null)
    {
        /** @var LecturerInterface $lecturer */
        $lecturer = $this->getUserRole();
        return $this->getDomainManager()->getChapterByLecturer($lecturer, $limit, $offset);
    }

    protected function processForm(ModelInterface $entity, array $parameters, $method = 'PUT')
    {
        /**
         * @var ChapterInterface $entity
         */
        if (null === $entity->getAuthor()) {
            $entity->setAuthor($this->getUserRole());
        }

        return parent::processForm($entity, $parameters, $method);
    }

    /**
     * @inheritdoc
     *
     * Auto complete helper method
     *
     * @return ChapterManagerInterface
     */
    protected function getDomainManager()
    {
        return parent::getDomainManager();
    }
}