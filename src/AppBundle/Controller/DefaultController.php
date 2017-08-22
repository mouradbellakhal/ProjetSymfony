<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Blogpost;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $rep = $this->getDoctrine()
        ->getRepository(Blogpost::class);
        $query = $rep->createQueryBuilder('p')->where('p.published_at IS NOT NULL')->getQuery();
        $posts = $query->getResult();
        return $this->render('default/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/users", name="users")
     */
    public function usersAction(Request $request)
    {
        $users = [
            [
                'username' => 'jeremy',
                'fullname' => 'Jérémy Romey',
                'email' => 'jeremy.romey@sensiolabs.com',
            ],
            [
                'username' => 'aurelia',
                'fullname' => 'Aurélia',
                'email' => 'aurelia@sensiolabs.com',
            ],
            [
                'username' => 'heloise',
                'fullname' => 'Héloise',
                'email' => 'heloise@sensiolabs.com',
            ],
            [
                'username' => 'julie',
                'fullname' => 'Julie',
                'email' => 'julie@sensiolabs.com',
            ],
        ];

        return $this->render('default/users.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/hello/{name}", name="hello",
     *  defaults={"name"="emm"},
     *  requirements={"name"="[a-z]+"}
     * )
     * @Method("GET")
     */
    public function helloAction(Request $request, $name)
    {
        return $this->render('default/hello.html.twig', [
            'name' => $name,
        ]);
    }
}
