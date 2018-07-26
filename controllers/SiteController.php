<?php
namespace controllers;

use models\{Category, Product, User};
use components\BaseController;

class SiteController extends BaseController
{

	public function actionIndex()
	{
		$categories = Category::getCategoriesList();
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
        $categoriesView = $this->objView->fetchPartial(
            'layouts/category',
            ['categories' => $categories]
        );
        $this->objView->render(
            'site/index',
            [
                'categoriesView' => $categoriesView,
                'productsView' => $productsView,
                'recommendedView' => $recommendedView
            ]
        );		

		return true;
	}

	public function actionAbout()
	{
		$this->objView->render('site/about');

		return true;
	}

	public function actionSupport()
    {
        // Переменные для формы
        $userEmail = false;
        $userText = false;
        $result = false;
        $errors = array();
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена 
            // Получаем данные из формы
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];
            // Валидация полей
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }
            if (empty($errors)) {
                // Если ошибок нет
                // Отправляем письмо администратору 
                $adminEmail = 'tarasenok2012@mail.ru';
                $message = "Текст: {$userText}. От {$userEmail}";
                $subject = 'Тема письма';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }
        // Подключаем вид
        $this->objView->render(
            'site/support',
            [
                'result' => $result,
                 'errors' => $errors,
                 'userEmail' => $userEmail,
                 'userText' => $userText
             ]
         );

        return true;
    }
}