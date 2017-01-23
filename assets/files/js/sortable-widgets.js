function initSortableWidgets() {
  Sortable.create($('[data-sortable-widget=1] tbody').get(0), {
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