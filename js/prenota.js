(function () {
	updateData();

	$('.card').on('click', function (e) {
		e.preventDefault();

		updateData();

		var fascia1 = $('#fascia1');
		var fascia2 = $('#fascia2');
		var card = $(this);
		var day = card.attr('data-dayid');
		var cardData = window.days.filter(week_day => {
			return week_day.id == day;
		})[0]

		fascia1.attr('disabled', false)
		fascia2.attr('disabled', false)

		fascia1.next('label').html('19.30 - 21:30')
		fascia2.next('label').html('21.30 - 00:00')

		$('form input[name="day"]').val(day);
		$('.card').removeClass('selected');
		card.addClass('selected');

		if ($('.bottom-container').css('display') !== 'none') {
			$('.bottom-container').slideUp();
			$('.bottom-container').slideDown();
		} else {
			$('.bottom-container').slideDown();
		}

		updateData();

		if ( cardData.fascie[1].length > 1 ) {
			fascia1.attr('disabled', true)
			fascia1.next('label').html(cardData.fascie[1] || '19.30 - 21:30')
		}

		if ( cardData.fascie[2].length > 1 ) {
			fascia2.attr('disabled', true)
			fascia2.next('label').html(cardData.fascie[2] || '21.30 - 00:00')
		}
	})

	setTimeout(() => {
		$('.card').eq(0).trigger('click');
	}, 200)


	$('form').on('submit', function (e) {
		e.preventDefault();

		var fascia = $('form input[name="fascia"]:checked').val();
		var day = $('form input[name="day"]').val();

		var formData = new FormData();

		formData.set('fascia', fascia);
		formData.set('day', day);

		console.log(fascia);

		axios({
			method: 'post',
			url: '/backend/prenotation_handler.php',
			data: formData,
			config: { headers: { 'Content-Type': 'multipart/form-data' } }
		})
		.then(({data}) => {
			
			if (data.status === true) {
				$('.card').eq(day - 1).addClass('taken');
				$('.close').trigger('click');
			}

		})
		.catch(console.error);
	})

	$('.bottom-container .close').click(() => {
		$('.card').removeClass('selected');
		$('.bottom-container').slideUp();
	})
})()

// slideUp close
// slideDown open


function updateData() {
	axios.get('/backend/prenotations.php')
		.then(res => {

			window.days = res.data.map(day => {
				return {
					id: day.id,
					name: day.name,
					fascie: {
						1: day.fascia1 || '',
						2: day.fascia2 || ''
					}
				}
			})
		})
		.catch(err => {
			throw err;
		});
}