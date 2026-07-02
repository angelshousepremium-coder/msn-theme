<!-- SEARCH PAGE -->
<?php if (is_search()): ?>
    <section class="entry-content clearfix" style="display: inline-flex;" itemprop="articleBody">
        <ul style="width:450px;">
            <li >
			
                <h3><a href="<?php echo get_permalink(); ?>"><?php the_title();  ?></a></h3>
				<div class="entry">

    <?php
        if ( has_post_thumbnail() ) { // check if the post Thumbnail
            the_post_thumbnail();
        } else {
            //your default img
        }
?>
</div>
                <?php 
                    $content = get_the_content();
                    $trimmed_content = wp_trim_words( $content, 20, '<a href="'. get_permalink() .'"></a>' );
                    echo $trimmed_content;
                 ?>
            </li>
         </ul>
    </section>    
<?php endif ?>
