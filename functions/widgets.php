<?php
    add_action( 'widgets_init', 'mfc_init' );

    function mfc_init() {
        register_widget( 'mfc_widget' );
    }

    class mfc_widget extends WP_Widget
    {

        public function __construct()
        {
            $widget_details = array(
                'classname' => 'widget-banner',
                'description' => 'Баннер для блога'
            );

            parent::__construct( 'mfc_widget', 'Osvitamarket: Баннер', $widget_details );

            add_action('admin_enqueue_scripts', array($this, 'mfc_assets'));
        }


        public function mfc_assets()
        {
            wp_enqueue_script('media-upload');
            wp_enqueue_script('thickbox');
            wp_enqueue_script(
                'mfc-media-upload',
                get_template_directory_uri() . '/functions/scripts/mfc-media-upload.js', array('jquery')
            );
            wp_enqueue_style('thickbox');
        }


        public function widget( $args, $instance )
        {
            echo $args['before_widget'];
            ?>
            <img src='<?php echo $instance['image'] ?>' class="widget-banner__background">
            <div class="widget-banner__content">
                <p class="widget-banner__title"><?php echo $instance['title']; ?></p>
                <div class='widget-banner__description'>
                    <?php echo wpautop( esc_html( $instance['description'] ) ) ?>
                </div>
                <a
                    class="btn btn_lg btn_brand-2"
                    href='<?php echo esc_url( $instance['link_url'] ) ?>'>
                    <?php echo esc_html( $instance['link_title'] ) ?>
                </a>
            </div>

            <?php

            echo $args['after_widget'];
        }

        public function update( $new_instance, $old_instance ) {
            return $new_instance;
        }

        public function form( $instance )
        {

            $title = '';
            if( !empty( $instance['title'] ) ) {
                $title = $instance['title'];
            }

            $description = '';
            if( !empty( $instance['description'] ) ) {
                $description = $instance['description'];
            }

            $link_url = '';
            if( !empty( $instance['link_url'] ) ) {
                $link_url = $instance['link_url'];
            }

            $link_title = '';
            if( !empty( $instance['link_title'] ) ) {
                $link_title = $instance['link_title'];
            }

            $image = '';
            if(isset($instance['image']))
            {
                $image = $instance['image'];
            }
            ?>
            <p>
                <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_name( 'description' ); ?>"><?php _e( 'Description:' ); ?></label>
                <textarea
                    class="widefat"
                    id="<?php echo $this->get_field_id( 'description' ); ?>"
                    name="<?php echo $this->get_field_name( 'description' ); ?>"
                    type="text">
                    <?php echo esc_attr( $description ); ?>
                </textarea>
            </p>

            <p>
                <label for="<?php echo $this->get_field_name( 'link_url' ); ?>"><?php _e( 'Link URL:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'link_url' ); ?>" name="<?php echo $this->get_field_name( 'link_url' ); ?>" type="text" value="<?php echo esc_attr( $link_url ); ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_name( 'link_title' ); ?>"><?php _e( 'Link Title:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'link_title' ); ?>" name="<?php echo $this->get_field_name( 'link_title' ); ?>" type="text" value="<?php echo esc_attr( $link_title ); ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_name( 'image' ); ?>"><?php _e( 'Image:' ); ?></label>
                <input name="<?php echo $this->get_field_name( 'image' ); ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $image ); ?>" />
                <br>
                <br>
                <input class="button button-primary upload_image_button" type="button" value="Upload Image" />
            </p>
            <?php
        }
    }