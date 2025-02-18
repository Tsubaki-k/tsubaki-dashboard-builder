<?php
/**
 * Pill field callback function.
 *
 * WordPress has magic interaction with the following keys: label_for, class.
 * - The "label_for" key value is used for the "for" attribute of the <label>.
 * - The "class" key value is used for the "class" attribute of the <tr> containing the field.
 * Note: you can add custom key-value pairs to be used inside your callbacks.
 *
 * @param array $args
 */
function tsubaki_field_tabs_cb( $args )
{
    // Get the value of the setting we've registered with register_setting()
    $get_raw_options = get_option('tsubaki_options');
    $options =  $get_raw_options ? $get_raw_options[1] : [];

//    wp_die(var_dump($options));

//    wp_die( var_dump( $options ) );

    $pages_list = [];
    foreach( get_pages() as $page ) {
        $pages_list[] = [
            'id'    => $page->ID,
            'title' => esc_html($page->post_title),
        ];
    }


    ?>
    <div class="wrapper flex flex-wrap" >
        <?php
        if( $options ) {
            foreach( $options as $name => $option ) {

//                wp_die(var_dump($name, $option));
//                foreach( $option as $key => $value ) {
//                    wp_die( var_dump($key, $value) );
//                }
                $label   = $option[ 'label' ];
                $icon    = $option[ 'icon' ];
                $link    = $option[ 'link' ];
                $page_id = $option[ 'page_id' ];
                ?>
                <div id="tab-<?php echo $name; ?>" class="tabs-data-container" >
                    <div class="tabs-field-container" ><label >Title</label >
                        <input name="tsubaki_options[<?php echo $name; ?>][label]" data-type="label"
                               value="<?php echo esc_attr($label); ?>"
                               type="text" class="tab-name" size="50" placeholder="Tab's title..." required >
                    </div >
                    <div class="tabs-field-container" ><label for="" >Icon (URL)</label >
                        <input name="tsubaki_options[<?php echo $name; ?>][icon]" data-type="icon"
                               value="<?php echo esc_attr($icon); ?>"
                               type="text" class="tab-icon" placeholder="https:// ..." required >
                    </div >
                    <div class="tabs-field-container" ><label for="" >Slug</label >
                        <input name="tsubaki_options[<?php echo $name; ?>][link]" data-type="link"
                               value="<?php echo esc_attr($link); ?>"
                               type="text" class="tab-link" size="50" placeholder="the-slug..." >
                    </div >
                    <div class="tabs-field-container" ><label for="" >Select Page</label >
                        <select name="tsubaki_options[<?php echo $name; ?>][page_id]" data-type="page_id" class="tab-page_id" >
                            <option value="" >-- Select a Page --</option >
                            <?php
                            foreach( $pages_list as $page ) {
                                $selected = ( $page_id == $page[ 'id' ] ? 'selected' : '' );
                                echo '<option value="' . $page[ 'id' ] . '" ' . $selected . '>' . $page[ 'title' ] . '</option>';
                            }
                            ?>
                        </select >
                    </div >
                    <button onclick="deleteTabField(this)" class="delete-tabs-container" type="button" >❌</button >
                </div >
                <?php
            }
        }
        ?>

        <div id="elem1" class="hidden tabs-data-container" >
            <div id="clone1" class="tabs-field-container" ><label >label</label >
                <input name="tsubaki_options[" data-type="label"
                       value=""
                       type="text" class="tab-name tabs-field-input" size="50" placeholder="Tab's title..." >
            </div >
            <div id="clone1" class="tabs-field-container" ><label for="" >Icon (URL)</label >
                <input name="tsubaki_options[" data-type="icon"
                       value=""
                       type="text" class="tab-icon tabs-field-input" size="50" placeholder="https:// ..." >
            </div >
            <div id="clone1" class="tabs-field-container" ><label for="" >Slug</label >
                <input name="tsubaki_options[" data-type="link"
                       value=""
                       type="text" class="tab-link tabs-field-input" size="50" placeholder="the-slug..." >
            </div >
            <div id="clone1" class="tabs-field-container" ><label for="" >Select Page</label >
<!--                <input name="tsubaki_options[" data-type="page_id"-->
<!--                       value=""-->
<!--                       type="text" class="tab-page_id tabs-field-input" size="50" placeholder="[page_id]" >-->

                <select name="tsubaki_options[" data-type="page_id" class="tab-page_id tabs-field-input" >

                    <option value="" >-- Select a Page --</option >
                    <?php
                    foreach( $pages_list as $page ) {
                        echo '<option value="' . $page[ 'id' ] . '" >' . $page[ 'title' ] . '</option>';
                    }
                    ?>

                </select >

            </div >
            <button onclick="deleteTabField(this)" class="delete-tabs-container" type="button" >❌</button >

        </div >


        <div class="controls flex block w-full" >
            <button type="button" id="add_more_fields" class="btn" >
                ➕ Add New Tab
            </button >
        </div >
    </div >
    <?php
}

function tsubaki_validate_options( $input )
{

//    wp_die( var_dump( $input ) );
    return [ 1 => $input ]; // Return the sanitized input
}