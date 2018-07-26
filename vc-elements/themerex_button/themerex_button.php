<?php
/*
Element Button
*/

// Element Class 
class vcThemeRexButton extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_themerex_button_mapping' ) );
        add_shortcode( 'vc_themerex_button', array( $this, 'vc_themerex_button_html' ) );
    }

    // Element Mapping
    public function vc_themerex_button_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Themerex Button', 'themerex'),
                'base' => 'vc_themerex_button',
                'description' => __('Button for Themerex', 'themerex'), 
                'category' => __('Themerex components', 'themerex'),   
                'icon' => get_template_directory_uri().'/img/button.svg',            
                'params' => array(   

                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Button Name', 'themerex' ),
                        'param_name' => 'btn_text',
                        'value' => __( '#', 'themerex' ),
                    ),       
                    array(
                        'type' => 'vc_link',
                        'heading' => __( 'Button Link', 'themerex' ),
                        'param_name' => 'btn_link',
                        'value' => __( 'Button', 'themerex' ),
                    ), 
                    array(
                      "type" => "colorpicker",
                      "heading" => __( "Button Background", "themerex" ),
                      "param_name" => "btn_bgc",
                      "value" => '', 
                  ),
                    array(
                      "type" => "colorpicker",
                      "heading" => __( "Button Color", "themerex" ),
                      "param_name" => "btn_color",
                      "value" => '', 
                  ),
                    array(
                      "type" => "colorpicker",
                      "heading" => __( "Button Background Hover", "themerex" ),
                      "param_name" => "btn_bgc_h",
                      "value" => '', 
                  ),
                    array(
                      "type" => "colorpicker",
                      "heading" => __( "Button Color Hover", "themerex" ),
                      "param_name" => "btn_color_h",
                      "value" => '', 
                  ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Font Size', 'themerex' ),
                        'param_name' => 'btn_fz',
                        "description" => __( "Enter font size. Use px,em,%. For example 10px.", "themerex" ),
                        "value" => '', 
                    ), 
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Text Transform', 'themerex' ),
                        'param_name' => 'btn_trf',
                        'value' => array(
                            __( 'Default',  "themerex"  ) => 'initial',
                            __( 'Uppercase',  "themerex"  ) => 'uppercase',
                            __( 'Lowercase',  "themerex"  ) => 'Lowercase',
                            __( 'Capitalize',  "themerex"  ) => 'Capitalize',
                        ),
                    ),   
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Button Align', 'themerex' ),
                        'param_name' => 'btn_alg',
                        'value' => array(
                            __( 'Left',  "themerex"  ) => 'left',
                            __( 'Right',  "themerex"  ) => 'right',
                            __( 'Center',  "themerex"  ) => 'center',
                        ),
                    ),        
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Padding Top|Bottom', 'themerex' ),
                        'param_name' => 'btn_padding_tb',
                        "description" => __( "Enter top and bottom padding. Use px,em,%. For example 10px.", "themerex" ),
                        "value" => '', 
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Padding Left|Right', 'themerex' ),
                        'param_name' => 'btn_padding_lr',
                        "description" => __( "Enter left and right padding. Use px,em,%. For example 10px.", "themerex" ),
                        "value" => '', 
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => __( 'Two or many button in one row', 'themerex' ),
                        'param_name' => 'btn_many',
                        "description" => __( "If you use this option, then click on the checkbox and on the other buttons in the row", "themerex" ),
                        "value" => '', 
                    ),                                              
                ),
            )
);                                

}


    // Element HTML
public function vc_themerex_button_html( $atts ) {

        // Params extraction
    extract(
        shortcode_atts(
            array(
                'btn_text' => '',
                'btn_link'   => '',
                'btn_bgc'   => '',
                'btn_bgc_h'   => '',
                'btn_color'   => '',
                'btn_color_h'   => '',
                'btn_fz'   => '',
                'btn_padding_tb'   => '',
                'btn_padding_lr'   => '',
                'btn_trf'   => '',
                'btn_alg'   => '',
                'btn_many'   => '',
            ), 
            $atts
        )
    );

    $btn_link = ($btn_link=='||') ? '' : $btn_link;
    $btn_link = vc_build_link( $btn_link );
    $a_link = $btn_link['url'];
    $a_title = $btn_link['title'];
    $a_target = $btn_link['target'];

    $id_button = mt_rand();

    if($btn_many==true){
        $btn_many_position = 'inline-block';
    }else{
        $btn_many_position = 'block';
    }

        // Fill $html var with data
    $html = '

    <div class="vc_themerex_button-wrap" style="text-align:'.$btn_alg.'; display:'.$btn_many_position.';">
    <style>
        #vc_themerex_button_'.$id_button.'{
            background-color:'.$btn_bgc.'; 
            color:'.$btn_color.';
            font-size:'.$btn_fz.';
            padding:'.$btn_padding_tb.' '.$btn_padding_lr.';
            text-transform:'.$btn_trf.';
            }
        #vc_themerex_button_'.$id_button.':hover{
            background-color:'.$btn_bgc_h.'; 
            color:'.$btn_color_h.';
        }
    </style>
<a class="vc_themerex_button" id="vc_themerex_button_'.$id_button.'" href="'.$a_link.'" title="'.$a_title.'" target="'.$a_target.'" style="" >' . $btn_text . '</a>

</div>';      

return $html;

}

} // End Element Class


// Element Class Init
new vcThemeRexButton(); 