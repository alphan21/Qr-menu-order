<?php include("partials-front/menu.php"); ?>

<?php 
	if (isset($_POST['search'])) {
		$key =  $_POST['search'];

		$foods = $db->query("SELECT * FROM tbl_food WHERE title LIKE '%$key%'",PDO::FETCH_OBJ)->fetchAll();

		?>
		<div class="bg-tertiary p-5">
			<div class="row">
		<?php
		if(count($foods) < 1){
			?>
			 <div class="container mt-5">
    <div class="row">
      <div class="col-md-12 text-center">
        <i class="fas fa-search fa-4x"></i>
        <h2 class="mt-3">NAO TEM ESSE PRODUTO</h2>
        <p>NAO TEM ESSE PRODUTO, POR FAVOR TENTA DENOVO OU CONTROLE LETRAS</p>
        
      </div>
    </div>
  </div>

 







			<?php
		}else{
			foreach ($foods as $food ) {
		 	?>
	    			  	<div class="col-md-6 border p-2">
	    			  		<div class="p-2 bg-light rounded-3 ">
	    			  			<div class="row">
	    			  				<div class="col-4">
	    			  					<img src="<?php echo SITEURL."images/food/".$food->image_name; ?>" class="card-img-top" alt="<?php echo $food->title ?>">
	    			  				</div>
	    			  				<div class="col-8 p-2">
	    			  					<h4 class=""><?php echo $food->title; ?></h4>
	    			  					 	<p class="card-text"><?php echo $food->description; ?></p>
	                          			  	<p class="bold">Price : <?php echo $food->price. " "; ?> R$</p>
	                          			  	<?php 
	                                if ($food->food_content == "") {
	                                    ?>
	                                        <button class="btn btn-primary addToCartBtn" product-id="<?php echo $food->id; ?>">Pedir</button>
	                                    <?php
	                                }else{
	                                    ?>
	                                          <!-- Button extra eklemek için modal -->
	                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#extra-product-<?php echo $food->id ?>">
	                                  Pedir
	                                </button>

	  <!-- Modal   extraların gösterildiği  button  -->
	<div class="modal fade" id="extra-product-<?php echo $food->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-5" id="exampleModalLabel">Voce quer produto extra</h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	          <?php 
	           
	             $food_content = explode(",", $food->food_content);
	             foreach ($food_content as $product) {
	                 $productData = $db->query("SELECT * FROM tbl_product WHERE id = '$product' ",PDO::FETCH_OBJ)->fetchAll();

	                   ?>
	                                                 
	                                                <div class="form-check">
	                                                    <input class="form-check-input" type="checkbox" name="product-<?php echo $food->id; ?>" value="<?php echo $product; ?>" id="flexCheckDefault">
	                                                    <label class="form-check-label" for="flexCheckDefault">
	                                                        mit <?php echo $productData[0]->product_name."  (+".$productData[0]->product_price ." $)"; ?> 
	                                                    </label>
	                                                </div>
	                                                <?php

	             }

	          ?>
	      </div>
	      <div class="modal-footer">
	        <button class="btn btn-primary addToCartBtn" product-id="<?php echo $food->id; ?>">Pedir</button>
	        
	      </div>
	    </div>
	  </div>
	</div>

	                            
	                                    <?php
	                                }
	                             ?>
	    			  				</div>
	    			  			</div>
	    			  			
	    			  		</div>
	    			  	</div>



	    			  	<!--**********************************************************************************-->
	    			  	



		 	<?php
		 	}
		}


		?>
			</div>
		</div>
		<?php
		 
	}else{
		header("location:".SITEURL."table-order");
	}
 ?>
<?php include("partials-front/footer.php"); ?>
