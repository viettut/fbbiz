<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 11/1/15
 * Time: 2:24 PM
 */

namespace Viettut\Bundle\WebBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Viettut\Model\User\UserEntityInterface;

class LecturerController extends FOSRestController
{
    /**
     * @Rest\Get("/{username}", name="lecturer_index")
     * @param string $username
     * @return \Symfony\Component\HttpFoundation\Response
     * @Template()
     */
    public function indexAction($username)
    {
        $author = $this->get('fos_user.user_manager')->findUserByUsername($username);
        if (!$author instanceof UserEntityInterface) {
            throw new NotFoundHttpException('page not found');
        }

        $courses = $this->get('viettut.repository.course')->getCourseByUser($author);
        $tutorials = $this->get('viettut.repository.tutorial')->getTutorialByUser($author);

        return $this->render('ViettutWebBundle:Lecturer:index.html.twig', array(
            'courses' => $courses,
            'tutorials' =>  $tutorials,
            'lecturer' => $author
        ));
    }
}