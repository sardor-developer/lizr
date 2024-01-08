import { __ } from '@wordpress/i18n';

export const LIZR_ICON_BY_URL = 'paste_url';
export const LIZR_ICON_BY_JSON_FILE = 'upload_json_file';

export default [
	{ label: __( 'Paste Lordicon URL', 'lizr' ), value: LIZR_ICON_BY_URL },
	{ label: __( 'Upload Lordicon JSON File', 'lizr' ), value: LIZR_ICON_BY_JSON_FILE },
];
