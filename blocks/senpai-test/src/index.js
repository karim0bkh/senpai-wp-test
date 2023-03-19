/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
 import { registerBlockType } from '@wordpress/blocks';
 import { __ } from '@wordpress/i18n';
 /**
  * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
  * All files containing `style` keyword are bundled together. The code used
  * gets applied both to the front of your site and to the editor.
  *
  * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
  */
 import './style.scss';
 
 /**
  * Internal dependencies
  */
 import edit from './edit';
 import save from './save';
 
 /**
  * Every block starts by registering a new block type definition.
  *
  * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
  */
 registerBlockType( 'wp-senpai-blocks/senpai-test', {
     title: __("Senpai Test",'great-senpai'),
 
     category: "senpai-blocks",
 
     // Specifying a custom svg for the block
     icon: <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M0 0h24v24H0V0z" /><path d="M19 13H5v-2h14v2z" /></svg>,
 
     attributes: {
         message: {
             type: 'string',
             source: 'text',
             selector: 'div',
             default: 'Notice me senpai!', // empty default
         },
         bg_color: { type: 'string', default: '#0071a1' },
         text_color: { type: 'string', default: '#ffffff' },
         alignment: {
             type: 'string',
             default: 'center',
         },
         margin: {
             type: 'integer',
             default: 0,
         },
         padding: {
             type: 'integer',
             default: 0,
         },
         font_size: {
             type: 'integer',
             default: 16,
         },
     },
 
     /**
      * @see ./edit.js
      */
     edit,
 
     /**
      * @see ./save.js
      */
     save,
 } );
 