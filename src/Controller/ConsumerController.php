<?php

namespace App\Controller;

use App\Form\SignUpType;
use App\Renderer;
use App\TemplateLoader\TemplateLoaderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TemplateController
 */
class ConsumerController extends AbstractController
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var TemplateLoaderInterface
     */
    private $loader;

    /**
     * @var Renderer
     */
    private $renderer;

    /**
     * ConsumerController constructor.
     * @param \Swift_Mailer $mailer
     * @param TemplateLoaderInterface $loader
     * @param Renderer $renderer
     */
    public function __construct(\Swift_Mailer $mailer, TemplateLoaderInterface $loader, Renderer $renderer)
    {
        $this->mailer = $mailer;
        $this->loader = $loader;
        $this->renderer = $renderer;
    }

    /**
     * @Route("/sign-up")
     *
     * @param Request $request
     */
    public function signUp(Request $request)
    {
        $form = $this->createForm(SignUpType::class);

        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $message = new \Swift_Message('Sign up', $this->renderer->render($this->loader->load('consumer_welcome_email'), [
                'first_name' => $data['firstName'],
                'last_name' => $data['lastName'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]), 'text/html');

            $message->setSender('unbitest@gmail.com');
            $message->setTo($data['email']);

            $this->mailer->send($message);

            $this->addFlash('success', 'Please check your email');

            return $this->redirectToRoute('app_consumer_signup');
        }

        return $this->render('sign_up.html.twig', [
            'form' => $form->createView()
        ]);
    }
}