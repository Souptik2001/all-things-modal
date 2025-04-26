/**
 * Global variables.
 */
const { customElements, HTMLElement } = window;

/**
 * External dependencies.
 */
import '@travelopia/web-components/dist/modal';

/**
 * ModalTrigger Class.
 */
class ModalTrigger extends HTMLElement {
	/**
	 * Constructor.
	 */
	constructor() {
		// Initialize parent.
		super();

		// Elements.
		this.modalId = this.getAttribute( 'modal-id' );

		// Check if modal id is not available, return.
		if ( ! this.modalId ) {
			// Modal ID not found, bail early.
			return;
		}

		// Get the modal element.
		this.modal = document.querySelector( 'tp-modal#' + this.modalId );

		// Event.
		this.addEventListener( 'click', () => this.open() );
	}

	/**
	 * Open Modal.
	 */
	open() {
		// Check if we have modal element.
		if ( this.modal ) {
			// Open the modal.
			this.modal.open();
		}
	}
}

/**
 * Modal Class.
 */
class Modal extends HTMLElement {
	/**
	 * Constructor.
	 */
	constructor() {
		// Initialize parent.
		super();

		// Elements.
		this.modalId = this.getAttribute( 'modal-id' );

		// Check if modal id is not available, return.
		if ( ! this.modalId ) {
			// Modal ID not found, bail early.
			return;
		}

		this.modal = document.querySelector( 'tp-modal#' + this.modalId );
		this.autoTrigger = this.getAttribute( 'auto-trigger' );
		this.autoTriggerDelay = this.getAttribute( 'auto-trigger-delay' );
		this.triggerOnScroll = this.getAttribute( 'trigger-on-scroll' );
		this.triggerOnScrollHeight = this.getAttribute( 'trigger-on-scroll-height' );
		this.triggerOnPageExit = this.getAttribute( 'trigger-on-page-exit' );
		this.triggerOnPageExitDisableAfterNOccurrences = this.getAttribute( 'trigger-on-page-exit-disable-after-n-occurrences' );
		this.advancedBehaviorAppliesTo = this.getAttribute( 'advanced-behavior-applies-to' );
		this.triggerOnExitCount = 0;
		this.initialVerticalPosition = window.scrollY;

		if (
			'desktop' === this.advancedBehaviorAppliesTo &&
			window.innerWidth <= 600
		) {
			return;
		}

		if (
			'mobile' === this.advancedBehaviorAppliesTo &&
			window.innerWidth > 600
		) {
			return;
		}


		if ( 'yes' === this.autoTrigger ) {
			// Set timeout to open the modal.
			setTimeout( () => {
				this.open();
			}, this.autoTriggerDelay * 1000 );
		}

		if ( 'yes' === this.triggerOnScroll ) {
			// Pre-bind the event handler, so that we can remove the event listener later.
			this.boundScrollTriggerHandler = this.scrollTriggerHandler.bind( this );

			// Set scroll event to open the modal.
			window.addEventListener( 'scroll', this.boundScrollTriggerHandler );
		}

		if ( 'yes' === this.triggerOnPageExit ) {
			this.boundPageExitTriggerHandler = this.pageExitTriggerHandler.bind( this );
			document.addEventListener( 'mouseleave', this.boundPageExitTriggerHandler );
		}
	}

	/**
	 * Scroll trigger handler.
	 */
	scrollTriggerHandler() {
		if ( Math.abs( this.initialVerticalPosition - window.scrollY ) >= this.triggerOnScrollHeight ) {
			// Check if we have modal element.
			this.open();
			window.removeEventListener( 'scroll', this.boundScrollTriggerHandler );
		}
	}

	/**
	 * Page exit handler.
	 */
	pageExitTriggerHandler() {
		this.triggerOnExitCount++;
		this.open();

		if ( this.triggerOnPageExitDisableAfterNOccurrences > 0 && this.triggerOnExitCount >= this.triggerOnPageExitDisableAfterNOccurrences ) {
			document.removeEventListener( 'mouseleave', this.boundPageExitTriggerHandler );
		}
	}

	/**
	 * Open Modal.
	 */
	open() {
		// Check if we have modal element.
		if ( this.modal ) {
			// Open the modal.
			this.modal.open();
		}
	}
}

/**
 * Initialize.
 */
customElements.define( 'atm-modal', Modal );
customElements.define( 'atm-modal-trigger', ModalTrigger );
