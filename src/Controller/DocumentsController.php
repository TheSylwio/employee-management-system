<?php

namespace App\Controller;

use App\Entity\Document;
use App\Form\DocumentType;
use App\Service\FileUploader;
use App\Service\Helper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class DocumentsController extends AbstractController
{
    /**
     * @Route("/documents", name="documents")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @param Helper $helper
     * @return Response
     */
    public function index(Request $request, FileUploader $fileUploader, Helper $helper): Response
    {
        $employee = $helper->getEmployee();
        $document = new Document();
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $documentFile = $form->get('filename')->getData();
            $documentFileName = $fileUploader->upload($documentFile);

            $document->setFilename($documentFileName);
            $document->setEmployee($employee);

            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();

            $this->addFlash('success', 'Pomyślnie dodano dokument!');
            return $this->redirectToRoute('documents');
        }

        return $this->render('documents/index.html.twig', [
            'documents' => $employee->getDocuments(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/documents/{filename}", name="documents_preview")
     * @param $filename
     * @return BinaryFileResponse
     */
    public function preview($filename): BinaryFileResponse
    {
        return new BinaryFileResponse("./uploads/documents/" . $filename);
    }
}
