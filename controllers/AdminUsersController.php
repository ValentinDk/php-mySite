<?php
namespace controllers;

use models\User;
use components\Pagination;
use components\AdminBase;

class AdminUsersController extends AdminBase
{
    /**
     * @return bool
     */
    public function actionIndex()
    {
    	$users = User::getAllUser();
        
    	$this->objView->render(
    		'admin//users/index',
    		['users' => $users]
    	);
        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function actionDelete($id)
    {
        $result = false;
        $user = User::getUserById($id);

        if (isset($_POST['delete'])) {
            User::delete($id);
            $result = true;
        } elseif (isset($_POST['undelete'])) {
            header('Location: /admin');
        }
        $this->objView->render(
            '/admin/users/delete',
            [
                'result' => $result,
                'user' => $user,
            ]
        );
        return true;
    }
}