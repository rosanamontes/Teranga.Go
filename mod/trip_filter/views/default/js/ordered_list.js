define(function (require) 
{
	var elgg = require('elgg');
	var $ = require('jquery');
	require('jquery-ui');
	
	$('.trip-filter-list-ordered').sortable({
		update: function () {
			var ordered_ids = [];
			$('.trip_filter-list-ordered > li').each(function () {
				var group_id = $(this).attr("id").replace("elgg-group-", "");
				ordered_ids.push(group_id);
			});
			elgg.action("trip_filter/order_mytrips", {
				data: {
					guids: ordered_ids
				}
			});
		}
	});

});