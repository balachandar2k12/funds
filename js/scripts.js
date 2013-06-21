/*
 * jQuery EasyTabs plugin 3.1.1
 *
 * Copyright (c) 2010-2011 Steve Schwartz (JangoSteve)
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 * Date: Tue Jan 26 16:30:00 2012 -0500
 */
( function($) {

  $.easytabs = function(container, options) {

        // Attach to plugin anything that should be available via
        // the $container.data('easytabs') object
    var plugin = this,
        $container = $(container),

        defaults = {
          animate: true,
          panelActiveClass: "active",
          tabActiveClass: "active",
          defaultTab: "li:first-child",
          animationSpeed: "normal",
          tabs: "> ul > li",
          updateHash: true,
          cycle: false,
          collapsible: false,
          collapsedClass: "collapsed",
          collapsedByDefault: true,
          uiTabs: false,
          transitionIn: 'fadeIn',
          transitionOut: 'fadeOut',
          transitionInEasing: 'swing',
          transitionOutEasing: 'swing',
          transitionCollapse: 'slideUp',
          transitionUncollapse: 'slideDown',
          transitionCollapseEasing: 'swing',
          transitionUncollapseEasing: 'swing',
          containerClass: "",
          tabsClass: "",
          tabClass: "",
          panelClass: "",
          cache: true,
          panelContext: $container
        },

        // Internal instance variables
        // (not available via easytabs object)
        $defaultTab,
        $defaultTabLink,
        transitions,
        lastHash,
        skipUpdateToHash,
        animationSpeeds = {
          fast: 200,
          normal: 400,
          slow: 600
        },

        // Shorthand variable so that we don't need to call
        // plugin.settings throughout the plugin code
        settings;

    // =============================================================
    // Functions available via easytabs object
    // =============================================================

    plugin.init = function() {

      plugin.settings = settings = $.extend({}, defaults, options);

      // Add jQuery UI's crazy class names to markup,
      // so that markup will match theme CSS
      if ( settings.uiTabs ) {
        settings.tabActiveClass = 'ui-tabs-selected';
        settings.containerClass = 'ui-tabs ui-widget ui-widget-content ui-corner-all';
        settings.tabsClass = 'ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all';
        settings.tabClass = 'ui-state-default ui-corner-top';
        settings.panelClass = 'ui-tabs-panel ui-widget-content ui-corner-bottom';
      }

      // If collapsible is true and defaultTab specified, assume user wants defaultTab showing (not collapsed)
      if ( settings.collapsible && options.defaultTab !== undefined && options.collpasedByDefault === undefined ) {
        settings.collapsedByDefault = false;
      }

      // Convert 'normal', 'fast', and 'slow' animation speed settings to their respective speed in milliseconds
      if ( typeof(settings.animationSpeed) === 'string' ) {
        settings.animationSpeed = animationSpeeds[settings.animationSpeed];
      }

      $('a.anchor').remove().prependTo('body');

      // Store easytabs object on container so we can easily set
      // properties throughout
      $container.data('easytabs', {});

      plugin.setTransitions();

      plugin.getTabs();

      addClasses();

      setDefaultTab();

      bindToTabClicks();

      initHashChange();

      initCycle();

      // Append data-easytabs HTML attribute to make easy to query for
      // easytabs instances via CSS pseudo-selector
      $container.attr('data-easytabs', true);
    };

    // Set transitions for switching between tabs based on options.
    // Could be used to update transitions if settings are changes.
    plugin.setTransitions = function() {
      transitions = ( settings.animate ) ? {
          show: settings.transitionIn,
          hide: settings.transitionOut,
          speed: settings.animationSpeed,
          collapse: settings.transitionCollapse,
          uncollapse: settings.transitionUncollapse,
          halfSpeed: settings.animationSpeed / 2
        } :
        {
          show: "show",
          hide: "hide",
          speed: 0,
          collapse: "hide",
          uncollapse: "show",
          halfSpeed: 0
        };
    };

    // Find and instantiate tabs and panels.
    // Could be used to reset tab and panel collection if markup is
    // modified.
    plugin.getTabs = function() {
      var $matchingPanel;

      // Find the initial set of elements matching the setting.tabs
      // CSS selector within the container
      plugin.tabs = $container.find(settings.tabs),

      // Instantiate panels as empty jquery object
      plugin.panels = $(),

      plugin.tabs.each(function(){
        var $tab = $(this),
            $a = $tab.children('a'),

            // targetId is the ID of the panel, which is either the
            // `href` attribute for non-ajax tabs, or in the
            // `data-target` attribute for ajax tabs since the `href` is
            // the ajax URL
            targetId = $tab.children('a').data('target');

        $tab.data('easytabs', {});

        // If the tab has a `data-target` attribute, and is thus an ajax tab
        if ( targetId !== undefined && targetId !== null ) {
          $tab.data('easytabs').ajax = $a.attr('href');
        } else {
          targetId = $a.attr('href');
        }
        targetId = targetId.match(/#([^\?]+)/)[0].substr(1);

        $matchingPanel = settings.panelContext.find("#" + targetId);

        // If tab has a matching panel, add it to panels
        if ( $matchingPanel.length ) {

          // Store panel height before hiding
          $matchingPanel.data('easytabs', {
            position: $matchingPanel.css('position'),
            visibility: $matchingPanel.css('visibility')
          });

          // Don't hide panel if it's active (allows `getTabs` to be called manually to re-instantiate tab collection)
          $matchingPanel.not(settings.panelActiveClass).hide();

          plugin.panels = plugin.panels.add($matchingPanel);

          $tab.data('easytabs').panel = $matchingPanel;

        // Otherwise, remove tab from tabs collection
        } else {
          plugin.tabs = plugin.tabs.not($tab);
        }
      });
    };

    // Select tab and fire callback
    plugin.selectTab = function($clicked, callback) {
      var url = window.location,
          hash = url.hash.match(/^[^\?]*/)[0],
          $targetPanel = $clicked.parent().data('easytabs').panel,
          ajaxUrl = $clicked.parent().data('easytabs').ajax;

      // Tab is collapsible and active => toggle collapsed state
      if( settings.collapsible && ! skipUpdateToHash && ($clicked.hasClass(settings.tabActiveClass) || $clicked.hasClass(settings.collapsedClass)) ) {
        plugin.toggleTabCollapse($clicked, $targetPanel, ajaxUrl, callback);

      // Tab is not active and panel is not active => select tab
      } else if( ! $clicked.hasClass(settings.tabActiveClass) || ! $targetPanel.hasClass(settings.panelActiveClass) ){
        activateTab($clicked, $targetPanel, ajaxUrl, callback);

      // Cache is disabled => reload (e.g reload an ajax tab).
      } else if ( ! settings.cache ){
        activateTab($clicked, $targetPanel, ajaxUrl, callback);
      }

    };

    // Toggle tab collapsed state and fire callback
    plugin.toggleTabCollapse = function($clicked, $targetPanel, ajaxUrl, callback) {
      plugin.panels.stop(true,true);

      if( fire($container,"easytabs:before", [$clicked, $targetPanel, settings]) ){
        plugin.tabs.filter("." + settings.tabActiveClass).removeClass(settings.tabActiveClass).children().removeClass(settings.tabActiveClass);

        // If panel is collapsed, uncollapse it
        if( $clicked.hasClass(settings.collapsedClass) ){

          // If ajax panel and not already cached
          if( ajaxUrl && (!settings.cache || !$clicked.parent().data('easytabs').cached) ) {
            $container.trigger('easytabs:ajax:beforeSend', [$clicked, $targetPanel]);

            $targetPanel.load(ajaxUrl, function(response, status, xhr){
              $clicked.parent().data('easytabs').cached = true;
              $container.trigger('easytabs:ajax:complete', [$clicked, $targetPanel, response, status, xhr]);
            });
          }

          // Update CSS classes of tab and panel
          $clicked.parent()
            .removeClass(settings.collapsedClass)
            .addClass(settings.tabActiveClass)
            .children()
              .removeClass(settings.collapsedClass)
              .addClass(settings.tabActiveClass);

          $targetPanel
            .addClass(settings.panelActiveClass)
            [transitions.uncollapse](transitions.speed, settings.transitionUncollapseEasing, function(){
              $container.trigger('easytabs:midTransition', [$clicked, $targetPanel, settings]);
              if(typeof callback == 'function') callback();
            });

        // Otherwise, collapse it
        } else {

          // Update CSS classes of tab and panel
          $clicked.addClass(settings.collapsedClass)
            .parent()
              .addClass(settings.collapsedClass);

          $targetPanel
            .removeClass(settings.panelActiveClass)
            [transitions.collapse](transitions.speed, settings.transitionCollapseEasing, function(){
              $container.trigger("easytabs:midTransition", [$clicked, $targetPanel, settings]);
              if(typeof callback == 'function') callback();
            });
        }
      }
    };


    // Find tab with target panel matching value
    plugin.matchTab = function(hash) {
      return plugin.tabs.find("[href='" + hash + "'],[data-target='" + hash + "']").first();
    };

    // Find panel with `id` matching value
    plugin.matchInPanel = function(hash) {
      return ( hash ? plugin.panels.filter(':has(' + hash + ')').first() : [] );
    };

    // Select matching tab when URL hash changes
    plugin.selectTabFromHashChange = function() {
      var hash = window.location.hash.match(/^[^\?]*/)[0],
          $tab = plugin.matchTab(hash),
          $panel;

      if ( settings.updateHash ) {

        // If hash directly matches tab
        if( $tab.length ){
          skipUpdateToHash = true;
          plugin.selectTab( $tab );

        } else {
          $panel = plugin.matchInPanel(hash);

          // If panel contains element matching hash
          if ( $panel.length ) {
            hash = '#' + $panel.attr('id');
            $tab = plugin.matchTab(hash);
            skipUpdateToHash = true;
            plugin.selectTab( $tab );

          // If default tab is not active...
          } else if ( ! $defaultTab.hasClass(settings.tabActiveClass) && ! settings.cycle ) {

            // ...and hash is blank or matches a parent of the tab container or
            // if the last tab (before the hash updated) was one of the other tabs in this container.
            if ( hash === '' || plugin.matchTab(lastHash).length || $container.closest(hash).length ) {
              skipUpdateToHash = true;
              plugin.selectTab( $defaultTabLink );
            }
          }
        }
      }
    };

    // Cycle through tabs
    plugin.cycleTabs = function(tabNumber){
      if(settings.cycle){
        tabNumber = tabNumber % plugin.tabs.length;
        $tab = $( plugin.tabs[tabNumber] ).children("a").first();
        skipUpdateToHash = true;
        plugin.selectTab( $tab, function() {
          setTimeout(function(){ plugin.cycleTabs(tabNumber + 1); }, settings.cycle);
        });
      }
    };

    // Convenient public methods
    plugin.publicMethods = {
      select: function(tabSelector){
        var $tab;

        // Find tab container that matches selector (like 'li#tab-one' which contains tab link)
        if ( ($tab = plugin.tabs.filter(tabSelector)).length === 0 ) {

          // Find direct tab link that matches href (like 'a[href="#panel-1"]')
          if ( ($tab = plugin.tabs.find("a[href='" + tabSelector + "']")).length === 0 ) {

            // Find direct tab link that matches selector (like 'a#tab-1')
            if ( ($tab = plugin.tabs.find("a" + tabSelector)).length === 0 ) {

              // Find direct tab link that matches data-target (lik 'a[data-target="#panel-1"]')
              if ( ($tab = plugin.tabs.find("[data-target='" + tabSelector + "']")).length === 0 ) {

                // Find direct tab link that ends in the matching href (like 'a[href$="#panel-1"]', which would also match http://example.com/currentpage/#panel-1)
                if ( ($tab = plugin.tabs.find("a[href$='" + tabSelector + "']")).length === 0 ) {

                  $.error('Tab \'' + tabSelector + '\' does not exist in tab set');
                }
              }
            }
          }
        } else {
          // Select the child tab link, since the first option finds the tab container (like <li>)
          $tab = $tab.children("a").first();
        }
        plugin.selectTab($tab);
      }
    };

    // =============================================================
    // Private functions
    // =============================================================

    // Triggers an event on an element and returns the event result
    var fire = function(obj, name, data) {
      var event = $.Event(name);
      obj.trigger(event, data);
      return event.result !== false;
    }

    // Add CSS classes to markup (if specified), called by init
    var addClasses = function() {
      $container.addClass(settings.containerClass);
      plugin.tabs.parent().addClass(settings.tabsClass);
      plugin.tabs.addClass(settings.tabClass);
      plugin.panels.addClass(settings.panelClass);
    };

    // Set the default tab, whether from hash (bookmarked) or option,
    // called by init
    var setDefaultTab = function(){
      var hash = window.location.hash.match(/^[^\?]*/)[0],
          $selectedTab = plugin.matchTab(hash).parent(),
          $panel;

      // If hash directly matches one of the tabs, active on page-load
      if( $selectedTab.length === 1 ){
        $defaultTab = $selectedTab;
        settings.cycle = false;

      } else {
        $panel = plugin.matchInPanel(hash);

        // If one of the panels contains the element matching the hash,
        // make it active on page-load
        if ( $panel.length ) {
          hash = '#' + $panel.attr('id');
          $defaultTab = plugin.matchTab(hash).parent();

        // Otherwise, make the default tab the one that's active on page-load
        } else {
          $defaultTab = plugin.tabs.parent().find(settings.defaultTab);
          if ( $defaultTab.length === 0 ) {
            $.error("The specified default tab ('" + settings.defaultTab + "') could not be found in the tab set.");
          }
        }
      }

      $defaultTabLink = $defaultTab.children("a").first();

      activateDefaultTab($selectedTab);
    };

    // Activate defaultTab (or collapse by default), called by setDefaultTab
    var activateDefaultTab = function($selectedTab) {
      var defaultPanel,
          defaultAjaxUrl;

      if ( settings.collapsible && $selectedTab.length === 0 && settings.collapsedByDefault ) {
        $defaultTab
          .addClass(settings.collapsedClass)
          .children()
            .addClass(settings.collapsedClass);

      } else {

        defaultPanel = $( $defaultTab.data('easytabs').panel );
        defaultAjaxUrl = $defaultTab.data('easytabs').ajax;

        if ( defaultAjaxUrl && (!settings.cache || !$defaultTab.data('easytabs').cached) ) {
          $container.trigger('easytabs:ajax:beforeSend', [$defaultTabLink, defaultPanel]);
          defaultPanel.load(defaultAjaxUrl, function(response, status, xhr){
            $defaultTab.data('easytabs').cached = true;
            $container.trigger('easytabs:ajax:complete', [$defaultTabLink, defaultPanel, response, status, xhr]);
          });
        }

        $defaultTab.data('easytabs').panel
          .show()
          .addClass(settings.panelActiveClass);

        $defaultTab
          .addClass(settings.tabActiveClass)
          .children()
            .addClass(settings.tabActiveClass);
      }
    };

    // Bind tab-select funtionality to namespaced click event, called by
    // init
    var bindToTabClicks = function() {
      plugin.tabs.children("a").bind("click.easytabs", function(e) {

        // Stop cycling when a tab is clicked
        settings.cycle = false;

        // Hash will be updated when tab is clicked,
        // don't cause tab to re-select when hash-change event is fired
        skipUpdateToHash = false;

        // Select the panel for the clicked tab
        plugin.selectTab( $(this) );

        // Don't follow the link to the anchor
        e.preventDefault();
      });
    };

    // Activate a given tab/panel, called from plugin.selectTab:
    //
    //   * fire `easytabs:before` hook
    //   * get ajax if new tab is an uncached ajax tab
    //   * animate out previously-active panel
    //   * fire `easytabs:midTransition` hook
    //   * update URL hash
    //   * animate in newly-active panel
    //   * update CSS classes for inactive and active tabs/panels
    //
    // TODO: This could probably be broken out into many more modular
    // functions
    var activateTab = function($clicked, $targetPanel, ajaxUrl, callback) {
      plugin.panels.stop(true,true);

      if( fire($container,"easytabs:before", [$clicked, $targetPanel, settings]) ){
        var $visiblePanel = plugin.panels.filter(":visible"),
            $panelContainer = $targetPanel.parent(),
            targetHeight,
            visibleHeight,
            heightDifference,
            showPanel,
            hash = window.location.hash.match(/^[^\?]*/)[0];

        if (settings.animate) {
          targetHeight = getHeightForHidden($targetPanel);
          visibleHeight = $visiblePanel.length ? setAndReturnHeight($visiblePanel) : 0;
          heightDifference = targetHeight - visibleHeight;
        }

        // Set lastHash to help indicate if defaultTab should be
        // activated across multiple tab instances.
        lastHash = hash;

        // TODO: Move this function elsewhere
        showPanel = function() {
          // At this point, the previous panel is hidden, and the new one will be selected
          $container.trigger("easytabs:midTransition", [$clicked, $targetPanel, settings]);

          // Gracefully animate between panels of differing heights, start height change animation *after* panel change if panel needs to contract,
          // so that there is no chance of making the visible panel overflowing the height of the target panel
          if (settings.animate && settings.transitionIn == 'fadeIn') {
            if (heightDifference < 0)
              $panelContainer.animate({
                height: $panelContainer.height() + heightDifference
              }, transitions.halfSpeed ).css({ 'min-height': '' });
          }

          if ( settings.updateHash && ! skipUpdateToHash ) {
            //window.location = url.toString().replace((url.pathname + hash), (url.pathname + $clicked.attr("href")));
            // Not sure why this behaves so differently, but it's more straight forward and seems to have less side-effects
            window.location.hash = '#' + $targetPanel.attr('id');
          } else {
            skipUpdateToHash = false;
          }

          $targetPanel
            [transitions.show](transitions.speed, settings.transitionInEasing, function(){
              $panelContainer.css({height: '', 'min-height': ''}); // After the transition, unset the height
              $container.trigger("easytabs:after", [$clicked, $targetPanel, settings]);
              // callback only gets called if selectTab actually does something, since it's inside the if block
              if(typeof callback == 'function'){
                callback();
              }
          });
        };

        if ( ajaxUrl && (!settings.cache || !$clicked.parent().data('easytabs').cached) ) {
          $container.trigger('easytabs:ajax:beforeSend', [$clicked, $targetPanel]);
          $targetPanel.load(ajaxUrl, function(response, status, xhr){
            $clicked.parent().data('easytabs').cached = true;
            $container.trigger('easytabs:ajax:complete', [$clicked, $targetPanel, response, status, xhr]);
          });
        }

        // Gracefully animate between panels of differing heights, start height change animation *before* panel change if panel needs to expand,
        // so that there is no chance of making the target panel overflowing the height of the visible panel
        if( settings.animate && settings.transitionOut == 'fadeOut' ) {
          if( heightDifference > 0 ) {
            $panelContainer.animate({
              height: ( $panelContainer.height() + heightDifference )
            }, transitions.halfSpeed );
          } else {
            // Prevent height jumping before height transition is triggered at midTransition
            $panelContainer.css({ 'min-height': $panelContainer.height() });
          }
        }

        // Change the active tab *first* to provide immediate feedback when the user clicks
        plugin.tabs.filter("." + settings.tabActiveClass).removeClass(settings.tabActiveClass).children().removeClass(settings.tabActiveClass);
        plugin.tabs.filter("." + settings.collapsedClass).removeClass(settings.collapsedClass).children().removeClass(settings.collapsedClass);
        $clicked.parent().addClass(settings.tabActiveClass).children().addClass(settings.tabActiveClass);

        plugin.panels.filter("." + settings.panelActiveClass).removeClass(settings.panelActiveClass);
        $targetPanel.addClass(settings.panelActiveClass);

        if( $visiblePanel.length ) {
          $visiblePanel
            [transitions.hide](transitions.speed, settings.transitionOutEasing, showPanel);
        } else {
          $targetPanel
            [transitions.uncollapse](transitions.speed, settings.transitionUncollapseEasing, showPanel);
        }
      }
    };

    // Get heights of panels to enable animation between panels of
    // differing heights, called by activateTab
    var getHeightForHidden = function($targetPanel){

      if ( $targetPanel.data('easytabs') && $targetPanel.data('easytabs').lastHeight ) {
        return $targetPanel.data('easytabs').lastHeight;
      }

      // this is the only property easytabs changes, so we need to grab its value on each tab change
      var display = $targetPanel.css('display'),

          // Workaround, because firefox returns wrong height if element itself has absolute positioning
          height = $targetPanel
            .wrap($('<div>', {position: 'absolute', 'visibility': 'hidden', 'overflow': 'hidden'}))
            .css({'position':'relative','visibility':'hidden','display':'block'})
            .outerHeight();

      $targetPanel.unwrap();

      // Return element to previous state
      $targetPanel.css({
        position: $targetPanel.data('easytabs').position,
        visibility: $targetPanel.data('easytabs').visibility,
        display: display
      });

      // Cache height
      $targetPanel.data('easytabs').lastHeight = height;

      return height;
    };

    // Since the height of the visible panel may have been manipulated due to interaction,
    // we want to re-cache the visible height on each tab change, called
    // by activateTab
    var setAndReturnHeight = function($visiblePanel) {
      var height = $visiblePanel.outerHeight();

      if( $visiblePanel.data('easytabs') ) {
        $visiblePanel.data('easytabs').lastHeight = height;
      } else {
        $visiblePanel.data('easytabs', {lastHeight: height});
      }
      return height;
    };

    // Setup hash-change callback for forward- and back-button
    // functionality, called by init
    var initHashChange = function(){

      // enabling back-button with jquery.hashchange plugin
      // http://benalman.com/projects/jquery-hashchange-plugin/
      if(typeof $(window).hashchange === 'function'){
        $(window).hashchange( function(){
          plugin.selectTabFromHashChange();
        });
      } else if ($.address && typeof $.address.change === 'function') { // back-button with jquery.address plugin http://www.asual.com/jquery/address/docs/
        $.address.change( function(){
          plugin.selectTabFromHashChange();
        });
      }
    };

    // Begin cycling if set in options, called by init
    var initCycle = function(){
      var tabNumber;
      if (settings.cycle) {
        tabNumber = plugin.tabs.index($defaultTab);
        setTimeout( function(){ plugin.cycleTabs(tabNumber + 1); }, settings.cycle);
      }
    };


    plugin.init();

  };

  $.fn.easytabs = function(options) {
    var args = arguments;

    return this.each(function() {
      var $this = $(this),
          plugin = $this.data('easytabs');

      // Initialization was called with $(el).easytabs( { options } );
      if (undefined === plugin) {
        plugin = new $.easytabs(this, options);
        $this.data('easytabs', plugin);
      }

      // User called public method
      if ( plugin.publicMethods[options] ){
        return plugin.publicMethods[options](Array.prototype.slice.call( args, 1 ));
      }
    });
  };

})(jQuery);

/*
 * Parsley.js allows you to verify your form inputs frontend side, without writing a line of javascript. Or so..
 *
 * Author: Guillaume Potier - @guillaumepotier
*/

!function ($) {

  'use strict';

  /**
  * Validator class stores all constraints functions and associated messages.
  * Provides public interface to add, remove or modify them
  *
  * @class Validator
  * @constructor
  */
  var Validator = function ( options ) {
    /**
    * Error messages
    *
    * @property messages
    * @type {Object}
    */
    this.messages = {
        defaultMessage: "*This value seems to be invalid."
      , type: {
            email:      "*This value should be a valid email."
          , url:        "*This value should be a valid url."
          , urlstrict:  "*This value should be a valid url."
          , number:     "*This value should be a valid number."
          , digits:     "*This value should be digits."
          , dateIso:    "*This value should be a valid date (YYYY-MM-DD)."
          , alphanum:   "*This value should be alphanumeric."
          , phone:      "*This value should be a valid phone number."
        }
      , notnull:        "*This value should not be null."
      , notblank:       "*This value should not be blank."
      , required:       "*This value is required."
      , regexp:         "*This value seems to be invalid."
      , min:            "*This value should be greater than or equal to %s."
      , max:            "*This value should be lower than or equal to %s."
      , range:          "*This value should be between %s and %s."
      , minlength:      "*This value is too short. It should have %s characters or more."
      , maxlength:      "*This value is too long. It should have %s characters or less."
      , rangelength:    "*This value length is invalid. It should be between %s and %s characters long."
      , mincheck:       "*You must select at least %s choices."
      , maxcheck:       "*You must select %s choices or less."
      , rangecheck:     "*You must select between %s and %s choices."
      , equalto:        "*This value should be the same."
    },

    this.init( options );
  };

  Validator.prototype = {

    constructor: Validator

    /**
    * Validator list. Built-in validators functions
    *
    * @property validators
    * @type {Object}
    */
    , validators: {
      notnull: function ( val ) {
        return val.length > 0;
      }

      , notblank: function ( val ) {
        return 'string' === typeof val && '' !== val.replace( /^\s+/g, '' ).replace( /\s+$/g, '' );
      }

      // Works on all inputs. val is object for checkboxes
      , required: function ( val ) {

        // for checkboxes and select multiples. Check there is at least one required value
        if ( 'object' === typeof val ) {
          for ( var i in val ) {
            if ( this.required( val[ i ] ) ) {
              return true;
            }
          }

          return false;
        }

        return this.notnull( val ) && this.notblank( val );
      }

      , type: function ( val, type ) {
        var regExp;

        switch ( type ) {
          case 'number':
            regExp = /^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/;
            break;
          case 'digits':
            regExp = /^\d+$/;
            break;
          case 'alphanum':
            regExp = /^\w+$/;
            break;
          case 'email':
            regExp = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i;
            break;
          case 'url':
            val = new RegExp( '(https?|s?ftp|git)', 'i' ).test( val ) ? val : 'http://' + val;
            /* falls through */
          case 'urlstrict':
            regExp = /^(https?|s?ftp|git):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;
            break;
          case 'dateIso':
            regExp = /^(\d{4})\D?(0[1-9]|1[0-2])\D?([12]\d|0[1-9]|3[01])$/;
            break;
          case 'phone':
            regExp = /^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$/;
            break;
          default:
            return false;
        }

        // test regExp if not null
        return '' !== val ? regExp.test( val ) : false;
      }

      , regexp: function ( val, regExp, self ) {
        return new RegExp( regExp, self.options.regexpFlag || '' ).test( val );
      }

      , minlength: function ( val, min ) {
        return val.length >= min;
      }

      , maxlength: function ( val, max ) {
        return val.length <= max;
      }

      , rangelength: function ( val, arrayRange ) {
        return this.minlength( val, arrayRange[ 0 ] ) && this.maxlength( val, arrayRange[ 1 ] );
      }

      , min: function ( val, min ) {
        return Number( val ) >= min;
      }

      , max: function ( val, max ) {
        return Number( val ) <= max;
      }

      , range: function ( val, arrayRange ) {
        return val >= arrayRange[ 0 ] && val <= arrayRange[ 1 ];
      }

      , equalto: function ( val, elem, self ) {
        self.options.validateIfUnchanged = true;

        return val === $( elem ).val();
      }

      , remote: function ( val, url, self ) {
        var result = null
          , data = {}
          , dataType = {};

        data[ self.$element.attr( 'name' ) ] = val;

        if ( 'undefined' !== typeof self.options.remoteDatatype ) {
          dataType = { dataType: self.options.remoteDatatype };
        }

        var manage = function ( isConstraintValid, message ) {
          // remove error message if we got a server message, different from previous message
          if ( 'undefined' !== typeof message && 'undefined' !== typeof self.Validator.messages.remote && message !== self.Validator.messages.remote ) {
            $( self.ulError + ' .remote' ).remove();
          }

          self.updtConstraint( { name: 'remote', valid: isConstraintValid }, message );
          self.manageValidationResult();
        };

        // transform string response into object
        var handleResponse = function ( response ) {
          if ( 'object' === typeof response ) {
            return response;
          }

          try {
            response = $.parseJSON( response );
          } catch ( err ) {}

          return response;
        }

        var manageErrorMessage = function ( response ) {
          return 'object' === typeof response && null !== response ? ( 'undefined' !== typeof response.error ? response.error : ( 'undefined' !== typeof response.message ? response.message : null ) ) : null;
        }

        $.ajax( $.extend( {}, {
            url: url
          , data: data
          , type: self.options.remoteMethod || 'GET'
          , success: function ( response ) {
            response = handleResponse( response );
            manage( 1 === response || true === response || ( 'object' === typeof response && null !== response && 'undefined' !== typeof response.success ), manageErrorMessage( response )
            );
          }
          , error: function ( response ) {
            response = handleResponse( response );
            manage( false, manageErrorMessage( response ) );
          }
        }, dataType ) );

        return result;
      }

      /**
      * Aliases for checkboxes constraints
      */
      , mincheck: function ( obj, val ) {
        return this.minlength( obj, val );
      }

      , maxcheck: function ( obj, val ) {
        return this.maxlength( obj, val);
      }

      , rangecheck: function ( obj, arrayRange ) {
        return this.rangelength( obj, arrayRange );
      }
    }

    /*
    * Register custom validators and messages
    */
    , init: function ( options ) {
      var customValidators = options.validators
        , customMessages = options.messages;

      var key;
      for ( key in customValidators ) {
        this.addValidator(key, customValidators[ key ]);
      }

      for ( key in customMessages ) {
        this.addMessage(key, customMessages[ key ]);
      }
    }

    /**
    * Replace %s placeholders by values
    *
    * @method formatMesssage
    * @param {String} message Message key
    * @param {Mixed} args Args passed by validators functions. Could be string, number or object
    * @return {String} Formatted string
    */
    , formatMesssage: function ( message, args ) {

      if ( 'object' === typeof args ) {
        for ( var i in args ) {
          message = this.formatMesssage( message, args[ i ] );
        }

        return message;
      }

      return 'string' === typeof message ? message.replace( new RegExp( '%s', 'i' ), args ) : '';
    }

    /**
    * Add / override a validator in validators list
    *
    * @method addValidator
    * @param {String} name Validator name. Will automatically bindable through data-name=''
    * @param {Function} fn Validator function. Must return {Boolean}
    */
    , addValidator: function ( name, fn ) {
      this.validators[ name ] = fn;
    }

    /**
    * Add / override error message
    *
    * @method addMessage
    * @param {String} name Message name. Will automatically be binded to validator with same name
    * @param {String} message Message
    */
    , addMessage: function ( key, message, type ) {

      if ( 'undefined' !== typeof type && true === type ) {
        this.messages.type[ key ] = message;
        return;
      }

      // custom types messages are a bit tricky cuz' nested ;)
      if ( 'type' === key ) {
        for ( var i in message ) {
          this.messages.type[ i ] = message[ i ];
        }

        return;
      }

      this.messages[ key ] = message;
    }
  };

  /**
  * ParsleyField class manage each form field inside a validated Parsley form.
  * Returns if field valid or not depending on its value and constraints
  * Manage field error display and behavior, event triggers and more
  *
  * @class ParsleyField
  * @constructor
  */
  var ParsleyField = function ( element, options, type ) {
    this.options = options;
    this.Validator = new Validator( options );

    // if type is ParsleyFieldMultiple, just return this. used for clone
    if ( type === 'ParsleyFieldMultiple' ) {
      return this;
    }

    this.init( element, type || 'ParsleyField' );
  };

  ParsleyField.prototype = {

    constructor: ParsleyField

    /**
    * Set some properties, bind constraint validators and validation events
    *
    * @method init
    * @param {Object} element
    * @param {Object} options
    */
    , init: function ( element, type ) {
      this.type = type;
      this.valid = true;
      this.element = element;
      this.validatedOnce = false;
      this.$element = $( element );
      this.val = this.$element.val();
      this.isRequired = false;
      this.constraints = {};

      // overriden by ParsleyItemMultiple if radio or checkbox input
      if ( 'undefined' === typeof this.isRadioOrCheckbox ) {
        this.isRadioOrCheckbox = false;
        this.hash = this.generateHash();
        this.errorClassHandler = this.options.errors.classHandler( element, this.isRadioOrCheckbox ) || this.$element;
      }

      // error ul dom management done only once at init
      this.ulErrorManagement();

      // bind some html5 properties
      this.bindHtml5Constraints();

      // bind validators to field
      this.addConstraints();

      // bind parsley events if validators have been registered
      if ( this.hasConstraints() ) {
        this.bindValidationEvents();
      }
    }

    , setParent: function ( elem ) {
      this.$parent = $( elem );
    }

    , getParent: function () {
      return this.$parent;
    }

    /**
    * Bind some extra html5 types / validators
    *
    * @private
    * @method bindHtml5Constraints
    */
    , bindHtml5Constraints: function () {
      // add html5 required support + class required support
      if ( this.$element.hasClass( 'required' ) || this.$element.prop( 'required' ) ) {
        this.options.required = true;
      }

      // add html5 supported types & options
      if ( 'undefined' !== typeof this.$element.attr( 'type' ) && new RegExp( this.$element.attr( 'type' ), 'i' ).test( 'email url number range' ) ) {
        this.options.type = this.$element.attr( 'type' );

        // number and range types could have min and/or max values
        if ( new RegExp( this.options.type, 'i' ).test( 'number range' ) ) {
          this.options.type = 'number';

          // double condition to support jQuery and Zepto.. :(
          if ( 'undefined' !== typeof this.$element.attr( 'min' ) && this.$element.attr( 'min' ).length ) {
            this.options.min = this.$element.attr( 'min' );
          }

          if ( 'undefined' !== typeof this.$element.attr( 'max' ) && this.$element.attr( 'max' ).length ) {
            this.options.max = this.$element.attr( 'max' );
          }
        }
      }

      if ( 'string' === typeof this.$element.attr( 'pattern' ) && this.$element.attr( 'pattern' ).length ) {
          this.options.regexp = this.$element.attr( 'pattern' );
      }

    }

    /**
    * Attach field validators functions passed through data-api
    *
    * @private
    * @method addConstraints
    */
    , addConstraints: function () {
      for ( var constraint in this.options ) {
        var addConstraint = {};
        addConstraint[ constraint ] = this.options[ constraint ];
        this.addConstraint( addConstraint, true );
      }
    }

    /**
    * Dynamically add a new constraint to a field
    *
    * @method addConstraint
    * @param {Object} constraint { name: requirements }
    */
    , addConstraint: function ( constraint, doNotUpdateValidationEvents ) {
        for ( var name in constraint ) {
          name = name.toLowerCase();

          if ( 'function' === typeof this.Validator.validators[ name ] ) {
            this.constraints[ name ] = {
                name: name
              , requirements: constraint[ name ]
              , valid: null
            }

            if ( name === 'required' ) {
              this.isRequired = true;
            }

            this.addCustomConstraintMessage( name );
          }
        }

        // force field validation next check and reset validation events
        if ( 'undefined' === typeof doNotUpdateValidationEvents ) {
          this.bindValidationEvents();
        }
    }

    /**
    * Dynamically update an existing constraint to a field.
    * Simple API: { name: requirements }
    *
    * @method updtConstraint
    * @param {Object} constraint
    */
    , updateConstraint: function ( constraint, message ) {
      for ( var name in constraint ) {
        this.updtConstraint( { name: name, requirements: constraint[ name ], valid: null }, message );
      }
    }

    /**
    * Dynamically update an existing constraint to a field.
    * Complex API: { name: name, requirements: requirements, valid: boolean }
    *
    * @method updtConstraint
    * @param {Object} constraint
    */
    , updtConstraint: function ( constraint, message ) {
      this.constraints[ constraint.name ] = $.extend( true, this.constraints[ constraint.name ], constraint );

      if ( 'string' === typeof message ) {
        this.Validator.messages[ constraint.name ] = message ;
      }

      // force field validation next check and reset validation events
      this.bindValidationEvents();
    }

    /**
    * Dynamically remove an existing constraint to a field.
    *
    * @method removeConstraint
    * @param {String} constraintName
    */
    , removeConstraint: function ( constraintName ) {
      var constraintName = constraintName.toLowerCase();

      delete this.constraints[ constraintName ];

      if ( constraintName === 'required' ) {
        this.isRequired = false;
      }

      // if there are no more constraint, destroy parsley instance for this field
      if ( !this.hasConstraints() ) {
        // in a form context, remove item from parent
        if ( 'ParsleyForm' === typeof this.getParent() ) {
          this.getParent().removeItem( this.$element );
          return;
        }

        this.destroy();
        return;
      }

      this.bindValidationEvents();
    }

    /**
    * Add custom constraint message, passed through data-API
    *
    * @private
    * @method addCustomConstraintMessage
    * @param constraint
    */
    , addCustomConstraintMessage: function ( constraint ) {
      // custom message type data-type-email-message -> typeEmailMessage | data-minlength-error => minlengthMessage
      var customMessage = constraint
        + ( 'type' === constraint && 'undefined' !== typeof this.options[ constraint ] ? this.options[ constraint ].charAt( 0 ).toUpperCase() + this.options[ constraint ].substr( 1 ) : '' )
        + 'Message';

      if ( 'undefined' !== typeof this.options[ customMessage ] ) {
        this.Validator.addMessage( 'type' === constraint ? this.options[ constraint ] : constraint, this.options[ customMessage ], 'type' === constraint );
      }
    }

    /**
    * Bind validation events on a field
    *
    * @private
    * @method bindValidationEvents
    */
    , bindValidationEvents: function () {
      // this field has validation events, that means it has to be validated
      this.valid = null;
      this.$element.addClass( 'parsley-validated' );

      // remove eventually already binded events
      this.$element.off( '.' + this.type );

      // force add 'change' event if async remote validator here to have result before form submitting
      if ( this.options.remote && !new RegExp( 'change', 'i' ).test( this.options.trigger ) ) {
        this.options.trigger = !this.options.trigger ? 'change' : ' change';
      }

      // alaways bind keyup event, for better UX when a field is invalid
      var triggers = ( !this.options.trigger ? '' : this.options.trigger )
        + ( new RegExp( 'key', 'i' ).test( this.options.trigger ) ? '' : ' keyup' );

      // alaways bind change event, for better UX when a select is invalid
      if ( this.$element.is( 'select' ) ) {
        triggers += new RegExp( 'change', 'i' ).test( triggers ) ? '' : ' change';
      }

      // trim triggers to bind them correctly with .on()
      triggers = triggers.replace( /^\s+/g , '' ).replace( /\s+$/g , '' );

      this.$element.on( ( triggers + ' ' ).split( ' ' ).join( '.' + this.type + ' ' ), false, $.proxy( this.eventValidation, this ) );
    }

    /**
    * Hash management. Used for ul error
    *
    * @method generateHash
    * @returns {String} 5 letters unique hash
    */
    , generateHash: function () {
      return 'parsley-' + ( Math.random() + '' ).substring( 2 );
    }

    /**
    * Public getHash accessor
    *
    * @method getHash
    * @returns {String} hash
    */
    , getHash: function () {
      return this.hash;
    }

    /**
    * Returns field val needed for validation
    * Special treatment for radio & checkboxes
    *
    * @method getVal
    * @returns {String} val
    */
    , getVal: function () {
      return this.$element.data('value') || this.$element.val();
    }

    /**
    * Called when validation is triggered by an event
    * Do nothing if val.length < this.options.validationMinlength
    *
    * @method eventValidation
    * @param {Object} event jQuery event
    */
    , eventValidation: function ( event ) {
      var val = this.getVal();

      // do nothing on keypress event if not explicitely passed as data-trigger and if field has not already been validated once
      if ( event.type === 'keyup' && !/keyup/i.test( this.options.trigger ) && !this.validatedOnce ) {
        return true;
      }

      // do nothing on change event if not explicitely passed as data-trigger and if field has not already been validated once
      if ( event.type === 'change' && !/change/i.test( this.options.trigger ) && !this.validatedOnce ) {
        return true;
      }

      // start validation process only if field has enough chars and validation never started
      if ( !this.isRadioOrCheckbox && val.length < this.options.validationMinlength && !this.validatedOnce ) {
        return true;
      }

      this.validate();
    }

    /**
    * Return if field verify its constraints
    *
    * @method isValid
    * @return {Boolean} Is field valid or not
    */
    , isValid: function () {
      return this.validate( false );
    }

    /**
    * Return if field has constraints
    *
    * @method hasConstraints
    * @return {Boolean} Is field has constraints or not
    */
    , hasConstraints: function () {
      for ( var constraint in this.constraints ) {
        return true;
      }

      return false;
    }

    /**
    * Validate a field & display errors
    *
    * @method validate
    * @param {Boolean} errorBubbling set to false if you just want valid boolean without error bubbling next to fields
    * @return {Boolean} Is field valid or not
    */
    , validate: function ( errorBubbling ) {
      var val = this.getVal()
        , valid = null;

      // do not even bother trying validating a field w/o constraints
      if ( !this.hasConstraints() ) {
        return null;
      }

      // reset Parsley validation if onFieldValidate returns true, or if field is empty and not required
      if ( this.options.listeners.onFieldValidate( this.element, this ) || ( '' === val && !this.isRequired ) ) {
        this.reset();
        return null;
      }

      // do not validate a field already validated and unchanged !
      if ( !this.needsValidation( val ) ) {
        return this.valid;
      }

      valid = this.applyValidators();

      if ( 'undefined' !== typeof errorBubbling ? errorBubbling : this.options.showErrors ) {
        this.manageValidationResult();
      }

      return valid;
    }

    /**
    * Check if value has changed since previous validation
    *
    * @method needsValidation
    * @param value
    * @return {Boolean}
    */
    , needsValidation: function ( val ) {
      if ( !this.options.validateIfUnchanged && this.valid !== null && this.val === val && this.validatedOnce ) {
        return false;
      }

      this.val = val;
      return this.validatedOnce = true;
    }

    /**
    * Loop through every fields validators
    * Adds errors after unvalid fields
    *
    * @method applyValidators
    * @return {Mixed} {Boolean} If field valid or not, null if not validated
    */
    , applyValidators: function () {
      var valid = null;

      for ( var constraint in this.constraints ) {
        var result = this.Validator.validators[ this.constraints[ constraint ].name ]( this.val, this.constraints[ constraint ].requirements, this );

        if ( false === result ) {
          valid = false;
          this.constraints[ constraint ].valid = valid;
          this.options.listeners.onFieldError( this.element, this.constraints, this );
        } else if ( true === result ) {
          this.constraints[ constraint ].valid = true;
          valid = false !== valid;
          this.options.listeners.onFieldSuccess( this.element, this.constraints, this );
        }
      }

      return valid;
    }

    /**
    * Fired when all validators have be executed
    * Returns true or false if field is valid or not
    * Display errors messages below failed fields
    * Adds parsley-success or parsley-error class on fields
    *
    * @method manageValidationResult
    * @return {Boolean} Is field valid or not
    */
    , manageValidationResult: function () {
      var valid = null;

      for ( var constraint in this.constraints ) {
        if ( false === this.constraints[ constraint ].valid ) {
          this.manageError( this.constraints[ constraint ] );
          valid = false;
        } else if ( true === this.constraints[ constraint ].valid ) {
          this.removeError( this.constraints[ constraint ].name );
          valid = false !== valid;
        }
      }

      this.valid = valid;

      if ( true === this.valid ) {
        this.removeErrors();
        this.errorClassHandler.removeClass( this.options.errorClass ).addClass( this.options.successClass );
        return true;
      } else if ( false === this.valid ) {
        this.errorClassHandler.removeClass( this.options.successClass ).addClass( this.options.errorClass );
        return false;
      }

      return valid;
    }

    /**
    * Manage ul error Container
    *
    * @private
    * @method ulErrorManagement
    */
    , ulErrorManagement: function () {
      this.ulError = '#' + this.hash;
      this.ulTemplate = $( this.options.errors.errorsWrapper ).attr( 'id', this.hash ).addClass( 'parsley-error-list' );
    }

    /**
    * Remove li / ul error
    *
    * @method removeError
    * @param {String} constraintName Method Name
    */
    , removeError: function ( constraintName ) {
      var liError = this.ulError + ' .' + constraintName
        , that = this;

      this.options.animate ? $( liError ).fadeOut( this.options.animateDuration, function () {
        $( this ).remove();

        if ( that.ulError && $( that.ulError ).children().length === 0 ) {
          that.removeErrors();
        } } ) : $( liError ).remove();

      // remove li error, and ul error if no more li inside
      if ( this.ulError && $( this.ulError ).children().length === 0 ) {
        this.removeErrors();
      }
    }

    /**
    * Add li error
    *
    * @method addError
    * @param {Object} { minlength: "error message for minlength constraint" }
    */
    , addError: function ( error ) {
      for ( var constraint in error ) {
        var liTemplate = $( this.options.errors.errorElem ).addClass( constraint );

        $( this.ulError ).append( this.options.animate ? $( liTemplate ).html( error[ constraint ] ).hide().fadeIn( this.options.animateDuration ) : $( liTemplate ).html( error[ constraint ] ) );
      }
    }

    /**
    * Remove all ul / li errors
    *
    * @method removeErrors
    */
    , removeErrors: function () {
      this.options.animate ? $( this.ulError ).fadeOut( this.options.animateDuration, function () { $( this ).remove(); } ) : $( this.ulError ).remove();
    }

    /**
    * Remove ul errors and parsley error or success classes
    *
    * @method reset
    */
    , reset: function () {
      this.valid = null;
      this.removeErrors();
      this.validatedOnce = false;
      this.errorClassHandler.removeClass( this.options.successClass ).removeClass( this.options.errorClass );

      for ( var constraint in this.constraints ) {
        this.constraints[ constraint ].valid = null;
      }

      return this;
    }

    /**
    * Add li / ul errors messages
    *
    * @method manageError
    * @param {Object} constraint
    */
    , manageError: function ( constraint ) {
      // display ulError container if it has been removed previously (or never shown)
      if ( !$( this.ulError ).length ) {
        this.manageErrorContainer();
      }

      // TODO: refacto properly
      // if required constraint but field is not null, do not display
      if ( 'required' === constraint.name && null !== this.getVal() && this.getVal().length > 0 ) {
        return;
      // if empty required field and non required constraint fails, do not display
      } else if ( this.isRequired && 'required' !== constraint.name && ( null === this.getVal() || 0 === this.getVal().length ) ) {
        return;
      }

      // TODO: refacto error name w/ proper & readable function
      var constraintName = constraint.name
        , liClass = false !== this.options.errorMessage ? 'custom-error-message' : constraintName
        , liError = {}
        , message = false !== this.options.errorMessage ? this.options.errorMessage : ( constraint.name === 'type' ?
            this.Validator.messages[ constraintName ][ constraint.requirements ] : ( 'undefined' === typeof this.Validator.messages[ constraintName ] ?
              this.Validator.messages.defaultMessage : this.Validator.formatMesssage( this.Validator.messages[ constraintName ], constraint.requirements ) ) );

      // add liError if not shown. Do not add more than once custom errorMessage if exist
      if ( !$( this.ulError + ' .' + liClass ).length ) {
        liError[ liClass ] = message;
        this.addError( liError );
      }
    }

    /**
    * Create ul error container
    *
    * @method manageErrorContainer
    */
    , manageErrorContainer: function () {
      var errorContainer = this.options.errorContainer || this.options.errors.container( this.element, this.isRadioOrCheckbox )
        , ulTemplate = this.options.animate ? this.ulTemplate.show() : this.ulTemplate;

      if ( 'undefined' !== typeof errorContainer ) {
        $( errorContainer ).append( ulTemplate );
        return;
      }

      !this.isRadioOrCheckbox ? this.$element.after( ulTemplate ) : this.$element.parent().after( ulTemplate );
    }

    /**
    * Add custom listeners
    *
    * @param {Object} { listener: function () {} }, eg { onFormSubmit: function ( valid, event, focus ) { ... } }
    */
    , addListener: function ( object ) {
      for ( var listener in object ) {
        this.options.listeners[ listener ] = object[ listener ];
      }
    }

    /**
    * Destroy parsley field instance
    *
    * @private
    * @method destroy
    */
    , destroy: function () {
      this.$element.removeClass( 'parsley-validated' );
      this.reset().$element.off( '.' + this.type ).removeData( this.type );
    }
  };

  /**
  * ParsleyFieldMultiple override ParsleyField for checkbox and radio inputs
  * Pseudo-heritance to manage divergent behavior from ParsleyItem in dedicated methods
  *
  * @class ParsleyFieldMultiple
  * @constructor
  */
  var ParsleyFieldMultiple = function ( element, options, type ) {
    this.initMultiple( element, options );
    this.inherit( element, options );
    this.Validator = new Validator( options );

    // call ParsleyField constructor
    this.init( element, type || 'ParsleyFieldMultiple' );
  };

  ParsleyFieldMultiple.prototype = {

    constructor: ParsleyFieldMultiple

    /**
    * Set some specific properties, call some extra methods to manage radio / checkbox
    *
    * @method init
    * @param {Object} element
    * @param {Object} options
    */
    , initMultiple: function ( element, options ) {
      this.element = element;
      this.$element = $( element );
      this.group = options.group || false;
      this.hash = this.getName();
      this.siblings = this.group ? '[data-group="' + this.group + '"]' : 'input[name="' + this.$element.attr( 'name' ) + '"]';
      this.isRadioOrCheckbox = true;
      this.isRadio = this.$element.is( 'input[type=radio]' );
      this.isCheckbox = this.$element.is( 'input[type=checkbox]' );
      this.errorClassHandler = options.errors.classHandler( element, this.isRadioOrCheckbox ) || this.$element.parent();
    }

    /**
    * Set specific constraints messages, do pseudo-heritance
    *
    * @private
    * @method inherit
    * @param {Object} element
    * @param {Object} options
    */
    , inherit: function ( element, options ) {
      var clone = new ParsleyField( element, options, 'ParsleyFieldMultiple' );

      for ( var property in clone ) {
        if ( 'undefined' === typeof this[ property ] ) {
          this[ property ] = clone [ property ];
        }
      }
    }

    /**
    * Set specific constraints messages, do pseudo-heritance
    *
    * @method getName
    * @returns {String} radio / checkbox hash is cleaned 'name' or data-group property
    */
   , getName: function () {
     if ( this.group ) {
       return 'parsley-' + this.group;
     }

     if ( 'undefined' === typeof this.$element.attr( 'name' ) ) {
       throw "A radio / checkbox input must have a data-group attribute or a name to be Parsley validated !";
     }

     return 'parsley-' + this.$element.attr( 'name' ).replace( /(:|\.|\[|\])/g, '' );
   }

   /**
   * Special treatment for radio & checkboxes
   * Returns checked radio or checkboxes values
   *
   * @method getVal
   * @returns {String} val
   */
   , getVal: function () {
      if ( this.isRadio ) {
        return $( this.siblings + ':checked' ).val() || '';
      }

      if ( this.isCheckbox ) {
        var values = [];

        $( this.siblings + ':checked' ).each( function () {
          values.push( $( this ).val() );
        } );

        return values;
      }
   }

   /**
   * Bind validation events on a field
   *
   * @private
   * @method bindValidationEvents
   */
   , bindValidationEvents: function () {
     // this field has validation events, that means it has to be validated
     this.valid = null;
     this.$element.addClass( 'parsley-validated' );

     // remove eventually already binded events
     this.$element.off( '.' + this.type );

      // alaways bind keyup event, for better UX when a field is invalid
      var self = this
        , triggers = ( !this.options.trigger ? '' : this.options.trigger )
        + ( new RegExp( 'change', 'i' ).test( this.options.trigger ) ? '' : ' change' );

      // trim triggers to bind them correctly with .on()
      triggers = triggers.replace( /^\s+/g , '' ).replace( /\s+$/g ,'' );

     // bind trigger event on every siblings
     $( this.siblings ).each(function () {
       $( this ).on( triggers.split( ' ' ).join( '.' + self.type + ' ' ) , false, $.proxy( self.eventValidation, self ) );
     } )
   }
  };

  /**
  * ParsleyForm class manage Parsley validated form.
  * Manage its fields and global validation
  *
  * @class ParsleyForm
  * @constructor
  */
  var ParsleyForm = function ( element, options, type ) {
    this.init( element, options, type || 'parsleyForm' );
  };

  ParsleyForm.prototype = {

    constructor: ParsleyForm

    /* init data, bind jQuery on() actions */
    , init: function ( element, options, type ) {
      this.type = type;
      this.items = [];
      this.$element = $( element );
      this.options = options;
      var self = this;

      this.$element.find( options.inputs ).each( function () {
        self.addItem( this );
      });

      this.$element.on( 'submit.' + this.type , false, $.proxy( this.validate, this ) );
    }

    /**
    * Add custom listeners
    *
    * @param {Object} { listener: function () {} }, eg { onFormSubmit: function ( valid, event, focus ) { ... } }
    */
    , addListener: function ( object ) {
      for ( var listener in object ) {
        if ( new RegExp( 'Field' ).test( listener ) ) {
          for ( var item = 0; item < this.items.length; item++ ) {
            this.items[ item ].addListener( object );
          }
        } else {
          this.options.listeners[ listener ] = object[ listener ];
        }
      }
    }

    /**
    * Adds a new parsleyItem child to ParsleyForm
    *
    * @method addItem
    * @param elem
    */
    , addItem: function ( elem ) {
      if ( $( elem ).is( this.options.excluded ) ) {
        return false;
      }

      var ParsleyField = $( elem ).parsley( this.options );
      ParsleyField.setParent( this );

      this.items.push( ParsleyField );
    }

    /**
    * Removes a parsleyItem child from ParsleyForm
    *
    * @method removeItem
    * @param elem
    * @return {Boolean}
    */
    , removeItem: function ( elem ) {
      var parsleyItem = $( elem ).parsley();

      // identify & remove item if same Parsley hash
      for ( var i = 0; i < this.items.length; i++ ) {
        if ( this.items[ i ].hash === parsleyItem.hash ) {
          this.items[ i ].destroy();
          this.items.splice( i, 1 );
          return true;
        }
      }

      return false;
    }

    /**
    * Process each form field validation
    * Display errors, call custom onFormSubmit() function
    *
    * @method validate
    * @param {Object} event jQuery Event
    * @return {Boolean} Is form valid or not
    */
    , validate: function ( event ) {
      var valid = true;
      this.focusedField = false;

      for ( var item = 0; item < this.items.length; item++ ) {
        if ( 'undefined' !== typeof this.items[ item ] && false === this.items[ item ].validate() ) {
          valid = false;

          if ( !this.focusedField && 'first' === this.options.focus || 'last' === this.options.focus ) {
            this.focusedField = this.items[ item ].$element;
          }
        }
      }

      // form is invalid, focus an error field depending on focus policy
      if ( this.focusedField && !valid ) {
        this.focusedField.focus();
      }

      this.options.listeners.onFormSubmit( valid, event, this );

      return valid;
    }

    , isValid: function () {
      for ( var item = 0; item < this.items.length; item++ ) {
        if ( false === this.items[ item ].isValid() ) {
          return false;
        }
      }

      return true;
    }

    /**
    * Remove all errors ul under invalid fields
    *
    * @method removeErrors
    */
    , removeErrors: function () {
      for ( var item = 0; item < this.items.length; item++ ) {
        this.items[ item ].parsley( 'reset' );
      }
    }

    /**
    * destroy Parsley binded on the form and its fields
    *
    * @method destroy
    */
    , destroy: function () {
      for ( var item = 0; item < this.items.length; item++ ) {
        this.items[ item ].destroy();
      }

      this.$element.off( '.' + this.type ).removeData( this.type );
    }

    /**
    * reset Parsley binded on the form and its fields
    *
    * @method reset
    */
    , reset: function () {
      for ( var item = 0; item < this.items.length; item++ ) {
        this.items[ item ].reset();
      }
    }
  };

  /**
  * Parsley plugin definition
  * Provides an interface to access public Validator, ParsleyForm and ParsleyField functions
  *
  * @class Parsley
  * @constructor
  * @param {Mixed} Options. {Object} to configure Parsley or {String} method name to call a public class method
  * @param {Function} Callback function
  * @return {Mixed} public class method return
  */
  $.fn.parsley = function ( option, fn ) {
    var options = $.extend( true, {}, $.fn.parsley.defaults, 'undefined' !== typeof window.ParsleyConfig ? window.ParsleyConfig : {}, option, this.data() )
      , newInstance = null;

    function bind ( self, type ) {
      var parsleyInstance = $( self ).data( type );

      // if data never binded or we want to clone a build (for radio & checkboxes), bind it right now!
      if ( !parsleyInstance ) {
        switch ( type ) {
          case 'parsleyForm':
            parsleyInstance = new ParsleyForm( self, options, 'parsleyForm' );
            break;
          case 'parsleyField':
            parsleyInstance = new ParsleyField( self, options, 'parsleyField' );
            break;
          case 'parsleyFieldMultiple':
            parsleyInstance = new ParsleyFieldMultiple( self, options, 'parsleyFieldMultiple' );
            break;
          default:
            return;
        }

        $( self ).data( type, parsleyInstance );
      }

      // here is our parsley public function accessor
      if ( 'string' === typeof option && 'function' === typeof parsleyInstance[ option ] ) {
        var response = parsleyInstance[ option ]( fn );

        return 'undefined' !== typeof response ? response : $( self );
      }

      return parsleyInstance;
    }

    // if a form elem is given, bind all its input children
    if ( $( this ).is( 'form' ) ) {
      newInstance = bind ( $( this ), 'parsleyForm' );

    // if it is a Parsley supported single element, bind it too, except inputs type hidden
    // add here a return instance, cuz' we could call public methods on single elems with data[ option ]() above
    } else if ( $( this ).is( options.inputs ) && !$( this ).is( options.excluded ) ) {
      newInstance = bind( $( this ), !$( this ).is( 'input[type=radio], input[type=checkbox]' ) ? 'parsleyField' : 'parsleyFieldMultiple' );
    }

    return 'function' === typeof fn ? fn() : newInstance;
  };

  $.fn.parsley.Constructor = ParsleyForm;

  /**
  * Parsley plugin configuration
  *
  * @property $.fn.parsley.defaults
  * @type {Object}
  */
  $.fn.parsley.defaults = {
    // basic data-api overridable properties here..
    inputs: 'input, textarea, select'           // Default supported inputs.
    , excluded: 'input[type=hidden], :disabled' // Do not validate input[type=hidden] & :disabled.
    , trigger: false                            // $.Event() that will trigger validation. eg: keyup, change..
    , animate: true                             // fade in / fade out error messages
    , animateDuration: 300                      // fadein/fadout ms time
    , focus: 'first'                            // 'fist'|'last'|'none' which error field would have focus first on form validation
    , validationMinlength: 3                    // If trigger validation specified, only if value.length > validationMinlength
    , successClass: 'parsley-success'           // Class name on each valid input
    , errorClass: 'parsley-error'               // Class name on each invalid input
    , errorMessage: false                       // Customize an unique error message showed if one constraint fails
    , validators: {}                            // Add your custom validators functions
    , showErrors: true                          // Set to false if you don't want Parsley to display error messages
    , messages: {}                              // Add your own error messages here

    //some quite advanced configuration here..
    , validateIfUnchanged: false                                          // false: validate once by field value change
    , errors: {
        classHandler: function ( elem, isRadioOrCheckbox ) {}             // specify where parsley error-success classes are set
      , container: function ( elem, isRadioOrCheckbox ) {}                // specify an elem where errors will be **apened**
      , errorsWrapper: '<ul></ul>'                                        // do not set an id for this elem, it would have an auto-generated id
      , errorElem: '<li></li>'                                            // each field constraint fail in an li
      }
    , listeners: {
        onFieldValidate: function ( elem, ParsleyForm ) { return false; } // Executed on validation. Return true to ignore field validation
      , onFormSubmit: function ( isFormValid, event, ParsleyForm ) {}     // Executed once on form validation
      , onFieldError: function ( elem, constraints, ParsleyField ) {}     // Executed when a field is detected as invalid
      , onFieldSuccess: function ( elem, constraints, ParsleyField ) {}   // Executed when a field passes validation
    }
  };

  /* PARSLEY auto-bind DATA-API + Global config retrieving
  * =================================================== */
  $( window ).on( 'load', function () {
    $( '[data-validate="parsley"]' ).each( function () {
      $( this ).parsley();
    } );
  } );

// This plugin works with jQuery or Zepto (with data extension built for Zepto.)
}(window.jQuery || window.Zepto);











var fnames = new Array();var ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='MMERGE3';ftypes[3]='text';fnames[4]='MMERGE4';ftypes[4]='text';fnames[5]='MMERGE5';ftypes[5]='text';
try {
    var jqueryLoaded=jQuery;
    jqueryLoaded=true;
} catch(err) {
    var jqueryLoaded=false;
}
var head= document.getElementsByTagName('head')[0];
if (!jqueryLoaded) {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js';
    head.appendChild(script);
    if (script.readyState && script.onload!==null){
        script.onreadystatechange= function () {
              if (this.readyState == 'complete') mce_preload_check();
        }    
    }
}
var script = document.createElement('script');
script.type = 'text/javascript';
script.src = 'http://downloads.mailchimp.com/js/jquery.form-n-validate.js';
head.appendChild(script);
var err_style = '';
try{
    err_style = mc_custom_error_style;
} catch(e){
    err_style = '#mc_embed_signup input.mce_inline_error{border-color:#6B0505;} #mc_embed_signup div.mce_inline_error{margin: 0 0 1em 0; padding: 5px 10px; background-color:#6B0505; font-weight: bold; z-index: 1; color:#fff;}';
}
var head= document.getElementsByTagName('head')[0];
var style= document.createElement('style');
style.type= 'text/css';
if (style.styleSheet) {
  style.styleSheet.cssText = err_style;
} else {
  style.appendChild(document.createTextNode(err_style));
}
head.appendChild(style);
setTimeout('mce_preload_check();', 250);

var mce_preload_checks = 0;
function mce_preload_check(){
    if (mce_preload_checks>40) return;
    mce_preload_checks++;
    try {
        var jqueryLoaded=jQuery;
    } catch(err) {
        setTimeout('mce_preload_check();', 250);
        return;
    }
    try {
        var validatorLoaded=jQuery("#fake-form").validate({});
    } catch(err) {
        setTimeout('mce_preload_check();', 250);
        return;
    }
    mce_init_form();
}
function mce_init_form(){
    jQuery(document).ready( function($) {
      var options = { errorClass: 'mce_inline_error', errorElement: 'div', onkeyup: function(){}, onfocusout:function(){}, onblur:function(){}  };
      var mce_validator = $("#mc-embedded-subscribe-form").validate(options);
      $("#mc-embedded-subscribe-form").unbind('submit');//remove the validator so we can get into beforeSubmit on the ajaxform, which then calls the validator
      options = { url: 'http://basilapparel.us6.list-manage.com/subscribe/post-json?u=a853f89dd76f2587cf7e299a8&id=4c947b8c4d&c=?', type: 'GET', dataType: 'json', contentType: "application/json; charset=utf-8",
                    beforeSubmit: function(){
                        $('#mce_tmp_error_msg').remove();
                        $('.datefield','#mc_embed_signup').each(
                            function(){
                                var txt = 'filled';
                                var fields = new Array();
                                var i = 0;
                                $(':text', this).each(
                                    function(){
                                        fields[i] = this;
                                        i++;
                                    });
                                $(':hidden', this).each(
                                    function(){
                                        var bday = false;
                                        if (fields.length == 2){
                                            bday = true;
                                            fields[2] = {'value':1970};//trick birthdays into having years
                                        }
                                    	if ( fields[0].value=='MM' && fields[1].value=='DD' && (fields[2].value=='YYYY' || (bday && fields[2].value==1970) ) ){
                                    		this.value = '';
									    } else if ( fields[0].value=='' && fields[1].value=='' && (fields[2].value=='' || (bday && fields[2].value==1970) ) ){
                                    		this.value = '';
									    } else {
									        if (/\[day\]/.test(fields[0].name)){
    	                                        this.value = fields[1].value+'/'+fields[0].value+'/'+fields[2].value;									        
									        } else {
    	                                        this.value = fields[0].value+'/'+fields[1].value+'/'+fields[2].value;
	                                        }
	                                    }
                                    });
                            });
                        return mce_validator.form();
                    }, 
                    success: mce_success_cb
                };
      $('#mc-embedded-subscribe-form').ajaxForm(options);
      
      
    });
}
function mce_success_cb(resp){
    $('#mce-success-response').hide();
    $('#mce-error-response').hide();
    if (resp.result=="success"){
        $('#mce-'+resp.result+'-response').show();
        $('#mce-'+resp.result+'-response').html(resp.msg);
        $('#mc-embedded-subscribe-form').each(function(){
            this.reset();
    	});
    } else {
        var index = -1;
        var msg;
        try {
            var parts = resp.msg.split(' - ',2);
            if (parts[1]==undefined){
                msg = resp.msg;
            } else {
                i = parseInt(parts[0]);
                if (i.toString() == parts[0]){
                    index = parts[0];
                    msg = parts[1];
                } else {
                    index = -1;
                    msg = resp.msg;
                }
            }
        } catch(e){
            index = -1;
            msg = resp.msg;
        }
        try{
            if (index== -1){
                $('#mce-'+resp.result+'-response').show();
                $('#mce-'+resp.result+'-response').html(msg);            
            } else {
                err_id = 'mce_tmp_error_msg';
                html = '<div id="'+err_id+'" style="'+err_style+'"> '+msg+'</div>';
                
                var input_id = '#mc_embed_signup';
                var f = $(input_id);
                if (ftypes[index]=='address'){
                    input_id = '#mce-'+fnames[index]+'-addr1';
                    f = $(input_id).parent().parent().get(0);
                } else if (ftypes[index]=='date'){
                    input_id = '#mce-'+fnames[index]+'-month';
                    f = $(input_id).parent().parent().get(0);
                } else {
                    input_id = '#mce-'+fnames[index];
                    f = $().parent(input_id).get(0);
                }
                if (f){
                    $(f).append(html);
                    $(input_id).focus();
                } else {
                    $('#mce-'+resp.result+'-response').show();
                    $('#mce-'+resp.result+'-response').html(msg);
                }
            }
        } catch(e){
            $('#mce-'+resp.result+'-response').show();
            $('#mce-'+resp.result+'-response').html(msg);
        }
    }
}



