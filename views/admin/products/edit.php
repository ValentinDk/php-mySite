<section>
    <div class="container">
        <div class="row">

        	<?php if ($result): ?>
					<h3>Данные изменены!</h3>
			<?php else: ?>
			

            <br/>

            <h4>Редактировать товар #<?= $id; ?> <a href="/adminProducts/delete/<?= $product['id'];?>" data-id="<?= $product['id'];?>"></i>(Удалить)</a></h4>

            <br/>

            <div class="col-lg-4">

                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Название товара</p>
                        <input type="text" name="name" placeholder="" value="<?= $product['name']; ?>">

                        <p>Код товара</p>
                        <input type="text" name="code" placeholder="" value="<?= $product['code']; ?>">

                        <p>Стоимость, $</p>
                        <input type="text" name="price" placeholder="" value="<?= $product['price']; ?>">

                        <p>Категория</p>
                        <select name="category_id">
                            <?php if (is_array($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id']; ?>" 
                                        <?php if ($product['category_id'] == $category['id']) echo ' selected="selected"'; ?>>
                                        <?php echo $category['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        
                        <br/><br/>

                        <p>Производитель</p>
                        <input type="text" name="brand" placeholder="" value="<?= $product['brand']; ?>">

                        <p>Изображение товара</p>
                        <div class="product-img"
                             style="background-image: url('<?= models\Product::getImage($product['id']) ?>'); height: 500px;">
                        </div>
                        <input type="file" name="image" placeholder="">

                        <p>Детальное описание</p>
                        <textarea name="description"><?= $product['description']; ?></textarea>
                        
                        <br/><br/>

                        <p>Наличие на складе</p>
                        <select name="availability">
                            <option value="1" <?php if ($product['availability'] == 1) echo ' selected="selected"'; ?>>Да</option>
                            <option value="0" <?php if ($product['availability'] == 0) echo ' selected="selected"'; ?>>Нет</option>
                        </select>
                        
                        <br/><br/>
                        
                        <p>Новинка</p>
                        <select name="is_new">
                            <option value="1" <?php if ($product['is_new'] == 1) echo ' selected="selected"'; ?>>Да</option>
                            <option value="0" <?php if ($product['is_new'] == 0) echo ' selected="selected"'; ?>>Нет</option>
                        </select>
                        
                        <br/><br/>

                        <p>Рекомендуемые</p>
                        <select name="is_recommended">
                            <option value="1" <?php if ($product['is_recommended'] == 1) echo ' selected="selected"'; ?>>Да</option>
                            <option value="0" <?php if ($product['is_recommended'] == 0) echo ' selected="selected"'; ?>>Нет</option>
                        </select>
                        
                        <br/><br/>

                        <p>Статус</p>
                        <select name="status">
                            <option value="1" <?php if ($product['status'] == 1) echo ' selected="selected"'; ?>>Отображается</option>
                            <option value="0" <?php if ($product['status'] == 0) echo ' selected="selected"'; ?>>Скрыт</option>
                        </select>
                        
                        <br/><br/>
                        
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
         
                        <br/><br/>
                        
                    </form>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>