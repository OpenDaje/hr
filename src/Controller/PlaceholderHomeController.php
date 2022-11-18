<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlaceholderHomeController extends AbstractController
{
    #[Route('/', name: 'placeholder_home')]
    public function __invoke(): Response
    {
        return new JsonResponse([
            'applicationName' => 'HR',
        ]);
    }
}
