<?php
namespace App\ContextBundle\Infrastructure\Kitchen\Http;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class KitchenController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    #[Route('/kitchen/show')]
    function hello() :Response
    {
        return $this->render('kitchen/frontend/hello.html.twig');
    }
}