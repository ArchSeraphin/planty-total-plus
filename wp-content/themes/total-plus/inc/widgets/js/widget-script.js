var selector;

function upload_media_image(selector) {
    // ADD IMAGE LINK
    jQuery('body').on('click', selector, function (event) {
        event.preventDefault();

        var imgContainer = jQuery(this).closest('.attachment-media-view').find('.thumbnail-image'),
                placeholder = jQuery(this).closest('.attachment-media-view').find('.placeholder'),
                imgIdInput = jQuery(this).siblings('.upload-id');

        // Create a new media frame
        frame = wp.media({
            title: 'Select or Upload Image',
            button: {
                text: 'Use Image'
            },
            multiple: false // Set to true to allow multiple files to be selected
        });

        // When an image is selected in the media frame...
        frame.on('select', function () {

            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();

            // Send the attachment URL to our custom image input field.
            imgContainer.html('<img src="' + attachment.url + '" style="max-width:100%;"/>');
            placeholder.addClass('hidden');
            imgIdInput.val(attachment.url).trigger('change');
        });

        // Finally, open the modal on click
        frame.open();

    });
}

function delete_media_image(selector) {
    // DELETE IMAGE LINK
    jQuery('body').on('click', selector, function (event) {

        event.preventDefault();
        var imgContainer = jQuery(this).closest('.attachment-media-view').find('.thumbnail-image'),
                placeholder = jQuery(this).closest('.attachment-media-view').find('.placeholder'),
                imgIdInput = jQuery(this).siblings('.upload-id');

        // Clear out the preview image
        imgContainer.find('img').remove();
        placeholder.removeClass('hidden');

        // Delete the image id from the hidden input
        imgIdInput.val('').trigger('change');

    });
}

function total_widget_color_picker(selector) {
    if (jQuery(selector).parents('#widgets-left').length < 1) {
        var el = selector + ' .ht-widget-color-picker';
        jQuery(el).wpColorPicker({
            change: function (event, ui) {
                setTimeout(function (event, ui) {
                    jQuery(el).parents('.widget-content').find('[name]:first').trigger('change');
                }, 100);
            },
            clear: function () {
                setTimeout(function (event, ui) {
                    jQuery(el).parents('.widget-content').find('[name]:first').trigger('change');
                }, 100);
            }
        });
    }
}

function total_widget_sortable(selector) {
    var el = selector + ' .ht-widget-repeater';
    jQuery(el).sortable({
        axis: 'y',
        helper: 'clone',
        cursor: 'move',
        handle: '.ht-repeater-box-title',
        update: function (event, ui) {
            jQuery(this).find('.ht-widget-repeater-box').each(function (index) {
                jQuery(this).find('[name]').each(function () {
                    var name = jQuery(this).attr('name');
                    name = name.split('[');

                    name[3] = name[3].replace(/[0-9]/g, index + 1);
                    name = name.join('[');
                    jQuery(this).attr('name', name);
                });
            });
            jQuery(el).find('[name]:first').trigger('change');
        }
    });
}

function total_widget_editor(selector) {
    if (jQuery(selector).parents('#widgets-left').length < 1) {

        setTimeout(function () {
            var editorId = jQuery(selector + ' .ht-inline-editor').attr('id');

            if (tinymce.get(editorId)) {
                wp.editor.remove(editorId);
            }

            wp.editor.initialize(editorId, {
                tinymce: {
                    wpautop: true,
                    setup: function (editor) {
                        editor.on('change', function () {
                            editor.save();
                            jQuery(editor.getElement()).trigger('change');
                        });
                    }
                },
                quicktags: true
            });
        }, 300);
    }
}

function total_widget_tabs(selector) {
    jQuery(selector).find('.ht-widget-tab > div:first').addClass('active');
    jQuery(selector).find('.ht-widget-tab-content').not(':first').hide();
}

function total_widget_datepicker(selector) {
    if (jQuery(selector).parents('#widgets-left').length < 1) {
        var el = selector + ' .ht-datepicker';
        jQuery(el).datepicker({
            dateFormat: "yy/mm/dd"
        });
    }
}

jQuery(document).ready(function ($) {
    upload_media_image('.widget-media-view .ht-upload-button');
    delete_media_image('.widget-media-view .ht-delete-button');

    $(document).on('widget-added widget-updated', function (event, widget) {
        
        if (total_plus_widget_options.widgets_block_editor) {
            var widget_id = '.wp-block';
        } else {
            var widget_id = '#' + $(widget).attr('id');
        }

        total_widget_color_picker(widget_id);

        total_widget_sortable(widget_id);

        total_widget_editor(widget_id);

        total_widget_tabs(widget_id);

        total_widget_datepicker(widget_id);
    });

    //Widget Repeater Add Item
    $('body').on('click', '.ht-widget-add-item', function () {
        var $this = $(this).prev('.ht-widget-repeater');
        var count = $this.data('count');
        $this.data('count', count + 1);

        if (typeof $this != 'undefined') {
            var field = $this.find('.ht-widget-repeater-box:first').clone();
            field.find('[name]').each(function () {
                var name = $(this).attr('name');
                name = name.split('[');

                name[3] = name[3].replace(/[0-9]/g, count + 1);
                name = name.join('[');
                $(this).attr('name', name);
                $(this).val('');
            });
            field.find('[id]').each(function () {
                var id = $(this).attr('id');
                id = id.split('-');
                id[4] = id[4].replace(/[0-9]/g, count + 1);
                id = id.join('-');
                $(this).attr('id', id);
            });
            field.find('[for]').each(function () {
                var forr = $(this).attr('for');
                forr = forr.split('-');

                forr[4] = forr[4].replace(/[0-9]/g, count + 1);
                forr = forr.join('-');
                $(this).attr('for', forr);
            });
            field.find('.placeholder').each(function () {
                $(this).removeClass('hidden');
            });
            field.find('.thumbnail-image').each(function () {
                $(this).html('');
            });
            $this.append(field);

            var fieldTitle = field.find('.ht-repeater-box-title span:first').text();
            fieldTitle = fieldTitle.split('-');
            fieldTitle = fieldTitle[0] + ' - ';
            field.find('.ht-repeater-box-title span:first').text(fieldTitle);
            field.find('.ht-repeater-content').show();
            $this.find('[name]:first').trigger('change');
        }
        return false;
    });

    //Widget Repeater Remove Item
    $('body').on('click', '.ht-widget-repeater-remove', function () {
        $(this).closest('.ht-widget-repeater-box').find('[name]:first').trigger('change');
        $(this).closest('.ht-widget-repeater-box').remove();
        return false;
    });

    //Widget Repeater Toggle Item
    $('body').on('click', '.ht-repeater-toggle', function () {
        $(this).closest('.ht-repeater-box-title').next('.ht-repeater-content').slideToggle();
        $(this).toggleClass('closed');
    });

    //Widget Tabs
    $('body').on('click', '.ht-widget-tab > div', function () {
        if ($(this).hasClass('active')) {
            return false;
        }
        var el = $(this).attr('class');
        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        $(this).parent('.ht-widget-tab').next('.ht-widget-tab-content-wrap').children('.ht-widget-tab-content').hide();
        $(this).parent('.ht-widget-tab').next('.ht-widget-tab-content-wrap').children('.ht-widget-tab-content[data-id=' + el + ']').fadeIn();
    });

    //FontAwesome Icon Chooser
    $('body').on('click', '.ht-widget-icon-box .ht-icon-list li', function () {
        var icon_class = $(this).find('i').attr('class');
        $(this).closest('.ht-icon-box').find('.ht-icon-list li').removeClass('icon-active');
        $(this).addClass('icon-active');
        $(this).closest('.ht-icon-box').prev('.ht-selected-icon').children('i').attr('class', '').addClass(icon_class);
        $(this).closest('.ht-icon-box').next('input').val(icon_class).trigger('change');
        $(this).closest('.ht-icon-box').slideUp();
    });

    $('body').on('click', '.ht-widget-icon-box .ht-selected-icon', function () {
        $(this).next().slideToggle();
    });

    $('body').on('keyup', '.ht-widget-icon-box .ht-icon-search input', function (e) {
        var keyword = $(this).val().toLowerCase();
        search_criteria = $(this).closest('.ht-icon-box').find('.ht-icon-list i');

        $(search_criteria).each(function () {
            if ($(this).attr('class').indexOf(keyword) > -1) {
                $(this).parent().show();
            } else {
                $(this).parent().hide();
            }
        });
    });

    $(document).on('click', '.ht-wp-editor-button', function () {
        $(this).addClass('ht-wp-editor-widget-active');
        $('#ht-wp-editor-widget-backdrop').show();
        $('body.widgets-php #ht-wp-editor-widget-container, body.post-php #ht-wp-editor-widget-container, body.post-new-php #ht-wp-editor-widget-container, body.fl-builder #ht-wp-editor-widget-container, body.elementor-editor-active #ht-wp-editor-widget-container').show();
        $('body.wp-customizer #ht-wp-editor-widget-container').fadeIn(100).animate({
            'left': '0'
        });

        var currentEditorPage = '';
        if ($('body').hasClass('wp-customizer')) {
            var currentEditorPage = 'wp-customizer';
        } else if ($('body').hasClass('widgets-php')) {
            var currentEditorPage = 'widgets-php';
        } else {
            var currentEditorPage = 'wp-pagescreen';
        }


        if (currentEditorPage == 'wp-customizer') {
            var wpFullOverlayOriginalZIndex = parseInt($('.wp-full-overlay').css('zIndex'));
            $('.wp-full-overlay').css({
                zIndex: 49000
            });
        }

        var editor = tinyMCE.EditorManager.get('wpeditorwidget');
        var content = $(this).prev().val();

        if (typeof editor == "object" && editor !== null) {
            editor.setContent(content);
        }
        $('#wpeditorwidget').val(content);
        return false;

    });

    $(document).on('click', '.ht-wp-editor-widget-close', function () {
        $('.ht-wp-editor-button').removeClass('ht-wp-editor-widget-active');
        $('#ht-wp-editor-widget-backdrop').hide();
        $('body.widgets-php #ht-wp-editor-widget-container, body.post-php #ht-wp-editor-widget-container, body.post-new-php #ht-wp-editor-widget-container, body.fl-builder #ht-wp-editor-widget-container, body.elementor-editor-active #ht-wp-editor-widget-container').hide();
        $('body.wp-customizer #ht-wp-editor-widget-container').animate({
            "left": "-650px"
        }).fadeOut();

        var currentEditorPage = '';
        if ($('body').hasClass('wp-customizer')) {
            var currentEditorPage = 'wp-customizer';
        } else if ($('body').hasClass('widgets-php')) {
            var currentEditorPage = 'widgets-php';
        } else {
            var currentEditorPage = 'wp-pagescreen';
        }
        if (this.currentEditorPage == "wp-customizer") {
            var wpFullOverlayOriginalZIndex = parseInt($('.wp-full-overlay').css('zIndex'));
            $('.wp-full-overlay').css({
                zIndex: wpFullOverlayOriginalZIndex
            });
        }
        return false;
    });

    $(document).on('click', '.ht-wp-editor-widget-update-close', function () {
        var currentEditorPage = '';
        if ($('body').hasClass('wp-customizer')) {
            var currentEditorPage = 'wp-customizer';
        } else if ($('body').hasClass('widgets-php')) {
            var currentEditorPage = 'widgets-php';
        } else {
            var currentEditorPage = 'wp-pagescreen';
        }

        var currentContentId = $('.ht-wp-editor-widget-active').prev('input')

        $('#wpeditorwidget-tmce').trigger('click');
        var editor = tinyMCE.EditorManager.get('wpeditorwidget');

        if (typeof editor == "undefined" || editor == null || editor.isHidden()) {
            var content = $('#wpeditorwidget').val();
        } else {
            var content = editor.getContent();
        }

        currentContentId.val(content).trigger('change');

        // customize.php
        if (currentEditorPage == "wp-customizer" && $(currentContentId).attr('class') == 'editorfield') {
            var controlid = $(currentContentId).data('customize-setting-link');
            //console.log(controlid);
            setTimeout(function () {
                wp.customize(controlid, function (obj) {
                    obj.set(editor.getContent());
                });
            }, 1000);


        } else if (this.currentEditorPage == "wp-customizer") {
            var widget_id = $(currentContentId).closest('div.form').find('input.widget-id').val();
            var widget_form_control = wp.customize.Widgets.getWidgetFormControlForWidget(widget_id)
            widget_form_control.updateWidget();
        }
        // If Widgets Edit Page
        else if (this.currentEditorPage == "widgets-php") {
            wpWidgets.save($(currentContentId).closest('div.widget'), 0, 1, 0);
        }

        // If Page builder
        else {

            $(currentContentId).closest('div.form').find('input.widget-id').val(editor.getContent());
        }

        $('.ht-wp-editor-button').removeClass('ht-wp-editor-widget-active');
        $('#ht-wp-editor-widget-backdrop').hide();
        $('body.widgets-php #ht-wp-editor-widget-container, body.post-php #ht-wp-editor-widget-container, body.post-new-php #ht-wp-editor-widget-container, body.fl-builder #ht-wp-editor-widget-container, body.elementor-editor-active #ht-wp-editor-widget-container').hide();
        $('body.wp-customizer #ht-wp-editor-widget-container').animate({
            "left": "-650px"
        }).fadeOut();

        if (this.currentEditorPage == "wp-customizer") {
            var wpFullOverlayOriginalZIndex = parseInt($('.wp-full-overlay').css('zIndex'));
            $('.wp-full-overlay').css({
                zIndex: wpFullOverlayOriginalZIndex
            });
        }
        return false;
    });

});
