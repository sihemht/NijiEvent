<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Admin;
use App\Entity\User;
use App\Entity\Event;
use App\Entity\Vote;


class DashboardController extends AbstractDashboardController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'dashboard')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Niji Event Admin');
    }
    public function configureMenuItems(): iterable
    {
       // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Admin', 'fas fa-user-tie', Admin::class);
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);

        yield MenuItem::linkToCrud('Event', 'fas fa-calendar-days', Event::class);
        //yield MenuItem::linkToCrud('Add Event', 'fa fa-tags', Event::class)
        //    ->setAction('new');

        yield MenuItem::linkToCrud('Vote', 'fa fa-check-to-slot', Vote::class);

        
    }
}
