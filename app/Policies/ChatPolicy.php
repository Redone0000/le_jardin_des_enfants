<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Conversation;

class ChatPolicy
{
    /**
     * Determine whether the user can view the index page.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function viewIndex(User $user)
    {
        // Permettre à l'admin, teacher et tutor d'accéder à la page d'index
        return $user->role_id === 1 || $user->role_id === 2 || $user->role_id === 3;
    }

    /**
     * Determine whether the user can view the given conversation.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Conversation $conversation
     * @return bool
     */
    public function view(User $user, Conversation $conversation)
    {
        // Permettre aux utilisateurs de voir la conversation s'ils sont participants
        return $user->id === $conversation->user1_id || $user->id === $conversation->user2_id;
    }

    /**
     * Determine whether the user can store a message in the conversation.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Conversation $conversation
     * @return bool
     */
    public function storeMessage(User $user, Conversation $conversation)
    {
        // Permettre à l'admin, teacher et tutor d'envoyer des messages s'ils sont dans la conversation
        return $this->view($user, $conversation);
    }

    /**
     * Determine whether the user can create a new conversation.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function createConversation(User $user)
    {
        // Permettre à l'admin, teacher et tutor de créer une nouvelle conversation
        return in_array($user->role_id, [1, 2, 3]); // 1: admin, 2: teacher, 3: tutor
    }
}
