<?php

namespace App\Controller;

use App\Entity\PersistentTemplate;
use App\Form\TemplateType;
use App\Renderer;
use App\Repository\PersistentTemplateRepository;
use App\Template\DynamicTemplate;
use App\TemplateLoader\AggregateTemplateLoader;
use App\TemplateLoader\SourceTemplateLoader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class TemplateController
 */
class TemplateController extends AbstractController
{
    /**
     * @var AggregateTemplateLoader
     */
    private $loader;

    /**
     * @var SourceTemplateLoader
     */
    private $sourceTemplateLoader;

    /**
     * @var PersistentTemplateRepository
     */
    private $repository;

    /**
     * @var Renderer
     */
    private $renderer;

    /**
     * TemplateController constructor.
     * @param AggregateTemplateLoader $loader
     * @param SourceTemplateLoader $sourceTemplateLoader
     * @param PersistentTemplateRepository $repository
     * @param Renderer $renderer
     */
    public function __construct(AggregateTemplateLoader $loader, SourceTemplateLoader $sourceTemplateLoader, PersistentTemplateRepository $repository, Renderer $renderer)
    {
        $this->loader = $loader;
        $this->sourceTemplateLoader = $sourceTemplateLoader;
        $this->repository = $repository;
        $this->renderer = $renderer;
    }

    /**
     * @Route("/")
     *
     * @return Response
     */
    public function all(): Response
    {
        return $this->render('list.html.twig', [
            'templates' => $this->loader->loadAll()
        ]);
    }

    /**
     * @Route("/{id}/edit/")
     * @param Request $request
     * @param string $id
     * @return Response
     */
    public function edit(Request $request, string $id): Response
    {
        if (!$template = $this->repository->find($id)) {
            if (!$source = $this->sourceTemplateLoader->load($id)) {
                throw new NotFoundHttpException();
            }

            $template = new PersistentTemplate($id, $source->getContent());
        }

        $form = $this->createForm(TemplateType::class, $template);

        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $this->repository->save($template);
            $this->addFlash('success', 'Template has been successfully updated');

            return $this->redirectToRoute('app_template_all');
        }

        return $this->render('edit.html.twig', [
            'form' => $form->createView(),
            'template' => $template,
        ]);
    }

    /**
     * @Route("/{id}/preview/")
     * @param Request $request
     * @param string $id
     * @return Response
     */
    public function preview(Request $request, string $id): Response
    {
        if (!$source = $this->sourceTemplateLoader->load($id)) {
            throw new NotFoundHttpException();
        }

        $template = new PersistentTemplate($id, $source->getContent());

        $form = $this->createForm(TemplateType::class, $template, [
            'csrf_protection' => false
        ]);

        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            return $this->render('preview.html.twig', [
                'preview' => $this->renderer->render(new DynamicTemplate($template->getContent(), $source), $source->getExampleContext())
            ]);
        }

        throw new \Exception('Invalid form');
    }
}