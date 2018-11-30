// External Dependencies
import React, { Component, Fragment } from 'react';
import $ from 'jquery';

class MCFlipBoxParent extends Component {

  static slug = 'mc_et_pb_flipbox';

  resizeFlipBox() {

    // Get an array of all element heights
    var elementHeights = null;
    $( '.et_pb_row' ).each( function() {

      var flixboxModulesChilds = $( this ).find( '.mc_et_pb_flipbox_child > div:first-child' );

      var elementHeights = $( flixboxModulesChilds ).map( function() {
        return $( this ).outerHeight();
      }).get();

      var flixboxModules = $( this ).find( '.mc_et_pb_flipbox_child, .mc_et_pb_flipbox' );

      // Math.max takes a variable number of arguments
      // `apply` is equivalent to passing each height as an argument
      var maxHeight = Math.max.apply( null, elementHeights );
      // Set each height to the max height
      $( flixboxModules ).height( maxHeight );
    });
  }

  /**
   * Module render in VB
   * Basically MCFlipBoxParent->render() equivalent in JSX
   */
  render() {
    //console.log(this);
    return (
      <Fragment>
        {this.props.content}
      </Fragment>
    );
  }

  componentDidUpdate(lastProps, lastStates) {
    this.resizeFlipBox();
  }
}

export default MCFlipBoxParent;
