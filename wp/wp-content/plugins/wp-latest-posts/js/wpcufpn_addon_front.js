/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(function($){
    $(document).ready(function(){
        $('#wpcufpn_front_load_element').on('click',function(){
            var loaded_ids = [];
            $(".li-item-id").each(function() {
                var $this = $(this);
                loaded_ids.push($this.data('post'));
            });
            var widget_id = $(".wpcufpn_container").data('post');
            var theme_class = $(".li-item-id").attr("class").split(' ');

            var data = {
                'action' : 'loadMoreElement',
                'loaded_ids' : loaded_ids,
                'widget_id' : widget_id,
                'theme_class' : theme_class,
            };
            $.post(ajaxurl,data,function(response){
                var $res = $(response);
                $(".wpcufpn_listposts").append( $res ).imagesLoaded(function(){
                    $(".wpcufpn_listposts").masonry( 'appended', $res );
                });

               
                
                if(response == ''){
                    $('#wpcufpn_front_load_element').css('display','none');
                }
            });
            
        });
    });
});

