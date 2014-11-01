<?php

function websitefuse_add_admin_menu(){

	add_options_page('Country Blocker(Websitefuse.com)','Country Blocker','manage_options',__FILE__,'websitefuse_admin_landing_page');

}


function websitefuse_assets(){
	wp_enqueue_style( 'websitefuse_bootstrap_css', plugins_url( 'css/bootstrap.css', __FILE__ ), array(), '07082014', 'all' );
	wp_enqueue_style( 'websitefuse_bootstrap_multiselect_css', plugins_url( 'css/bootstrap-multiselect.css', __FILE__ ), array(), '07082014', 'all' );

	wp_enqueue_script('jquery');

	wp_enqueue_script('websitefuse_bootstrap_js',plugins_url('js/bootstrap.js',__FILE__));
	wp_enqueue_script('websitefuse_bootstrap_multiselect_js',plugins_url('js/bootstrap-multiselect.js',__FILE__));
}


function websitefuse_admin_landing_page(){
	global $wpdb;
	$websitefuse_countries = $wpdb->get_results( 'SELECT * FROM websitefuse_country');

	if(isset($_POST['websitefuse_country_block'])){
		$country_short= $_POST['multiselect'];

                    
		if($country_short[0]=='all'){

			unset($country_short[0]);
		}

		if($country_short!=''){
			$websitefuse_block_country=array();
			foreach ($country_short as $key => $value) {
				array_push($websitefuse_block_country,$value);
			}
		}
		delete_option('websitefuse_block_country');
		add_option('websitefuse_block_country',$websitefuse_block_country);
	}

	if(isset($_POST['websitefuse_block_ipv4'])){

		$o1=$_POST['o1'];
		$o2=$_POST['o2'];
		$o3=$_POST['o3'];
		$o4=$_POST['o4'];
		if($o1<1 || $o1>233 || $o2<0 || $o2>255 || $o3<0 || $o3>255 || $o4<0 || $o4>255 ){
			$return=new WP_Error('broke', __("Invaid IP address"));
		}
		else{
			$ip_num = ( 16777216 * $o1 )
			        + (    65536 * $o2 )
			        + (      256 * $o3 )
			        +              $o4;
			$ip_exist = $wpdb->get_results( 'SELECT * FROM websitefuse_ipv4 where ip_num='.$ip_num);
			if(!empty($ip_exist)){
				$return=new WP_Error('broke', __("IP address already exist in the database."));
			}else{
				$ip = $o1.'.'.$o2.'.'.$o3.'.'.$o4;
				$ip_num = $ip_num;
				$wpdb->insert( 'websitefuse_ipv4', array( 'ip' => $ip, 'ip_num' => $ip_num,'allow'=>0 ), array( '%s', '%d', '%d') );
				$return=new WP_Error('broke', __("IP address to block, added."));
			}
		}

	}

	if(isset($_POST['websitefuse_allow_ipv4'])){

		$o1=$_POST['o1'];
		$o2=$_POST['o2'];
		$o3=$_POST['o3'];
		$o4=$_POST['o4'];
		if($o1<1 || $o1>233 || $o2<0 || $o2>255 || $o3<0 || $o3>255 || $o4<0 || $o4>255 ){
			$return=new WP_Error('broke', __("Invaid IP address"));
		}
		else{
			$ip_num = ( 16777216 * $o1 )
			        + (    65536 * $o2 )
			        + (      256 * $o3 )
			        +              $o4;
			$ip_exist = $wpdb->get_results( 'SELECT * FROM websitefuse_ipv4 where ip_num='.$ip_num);
			if(!empty($ip_exist)){
				$return=new WP_Error('broke', __("IP address already exist in the database."));
			}else{
				$ip = $o1.'.'.$o2.'.'.$o3.'.'.$o4;
				$ip_num = $ip_num;
				$wpdb->insert( 'websitefuse_ipv4', array( 'ip' => $ip, 'ip_num' => $ip_num,'allow'=>1 ), array( '%s', '%d', '%d') );
				$return=new WP_Error('broke', __("IP address to allow, added."));
			}
		}

	}

	if(isset($_POST['websitefuse_delete_ipv4'])){
		$websitefuse_delete_ipv4_id=$_POST['websitefuse_delete_ipv4'];
		$wpdb->delete( 'websitefuse_ipv4', array( 'id' => $websitefuse_delete_ipv4_id ) );


	}
	
?>

	<div class="wrap" style="background-color:#FFF">
	<?php
		if ( is_wp_error($return) ){
			echo '<div id="message" class="updated" style="border-top:1px solid #EEE">';
			echo '<p>';
	   		echo $return->get_error_message();
	   		echo '</p>';
			echo '</div>';

 		}
   	?>
		<h2>Country Blocker (Websitefuse.com)</h2>
		<br>
		<h4>Select countries to Block</h4>
		<form method="post">
			<?php $websitefuse_block_country=get_option('websitefuse_block_country',array()); 
			?>

			<select class="wb_multiselect" multiple="multiple" style="max-height:200px;height:200px">
                    <?php 
                    	foreach($websitefuse_countries as $country){ 
                    		if(in_array($country->country_short, $websitefuse_block_country)){
                    ?>
                			<option value="<?php echo $country->country_short ?>" selected><?php echo $country->country ?></option>
                		<?php }else{ ?>
                			<option value="<?php echo $country->country_short ?>"><?php echo $country->country ?></option>
                			<?php }?>
                    <?php }?>
                   
                     
            </select>
            <br><br>
            <button id="submit_button" name="websitefuse_country_block" class="button-primary" value="block">Block</button>
		</form>

		
		<br>
		<hr>
		<br>

		<!--- IPs to block -->

		<h4>Select IPs to Block</h4>
		<form method="post"> 
                  <span style="float:left;">
                    <select style="max-height:200px;height:28px" name='o1'>
                      <?php for($i = 1; $i <= 233; $i++)
                        echo "<option value=".$i.">".$i."</option>";
                      ?>
                        
                    </select>
                  </span>

                  <span style="float:left">&nbsp;.&nbsp;</span>

                  <span style="float:left;">
                    <select style="max-height:200px;height:28px" name='o2'>
                       <?php for($i = 0; $i <= 255; $i++)
                        echo "<option value=".$i.">".$i."</option>";
                      ?>
                        
                    </select>
                  </span>


                  <span style="float:left">&nbsp;.&nbsp;</span>

                  <span style="float:left;">
                    <select style="max-height:200px;height:28px" name='o3'>
                       <?php for($i = 0; $i <= 255; $i++)
                        echo "<option value=".$i.">".$i."</option>";
                      ?>
                        
                    </select>
                  </span>


                  <span style="float:left">&nbsp;.&nbsp;</span>

                  <span style="float:left;">
                    <select style="max-height:200px;height:28px"  name='o4'>
                       <?php for($i = 0; $i <= 255; $i++)
                        echo "<option value=".$i.">".$i."</option>";
                      ?>
                        
                    </select>
                  </span>

                  <span style="float:left">&nbsp; &nbsp;</span>
            
            <button id="submit_button" name="websitefuse_block_ipv4" class="button-primary" value="block-ipv4">Block</button>

        
              <br/>

		</form>



		<h4>Blocked IPv4</h4>
		<?php 
			$websitefuse_blocked_ipv4 = $wpdb->get_results( 'SELECT * FROM websitefuse_ipv4 where allow=0'); 
			if(empty($websitefuse_blocked_ipv4))
				echo "No IPs Blocked yet";
			else{
				echo "<table class='table' style='border:1px solid #EEE'><tr><th>IP</th><th>Delete</th></tr>";
				foreach ($websitefuse_blocked_ipv4 as $ip) {
					echo "<tr>";
					echo "<td>".$ip->ip."</td>";
					echo "<td>";
					echo "<form method='post'>";
					echo "<button id='submit_button' name='websitefuse_delete_ipv4' class='button-primary' value='".$ip->id."'>Delete</button>";
					echo "</form>";
					echo "</td>";
					echo "</tr>";
				}
				echo "</table>";
			}

		?>
		<br>
		<hr>
		<br>

		<h4>Allow IPs from Blocked Countries</h4>
		<form method="post"> 
                  <span style="float:left;">
                    <select style="max-height:200px;height:28px" name='o1'>
                      <?php for($i = 1; $i <= 233; $i++)
                        echo "<option value=".$i.">".$i."</option>";
                      ?>
                        
                    </select>
                  </span>

                  <span style="float:left">&nbsp;.&nbsp;</span>

                  <span style="float:left;">
                    <select style="max-height:200px;height:28px" name='o2'>
                       <?php for($i = 0; $i <= 255; $i++)
                        echo "<option value=".$i.">".$i."</option>";
                      ?>
                        
                    </select>
                  </span>


                  <span style="float:left">&nbsp;.&nbsp;</span>

                  <span style="float:left;">
                    <select style="max-height:200px;height:28px" name='o3'>
                       <?php for($i = 0; $i <= 255; $i++)
                        echo "<option value=".$i.">".$i."</option>";
                      ?>
                        
                    </select>
                  </span>


                  <span style="float:left">&nbsp;.&nbsp;</span>

                  <span style="float:left;">
                    <select style="max-height:200px;height:28px"  name='o4'>
                       <?php for($i = 0; $i <= 255; $i++)
                        echo "<option value=".$i.">".$i."</option>";
                      ?>
                        
                    </select>
                  </span>

                  <span style="float:left">&nbsp; &nbsp;</span>
            
            <button id="submit_button" name="websitefuse_allow_ipv4" class="button-primary" value="block-ipv4">Allow</button>

        
              <br/>

		</form>



		<h4>Allowed IPv4</h4>
		<?php 
			$websitefuse_blocked_ipv4 = $wpdb->get_results( 'SELECT * FROM websitefuse_ipv4 where allow=1'); 
			if(empty($websitefuse_blocked_ipv4))
				echo "No IPs Allowed yet";
			else{
				echo "<table class='table' style='border:1px solid #EEE'><tr><th>IP</th><th>Delete</th></tr>";
				foreach ($websitefuse_blocked_ipv4 as $ip) {
					echo "<tr>";
					echo "<td>".$ip->ip."</td>";
					echo "<td>";
					echo "<form method='post'>";
					echo "<button id='submit_button' name='websitefuse_delete_ipv4' class='button-primary' value='".$ip->id."'>Delete</button>";
					echo "</form>";
					echo "</td>";
					echo "</tr>";
				}
				echo "</table>";
			}

		?>



		<br>
		<hr>
		<br>


	</div>
	<script type="text/javascript">
		jQuery(document).ready(function() {

	        jQuery('.wb_multiselect').multiselect({
	        includeSelectAllOption: true,
	         includeSelectAllDivider: true,
	        enableCaseInsensitiveFiltering: true,
	        buttonWidth: '100%',
	        numberDisplayed: 5
	        });
	     	console.log( "ready!" );
		});
    </script>
<?php
}

?>