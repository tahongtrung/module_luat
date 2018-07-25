<script type="text/javascript" src="<?=PATH?>/media/js/rating.js"></script>

<p><a href="<?=PATH?>/menu" title="&larr; Back to the menu">&larr; Back to the menu</a></p>
	<h1><?=$this->menu->title?> - &pound;<?=$this->menu->price?></h1>
    <div class="food">
        <h3 class="category"><?=$this->menu->category_title?></h3>
        <div class="food_image">
			<img src="<?=PATH?>/media/img/menu/<?=$this->menu->image?>" alt="<?=$this->menu->title?> - &pound;<?=$this->menu->price?>" />
		</div>
        <div class="food_description">
			<p>
				<?=$this->menu->description?>
			</p>
		</div>
        <?php
            $check = 0;//kiem tra xem menu nay da duoc vote chua?.
            if(isset($_SESSION["voted"])){
                if(in_array($this->menu->id, $_SESSION["voted"])){
                    $check = 1;
                }
            } 
        ?>
        
        <h3>Rating: &nbsp;</h3>
		<div id="ratings-wrapper">
			<div id="rating"><?=$this->menu->score?> (<?=$this->menu->rate?> rating<!--<?=$this->menu->more?>-->)</div>
             <?php if($check == 0) : ?>
			<div id="ratingswitch" style="visibility:visible">
				<a href="#" onclick="toggleRatingForm()">Add a rating</a>
			</div>
			<div id="ratingform" style="visibility:collapse; height:0px">
				<form action="<?=PATH?>/menu" method="post" id="newratingform">
					<fieldset class="input">
						<div class="text" id="rating_input">
							<label for="rating">Select your rating:</label>
							<select name="rating" id="rating">							
								<option value="1">1 bad</option>
								<option value="2">2</option>
								<option value="3">3 ok</option>
								<option value="4">4</option>
								<option value="5" selected>5 delicious</option>
							</select>
							<span class="message"></span>
						</div>
						<div class="text" id="rating_captcha">
							<label for="captcha_input">Type in the text from the image:</label>
							<!-- captcha image: do not store on filesystem, but generate dynamically - modify path in /media/js/rating.js -->
							<img src="<?=PATH?>/captcha/captcha.php" name="captcha_image" id="captcha_image" alt="Image with text to type in" title="Image with text to type in">
							<input type="text" name="captcha_input" id="captcha_input" size="5" maxlength="5"/>
							 <?php if(isset($this->message) && ($this->message == "2")) : ?>
                            <span class="message_error">Text did not match the text on the CAPTCHA image. Please try again width new one!</span>
                            <script>toggleRatingForm(); </script>
                            <?php else :?>
                                <span class="message"></span>
                            <?php endif ?>
						</div>
					</fieldset>
					<fieldset class="submit">
						<div class="submit">
							<input type="submit" value="Submit rating" />
                           
							
						</div>
					</fieldset>
                    <input type="hidden" id="action" name="action" value ="rating" />
                    <input type="hidden" id="idMenu" name="idMenu" value ="<?=$this->menu->id ?>"/>
				</form>
			</div>	
            <?php endif?>			
		</div>
    </div>