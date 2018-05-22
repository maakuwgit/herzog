<?php
class Recent_Articles extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'recent_articles', // Base ID
      esc_html__( 'Article Showcase', 'll' ), // Name
      array( 'description' => esc_html__( 'Herzog\'s most recent Posts with Headlines for category and no widget title', 'll' ), ) // Args
    );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {
    echo $args['before_widget'];

    if ( ! empty( $instance['category'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['category'] ) . $args['after_title'];
    }
    if ( ! empty( $instance['article'] ) ) {
      $article = get_the_excerpt($instance['article']);
      if( !$article ) $article = apply_filters('get_the_excerpt', get_the_content($instance['article']));
      if( !$article ) $article = 'Lorem ipsum sin dolor';
      echo $args['before_article'] . $article . $args['after_article'];
    }

    echo $args['after_widget'];
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {
    $category = ! empty( $instance['category'] ) ? $instance['category'] : esc_html__( 'News', 'll' );
    $article =  ! empty( $instance['article'] ) ? $instance['article'] : false;
    $args    = array(
                  'post_type'     => 'post',
                  'post_status'   => 'publish',
                  'order'         => 'ASC'
                );

    $posts = new WP_Query( $args );
    ?>
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_attr_e( 'Category:', 'll' ); ?></label>
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>" type="text" value="<?php echo esc_attr( $category ); ?>">
    </p>
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'article' ) ); ?>"><?php esc_attr_e( 'Article:', 'll' ); ?></label>
    <?php if ( $posts->have_posts() ) : ?>
    <select id="<?php echo esc_attr( $this->get_field_id( 'article' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'article' ) ); ?>">
    <?php while ( $posts->have_posts()) : $posts->the_post();?>
      <option<?php echo ($article == get_the_ID() ? ' selected' : '');?> value="<?php the_ID();?>"><?php the_title();?></option>
    <?php endwhile; ?>
    </select>
  <?php endif; ?>
    </p>
    <?php
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['category'] = ( ! empty( $new_instance['category'] ) ) ? sanitize_text_field( $new_instance['category'] ) : '';
    $instance['article'] = ( ! empty( $new_instance['article'] ) ) ? sanitize_text_field( $new_instance['article'] ) : '';

    return $instance;
  }

} // class Recent_Articles