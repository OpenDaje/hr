<?php declare(strict_types=1);

namespace Hiring\Adapter\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeApiController extends AbstractController
{
    #[Route('/api/employee', name: 'api_employee_add', methods: 'POST')]
    public function __invoke(): Response
    {
        return new JsonResponse([
            'status' => 'todo....',
        ]);
    }
}
