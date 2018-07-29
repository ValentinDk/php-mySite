<?php
namespace controllers;

use components\BaseController;
use models\Product;
use models\User;

class SiteController extends BaseController
{
    /**
     * @return bool
     */
	public function actionIndex()
	{
        $latestProducts = Product::getLatestProducts(3);
        $recommended = Product::getRecommendedProducts();

        $recommendedView = $this->objView->fetchPartial(
            'product/recommended',
            ['recommended' => $recommended]
        );
        $productsView = $this->objView->fetchPartial(
            'product/fetchProducts',
            ['products' => $latestProducts]
        );
        $categoriesView = $this->getCategoriesView();
        $this->objView->render(
            'site/index',
            [
                'categoriesView' => $categoriesView,
                'productsView' => $productsView,
                'recommendedView' => $recommendedView,
            ]
        );
		return true;
	}

	public function actionAbout()
	{
		$this->objView->render('site/about');

		return true;
	}

    /**
     * @return bool
     */
	public function actionSupport()
    {
        $userEmail = false;
        $userText = false;
        $result = false;
        $errors = [];
        // Обработка формы
        if (isset($_POST['submit'])) {
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }
            if (empty($errors)) {
                $adminEmail = 'tarasenok2012@mail.ru';
                $message = "Текст: {$userText}. От {$userEmail}";
                $subject = 'Тема письма';
                mail($adminEmail, $subject, $message);
                $result = true;
            }
        }
        $this->objView->render(
            'site/support',
            [
                'result' => $result,
                 'errors' => $errors,
                 'userEmail' => $userEmail,
                 'userText' => $userText,
             ]
         );
        return true;
    }
}