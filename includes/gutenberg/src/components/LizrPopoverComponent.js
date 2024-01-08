import { Button, Popover, ToolbarButton } from '@wordpress/components';
import * as PropTypes from 'prop-types';
import { useState } from '@wordpress/element';

LizrPopoverComponent.propTypes = {
	className: PropTypes.string,
	buttonVariant: PropTypes.string,
	buttonLabel: PropTypes.string,
	children: PropTypes.node,
	buttonIcon: PropTypes.element,
	buttonType: PropTypes.oneOf( [ 'Button', 'ToolbarButton' ] ),
};

LizrPopoverComponent.defaultProps = {
	buttonType: 'Button',
	buttonVariant: 'primary',
};

function LizrPopoverComponent( props ) {
	const {
		className,
		buttonVariant,
		children,
		buttonIcon,
		buttonType,
		buttonLabel,
	} = props;

	const [ isVisible, setIsVisible ] = useState( false );
	const toggleVisible = () => {
		setIsVisible( ( state ) => ! state );
	};

	return <div className={ className }>
		{ buttonType === 'Button' && (
			<Button variant={ buttonVariant } onClick={ toggleVisible }>{ buttonLabel }</Button>
		) }

		{ buttonType === 'ToolbarButton' && (
			<ToolbarButton icon={ buttonIcon } variant={ buttonVariant } onClick={ toggleVisible }>{ buttonLabel }</ToolbarButton>
		) }

		{ isVisible && <Popover>{ children }</Popover> }
	</div>;
}

export default LizrPopoverComponent;
