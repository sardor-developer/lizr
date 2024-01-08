import { __ } from '@wordpress/i18n';

export const LIZR_ANIMATION_LOOP = 'loop';
export const LIZR_ANIMATION_CLICK = 'click';
export const LIZR_ANIMATION_LOOP_ON_HOVER = 'loop-on-hover';
export const LIZR_ANIMATION_MORPH = 'morph';
export const LIZR_ANIMATION_MORPH_TWO_WAY = 'morph-two-way';
export const LIZR_IN_SCREEN = 'in-screen';
export const LIZR_IN_SCREEN_ONCE = 'in-screen-once';

export default [
	{ label: __( 'Loop (always animate)', 'lizr' ), value: LIZR_ANIMATION_LOOP },
	{ label: __( 'Click', 'lizr' ), value: LIZR_ANIMATION_CLICK },
	{ label: __( 'Loop on Hover', 'lizr' ), value: LIZR_ANIMATION_LOOP_ON_HOVER },
	{ label: __( 'Morph', 'lizr' ), value: LIZR_ANIMATION_MORPH },
	{ label: __( 'Morph Two Way', 'lizr' ), value: LIZR_ANIMATION_MORPH_TWO_WAY },
	{ label: __( 'In-screen', 'lizr' ), value: LIZR_IN_SCREEN },
	{ label: __( 'In-screen Once', 'lizr' ), value: LIZR_IN_SCREEN_ONCE },
];
