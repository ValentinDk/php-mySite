<section>
    <div class="container">
        <div class="row">

        	<?php if ($result): ?>
					<h3>Товар успешно добавлен!</h3>
			<?php else: ?>
			

            <br/>

            <h4>Добавить товар</h4>

            <br/>

            <div class="col-lg-4">

                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Название товара</p>
                        <input type="text" name="name" placeholder="" value="">

                        <p>Код товара</p>
                        <input type="text" name="code" placeholder="" value="">

                        <p>Стоимость, $</p>
                        <input type="text" name="price" placeholder="" value="">

                        <p>Категория</p>
                        <select name="category_id">
                            <?php if (is_array($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id']; ?>" 
                                        >
                                        <?= $category['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        
                        <br/><br/>

                        <p>Производитель</p>
                        <input type="text" name="brand" placeholder="" value="">

                        <p>Изображение товара</p>
                        <input type="file" name="image">

                        <p>Детальное описание</p>
                        <textarea name="description"></textarea>
                        
                        <br/><br/>

                        <p>Наличие на складе</p>
                        <select name="availability">
                            <option value="1">Да</option>
                            <option value="0">Нет</option>
                        </select>
                        
                        <br/><br/>
                        
                        <p>Новинка</p>
                        <select name="is_new">
                            <option value="1" <?= ' selected="selected"'; ?>>Да</option>
                            <option value="0" <?= ' selected="selected"'; ?>>Нет</option>
                        </select>
                        
                        <br/><br/>

                        <p>Рекомендуемые</p>
                        <select name="is_recommended">
                            <option value="1" <?= ' selected="selected"'; ?>>Да</option>
                            <option value="0" <?= ' selected="selected"'; ?>>Нет</option>
                        </select>
                        
                        <br/><br/>

                        <p>Статус</p>
                        <select name="status">
                            <option value="1" <?= ' selected="selected"'; ?>>Отображается</option>
                            <option value="0" <?= ' selected="selected"'; ?>>Скрыт</option>
                        </select>
                        
                        <br/><br/>
                        
                        <input type="submit" name="submit" class="btn btn-default" value="Добавить">
         
                        <br/><br/>
                        
                    </form>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>