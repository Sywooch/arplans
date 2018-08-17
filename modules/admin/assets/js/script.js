$(function () {
    'use strict';
    $(document).on('click', '.js-delete-preview', function () {
        var container = $(this).closest('.preview-image-block');
        var button = $(this);
        var postId = container.data('id');
        $.ajax({
            type: 'GET',
            url: '/admin/modules/blog/post/delete-preview-image',
            data: {
                postId: postId
            },
            success: function (data) {
                if (data.status === 'success') {
                    container.find('.preview-image').remove();
                    button.remove();
                    $('.old-image-input').val('');
                }
            }
        });
    });

    $(document).on('click', '.js-delete-preview-page', function () {
        var container = $(this).closest('.preview-image-block');
        var button = $(this);
        var pageId = container.data('id');
        $.ajax({
            type: 'GET',
            url: '/admin/modules/blog/page/delete-preview-image',
            data: {
                pageId: pageId
            },
            success: function (data) {
                if (data.status === 'success') {
                    container.find('.preview-image').remove();
                    button.remove();
                    $('.old-image-input').val('');
                }
            }
        });
    });

    // Переключение табов
    $("#wr-tabs").on("click", ".tab", function () {
        var tabs = $("#wr-tabs .tab"),
            cont = $("#wr-tabs .tab-cont");
        // Удаляем классы active
        tabs.removeClass("active");
        cont.removeClass("active");
        // Добавляем классы active
        $(this).addClass("active");
        cont.eq($(this).index()).addClass("active");
        return false;
    });

    // загрузка картинок товара
    $("form[name='uploader']").submit(function (e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: '/admin/modules/shop/item/upload',
            type: "POST",
            data: formData,
            async: false,
            success: function (result) {
                if (result.status === 'success') {
                    $('.images-panel').append(result.block);
                    var urls = $('.new-images-input').attr("value");
                    urls += ':' + result.file;
                    $('.new-images-input').attr('value', urls);
                }
            },
            error: function () {
                alert('Ошибка при загрузке файла');
            },
            cache: false,
            contentType: false,
            processData: false
        });
        e.preventDefault();
    });

    $(document).on('click', '.js-image-admin-delete', function () {
        var container = $(this).closest('.image-admin-preview');
        var id = container.data('id');
        var file = container.data('file');
        $.ajax({
            type: 'GET',
            url: '/admin/modules/shop/item/delete-image',
            data: {
                id: id,
                file: file
            },
            success: function (data) {
                if (data.status === 'success') {
                    container.remove();
                    var urls = $('.new-images-input').attr("value");
                    var urlsNew = urls.replace(':' + file, '');
                    $('.new-images-input').attr('value', urlsNew);
                }
            }
        });

    });

    $(document).on('click', '.js-set-default-image', function () {
        var button = $(this);
        var id = button.closest('.image-admin-preview').data('id');
        $.ajax({
            type: 'GET',
            url: '/admin/modules/shop/item/set-preview',
            data: {
                id: id
            },
            success: function (data) {
                if (data.status === 'success') {
                    $('.default-image').addClass('js-set-default-image').removeClass('default-image');
                    button.removeClass('js-set-default-image').addClass('default-image');
                }
            }
        });
    })
});