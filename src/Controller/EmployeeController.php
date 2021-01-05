<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\User;
use App\Form\EmployeeType;
use App\Service\Helper;
use mysql_xdevapi\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @IsGranted("ROLE_EMPLOYER")
 */
class EmployeeController extends AbstractController
{
    /**
     * @Route("/employees", name="employees")
     * @return Response
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Employee::class);
        return $this->render('employees/index.html.twig', [
            'employees' => $repo->findAll(),
        ]);
    }

    /**
     * @Route("/employees/add", name="employees_add")
     * @param Request $request
     * @param Helper $helper
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function add(Request $request, Helper $helper, UserPasswordEncoderInterface $encoder): Response
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employee->setCompany($helper->getCompany());

            $user = new User();
            $user
                ->setEmployee($employee)
                ->setEmail(strtolower($form->get('firstName')->getData()) . '.' . strtolower($form->get('surname')->getData()) . '@emp.pl')
                ->setPassword($encoder->encodePassword($user, 'admin123'))
                ->setRoles([$form->get('role')->getData()]);

            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('employees');
        }

        return $this->render('employees/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/employees/edit/{employee}", name="employee_edit")
     * @param Request $request
     * @param Employee $employee
     * @return Response
     */
    public function edit(Request $request, Employee $employee): Response
    {
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Pomyślnie zmieniono dane pracownika');

            return $this->redirectToRoute('employees');
        }

        return $this->render('employees/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYER")
     * @Route("/employee/{employee}/delete", name="employee_delete", methods={"POST"})
     * @param Employee $employee
     * @return Response
     */
    public function delete(Employee $employee): Response
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($employee);
            $em->flush();
        } catch (Exception $exception) {
            return new JsonResponse($exception->getMessage(), 500);
        }

        $this->addFlash('success', 'Pomyślnie usunięto pracownika');
        return new JsonResponse('Pomyślnie usunięto pracownika', 200);
    }
}
