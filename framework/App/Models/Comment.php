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
            'SELECT c.id, c.nickname, c.content, c.created_at, c.post_id, p.title
            FROM comments c
            INNER JOIN posts p ON p.id = c.post_id
            ORDER BY c.created_at DESC'
        );
    }
    
    /**
     * Récupère tous les commentaires d'un article dont l'id est spécifié
     * 
     * @param int $postId L'id de l'article dont je veux tous les commentaires
     * @return array La liste des commentaires de l'article
     */
    public function findByPost(int $postId): array
    {
        return $this->db->getAll(
            'SELECT c.id, c.nickname, c.content, c.created_at, c.post_id
            FROM comments c
            WHERE c.post_id = ?
            ORDER BY c.created_at DESC', [
                $postId    
            ]
        );
    }
    
    public function create(array $comment): void
    {
        $this->db->execute(
            'INSERT INTO comments (nickname, content, created_at, post_id) VALUES (?, ?, NOW(), ?)', [
            $comment['nickname'],
            $comment['content'],
            $comment['post_id']
        ]);
    }
}