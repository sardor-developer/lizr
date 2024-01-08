import './style.scss';
import './editor.scss';
import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';
import metadata from '../block.json';
import { getLizrIcon } from './utils/helpers';

const lizrIcon = getLizrIcon();

registerBlockType( metadata, {
	icon: {
		src: lizrIcon,
	},
	edit: Edit,
	save: Save,
} );
