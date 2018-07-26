<section>
	<div class="container">
		<div class="row">
			
			<div class="col-sm-4 col-sm-offset-4 padding-right">

				<?php if ($result): ?>
					<h3>Регистрация прошла успешно!</h3>
				<?php else: ?>
					<?php if (isset($errors) && is_array($errors)): ?>
						<ul>
							<?php foreach ($errors as $error): ?>
								<li> - <?= $error; ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<div class="signup-form">
						<h2>Регистрация</h2>
						<form action="#"" method="post">
							<input type="text" name="name" placeholder="Имя" value="<?= $name; ?>" />
							<input type="email" name="email" placeholder="E-mail" value="<?= $email; ?>"/>
							<input type="password" name="password" placeholder="Пароль" value="<?= $password; ?>"/>
							<input type="submit" name="submit" class="btn btn-default" value ="Зарегистрироватьcя"/>
						</form>
					</div>
					
				<?php endif; ?>
				<br/>
				<br/>
			</div>
		</div>
	</div>
</section>