<?php 
if(!defined("_access")) { 
	die("Error: You don't have permission to access here..."); 
} 

if(is_array($posts)) {
	$i = 1;
	$rand2 = rand(6, 10);
	
	foreach($posts as $post) {			
		if(isset($post["post"])) {
			$post = array_shift($post);
		}
			
		$URL  = path("blog/". $post["Year"] ."/". $post["Month"] ."/". $post["Day"] ."/". $post["Slug"], FALSE, TRUE, TRUE);	
		
		$in = ($post["Tags"] !== "") ? __("in") : NULL;	

		$lock = (strlen($post["Pwd"]) === 40) ? img(_get("webURL") . _sh . _lock, array("alt" => __("Private"), "class" => "no-border")) : NULL;
?>		
			
		<div class="post">
			<div class="post-title">
				<a href="<?php echo $URL; ?>" title="<?php echo stripslashes($post["Title"]); ?>">
					<?php echo $lock . stripslashes($post["Title"]); ?>
				</a>
			</div>
			
			<div class="post-left">
				<?php 
					echo __("Published") ." ". howLong($post["Start_Date"]) ." $in ". exploding($post["Tags"], "blog/tag/") ." ". __("by") .' <a href="'. path("blog/author/". $post["Author"]) .'">'. $post["Author"] .'</a>'; ?>
			</div>
			
			<div class="post-right">
				<?php
					if($post["Enable_Comments"]) {
                    	echo fbComments($URL, TRUE);
					}
				?>
			</div>

			<div class="clear"></div>
					
			<div class="post-content">	
				<div class="social" style="float:left; margin-bottom: 30px;">
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $URL; ?>" data-text="<?php echo $post["Content"]; ?>" data-via="<?php echo _via; ?>" data-lang="<?php echo _get("webLang"); ?>">Tweet</a>
				</div>
				<?php 								
					echo showContent(pagebreak($post["Content"], $URL), TRUE); 
				?>	

				<br /><br />
				
				<?php					
					if($i === $rand2) {
						echo display('<p>
				                       <script type="text/javascript">
										google_ad_client = "ca-pub-4006994369722584";
										/* mujeresen.la */
										google_ad_slot = "9139966704";
										google_ad_width = 728;
										google_ad_height = 90;
										</script>
										<script type="text/javascript"
										src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
										</script>
				                    </p>', 4);
					}
				?>		
			</div>
			
			<div class="clear"></div>
		</div>
				
		<div class="clear"></div>
		<?php
		$i++;
	}
}
	
echo isset($pagination) ? $pagination : NULL;
