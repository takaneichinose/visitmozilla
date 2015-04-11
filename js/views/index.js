define([
    'jquery',
    'underscore',
    'backbone',
    '/emplates/index.js'
], function($, _, Backbone, indexTemplate){
  var indexView = Backbone.View.extend({
    el: $('.row'),
    render: function(){
      compiledTemplate = _.template(indexTemplate);
      this.$el.append(compiledTemplate);
      console.log('index view here motherfucker!');
    }
  });

  return indexView;
});
