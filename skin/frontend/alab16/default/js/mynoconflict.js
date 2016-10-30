// Avoid PrototypeJS conflicts, assign jQuery to $j instead of $
var $j = jQuery.noConflict();

// First call elevateZoom

$j(document).ready(function() {     
  $j('.product-image-thumbs').attr('id', 'zoomGallery');

  //initiate the plugin and pass the id of the div containing gallery images 

  $j("#image-main").elevateZoom({gallery:'zoomGallery', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'}); 

 //pass the images to Fancybox 

 $j("#image-main").bind("click", function(e) { 
    var ez = $j('#image-main').data('elevateZoom');    
    $j.fancybox(ez.getGalleryList()); 
    return false; 
 }); 

// after click you need to remove the current zoom 

$j(".product-image-thumbs li img").click(function(){
    $j("#image-main").attr("src", $j(this).attr("data-main-image-src"));
    $j('.zoomContainer').remove();
    $j('#image-main').removeData('elevateZoom');

// and then call it again

$j('#image-main').elevateZoom({
    gallery: 'more-vies',
    lensSize: 200,
    cursor: 'pointer',
    galleryActiveClass: 'active',
    imageCrossfade: true,
    scrollZoom : true,
    responsive: true
  });
});
});