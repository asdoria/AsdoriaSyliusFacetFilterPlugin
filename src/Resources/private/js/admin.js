import './sylius-move-facets';
import './sylius-move-facet-groups';

document.addEventListener('DOMContentLoaded', () => {
  $('.asdoria-update-facets').moveFacets($('.asdoria-facet-position'));
  $('.asdoria-update-facet-groups').moveFacetGroups($('.asdoria-facet-group-position'));
});
