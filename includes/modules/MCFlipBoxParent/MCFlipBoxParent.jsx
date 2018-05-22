// External Dependencies
import React, { Component, Fragment } from 'react';


class MCFlipBoxParent extends Component {

  static slug = 'mc_et_pb_flipbox';

  /**
   * Module render in VB
   * Basically MCFlipBoxParent->render() equivalent in JSX
   */
  render() {
    console.log(this.props);
    return (
      <Fragment>
        {this.props.content}
      </Fragment>
    );
  }
}

export default MCFlipBoxParent;
