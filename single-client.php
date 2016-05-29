<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<div class="row">
	<div class="small-12 large-8 columns" role="main">

	<?php do_action( 'foundationpress_before_content' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php foundationpress_entry_meta(); ?>
			</header>
			<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
			<div class="entry-content">

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="row">
					<div class="column">
						<?php the_post_thumbnail( '', array('class' => 'th') ); ?>
					</div>
				</div>
			<?php endif; ?>

			<?php the_content(); ?>

// My Custom output
            
            <h2>Display a field</h2>
            <p><?php the_field('company_overview'); ?></p>        
         
<h2>Basic display (multiple values)</h2>
<?php 

$terms = get_the_terms(get_the_ID(), 'company_types');

if( $terms ): ?>

	<ul>

	<?php foreach( $terms as $term ): ?>

		<p>name: <?php echo $term->name; ?><br/>
		description: <?php echo $term->description; ?>
		<a href="<?php echo get_term_link( $term ); ?>">View all '<?php echo $term->name; ?>' posts</a></p>

	<?php endforeach; ?>

	</ul>

<?php endif; ?>

<h2>Company Image: Basic display (Object)</h2> 
<?php 

$image = get_field('company_image');

if( !empty($image) ): ?>

	<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

<?php endif; ?>


<h2>Company Types</h2> 
<?php

// load all 'category' terms for the post
$terms = get_the_terms(get_the_ID(), 'company_types');
//print_r(wp_get_object_terms(48,"company_types"));
//print_r(get_the_ID());

// we will use the first term to load ACF data from
if( !empty($terms) ) {

	echo '<ul>';

	foreach ($terms as $term) {
	
	  $term_name = $term->name;	
	  echo '<li>' . $term_name . '</li>';
	}

	echo '</ul>';
}

?>
// My Custom output end           
			</div>
			<footer>
				<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
				<p><?php the_tags(); ?></p>
			</footer>
			<?php do_action( 'foundationpress_post_before_comments' ); ?>
			<?php comments_template(); ?>
			<?php do_action( 'foundationpress_post_after_comments' ); ?>
		</article>
	<?php endwhile;?>

	<?php do_action( 'foundationpress_after_content' ); ?>

	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>