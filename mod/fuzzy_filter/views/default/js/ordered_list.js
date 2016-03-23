define(function (require) {

	var elgg = require('elgg');
	var $ = require('jquery');
	require('jquery-ui');
	
	$('.fuzzy-filter-list-ordered').sortable({
		update: function () {
			var ordered_ids = [];
			$('.fuzzy_filter-list-ordered > li').each(function () {
				var group_id = $(this).attr("id").replace("elgg-group-", "");
				ordered_ids.push(group_id);
			});
			elgg.action("fuzzy_filter/order_groups", {
				data: {
					guids: ordered_ids
				}
			});
		}
	});

});