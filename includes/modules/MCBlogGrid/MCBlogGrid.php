<?php

class MC_BlogGrid extends ET_Builder_Module {

    public $slug       = 'mdvcm_blog_grid';
    public $vb_support = 'on';

    protected $module_credits = array(
        'module_uri' => '',
        'author'     => 'Marie Comet',
        'author_uri' => 'https://mariecomet.fr',
    );

    public function init() {
        $this->name = esc_html__( 'Blog Grid', 'mdvcm-mc-divi-vb-custom-modules' );
        // à retirer en prod
        $debug_module = true;

        if (is_admin()) {
            // Clear module from cache if necessary
            if ($debug_module) { 
                add_action('admin_head', array( $this, 'remove_from_local_storage' ) );
            }
        }
        // à retirer en prod
    }

    public $debug_module = true;
                        
        public function remove_from_local_storage() {
            global $debug_module; 
            echo "<script>localStorage.removeItem('et_pb_templates_".esc_attr($this->slug)."');</script>";
        }


    public function get_fields() {
        return array(
            'posts_number' => array(
                'label'             => esc_html__( 'Nombre d\'articles', 'mdcm-mc-divi-custom-modules-react' ),
                'type'              => 'text',
                'option_category'   => 'configuration',
                'description'       => esc_html__( 'Choose how much posts you would like to display per page.', 'mdcm-mc-divi-custom-modules-react' ),
                'computed_affects'   => array(
                    '__posts',
                ),
                'toggle_slug'       => 'main_content',
                'default'           => 5,
            ),
            'show_sticky' => array(
                'label'             => esc_html__( 'Articles mis en avant', 'mdcm-mc-divi-custom-modules-react' ),
                'type'              => 'yes_no_button',
                'option_category'   => 'configuration',
                'options'           => array(
                    'off' => esc_html__( "No", 'mdcm-mc-divi-custom-modules-react' ),
                    'on'  => esc_html__( 'Yes', 'mdcm-mc-divi-custom-modules-react' ),
                ),
                'default_on_front'=> 'off',
                'toggle_slug'       => 'main_content',
                'description'       => esc_html__( 'Afficher uniquement les articles mis en avant', 'mdcm-mc-divi-custom-modules-react' ),
            ),
            'exclude_sticky' => array(
                'label'             => esc_html__( 'Exclure les articles mis en avant', 'mdcm-mc-divi-custom-modules-react' ),
                'type'              => 'yes_no_button',
                'option_category'   => 'configuration',
                'options'           => array(
                    'off' => esc_html__( "No", 'mdcm-mc-divi-custom-modules-react' ),
                    'on'  => esc_html__( 'Yes', 'mdcm-mc-divi-custom-modules-react' ),
                ),
                'default_on_front'=> 'off',
                'toggle_slug'       => 'main_content',
                'description'       => esc_html__( 'Exclure les articles mis en avant', 'mdcm-mc-divi-custom-modules-react' ),
            ),
            'include_categories' => array(
                'label'            => esc_html__( 'Include Categories', 'mdcm-mc-divi-custom-modules-react' ),
                'type'             => 'categories',
                'meta_categories'  => array(
                    'all'     => esc_html__( 'All Categories', 'mdcm-mc-divi-custom-modules-react' ),
                    'current' => esc_html__( 'Current Category', 'mdcm-mc-divi-custom-modules-react' ),
                ),
                'option_category'  => 'basic_option',
                'renderer_options' => array(
                    'use_terms' => false,
                ),
                'description'      => esc_html__( 'Choose which categories you would like to include in the feed.', 'mdcm-mc-divi-custom-modules-react' ),
                'toggle_slug'      => 'main_content',
                'computed_affects' => array(
                    '__posts',
                ),
            ),
            '__posts' => array(
                'type' => 'computed',
                'computed_callback' => array( 'MC_BlogGrid', 'get_blog_posts' ),
                'computed_depends_on' => array(
                    'posts_number',
                    'include_categories',
                ),
                'computed_minimum' => array(
                    'posts_number',
                ),
            ),
        );
    }

    /**
     * Get blog posts for blog module
     *
     * @param array   arguments that is being used by et_pb_custom_blog
     * @return string blog post markup
     */
    static function get_blog_posts( $args = array(), $conditional_tags = array(), $current_page = array() ) {

        $defaults = array(
            'posts_number'                  => '',
            'include_categories'            => '',
            'show_sticky'                   => '',
            'exclude_sticky'                => ''
        );

        $args = wp_parse_args( $args, $defaults );
        
        $query_args = array(
            'posts_per_page' => intval( $args['posts_number'] ),
            'post_status'    => 'publish',
        );

        $query_args['ignore_sticky_posts'] = 1;

        if ( '' !== $args['include_categories'] ) {
            $query_args['cat'] = $args['include_categories'];
        }

        if ( 'on' === $args['show_sticky'] ) {
            $query_args['post__in'] = get_option( 'sticky_posts' );
        }

        if ( 'on' === $args['exclude_sticky'] ) {
            $query_args['post__not_in'] = get_option( 'sticky_posts' );
        }

        // Get query
        $query = new WP_Query( $query_args );

        ob_start();

        if ( $query->have_posts() ) {

            echo '<div class="container">';

            $counter_post = 1;

            while( $query->have_posts() ) {
                $query->the_post();
                global $et_fb_processing_shortcode_object;

                $post_id = get_the_ID();
                $global_processing_original_value = $et_fb_processing_shortcode_object;

                $post_categories = get_the_terms( $post_id, 'category' );
                if ( ! empty( $post_categories ) && ! is_wp_error( $post_categories ) ) {
                    $categories = join(', ', wp_list_pluck( $post_categories, 'name'));
                }

                // reset the fb processing flag
                $et_fb_processing_shortcode_object = false;

                $img_size = 'blog-grid';
                if( $counter_post > 1 ) {
                    $img_size = 'et-pb-portfolio-image';
                }
                $img_url = get_the_post_thumbnail_url( $post_id, $img_size );

                ?>
                <article id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>
                    <figure>
                    <a href="<?php the_permalink(); ?>" title="<?php the_permalink( $post_id ); ?>">
                      <img src="<?php echo $img_url; ?>">
                      <div class="post_excerpt">
                          <h1 class="post_title"><?php the_title(); ?></h1>
                          <div class="post_metas">
                            <span class="post-meta"><?php echo $categories; ?></span>
                            <p class="post_date">
                              <span class="timer-svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12">
                                  <g fill="#FFF">
                                    <path d="M6 0C2.7 0 0 2.7 0 6s2.7 6 6 6 6-2.7 6-6-2.7-6-6-6zm0 10.7c-2.6 0-4.7-2.1-4.7-4.7S3.4 1.3 6 1.3s4.7 2.1 4.7 4.7-2.1 4.7-4.7 4.7z"/>
                                    <path d="M9.1 5.8H6.4V2.6c0-.3-.2-.5-.5-.5s-.5.2-.5.5v3.7c0 .3.2.5.5.5h3.2c.3 0 .5-.2.5-.5s-.2-.5-.5-.5z"/>
                                  </g>
                                </svg>
                              </span>
                              <span><?php the_time( get_option( 'date_format' ) ); ?></span></p>
                          </div>
                          
                      </div>
                    </a>
                  </figure>
                </article>
                <?php

                $et_fb_processing_shortcode_object = $global_processing_original_value;

                $counter_post++;
            } // endwhile

            echo '</div>';

            wp_reset_query();
        } else {
            if ( $et_is_builder_plugin_active ) {
                include( ET_BUILDER_PLUGIN_DIR . 'includes/no-results.php' );
            } else {
                get_template_part( 'includes/no-results', 'index' );
            }
        }

        wp_reset_postdata();

        $posts = ob_get_contents();

        ob_end_clean();

        return $posts;
    }

    public function render( $attrs, $content = null, $render_slug ) {
        
        $query_args = array(
            'posts_per_page' => intval( $this->props['posts_number'] ),
            'post_status'    => 'publish',
        );

        $query_args['ignore_sticky_posts'] = 1;

        if ( '' !== $this->props['include_categories'] ) {
            $query_args['cat'] = $this->props['include_categories'];
        }

        if ( 'on' === $this->props['show_sticky'] ) {
            $query_args['post__in'] = get_option( 'sticky_posts' );
        }

        if ( 'on' === $this->props['exclude_sticky'] ) {
            $query_args['post__not_in'] = get_option( 'sticky_posts' );
        }

        // Get query
        $query = new WP_Query( $query_args );

        ob_start();

        if ( $query->have_posts() ) {

            echo '<div class="container">';

            $counter_post = 1;

            while( $query->have_posts() ) {
                $query->the_post();
                global $et_fb_processing_shortcode_object;

                $post_id = get_the_ID();
                $global_processing_original_value = $et_fb_processing_shortcode_object;

                $post_categories = get_the_terms( $post_id, 'category' );
                if ( ! empty( $post_categories ) && ! is_wp_error( $post_categories ) ) {
                    $categories = join(', ', wp_list_pluck( $post_categories, 'name'));
                }

                // reset the fb processing flag
                $et_fb_processing_shortcode_object = false;

                $img_size = 'blog-grid';
                if( $counter_post > 1 ) {
                    $img_size = 'et-pb-portfolio-image';
                }
                $img_url = get_the_post_thumbnail_url( $post_id, $img_size );

                ?>
                <article id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>
                    <figure>
                    <a href="<?php the_permalink(); ?>" title="<?php the_permalink( $post_id ); ?>">
                      <img src="<?php echo $img_url; ?>">
                      <div class="post_excerpt">
                          <h1 class="post_title"><?php the_title(); ?></h1>
                          <div class="post_metas">
                            <span class="post-meta"><?php echo $categories; ?></span>
                            <p class="post_date">
                              <span class="timer-svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12">
                                  <g fill="#FFF">
                                    <path d="M6 0C2.7 0 0 2.7 0 6s2.7 6 6 6 6-2.7 6-6-2.7-6-6-6zm0 10.7c-2.6 0-4.7-2.1-4.7-4.7S3.4 1.3 6 1.3s4.7 2.1 4.7 4.7-2.1 4.7-4.7 4.7z"/>
                                    <path d="M9.1 5.8H6.4V2.6c0-.3-.2-.5-.5-.5s-.5.2-.5.5v3.7c0 .3.2.5.5.5h3.2c.3 0 .5-.2.5-.5s-.2-.5-.5-.5z"/>
                                  </g>
                                </svg>
                              </span>
                              <span><?php the_time( get_option( 'date_format' ) ); ?></span></p>
                          </div>
                          
                      </div>
                    </a>
                  </figure>
                </article>
                <?php

                $et_fb_processing_shortcode_object = $global_processing_original_value;

                $counter_post++;
            } // endwhile

            echo '</div>';

            wp_reset_query();
        } else {
            if ( $et_is_builder_plugin_active ) {
                include( ET_BUILDER_PLUGIN_DIR . 'includes/no-results.php' );
            } else {
                get_template_part( 'includes/no-results', 'index' );
            }
        }

        wp_reset_postdata();

        $posts = ob_get_contents();

        ob_end_clean();

        return $posts;
    }
}

new MC_BlogGrid;
