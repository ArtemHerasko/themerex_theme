<?php
/*
Plugin Name: Woocommerce Dropdown Cart
Plugin URI: https://wordpress.org/plugins/woocommerce-dropdown-cart/
Description: A widget plugin for WooCommerce to display the cart at top of page
Author: Phuc Pham
Version: 2.1.1
Author URI: http://www.clientsa2z.com
*/

class WooCommerce_Widget_DropdownCart extends WP_Widget {

    var $default_values = array(
        'title' => '',
        'hide_if_empty' => 0,
        'show_on_checkout' => 0,
        'popup_align' => 'left'
    );

    function __construct() {

        /* Widget settings. */
        $widget_options = array(
            'classname' => 'widget_shopping_mini_cart dropdown-cart',
            'description' => __( "Display the cart content", 'themerex_theme' )
        );

        /* Create the widget. */
        parent::__construct( 'widget_shopping_mini_cart', __( 'WooCommerce Dropdown Cart', 'themerex_theme' ), $widget_options );
    }


    function widget( $args, $instance ) {

        $instance = wp_parse_args($instance, $this->default_values);

        if(empty($instance['show_on_checkout']) && (is_cart() || is_checkout())){
            return;
        }

        $woocommerce = WC();

        $before_widget = $after_widget = $before_title = $after_title = '';
        extract( $args, EXTR_OVERWRITE );


        $hide_if_empty = empty( $instance['hide_if_empty'] )  ? 0 : 1;
        $popup_align = $instance['popup_align'] == 'left'?'left':'right';

        echo $before_widget;

        $title = apply_filters('widget_title', $instance['title']);
        if ( $title )
            echo $before_title . $title . $after_title;

        $cart_contents_count = $woocommerce->cart->get_cart_contents_count();

        $item_text = __('item', 'themerex_theme');
        $items_text = __('items', 'themerex_theme');

        ?>
        <div class="widget_shopping_mini_cart_content" id="<?php echo $this->id ?>-content">
            <?php if ( !$hide_if_empty || $cart_contents_count > 0 ) : ?>
                <div class="dropdown-cart-button <?php echo $hide_if_empty ? 'hide_dropdown_cart_widget_if_empty' : '' ?>" style="<?php echo $hide_if_empty && sizeof( $woocommerce->cart->get_cart() ) == 0 ? "display:none;":"" ?>">
                    <a href="#" class="dropdown-total"><?php echo $cart_contents_count.' '($item_text, $items_text, $cart_contents_count) ?> - <?php echo $woocommerce->cart->get_cart_subtotal(); ?></a>
                    <div class="dropdown dropdown-<?php echo $popup_align ?>">
                        <?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

    <ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
        <?php
            do_action( 'woocommerce_before_mini_cart_contents' );

            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                    $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                    $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                    ?>
                    <li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
                        <?php
                        echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                            '<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                            __( 'Remove this item', 'themerex_theme' ),
                            esc_attr( $product_id ),
                            esc_attr( $cart_item_key ),
                            esc_attr( $_product->get_sku() )
                        ), $cart_item_key );
                        ?>
                        <?php if ( empty( $product_permalink ) ) : ?>
                            <?php echo $thumbnail . $product_name . '&nbsp;'; ?>
                        <?php else : ?>
                            <a href="<?php echo esc_url( $product_permalink ); ?>">
                                <?php echo $thumbnail . $product_name . '&nbsp;'; ?>
                            </a>
                        <?php endif; ?>
                        <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>

                        <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
                    </li>
                    <?php
                }
            }

            do_action( 'woocommerce_mini_cart_contents' );
        ?>
    </ul>

    <p class="woocommerce-mini-cart__total total"><strong><?php _e( 'Subtotal', 'themerex_theme' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

    <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

    <p class="woocommerce-mini-cart__buttons buttons"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>

<?php else : ?>

    <p class="woocommerce-mini-cart__empty-message"><?php _e( 'No products in the cart.', 'themerex_theme' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>

                        <div class="clear"></div>
                    </div>
                </div>
            <?php else: ?>
                <script type="text/javascript">
                    jQuery(function($){
                        $('#<?php echo $this->id ?>').hide();
                    });
                </script>
            <?php endif; ?>
        </div>
        <?php
        echo $after_widget;

    }


    /**
     * update function.
     *
     * @see WP_Widget->update
     * @access public
     * @param array $new_instance
     * @param array $old_instance
     * @return array
     */
    function update( $new_instance, $old_instance ) {
        $instance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
        $instance['hide_if_empty'] = empty( $new_instance['hide_if_empty'] ) ? 0 : 1;
        $instance['show_on_checkout'] = empty( $new_instance['show_on_checkout'] ) ? 0 : 1;
        $instance['popup_align'] = $new_instance['popup_align'];
        return $instance;
    }


    /**
     * form function.
     *
     * @see WP_Widget->form
     * @access public
     * @param array $instance
     * @return void
     */
    function form( $instance ) {

        $instance = wp_parse_args($instance, $this->default_values);

        $hide_if_empty = empty( $instance['hide_if_empty'] ) ? 0 : 1;
        $show_on_checkout = empty( $instance['show_on_checkout'] ) ? 0 : 1;
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'themerex_theme') ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>

        <p><input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('hide_if_empty') ); ?>" name="<?php echo esc_attr( $this->get_field_name('hide_if_empty') ); ?>"<?php checked( $hide_if_empty ); ?> />
            <label for="<?php echo $this->get_field_id('hide_if_empty'); ?>"><?php _e( 'Hide if cart is empty', 'themerex_theme' ); ?></label></p>

        <p><input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_on_checkout') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_on_checkout') ); ?>"<?php checked( $show_on_checkout ); ?> />
            <label for="<?php echo $this->get_field_id('show_on_checkout'); ?>"><?php _e( 'Show this widget on cart/checkout pages', 'themerex_theme' ); ?></label></p>
        <p>
            <label for="<?php echo $this->get_field_id('popup_align') ?>"><?php _e('Popup align:', 'themerex_theme') ?></label>
            <select name="<?php echo $this->get_field_name('popup_align') ?>" id="<?php echo $this->get_field_id('popup_align') ?>" class="widefat">
                <option value="left" <?php selected('left', $instance['popup_align']) ?>><?php _e('Left', 'themerex_theme') ?></option>
                <option value="right" <?php selected('right', $instance['popup_align']) ?>><?php _e('Right', 'themerex_theme') ?></option>
            </select>
        </p>
    <?php
    }
}

function register_WooCommerce_Widget_DropdownCart() {
    if(class_exists('Woocommerce')) {
        register_widget('WooCommerce_Widget_DropdownCart');
    }
}add_action( 'widgets_init', 'register_WooCommerce_Widget_DropdownCart' );