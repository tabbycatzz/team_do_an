jQuery('body').on('click', '#btn-reply-comment', function () {
    var id = $(this).val();

    $(document).on('click', '#icon-reply-' + id, function () {
        document.getElementById('form-reply-' + id).style.display = 'block';
    });
    
    $(document).on('click', '.close-add-comment', function () {
        document.getElementById('form-reply-' + id).style.display = 'none';
    });
});

jQuery('body').on('click', '#btn-edit-comment', function () {
    var id = $(this).val();

    $(document).on('click', '#icon-edit-' + id, function () {
        document.getElementById('form-edit-' + id).style.display = 'block';
    });
    
    $(document).on('click', '.close-edit-' + id, function () {
        document.getElementById('form-edit-' + id).style.display = 'none';
    });
});
