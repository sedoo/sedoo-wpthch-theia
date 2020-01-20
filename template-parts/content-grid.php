<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Data-Terra
 */


?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
    <a href="<?php the_permalink(); ?>"></a>
	<header class="entry-header">
        <figure>
            <?php 
            if (has_post_thumbnail()) {
                the_post_thumbnail('thumbnail-loop');
            } else {
                if (catch_that_image() ==  "no_image" ){
                    $logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'thumbnail-loop', false);
                    echo '<img src="'.$logo[0].'" alt="" class="custom-logo">';
                } else {
                    echo '<img src="';
                    echo catch_that_image();
                    echo '" alt="" />'; 
                }
                
            }?>
            
        </figure>
        <div class="tag">
    <?php
        $categories = get_the_category();
        foreach( $categories as $categorie ) { 
            if ($categorie->slug !== "non-classe") {
                if ( "en" == pll_current_language()) {
                    echo '<a href="'.site_url().'/'.pll_current_language().'/'.$slugRewrite.'/'.$categorie->slug.'" class="'.$categorie->slug.'">';
                } else {
                    echo '<a href="'.site_url().'/'.$slugRewrite.'/'.$categorie->slug.'" class="'.$categorie->slug.'">';
                }
                echo $categorie->name; 
                ?>                    
            </a>
    <?php 
            }
        }
    ?>
    </div>
        <!-- <div class="tag"> -->
        <?php 
            /*if ( ! empty( $categories ) ) {
            echo esc_html( $categories[0]->name );   
        }; */?>
        <!-- </div> -->
	</header><!-- .entry-header -->
    <div class="group-content">
        <div class="entry-content">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_excerpt(); ?>
        </div><!-- .entry-content -->
        <footer class="entry-footer">
            <?php
            if ( 'post' === get_post_type() ) :
                ?>
                <p class="post-meta">
                <?php the_date('d.m.Y'); ?>
                </p>
            <?php endif; ?>
            <!--
            <a href="<?php //the_permalink(); ?>"><?php //echo __('Lire plus', 'sedoo-wpth-labs'); ?> →</a>-->
        </footer><!-- .entry-footer -->
    </div>
</article><!-- #post-->
