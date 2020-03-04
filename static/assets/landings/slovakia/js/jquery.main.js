$(document).ready(function(){
	
	function log(logText){
		console.log(logText);
	}

	// Thank you page question

		// Set data-index for each quiz__item
		$('.quiz__item').each(function(index){
			$(this).attr('data-index', index);

			// Get data-title
			var dataTitle = $(this).attr('data-title');

			// Get title of quiz item
			var quizItemTitle = $(this).find('.quiz__item-title');

			// set him html of this data-title
			quizItemTitle.html(dataTitle);

			// Get radio buttons of quiz item
			var quizItemRadio = $(this).find('input[type="radio"]');

			// Set attribute for radio buttons
			quizItemRadio.attr('data-title', dataTitle);

		});

		// Define array for quiz answers
		var quizArray = [];

		// Radio button change
		$('.js-quiz').change(function(){

			// Get value of changed radio
			var value = $(this).val();

			// Get title of input
			var title = $(this).attr('data-title');

			// Concat title and value
			var concat = title + ' - ' + value;

			// Get length of $('.quiz__item')
			var quizItemsLength = parseInt($('.quiz__item').length - 1);

			// Get parent of changed radio
			var quizParent = $(this).closest('.quiz__item');

			// Get index of parent $('.quiz__item')
			var quizParentIndex = parseInt(quizParent.attr('data-index'));

			// Add 1 for find next $('.quiz__item')
			var quizNextIndex = quizParentIndex + 1;

			// Push to array answer
			quizArray.push(concat);

			// Switch items 
			if(quizParentIndex < quizItemsLength){

				// Remove class of parent
				quizParent.removeClass('quiz__item_active');

				// Show next element, starting from parent
				$('.quiz__item[data-index="'+ quizNextIndex +'"]').addClass('quiz__item_active');
			}

		});

		function showAppearModal() {
			$('#modal-appear').addClass('modal_showing_in');
			$('body').addClass('modal-open');
		}

		setTimeout(function() {
			showAppearModal();
		}, 10000);

		$('.js-appear__button').click(function(){
			$('#modal-appear').removeClass('modal_showing_in');
			$('body').removeClass('modal-open');
		});
});	