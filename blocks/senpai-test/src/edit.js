import { __ } from '@wordpress/i18n';
import './editor.scss';

import {
	RichText,
    useBlockProps,
} from '@wordpress/block-editor';

import SettingSideBar from './sidebar';
import SettingToolBar from './toolbar';

export default function edit({ attributes, setAttributes }) {
	return (
		<div { ...useBlockProps() }>
				<SettingSideBar attributes={attributes} setAttributes={setAttributes} />
				<SettingToolBar attributes={attributes} setAttributes={setAttributes} />
				<RichText
                    className={ attributes.className }
                    tagName="h1"
                    onChange={ ( val ) => setAttributes( { message: val } ) }
                    value={ attributes.message }
					style={ {
                        backgroundColor: attributes.bg_color,
                        color: attributes.text_color,
						textAlign: attributes.alignment,
						padding: attributes.padding,
						margin: attributes.margin,
						fontSize: attributes.font_size,
                    } }
                />
		</div>
	);
}
