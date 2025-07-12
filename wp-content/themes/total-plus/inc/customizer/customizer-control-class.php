<?php
/**
 *
 * @package Total Plus
 */
if (class_exists('WP_Customize_Control')) {

    class Total_Plus_Repeater_Controler extends WP_Customize_Control {

        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'repeater';
        public $box_label = '';
        public $add_label = '';
        private $cats = '';

        /**
         * The fields that each container row will contain.
         *
         * @access public
         * @var array
         */
        public $fields = array();

        /**
         * Repeater drag and drop controller
         *
         * @since  1.0.0
         */
        public function __construct($manager, $id, $args = array(), $fields = array()) {
            $this->fields = $fields;
            $this->box_label = $args['box_label'];
            $this->add_label = $args['add_label'];
            $this->cats = get_categories(array('hide_empty' => false));
            parent::__construct($manager, $id, $args);
        }

        public function render_content() {
            ?>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>

            <?php if ($this->description) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php } ?>

            <ul class="total-plus-repeater-field-control-wrap">
                <?php
                $this->total_plus_get_fields();
                ?>
            </ul>

            <input type="hidden" <?php esc_attr($this->link()); ?> class="total-plus-repeater-collector" value="<?php echo esc_attr($this->value()); ?>" />
            <button type="button" class="button total-plus-add-control-field"><?php echo esc_html($this->add_label); ?></button>
            <?php
        }

        private function total_plus_get_fields() {
            $fields = $this->fields;
            $values = json_decode($this->value());

            if (is_array($values)) {
                foreach ($values as $value) {
                    ?>
                    <li class="total-plus-repeater-field-control">
                        <h3 class="total-plus-repeater-field-title"><?php echo esc_html($this->box_label); ?></h3>

                        <div class="total-plus-repeater-fields">
                            <?php
                            foreach ($fields as $key => $field) {
                                $class = isset($field['class']) ? $field['class'] : '';
                                ?>
                                <div class="total-plus-fields total-plus-type-<?php echo esc_attr($field['type']) . ' ' . esc_attr($class); ?>">

                                    <?php
                                    $label = isset($field['label']) ? $field['label'] : '';
                                    $description = isset($field['description']) ? $field['description'] : '';
                                    if ($field['type'] != 'checkbox') {
                                        ?>
                                        <span class="customize-control-repeater-title"><?php echo esc_html($label); ?></span>
                                        <span class="description customize-control-description"><?php echo esc_html($description); ?></span>
                                        <?php
                                    }

                                    $new_value = isset($value->$key) ? $value->$key : '';
                                    $default = isset($field['default']) ? $field['default'] : '';

                                    switch ($field['type']) {
                                        case 'text':
                                            echo '<input data-default="' . esc_attr($default) . '" data-name="' . esc_attr($key) . '" type="text" value="' . esc_attr($new_value) . '"/>';
                                            break;

                                        case 'textarea':
                                            echo '<textarea data-default="' . esc_attr($default) . '"  data-name="' . esc_attr($key) . '">' . esc_textarea($new_value) . '</textarea>';
                                            break;

                                        case 'upload':
                                            $image = $image_class = "";
                                            if ($new_value) {
                                                $image = '<img src="' . esc_url($new_value) . '" style="max-width:100%;"/>';
                                                $image_class = ' hidden';
                                            }
                                            echo '<div class="total-plus-fields-wrap">';
                                            echo '<div class="attachment-media-view">';
                                            echo '<div class="placeholder' . esc_attr($image_class) . '">';
                                            esc_html_e('No image selected', 'total-plus');
                                            echo '</div>';
                                            echo '<div class="thumbnail thumbnail-image">';
                                            echo $image;
                                            echo '</div>';
                                            echo '<div class="actions clearfix">';
                                            echo '<button type="button" class="button total-plus-delete-button align-left">' . esc_html__('Remove', 'total-plus') . '</button>';
                                            echo '<button type="button" class="button total-plus-upload-button alignright">' . esc_html__('Select Image', 'total-plus') . '</button>';
                                            echo '<input data-default="' . esc_attr($default) . '" class="upload-id" data-name="' . esc_attr($key) . '" type="hidden" value="' . esc_attr($new_value) . '"/>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            break;

                                        case 'category':
                                            echo '<select data-default="' . esc_attr($default) . '"  data-name="' . esc_attr($key) . '">';
                                            echo '<option value="0">' . esc_html__('Select Category', 'total-plus') . '</option>';
                                            echo '<option value="-1">' . esc_html__('Latest Posts', 'total-plus') . '</option>';
                                            foreach ($this->cats as $cat) {
                                                printf('<option value="%1$s" %2$s>%3$s</option>', esc_attr($cat->term_id), selected($new_value, $cat->term_id, false), esc_html($cat->name));
                                            }
                                            echo '</select>';
                                            break;

                                        case 'select':
                                            $options = $field['options'];
                                            echo '<select  data-default="' . esc_attr($default) . '"  data-name="' . esc_attr($key) . '">';
                                            foreach ($options as $option => $val) {
                                                printf('<option value="%1$s" %2$s>%3$s</option>', esc_attr($option), selected($new_value, $option, false), esc_html($val));
                                            }
                                            echo '</select>';
                                            break;

                                        case 'checkbox':
                                            echo '<label>';
                                            echo '<input data-default="' . esc_attr($default) . '" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '" type="checkbox" ' . checked($new_value, 'yes', false) . '/>';
                                            echo esc_html($label);
                                            echo '<span class="description customize-control-description">' . esc_html($description) . '</span>';
                                            echo '</label>';
                                            break;

                                        case 'colorpicker':
                                            echo '<input data-default="' . esc_attr($default) . '" class="total-plus-color-picker" data-alpha-color-type="hex" data-alpha-enabled="true" data-name="' . esc_attr($key) . '" type="text" value="' . esc_attr($new_value) . '"/>';
                                            break;

                                        case 'selector':
                                            $options = $field['options'];
                                            echo '<div class="selector-labels">';
                                            foreach ($options as $option => $val) {
                                                $class = ( $new_value == $option ) ? 'selector-selected' : '';
                                                echo '<label class="' . $class . '" data-val="' . esc_attr($option) . '">';
                                                echo '<img src="' . esc_url($val) . '"/>';
                                                echo '</label>';
                                            }
                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;

                                        case 'radio':
                                            $options = $field['options'];
                                            echo '<div class="radio-labels">';
                                            foreach ($options as $option => $val) {
                                                echo '<label>';
                                                echo '<input value="' . esc_attr($option) . '" type="radio" ' . checked($new_value, $option, false) . '/>';
                                                echo esc_html($val);
                                                echo '</label>';
                                            }
                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;

                                        case 'switch':
                                            $switch = $field['switch'];
                                            $switch_class = ($new_value == 'on') ? 'switch-on' : '';
                                            echo '<div class="onoffswitch ' . esc_attr($switch_class) . '">';
                                            echo '<div class="onoffswitch-inner">';
                                            echo '<div class="onoffswitch-active">';
                                            echo '<div class="onoffswitch-switch">' . esc_html($switch["on"]) . '</div>';
                                            echo '</div>';
                                            echo '<div class="onoffswitch-inactive">';
                                            echo '<div class="onoffswitch-switch">' . esc_html($switch["off"]) . '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;

                                        case 'range':
                                            $options = $field['options'];
                                            $new_value = $new_value ? $new_value : $options['val'];
                                            echo '<div class="total-plus-range-slider" >';
                                            echo '<div class="range-input" data-defaultvalue="' . esc_attr($options['val']) . '" data-value="' . esc_attr($new_value) . '" data-min="' . esc_attr($options['min']) . '" data-max="' . esc_attr($options['max']) . '" data-step="' . esc_attr($options['step']) . '"></div>';
                                            echo '<input  class="range-input-selector" type="text" disabled="disabled" value="' . esc_attr($new_value) . '"  data-name="' . esc_attr($key) . '"/>';
                                            echo '<span class="unit">' . esc_html($options['unit']) . '</span>';
                                            echo '</div>';
                                            break;

                                        case 'icon':
                                            echo '<div class="total-plus-customizer-icon-box total-plus-icon-box-wrap">';
                                            echo '<div class="total-plus-selected-icon">';
                                            echo '<i class="' . esc_attr($new_value) . '"></i>';
                                            echo '<span><i class="icofont-simple-down"></i></span>';
                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            echo '</div>';
                                            break;

                                        case 'multicategory':
                                            $new_value_array = !is_array($new_value) ? explode(',', $new_value) : $new_value;
                                            echo '<ul class="total-plus-multi-category-list">';
                                            echo '<li><label><input type="checkbox" value="-1" ' . checked('-1', $new_value, false) . '/>' . esc_html__('Latest Posts', 'total-plus') . '</label></li>';
                                            foreach ($this->cats as $cat) {
                                                $checked = in_array($cat->term_id, $new_value_array) ? 'checked="checked"' : '';
                                                echo '<li>';
                                                echo '<label>';
                                                echo '<input type="checkbox" value="' . esc_attr($cat->term_id) . '" ' . $checked . '/>';
                                                echo esc_html($cat->name);
                                                echo '</label>';
                                                echo '</li>';
                                            }
                                            echo '</ul>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr(implode(',', $new_value_array)) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;

                                        default:
                                            break;
                                    }
                                    ?>
                                </div>
                            <?php }
                            ?>

                            <div class="clearfix total-plus-repeater-footer">
                                <div class="alignright">
                                    <a class="total-plus-repeater-field-remove" href="#remove"><?php esc_html_e('Delete', 'total-plus') ?></a> |
                                    <a class="total-plus-repeater-field-close" href="#close"><?php esc_html_e('Close', 'total-plus') ?></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
            }
        }

    }

    class Total_Plus_Dropdown_Chooser extends WP_Customize_Control {

        public $type = 'dropdown_chooser';

        public function render_content() {
            if (empty($this->choices)) {
                return;
            }
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if ($this->description) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>

                <select class="hs-chosen-select" <?php $this->link(); ?>>
                    <?php
                    foreach ($this->choices as $value => $label) {
                        echo '<option value="' . esc_attr($value) . '"' . selected($this->value(), $value, false) . '>' . esc_html($label) . '</option>';
                    }
                    ?>
                </select>
            </label>
            <?php
        }

    }

    class Total_Plus_Fontawesome_Icon_Chooser extends WP_Customize_Control {

        public $type = 'icon';
        public $icon_array = array();

        public function __construct($manager, $id, $args = array()) {
            if (isset($args['icon_array'])) {
                $this->icon_array = $args['icon_array'];
            }
            parent::__construct($manager, $id, $args);
        }

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if ($this->description) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>
                <div class="total-plus-customizer-icon-box total-plus-icon-box-wrap">
                    <div class="total-plus-selected-icon">
                        <i class="<?php echo esc_attr($this->value()); ?>"></i>
                        <span><i class="icofont-simple-down"></i></span>
                    </div>

                    <div class="total-plus-icon-box">
                        <div class="total-plus-icon-search">
                            <input type="text" class="total-plus-icon-search-input" placeholder="<?php echo esc_html__('Type to filter', 'total-plus'); ?>" />
                        </div>

                        <ul class="total-plus-icon-list clearfix active">
                            <?php
                            if (isset($this->icon_array) && !empty($this->icon_array)) {
                                $total_plus_font_awesome_icon_array = $this->icon_array;
                            } else {
                                $total_plus_font_awesome_icon_array = total_plus_font_awesome_icon_array();
                            }

                            foreach ($total_plus_font_awesome_icon_array as $total_plus_font_awesome_icon) {
                                $icon_class = $this->value() == $total_plus_font_awesome_icon ? 'icon-active' : '';
                                echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($total_plus_font_awesome_icon) . '"></i></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <input type="hidden" value="<?php esc_attr($this->value()); ?>" <?php $this->link(); ?> />
                </div>
            </label>
            <?php
        }

    }

    class Total_Plus_Display_Gallery_Control extends WP_Customize_Control {

        public $type = 'gallery';

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if ($this->description) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>

                <div class="gallery-screenshot clearfix">
                    <?php
                    $value = $this->value();
                    if ($value) {
                        $ids = explode(',', $value);
                        foreach ($ids as $attachment_id) {
                            $img = wp_get_attachment_image_src($attachment_id, 'total-plus-100x100');
                            echo '<div class="screen-thumb"><img src="' . esc_url($img[0]) . '" /></div>';
                        }
                    }
                    ?>
                </div>

                <input id="edit-gallery" class="button upload_gallery_button" type="button" value="<?php esc_html_e('Add/Edit Gallery', 'total-plus') ?>" />
                <input id="clear-gallery" class="button upload_gallery_button" type="button" value="<?php esc_html_e('Clear', 'total-plus') ?>" />
                <input type="hidden" class="gallery_values" <?php echo $this->link() ?> value="<?php echo esc_attr($this->value()); ?>">
            </label>
            <?php
        }

    }

    class Total_Plus_Customize_Checkbox_Multiple extends WP_Customize_Control {

        public $type = 'checkbox-multiple';

        public function render_content() {

            if (empty($this->choices)) {
                return;
            }
            ?>

            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
            </span>

            <?php if ($this->description) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php } ?>

            <?php $multi_values = !is_array($this->value()) ? explode(',', $this->value()) : $this->value(); ?>

            <ul>
                <?php foreach ($this->choices as $value => $label) : ?>

                    <li>
                        <label>
                            <input type="checkbox" value="<?php echo esc_attr($value); ?>" <?php checked(in_array($value, $multi_values)); ?> />
                            <?php echo esc_html($label); ?>
                        </label>
                    </li>

                <?php endforeach; ?>
            </ul>

            <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr(implode(',', $multi_values)); ?>" />
            <?php
        }

    }

    class Total_Plus_Customize_Heading extends WP_Customize_Control {

        public $type = 'heading';

        public function render_content() {
            if (!empty($this->label)) :
                ?>
                <h3 class="total-plus-accordion-section-title"><?php echo esc_html($this->label); ?></h3>
                <?php
            endif;

            if ($this->description) {
                ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
                <?php
            }
        }

    }

    class Total_Plus_Dropdown_Multiple_Chooser extends WP_Customize_Control {

        public $type = 'dropdown_multiple_chooser';
        public $placeholder = '';

        public function __construct($manager, $id, $args = array()) {
            $this->placeholder = $args['placeholder'];

            parent::__construct($manager, $id, $args);
        }

        public function render_content() {
            if (empty($this->choices)) {
                return;
            }
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if ($this->description) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php }
                ?>

                <select data-placeholder="<?php echo esc_attr($this->placeholder); ?>" multiple="multiple" class="hs-chosen-select" <?php $this->link(); ?>>
                    <?php
                    foreach ($this->choices as $value => $label) {
                        $selected = '';
                        if (in_array($value, $this->value())) {
                            $selected = 'selected="selected"';
                        }
                        echo '<option value="' . esc_attr($value) . '"' . $selected . '>' . esc_html($label) . '</option>';
                    }
                    ?>
                </select>
            </label>
            <?php
        }

    }

    class Total_Plus_Category_Dropdown extends WP_Customize_Control {

        private $cats = false;

        public function __construct($manager, $id, $args = array(), $options = array()) {
            $this->cats = get_categories($options);

            parent::__construct($manager, $id, $args);
        }

        public function render_content() {
            if (!empty($this->cats)) {
                ?>
                <label>
                    <span class="customize-control-title">
                        <?php echo esc_html($this->label); ?>
                    </span>

                    <?php if ($this->description) { ?>
                        <span class="description customize-control-description">
                            <?php echo wp_kses_post($this->description); ?>
                        </span>
                    <?php } ?>

                    <select <?php $this->link(); ?>>
                        <?php
                        foreach ($this->cats as $cat) {
                            printf('<option value="%1$s" %2$s>%3$s</option>', esc_attr($cat->term_id), selected($this->value(), $cat->term_id, false), esc_html($cat->name));
                        }
                        ?>
                    </select>
                </label>
                <?php
            }
        }

    }

    class Total_Plus_Image_Select extends WP_Customize_Control {

        public $type = 'select';

        public function __construct($manager, $id, $args = array(), $choices = array()) {
            $this->image_path = $args['image_path'];
            $this->choices = $args['choices'];
            parent::__construct($manager, $id, $args);
        }

        public function render_content() {
            if (!empty($this->choices)) {
                ?>
                <label>
                    <span class="customize-control-title">
                        <?php echo esc_html($this->label); ?>
                    </span>

                    <?php if ($this->description) { ?>
                        <span class="description customize-control-description">
                            <?php echo wp_kses_post($this->description); ?>
                        </span>
                    <?php } ?>

                    <select class="select-image-control" <?php $this->link(); ?>>
                        <?php
                        foreach ($this->choices as $key => $choice) {
                            printf('<option data-image="%1$s" value="%2$s" %3$s>%4$s</option>', esc_attr($this->image_path . $key) . '.png', esc_attr($key), selected($this->value(), $key, false), esc_html($choice));
                        }
                        ?>
                    </select>

                    <div class="select-image-wrap"><img src="<?php echo $this->image_path . $this->value(); ?>.png"/></div>
                </label>
                <?php
            }
        }

    }

    class Total_Plus_Switch_Control extends WP_Customize_Control {

        public $type = 'switch';
        public $on_off_label = array();
        public $class;

        public function __construct($manager, $id, $args = array()) {
            $this->on_off_label = $args['on_off_label'];
            $this->class = isset($args['class']) ? $args['class'] : '';
            parent::__construct($manager, $id, $args);
        }

        public function render_content() {
            $switch_class = ($this->value() == 'on') ? 'switch-on ' : '';
            $switch_class .= $this->class;
            $on_off_label = $this->on_off_label;
            ?>
            <div class="onoffswitch <?php echo esc_attr($switch_class); ?>">
                <div class="onoffswitch-inner">
                    <div class="onoffswitch-active">
                        <div class="onoffswitch-switch"><?php echo esc_html($on_off_label['on']) ?></div>
                    </div>

                    <div class="onoffswitch-inactive">
                        <div class="onoffswitch-switch"><?php echo esc_html($on_off_label['off']) ?></div>
                    </div>
                </div>
            </div>
            <input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr($this->value()); ?>"/>
            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
            </span>

            <?php if ($this->description) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php } ?>
            <?php
        }

    }

    class Total_Plus_Info_Text extends WP_Customize_Control {

        public function render_content() {
            ?>
            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
            </span>

            <?php if ($this->description) { ?>
                <span class="customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
                <?php
            }
        }

    }

    class Total_Plus_Selector extends WP_Customize_Control {

        public $type = 'selector';
        public $options = array();
        public $class = '';

        public function __construct($manager, $id, $args = array()) {
            $this->options = $args['options'];
            $this->class = isset($args['class']) ? $args['class'] : '';
            parent::__construct($manager, $id, $args);
        }

        public function render_content() {
            $options = $this->options;
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if (!empty($this->description)) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>

                <div class="selector-labels <?php echo esc_attr($this->class) ?>">
                    <?php
                    foreach ($options as $key => $image) {
                        $class = ( $this->value() == $key ) ? 'selector-selected' : '';
                        echo '<label class="' . esc_attr($class) . '" data-val="' . esc_attr($key) . '">';
                        echo '<img src="' . esc_url($image) . '"/>';
                        echo '</label>';
                    }
                    ?>
                </div>
                <input type="hidden" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />

            </label>
            <?php
        }

    }

    class Total_Plus_Alpha_Color_Control extends WP_Customize_Control {

        /**
         * Official control name.
         */
        public $type = 'alpha-color';

        /**
         * Add support for palettes to be passed in.
         *
         * Supported palette values are true, false, or an array of RGBa and Hex colors.
         */
        public $palette;

        /**
         * Add support for showing the opacity value on the slider handle.
         */
        public $show_opacity;

        /**
         * Render the control.
         */
        public function render_content() {

            // Process the palette
            if (is_array($this->palette)) {
                $palette = implode('|', $this->palette);
            } else {
                // Default to true.
                $palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
            }

            // Support passing show_opacity as string or boolean. Default to true.
            $show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';

            // Begin the output. 
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if (!empty($this->description)) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>
            </label>
            <input class="alpha-color-control" data-alpha-color-type="hex" data-alpha-enabled="<?php echo esc_attr($show_opacity); ?>" type="text" data-palette="<?php echo esc_attr($palette); ?>" data-default-color="<?php echo esc_attr($this->settings['default']->default); ?>" <?php $this->link(); ?>  />
            <?php
        }

    }

    class Total_Plus_Checkbox_Control extends WP_Customize_Control {

        /**
         * Control type
         *
         * @var string
         */
        public $type = 'checkbox-toggle';

        /**
         * Control method
         *
         * @since 1.0.0
         */
        public function render_content() {
            ?>
            <div class="total-plus-checkbox-toggle">
                <div class="onoff-switch">
                    <input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="onoff-switch-checkbox" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> <?php checked($this->value()); ?>>
                    <label class="onoff-switch-label" for="<?php echo esc_attr($this->id); ?>"></label>
                </div>
                <span class="customize-control-title onoff-switch-title"><?php echo esc_html($this->label); ?></span>
                <?php if (!empty($this->description)) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>
            </div>
            <?php
        }

    }

    class Total_Plus_Separator_Control extends WP_Customize_Control {

        /**
         * Control type
         *
         * @var string
         */
        public $type = 'separator';

        /**
         * Control method
         *
         * @since 1.0.0
         */
        public function render_content() {
            ?>
            <p><span></span></p>
            <?php
        }

    }

    class Total_Plus_Page_Editor extends WP_Customize_Control {

        /**
         * Flag to do action admin_print_footer_scripts.
         * This needs to be true only for one instance.
         *
         * @var bool|mixed
         */
        private $include_admin_print_footer = false;

        /**
         * Flag to load teeny.
         *
         * @var bool|mixed
         */
        private $teeny = false;

        /**
         * Total_Page_Editor constructor.
         *
         * @param WP_Customize_Manager $manager Manager.
         * @param string               $id Id.
         * @param array                $args Constructor args.
         */
        public function __construct($manager, $id, $args = array()) {
            parent::__construct($manager, $id, $args);

            if (!empty($args['include_admin_print_footer'])) {
                $this->include_admin_print_footer = $args['include_admin_print_footer'];
            }

            if (!empty($args['teeny'])) {
                $this->teeny = $args['teeny'];
            }
        }

        /**
         * Render the content on the theme customizer page
         */
        public function render_content() {
            ?>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>

            <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea($this->value()); ?>">
            <?php
            $settings = array(
                'textarea_name' => $this->id,
                'teeny' => $this->teeny,
                'textarea_rows' => 6
            );

            $page_content = $this->value();

            wp_editor($page_content, $this->id, $settings);

            if ($this->include_admin_print_footer === true) {
                do_action('admin_print_footer_scripts');
            }
        }

    }

    class Total_Plus_Gradient_Control extends WP_Customize_Control {

        public $type = 'gradient';
        public $params = array();

        public function __construct($manager, $id, $args = array()) {
            if (isset($args['params'])) {
                $this->params = $args['params'];
            }
            parent::__construct($manager, $id, $args);
        }

        public function enqueue() {
            wp_enqueue_script('color-picker', get_template_directory_uri() . '/inc/customizer/js/colorpicker.js', array('jquery'), TOTAL_PLUS_VERSION, true);
            wp_enqueue_script('jquery-classygradient', get_template_directory_uri() . '/inc/customizer/js/jquery.classygradient.js', array('jquery'), TOTAL_PLUS_VERSION, true);
            wp_enqueue_script('custom-gradient', get_template_directory_uri() . '/inc/customizer/js/custom-gradient.js', array('jquery', 'jquery-ui-slider'), TOTAL_PLUS_VERSION, true);

            wp_enqueue_style('color-picker', get_template_directory_uri() . '/inc/customizer/css/colorpicker.css', array(), TOTAL_PLUS_VERSION);
            wp_enqueue_style('jquery-classygradient', get_template_directory_uri() . '/inc/customizer/css/jquery.classygradient.css', array(), TOTAL_PLUS_VERSION);
        }

        public function render_content() {

            if (!empty($this->label)) :
                ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php
            endif;

            if (!empty($this->description)) :
                ?>
                <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                <?php
            endif;

            $type = $this->type;
            $params = $this->params;
            $class = isset($params['class']) ? $params['class'] : '';
            $default_color = isset($params['default_color']) ? $params['default_color'] : '0% #0051FF, 100% #00C5FF';
            $picker_label = isset($params['picker_label']) ? $params['picker_label'] : esc_html__("Define Gradient Colors", "total-plus");
            $picker_description = isset($params['picker_description']) ? $params['picker_description'] : esc_html__("For a gradient, at least one starting and one end color should be defined.", "total-plus");
            $angle_label = isset($params['angle_label']) ? $params['angle_label'] : esc_html__("Define Gradient Direction", "total-plus");
            $preview_label = isset($params['preview_label']) ? $params['preview_label'] : esc_html__("Gradient Preview", "total-plus");


            $html = '<div class="gradient-box" data-default-color="' . esc_attr($default_color) . '">';

            // Classy Gradient Picker
            $html .= '<div class="gradient-row">';
            $html .= '<div class="gradient-label">' . esc_html($picker_label) . '</div>';
            $html .= '<div class="gradient-picker"></div>';
            $html .= '<div class="gradient-description">' . esc_html($picker_description) . '</div>';
            $html .= '</div>';

            // Gradient Linear Direction Selector
            $html .= '<div class="gradient-row">';
            $html .= '<div class="gradient-label">' . esc_html($angle_label) . '</div>';
            $html .= '<select class="gradient-direction">
				<option value="vertical">' . esc_html__('Vertical Spread (Top to Bottom)', 'total-plus') . '</option>
				<option value="horizontal">' . esc_html__('Horizontal Spread (Left To Right)', 'total-plus') . '</option>
				<option value="custom">' . esc_html__('Custom Angle Spread', 'total-plus') . '</option>
			</select>';
            $html .= '</div>';

            // Gradient Custom Angle Input
            $html .= '<div class="gradient-row">';
            $html .= '<div class="gradient-custom" style="display: none;">';
            $html .= '<div class="gradient-label">' . esc_html__('Define Custom Angle', 'total-plus') . '</div>';
            $html .= '<div class="gradient-angle-slider">';
            $html .= '<div class="gradient-range"></div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';

            // Gradient Preview Panel
            $html .= '<div class="gradient-row">';
            $html .= '<div class="gradient-label">' . esc_html($preview_label) . '</div>';
            $html .= '<div class="gradient-preview"></div>';
            $html .= '</div>';
            echo $html;
            ?>
            <input type="hidden" class="<?php echo esc_attr($type) . ' ' . esc_attr($class) ?> gradient-val"  value="<?php echo esc_attr($this->value()) ?>" <?php $this->link(); ?> />
            </div>
            <?php
        }

    }

    class Total_Plus_Background_Control extends WP_Customize_Upload_Control {

        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'background-image';

        /**
         * Mime type for upload control.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $mime_type = 'image';

        /**
         * Labels for upload control buttons.
         *
         * @since  1.0.0
         * @access public
         * @var    array
         */
        public $button_labels = array();

        /**
         * Field labels
         *
         * @since  1.0.0
         * @access public
         * @var    array
         */
        public $field_labels = array();

        /**
         * Background choices for the select fields.
         *
         * @since  1.0.0
         * @access public
         * @var    array
         */
        public $background_choices = array();

        /**
         * Constructor.
         *
         * @since 1.0.0
         * @uses WP_Customize_Upload_Control::__construct()
         *
         * @param WP_Customize_Manager $manager Customizer bootstrap instance.
         * @param string               $id      Control ID.
         * @param array                $args    Optional. Arguments to override class property defaults.
         */
        public function __construct($manager, $id, $args = array()) {

            // Calls the parent __construct
            parent::__construct($manager, $id, $args);

            // Set button labels for image uploader
            $button_labels = $this->get_button_labels();
            $this->button_labels = apply_filters('customizer_background_button_labels', $button_labels, $id);

            // Set field labels
            $field_labels = $this->get_field_labels();
            $this->field_labels = apply_filters('customizer_background_field_labels', $field_labels, $id);

            // Set background choices
            $background_choices = $this->get_background_choices();
            $this->background_choices = apply_filters('customizer_background_choices', $background_choices, $id);
        }

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {

            parent::to_json();

            $background_choices = $this->background_choices;
            $field_labels = $this->field_labels;

            // Loop through each of the settings and set up the data for it.
            foreach ($this->settings as $setting_key => $setting_id) {

                $this->json[$setting_key] = array(
                    'link' => $this->get_link($setting_key),
                    'value' => $this->value($setting_key),
                    'label' => isset($field_labels[$setting_key]) ? $field_labels[$setting_key] : ''
                );

                if ('image_url' === $setting_key) {
                    if ($this->value($setting_key)) {
                        // Get the attachment model for the existing file.
                        $attachment_id = attachment_url_to_postid($this->value($setting_key));
                        if ($attachment_id) {
                            $this->json['attachment'] = wp_prepare_attachment_for_js($attachment_id);
                        }
                    }
                } elseif ('repeat' === $setting_key) {
                    $this->json[$setting_key]['choices'] = $background_choices['repeat'];
                } elseif ('size' === $setting_key) {
                    $this->json[$setting_key]['choices'] = $background_choices['size'];
                } elseif ('position' === $setting_key) {
                    $this->json[$setting_key]['choices'] = $background_choices['position'];
                } elseif ('attach' === $setting_key) {
                    $this->json[$setting_key]['choices'] = $background_choices['attach'];
                }
            }
        }

        /**
         * Render a JS template for the content of the media control.
         *
         * @since 1.0.0
         */
        public function content_template() {

            parent::content_template();
            ?>

            <div class="background-image-fields">
                <# if ( data.attachment && data.repeat && data.repeat.choices ) { #>
                <li class="background-image-repeat">
                    <# if ( data.repeat.label ) { #>
                    <span class="customize-control-title">{{ data.repeat.label }}</span>
                    <# } #>
                    <select {{{ data.repeat.link }}}>
                        <# _.each( data.repeat.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.repeat.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
                <# } #>

                <# if ( data.attachment && data.size && data.size.choices ) { #>
                <li class="background-image-size">
                    <# if ( data.size.label ) { #>
                    <span class="customize-control-title">{{ data.size.label }}</span>
                    <# } #>
                    <select {{{ data.size.link }}}>
                        <# _.each( data.size.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.size.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
                <# } #>

                <# if ( data.attachment && data.position && data.position.choices ) { #>
                <li class="background-image-position">
                    <# if ( data.position.label ) { #>
                    <span class="customize-control-title">{{ data.position.label }}</span>
                    <# } #>
                    <select {{{ data.position.link }}}>
                        <# _.each( data.position.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.position.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
                <# } #>

                <# if ( data.attachment && data.attach && data.attach.choices ) { #>
                <li class="background-image-attach">
                    <# if ( data.attach.label ) { #>
                    <span class="customize-control-title">{{ data.attach.label }}</span>
                    <# } #>
                    <select {{{ data.attach.link }}}>
                        <# _.each( data.attach.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.attach.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
                <# } #>

            </div>

            <?php
        }

        /**
         * Returns button labels.
         *
         * @since 1.0.0
         */
        public static function get_button_labels() {

            $button_labels = array(
                'select' => esc_html__('Select Image', 'total-plus'),
                'change' => esc_html__('Change Image', 'total-plus'),
                'remove' => esc_html__('Remove', 'total-plus'),
                'default' => esc_html__('Default', 'total-plus'),
                'placeholder' => esc_html__('No image selected', 'total-plus'),
                'frame_title' => esc_html__('Select Image', 'total-plus'),
                'frame_button' => esc_html__('Choose Image', 'total-plus'),
            );

            return $button_labels;
        }

        /**
         * Returns field labels.
         *
         * @since 1.0.0
         */
        public static function get_field_labels() {

            $field_labels = array(
                'repeat' => esc_html__('Repeat', 'total-plus'),
                'size' => esc_html__('Size', 'total-plus'),
                'position' => esc_html__('Position', 'total-plus'),
                'attach' => esc_html__('Attachment', 'total-plus')
            );

            return $field_labels;
        }

        /**
         * Returns the background choices.
         *
         * @since 1.0.0
         * @return array
         */
        public static function get_background_choices() {

            $choices = array(
                'repeat' => array(
                    'no-repeat' => esc_html__('No Repeat', 'total-plus'),
                    'repeat' => esc_html__('Tile', 'total-plus'),
                    'repeat-x' => esc_html__('Tile Horizontally', 'total-plus'),
                    'repeat-y' => esc_html__('Tile Vertically', 'total-plus')
                ),
                'size' => array(
                    'auto' => esc_html__('Default', 'total-plus'),
                    'cover' => esc_html__('Cover', 'total-plus'),
                    'contain' => esc_html__('Contain', 'total-plus')
                ),
                'position' => array(
                    'left-top' => esc_html__('Left Top', 'total-plus'),
                    'left-center' => esc_html__('Left Center', 'total-plus'),
                    'left-bottom' => esc_html__('Left Bottom', 'total-plus'),
                    'right-top' => esc_html__('Right Top', 'total-plus'),
                    'right-center' => esc_html__('Right Center', 'total-plus'),
                    'right-bottom' => esc_html__('Right Bottom', 'total-plus'),
                    'center-top' => esc_html__('Center Top', 'total-plus'),
                    'center-center' => esc_html__('Center Center', 'total-plus'),
                    'center-bottom' => esc_html__('Center Bottom', 'total-plus')
                ),
                'attach' => array(
                    'fixed' => esc_html__('Fixed', 'total-plus'),
                    'scroll' => esc_html__('Scroll', 'total-plus')
                )
            );

            return $choices;
        }

    }

    class Total_Plus_Control_Tab extends WP_Customize_Control {

        public $type = 'tab';
        public $buttons = '';

        public function __construct($manager, $id, $args = array()) {
            parent::__construct($manager, $id, $args);
        }

        public function to_json() {
            parent::to_json();
            $first = true;
            $formatted_buttons = array();
            $all_fields = array();
            foreach ($this->buttons as $button) {
                //$fields = array();
                $active = isset($button['active']) ? $button['active'] : false;
                if ($active && $first) {
                    $first = false;
                } elseif ($active && !$first) {
                    $active = false;
                }

                $formatted_buttons[] = array(
                    'name' => $button['name'],
                    'fields' => $button['fields'],
                    'active' => $active,
                );
                $all_fields = array_merge($all_fields, $button['fields']);
            }
            $this->json['buttons'] = $formatted_buttons;
            $this->json['fields'] = $all_fields;
        }

        public function content_template() {
            ?>
            <div class="customizer-tab-wrap">
                <# if ( data.buttons ) { #>
                <div class="customizer-tabs">
                    <# for (tab in data.buttons) { #>
                    <a href="#" class="customizer-tab <# if ( data.buttons[tab].active ) { #> active <# } #>" data-tab="{{ tab }}">{{ data.buttons[tab].name }}</a>
                    <# } #>
                </div>
                <# } #>
            </div>
            <?php
        }

    }

    class Total_Plus_Date_Control extends WP_Customize_Control {

        public $type = 'date_picker';

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if ($this->description) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>

                <input class="ht-datepicker-control" type="text" autocomplete="off" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?>>
            </label>
            <?php
        }

    }

    class Total_Plus_Dimensions_Control extends WP_Customize_Control {

        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'dimensions';

        /**
         * Renders the control wrapper and calls $this->render_content() for the internals.
         *
         * @see WP_Customize_Control::render()
         */
        protected function render() {
            $id = 'customize-control-' . str_replace(array('[', ']'), array('-', ''), $this->id);
            $class = 'customize-control has-switchers customize-control-' . $this->type;
            ?><li id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class); ?>">
                <?php $this->render_content(); ?>
            </li><?php
        }

        /**
         * Refresh the parameters passed to the JavaScript via JSON.
         *
         * @see WP_Customize_Control::to_json()
         */
        public function to_json() {
            parent::to_json();

            $this->json['id'] = $this->id;
            $this->json['l10n'] = $this->l10n();
            $this->json['title'] = esc_html__('Link values together', 'total-plus');

            $this->json['inputAttrs'] = '';
            foreach ($this->input_attrs as $attr => $value) {
                $this->json['inputAttrs'] .= $attr . '="' . esc_attr($value) . '" ';
            }

            $this->json['desktop'] = array();
            $this->json['tablet'] = array();
            $this->json['mobile'] = array();

            foreach ($this->settings as $setting_key => $setting) {

                list( $_key ) = explode('_', $setting_key);

                $this->json[$_key][$setting_key] = array(
                    'id' => $setting->id,
                    'link' => $this->get_link($setting_key),
                    'value' => $this->value($setting_key),
                );
            }
        }

        /**
         * An Underscore (JS) template for this control's content (but not its container).
         *
         * Class variables for this control class are available in the `data` JS object;
         * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
         *
         * @see WP_Customize_Control::print_template()
         *
         * @access protected
         */
        protected function content_template() {
            ?>
            <# if ( data.label ) { #>
            <span class="customize-control-title">
                <span>{{{ data.label }}}</span>

                <ul class="responsive-switchers">
                    <li class="desktop">
                        <button type="button" class="preview-desktop active" data-device="desktop">
                            <i class="dashicons dashicons-desktop"></i>
                        </button>
                    </li>
                    <li class="tablet">
                        <button type="button" class="preview-tablet" data-device="tablet">
                            <i class="dashicons dashicons-tablet"></i>
                        </button>
                    </li>
                    <li class="mobile">
                        <button type="button" class="preview-mobile" data-device="mobile">
                            <i class="dashicons dashicons-smartphone"></i>
                        </button>
                    </li>
                </ul>

            </span>
            <# } #>

            <# if ( data.description ) { #>
            <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>

            <ul class="desktop control-wrap active">
                <# _.each( data.desktop, function( args, key ) { #>
                <li class="dimension-wrap {{ key }}">
                    <input {{{ data.inputAttrs }}} type="number" class="dimension-{{ key }}" {{{ args.link }}} value="{{{ args.value }}}" />
                        <span class="dimension-label">{{ data.l10n[ key ] }}</span>
                </li>
                <# } ); #>

                <li class="dimension-wrap">
                    <div class="link-dimensions">
                        <span class="dashicons dashicons-admin-links total-plus-linked" data-element="{{ data.id }}" title="{{ data.title }}"></span>
                        <span class="dashicons dashicons-editor-unlink total-plus-unlinked" data-element="{{ data.id }}" title="{{ data.title }}"></span>
                    </div>
                </li>
            </ul>

            <ul class="tablet control-wrap">
                <# _.each( data.tablet, function( args, key ) { #>
                <li class="dimension-wrap {{ key }}">
                    <input {{{ data.inputAttrs }}} type="number" class="dimension-{{ key }}" {{{ args.link }}} value="{{{ args.value }}}" />
                        <span class="dimension-label">{{ data.l10n[ key ] }}</span>
                </li>
                <# } ); #>

                <li class="dimension-wrap">
                    <div class="link-dimensions">
                        <span class="dashicons dashicons-admin-links total-plus-linked" data-element="{{ data.id }}_tablet" title="{{ data.title }}"></span>
                        <span class="dashicons dashicons-editor-unlink total-plus-unlinked" data-element="{{ data.id }}_tablet" title="{{ data.title }}"></span>
                    </div>
                </li>
            </ul>

            <ul class="mobile control-wrap">
                <# _.each( data.mobile, function( args, key ) { #>
                <li class="dimension-wrap {{ key }}">
                    <input {{{ data.inputAttrs }}} type="number" class="dimension-{{ key }}" {{{ args.link }}} value="{{{ args.value }}}" />
                        <span class="dimension-label">{{ data.l10n[ key ] }}</span>
                </li>
                <# } ); #>

                <li class="dimension-wrap">
                    <div class="link-dimensions">
                        <span class="dashicons dashicons-admin-links total-plus-linked" data-element="{{ data.id }}_mobile" title="{{ data.title }}"></span>
                        <span class="dashicons dashicons-editor-unlink total-plus-unlinked" data-element="{{ data.id }}_mobile" title="{{ data.title }}"></span>
                    </div>
                </li>
            </ul>

            <?php
        }

        /**
         * Returns an array of translation strings.
         *
         * @access protected
         * @param string|false $id The string-ID.
         * @return string
         */
        protected function l10n($id = false) {
            $translation_strings = array(
                'desktop_top' => esc_attr__('Top', 'total-plus'),
                'desktop_right' => esc_attr__('Right', 'total-plus'),
                'desktop_bottom' => esc_attr__('Bottom', 'total-plus'),
                'desktop_left' => esc_attr__('Left', 'total-plus'),
                'tablet_top' => esc_attr__('Top', 'total-plus'),
                'tablet_right' => esc_attr__('Right', 'total-plus'),
                'tablet_bottom' => esc_attr__('Bottom', 'total-plus'),
                'tablet_left' => esc_attr__('Left', 'total-plus'),
                'mobile_top' => esc_attr__('Top', 'total-plus'),
                'mobile_right' => esc_attr__('Right', 'total-plus'),
                'mobile_bottom' => esc_attr__('Bottom', 'total-plus'),
                'mobile_left' => esc_attr__('Left', 'total-plus'),
            );
            if (false === $id) {
                return $translation_strings;
            }
            return $translation_strings[$id];
        }

    }

    class Total_Plus_Range_Slider_Control extends WP_Customize_Control {

        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'range-slider';

        /**
         * Renders the control wrapper and calls $this->render_content() for the internals.
         *
         * @see WP_Customize_Control::render()
         */
        protected function render() {
            $id = 'customize-control-' . str_replace(array('[', ']'), array('-', ''), $this->id);
            $class = 'customize-control has-switchers customize-control-' . $this->type;
            ?><li id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class); ?>">
                <?php $this->render_content(); ?>
            </li><?php
        }

        /**
         * Refresh the parameters passed to the JavaScript via JSON.
         *
         * @see WP_Customize_Control::to_json()
         */
        public function to_json() {
            parent::to_json();

            $this->json['id'] = $this->id;

            $this->json['inputAttrs'] = '';
            foreach ($this->input_attrs as $attr => $value) {
                $this->json['inputAttrs'] .= $attr . '="' . esc_attr($value) . '" ';
            }

            $this->json['desktop'] = array();
            $this->json['tablet'] = array();
            $this->json['mobile'] = array();

            foreach ($this->settings as $setting_key => $setting) {
                $this->json[$setting_key] = array(
                    'id' => $setting->id,
                    'default' => $setting->default,
                    'link' => $this->get_link($setting_key),
                    'value' => $this->value($setting_key),
                );
            }
        }

        /**
         * An Underscore (JS) template for this control's content (but not its container).
         *
         * Class variables for this control class are available in the `data` JS object;
         * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
         *
         * @see WP_Customize_Control::print_template()
         *
         * @access protected
         */
        protected function content_template() {
            ?>
            <# if ( data.label ) { #>
            <span class="customize-control-title">
                <span>{{{ data.label }}}</span>

                <ul class="responsive-switchers">
                    <li class="desktop">
                        <button type="button" class="preview-desktop active" data-device="desktop">
                            <i class="dashicons dashicons-desktop"></i>
                        </button>
                    </li>
                    <li class="tablet">
                        <button type="button" class="preview-tablet" data-device="tablet">
                            <i class="dashicons dashicons-tablet"></i>
                        </button>
                    </li>
                    <li class="mobile">
                        <button type="button" class="preview-mobile" data-device="mobile">
                            <i class="dashicons dashicons-smartphone"></i>
                        </button>
                    </li>
                </ul>

            </span>
            <# } #>

            <# if ( data.description ) { #>
            <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>

            <# if ( data.desktop ) { #>
            <div class="desktop control-wrap active">
                <div class="total-plus-slider desktop-slider"></div>
                <div class="total-plus-slider-input">
                    <input {{{ data.inputAttrs }}} type="number" class="slider-input desktop-input" value="{{ data.desktop.value }}" {{{ data.desktop.link }}} />
                </div>
            </div>
            <# } #>

            <# if ( data.tablet ) { #>
            <div class="tablet control-wrap">
                <div class="total-plus-slider tablet-slider"></div>
                <div class="total-plus-slider-input">
                    <input {{{ data.inputAttrs }}} type="number" class="slider-input tablet-input" value="{{ data.tablet.value }}" {{{ data.tablet.link }}} />
                </div>
            </div>
            <# } #>

            <# if ( data.mobile ) { #>
            <div class="mobile control-wrap">
                <div class="total-plus-slider mobile-slider"></div>
                <div class="total-plus-slider-input">
                    <input {{{ data.inputAttrs }}} type="number" class="slider-input mobile-input" value="{{ data.mobile.value }}" {{{ data.mobile.link }}} />
                </div>
            </div>
            <# } #>

            <?php
        }

    }

    class Total_Plus_Sortable_Control extends WP_Customize_Control {

        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'sortable';

        /**
         * Refresh the parameters passed to the JavaScript via JSON.
         *
         * @see WP_Customize_Control::to_json()
         */
        public function to_json() {
            parent::to_json();

            $this->json['default'] = $this->setting->default;
            if (isset($this->default)) {
                $this->json['default'] = $this->default;
            }
            $this->json['value'] = maybe_unserialize($this->value());
            $this->json['choices'] = $this->choices;
            $this->json['link'] = $this->get_link();
            $this->json['id'] = $this->id;

            $this->json['inputAttrs'] = '';
            foreach ($this->input_attrs as $attr => $value) {
                $this->json['inputAttrs'] .= $attr . '="' . esc_attr($value) . '" ';
            }

            $this->json['inputAttrs'] = maybe_serialize($this->input_attrs());
        }

        /**
         * An Underscore (JS) template for this control's content (but not its container).
         *
         * Class variables for this control class are available in the `data` JS object;
         * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
         *
         * @see WP_Customize_Control::print_template()
         *
         * @access protected
         */
        protected function content_template() {
            ?>
            <label class='total-plus-sortable'>
                <span class="customize-control-title">
                    {{{ data.label }}}
                </span>
                <# if ( data.description ) { #>
                <span class="description customize-control-description">{{{ data.description }}}</span>
                <# } #>

                <ul class="sortable">
                    <# _.each( data.value, function( choiceID ) { #>
                    <li {{{ data.inputAttrs }}} class='total-plus-sortable-item' data-value='{{ choiceID }}'>
                        <i class='dashicons dashicons-menu'></i>
                        <i class="dashicons dashicons-visibility visibility"></i>
                        {{{ data.choices[ choiceID ] }}}
                    </li>
                    <# }); #>
                    <# _.each( data.choices, function( choiceLabel, choiceID ) { #>
                    <# if ( -1 === data.value.indexOf( choiceID ) ) { #>
                    <li {{{ data.inputAttrs }}} class='total-plus-sortable-item invisible' data-value='{{ choiceID }}'>
                        <i class='dashicons dashicons-menu'></i>
                        <i class="dashicons dashicons-visibility visibility"></i>
                        {{{ data.choices[ choiceID ] }}}
                    </li>
                    <# } #>
                    <# }); #>
                </ul>
            </label>
            <?php
        }

    }

    class Total_Plus_Range_Control extends WP_Customize_Control {

        /**
         * The type of control being rendered
         */
        public $type = 'range';

        /**
         * Render the control in the customizer
         */
        public function render_content() {
            ?>
            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
                <span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr($this->value()); ?>"></span>
            </span>

            <div class="control-wrap"> 
                <div class="total-plus-slider" slider-min-value="<?php echo esc_attr($this->input_attrs['min']); ?>" slider-max-value="<?php echo esc_attr($this->input_attrs['max']); ?>" slider-step-value="<?php echo esc_attr($this->input_attrs['step']); ?>"></div>
                <div class="total-plus-slider-input">
                    <input type="number" value="<?php echo esc_attr($this->value()); ?>" class="slider-input" <?php $this->link(); ?> />
                </div>
            </div>

            <?php
            if ($this->description) {
                ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
                <?php
            }
        }

    }

    class Total_Plus_Color_Tab_Control extends WP_Customize_Control {

        public $type = 'color-tab';

        /**
         * Add support for palettes to be passed in.
         *
         * Supported palette values are true, false, or an array of RGBa and Hex colors.
         */
        public $palette;

        /**
         * Add support for showing the opacity value on the slider handle.
         */
        public $show_opacity;
        public $group;

        public function __construct($manager, $id, $args = array()) {
            if (isset($args['palette'])) {
                $this->palette = $args['palette'];
            }
            parent::__construct($manager, $id, $args);
        }

        /**
         * Refresh the parameters passed to the JavaScript via JSON.
         *
         * @see WP_Customize_Control::to_json()
         */
        public function to_json() {
            parent::to_json();

            // Process the palette
            if (is_array($this->palette)) {
                $palette_string = implode('|', $this->palette);
            } else {
                // Default to true.
                $palette_string = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
            }
            $this->json['show_opacity'] = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';
            $this->json['group'] = array();
            $this->json['l10n'] = $this->l10n();
            $this->json['group'] = $this->group;
            $this->json['palette'] = $palette_string;

            foreach ($this->settings as $setting_key => $setting) {
                list( $_key ) = explode('_', $setting_key);
                $this->json[$_key][$setting_key] = array(
                    'id' => $setting->id,
                    'link' => $this->get_link($setting_key),
                    'value' => $this->value($setting_key),
                    'default' => $setting->default
                );
            }
        }

        /**
         * An Underscore (JS) template for this control's content (but not its container).
         *
         * Class variables for this control class are available in the `data` JS object;
         * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
         *
         * @see WP_Customize_Control::print_template()
         *
         * @access protected
         */
        protected function content_template() {
            ?>
            <# if ( data.label ) { #>
            <span class="customize-control-title">
                <label>{{{ data.label }}}</label>
                <div class="color-tab-toggle"><span class="dashicons dashicons-edit"></span></div>
            </span>
            <# } #>

            <# if ( data.description ) { #>
            <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>

            <div class="color-tab-wrap" style="display:none">
                <ul class="color-tab-switchers">
                    <li data-tab="color-tab-content-normal" class="active">{{{ data.l10n['normal'] }}}</li>
                    <li data-tab="color-tab-content-hover">{{{ data.l10n['hover'] }}}</li>
                </ul>

                <div class="color-tab-contents">
                    <div class="color-tab-content-normal" style="display:block">
                        <# _.each( data.normal, function( args, key ) { #>
                        <div class="color-content-wrap {{ key }}">
                            <label class="color-tab-label">{{ data.group[ key ] }}</label>
                            <input class="alpha-color-control" type="text" value="{{ args.value }}" data-alpha-color-type="hex" data-alpha-enabled="{{ data.show_opacity }}" data-default-color="{{ args.default }}" data-palette="{{ data.palette }}" {{{ args.link }}} />   
                        </div>
                        <# } ); #>
                    </div>

                    <div class="color-tab-content-hover" style="display:none">
                        <# _.each( data.hover, function( args, key ) { #>
                        <div class="color-content-wrap {{ key }}">
                            <label class="color-tab-label">{{ data.group[ key ] }}</label>
                            <input class="alpha-color-control" type="text"  value="{{ args.value }}" data-alpha-color-type="hex" data-alpha-enabled="{{ data.show_opacity }}" data-default-color="{{ args.default }}" data-palette="{{ data.palette }}" {{{ args.link }}} />   
                        </div>
                        <# } ); #>
                    </div>
                </div>
            </div>
            <?php
        }

        /**
         * Returns an array of translation strings.
         *
         * @access protected
         * @param string|false $id The string-ID.
         * @return string
         */
        protected function l10n($id = false) {
            $translation_strings = array(
                'normal' => esc_attr__('Normal', 'total-plus'),
                'hover' => esc_attr__('Hover', 'total-plus')
            );
            if (false === $id) {
                return $translation_strings;
            }
            return $translation_strings[$id];
        }

    }

}

if (class_exists('WP_Customize_Section')) {

    /**
     * Class Total_Plus_Toggle_Section
     *
     * @access public
     */
    class Total_Plus_Toggle_Section extends WP_Customize_Section {

        /**
         * The type of customize section being rendered.
         *
         * @access public
         * @var    string
         */
        public $type = 'toggle-section';

        /**
         * Flag to display icon when entering in customizer
         *
         * @access public
         * @var bool
         */
        public $hide;

        /**
         * Name of customizer hiding control.
         *
         * @access public
         * @var bool
         */
        public $hiding_control;

        /**
         * Total_Plus_Toggle_Section constructor.
         *
         * @param WP_Customize_Manager $manager Customizer Manager.
         * @param string               $id Control id.
         * @param array                $args Arguments.
         */
        public function __construct(WP_Customize_Manager $manager, $id, array $args = array()) {
            parent::__construct($manager, $id, $args);

            if (isset($args['hiding_control'])) {
                $this->hide = get_theme_mod($args['hiding_control'], 'off');
            }

            add_action('customize_controls_init', array($this, 'enqueue'));
        }

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @access public
         */
        public function json() {
            $json = parent::json();
            $json['hide'] = $this->hide;
            $json['hiding_control'] = $this->hiding_control;
            return $json;
        }

        /**
         * Enqueue function.
         *
         * @access public
         * @return void
         */
        public function enqueue() {
            wp_enqueue_script('total-plus-toggle-section', get_template_directory_uri() . '/inc/customizer/js/toggle-section.js', array('jquery'), TOTAL_PLUS_VERSION, true);
        }

        /**
         * Outputs the Underscore.js template.
         *
         * @access public
         * @return void
         */
        protected function render_template() {
            ?>
            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }}">
                <h3 class="accordion-section-title <# if ( data.hide != 'on' ) { #> total-plus-section-visible <# } else { #> total-plus-section-hidden <# }#>">
                    <# if(data.hiding_control){ #>
                    <span class="ht--sortable-handle dashicons dashicons-move"></span>
                    <# } #>    
                    <button type="button" class="accordion-trigger" aria-expanded="false" aria-controls="{{ data.id }}-content">
                    {{ data.title }}
                    <# if ( data.hide != 'on' ) { #>
                    <a data-control="{{ data.hiding_control }}" class="total-plus-toggle-section" href="#"><span class="dashicons dashicons-visibility"></span></a>
                    <# } else { #>
                    <a data-control="{{ data.hiding_control }}" class="total-plus-toggle-section" href="#"><span class="dashicons dashicons-hidden"></span></a>
                    <# } #>
                    </button>
                </h3>
                <ul class="accordion-section-content" id="{{ data.id }}-content">
                    <li class="customize-section-description-container section-meta <# if ( data.description_hidden ) { #>customize-info<# } #>">
                        <div class="customize-section-title">
                            <button class="customize-section-back" tabindex="-1">
                            </button>
                            <h3>
                                <span class="customize-action">
                                    {{{ data.customizeAction }}}
                                </span>
                                {{ data.title }}
                            </h3>
                            <# if ( data.description && data.description_hidden ) { #>
                            <button type="button" class="customize-help-toggle dashicons dashicons-editor-help" aria-expanded="false"></button>
                            <div class="description customize-section-description">
                                {{{ data.description }}}
                            </div>
                            <# } #>
                        </div>

                        <# if ( data.description && ! data.description_hidden ) { #>
                        <div class="description customize-section-description">
                            {{{ data.description }}}
                        </div>
                        <# } #>
                    </li>
                </ul>
            </li>
            <?php
        }

    }

}