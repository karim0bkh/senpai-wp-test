import { __ } from '@wordpress/i18n';


/**
 * 
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/
 */
import {
    ColorPalette,
    InspectorControls,
    PanelColorSettings,
    
} from '@wordpress/block-editor';

/**
 * @see https://developer.wordpress.org/block-editor/reference-guides/components/
 */
import { FontSizePicker,
         PanelBody,
         PanelRow,
         Card,
         CardBody,
         CardHeader,
         RangeControl,

} from '@wordpress/components';

/**
 * @see https://wordpress.github.io/gutenberg/?path=/story/icons-icon--library
 */
import { fullscreen,aspectRatio,brush } from '@wordpress/icons';


export default function SettingSideBar({attributes,setAttributes}){
    const onChangeBGColor = ( hexColor ) => {
        setAttributes( { bg_color: hexColor } );
    };
    
    const onChangeTextColor = ( hexColor ) => {
        setAttributes( { text_color: hexColor } );
    };
    const onChangeFontSize = (size)=>{
        setAttributes( { font_size: size } );
    }
    const fontSizes = [
		{
			name: 'Small',
			slug: 'small',
			size: 12,
		},
		{
			name: 'Normal',
			slug: 'normal',
			size: 16,
		},
		{
			name: 'Big',
			slug: 'big',
			size: 26,
        }
    ];
    const fallbackFontSize = 16;

    return (
        <InspectorControls key="setting">
                <PanelBody title={__('Font settings')} 
                initialOpen={ false }>
                    <PanelRow>
                        <div class="senpai-w-100">
                            <FontSizePicker 
                                        fontSizes={ fontSizes }
                                        value={ attributes.font_size }
                                        fallbackFontSize={ fallbackFontSize }
                                        onChange={onChangeFontSize}
                                        withSlider
                            />
                        </div>
                    </PanelRow>
                </PanelBody>

                <PanelColorSettings 
					title={__('Color settings')}
                    initialOpen={ false }
					colorSettings={[
						{
							value: attributes.text_color,
							onChange: onChangeTextColor,
							label: __('Text Color')
						},
                        {
							value: attributes.bg_color,
							onChange: onChangeBGColor,
                            label: __('Background color')
                        },
					]}
				/>
                <PanelBody title={__('Spacing settings')}  initialOpen={ false }>
                    <PanelRow>
                                <div class="senpai-w-100">
                                    <RangeControl
                                        label="margin"
                                        value={ attributes.margin }
                                        onChange={ ( margin ) => setAttributes( { margin } ) }
                                        min={ 0 }
                                        max={ 50 }
                                    />
                                </div>
                                </PanelRow>
                            <PanelRow>
                                <div class="senpai-w-100">
                                    <RangeControl
                                        label="padding"
                                        value={ attributes.padding }
                                        onChange={ ( padding ) => setAttributes( { padding } ) }
                                        min={ 0 }
                                        max={ 50 }
                                    />
                                </div>
                    </PanelRow>
                </PanelBody>
        </InspectorControls>
    );
};