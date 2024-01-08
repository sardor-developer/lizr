import { SelectControl } from '@wordpress/components';
import * as PropTypes from 'prop-types';

LizrSelectControl.propTypes = {
	className: PropTypes.string,
};

function LizrSelectControl( { className, ...otherProps } ) {
	return <div className={ className }>
		<SelectControl
			{ ...otherProps }
		/>
	</div>;
}

export default LizrSelectControl;
