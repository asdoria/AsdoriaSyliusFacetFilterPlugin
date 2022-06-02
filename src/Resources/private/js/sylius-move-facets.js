import 'semantic-ui-css/components/api';
import $ from 'jquery';

$.fn.extend({
  moveFacets(positionInput) {
    const facetRows = [];
    const element = this;

    element.api({
      method: 'PUT',
      beforeSend(settings) {
        /* eslint-disable-next-line no-param-reassign */
        settings.data = {
          facets: facetRows,
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
      const facetId = input.data('id');
      const row = facetRows.find(({ id }) => id === facetId);

      if (!row) {
        facetRows.push({
          id: facetId,
          position: input.val(),
        });
      } else {
        row.position = input.val();
      }
    });
  },
});
