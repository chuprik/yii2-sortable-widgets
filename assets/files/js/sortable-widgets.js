function initSortableWidgets() {
  $('[data-sortable-widget=1] tbody').sortable({
    animation: 300,
    handle: '.sortable-widget-handler',
    dataIdAttr: 'data-sortable-id',
    onEnd: function (e) {
      $.post($(this.el).parents('[data-sortable-widget=1]').data('sortable-url'), {
        sorting: this.toArray()
      });
    }
  });
}
