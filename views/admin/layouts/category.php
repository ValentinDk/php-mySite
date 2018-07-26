<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Каталог</h2>
        <div class="panel-group category-products">
            <?php foreach ($categories as $categoryItem): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="/adminCategory/<?= $categoryItem['id']; ?>"
                                class="<?php if ($categoryId == $categoryItem['id']) echo 'active'; ?>"
                                >
                                <?= $categoryItem['name']; ?>
                            </a>
                        </h4>
                        <i><small><a href="/adminCategory/edit/<?= $categoryItem['id'];?>" data-id="<?= $categoryItem['id'];?>">(Редактировать)</a></small></i>
                    </div>
                </div>
            <?php endforeach; ?>
            <i><p align="center"><a href="/adminCategory/create" class="">Добавить категорию</a></p></i>
        </div>
    </div>
</div>