<?php
/*
 * Custom Share Buttons With Floating Sidebar (C)
 * @get_csbwf_sidebar_options()
 * @get_csbwf_sidebar_content()
 * */
?>
<?php 
// get all options value for "Custom Share Buttons with Floating Sidebar"
	function get_csbwf_sidebar_options() {
		global $wpdb;
		$ctOptions = $wpdb->get_results("SELECT option_name, option_value FROM $wpdb->options WHERE option_name LIKE 'csbwfs_%'");
								
		foreach ($ctOptions as $option) {
			$ctOptions[$option->option_name] =  $option->option_value;
		}
	
		return $ctOptions;	
	}
	
// Get plugin options

$pluginOptionsVal=get_csbwf_sidebar_options();
//check plugin in enable or not
if(isset($pluginOptionsVal['csbwfs_active']) && $pluginOptionsVal['csbwfs_active']==1){
	
if((isMobile()) && 
isset($pluginOptionsVal['csbwfs_deactive_for_mob']) && $pluginOptionsVal['csbwfs_deactive_for_mob']!='')
{
// silent is Gold;
}else
{
add_action('wp_footer','get_csbwf_sidebar_content');
add_action( 'wp_enqueue_scripts', 'csbwf_sidebar_scripts' );
add_action('wp_footer','csbwf_sidebar_load_inline_js');
add_action('wp_footer','csbwfs_cookie');
}

}

function csbwfs_cookie()
{
	echo $cookieVal='<script>csbwfsCheckCookie();function csbwfsSetCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname+"="+cvalue+"; "+expires;
}

function csbwfsGetCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(\';\');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==\' \') c = c.substring(1);
        if (c.indexOf(name) != -1) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function csbwfsCheckCookie() {
    var button_status=csbwfsGetCookie("csbwfs_show_hide_status");
    if (button_status != "") {
        
    } else {
        csbwfsSetCookie("csbwfs_show_hide_status", "active",1);
    }
}

</script>';


}

if(isset($pluginOptionsVal['csbwfs_buttons_active']) && $pluginOptionsVal['csbwfs_buttons_active']==1){
add_filter( 'the_content', 'csbfs_the_content_filter', 20);
}

//register style and scrip files
function csbwf_sidebar_scripts() {
wp_enqueue_script( 'jquery' ); // wordpress jQuery
wp_register_style( 'csbwf_sidebar_style', plugins_url( 'css/csbwfs.css',__FILE__ ) );
wp_enqueue_style( 'csbwf_sidebar_style' );
}

/*
-----------------------------------------------------------------------------------------------
                              "Add the jQuery code in head section using hooks"
-----------------------------------------------------------------------------------------------
*/


function csbwf_sidebar_load_inline_js()
{
   $pluginOptionsVal=get_csbwf_sidebar_options();
	$jscnt='<script>
	  var windWidth=jQuery( window ).width();
	  //alert(windWidth);
	  var animateWidth;
	  var defaultAnimateWidth;';
  $jscnt.='
	jQuery(document).ready(function()
  { 
	animateWidth="55";
    defaultAnimateWidth= animateWidth-10;
	animateHeight="49";
	defaultAnimateHeight= animateHeight-2;';
  if($pluginOptionsVal['csbwfs_delayTimeBtn']!='0'):
     $jscnt.='jQuery("#csbwfs-delaydiv").hide();
	  setTimeout(function(){
	  jQuery("#csbwfs-delaydiv").fadeIn();}, '.$pluginOptionsVal['csbwfs_delayTimeBtn'].');';
  endif;  
  
if($pluginOptionsVal['csbwfs_position']=='right' || $pluginOptionsVal['csbwfs_position']=='left'){
  
  if($pluginOptionsVal['csbwfs_tpublishBtn']!=''):
  $jscnt.='jQuery("div#csbwfs-tw a").hover(function(){
  jQuery("div#csbwfs-tw a").animate({width:animateWidth});
  },function(){
    jQuery("div#csbwfs-tw a").stop( true, true ).animate({width:defaultAnimateWidth});
  });';
  endif;
  
  if($pluginOptionsVal['csbwfs_fpublishBtn']!=''):
  $jscnt.='jQuery("div#csbwfs-fb a").hover(function(){
    jQuery("div#csbwfs-fb a").animate({width:animateWidth});
  },function(){
    jQuery("div#csbwfs-fb a").stop( true, true ).animate({width:defaultAnimateWidth});
  });';
  endif;
  
  if($pluginOptionsVal['csbwfs_mpublishBtn']!=''):
  $jscnt.='jQuery("div#csbwfs-ml a").hover(function(){
    jQuery("div#csbwfs-ml a").animate({width:animateWidth});
  },function(){
    jQuery("div#csbwfs-ml a").stop( true, true ).animate({width:defaultAnimateWidth});
  });';
  endif;
  
  if($pluginOptionsVal['csbwfs_gpublishBtn']!=''):
  $jscnt.='jQuery("div#csbwfs-gp a").hover(function(){
    jQuery("div#csbwfs-gp a").animate({width:animateWidth});
  },function(){
    jQuery("div#csbwfs-gp a").stop( true, true ).animate({width:defaultAnimateWidth});
  });';
  endif;
  
  if($pluginOptionsVal['csbwfs_lpublishBtn']!=''):
  $jscnt.='jQuery("div#csbwfs-li a").hover(function(){
    jQuery("div#csbwfs-li a").animate({width:animateWidth});
  },function(){
    jQuery("div#csbwfs-li a").stop( true, true ).animate({width:defaultAnimateWidth});
  });';
  endif;
  
   if($pluginOptionsVal['csbwfs_ppublishBtn']!=''):
  $jscnt.='jQuery("div#csbwfs-pin a").hover(function(){
    jQuery("div#csbwfs-pin a").animate({width:animateWidth});
  },function(){
    jQuery("div#csbwfs-pin a").stop( true, true ).animate({width:defaultAnimateWidth});
  });';
  endif;
  
   if(isset($pluginOptionsVal['csbwfs_ytpublishBtn']) && $pluginOptionsVal['csbwfs_ytpublishBtn']!=''):
  $jscnt.='jQuery("div#csbwfs-yt a").hover(function(){
    jQuery("div#csbwfs-yt a").animate({width:animateWidth});
  },function(){
    jQuery("div#csbwfs-yt a").stop( true, true ).animate({width:defaultAnimateWidth});
  });';
  endif;
   if(isset($pluginOptionsVal['csbwfs_republishBtn']) && $pluginOptionsVal['csbwfs_republishBtn']!=''):
  $jscnt.='jQuery("div#csbwfs-re a").hover(function(){
    jQuery("div#csbwfs-re a").animate({width:animateWidth});
  },function(){
    jQuery("div#csbwfs-re a").stop( true, true ).animate({width:defaultAnimateWidth});
  });';
  endif;
  
   if(isset($pluginOptionsVal['csbwfs_stpublishBtn']) && $pluginOptionsVal['csbwfs_stpublishBtn']!=''):
  $jscnt.='jQuery("div#csbwfs-st a").hover(function(){
    jQuery("div#csbwfs-st a").animate({width:animateWidth});
  },function(){
    jQuery("div#csbwfs-st a").stop( true, true ).animate({width:defaultAnimateWidth});
  });';
  endif;
  
}else
{  
 //silent
  
}

  $jscnt.='jQuery("div.csbwfs-show").hide();
  jQuery("div.csbwfs-show a").click(function(){
    jQuery("div#csbwfs-social-inner").show(500);
     jQuery("div.csbwfs-show").hide(500);
    jQuery("div.csbwfs-hide").show(500);
    csbwfsSetCookie("csbwfs_show_hide_status","active","1");
  });
  
  jQuery("div.csbwfs-hide a").click(function(){
     jQuery("div.csbwfs-show").show(500);
      jQuery("div.csbwfs-hide").hide(500);
     jQuery("div#csbwfs-social-inner").hide(500);
     csbwfsSetCookie("csbwfs_show_hide_status","in_active","1");
  });';
  
   $jscnt.='var button_status=csbwfsGetCookie("csbwfs_show_hide_status");
    if (button_status =="in_active") {
      jQuery("div.csbwfs-show").show();
      jQuery("div.csbwfs-hide").hide();
     jQuery("div#csbwfs-social-inner").hide();
    } else {
      jQuery("div#csbwfs-social-inner").show();
     jQuery("div.csbwfs-show").hide();
    jQuery("div.csbwfs-hide").show();
    }';

  
$jscnt.='});

</script>';
	
	echo $jscnt;
}	
 
/*
-----------------------------------------------------------------------------------------------
                              "Custom Share Buttons with Floating Sidebar" HTML
-----------------------------------------------------------------------------------------------
*/


function get_csbwf_sidebar_content() {
global $post;
$pluginOptionsVal=get_csbwf_sidebar_options();

/*Default Pinit Share image */
if(isset($pluginOptionsVal['csbwfs_defaultfeaturedshrimg']) && $pluginOptionsVal['csbwfs_defaultfeaturedshrimg']!=''){
	$pinShareImg=$pluginOptionsVal['csbwfs_defaultfeaturedshrimg'];
}else{
	$pinShareImg=plugins_url('images/mrweb-logo.jpg',__FILE__);
	}

if(is_category())
	{
	   $category_id = get_query_var('cat');
	   $shareurl =get_category_link( $category_id );   
	   $cats = get_the_category();
	   $ShareTitle=$cats[0]->name;
	}elseif(is_page() || is_single())
	{
		if ( has_post_thumbnail() ) 
		{
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );

			$pinShareImg= $large_image_url[0] ;
		}
			
	   $shareurl=get_permalink($post->ID);
	   $ShareTitle=$post->post_title;
	}
	elseif(is_archive())
	{
	   global $wp;
       $current_url = get_home_url(null, $wp->request, null);
       
       if ( is_day() ) :
		 $ShareTitle='Daily Archives: '. get_the_date(); 
		elseif ( is_month() ) : 
		 $ShareTitle='Monthly Archives: '. get_the_date('F Y'); 
		elseif ( is_year() ) : 
		 $ShareTitle='Yearly Archives: '. get_the_date('Y'); 
		elseif ( is_author() ) : 
		 $ShareTitle='Author Archives: '. get_the_author(); 
		else :
		 $ShareTitle ='Blog Archives';
		endif;			
	   $shareurl=$current_url;
	   
	   //$ShareTitle=$post->post_title;
	}
	else
	{
        $shareurl =home_url('/');
        $ShareTitle=get_bloginfo('name');
		}

/* Set title and url for home page */  
if(is_home() || is_front_page()) 
    {
	   $shareurl =home_url('/');
        $ShareTitle=get_bloginfo('name');	
		}	
			
$ShareTitle= htmlspecialchars(urlencode($ShareTitle));



/* Get All buttons Image */

//get facebook button image
if($pluginOptionsVal['csbwfs_fb_image']!=''){ $fImg=$pluginOptionsVal['csbwfs_fb_image'];} 
   else{$fImg=plugins_url('images/fb.png',__FILE__);}   
//get twitter button image  
if($pluginOptionsVal['csbwfs_tw_image']!=''){ $tImg=$pluginOptionsVal['csbwfs_tw_image'];} 
   else{$tImg=plugins_url('images/tw.png',__FILE__);}   
//get linkdin button image
if($pluginOptionsVal['csbwfs_li_image']!=''){ $lImg=$pluginOptionsVal['csbwfs_li_image'];} 
   else{$lImg=plugins_url('images/in.png',__FILE__);}   
//get mail button image  
if($pluginOptionsVal['csbwfs_mail_image']!=''){ $mImg=$pluginOptionsVal['csbwfs_mail_image'];} 
   else{$mImg=plugins_url('images/ml.png',__FILE__);}   
//get google plus button image 
if($pluginOptionsVal['csbwfs_gp_image']!=''){ $gImg=$pluginOptionsVal['csbwfs_gp_image'];} 
   else{$gImg=plugins_url('images/gp.png',__FILE__);}  
//get pinterest button image   
 
if($pluginOptionsVal['csbwfs_pin_image']!=''){ $pImg=$pluginOptionsVal['csbwfs_pin_image'];} 
   else{$pImg=plugins_url('images/pinit.png',__FILE__);}   
   
//get youtube button image
if(isset($pluginOptionsVal['csbwfs_yt_image']) && $pluginOptionsVal['csbwfs_yt_image']!=''){ $ytImg=$pluginOptionsVal['csbwfs_yt_image'];} 
   else{$ytImg=plugins_url('images/youtube.png',__FILE__);}   
    
//get reddit plus button image 
if(isset($pluginOptionsVal['csbwfs_re_image']) && $pluginOptionsVal['csbwfs_re_image']!=''){ $reImg=$pluginOptionsVal['csbwfs_re_image'];} 
   else{$reImg=plugins_url('images/reddit.png',__FILE__);}  
   
//get stumbleupon button image   
if(isset($pluginOptionsVal['csbwfs_st_image']) && $pluginOptionsVal['csbwfs_st_image']!=''){ $stImg=$pluginOptionsVal['csbwfs_st_image'];} 
   else{$stImg=plugins_url('images/stumbleupon.png',__FILE__);}   
     
//get email message
if(is_page() || is_single() || is_category() || is_archive()){
	
		if($pluginOptionsVal['csbwfs_mailMessage']!=''){ $mailMsg=$pluginOptionsVal['csbwfs_mailMessage'];} else{
		 $mailMsg='?subject='.$ShareTitle.'&body='.$shareurl;}
 }else
 {
	 $mailMsg='?subject='.get_bloginfo('name').'&body='.home_url('/');
	 }
 

// Top Margin
if($pluginOptionsVal['csbwfs_top_margin']!=''){
	$margin=$pluginOptionsVal['csbwfs_top_margin'];
}else
{
	$margin='25%';
	}

//Sidebar Position
if($pluginOptionsVal['csbwfs_position']=='right'){
	$style=' style="top:'.$margin.';right:-5px;"';
	$idName=' id="csbwfs-right"';
	$showImg='hide.png';
	$hideImg='show.png';
	
}else if($pluginOptionsVal['csbwfs_position']=='bottom'){
	$style=' style="bottom:0;"';
	$idName=' id="csbwfs-bottom"';
	$showImg='hide.png';
	$hideImg='show.png';
	
	}
else
{
	$idName=' id="csbwfs-left"';
	$style=' style="top:'.$margin.';left:0;"';
    $showImg='show.png';
	$hideImg='hide.png';
	}
	
 
   
/* Get All buttons background color */

//get facebook button image background color 
if($pluginOptionsVal['csbwfs_fb_bg']!=''){ $fImgbg=' style="background:'.$pluginOptionsVal['csbwfs_fb_bg'].';"';} 
   else{$fImgbg='';}   
//get twitter button image  background color 
if($pluginOptionsVal['csbwfs_tw_bg']!=''){ $tImgbg=' style="background:'.$pluginOptionsVal['csbwfs_tw_bg'].';"';} 
   else{$tImgbg='';}   
//get linkdin button image background color 
if($pluginOptionsVal['csbwfs_li_bg']!=''){ $lImgbg=' style="background:'.$pluginOptionsVal['csbwfs_li_bg'].';"';} 
   else{$lImgbg='';}   
//get mail button image  background color 
if($pluginOptionsVal['csbwfs_mail_bg']!=''){ $mImgbg=' style="background:'.$pluginOptionsVal['csbwfs_mail_bg'].';"';} 
   else{$mImgbg='';}   
//get google plus button image  background color 
if($pluginOptionsVal['csbwfs_gp_bg']!=''){ $gImgbg=' style="background:'.$pluginOptionsVal['csbwfs_gp_bg'].';"';} 
   else{$gImgbg='';}  
//get pinterest button image   background color 
if($pluginOptionsVal['csbwfs_pin_bg']!=''){ $pImgbg=' style="background:'.$pluginOptionsVal['csbwfs_pin_bg'].';"';} 
   else{$pImgbg='';}  
    
//get youtube button image   background color 
if(isset($pluginOptionsVal['csbwfs_yt_bg']) && $pluginOptionsVal['csbwfs_yt_bg']!=''){ $ytImgbg=' style="background:'.$pluginOptionsVal['csbwfs_yt_bg'].';"';} 
   else{$ytImgbg='';}   
//get reddit button image   background color 
if(isset($pluginOptionsVal['csbwfs_re_bg']) && $pluginOptionsVal['csbwfs_re_bg']!=''){ $reImgbg=' style="background:'.$pluginOptionsVal['csbwfs_re_bg'].';"';} 
   else{$reImgbg='';}  
//get stumbleupon button image   background color 
if(isset($pluginOptionsVal['csbwfs_st_bg']) && $pluginOptionsVal['csbwfs_st_bg']!=''){ $stImgbg=' style="background:'.$pluginOptionsVal['csbwfs_st_bg'].';"';} 
   else{$stImgbg='';}  
/** Message */ 

if($pluginOptionsVal['csbwfs_show_btn']!=''){ $showbtn=$pluginOptionsVal['csbwfs_show_btn'];} 
   else{$showbtn='Show Buttons';}   
//get show/hide button message 
if($pluginOptionsVal['csbwfs_hide_btn']!=''){ $hidebtn=$pluginOptionsVal['csbwfs_hide_btn'];} 
   else{$hidebtn='Hide Buttons';}   
//get mail button message 
if($pluginOptionsVal['csbwfs_share_msg']!=''){ $sharemsg=$pluginOptionsVal['csbwfs_share_msg'];} 
   else{$sharemsg='Share This With Your Friends';}   

/** Check display Show/Hide button or not*/
if(isset($pluginOptionsVal['csbwfs_rmSHBtn']) && $pluginOptionsVal['csbwfs_rmSHBtn']!=''):
$isActiveHideShowBtn='yes';
else:
$isActiveHideShowBtn='no';
endif;
$flitingSidebarContent='<div id="csbwfs-delaydiv"><div class="csbwfs-social-widget" '.$idName.' title="'.$sharemsg.'" '.$style.'>';

if($isActiveHideShowBtn!='yes') :
$flitingSidebarContent .= '<div class="csbwfs-show"><a href="javascript:" alt="'.$showbtn.'" id="csbwfs-show"><img src="'.plugins_url('custom-share-buttons-with-floating-sidebar/images/'.$showImg).'" title="'.$showbtn.'"></a></div>';
endif;

$flitingSidebarContent .= '<div id="csbwfs-social-inner">';

/** FB */
if($pluginOptionsVal['csbwfs_fpublishBtn']!=''):
$flitingSidebarContent .='<div class="csbwfs-sbutton"><div id="csbwfs-fb"><a href="https://www.facebook.com/sharer/sharer.php?u='.$shareurl.'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600\');return false;" target="_blank" alt="Share on Facebook" '.$fImgbg.'> <img src="'.$fImg.'"></a></div></div>';
endif;

/** TW */
if($pluginOptionsVal['csbwfs_tpublishBtn']!=''):
$flitingSidebarContent .='<div class="csbwfs-sbutton"><div id="csbwfs-tw"><a href="javascript:" onclick="window.open(\'http://twitter.com/share?url='.$shareurl.'&text='.$ShareTitle.'\',\'_blank\',\'width=800,height=300\')" alt="Twitter" '.$tImgbg.'><img src="'.$tImg.'"></a></div></div>';
endif;

/** GP */
if($pluginOptionsVal['csbwfs_gpublishBtn']!=''):
$flitingSidebarContent .='<div class="csbwfs-sbutton"><div id="csbwfs-gp"><a href="https://plus.google.com/share?url='.$shareurl.'"  onclick="javascript:window.open(this.href,\'\',\'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=800\');return false;" alt="Google Plus" '.$gImgbg.'><img src="'.$gImg.'"></a></div></div>';
endif;

/**  LI */
if($pluginOptionsVal['csbwfs_lpublishBtn']!=''):
$flitingSidebarContent .='<div class="csbwfs-sbutton"><div id="csbwfs-li"><a href="https://www.linkedin.com/cws/share?mini=true&url='. $shareurl.'" onclick="javascript:window.open(this.href,\'\',\'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=800\');return false;" alt="Google Plus" '.$lImgbg.'><img src="'.$lImg.'"></a></div></div>';
endif;

/** PIN */
if($pluginOptionsVal['csbwfs_ppublishBtn']!=''):
$flitingSidebarContent .='<div class="csbwfs-sbutton"><div id="csbwfs-pin"><a onclick="window.open(\'http://pinterest.com/pin/create/button/?url='.$shareurl.'&amp;media='.$pinShareImg.'&amp;description='.$ShareTitle.' :'.$shareurl.'\',\'pinIt\',\'toolbar=0,status=0,width=800,height=500\');" href="javascript:void(0);" '.$pImgbg.'><img src="'.$pImg.'"></a></div></div>';
endif;

/** YT */	 	 
if(isset($pluginOptionsVal['csbwfs_ytpublishBtn']) && $pluginOptionsVal['csbwfs_ytpublishBtn']!=''):
$flitingSidebarContent .='<div class="csbwfs-sbutton"><div id="csbwfs-yt"><a onclick="window.open(\''.$pluginOptionsVal['csbwfs_ytPath'].'\');" href="javascript:void(0);" '.$ytImgbg.'><img src="'.$ytImg.'"></a></div></div>';
endif;

/** Reddit */
if(isset($pluginOptionsVal['csbwfs_republishBtn']) && $pluginOptionsVal['csbwfs_republishBtn']!=''):
$flitingSidebarContent .='<div class="csbwfs-sbutton"><div id="csbwfs-re"><a onclick="window.open(\'http://reddit.com/submit?url='.$shareurl.'&amp;title='.$ShareTitle.'\',\'Reddit\',\'toolbar=0,status=0,width=1000,height=800\');" href="javascript:void(0);" '.$reImgbg.'><img src="'.$reImg.'"></a></div></div>';
endif;

/** Stumbleupon */
if(isset($pluginOptionsVal['csbwfs_stpublishBtn']) && $pluginOptionsVal['csbwfs_stpublishBtn']!=''):
$flitingSidebarContent .='<div class="csbwfs-sbutton"><div id="csbwfs-st"><a onclick="window.open(\'http://www.stumbleupon.com/submit?url='.$shareurl.'&amp;title='.$ShareTitle.'\',\'Stumbleupon\',\'toolbar=0,status=0,width=1000,height=800\');"  href="javascript:void(0);" '.$stImgbg.'><img src="'. $stImg.'"></a></div></div>';
endif; 

/** Mail*/
if($pluginOptionsVal['csbwfs_mpublishBtn']!=''):
$flitingSidebarContent .='<div class="csbwfs-sbutton"><div id="csbwfs-ml"><a href="mailto:'.$mailMsg.'" alt="Email" '.$mImgbg.'><img src="'.$mImg.'"></a></div></div>';
endif;

$flitingSidebarContent .='</div>'; //End social-inner

if($isActiveHideShowBtn!='yes') :
$flitingSidebarContent .='<div class="csbwfs-hide"><a href="javascript:" alt="'.$hidebtn.'" id="csbwfs-hide"><img src="'.plugins_url('custom-share-buttons-with-floating-sidebar/images/'.$hideImg).'" title="'.$hidebtn.'"></a></div>';
endif;

$flitingSidebarContent .='</div></div>'; //End social-inner


/** Check conditions */
    // Returns the content.
    
if(isset($pluginOptionsVal['csbwfs_hide_home'])){$hideOnHome=$pluginOptionsVal['csbwfs_hide_home'];	}else{			$hideOnHome='';}
  
if((is_home() && $hideOnHome=='yes' ) || (is_front_page() && $hideOnHome=='yes' )):
    $flitingSidebarContent='';
    endif;
    
print $flitingSidebarContent;
  
    
}

/**
 * Add social share bottons to the end of every post/page.
 *
 * @uses is_home()
 * @uses is_page()
 * @uses is_single()
 */
function csbfs_the_content_filter( $content ) {

global $post;
$pluginOptionsVal=get_csbwf_sidebar_options();

if(is_category())
	{
	   $category_id = get_query_var('cat');
	   $shareurl =get_category_link( $category_id );   
	   $cats = get_the_category();
	   $ShareTitle=$cats[0]->name;
	}elseif(is_page() || is_single())
	{
	   $shareurl=get_permalink($post->ID);
	   $ShareTitle=$post->post_title;
	}
	else
	{
        $shareurl =home_url('/');
        $ShareTitle=get_bloginfo('name');
		}
		
/* Set title and url for home page */  
if(is_home() || is_front_page()) 
    {
	   $shareurl =home_url('/');
        $ShareTitle=get_bloginfo('name');	
		}	
				
$ShareTitle= htmlspecialchars(urlencode($ShareTitle));

/* Get All buttons Image */

//get facebook button image
if($pluginOptionsVal['csbwfs_fb_image']!=''){ $fImg=$pluginOptionsVal['csbwfs_fb_image'];} 
   else{$fImg=plugins_url('images/fb-p.png',__FILE__);}   
//get twitter button image  
if($pluginOptionsVal['csbwfs_tw_image']!=''){ $tImg=$pluginOptionsVal['csbwfs_tw_image'];} 
   else{$tImg=plugins_url('images/tw-p.png',__FILE__);}   
//get linkdin button image
if($pluginOptionsVal['csbwfs_li_image']!=''){ $lImg=$pluginOptionsVal['csbwfs_li_image'];} 
   else{$lImg=plugins_url('images/in-p.png',__FILE__);}   
//get mail button image  
if($pluginOptionsVal['csbwfs_mail_image']!=''){ $mImg=$pluginOptionsVal['csbwfs_mail_image'];} 
   else{$mImg=plugins_url('images/ml-p.png',__FILE__);}   
//get google plus button image 
if($pluginOptionsVal['csbwfs_gp_image']!=''){ $gImg=$pluginOptionsVal['csbwfs_gp_image'];} 
   else{$gImg=plugins_url('images/gp-p.png',__FILE__);}  
//get pinterest button image   
if($pluginOptionsVal['csbwfs_pin_image']!=''){ $pImg=$pluginOptionsVal['csbwfs_pin_image'];} 
   else{$pImg=plugins_url('images/pinit-p.png',__FILE__);}   
   
//get youtube button image   
if(isset($pluginOptionsVal['csbwfs_yt_image']) && $pluginOptionsVal['csbwfs_yt_image']!=''){ $ytImg=$pluginOptionsVal['csbwfs_yt_image'];} 
   else{$ytImg=plugins_url('images/youtube-p.png',__FILE__);}   
//get reddit plus button image 
if(isset($pluginOptionsVal['csbwfs_re_image']) && $pluginOptionsVal['csbwfs_re_image']!=''){ $reImg=$pluginOptionsVal['csbwfs_re_image'];} 
   else{$reImg=plugins_url('images/reddit.png',__FILE__);}  
//get stumbleupon button image   
if(isset($pluginOptionsVal['csbwfs_st_image']) && $pluginOptionsVal['csbwfs_st_image']!=''){ $stImg=$pluginOptionsVal['csbwfs_st_image'];} 
   else{$stImg=plugins_url('images/stumbleupon.png',__FILE__);}  
   
//get email message 
if(is_page() || is_single() || is_category() || is_archive()){
	
		if($pluginOptionsVal['csbwfs_mailMessage']!=''){ $mailMsg=$pluginOptionsVal['csbwfs_mailMessage'];} else{
		 $mailMsg='?subject='.get_the_title().'&body='.$shareurl;}
 }else
 {
	 $mailMsg='?subject='.get_bloginfo('name').'&body='.home_url('/');
	 }
if(isset($pluginOptionsVal['csbwfs_btn_position']) && $pluginOptionsVal['csbwfs_btn_position']!=''):
$btnPosition=$pluginOptionsVal['csbwfs_btn_position'];
else:
$btnPosition='left';
endif;

if(isset($pluginOptionsVal['csbwfs_btn_text']) && $pluginOptionsVal['csbwfs_btn_text']!=''):
$btnText=$pluginOptionsVal['csbwfs_btn_text'];
else:
$btnText='Share This!';
endif;

$shareButtonContent='<div id="socialButtonOnPage" class="'.$btnPosition.'SocialButtonOnPage"><div class="sharethis-arrow"><span>'.$btnText.'</span></div>';
/* Facebook*/
if($pluginOptionsVal['csbwfs_fpublishBtn']!=''):
	$shareButtonContent.='<div class="csbwfs-sbutton-post"><div id="fb-p"><a href="https://www.facebook.com/sharer/sharer.php?u='.$shareurl.'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600\');return false;"
   target="_blank" alt="Share on Facebook"> <img src="'.$fImg.'"></a></div></div>';
endif;

/* Twitter */
if($pluginOptionsVal['csbwfs_tpublishBtn']!=''):
	$shareButtonContent.='<div class="csbwfs-sbutton-post"><div id="tw-p"><a href="javascript:" onclick="window.open(\'http://twitter.com/share?url='.$shareurl.'&text='.$ShareTitle.'&nbsp;&nbsp;\', \'_blank\', \'width=800,height=300\')" alt="Twitter"><img src="'.$tImg.'"></a></div></div>';
endif;

/* Google Plus */
if($pluginOptionsVal['csbwfs_gpublishBtn']!=''):
	$shareButtonContent.='<div class="csbwfs-sbutton-post"><div id="gp-p"><a href="https://plus.google.com/share?url='.$shareurl.'" onclick="javascript:window.open(this.href,\'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;" alt="Google Plus">    
  <img src="'.$gImg.'"></a></div>
	</div>';
endif;

/* Linkedin */
if($pluginOptionsVal['csbwfs_lpublishBtn']!=''):
$shareButtonContent.='<div class="csbwfs-sbutton-post"><div id="li-p"><a href="https://www.linkedin.com/cws/share?url='.$shareurl.'" onclick="javascript:window.open(this.href,\'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;" alt="Google Plus"><img src="'.$lImg.'"></a></div></div>';
endif;

/* Pinterest */
if($pluginOptionsVal['csbwfs_ppublishBtn']!=''):
$shareButtonContent.='<div class="csbwfs-sbutton-post"><div id="pin-p"><a onclick="window.open(\'http://pinterest.com/pin/create/button/?url='.$shareurl.'&amp;media='.plugins_url('images/mrweb-logo.jpg',__FILE__).'&amp;description='.$ShareTitle.':'.$shareurl.'\',\'pinIt\',\'toolbar=0,status=0,width=620,height=500\');" href="javascript:void(0);"><img src="'.$pImg.'"></a></div></div>';
endif;

/* Youtube */
if(isset($pluginOptionsVal['csbwfs_ytpublishBtn']) && $pluginOptionsVal['csbwfs_ytpublishBtn']!=''):
$shareButtonContent.='<div class="csbwfs-sbutton-post"><div id="yt-p"><a onclick="window.open(\'http://pinterest.com/pin/create/button/?url='.$shareurl.'&amp;media=http://www.mrwebsolution.in/wp-content/themes/mrweb/images/logo.png&amp;description='.$ShareTitle.':'.$shareurl.'\',\'pinIt\',\'toolbar=0,status=0,width=620,height=500\');" href="javascript:void(0);" style="width: 45px;"><img src="'.$ytImg.'"></a></div></div>';
endif;
/* Stumbleen */
if(isset($pluginOptionsVal['csbwfs_stpublishBtn']) && $pluginOptionsVal['csbwfs_stpublishBtn']!=''):
$shareButtonContent.='<div class="csbwfs-sbutton-post"><div id="st-p"><a onclick="window.open(\'http://www.stumbleupon.com/submit?url='.$shareurl.'&amp;title='.$ShareTitle.'\',\'Stumbleupon\',\'toolbar=0,status=0,width=1000,height=800\');"  href="javascript:void(0);" ><img src="'.$stImg.'"></a></div></div>';
endif;

/* Reddit */
if(isset($pluginOptionsVal['csbwfs_republishBtn']) && $pluginOptionsVal['csbwfs_republishBtn']!=''):
$shareButtonContent.='<div class="csbwfs-sbutton-post"><div id="re-p"><a onclick="window.open(\'http://reddit.com/submit?url='.$shareurl.'&amp;title='.$ShareTitle.'\',\'Reddit\',\'toolbar=0,status=0,width=1000,height=800\');" href="javascript:void(0);"><img src="'.$reImg.'"></a></div></div>';
endif;


/* Email */
if($pluginOptionsVal['csbwfs_mpublishBtn']!=''):
$shareButtonContent.='<div class="csbwfs-sbutton-post"><div id="ml-p"><a href="mailto:'.$mailMsg.'" alt="Email"><img src="'.$mImg.'"></a></div></div>';
endif;
$shareButtonContent.='</div>';


	//add_filter( 'the_content', array($this, 'add_share_buttons_to_content'));	
    // Returns the content.
    if(is_home() && $pluginOptionsVal['csbwfs_page_hide_home']!='yes'):
    $shareButtonContent='';
    endif;
    
     if(is_single() && $pluginOptionsVal['csbwfs_page_hide_post']!='yes'):
     $shareButtonContent='';
    endif;
    
     if(is_page() && $pluginOptionsVal['csbwfs_page_hide_page']!='yes'):
     $shareButtonContent='';
    endif;
    
    if(is_archive() && $pluginOptionsVal['csbwfs_page_hide_archive']!='yes'):
     $shareButtonContent='';
    endif;
    
   if($shareButtonContent!=''): 
   return $content.$shareButtonContent;
    else:
    return $content;
    endif;
}

/* 
 * Site is browsing in mobile or not
 * @IsMobile()
 * */
function isMobile() {
// Check the server headers to see if they're mobile friendly
if(isset($_SERVER["HTTP_X_WAP_PROFILE"])) {
    return true;
}
// Let's NOT return "mobile" if it's an iPhone, because the iPhone can render normal pages quite well.
if(isset($_SERVER["HTTP_USER_AGENT"])):
if(strstr($_SERVER['HTTP_USER_AGENT'], 'iPad')) {
    return false;
}
endif;

// If the http_accept header supports wap then it's a mobile too
if(isset($_SERVER["HTTP_ACCEPT"])):
if(preg_match("/wap\.|\.wap/i",$_SERVER["HTTP_ACCEPT"])) {
    return true;
}
endif;
// Still no luck? Let's have a look at the user agent on the browser. If it contains
// any of the following, it's probably a mobile device. Kappow!
if(isset($_SERVER["HTTP_USER_AGENT"])){
    $user_agents = array("midp", "j2me", "avantg", "docomo", "novarra", "palmos", "palmsource", "240x320", "opwv", "chtml", "pda", "windows\ ce", "mmp\/", "blackberry", "mib\/", "symbian", "wireless", "nokia", "hand", "mobi", "phone", "cdm", "up\.b", "audio", "SIE\-", "SEC\-", "samsung", "HTC", "mot\-", "mitsu", "sagem", "sony", "alcatel", "lg", "erics", "vx", "NEC", "philips", "mmm", "xx", "panasonic", "sharp", "wap", "sch", "rover", "pocket", "benq", "java", "pt", "pg", "vox", "amoi", "bird", "compal", "kg", "voda", "sany", "kdd", "dbt", "sendo", "sgh", "gradi", "jb", "\d\d\di", "moto");
    foreach($user_agents as $user_string){
        if(preg_match("/".$user_string."/i",$_SERVER["HTTP_USER_AGENT"])) {
            return true;
        }
    }
}
// None of the above? Then it's probably not a mobile device.
return false;
}

?>
