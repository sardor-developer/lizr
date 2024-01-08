import { RangeControl } from '@wordpress/components';
import * as PropTypes from 'prop-types';

LizrRangeControl.propTypes = {
	className: PropTypes.string,
	min: PropTypes.number,
	max: PropTypes.number,
};

LizrRangeControl.defaultProps = {
	min: 0,
	max: 500,
};

function LizrRangeControl( { className, ...otherProps } ) {
	return <div className={ className }>
		<RangeControl
			{ ...otherProps }
		/>
	</div>;
}

export default LizrRangeControl;
