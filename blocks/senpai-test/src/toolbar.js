import { __ } from '@wordpress/i18n';

import {
    AlignmentToolbar,
    BlockControls,
} from '@wordpress/block-editor';

export default function SettingToolBar({attributes,setAttributes}){
	const onChangeAlignment = ( newAlignment ) => {
		setAttributes( {
			alignment: newAlignment === undefined ? 'none' : newAlignment,
		} );
	};

    return(
        <BlockControls>
            <AlignmentToolbar
                value={ attributes.alignment }
                onChange={ onChangeAlignment }
            />
        </BlockControls>
    );
}