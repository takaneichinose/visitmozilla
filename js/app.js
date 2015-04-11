/*globals define*/
/*eslint*/
(function(){
  'use strict';
  define([
    'jquery',
    'underscore',
    'backbone',
    'router'
  ], function($, _, Backbone, Router){
    var initialize = function(){
      return new Router();
    };
    
    return {
      initialize: initialize
    };
  });
}());
