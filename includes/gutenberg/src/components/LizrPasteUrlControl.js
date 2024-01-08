import { Flex, FlexBlock, FlexItem, IconButton, TextControl } from '@wordpress/components';
import * as PropTypes from 'prop-types';
import { check } from '@wordpress/icons';
import { useState } from '@wordpress/element';

LizrPasteUrlControl.propTypes = {
	className: PropTypes.string,
	onSubmit: PropTypes.func,
	value: PropTypes.string,
};

function LizrPasteUrlControl( { onSubmit, value, ...props } ) {
	const [ content, setContent ] = useState( value );

	return <Flex className="lizr-dropdown-content" align="flex-end">
		<FlexBlock>
			<TextControl
				{ ...props }
				onChange={ ( text ) => setContent( text ) }
			/>
		</FlexBlock>
		<FlexItem >
			<IconButton icon={ check } onClick={ () => onSubmit( content ) }></IconButton>
		</FlexItem>
	</Flex>;
}

export default LizrPasteUrlControl;
