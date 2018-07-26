<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Главная</title>
        <link href="/template/css/bootstrap.min.css" rel="stylesheet">
        <link href="/template/css/font-awesome.min.css" rel="stylesheet">
        <link href="/template/css/prettyPhoto.css" rel="stylesheet">
        <link href="/template/css/price-range.css" rel="stylesheet">
        <link href="/template/css/animate.css" rel="stylesheet">
        <link href="/template/css/main.css" rel="stylesheet">
        <link href="/template/css/responsive.css" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->      
        <link rel="shortcut icon" href="/template/images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/template/images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/template/images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/template/images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="/template/images/ico/apple-touch-icon-57-precomposed.png">

    </head><!--/head-->

    <body>
        <header id="header"><!--header-->
            <div class="header_top"><!--header_top-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="contactinfo">
                                <ul class="nav nav-pills">
                                    <li><a><i class="fa fa-phone"></i> +375(29) 000-00-00</a></li>
                                    <li><a><i class="fa fa-envelope"></i> vall126kv3@mail.com</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="social-icons pull-right">
                                <ul class="nav navbar-nav">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header_top-->

            <div class="header-middle"><!--header-middle-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="logo pull-left">
                                <a href="/"><img src="/template/images/home/logo.png" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">                                    
                                    <?php if (!models\User::isGuest()): ?>
                                        <?php if (models\User::isAdmin()): ?>
                                        <li>
                                            <form action="/admin/" method="post">
                                                <input type="submit" name="admin" class="btn btn-default" value ="Админка"/>
                                            </form>
                                        </li>
                                        <li><a href="/cart/">
                                            <i class="fa fa-shopping-cart"></i> Корзина
                                            (<span id="cart-count"><?= models\Cart::countItems();?></span>)
                                        </a>
                                        </li>
                                        <li>
                                            <a href="/user/">
                                                <i class="fa fa-user"></i> Мой кабинет
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/user/logout/">
                                                <i class="fa fa-unlock"></i> Выход
                                            </a>
                                        </li>
                                        <?php else: ?>
                                        <li><a href="/cart/">
                                                <i class="fa fa-shopping-cart"></i> Корзина
                                                (<span id="cart-count"><?= models\Cart::countItems();?></span>)
                                            </a>
                                        </li>
                                            <li>
                                                <a href="/user/">
                                                    <i class="fa fa-user"></i> Мой кабинет
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/user/logout/">
                                                    <i class="fa fa-unlock"></i> Выход
                                                </a>
                                            </li>
                                        <?php endif ?>
                                    <?php else: ?>
                                    <li><a href="/cart/">
                                            <i class="fa fa-shopping-cart"></i> Корзина
                                            (<span id="cart-count"><?= models\Cart::countItems();?></span>)
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/user/register/">
                                            <i class="fa fa-pencil"></i> Зарегистрироваться
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/user/login/">
                                            <i class="fa fa-lock"></i> Вход
                                        </a>
                                    </li>          
                                    <?php endif ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-middle-->

            <div class="header-bottom"><!--header-bottom-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="mainmenu pull-left">
                                <ul class="nav navbar-nav collapse navbar-collapse">
                                    <li><a href="/">Главная</a></li>
                                    <li class="dropdown"><a href="#">Магазин<i class="fa fa-angle-down"></i></a>
                                        <ul role="menu" class="sub-menu">
                                            <li><a href="/catalog/">Каталог товаров</a></li>
                                            <li><a href="/cart/">Корзина</a></li> 
                                        </ul>
                                    </li> 
                                    <li><a href="/support/">Поддержка</a></li>
                                    <li><a href="/about/">О магазине</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-bottom-->
            
        </header><!--/header-->

        <div id="main">
            <?= $content;?>
        </div>

        <footer id="footer"><!--Footer-->
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <p class="pull-left">Copyright © 2018</p>
                        <p class="pull-right">Курс PHP Start</p>
                    </div>
                </div>
            </div>
        </footer><!--/Footer-->



        <script src="/template/js/jquery.js"></script>
        <script src="/template/js/jquery.cycle2.min.js"></script>
        <script src="/template/js/jquery.cycle2.carousel.min.js"></script>
        <script src="/template/js/bootstrap.min.js"></script>
        <script src="/template/js/jquery.scrollUp.min.js"></script>
        <script src="/template/js/price-range.js"></script>
        <script src="/template/js/jquery.prettyPhoto.js"></script>
        <script src="/template/js/main.js"></script>
        <script>//Добавление в корзину асинхронным запросом
            $(document).ready(function () {
                $(".add-to-cart").click(function () { //Кнопка добавления
                    var id = $(this).attr("data-id"); //id кнопки(соответствует id товара)
                    $.post("/cart/addAjax/"+id, {}, function (data) {
                        $("#cart-count").html(data);
                    });
                    return false;
                });
            });
        </script>
    </body>
</html>