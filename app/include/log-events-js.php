	<script type="text/javascript"><!--
		function logEvent(action) {
			<?php if ($log_events === true || !isset($log_events)): ?>
						try {
							pageTracker._initData();
							pageTracker._trackPageview(action);
						} catch (err) {}
			<?php endif; ?>
		}
	//--></script>
