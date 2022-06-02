import 'semantic-ui-css/components/api';
import $ from 'jquery';

$.fn.extend({
  moveFacetGroups(positionInput) {
    const facetGroupRows = [];
    const element = this;

    element.api({
      method: 'PUT',
      beforeSend(settings) {
        /* eslint-disable-next-line no-param-reassign */
        settings.data = {
          facetGroups: facetGroupRows,
          _csrf_token: element.data('csrf-token'),
        };

        return settings;
      },
      onSuccess() {
        window.location.reload();
      },
    });

    positionInput.on('input', (event) => {
      const input = $(event.currentTarget);
      const facetGroupId = input.data('id');
      const row = facetGroupRows.find(({ id }) => id === facetGroupId);

      if (!row) {
        facetGroupRows.push({
          id: facetGroupId,
          position: input.val(),
        });
      } else {
        row.position = input.val();
      }
    });
  },
});
