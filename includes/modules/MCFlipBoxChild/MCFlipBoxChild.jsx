// External Dependencies
import React, { Component, Fragment } from 'react';
import $ from 'jquery';

class MCFlipBoxChild extends Component {

  static slug = 'mc_et_pb_flipbox_child';

  _renderButton() {
    const props           = this.props;
    const utils           = window.ET_Builder.API.Utils;
    const buttonTarget    = 'on' === props.url_new_window ? '_blank' : '';
    const buttonIcon      = props.button_icon ? utils.processFontIcon(props.button_icon) : false;
    const buttonClassName = {
      et_pb_button:             true,
      et_pb_custom_button_icon: props.button_icon,
    };

    if (!props.button_text || !props.button_url) {
      return '';
    }

    return (
      <div className='et_pb_button_wrapper'>
        <a
          className={utils.classnames(buttonClassName)}
          href={props.button_url}
          target={buttonTarget}
          rel={utils.linkRel(props.button_rel)}
          data-icon={buttonIcon}
        >
          {props.button_text}
        </a>
      </div>
    );
  }

/**
   * Render prop value. Some attribute values need to be parsed before can be displayed
   *
   * @return {string|React.Component|React.component[]}
   */
  _renderProp(value, fieldName, fieldType, renderSlug) {
    const utils      = window.ET_Builder.API.Utils;
    const _          = utils._;
    const orderClass = `${this.props.moduleInfo.type}_${this.props.moduleInfo.order}`;

    let output = '';

    if (! value) {
      return output;
    }

    switch (fieldType) {
      case 'options_list':
        value = utils.decodeOptionListValue(value);

        if (_.isArray(value)) {
          output = value.map((option, index) => {
            return (
              <option key={`${orderClass}-${index}`} value={option.value}>{option.value}</option>
            );
          });
        }
        break;
      case 'options_list_checkbox':
        const checkboxName = `${orderClass}_${fieldName}`;

        value = utils.decodeOptionListValue(value);

        if (_.isArray(value)) {
          output = value.map((option, index) => {
            const checkboxID = `${checkboxName}_${index}`;
            const isChecked  = 1 === option.checked;

            return (
              <span className="checkbox-wrap" key={`${orderClass}-${index}`}>
                <input type="checkbox" id={checkboxID} className="input" value={option.value} readOnly={true} checked={isChecked}/>
                <label htmlFor={checkboxID}><i></i>{option.value}</label>
              </span>
            );
          });
        }
        break;
      case 'options_list_radio':
        const radioName = `${orderClass}_${fieldName}`;

        value = utils.decodeOptionListValue(value);

        if (_.isArray(value)) {
          output = value.map((option, index) => {
            const radioId   = `${radioName}_radio_${index}`;
            const isChecked = 1 === option.checked;

            return (
              <span key={`${orderClass}-${index}`} className="radio-wrap">
                <input type="radio" id={radioId} className="input" value={option.value} name={radioName} readOnly={true} checked={isChecked}/>
                <label htmlFor={radioId}><i></i>{option.value}</label>
              </span>
            );
          });
        }
        break;
      case 'font_icon':
        output = (
          <span className="et-pb-icon" style={{fontFamily: '"ETmodules"', fontSize: 30}}>{utils.processFontIcon(value)}</span>
        );
        break;
      case 'upload_image':
        output = <span className="et-pb-icon"><img src={value} alt=''/></span>;
        break;
      default:
        output = value;
        break;
    }

    return output;
  }

  static css(props) {
    const utils         = window.ET_Builder.API.Utils;
    const additionalCss = [];

    // Process text-align value into style
    if (props.text_orientation) {
      additionalCss.push([{
        selector:    '%%order_class%% .flipbox-title',
        declaration: `text-align: ${props.text_orientation};`,
      }]);
    }

    if (props.module_text_align) {
      additionalCss.push([{
        selector:    '%%order_class%% .flipbox-content',
        declaration: `text-align: ${props.module_text_align};`,
      }]);
    }


    // Process font option into style
    if (props.select_font) {
      additionalCss.push([{
        selector:    '%%order_class%% .flipbox-content',
        declaration: utils.setElementFont(props.select_font),
      }]);
    }

    // Process color preview color
    if (props.color) {
      additionalCss.push([{
        selector:    '%%order_class%% .flipbox-content',
        declaration: `background-color: ${props.color};`,
      }]);
    }

    // Process color preview color alpha
    if (props.title_color) {
      additionalCss.push([{
        selector:    '%%order_class%% .flipbox-title',
        declaration: `color: ${props.title_color};`,
      }]);
    }

    return additionalCss;
  }

  resizeFlipBox() {
    console.log('resize');
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

  /*onItemClick( e ) {

    e.preventDefault();
    console.log('clicked');
    var button_clicked = e.currentTarget;
    var parent = $(  button_clicked ).parents( '.mc_et_pb_flipbox_child' );
    console.log(parent);
    $( parent ).addClass( 'hidden' );
    $( parent ).next( '.mc_et_pb_flipbox_child' ).addClass( 'visible' );
    $('.rotate_button').not(  button_clicked ).parents( '.mc_et_pb_flipbox_child.visible' ).removeClass('visible');

  }*/

  /**
   * Module render in VB
   * Basically MCFliBoxParent->render() equivalent in JSX
   */
  render() {

    const utils = window.ET_Builder.API.Utils;

    var currentEditing = $( '*[data-address="'+this.props.moduleInfo.address+'"]' );

    $( '.mc_et_pb_flipbox_child' ).removeClass( 'hidden' );

    $( currentEditing ).siblings( '.mc_et_pb_flipbox_child' ).removeClass( 'visible' );
    $( currentEditing ).siblings( '.mc_et_pb_flipbox_child' ).addClass( 'hidden' );
    $( currentEditing ).addClass( 'visible' );

    this.resizeFlipBox();

    const CustomTag = `${ !!( this.props.title_level ) ? this.props.title_level : 'h2' }`;

    const useShadow  = 'on' === this.props.title_shadow ? true : false;

    const titleClass = {
      'flipbox-title': true,
      'title_shadow': useShadow
    }

    return (
      <Fragment>
        <div className="flipbox-top">
          { ( ( this.props.use_icon !== 'on' && this.props.image ) || this.props.use_icon !== 'off' ) && (
            <div className="flipbox-header">
              <div>
                { this.props.use_icon !== 'off' && (
                  this._renderProp(this.props.font_icon, 'font_icon', 'font_icon', this.props.moduleInfo.type)
                ) }
              </div>
              <div>
                { this.props.use_icon !== 'on' && this.props.image && (
                  this._renderProp(this.props.image, 'image', 'upload_image', this.props.moduleInfo.type)
                ) }
              </div>
            </div>
          ) }
          { !! this.props.title && (
            <CustomTag className={ utils.classnames(titleClass) }>{this.props.title}</CustomTag>
          ) }
          { !! this.props.content && (
            <div className="flipbox-content">{this.props.content()}</div>
          ) }
        </div>
        <div className="button_bottom">
          { this._renderButton() }
        </div>
        { 'on' === this.props.use_flip_icon && (
          <div className="flipbox-bottom">
            <a className="rotate_button" href="#"></a>
          </div>
        ) }
      </Fragment>
    );
  }

  componentDidUpdate(lastProps, lastStates) {
    this.resizeFlipBox();
  }

}

export default MCFlipBoxChild;
