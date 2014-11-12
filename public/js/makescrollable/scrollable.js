
// Initialize the plugin with no custom options
$(document).ready(function () {
  // None of the options are set
  $("div#makeMeScrollable").smoothDivScroll({
    touchScrolling: true,
    // mousewheelScrolling: "allDirections",
	manualContinuousScrolling: true
  });
});
