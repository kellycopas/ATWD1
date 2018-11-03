// Displays correct form content for either POST, PUT or DELETE

$('.btn a').on('click', function (e) {

	e.preventDefault();

	$(this).parent().addClass('active');
	$(this).parent().siblings().removeClass('active');

	target = $(this).attr('href');

	$('.form_content > div').not(target).hide();

	$(target).fadeIn(600);
	
});