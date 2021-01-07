<?php

namespace App\Controller;

use App\Service\Helper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VacationController extends AbstractController
{
    /**
     * @Route("/vacation", name="vacation")
     * @param Helper $helper
     * @return Response
     */
    public function index(Helper $helper): Response
    {
        return $this->render('vacation/index.html.twig', [
            'vacations' => $helper->getCompany()->getVacations(),
        ]);
    }
}
