<?PHP
//session_name('floor_stripper_cost_comparison');
	//session_start();
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Calculator Compare</title>

<!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

<style type="text/css">
	
	h2{
		text-align:center;
	}
	
	
	#comparison_results, #comparison_form{
		
		font-family:Verdana, sans-serif;
		font-size:13px;
		line-height:17px;
		max-width:653px;
		margin:auto;
		border-radius: 10px 10px 10px 10px;
		-moz-border-radius: 10px 10px 10px 10px;
		-webkit-border-radius: 10px 10px 10px 10px;
		border: 1px solid #000000;
		
		/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#d30000+0,ff9696+100 */
background: rgb(211,0,0); /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2QzMDAwMCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNmZjk2OTYiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top, rgba(211,0,0,1) 0%, rgba(255,150,150,1) 100%); /* FF3.6-15 */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(211,0,0,1)), color-stop(100%,rgba(255,150,150,1))); /* Chrome4-9,Safari4-5 */
background: -webkit-linear-gradient(top, rgba(211,0,0,1) 0%,rgba(255,150,150,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: -o-linear-gradient(top, rgba(211,0,0,1) 0%,rgba(255,150,150,1) 100%); /* Opera 11.10-11.50 */
background: -ms-linear-gradient(top, rgba(211,0,0,1) 0%,rgba(255,150,150,1) 100%); /* IE10 preview */
background: linear-gradient(to bottom, rgba(211,0,0,1) 0%,rgba(255,150,150,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d30000', endColorstr='#ff9696',GradientType=0 ); /* IE6-8 */
		padding: 8px 10px;
	}
	
	#comparison_form{
		padding:0 125px;
	}
	
	.dollar_sign{
		background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' version='1.1' height='16px' width='85px'><text x='2' y='13' fill='gray' font-size='12' font-family='arial'>$</text></svg>");
	background-repeat:no-repeat;
	padding-left: 12px;
	}
	
	#comparison_results{
	}
	
	#essential_results{
		font-size:10px;
		float:left;
		width:315px;
	}
	
	#your_results{
		font-size:10px;
		margin-left:10px;
		padding-left:10px;
		float:right;
		width:315px;
		border-left:1px solid #860093;
	}
	
	.labeled_at{
		font-size:8px;
	}
	
	.outies, .final_price{
		float:right;
		margin-right:5%;
		font-weight:bold;
	}
	
	.final_price{
		text-align:right;
		font-size:13px;
		color:#000;
	}
	
	.seperating_line{
		border-bottom:solid 1px #460000;
	}
	
	
	.clear_float{
		clear:both;
	}
	
	
	@media (max-width: 705px){
		
		#your_results, #essential_results{
			border:0;
			float:none;
			width:90%;
			margin:auto;
		}
	}
	
	</style>


</head>

<body>

<?PHP

/*
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
*/	
	$isSubmitted = false;
	$isValid = true;
	$squareFootError ="";
	$dilutionError = "";
	$yourCostError = "";
	// Average square feet covered by one gallon of RTU stripper
	$avgCover = 100;
	// essential Xlerate variables
	// dilution value representing a ratio of 1:19
	$essentialDilution = 20;
	// cost per gallon of concentrate
	$essentialCostPG = 48;

	if(isset($_POST['submit2'])){
			$isSubmitted = true;
			$squareFoot = strip_tags(trim($_POST['squareFoot']));
			$squareFoot = filter_var($squareFoot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$yourDilution = $_POST['yourDilution'];
			// if the user sees and selects 1:1 then $yourDilution = 2 and the user will see 1:1 instead of 2 (by using the variable $show.
			switch($_POST['yourDilution']){
			 case 2: 
				 $show = "1:1";
			 break;
			 
			 case 3: 
				 $show = "1:2";
			 break;
			 
			 case 4: 
				 $show = "1:3";
			 break;
			 
			 case 5: 
				 $show = "1:4";
			 break;
			 
			 case 6: 
				 $show = "1:5";
			 break;
			 
			 case 7: 
				 $show = "1:6";
			 break;
			 
			 case 8: 
				 $show = "1:7";
			 break;
			 
			 case 9: 
				 $show = "1:8";
			 break;
			 
			 case 10: 
				 $show = "1:9";
			 break;
			 
			 case 11: 
				 $show = "1:10";
			 break;
			 
			 case 12: 
				 $show = "1:11";
			 break;
			 
			 case 13: 
				 $show = "1:12";
			 break;
			 
			 case 14: 
				 $show = "1:13";
			 break;
			 
			 case 15: 
				 $show = "1:14";
			 break;
			 
			  case 16: 
				 $show = "1:15";
			 break;
			 
			  case 17: 
				 $show = "1:16";
			 break;
			 
			  case 18: 
				 $show = "1:17";
			 break;
			 
			  case 19: 
				 $show = "1:18";
			 break;
			 
			  case 20: 
				 $show = "1:19";
			 break;
			 
			}
			$yourCostPG	= strip_tags(trim($_POST['yourCostPG']));
			
				// Validation
			if(!is_numeric($squareFoot)){
				$isValid = false;
				$squareFootError = "Please enter a numeric value";
			}
			
			else if(empty($squareFoot)){
				$isValid = false;
				$squareFootError = "Please enter a numeric value";
			}
			
			else if($squareFoot < 200 || $squareFoot > 500000){
				$isValid = false;
				$squareFootError = "Please enter a number between 200 and 500,000";	
			}
			
			
			else if($yourDilution < 2 || $yourDilution > 20){
				$isValid = false;
				$dilutionError = "Please select dilution. If unkown choose 1:4";
			}
			
			else if($yourCostPG < 1 || $yourCostPG > 100) {
				$isValid = false;
				$yourCostError = "Please enter a number between 1 and 100";				
			}
			
			else if(empty($yourCostPG)) {
				$isValid = false;
				$yourCostError = "Please enter a number between 1 and 100";	
			}
			
			else if(!is_numeric($yourCostPG)) {
				$isValid = false;
				$yourCostError = "Please enter a numerical value";
			}
			
			else{
			
			// Calculate gallons of Ready to Use needed
			$galRTUneeded = $squareFoot / $avgCover;
			
			// Calculate Gallons of Concentrate Needed
			$essentialGalConNeeded = $galRTUneeded / $essentialDilution;
			$yourGalConNeeded = $galRTUneeded / $yourDilution;
			
			// Calculate Total Cost 
			$essentialTotal = $essentialGalConNeeded * $essentialCostPG;
			$yourTotal = $yourGalConNeeded * $yourCostPG;
			
			// Format Square Footage
			$squareFootFormat = number_format($squareFoot, 0, '', ',');
			
			// Format RTU GALLONS Needed to display with only one decimal place
			$galRTUformat = number_format($galRTUneeded, 1, '.', ',');
			
			// Format GALLONS of CONCENTRATE totals so they can be shown with a max of 1 decimal place
			$essentialGalConFormat = number_format($essentialGalConNeeded, 1, '.', ',');
			$yourGalConFormat = number_format($yourGalConNeeded, 1, '.', ',');
			
			// Format DOLLAR totals so they can be shown as dollars and cents
			$essentialTotalFormat = number_format($essentialTotal, 2, '.', ',');
			$yourTotalFormat = number_format($yourTotal, 2, '.', ',');
			
			
			?>
   
   
   <!-- FRONT END: FORM RESULTS -->
   
   
            
     <div id="comparison_results"> 
     
     	<h2>Floor Stripper Cost Comparison</h2>      
            <div id="essential_results">
                	<h3>Essential Xlerate<sup>&trade;</sup></h3>
                    <p>1. Square Footage being stripped <span class="outies"><?PHP echo $squareFootFormat; ?></span></p>
                    <div class="seperating_line"></div>
                    <p>2. Average ft<sup>2</sup> one gallon of RTU stripper covers <span class="outies"><?PHP echo $avgCover; ?></span></p>
                    <div class="seperating_line"></div>
                    <p>3. RTU gallons needed for <?PHP echo $squareFootFormat; ?> ft<sup>2</sup><span class="outies"><?PHP echo $galRTUformat; ?></span></p>
                    <div class="seperating_line"></div>
                    <p>4. Dilution ratio of stripper <span class="outies">1:19</span></p>
                    <div class="seperating_line"></div>
                    <p>5. Gallons of concentrate needed <span class="outies"><?PHP echo $essentialGalConFormat; ?></span></p>
                    <div class="seperating_line"></div>
                    <p>6. Suggested cost per gallon of concentrate <span class="outies">$<?PHP echo $essentialCostPG; ?></span></p>
                    <div class="seperating_line"></div>
                    <p>7. Total Cost <span class="final_price"><?PHP echo "$" . $essentialTotalFormat; ?></span></p>
                </div><!--essential_results-->
            
            
             <div id="your_results">
                	<h3>Your Current Floor Stripper</h3>
                    <p>1. Square Footage being stripped <span class="outies"><?PHP echo $squareFootFormat; ?></span></p>
                    <div class="seperating_line"></div>
                    <p>2. Average ft<sup>2</sup> one gallon of RTU stripper covers <span class="outies"><?PHP echo $avgCover; ?></span></p>
                    <div class="seperating_line"></div>
                    <p>3. RTU gallons needed for <?PHP echo $squareFootFormat; ?> ft<sup>2</sup><span class="outies"><?PHP echo $galRTUformat; ?></span></p>
                    <div class="seperating_line"></div>
                    <p>4. Dilution ratio of stripper <span class="outies"><?PHP echo $show; ?></span></p>
                    <div class="seperating_line"></div>
                    <p>5. Gallons of concentrate needed <span class="outies"><?PHP echo $yourGalConFormat; ?></span></p>
                    <div class="seperating_line"></div>
                    <p>6. Suggested cost per gallon of concentrate <span class="outies">$<?PHP echo $yourCostPG; ?></span></p>
                    <div class="seperating_line"></div>
                    <p>7. Total Cost <span class="final_price"><?PHP echo "$" . $yourTotalFormat; ?></span></p>
                </div><!--your_results-->
            	<div class="clear_float"></div>
                
       </div><!--  comparison_results -->    
            <?PHP
			}
		};

?>


<?php if(!$isSubmitted || !$isValid) { ?>







<!-- FRONT END: FORM -->

<div id="comparison_form">

	<h2>Floor Stripper Cost Comparison</h2>

	<form id="formTwo" name="formTwo" action="" method="post">
        
        	<p>
            	<label>Floor Square Footage<br></label>
        		<input type="text" class="text_inputs" size="5" name="squareFoot" value="<?PHP if(isset($_POST['squareFoot'])) echo $squareFoot ?>"><span class="error_message"><?PHP echo " " . $squareFootError; ?></span>
            </p>
                
            <p>
            	<label>Dilution Ratio<br></label>
                <select name="yourDilution" id="yourDilution">
                
                	<option value=""></option>
                	<option value="2" <?php if(isset($yourDilution) && $yourDilution == 2){ echo 'selected = "selected" '; }?>>1:1</option>
                    <option value="3" <?php if(isset($yourDilution) && $yourDilution == 3){ echo 'selected = "selected" '; }?>>1:2</option>
                    <option value="4" <?php if(isset($yourDilution) && $yourDilution == 4){ echo 'selected = "selected" '; }?>>1:3</option>
                    <option value="5" <?php if(isset($yourDilution) && $yourDilution == 5){ echo 'selected = "selected" '; }?>>1:4</option>
                    <option value="6" <?php if(isset($yourDilution) && $yourDilution == 6){ echo 'selected = "selected" '; }?>>1:5</option>
                    <option value="7" <?php if(isset($yourDilution) && $yourDilution == 7){ echo 'selected = "selected" '; }?>>1:6</option>
                    <option value="8" <?php if(isset($yourDilution) && $yourDilution == 8){ echo 'selected = "selected" '; }?>>1:7</option>
                    <option value="9" <?php if(isset($yourDilution) && $yourDilution == 9){ echo 'selected = "selected" '; }?>>1:8</option>
                    <option value="10" <?php if(isset($yourDilution) && $yourDilution == 10){ echo 'selected = "selected" '; }?>>1:9</option>
                    <option value="11" <?php if(isset($yourDilution) && $yourDilution == 11){ echo 'selected = "selected" '; }?>>1:10</option>
                    <option value="12" <?php if(isset($yourDilution) && $yourDilution == 12){ echo 'selected = "selected" '; }?>>1:11</option>
                    <option value="13" <?php if(isset($yourDilution) && $yourDilution == 13){ echo 'selected = "selected" '; }?>>1:12</option>
                    <option value="14" <?php if(isset($yourDilution) && $yourDilution == 14){ echo 'selected = "selected" '; }?>>1:13</option>
                    <option value="15" <?php if(isset($yourDilution) && $yourDilution == 15){ echo 'selected = "selected" '; }?>>1:14</option>
                    <option value="16" <?php if(isset($yourDilution) && $yourDilution == 16){ echo 'selected = "selected" '; }?>>1:15</option>
                    <option value="17" <?php if(isset($yourDilution) && $yourDilution == 17){ echo 'selected = "selected" '; }?>>1:16</option>
                    <option value="18" <?php if(isset($yourDilution) && $yourDilution == 18){ echo 'selected = "selected" '; }?>>1:17</option>
                    <option value="19" <?php if(isset($yourDilution) && $yourDilution == 19){ echo 'selected = "selected" '; }?>>1:18</option>
                    <option value="20" <?php if(isset($yourDilution) && $yourDilution == 20){ echo 'selected = "selected" '; }?>>1:19</option>
                </select>
                <span class="error_message"><?PHP echo " " . $dilutionError; ?></span>
        	</p>
            
            <p>
            	<label>Cost per gallon <br></label>
                <input class="dollar_sign" type="text" class="text_inputs" size="5" max-length="4" name="yourCostPG" value="<?PHP if(isset($_POST['yourCostPG'])) echo $yourCostPG ?>"></span>
                <span class="error_message"><?PHP echo " " . $yourCostError; ?></span>
                </p>

            <button type="submit" name="submit2" id="submit2" value="submit2">Submit</button>
        
        </form>

</div><!-- comparison_form -->

 <?PHP
		}
		?>

</body>
</html>