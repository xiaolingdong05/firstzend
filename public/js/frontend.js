function displayBooks(response){
	
	response = JSON.parse(response);

    console.log(response);
	$('#booksResponse').html('');
	for (var i in response.books){
		$('#booksResponse').append('<div id = "books"><h3><a href = "#">' + response.books[i].title+'</a></h3><div><b>written by</b>' + response.books[i].author+'</div></div>')
	}
	$('#booksResponse #books').accordion({'active':'none', 'collapsible':'true'});
    $("#currentPage").html(response.currentPage);
	updatePageLinks(response.currentPage);
}

function updatePageLinks(page){
	$('#previous').attr('page', page - 1);
	$('#next').attr('page', page + 1);
} 

function getBooks(){
	var url = window.location.pathname + '/page/' + $(this).attr('page');
	$.post(url,
		   {'format':"json"},
		   function(data)
		   {
		   	displayBooks(data);
		   }, 'html');
	return false;
}

$(document).ready(function(){
	$('a#next').click(getBooks);
	$('a#previous').click(getBooks);
	$('a#page').each(function(){
		$(this).click(getBooks);
	});
})