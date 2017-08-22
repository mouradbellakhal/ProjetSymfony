<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Blogpost;
use AppBundle\Form\Type\blogformType;
use Ramsey\Uuid\Uuid;

class PostController extends Controller
{
    /**
     * @Route("/admin/posts/new", name="create_post")
     * @Method({"GET", "POST"})
     */
    public function createPostAction(Request $request, EntityManagerInterface $em)
    {
        $post = new Blogpost((string) Uuid::uuid4());
        $form = $this->createForm(blogformType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($post);// prepare to insert into the database
            $em->flush();// execute all SQL queries
            return $this->redirectToRoute('posts');
        }

        return $this->render('post/createblog.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/admin/posts", name="posts")
     * @Method({"GET", "POST"})
     */
    public function postsAction(Request $request, EntityManagerInterface $em)
    {
        $posts = $this->getDoctrine()
        ->getRepository(Blogpost::class)->findAll();
        return $this->render('post/blogs.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("admin/publish/{id}", name="publish_post")
     * @Method({"GET", "POST"})
     */
    public function publishAction(Request $request, EntityManagerInterface $em, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Blogpost::class)->find($id);
        if (!$post) {
            throw $this->createNotFoundException(
                'No post found for id '.$id
            );
        }
        $post->setPublished_at(new \DateTime());
        $em->flush();
        return $this->redirectToRoute('posts');
    }

    /**
     * @Route("/post/{id}", name="post")
     * @Method({"GET", "POST"})
     */
    public function postAction(Request $request, EntityManagerInterface $em, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Blogpost::class)->find($id);
        if (!$post) {
            throw $this->createNotFoundException(
                'No post found for id '.$id
            );
        }
        if (!$post->getPublished_at()) {
            throw $this->createNotFoundException(
                'No post found for id '.$id
            );
        }
        return $this->render('post/post.html.twig', [
            'post' => $post,
        ]);
    }
}