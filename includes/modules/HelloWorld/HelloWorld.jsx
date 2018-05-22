// External Dependencies
import React, { Component, Fragment } from 'react';

// Internal Dependencies
import './style.css';


class HelloWorld extends Component {

  static slug = 'mdcm_hello_world';

  render() {
    return (
      <Fragment>
    	<div className="et_pb_flipbox { this.props.module_class } ">
    		<div className="box">
    			<a
		          href={this.props.link}
		        >
		        	<div className="face front">
		        		<p>{this.props.content()}</p>
		        	</div>
		        	<div className="face back">
		        		<p>{this.props.back_text}</p>
		        	</div>
		        </a>
    		</div>
        </div>
      </Fragment>
    );
  }
}

export default HelloWorld;