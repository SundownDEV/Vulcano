<?php

namespace App\User;

use App\Application;
use App\Content\ArticleModel;

class UserModel
{
    public function __construct ()
    {}

    public static function createUser (array $user, Application $app)
    {
        $app->getDB()->query('INSERT INTO d_users (hash_id, name, slug, createdDate, description) VALUES(:hash_id, :name, :slug, NOW(), :description)');
        $app->getDB()->bind(':hash_id', md5(uniqid()));
        $app->getDB()->bind(':name', $user['name']);
        $app->getDB()->bind(':slug', ArticleModel::esc_url($user['name']));
        $app->getDB()->bind(':description', $user['description']);
        $app->getDB()->execute();
    }

    public static function editUser ($id, array $user, Application $app)
    {
        $targetUser = self::getUser($id, $app);

        $app->getDB()->query('UPDATE d_users SET username = :username, email = :email, password = :password, access = :access, description = :description, avatar = :avatar WHERE id = :id || hash_id = :id');
        $app->getDB()->bind(':username', $user['username'] ?? $targetUser['username']);
        $app->getDB()->bind(':email', $user['email'] ?? $targetUser['email']);
        $app->getDB()->bind(':password', $user['password'] ?? $targetUser['password']);
        $app->getDB()->bind(':access', $user['access'] ?? $targetUser['access']);
        $app->getDB()->bind(':description', $user['description'] ?? $targetUser['description']);
        $app->getDB()->bind(':avatar', $user['avatar'] ?? $targetUser['avatar']);
        $app->getDB()->bind(':id', $id);

        $app->getDB()->execute();
    }

    public static function deleteUser ($id)
    {
        $app->getDB()->query('DELETE FROM d_users WHERE id = :id || hash_id = :id');
        $app->getDB()->bind(':id', $id);
        $app->getDB()->execute();
    }

    public static function getUser ($id, Application $app)
    {
        $app->getDB()->query('SELECT id, hash_id, username, password, description, email, registerDate, access, description, avatar FROM d_users WHERE id = :id || hash_id = :id || username = :id');
        $app->getDB()->bind(':id', $id);
        $app->getDB()->execute();
        $user = $app->getDB()->single();

        return $user;
    }

    public static function getAllUsers ($limit = null, Application $app)
    {
        $app->getDB()->query('SELECT id, hash_id, username, description, email, registerDate, access FROM d_users ORDER BY id DESC');
        $app->getDB()->execute();
        $users = $app->getDB()->resultset();

        return $users;
    }

    public static function increaseUser ($id)
    {}

    public static function decreaseUser ($id)
    {}
}