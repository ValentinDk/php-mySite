<section>
    <div class="container">
        <div class="row">

        	<?php if ($result): ?>
					<h3>Категория изменена!</h3>
			<?php else: ?>
			
            <br/>

            <h4>Редактировать категорию <a href="/adminCategory/delete/<?= $categories['id'];?>" data-id="<?= $categories['id'];?>"></i>(Удалить)</a></h4>

            <br/>

            <div class="col-lg-4">

                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Название категории</p>
                        <input type="text" name="name" placeholder="" value="<?= $categories['name']; ?>">

                        <p>Позиция в списке</p>
                        <input type="text" name="sort_order" placeholder="" value="<?= $categories['sort_order']; ?>">

                        <p>Статус</p>
                        <select name="status">
                            <option value="1" <?php if ($categories['status'] == 1) echo ' selected="selected"'; ?>>Отображается</option>
                            <option value="0" <?php if ($categories['status'] == 0) echo ' selected="selected"'; ?>>Скрыт</option>
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