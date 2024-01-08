import {
	InspectorControls,
	useBlockProps,
	AlignmentToolbar,
	BlockControls,
	InnerBlocks,
	useInnerBlocksProps, MediaUpload,
	// eslint-disable-next-line @wordpress/no-unsafe-wp-apis
	__experimentalLinkControl as LinkControl,
} from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import {
	Panel,
	PanelBody,
	PanelRow,
	ToolbarGroup,
	TextControl,
	Placeholder, Button, Dropdown,
} from '@wordpress/components';
import { link } from '@wordpress/icons';
import IconMethods, { LIZR_ICON_BY_JSON_FILE, LIZR_ICON_BY_URL } from './constants/IconMethods';

//https://developer.wordpress.org/block-editor/how-to-guides/block-tutorial/block-controls-toolbar-and-sidebar/

import LizrMediaUpload from './components/LizrMediaUpload';
import AnimationTypes from './constants/AnimationTypes';
import LizrSelectControl from './components/LizrSelectControl';
import LizrRangeControl from './components/LizrRangeControl';
import LizrColorPicker from './components/LizrColorPicker';
import { getLizrIcon, getLizrIconURL } from './utils/helpers';
import LizrPopoverComponent from './components/LizrPopoverComponent';
import LizrPasteUrlControl from './components/LizrPasteUrlControl';

const Edit = ( { attributes, setAttributes } ) => {
	const { style } = attributes;

	const onChangeAttr = ( attr ) => {
		setAttributes( attr );
	};

	const blockProps = useBlockProps();
	const innerBlocksProps = useInnerBlocksProps();
	const lordIconSrc = getLizrIconURL( attributes );

	if ( attributes.preview ) {
		return <div className="lizr-preview-image"></div>;
	}

	return <div { ...blockProps }>
		<BlockControls>
			<AlignmentToolbar
				value={ attributes.alignment }
				onChange={ ( value ) => onChangeAttr( { alignment: value } ) }
			/>
			<ToolbarGroup>
				<LizrPopoverComponent
					buttonType="ToolbarButton"
					buttonIcon={ link }
					buttonVariant="toolbar"
				>
					<div>
						<LinkControl
							onChange={ ( value ) => onChangeAttr( { box_link: value } ) }
							onRemove={ ( ) => onChangeAttr( { box_link: null } ) }
							showSuggestions={ false }
							value={ attributes.box_link }
							settings={ [] }
						/>
					</div>
				</LizrPopoverComponent>

			</ToolbarGroup>
		</BlockControls>

		<InspectorControls key="setting">
			<Panel>
				<PanelBody title={ __( 'General', 'lizr' ) } initialOpen={ false }>
					<PanelRow>
						<LizrSelectControl
							className="lizr-full-width"
							label={ __( 'Icon method', 'lizr' ) }
							value={ attributes.icon_method }
							options={ IconMethods }
							onChange={ ( value ) => onChangeAttr( { icon_method: value } ) }
						/>
					</PanelRow>
					{ attributes.icon_method === LIZR_ICON_BY_URL && (
						<PanelRow>
							<TextControl
								className="lizr-full-width"
								label={ __( 'Paste CDN', 'lizr' ) }
								value={ attributes.cdn_lordicon }
								onChange={ ( value ) => onChangeAttr( { cdn_lordicon: value } ) }
							/>
						</PanelRow>
					) }
					{ attributes.icon_method === LIZR_ICON_BY_JSON_FILE && (
						<PanelRow>
							<LizrMediaUpload
								value={ attributes.json_lordicon }
								onSelect={ ( media ) => {
									onChangeAttr( {
										json_lordicon: {
											url: media.url,
											title: media.title,
											filename: media.filename,
											mime: media.mime,
										},
									} );
								} }
								allowedTypes={ [ 'application/json' ] }
								multiple={ false }
							/>
						</PanelRow>
					) }
					<PanelRow>
						<LizrSelectControl
							className="lizr-full-width"
							label={ __( 'Animation Trigger', 'lizr' ) }
							value={ attributes.animation_trigger }
							options={ AnimationTypes }
							onChange={ ( value ) => onChangeAttr( { animation_trigger: value } ) }
						/>
					</PanelRow>
				</PanelBody>
				{ lordIconSrc && (
					<PanelBody title="Icon" initialOpen={ false }>
						<PanelRow>
							<LizrRangeControl
								className="lizr-full-width"
								label={ __( 'Size', 'lizr' ) }
								value={ style.height }
								onChange={ ( size ) => onChangeAttr( {
									style: {
										...style,
										width: size,
										height: size,
									},
								} ) }
							/>
						</PanelRow>
						<PanelRow>
							<LizrColorPicker
								containerClassName="lizr-full-width"
								label={ __( 'Primary Color', 'lizr' ) }
								value={ attributes.icon_primary_color }
								onChange={ ( value ) => onChangeAttr( { icon_primary_color: value } ) }
							/>
						</PanelRow>
						<PanelRow>
							<LizrColorPicker
								containerClassName="lizr-full-width"
								label={ __( 'Secondary Color', 'lizr' ) }
								value={ attributes.icon_secondary_color }
								onChange={ ( value ) => onChangeAttr( { icon_secondary_color: value } ) }
							/>
						</PanelRow>
						<PanelRow>
							<LizrRangeControl
								className="lizr-full-width"
								label={ __( 'Stroke', 'lizr' ) }
								value={ attributes.icon_stroke }
								onChange={ ( value ) => onChangeAttr( { icon_stroke: value } ) }
							/>
						</PanelRow>
					</PanelBody>
				) }
			</Panel>
		</InspectorControls>

		{ lordIconSrc && (
			<div>
				<div style={ { textAlign: attributes.alignment } }>
					<lord-icon
						style={ style }
						src={ lordIconSrc }
						trigger={ attributes.animation_trigger }
						stroke={ attributes.icon_stroke }
						colors={ `primary:${ attributes.icon_primary_color },secondary:${ attributes.icon_secondary_color }` }>
					</lord-icon>
				</div>
				<div { ...innerBlocksProps }>
					<InnerBlocks
						allowedBlocks={ [ 'core/heading', 'core/paragraph', 'core/buttons' ] }
						template={ [
							[ 'core/heading', { placeholder: 'Add Title here...' } ],
							[ 'core/paragraph', { placeholder: 'Add Content here...' } ],
							[ 'core/buttons', { placeholder: 'Add Link here...' } ],
						] }
						templateLock={ false }
					/>
				</div>
			</div>
		) }

		{ ! lordIconSrc && (
			<Placeholder
				className="placeholder"
				icon={ getLizrIcon() }
				label={ __( 'Lord Icon', 'lizr' ) }
			>
				<div>
					{ __( 'Upload an json file, pick one from your media library, or add one with a URL.', 'lizr' ) }
					<div>
						<MediaUpload
							allowedTypes={ [ 'application/json' ] }
							multiple={ false }
							onSelect={ ( media ) => {
								onChangeAttr( {
									json_lordicon: {
										url: media.url,
										title: media.title,
										filename: media.filename,
										mime: media.mime,
									}, icon_method: LIZR_ICON_BY_JSON_FILE,
								} );
							} }
							render={ ( { open } ) => (
								<div className="lizr-media-upload-render">
									<Button onClick={ open } variant="primary">
										{ __( 'Get from Media Library', 'lizr' ) }
									</Button>
									<Dropdown
										contentClassName="lizr-dropdown-control"
										position="bottom right"
										renderToggle={ ( { isOpen, onToggle } ) => (
											<Button
												variant="secondary"
												onClick={ onToggle }
												aria-expanded={ isOpen }
											>
												{ __( 'Insert from URL', 'lizr' ) }
											</Button>
										) }
										renderContent={ () =>
											<LizrPasteUrlControl
												label={ __( 'Paste CDN', 'lizr' ) }
												value={ attributes.cdn_lordicon }
												onSubmit={ ( value ) => onChangeAttr( {
													cdn_lordicon: value,
													icon_method: LIZR_ICON_BY_URL,
												} ) }
											/> }
									/>
								</div>
							) }
						/>
					</div>
				</div>
			</Placeholder>
		) }
	</div>;
};

export default Edit;
