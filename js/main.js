/*global require*/
(function() {
  'use strict';
  
  require.config({
    paths: {
      jquery: 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min',
      underscore: 'https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.2/underscore-min',
      backbone: 'https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.1.2/backbone-min'
      text: 'libraries/text'
    }
  });

  require([
    'app'
  ], function(App){
    App.initialize();
  });
}());
