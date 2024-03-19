<?php

namespace App\Controller\Admin;

use App\Controller\MotoController;
use App\Entity\Commentaire;
use App\Entity\Moto;
use App\Entity\Reservation;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use \App\Entity\Modele;
use \App\Entity\Proprietaire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use App\Controller\Admin\UserCrudController;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;



class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private readonly AdminUrlGenerator $adminUrlGenerator
    ) {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/index.html.twig');

       

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Get My Bike');
            
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');
        yield MenuItem::section('Utilisateurs');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Propriétaires', 'fas fa-user', Proprietaire::class);
        yield MenuItem::section('Motos');
        yield MenuItem::linkToCrud('Motos', 'fas fa-motorcycle', Moto::class);
        yield MenuItem::linkToCrud('Modèles', 'fas fa-motorcycle', Modele::class);
        yield MenuItem::section('Reservations');
        yield MenuItem::linkToCrud('Reservations', 'fas fa-list', Reservation::class);
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-list', Commentaire::class);
        yield MenuItem::section();

        yield MenuItem::linkToUrl('Home', 'fa fa-home', $this->generateUrl('app_home'));

    }

    // public function configureUserMenu(UserInterface $user): UserMenu
    // {
    //     // Usually it's better to call the parent method because that gives you a
    //     // user menu with some menu items already created ("sign out", "exit impersonation", etc.)
    //     // if you prefer to create the user menu from scratch, use: return UserMenu::new()->...
    //     return parent::configureUserMenu($user)
    //         // use the given $user object to get the user name
    //         ->setName($user->getNom())
    //         // use this method if you don't want to display the name of the user
    //         ->displayUserName(false)

    //         // you can return an URL with the avatar image
    //         // ->setAvatarUrl('https://...')
    //         ->setAvatarUrl($user->getImageName())
    //         // use this method if you don't want to display the user image
    //         ->displayUserAvatar(false)
    //         // you can also pass an email address to use gravatar's service
    //         ->setGravatarEmail($user->getEmail())

    //         // you can use any type of menu item, except submenus
    //         ->addMenuItems([
    //             MenuItem::linkToRoute('My Profile', 'fa fa-id-card', '...', ['...' => '...']),
    //             MenuItem::linkToRoute('Settings', 'fa fa-user-cog', '...', ['...' => '...']),
    //             MenuItem::section(),
    //             // MenuItem::linkToLogout('Logout', 'fa fa-sign-out'),
    //         ]);
    // }
}
