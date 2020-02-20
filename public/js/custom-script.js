

var editComment = document.querySelectorAll('.edit-comment');


editComment.forEach(function(element, index){
	element.addEventListener('click', function(){
		document.getElementById('comment-textarea').innerHTML = this.parentElement.previousElementSibling.innerText;
		console.log(this.parentElement.previousElementSibling.innerText);
	});
});