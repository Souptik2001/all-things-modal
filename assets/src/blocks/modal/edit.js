/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { useSelect } from '@wordpress/data';
import { useEffect } from '@wordpress/element';
import {
	Placeholder,
	PanelBody,
	ToggleControl,
	SelectControl,
	TextControl,
} from '@wordpress/components';
import {
	InspectorControls,
	useBlockProps,
	useInnerBlocksProps,
} from '@wordpress/block-editor';

/**
 * External dependencies.
 */
import classnames from 'classnames';

/**
 * Internal dependencies
 */
import './editor.scss';

/**
 * Edit.
 *
 * @param {Object}   props               Component properties.
 * @param {string}   props.className     Class name.
 * @param {Array}    props.attributes    Block attributes.
 * @param {Function} props.setAttributes Set block attributes.
 * @param {string}   props.clientId      Client ID.
 *
 * @return {WPElement} Element to render.
 */
export default function Edit( { className, attributes, setAttributes, clientId } ) {
	const {
		modalPostId,
		autoTrigger,
		autoTriggerDelay,
		triggerOnScroll,
		triggerOnScrollHeight,
		triggerOnPageExit,
		triggerOnPageExitDisableAfterNOccurrences,
		advancedBehaviorAppliesTo,
	} = attributes;

	// Fetch all posts of the CPT
	const modals = useSelect( ( select ) => {
		return select( 'core' ).getEntityRecords( 'postType', 'atm-modal', { per_page: -1 } );
	}, [] );

	// Set the modal ID.
	useEffect( () => {
		setAttributes( { modalId: 'atm-' + clientId } );
	}, [ setAttributes, clientId ] );

	// Build block props.
	const blockProps = useBlockProps( {
		className: classnames( className, 'modal' ),
	} );

	const innerBlocksProps = useInnerBlocksProps(
		{ className: classnames( className, 'modal' ) },
		{
			placeholder: __( 'Add a modal trigger element', 'all-things-modal' ),
		},
	);

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Required Settings', 'all-things-modal' ) }>
					<SelectControl
						label="Choose Modal"
						value={ modalPostId }
						options={
							modals
								? [
									{ label: 'Select modal', value: '' },
									...modals.map( ( post ) => ( {
										label: post.title.rendered,
										value: post.id,
									} ) ),
								]
								: [ { label: __( 'Loading', 'all-things-modal' ), value: '' } ]
						}
						onChange={ ( value ) => setAttributes( { modalPostId: parseInt( value, 10 ) } ) }
					/>
				</PanelBody>
				<PanelBody title={ __( 'Advanced Behavior', 'all-things-modal' ) } initialOpen={ false }>
					<SelectControl
						label="Advanced Behavior applies to"
						value={ advancedBehaviorAppliesTo }
						options={
							[
								{
									label: 'Both',
									value: '',
								},
								{
									label: 'Only Desktop',
									value: 'desktop',
								},
								{
									label: 'Only Mobile',
									value: 'mobile',
								},
							]
						}
						onChange={ ( value ) => setAttributes( { advancedBehaviorAppliesTo: value } ) }
					/>
					<ToggleControl
						label={ __( 'Auto Trigger', 'all-things-modal' ) }
						checked={ autoTrigger }
						onChange={ ( value ) => setAttributes( { autoTrigger: value } ) }
						help={ __( 'Should the modal auto appear after few seconds?', 'all-things-modal' ) }
					/>
					{ autoTrigger && (
						<TextControl
							label={ __( 'Auto Trigger Delay', 'all-things-modal' ) }
							value={ autoTriggerDelay }
							type="number"
							onChange={ ( value ) => setAttributes( { autoTriggerDelay: parseInt( value, 10 ) } ) }
							help={ __( 'Time in seconds after which the modal will appear.', 'all-things-modal' ) }
						/>
					) }
					<ToggleControl
						label={ __( 'Trigger on Scroll', 'all-things-modal' ) }
						checked={ triggerOnScroll }
						onChange={ ( value ) => setAttributes( { triggerOnScroll: value } ) }
						help={ __( 'Should the modal open after the page is scrolled certain height?', 'all-things-modal' ) }
					/>
					{ triggerOnScroll && (
						<TextControl
							label={ __( 'Trigger on Scroll Height', 'all-things-modal' ) }
							value={ triggerOnScrollHeight }
							type="number"
							onChange={ ( value ) => setAttributes( { triggerOnScrollHeight: parseInt( value, 10 ) } ) }
							help={ __( 'Height in pixels after which the modal will appear.', 'all-things-modal' ) }
						/>
					) }
					<ToggleControl
						label={ __( 'Trigger on Page exit', 'all-things-modal' ) }
						checked={ triggerOnPageExit }
						onChange={ ( value ) => setAttributes( { triggerOnPageExit: value } ) }
						help={ __( 'Should the modal when someone is leaving the page (basically when they focus out of the page)?', 'all-things-modal' ) }
					/>
					{ triggerOnPageExit && (
						<TextControl
							label={ __( 'Disable Trigger On Page exit after N Occurrences', 'all-things-modal' ) }
							value={ triggerOnPageExitDisableAfterNOccurrences }
							type="number"
							onChange={ ( value ) => setAttributes( { triggerOnPageExitDisableAfterNOccurrences: parseInt( value, 10 ) } ) }
							help={ __( 'The trigger on page exit behavior will be disabled after N occurrences (set to 0 to continue infinitely).', 'all-things-modal' ) }
						/>
					) }
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<Placeholder label={ `This modal with ID "${ modalPostId }" will be rendered. It's advanced behavior (if any) will be triggered on "${ advancedBehaviorAppliesTo ? advancedBehaviorAppliesTo : 'both' }" screens.` } />
				<div { ...innerBlocksProps } />
			</div>
		</>
	);
}
