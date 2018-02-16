$(document).ready(() => {
	$('#order').click(e => {
		e.preventDefault();
		$.post('/order/create', $('.order-form').serialize(), (data, status) => {
			if (status != 'success') return;
			data = JSON.parse(data);
			if (!data.success) return alertError(data.message);
			alertSuccess(data.message);
		});
	});

	$('#login').click(function(e) {
		e.preventDefault();
		let form = $('.login-form').serialize();
		form += '&' + $(this).attr('name') + '=' + $(this).val();
		$.post('/login', form, (data, status) => {
			if (status != 'success') return;
			data = JSON.parse(data);
			if (!data.success) return alertError(data.message);
			window.location.replace('/order/list');
		});
	});

	$('#searchBy').keyup(e => {
		if (e.keyCode == 13)
			$('#search').click();
	});

	$('#search').click(e => {
		e.preventDefault();
		let search = $('#searchBy').val() || '';
		search = search.replace(' ', '-');
		let sortByIndex = $('#sortBy')[0].selectedIndex;
		let sortBy = 'id', asc = 'desc';
		if (sortByIndex) {
			let element = $('#sortBy option:eq(' + sortByIndex + ')');
			sortBy = element.attr('sortBy');
			asc = element.attr('asc');
		}
		let queryStr = window.location.href.split('?')[1];
		queryStr = queryStr ? ('?' + queryStr) : '';
		window.location.replace('/order/list/' + sortBy + '/' + asc + '/' + search + queryStr);
	});

	$('#reset').click(() => window.location.replace('/order/list'));

	$('#type, #amount').change(function() {
		let typeIndex = $('#type')[0].selectedIndex;
		let amountIndex = $('#amount')[0].selectedIndex;
		if (!typeIndex || !amountIndex) return $('#total').html(0);
		let price = $('#type option:eq(' + typeIndex + ')').attr('price');
		let amount = $('#amount option:eq(' + amountIndex + ')').val();
		$('#total').html(Math.round(price * amount * 100) / 100);
	});

	function alertError(message) {
		swal('Klaida!', message, 'error');
	}

	function alertSuccess(message) {
		swal('Puiku!', message, 'success');
	}

	let url = window.location.href.split('?')[0];
	url = url.split('order/list');
	if (url[1]) {
		if (url[1][0] == '/') url[1] = url[1].replace('/', '');
		let subUrl = url[1].split('/');
		if (!subUrl[0] || !subUrl[1]) return;
		$('#sortBy option[sortBy="' + subUrl[0] + '"][asc="' + subUrl[1] + '"]').prop('selected', true);
		if (subUrl[2])
			$('#searchBy').val(decodeURIComponent(subUrl[2].replace('-', ' ')));
	}
});