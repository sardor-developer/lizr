import { Button } from '@wordpress/components';
import { MediaUpload } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import * as PropTypes from 'prop-types';

LizrMediaUpload.propTypes = {
	value: PropTypes.object,
};

const LizrMediaViewComponent = ( { media } ) => {
	if ( media === null ) {
		return '';
	}

	return (
		<><p><strong>{ media.filename }</strong></p></>
	);
};

function LizrMediaUpload( { value, render, ...otherProps } ) {
	return <MediaUpload
		{ ...otherProps }
		render={ ( { open } ) => render || (
			<div>
				<LizrMediaViewComponent media={ value } />
				<Button onClick={ open } variant="secondary">
					{ value === null
						? __( 'Upload', 'lizr' )
						: __( 'Upload New File', 'lizr' ) }
				</Button>
			</div>
		) }
	/>;
}

export default LizrMediaUpload;
