$('table tbody').sortable({
    handle: '.sw-handler',
    placeholder: 'sw-placeholder',
    cursor: 'move',
    helper: function (e, ui) {
        ui.children().each(function () {
            $(this).width($(this).width());
        });
        return ui;
    },
    start: function (event, ui) {
        ui.item.data('prev-index', (ui.item.index() + 1));
    },
    update: function (event, ui) {
        var data = {
            prev_index: ui.item.data('prev-index'),
            new_index: (ui.item.index() + 1),
            dragged: ui.item.data('key')
        };

        var url = ui.item.parents('table').data('sorting-url');

        $.post(url, data);
    }
});
