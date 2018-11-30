// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class BlogGrid extends Component {

  static slug = 'mdvcm_blog_grid';

  render() {
    return (
      <div dangerouslySetInnerHTML={{__html: this.props.__posts}} />
    );
  }
}

export default BlogGrid;
