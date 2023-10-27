<?php /* Template Name: Homepage */?>

<?php require_once('header.php') ?>

<main>
    <article>
        <h1>
            <?php the_title() ?>
        </h1>
        <div class="breadgrumbs">
        <?php 
            $parent = get_post( $post->post_parent);
           
        ?>
        <?php breadcrumbs($parent->ID); ?>
        </div>
        <?php the_content() ?>
    </article>
    
</main>


<?php require_once('footer.php') ?>