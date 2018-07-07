<?php
namespace console\controllers;

use app\repositories\UserRepository;
use common\entities\User;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Manages users.
 *
 * @author Artem Mironov <mironov2708@gmail.com>
 */
class UsersController extends Controller
{

    /**
     * Creates a new user.
     */
    public function actionCreate()
    {
        $name = Console::prompt('Enter user name: ', ['required' => true]);
        $email = Console::prompt('Enter user email: ', ['required' => true]);
        $password = Console::prompt('Enter user password: ', ['required' => true]);
        $isAdmin = Console::confirm('Make this user admin?', $default = true);

        $data['group'] = ($isAdmin) ? 'admin' : 'user';
        $data['email'] = $email;
        $data['username'] = $name;

        $user = new User();
        $user->setAttributes($data);
        $user->setPassword($password);
        $user->save();

        Console::output('User was created successfully.');
    }
}