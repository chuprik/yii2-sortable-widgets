function initSortableWidgets() {
  $('[data-sortable-widget=1] tbody').sortableWidgets({
    animation: 300,
    handle: '.sortable-widget-handler',
    dataIdAttr: 'data-sortable-id',
    onEnd: function (e) {
      var context = $(this.el).parents('[data-sortable-widget=1]');
      $.post(context.data('sortable-url'), {
        sorting: this.toArray(),
        offset: $(e.item).find('[data-offset]').data('offset')
      }).done(function () {
          if (context.data('pjax')) {
              $.pjax.reload({container: context.data('pjax-container'), timeout: context.data('pjax-timeout')})
          }
      });
    }
  });
}
