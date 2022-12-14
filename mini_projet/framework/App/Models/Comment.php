<?php

namespace App\Models;

use Libraries\MVC\AbstractModel;

class Comment extends AbstractModel
{
    /**
     * Récupère tous les commentaires
     * 
     * @return array
     */
    public function findAll(): array
    {
        return $this->db->getAll(
            'SELECT c.id, username, c.content, c.created_at, c.event_id, e.title
            FROM Comments c
            INNER JOIN Events e ON e.id = c.event_id
            INNER JOIN Users u ON u.id = c.user_id
            ORDER BY c.created_at DESC'
        );
    }
    
    /**
     * Récupère tous les commentaires d'un article dont l'id est spécifié
     * 
     * @param int $postId L'id de l'article dont je veux tous les commentaires
     * @return array La liste des commentaires de l'article
     */
    public function findByPost(int $eventId): array
    {
        return $this->db->getAll(
            'SELECT c.id, u.username, c.content, c.created_at, c.event_id
            FROM Comments c
            INNER JOIN Users u ON u.id = c.user_id
            WHERE c.event_id = ?
            ORDER BY c.created_at DESC', [
                $eventId    
            ]
        );
    }
    
    public function create(array $comment): void
    {
        $this->db->execute(

            
            'INSERT INTO Comments ( content, event_id, user_id) VALUES (?, ?, ?)', [
                $comment['content'],
                $comment['event_id'],
                $comment['user_id']
            ]
        );
    }

    public function findx(int $id): ? array
    {
        return $this->db->getAll(
            'SELECT c.id, username, c.content, c.created_at, c.user_id, c.event_id
            FROM Comments c
            INNER JOIN Users u ON c.user_id = u.id
            INNER JOIN Events e ON e.id = c.event_id
            ORDER BY created_at DESC
            limit 5'
        );
    }

    public function delete(int $id): void
    {
        $this->db->execute(
            'DELETE FROM Comments WHERE id = ?', [$id]
        );
    }
}