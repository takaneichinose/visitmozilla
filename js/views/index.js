define([
    'jquery',
    'underscore',
    'backbone',
    'text!../templates/index.html'
], function($, _, Backbone, indexTemplate){
  var indexView = Backbone.View.extend({
    el: $('.row'),
    render: function(){
      compiledTemplate = _.template(indexTemplate);
      var data = {};
      this.$el.append(compiledTemplate, data);
    },
    events: {
      'click #login': 'login'
    },
    login: function() {
      console.log('bads');
    }
  });

  return indexView;
});
