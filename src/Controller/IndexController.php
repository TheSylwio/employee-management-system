<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Service\Helper;
use mysql_xdevapi\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY")
     * @Route("/", name="index_not_logged")
     * @return Response
     */
    public function indexNotLogged(): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('index');
        }
        return $this->render('index/index.notlogged.html.twig');
    }

    /**
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     * @Route("/dashboard", name="index")
     * @param Helper $helper
     * @return Response
     */
    public function index(Helper $helper): Response
    {
        return $this->render('index/index.html.twig', [
            'posts' => $company = $helper->getCompany()->getPosts(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYER")
     * @Route("/post/add", name="post_add")
     * @param Request $request
     * @param Helper $helper
     * @return Response
     */
    public function addPost(Request $request, Helper $helper): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setCompany($helper->getCompany());
            $post->setAuthor($helper->getEmployee());

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            $this->addFlash('success', 'Pomyślnie dodano post');
            return $this->redirectToRoute('index');
        }

        return $this->render('index/add_post.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/post/{post}/delete", name="post_delete", methods={"POST"})
     * @param Post $post
     * @return Response
     */
    public function delete(Post $post): Response
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($post);
            $em->flush();
        } catch (Exception $exception) {
            $this->addFlash('error', 'Wystąpił błąd podczas usuwania postu');
            return new JsonResponse($exception->getMessage(), 500);
        }

        $this->addFlash('success', 'Pomyślnie usunięto post');
        return new JsonResponse('Pomyślnie usunięto post', 200);
    }
}
