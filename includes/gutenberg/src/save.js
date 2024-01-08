import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import { getLizrIconURL } from './utils/helpers';
import { path } from 'ramda';

const Save = ( { attributes } ) => {
	const { style } = attributes;

	const lordIconSrc = getLizrIconURL( attributes );
	if ( ! lordIconSrc ) {
		return null;
	}

	const blockProps = useBlockProps.save();

	const boxLink = path( [ 'box_link', 'url' ], attributes );

	const iconView = ( <div { ...blockProps }>
		<div style={ { textAlign: attributes.alignment } }>
			<lord-icon
				style={ style }
				src={ lordIconSrc }
				trigger={ attributes.animation_trigger }
				stroke={ attributes.icon_stroke }
				colors={ `primary:${ attributes.icon_primary_color },secondary:${ attributes.icon_secondary_color }` }>
			</lord-icon>
		</div>
		<InnerBlocks.Content />
	</div> );

	if ( boxLink ) {
		return (
			<a href={ boxLink } title={ attributes.box_link.title }>
				{ iconView }
			</a>
		);
	}

	return iconView;
};

export default Save;
