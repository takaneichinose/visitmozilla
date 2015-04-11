/*globals define, console*/
/*eslint no-console: 0*/
(function(){
  "use strict";

  define([
      "jquery",
      "underscore",
      "backbone",
      "views/index",
  ], function($, _, Backbone, indexView){
    var appRouter = Backbone.Router.extend({
      routes: {
        "": "index",
        "registration": "userRegistration"
      },

      initialize: function(){
        console.log("route initialized");
        Backbone.history.start();
      },

      index: function(){
        console.log("!");
        var test = new indexView();
        test.render();
      },

      userRegistration: function(){
        console.log("registration");
      }
    });
    
    return appRouter;
  });
}());
