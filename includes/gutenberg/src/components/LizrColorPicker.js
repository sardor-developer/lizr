import {
	ColorIndicator,
	ColorPicker,
	Dropdown,
	Flex,
	FlexBlock,
	FlexItem,
} from '@wordpress/components';
import * as PropTypes from 'prop-types';

LizrColorPicker.propTypes = {
	label: PropTypes.string,
	value: PropTypes.string,
	containerClassName: PropTypes.string,
	dropdownClassName: PropTypes.string,
	dropdownContentClassName: PropTypes.string,
	dropdownPosition: PropTypes.string,
};

LizrColorPicker.defaultProps = {
	dropdownPosition: 'bottom right',
};

function LizrColorPicker( props ) {
	const {
		containerClassName,
		label,
		dropdownClassName,
		dropdownContentClassName,
		dropdownPosition,
		value,
		...colorPickerProps
	} = props;

	return (
		<div className={ containerClassName }>
			<Flex>
				<FlexBlock>
					<h4>{ label }</h4>
				</FlexBlock>
				<FlexItem>
					<Dropdown
						className={ dropdownClassName }
						contentClassName={ dropdownContentClassName }
						position={ dropdownPosition }
						renderToggle={ ( { isOpen, onToggle } ) => (
							<ColorIndicator colorValue={ value } aria-expanded={ isOpen } onClick={ onToggle } />
						) }
						renderContent={ () => (
							<ColorPicker
								{ ...colorPickerProps }
								color={ value }
							/>
						) }
					/>

				</FlexItem>
			</Flex>
		</div>
	);
}

export default LizrColorPicker;
