/**
* Génération du sommaire
*/

jQuery(document).ready(function(){
    
	// création du nav Sommaire
    var i=0;
    var navSommaire = '<nav role="sommaire"></nav>';
    var prevH2Item = null;                                                            
    var prevH2List = null;  
    //jQuery('.navLeft .current-menu-item').after(navSommaire);

	// Sur chaque :header
	jQuery('.wrapper-layout article > .entry-content > h2, .wrapper-layout article > .entry-content > h3, .wrapper-content article > .entry-content > h2, .wrapper-content article > .entry-content > h3').each(function(){

        // création des ancres, insertion avant les headers
        jQuery( '<a id="toc' + i + '"></a>' ).insertBefore( jQuery(this) );
        // Ajout des liens vers les ancres dans le sommaire
        // console.log('aa');
        if (jQuery(this).children('a').length > 0) {
            var titleurl = jQuery(this).find('a:first').attr('href');
            var item = '<li><a target="_blank" href="' + titleurl + '">' + jQuery(this).text() + '</a></li>';
        } else {
            var item = '<li><a href="#toc' + i + '">' + jQuery(this).text() + '</a></li>';
        }
        // jQuery(item).appendTo('[role="sommaire"]');

        if( jQuery(this).is("h2") ){                                     
            prevH2List = jQuery("<ul></ul>");                
            prevH2Item = jQuery(item);                                     
            prevH2Item.append(prevH2List);                          
            prevH2Item.appendTo("#tocList");                        
        } else {                                                    
            prevH2List.append(item);                                  
        }

        i++;
	});
    
    if (i < 2) {
        // jQuery('[role="sommaire"]').css("display", "none");
        jQuery('[id="stickyMenu"]').css("display", "none");
        
    }

    jQuery('#tocList > li:first-child').addClass('active');

    // Calcul de la hauteur du footer
    var footerHeight=jQuery('#page > footer').height() + 100;

    // Fixe le sommaire au scroll (jquery.sticky.js)
    jQuery(window).load(function(){
        var viewportWidth = jQuery(window).width();
     //   console.log('viewport' +viewportWidth);
        if (viewportWidth > 900) {
            jQuery('aside#stickyMenu').sticky({ topSpacing: 130 });
            jQuery('aside#stickyMenu').sticky({ bottomSpacing: footerHeight });

            jQuery(window).on("scroll", function() {
                var scrollHeight = jQuery(document).height();
                var scrollPosition = jQuery(window).height() + jQuery(window).scrollTop();
                var asideHeight = jQuery('aside#stickyMenu').height();
              //  console.log(asideHeight);
                if ((scrollHeight - scrollPosition) < footerHeight) {
                // if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
                 //   console.log("(" +scrollHeight+ "-" +scrollPosition+ ")=" + (scrollHeight - scrollPosition ));
                    jQuery('aside#stickyMenu').css("bottom", footerHeight - (scrollHeight - scrollPosition));
                    jQuery('aside#stickyMenu').css("top", "initial");
                }
            });
        }
    });

    // corriger l'espace manquant à gauche du main, après l'action du sticky qui "fixe" le sommaire.
    jQuery(window).scroll(function(){
        if (jQuery('.sticky-wrapper').hasClass("is-sticky")) {
            jQuery('.tocActive main').css("margin-left", "250px");
        } else {
            jQuery('.tocActive main').css("margin-left", "0");   
        }
    });

    /**
     * SCROLL SPY 
     */

    // Cache selectors
    var lastId,
        topMenu = jQuery("#tocList"),
        topMenuHeight = topMenu.outerHeight()+15,
        // All list items
        menuItems = topMenu.find("a"),
        // Anchors corresponding to menu items
        scrollItems = menuItems.map(function(){
        var item = jQuery(jQuery(this).attr("href"));
        if (item.length) { return item; }
        });

    // Bind click handler to menu items
    // so we can get a fancy scroll animation
    menuItems.click(function(e){
        var href = jQuery(this).attr("href"),
            offsetTop = href === "#" ? 0 : jQuery(href).offset().top-topMenuHeight+1;
        jQuery('html, body').stop().animate({ 
            scrollTop: offsetTop
        }, 300);
        e.preventDefault();
    });

    // Bind to scroll
    jQuery(window).scroll(function(){
        // Get container scroll position
        var fromTop = jQuery(this).scrollTop()+topMenuHeight;
        
        // Get id of current scroll item
        var cur = scrollItems.map(function(){
            if (jQuery(this).offset().top < fromTop)
            return this;
        });
        // Get the id of the current element
        cur = cur[cur.length-1];
        var id = cur && cur.length ? cur[0].id : "";
        
        if (lastId !== id) {
            lastId = id;
            // Set/remove active class
            menuItems
                .parent().removeClass("active")
                .end().filter("[href='#"+id+"']").parent().addClass("active");
            }                
    });


});
