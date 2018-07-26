        <section>
            <div class="container">
                <div class="row">
                   
                   <?= $categoriesView; ?>
                    
                    <div class="col-sm-9 padding-right">

                        <?= $productsView; ?>

                        <?= $pagination->get(); ?>
                        
                    </div>
                </div>
            </div>
        </section>