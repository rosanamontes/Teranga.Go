define(function (require) {
	var elgg = require('elgg'),
		$ = require('jquery');

	$('.elgg-menu-item-evaluation-content a, .elgg-menu-item-reportuser a').each(function () {
		if (!/address=/.test(this.href)) {
			this.href += '?url=' + encodeURIComponent(location.href) +
						'&name=' + encodeURIComponent(document.title);
		}
	});

	$(document).on('submit', '.elgg-form-evaluationcontent-add', function (e) {
		e.preventDefault();
		var $form = $(this);
		elgg.action($form[0].action, {
			data: $form.serialize(),
			success: function (data) {
				if (data.status == 0) {
					elgg.ui.lightbox.close();
				}
			}
		});
	});

	$(document).on('click', '.elgg-form-evaluationcontent-add .elgg-button-cancel', function (e) {
		if ($(this).is('#colorbox *')) {
			elgg.ui.lightbox.close();
		} else {
			if (history.length > 1) {
				history.go(-1);
			} else {
				location.href = elgg.get_site_url();
			}
		}
		return false;
	});

	$(document).on('click', '.elgg-item-object-evaluation_content', function (e) {
		var $clicked = $(e.target),
			$li = $(this);

		if (!$clicked.is('button[data-elgg-action]')) {
			return;
		}

		var action = $clicked.data('elggAction');
		elgg.action(action.name, {
			data: action.data,
			success: function (data) {
				if (data.status == -1) {
					return;
				}

				if (action.name === 'evaluationcontent/delete') {
					$li.slideUp();
				} else {
					$clicked.fadeOut();
					$li.find('.evaluation-content-active')
						.removeClass('evaluation-content-active')
						.addClass('evaluation-content-archived');
				}

				if (!$('.evaluation-content-refresh').length) {
					$li.parent().after('<p class="evaluation-content-refresh mtm ptm elgg-divide-top center">' +
						'<a href="">' + elgg.echo('evaluationcontent:refresh') + '</a></p>');
				}
			}
		});
		return false;
	})
});
