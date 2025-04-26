<?php
/**
 * Example block dynamic template.
 *
 * @package all-things-modal
 */

?>

<?php
	if ( !empty( $trigger_element ) ) {
		?>
			<atm-modal-trigger modal-id="<?php echo esc_attr( $attributes['modalId'] ); ?>">
				<?php echo wp_kses_post( $trigger_element ); ?>
			</atm-modal-trigger>
		<?php
	}
?>

<atm-modal
	modal-id="<?php echo esc_attr( $attributes['modalId'] ); ?>"
	auto-trigger="<?php echo esc_attr( $attributes['autoTrigger'] ); ?>"
	auto-trigger-delay="<?php echo esc_attr( $attributes['autoTriggerDelay'] ); ?>"
	trigger-on-scroll="<?php echo esc_attr( $attributes['triggerOnScroll'] ); ?>"
	trigger-on-scroll-height="<?php echo esc_attr( $attributes['triggerOnScrollHeight'] ); ?>"
	trigger-on-page-exit="<?php echo esc_attr( $attributes['triggerOnPageExit'] ); ?>"
	trigger-on-page-exit-disable-after-n-occurrences="<?php echo esc_attr( $attributes['triggerOnPageExitDisableAfterNOccurrences'] ); ?>"
	advanced-behavior-applies-to="<?php echo esc_attr( $attributes['advancedBehaviorAppliesTo'] ); ?>"
>
	<tp-modal id="<?php echo esc_attr( $attributes['modalId'] ); ?>" overlay-click-close="yes">
		<tp-modal-close>
			<button>Close</button>
		</tp-modal-close>
		<tp-modal-content>
			<?php
				echo wp_kses_post( $modal_content );
			?>
		</tp-modal-content>
	</tp-modal>
</atm-modal>