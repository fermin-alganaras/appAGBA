(function(){
  'use strict';

  angular
  .module('ARPGBA')
  .directive('selectableRow', selectableRow);

  function selectableRow(){
    return function(scope, element, attrs){
    var row = element;

    row.on('click', function(){
      if(_.isUndefined(attrs.multiselect) || attrs.multiselect == "false") {
        var siblings = row.parent().find('tr');
        _.forEach(siblings, function(sibling){
          sibling = $(sibling);
          if(sibling.hasClass('info'))
            sibling.removeClass('info')

        })
      }
      row.toggleClass('info')
    })
}
  }
})();
