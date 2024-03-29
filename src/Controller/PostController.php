<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post", name="post.")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param PostRepository $postRepository
     * @return Response
     */
    public function index(PostRepository $postRepository)
    {
        $post = $postRepository->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $post,
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $post = new Post();
//        $post->setTitle('This is going');
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        $form->getErrors();

        if($form->isSubmitted() && $form->isValid()) {
            // entity manager
            $em = $this->getDoctrine()->getManager();

            var_dump($request->files);die;

            $em->persist($post);
            $em->flush();
            $this->addFlash('success', 'Post was added');

            return $this->redirect($this->generateUrl('post.index'));
        }

//        return new Response('Post was created');
//        return $this->redirect($this->generateUrl('post.index'));
        return $this->render('post/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     * @param Post $post
     * @return Response
     */
    public function show(Post $post)
    {
        //create the show view
        return $this->render('post/show.html.twig', [
            'post' => $post
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param Post $post
     * @return Response
     */
    public function remove(Post $post)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        $this->addFlash('success', 'Post was removed');

        return $this->redirect($this->generateUrl('post.index'));
    }
}
