<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
    {

     
     
        return $this->render("index.html.twig");
    }

    /**
     * @Route("/test")
     */
    public function test(): Response
    {


        // $filesystemLoader = new FilesystemLoader(__DIR__.'/views/%name%');

        // $templating = new PhpEngine(new TemplateNameParser(), $filesystemLoader);
        // $templating->set(new SlotsHelper());

        // $test = $templating->render(__DIR__ .'/../../../views/index.html.twig');
        $test = "ok";
        return new Response($test);
        // $filesystemLoader = new FilesystemLoader(__DIR__.'/views/%name%');

        // $templating = new PhpEngine(new TemplateNameParser(), $filesystemLoader);
        // $templating->set(new SlotsHelper());

        // echo $templating->render('hello.php', ['firstname' => 'Fabien']);

        

        return new Response("Testado");
       
    }
}
