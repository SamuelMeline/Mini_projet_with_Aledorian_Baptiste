<?php

namespace App\Controllers;

use Libraries\MVC\AbstractController;
use App\Models\Event;
use App\Models\Comment;
use Libraries\Auth\User;

class AdminController extends AbstractController
{
    public function index(): void
    {

        $user = new User;

        // Récupérer la liste des articles
        $model = new Event();
        $events = $model->findAll();

        $model = new Comment();
        $comments = $model->findAll();

        // Afficher le template
        if($user->getUsername() === "admin"){
            $this->render('admin.phtml', [
                'events' => $events,
                'comments' => $comments  
            ]);
        }
        else{
            $this->redirect('/login');
        }
    }
}

